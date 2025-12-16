<?php
session_start();
require_once __DIR__ . '/config/config.php';
if (isset($_SESSION['loggedin'])) {
  header("location:student.php");
}

?>


<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> User</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="./bootstrap4/css/bootstrap.min.css">
    <link href="./User/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="./User/vendor/font-awesome-4.7.0/css/font-awesome.min.css">
    <link
      href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
      rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="./User/css/sb-admin-2.css" rel="stylesheet">
    <link rel="stylesheet" href="./User/css/admin.css">


  </head>
  <style>
    body {
      background-image: url(./images/bg.jpg);
      background-size: cover;
      background-repeat: no-repeat;
      padding: 0px;
      text-align: center;
      color: white;
      opacity: 0.9;
    }

    .text-center {
      animation: changeColor 3s infinite alternate;
    }

    #button {
      justify-content: center;
      align-items: center;
      display: flex;
      height: 300px;
    }

    @keyframes changeColor {
      0% {
        color: red;
      }

      100% {
        color: blue;
      }

    }

    .maxRadius {
      border-radius: 20px;
    }

    .rounded-circle-container {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      background-color: #007bff;
      color: #fff;
      text-align: center;
      line-height: 100px;
      font-size: 24px;
      font-weight: bold;
    }

    .rounded-circle {
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background-color: #007bff;
      color: #fff;
      text-align: center;
      line-height: 50px;
      font-size: 16px;
      font-weight: bold;
    }
  </style>
  </head>

  <body>

    <div class="container  text-color dark">
      <h4 class="text-center bg-dark  mb-4 p-4">Welcome To Lanre Awolokun High School Computerized Career Guidance
        Information System Gbagada</h4>

      <div class="container mt-5">
        <div class=" row justify-content-center">
          <div class="col-md-5">
            <div class="border p-4 maxRadius bg-dark ">
              <form action="./Student/login_process.php" method="post">
                <?php echo isset($_SESSION['msg']) ? $_SESSION['msg'] : ''; ?>
                <h2 class="text-center">Login as a Student</h2>
                <div class="form-group">
                  <input type="text" class="form-control" id="username" name="user"
                    placeholder="Enter username or Email">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" id="password" name="pass" placeholder="Enter password">
                </div>
                <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>

                <div class="text-center mt-3">
                  <a href="./Student/change-pass.php" class="text-danger"><i class="fa fa-exclamation-triangle"></i>
                    Forgotten Password?</a>
                </div>
              </form>
              <?php unset($_SESSION['msg']) ?>
            </div>
          </div>


          <div class="container text-center mt-5">
            <div class="rounded-circle-container mx-auto">
              OR
            </div>
          </div>

          <div class="container mt-5 row justify-content-center">

            <div class="col-md-6">
              <h4 class="text-warning  text-center"> <a href="./Student/register.php"
                  class="btn-center btn btn-warning ">Sign-Up as a Student</a></h4>
            </div>

            <div class="col-md-6">
              <h4 class="text-primary text-center "><a href="./Counselor/login.php"
                  class="btn-center btn btn-warning">Sign-In as a Counselor</a></h4>
            </div>

          </div>

          <script src="./User/vendor/jquery/jquery.js"></script>
          <!-- <script src="./bootstrap4/js/jquery.min.js"></script> -->
          <script src="./bootstrap4/js/bootstrap.bundle.min.js"></script>

          <!-- Core plugin JavaScript-->
          <script src="./User/vendor/jquery-easing/jquery.easing.min.js"></script>

          <!-- Custom scripts for all pages-->
          <script src="./User/js/sb-admin-2.min.js"></script>

  </body>

</html>