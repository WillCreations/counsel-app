<?php
session_start();
require '../config/config.php'; // Ensure this includes the database connection

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

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE student SET dfname = ?, duname = ?, dphone = ?, demail = ? WHERE userid = ?");
    $stmt->bind_param("ssssi", $fullname, $username, $phone, $email, $userid);

    if ($stmt->execute()) {
        echo "Update successful!";
    } else {
        echo "Oops! Please try again later.";
    }

    $stmt->close();
    $conn->close();
}
?>
