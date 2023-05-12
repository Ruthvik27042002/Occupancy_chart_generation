<?php
    // Connect to MySQL database
    $conn = mysqli_connect("localhost", "root", "", "room_booking");

    // Check if the ID parameter is set
    if (isset($_GET["id"])) {
        $id = $_GET["id"];

        // Check if the user has confirmed the deletion
        if (isset($_GET["confirm"]) && $_GET["confirm"] == "yes") {
            // Delete the room with the specified ID from the database
            $sql = "DELETE FROM room_alloc WHERE id=$id";
            mysqli_query($conn, $sql);
            // Reset the auto-increment value for the ID column
            $sql = "SET @count = 0;";
            mysqli_query($conn, $sql);
            $sql = "UPDATE room_alloc SET id = @count:= @count + 1;";
            mysqli_query($conn, $sql);
            $sql = "ALTER TABLE room_alloc AUTO_INCREMENT = 1";
            mysqli_query($conn, $sql);


            // Close MySQL database connection
            mysqli_close($conn);

            // Display a pop-up message to indicate that the room has been deleted
            echo "<script>alert('Room has been deleted.')</script>";

            // Redirect the user to the homepage
            header("Location: index.php");
        } else {
            // Display a confirmation message to the user
            echo "<script>var result = confirm('Are you sure you want to delete this room?'); if (result) { window.location.href = 'delete_room.php?id=$id&confirm=yes'; }</script>";
        }
    }
?>
