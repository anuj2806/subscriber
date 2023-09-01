<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$database = "anuj";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];

    $query = "SELECT * FROM subscribers WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $message = "You are already subscribed!";
    } else {
        // Insert email into the database
        $insertQuery = "INSERT INTO subscribers (email) VALUES ('$email')";
        if (mysqli_query($conn, $insertQuery)) {
            $message = "Thank you for subscribing!";
        } else {
            $message = "Error: " . mysqli_error($conn);
        }
    }

    $response = array("message" => $message);
    echo json_encode($response);
}

mysqli_close($conn);
?>
