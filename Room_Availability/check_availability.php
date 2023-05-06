<?php
// Connect to database
$conn = mysqli_connect("localhost", "root", "", "room_booking");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve form data
$room = $_POST["room"];
$startTime = $_POST["startTime"];
$endTime = $_POST["endTime"];

// Check if room is available on selected date
$sql = "SELECT COUNT(*) as count FROM room_alloc WHERE room_number='$room' OR start_time='$startTime' OR end_time='$endTime'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$count = $row["count"];

// Close database connection
mysqli_close($conn);

// Return response
if ($count == 0) {
    echo "available";
} else {
    echo "unavailable";
}
?>
