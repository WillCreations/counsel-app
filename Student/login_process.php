
<?php

session_start();
require '../config/config.php';

if ($_SERVER['REQUEST_METHOD']=='POST'){
 
    $user = clean($_POST['user']);
    $pass = md5(clean($_POST['pass']));

    //run sql
    $sql = formQuery("SELECT * FROM student WHERE (demail='$user' OR duname='$user') AND dpass='$pass' "); 

    if($sql->num_rows>0){

        $row = $sql->fetch_assoc();
        $_SESSION['loggedin']=true;
        $_SESSION['email']= $row['demail'];
        $_SESSION['userid']= $row['userid'];
        header("Location:student.php");



    }else{
        $_SESSION['msg']='
        <div class="alert alert-danger alert-dismissible roll="alert"><a href="./index.php" 
        class=”close” datadismiss=”alert” aria-label=”close”>&times;</a> 
        <strong>Fail!</strong><br>
        <p>Invalid login details, try again later!</p>
         </div>';
         header('location:../index.php');
    }

}


