<?php
// Connect to database
$conn = mysqli_connect("localhost", "root", "", "room_booking");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve form data
$room = $_POST["room"];
$date = $_POST["date"];
$newDate = date("Y-m-d", strtotime($date));
$startTime = $_POST["start_time"];
$endTime = $_POST["end_time"];

// Check if room is available on selected date and time
$sql = "SELECT COUNT(*) as count FROM room_alloc WHERE room_number='$room' AND date='$newDate' AND ((start_time<='$startTime' AND end_time>='$startTime') OR (start_time>='$startTime' AND start_time<='$endTime'))";
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
