<?php
// ============================================================
// Campus Gigs — Database Connection
// ============================================================
$host     = "localhost";
$user     = "root";
$password = "";            // blank for XAMPP default
$database = "campus_gigs";

$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die(json_encode(["error" => "Connection failed: " . mysqli_connect_error()]));
}
mysqli_set_charset($conn, "utf8");
?>
