<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PATCH");
header("Access-Control-Allow-Headers: Content-Type");
require_once "db.php";

// ── POST: Create booking ─────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data       = json_decode(file_get_contents("php://input"), true);
    $buyer_id   = intval($data['buyer_id']   ?? 0);
    $service_id = intval($data['service_id'] ?? 0);
    if (!$buyer_id || !$service_id) {
        echo json_encode(["error" => "buyer_id and service_id required."]); exit;
    }
    $date = date("Y-m-d");
    $sql  = "INSERT INTO bookings (buyer_id, service_id, booking_date, status)
             VALUES ($buyer_id, $service_id, '$date', 'Pending')";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => true, "booking_id" => mysqli_insert_id($conn)]);
    } else {
        echo json_encode(["error" => mysqli_error($conn)]);
    }
    mysqli_close($conn); exit;
}

// ── PATCH: Update booking status ─────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
    $data       = json_decode(file_get_contents("php://input"), true);
    $booking_id = intval($data['booking_id'] ?? 0);
    $status     = mysqli_real_escape_string($conn, $data['status'] ?? '');
    $allowed    = ['Pending','Confirmed','Completed'];
    if (!$booking_id || !in_array($status, $allowed)) {
        echo json_encode(["error" => "Invalid data."]); exit;
    }
    mysqli_query($conn, "UPDATE bookings SET status='$status' WHERE booking_id=$booking_id");
    echo json_encode(["success" => true]);
    mysqli_close($conn); exit;
}

// ── GET: Fetch bookings ──────────────────────────────────
// ?type=my_gigs&user_id=X  → bookings on services I SELL
// ?type=my_orders&user_id=X → bookings I made as BUYER
$type    = $_GET['type']    ?? 'my_orders';
$user_id = intval($_GET['user_id'] ?? 6); // default demo user

$base = "
    SELECT b.booking_id, b.booking_date, b.status,
           buyer.full_name  AS buyer_name,  buyer.user_id  AS buyer_id,
           seller.full_name AS seller_name, seller.user_id AS seller_id,
           s.service_id, s.title AS service_title, s.price,
           c.category_name,
           COALESCE(rv.rating, 0)   AS rating,
           COALESCE(rv.comment, '') AS review_comment,
           COALESCE(rv.review_id,0) AS review_id
    FROM bookings b
    JOIN services   s      ON b.service_id  = s.service_id
    JOIN categories c      ON s.category_id = c.category_id
    JOIN users      buyer  ON b.buyer_id    = buyer.user_id
    JOIN users      seller ON s.seller_id   = seller.user_id
    LEFT JOIN reviews rv   ON rv.booking_id = b.booking_id
";

if ($type === 'my_gigs') {
    // Gigs I am SELLING
    $sql = $base . " WHERE seller.user_id = $user_id ORDER BY b.booking_date DESC";
} else {
    // Gigs I ORDERED
    $sql = $base . " WHERE buyer.user_id = $user_id ORDER BY b.booking_date DESC";
}

$result = mysqli_query($conn, $sql);
$out    = [];
while ($r = mysqli_fetch_assoc($result)) $out[] = $r;
echo json_encode($out);
mysqli_close($conn);
?>
