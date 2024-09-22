<?php
session_start();
require_once("connection_x3D.php");

function alert_box()
{
  echo "<script> alert('Customer Registered') </script>";
}

//the post records from the form
$fullname = $_POST["fname"];
$username = $_POST["uname"];
$designation = $_POST["designation"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$psw_1 = $_POST["pass"];
$psw_2 = $_POST["cpass"];

// security of the details entered
$hashed_passwd = password_hash($psw_2, PASSWORD_DEFAULT);
$fullname_e = mysqli_real_escape_string($conn, trim($fullname));
$username_e = mysqli_real_escape_string($conn, trim($username));
$designation_e = mysqli_real_escape_string($conn, trim($designation));
$email_e = mysqli_real_escape_string($conn, trim($email));
$phone_e= mysqli_real_escape_string($conn, trim($phone));
$psw_e = mysqli_real_escape_string($conn, trim($hashed_passwd));

if ($psw_1 == $psw_2) {
    $sql = "INSERT INTO `$dbname`.`personal_details` (`Name`,`Username`,`Designation`,`Phone`,`Email`,`Password`) VALUES ('$fullname_e','$username_e','$designation_e','$email_e','$phone_e','$psw_e')";
 
    // insert in database 
    if ($conn->query($sql) === TRUE) {
        // Store user's email in the session
        session_start(); // Start the session if not already started
        $_SESSION['username'] = $username_e;

        alert_box();
        header("Location: designation.php");
    } else {
        echo "Registration unsuccessful";
    }
} else {
    echo "Password did not match";
}
?>

/////inventory
donations to the store,
stock card.....date, particulars,in, out, balance, authorizer
store request ....who requests, who approves and who receives to substore...then to the kitchen