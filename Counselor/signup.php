
<?php
    session_start();
    require_once '../config/config.php';

    if(isset($_POST['submit'])){
        require 'register_process.php'; 
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
    <title> Student</title>
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="../bootstrap4/css/bootstrap.css">
    <link rel="stylesheet" href="../bootstrap4/css/bootstrap.min.css">
    <link href="./vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="./vendor/font-awesome-4.7.0/css/font-awesome.min.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="./css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/admin.css">


</head>
<style>

        .an{
            list-style: none;
            color:blue;
        }
        .and{
            color:white;
            /* background-color: red; */
        }

         
       #body{
            /* background-color: goldenrod; */
            background-image: url(../photos/background2.jpg); 
            background-repeat: no-repeat; 
		    background-attachment: fixed;
            /* opacity: 0.9; */
            background-size: cover;
      } 

      .content{
          padding: 5px;
          margin: 5px;
          height: auto;
          width: 800px;
          float:left;
          position: relative;
           left: 20%;

      }
     
        span{
            color:red;
        }


            .profile-pic {
                position: relative;
                width: 100px;
                height: 100px;
                border-radius: 50%;
                overflow: hidden;
                background-color: #f8f9fa;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 10px;
            }
            .profile-pic img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
            .profile-pic .camera-icon {
                position: absolute;
                bottom: 0;
                right: 0;
                background-color: #007bff;
                color: white;
                border-radius: 50%;
                padding: 10px;
                cursor: pointer;
            }
            .profile-pic input[type="file"] {
                display: none;
            }
    
    </style>

</head>
<body id="body">



<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>

<!-- Topbar Search -->
<form
    class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    <div class="input-group">
        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
            aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-primary" type="button">
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
    </div>
</form>

<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
    <li class="nav-item dropdown no-arrow d-sm-none">
        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
            aria-labelledby="searchDropdown">
            <form class="form-inline mr-auto w-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small"
                        placeholder="Search for..." aria-label="Search"
                        aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </li>

    <!-- Nav Item - Alerts -->
    <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link " href="../index.php">Home</a>
    </li>
    <li class="nav-item no-arrow mx-1">
        <a class="nav-link" href="#">About</a>
    </li>
     <li class="nav-item no-arrow mx-1">
        <a class="nav-link" href="register.php">Register</a>
     </li>

   

</ul>

</nav>
<!-- End of Topbar -->

  





<div class="container mt-5" style="width: 600px;">

    <form action="signup_process.php" method="post" class="mt-5" enctype="multipart/form-data">
        <div class="profile-pic">
            <img src="placeholder.jpg" id="profileImage" alt="Profile Picture">
            <label for="profilePicInput" class="camera-icon">
                <i class="fa fa-camera"></i>
            </label>
            <input type="file" name="profilePic" id="profilePicInput" accept="image/*" onchange="loadFile(event)">
        </div>

        <div class="form-group">
            <input type="text" name="fname" placeholder="Fullname" class="form-control">
            <span class="text-danger"><?php echo isset($errFname) ? $errFname : null; ?></span>
        </div>

        <div class="form-group">
            <input type="text" name="username" placeholder="Username" class="form-control">
            <span class="text-danger"><?php echo isset($errUsername) ? $errUsername : null; ?></span>
        </div>

        <div class="form-group">
            <input type="tel" name="phone" placeholder="Phone No" class="form-control">
            <span class="text-danger"><?php echo isset($errPhone) ? $errPhone : null; ?></span>
        </div>

        <div class="form-group">
            <input type="email" name="email" placeholder="Email" class="form-control">
            <span class="text-danger"><?php echo isset($errEmail) ? $errEmail : null; ?></span>
        </div>
      

        <div class="form-group">
            <textarea name="address" cols="30" placeholder="Address" class="form-control"></textarea>
            <span class="text-danger"><?php echo isset($errAddress) ? $errAddress : null; ?></span>
        </div>

        <div class="form-group">
            <input type="password" name="pass" placeholder="Password" class="form-control">
            <span class="text-danger"><?php echo isset($errPass) ? $errPass : null; ?></span>
        </div>

        <div class="form-group">
            <input type="password" name="cpass" placeholder="Confirm Password" class="form-control">
            <span class="text-danger"><?php echo isset($errCpass) ? $errCpass : null; ?></span>
        </div>

       

        <button type="submit" name="signup" class="btn btn-primary btn-block">Sign Up</button>

        <div class="form-group m-b-0">
            <div class="col-sm-12 text-center text-dark">
                Already have an account? <a href="login.php" class="text-dark m-l-5"><b>Sign In</b></a>
            </div>
        </div>
    </form>

</div>

<script src="./User/vendor/jquery/jquery.js"></script>
<script src="./bootstrap4/js/bootstrap.bundle.min.js"></script>
<script src="./User/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="./User/js/sb-admin-2.min.js"></script>

<script>
    function loadFile(event) {
        const output = document.getElementById('profileImage');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    }
</script>


</body>
</html>