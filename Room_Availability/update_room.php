<!DOCTYPE html>
<html>
<head>
    <title>Update Room - Classroom Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        h1 {
            margin-top: 50px;
        }
        form {
            margin: 50px auto;
            width: 50%;
        }
        label {
            display: block;
            margin-top: 20px;
        }
        input[type="text"], input[type="time"], input[type="date"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }
        .button {
            display: inline-block;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #0069d9;
        }
    </style>
</head>
<body>
    <h1>Update Room</h1>
    <?php
        // Connect to MySQL database
        $conn = mysqli_connect("localhost", "root", "", "room_booking");

        // Check if form was submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get form data
            $id = $_POST["id"];
            $room_number = $_POST["room_number"];
            $start_time = $_POST["start_time"];
            $end_time = $_POST["end_time"];
            $date = $_POST["date"];

            // Update room in database
            $sql = "UPDATE room_alloc SET room_number='$room_number', start_time='$start_time', end_time='$end_time', date='$date' WHERE id='$id'";
            if (mysqli_query($conn, $sql)) {
                echo "<p>Room updated successfully.</p>";
            } else {
                echo "<p>Error updating room: " . mysqli_error($conn) . "</p>";
            }
        } else {
            // Get room ID from query string parameter
            $id = $_GET["id"];

            // Select room from database
            $sql = "SELECT * FROM room_alloc WHERE id='$id'";
            $result = mysqli_query($conn, $sql);

            // Display room data in form
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                echo "<form method='post'>";
                echo "<input type='hidden' name='id' value='".$row["id"]."'>";
                echo "<label>Room Number:</label>";
                echo "<input type='text' name='room_number' value='".$row["room_number"]."'>";
                echo "<label>Start Time:</label>";
                echo "<input type='time' name='start_time' value='".$row["start_time"]."'>";
                echo "<label>End Time:</label>";
                echo "<input type='time' name='end_time' value='".$row["end_time"]."'>";
                echo "<label>Date:</label>";
                echo "<input type='date' name='date' value='".$row["date"]."'>";
                echo "<button type='submit' class='button'>Update</button>";
                echo "</form>";
            } else {
                echo "<p>Room not found.</p>";
            }
        }

        // Close MySQL database connection
        mysqli_close($conn);
    ?>
</body>
</html>
