<?php
// Connect to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "queries";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from form submission
$name = $_POST["name"];
$email = $_POST["email"];
$issue = $_POST["issue"];

// Insert data into database
$sql = "INSERT INTO queries (name, email, issue) VALUES ('$name', '$email', '$issue')";

if ($conn->query($sql) === TRUE) {
    echo "Query submitted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
