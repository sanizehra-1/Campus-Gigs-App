<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
require_once "db.php";

$result = mysqli_query($conn, "SELECT * FROM categories ORDER BY category_id");
$out    = [];
while ($r = mysqli_fetch_assoc($result)) $out[] = $r;
echo json_encode($out);
mysqli_close($conn);
?>
