<?php
    // Connect to database
    $conn = mysqli_connect("localhost", "root", "", "room_booking");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve room allocation data
    $sql = "SELECT room_number FROM room_alloc";
    $result = mysqli_query($conn, $sql);
    $rooms = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($rooms, $row);
    }

    // Close database connection
    mysqli_close($conn);

    // Send room allocation data as JSON
    echo json_encode($rooms);
?>
