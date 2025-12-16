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
    $query = "UPDATE counselor SET dfname= ?, duname= ?, dphone= ?, demail= ? WHERE userid= ?";
    $stmt = $conn->prepare($query);
    $result = $stmt->execute([$fullname, $username, $phone, $email, $userid]);
    if ($result === TRUE) {
         header("Location: profile.php");
        echo "Update successfully!";
    } else {
        echo "Oops! try again later";
    }
}
?>
