<?php
session_start();
require '../config/config.php';

if (!isset($_SESSION['userid'])) {
    exit('Unauthorized access');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userid = $_SESSION['userid'];
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Validate inputs
    if (empty($fullname) || empty($username) || empty($phone) || empty($email)) {
        exit('All fields are required.');
    }

    // Update the database
    $sql = "UPDATE counselor SET dfname='$fullname', duname='$username', dphone='$phone', demail='$email' WHERE userid='$userid'";
    
    if ($conn->query($sql) === TRUE) {
        // header("Location: profile.php");
        echo "Update successfully!";
    } else {
        echo "Oops! try again later";
    }
}
?>
