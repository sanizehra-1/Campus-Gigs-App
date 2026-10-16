<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");
require_once "db.php";

// ── POST: Submit a review ────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data       = json_decode(file_get_contents("php://input"), true);
    $booking_id = intval($data['booking_id'] ?? 0);
    $rating     = intval($data['rating']     ?? 0);
    $comment    = mysqli_real_escape_string($conn, trim($data['comment'] ?? ''));
    if (!$booking_id || $rating < 1 || $rating > 5) {
        echo json_encode(["error" => "booking_id and rating (1-5) required."]); exit;
    }
    // Check not already reviewed
    $check = mysqli_query($conn, "SELECT review_id FROM reviews WHERE booking_id=$booking_id");
    if (mysqli_num_rows($check) > 0) {
        echo json_encode(["error" => "Already reviewed."]); exit;
    }
    $sql = "INSERT INTO reviews (booking_id, rating, comment) VALUES ($booking_id, $rating, '$comment')";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => true, "review_id" => mysqli_insert_id($conn)]);
    } else {
        echo json_encode(["error" => mysqli_error($conn)]);
    }
    mysqli_close($conn); exit;
}

// ── GET: Fetch reviews for a service ────────────────────
$service_id = isset($_GET['service_id']) ? intval($_GET['service_id']) : 0;
$sql = "
    SELECT r.review_id, r.rating, r.comment,
           u.full_name AS reviewer_name,
           s.title     AS service_title,
           b.booking_id
    FROM reviews r
    JOIN bookings b ON r.booking_id = b.booking_id
    JOIN users    u ON b.buyer_id   = u.user_id
    JOIN services s ON b.service_id = s.service_id
";
if ($service_id) $sql .= " WHERE b.service_id = $service_id";
$sql .= " ORDER BY r.review_id DESC";

$result = mysqli_query($conn, $sql);
$out    = [];
while ($r = mysqli_fetch_assoc($result)) $out[] = $r;
echo json_encode($out);
mysqli_close($conn);
?>
