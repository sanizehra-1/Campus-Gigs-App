<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");
require_once "db.php";

// POST: Add a new gig
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $raw  = file_get_contents("php://input");
    $data = json_decode($raw, true);

    if (!$data) {
        echo json_encode(["error" => "Invalid JSON received."]);
        exit;
    }

    $category_id = intval($data['category_id'] ?? 0);
    $title       = trim($data['title']       ?? '');
    $description = trim($data['description'] ?? '');
    $price       = floatval($data['price']   ?? 0);
    $image_url   = trim($data['image_url']   ?? '');
    $seller_name = trim($data['seller_name'] ?? '');

    // Escape after trimming
    $title       = mysqli_real_escape_string($conn, $title);
    $description = mysqli_real_escape_string($conn, $description);
    $image_url   = mysqli_real_escape_string($conn, $image_url);
    $seller_name = mysqli_real_escape_string($conn, $seller_name);

    // Validate
    if ($title === '' || $seller_name === '' || $price <= 0) {
        echo json_encode([
            "error"   => "Missing required fields.",
            "received"=> ["category_id"=>$category_id,"title"=>$title,"price"=>$price,"seller_name"=>$seller_name]
        ]);
        exit;
    }

    // If no category selected, default to 1
    if ($category_id === 0) $category_id = 1;

    // Look up or create seller
    $nameRes = mysqli_query($conn, "SELECT user_id FROM users WHERE full_name='$seller_name' LIMIT 1");
    if (mysqli_num_rows($nameRes) > 0) {
        $row       = mysqli_fetch_assoc($nameRes);
        $seller_id = $row['user_id'];
    } else {
        $email = strtolower(str_replace(' ', '.', $seller_name)) . rand(10,99) . '@iobm.edu.pk';
        mysqli_query($conn, "INSERT INTO users (full_name, email, user_type) VALUES ('$seller_name', '$email', 'Freelancer')");
        $seller_id = mysqli_insert_id($conn);
    }

    // Insert with image_url, fallback without
    $sql = "INSERT INTO services (seller_id, category_id, title, description, price, image_url)
            VALUES ($seller_id, $category_id, '$title', '$description', $price, '$image_url')";
    if (!mysqli_query($conn, $sql)) {
        $sql = "INSERT INTO services (seller_id, category_id, title, description, price)
                VALUES ($seller_id, $category_id, '$title', '$description', $price)";
        mysqli_query($conn, $sql);
    }

    echo json_encode(["success" => true, "service_id" => mysqli_insert_id($conn)]);
    mysqli_close($conn);
    exit;
}

// GET: Fetch services
$category  = isset($_GET['category'])  ? mysqli_real_escape_string($conn, $_GET['category'])  : '';
$search    = isset($_GET['search'])    ? mysqli_real_escape_string($conn, $_GET['search'])    : '';
$seller_id = isset($_GET['seller_id']) ? intval($_GET['seller_id']) : 0;

$sql = "
    SELECT s.service_id, s.title, s.description, s.price,
           COALESCE(s.image_url,'') AS image_url,
           u.user_id AS seller_id, u.full_name AS seller_name,
           c.category_id, c.category_name,
           COALESCE(ROUND(AVG(r.rating),1),0) AS avg_rating,
           COUNT(DISTINCT r.review_id)         AS review_count,
           COUNT(DISTINCT b.booking_id)        AS booking_count
    FROM services s
    JOIN users u      ON s.seller_id   = u.user_id
    JOIN categories c ON s.category_id = c.category_id
    LEFT JOIN bookings b ON b.service_id = s.service_id
    LEFT JOIN reviews  r ON r.booking_id = b.booking_id
    WHERE 1=1
";
if ($category)  $sql .= " AND c.category_name = '$category'";
if ($search)    $sql .= " AND (s.title LIKE '%$search%' OR s.description LIKE '%$search%')";
if ($seller_id) $sql .= " AND s.seller_id = $seller_id";
$sql .= " GROUP BY s.service_id ORDER BY s.service_id DESC";

$result = mysqli_query($conn, $sql);
$out    = [];
while ($r = mysqli_fetch_assoc($result)) $out[] = $r;
echo json_encode($out);
mysqli_close($conn);
?>
