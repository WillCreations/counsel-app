<?php
session_start();
require_once '../config/config.php';
        
// if (!isset($_SESSION['userid'])){
//     header("Location:login.php");
// }

if(isset($_POST['change'])){
    require 'change-pass-process.php'; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../Admin/vendor/font-awesome-4.7.0/css/font-awesome.min.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/admin.css">
    <link rel="stylesheet" href="./css/sweetalert.css">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card bg-dark" style="margin-top: 200px;">
                <div class="card-title bg-light text-white mt-5">
                    <h2 class="text-center text-dark">Change Password</h2>
                    <?php if(isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger"><?php echo $_SESSION['error']; ?></div>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>
                    <form action="change-pass-process.php" method="post">
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Email" class="form-control">
                        </div>
                        
                        <button type="submit" name="change" class="btn btn-primary btn-block">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
