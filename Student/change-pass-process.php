<?php
session_start();
require '../config/config.php';


    if($_SERVER['REQUEST_METHOD']=='POST') {
        if(!empty($_POST['email'])) {
            $email = clean($_POST['email']);

            
            $sql = formQuery("SELECT userid FROM counselor WHERE demail='$email'"); 
            if($sql->num_rows>0){
            $row = $sql->fetch_assoc();
            $_SESSION['userid']= $row['userid'];
            header("Location: new_pass.php"); 
                exit();
            } else {
                $_SESSION['error'] = "Email not found!";
                header("Location: change-pass.php");
            }
        } else {
            $_SESSION['error'] = "Please enter your email!";
            header("Location: change-pass.php");
        }
    
} else {
    $_SESSION['error'] = "You are not logged in!";
    header("Location: login.php"); 
    exit();
}
?>
