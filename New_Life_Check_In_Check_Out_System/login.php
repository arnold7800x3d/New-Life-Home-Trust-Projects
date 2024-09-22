<?php
session_start();
require_once("connection_x3D.php");

$username = $_POST["uname"];
$password = $_POST["pass"];

$username = mysqli_real_escape_string($conn, trim($username));
$password = mysqli_real_escape_string($conn, trim($password));

$sql = "SELECT * FROM `$dbname`.`personal_details` WHERE `Username`='$username'";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['Password'])) {
        $_SESSION['username'] = $username;

        /* Add this line to send the email to the client-side
        echo json_encode(['userEmail' => $email]);
        
        // Debugging output
        echo 'User email in session: ' . $_SESSION['userEmail'];*/

        header("Location: designation.php");
        exit();
    } else {
        echo "Invalid username or password. Try again.";
    }
} else {
    echo "You need to create an account to continue.";
}
?>
