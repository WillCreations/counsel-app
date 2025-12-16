
<?php

session_start();
require '../config/config.php';

if ($_SERVER['REQUEST_METHOD']=='POST'){
 
    $user = clean($_POST['user']);
    $passInput = clean($_POST['pass']);

 var_dump($user, $passInput);

    //run sql

$stmt = $conn->prepare('SELECT id, userid, dpass, demail FROM counselor WHERE demail = ? OR duname = ? LIMIT 1');
    $stmt->execute([$user, $user]);
    $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
var_dump($userRow);

    if($userRow && password_verify($passInput, $userRow['dpass'])){

        session_regenerate_id(true);
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $userRow['demail'];
        $_SESSION['userid'] = $userRow['userid'];
        header('Location: counselor.php');
        exit;


    } else {
        $_SESSION['msg']='
        <div class="alert alert-danger alert-dismissible roll="alert"><a href="login.php" 
        class=”close” datadismiss=”alert” aria-label=”close”>&times;</a> 
        <strong>Fail!</strong><br>
        <p>Invalid login details, try again later!</p>
         </div>';
         header('location:login.php');
    }

}


