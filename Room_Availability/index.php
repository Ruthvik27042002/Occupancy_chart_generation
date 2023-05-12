<!DOCTYPE html>
<html>
<head>
    <title>Classroom Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        h1 {
            margin-top: 50px;
        }
        table {
            border-collapse: collapse;
            margin: 50px auto 0;
            width: 80%;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        a {
            text-decoration: none;
            color: #333;
        }
        a:hover {
            color: #000;
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
    <h1>Classroom Management System</h1>
    <a href="add_room.php" class="button">Add Room</a>
    <br><br>
    <table>
        <tr>
            <th>ID</th>
            <th>Room Number</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        <?php
            // Connect to MySQL database
            $conn = mysqli_connect("localhost", "root", "", "room_booking");

            // Select all rooms from the database that are available after the current date and time
            $current_datetime = date("Y-m-d H:i:s");
            $sql = "SELECT * FROM room_alloc WHERE CONCAT(date, ' ', start_time) > '$current_datetime'";
            $result = mysqli_query($conn, $sql);

            // Loop through all the rooms and display them in a table
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row["id"]."</td>";
                echo "<td>".$row["room_number"]."</td>";
                echo "<td>".$row["start_time"]."</td>";
                echo "<td>".$row["end_time"]."</td>";
                echo "<td>".$row["date"]."</td>";
                echo "<td><a href='update_room.php?id=".$row["id"]."' class='button'>Edit</a> | <a href='delete_room.php?id=".$row["id"]."' class='button'>Delete</a></td>";
                echo "</tr>";
            }

            // Close MySQL database connection
            mysqli_close($conn);
        ?>
    </table>
</body>
</html>
