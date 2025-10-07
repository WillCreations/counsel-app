<?php
session_start();
require '../config/config.php';


    $userid = $_SESSION['userid'];

    if(isset($_POST['update'])) {
        $pass = md5(clean($_POST['pass']));
        $cpass = md5(clean($_POST['cpass']));
        

        // Update password if new passwords match
        if($pass === $cpass) {
            formQuery("UPDATE counselor SET dpass='$pass' WHERE userid='$userid'");
            $_SESSION['error'] = "<p class='text-success'>Password changed successfully!</p>";
            unset($_SESSION['reset_userid']); 
        } else {
            $_SESSION['error'] = "<p class='text-danger'>New passwords do not match!</p>";
        }

        header("Location: new_pass.php"); 
        exit();
    
} else {
    $_SESSION['error'] = "User ID not found!";
    header("Location: change-pass.php"); 
    exit();
}
?>
