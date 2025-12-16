<?php
session_start();
require '../config/config.php';
    if($_SERVER['REQUEST_METHOD']=='POST') {
        if(!empty($_POST['email'])) {
            $email = clean($_POST['email']);

              $query = "SELECT * FROM counselor WHERE demail=? LIMIT 1";
                $stmt = $conn->prepare($query);
                $stmt->execute([$email]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
               
            if($row){
         
                $_SESSION['userid'] = $row['userid'];
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
