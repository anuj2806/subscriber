<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MySQL Data Interaction</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>MySQL Data Interaction</h1>
    <form id="dataForm" class="data-form" method="post">
        <input type="text" id="dataInput" name="data" class="data-input" placeholder="Enter data">
        <button type="button" onclick="addData()" class="data-button">Add Data</button>
    </form>
    <div id="result" class="result"> </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST["data"])) {
            $data = $_POST["data"];
            // Rest of your processing code
             // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "anuj";

            $conn = mysqli_connect($servername, $username, $password, $database);
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            mysqli_set_charset($conn, 'utf8mb4');
            // Insert data into the database
            // $sql = "INSERT INTO email (email_id) VALUES ('$data')";
            // if (mysqli_query($conn, $sql)) {
            //     echo "Data added successfully!";
            // } else {
            //     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            // }

            // Check if email exists in the database
            $query = "SELECT * FROM email WHERE email_id = '$data'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                $message = "You are already subscribed!";
            } else {
                // Insert email into the database
                $insertQuery = "INSERT INTO email (email_id) VALUES ('$data')";
                if (mysqli_query($conn, $insertQuery)) {
                    $message = "Thank you for subscribing!";
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            }

            mysqli_close($conn);
            echo json_encode(array("message" => $message));
            }
        }
        
    ?>
   
    <script src="script.js"></script>
</body>
</html>