<?php
require_once '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $error = false;

    if (empty($_POST['funame'])) {
        $errFname = "Fullname is required!";
        $error = true;
    } else {
        $fullname = clean($_POST['funame']);
    }

    if (empty($_POST['username'])) {
        $errUsername = "Username is required!";
        $error = true;
    } else {
        $username = strtolower(str_replace(' ', '', clean($_POST['username'])));
    }

    if (empty($_POST['phone'])) {
        $errPhone = "Phone number is required!";
        $error = true;
    } elseif (!is_numeric($_POST['phone'])) {
        $errPhone = "Enter valid Phone number!";
        $error = true;
    } else {
        $phone = clean($_POST['phone']);
    }

    if (empty($_POST['email'])) {
        $errEmail = "Email is required!";
        $error = true;
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errEmail = "Enter valid email address!";
        $error = true;
    } else {
        $email = clean($_POST['email']);
        $sql = formQuery("SELECT demail FROM counselor WHERE demail='$email'");
        if ($sql->num_rows > 0) {
            $error = true;
            $errEmail = "Email already taken!";
        }
    }

    if (empty($_POST['address'])) {
        $errAddress = "Address is required!";
        $error = true;
    } else {
        $address = clean($_POST['address']);
    }

    if (empty($_POST['pass'])) {
        $errPass = "Password is required!";
        $error = true;
    } elseif (strlen($_POST['pass']) < 3) {
        $errPass = "Password is too short!";
        $error = true;
    } elseif (strlen($_POST['pass']) > 20) {
        $errPass = "Password is too long!";
        $error = true;
    } else {
        $pass = clean($_POST['pass']);
    }

    if (empty($_POST['cpass'])) {
        $errCpass = "Confirm password is required!";
        $error = true;
    } else {
        $cpass = clean($_POST['cpass']);
        if (empty($errPass) && ($pass != $cpass)) {
            $errCpass = "Password doesn't match!";
            $error = true;
        }
    }

    // Profile picture validation
    if (!isset($_FILES['profilePic']) || $_FILES['profilePic']['error'] == UPLOAD_ERR_NO_FILE) {
        $errProfilePic = "Profile picture is required!";
        $error = true;
    } else {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES['profilePic']['type'], $allowedTypes)) {
            $errProfilePic = "Only JPG, PNG, and GIF files are allowed!";
            $error = true;
        } else {
            $profilePic = $_FILES['profilePic'];
            $profilePicPath = '../uploads/' . basename($profilePic['name']);
            if (!move_uploaded_file($profilePic['tmp_name'], $profilePicPath)) {
                $errProfilePic = "Failed to upload profile picture!";
                $error = true;
            }
        }
    }

    if ($error == false) {
        $pass = md5($pass);
        $userid = date("Ymdhis");

        $sql = formQuery("INSERT INTO counselor SET userid='$userid', dfname='$fullname', 
        duname='$username', demail='$email', dpass='$pass', dphone='$phone', daddress='$address', dphoto='$profilePicPath'");
        header("Location: counselor.php");
        if ($sql) {
            echo "Successful!";
        }
    }
}
?>
