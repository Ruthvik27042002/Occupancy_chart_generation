<html>
<head>
    <title>Classroom Management System - Add Room</title>
	<style>
		body {
			background-color: #f2f2f2;
			font-family: Arial, sans-serif;
		}
		h1 {
			text-align: center;
			margin-top: 50px;
		}
		form {
			background-color: #fff;
			padding: 20px;
			border-radius: 10px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
			max-width: 500px;
			margin: 50px auto;
		}
		label {
			display: block;
			margin-bottom: 10px;
			font-weight: bold;
		}
		input[type=text], textarea {
			width: 100%;
			padding: 10px;
			border-radius: 5px;
			border: none;
			margin-bottom: 20px;
			box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.1);
		}
		input[type=submit] {
			background-color: #4CAF50;
			color: white;
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
		}
		input[type=submit]:hover {
			background-color: #3e8e41;
		}

        input[type=time], input[type=date] {
            box-sizing: border-box;
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 2px solid #ccc;
            border-radius: 4px;
            background-color: #f8f8f8;
            font-size: 16px;
        }

	</style>
</head>
<body>
    <h1>Add Room</h1>
    <form action="add_room.php" method="post">
        <label for="room_number">Room Number:</label>
        <input type="text" name="room_number" id="room_number" required>
        <br><br>
        <label for="start_time">Start Time:</label>
        <input type="time" name="start_time" id="start_time" required>
        <br><br>
        <label for="end_time">End Time:</label>
        <input type="time" name="end_time" id="end_time" required>
        <br><br>
        <label for="date">Date:</label>
        <input type="date" name="date" id="date" required>
        <br><br>
        <input type="submit" value="Add Room">
    </form>
</body>
</html> 
<?php
// Connect to MySQL database
$conn = mysqli_connect("localhost", "root", "", "room_booking");

// Define variables and initialize with empty values
$room_number = $start_time = $end_time = $date = "";
$room_number_err = $start_time_err = $end_time_err = $date_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate room number
    if(empty(trim($_POST["room_number"]))){
        $room_number_err = "Please enter a room number.";
    } else{
        // Check if room number already exists
        $sql = "SELECT id FROM room_alloc WHERE room_number = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $param_room_number);
        $param_room_number = trim($_POST["room_number"]);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1){
            $room_number_err = "This room number is already taken.";
            echo "<script>alert('Room 1.')</script>";
        } else{
            $room_number = trim($_POST["room_number"]);
        }
        mysqli_stmt_close($stmt);
    }

    // Validate start time
    if(empty(trim($_POST["start_time"]))){
        $start_time_err = "Please enter a start time."; 
        echo "<script>alert('Room 2.')</script>";    
    } else{
        $start_time = trim($_POST["start_time"]);
    }

    // Validate end time
    if(empty(trim($_POST["end_time"]))){
        $end_time_err = "Please enter an end time."; 
        echo "<script>alert('Room 3.')</script>";    
    } else{
        $end_time = trim($_POST["end_time"]);
    }

    // Validate date
    if(empty(trim($_POST["date"]))){
        $date_err = "Please enter a date."; 
        echo "<script>alert('Room 4.')</script>";    
    } else{
        $date = trim($_POST["date"]);
    }

    // Check if start time is before end time
    if(!empty($start_time) && !empty($end_time)){
        if(strtotime($start_time) >= strtotime($end_time)){
            $start_time_err = "Start time must be before end time.";
            echo "<script>alert('Room 5.')</script>";
        }
    }

    // Check if date is in the future
    if(!empty($date)){
        if(strtotime($date) < time()){
            $date_err = "Date must be in the future.";
        }
    }
    // Check input errors before inserting in database
    if(empty($room_number_err) && empty($start_time_err) && empty($end_time_err) && empty($date_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO room_alloc (room_number, start_time, end_time, date) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $param_room_number, $param_start_time, $param_end_time, $param_date);
        $param_room_number = $room_number;
        $param_start_time = $start_time;
        $param_end_time = $end_time;
        $param_date = $date;
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        if(mysqli_stmt_execute($stmt)){
            // Display success message in popup
            echo "<script>alert('Room updated successfully.')</script>";
            // Redirect to login page
            header("location: index.php");
        } else{
            // Display error message in popup
            echo "<script>alert('Oops! Something went wrong. Please try again later.')</script>";
        }
        exit();
    }
    else{
            echo "<script>alert('Please enter a valid room number.')</script>";
        }

    // Close connection
    mysqli_close($conn);
}
?>
