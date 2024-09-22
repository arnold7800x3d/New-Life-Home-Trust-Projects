<?php
session_start();
require_once("connection_x3D.php");

date_default_timezone_set("Africa/Nairobi");
error_reporting(E_ALL);
ini_set('display_errors', 1);

function alert_box_one()
{
  echo "<script> alert('You have successfully checked in!!') </script>";
}

function alert_box_two()
{
  echo "<script> alert('You have successfully checked out!!') </script>";
}

if (isset($_POST['checkin'])) {
    // Check-in logic
    $sql = "INSERT INTO `$dbname`.`checkin_checkout` (`Day`, `Date`, `Username`, `TimeIn`) 
            VALUES (?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $day, $date, $username, $timeIn);

    $day = date("l"); // Full day name (e.g., Monday, Tuesday)
    $date = date("Y-m-d");
    $username = $_SESSION["username"];
    $timeIn = date("H:i:s");

    if ($stmt->execute()) {
        alert_box_one();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    
    // ... rest of the code for preparing and executing the statement
} elseif (isset($_POST['checkout'])) {
    // Checkout logic
    $sql = "UPDATE `$dbname`.`checkin_checkout` 
            SET `TimeOut` = ? 
            WHERE `Username` = ? AND `Date` = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $timeOut, $username, $date);

    $timeOut = date("H:i:s"); // Use 24-hour format without AM/PM
    $username = $_SESSION["username"];
    $date = date("Y-m-d");

    if ($stmt->execute()) {
        alert_box_two();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

?>
