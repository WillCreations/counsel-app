
<?php 

session_start();
if(isset($_SESSION['loggedin'])){
    header("location:counselor.php");
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
    <link rel="stylesheet" href="./styles.css">
</head>
<body>

    
    <div class="backdrop">
        <div class="">
            <div class="col-lg-6">
                <div  class="card bg-dark loginBox " style=" width: 400px">
                    <div class="card-title  text-white mt-5">
            <h2 class="text-center text-white">Log In</h2>
            <form action="login_process.php" method="post" >
                <?php echo isset($_SESSION['msg']) ? $_SESSION['msg']: '';?>  

            <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
                </div>
                <input type="text" name="user" class="form-control" placeholder="Username OR Email">
            </div>
            </div>
            
            <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                </div>
                <input type="password" name="pass" class="form-control" placeholder="Password">
            </div>
            </div>

                <button type="submit" name="login" class="btn btn-primary btn-block">Submit</button>
                
                <div class="text-center mt-3">
                    <a href="change-pass.php" class="text-danger"><i class="fa fa-exclamation-triangle"></i> Forgotten Password?</a>
                </div>
                
            </form>
            <?php unset($_SESSION['msg']) ?>

            <div class="text-center mt-3">
                <a href="../index.php" class="text-info"><i class="fa fa-home"></i> Back to Home</a>
            </div>

        </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>