<!-- header.php -->

<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $username = $_SESSION["username"]; // Assuming the username is stored in the session
    echo "<div style='background-color: #f2f2f2; padding: 10px;'>
            <div style='display: flex; justify-content: space-between; align-items: center;'>
                <div style='font-size: 24px; font-weight: bold;'>Your Website Logo</div>
                <div style='font-size: 16px;'>Hello, $username</div>
                <div><a href='logout.php' style='text-decoration: none; color: #333;'>Logout</a></div>
            </div>
          </div>";
} else {
    // Display a login link
    echo "<div style='background-color: #f2f2f2; padding: 10px;'>
            <div style='display: flex; justify-content: space-between; align-items: center;'>
                <div style='font-size: 24px; font-weight: bold;'>Your Website Logo</div>
                <div><a href='login.php' style='text-decoration: none; color: #333;'>Login</a></div>
            </div>
          </div>";
}
?>
