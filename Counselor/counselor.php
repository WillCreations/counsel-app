
    <?php 
        session_start();
        
        if (!isset($_SESSION['userid'])){
            header("Location:login.php");
        }
        
        require_once '../config/config.php';
        
        if(isset($_POST['submit'])){
            require 'admin_process.php'; 
        }
        
    ?>

    <?php
     include('./inc/header.php'); 
     include('./inc/navbar.php');

        
    ?>
        

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

            <?php
                include('./inc/topbar.php');
               

            ?>
             
                <!-- Begin Page Content -->
                <div class="container-fluid">

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModal">New Counselor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <form action="counselor_process.php" method="POST"enctype="multipart/form-data">

        <div class="profile-pic">
            <img src="placeholder.jpg" id="profileImage" alt="Profile Picture">
            <label for="profilePicInput" class="camera-icon">
                <i class="fa fa-camera"></i>
            </label>
            <input type="file" name="profilePic" id="profilePicInput" accept="image/*" onchange="loadFile(event)">
        </div>
            

          <div class="form-group">
            <label for="name">FullName:</label>
            <input type="text" name="funame" class="form-control" id="name">
            <span class="text-danger"> <?php echo isset($errFname) ? $errFname:null; ?> </span>
          </div>

          <div class="form-group">
            <label for="name">Username:</label>
            <input type="text" name="username" class="form-control" id="username">
            <span class="text-danger"> <?php echo isset($errUsername) ? $errUsername:null; ?> </span>
          </div>

          <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" name="email" class="form-control" id="email">
            <span class="text-danger"> <?php echo isset($errEmail) ? $errEmail:null; ?> </span>
          </div>
          
          <div class="form-group">
            <label for="username">Phone:</label>
            <input type="number" name="phone" class="form-control" id="phone">
            <span class="text-danger"> <?php echo isset($errPhone) ? $errPhone:null; ?> </span>
          </div>
          
          <div class="form-group">
            <label for="username">Address:</label>
            <input type="text" name="address" class="form-control" id="address">
            <span class="text-danger"> <?php echo isset($errAddress) ? $errAddress:null; ?> </span>
          </div>

          <div class="form-group">
            <label for="username">Password:</label>
            <input type="password" name="pass" class="form-control" id="username">
            <span class="text-danger"> <?php echo isset($errPass) ? $errPass:null; ?> </span>
          </div>


          <div class="form-group">
            <label for="username">Confirm Password:</label>
            <input type="password" name="cpass" class="form-control" id="username">
            <span class="text-danger"> <?php echo isset($errCpass) ? $errCpass:null; ?> </span>
          </div>
          
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="submit" class="btn btn-primary">Save</button>
        </div>
    </form>

    </div>
  </div>
</div>


        <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  New counselor
</button>

<!-- Modal -->


</div>

    <!-- Content Row -->
<div class="row">

    <!-- Number of Students -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Students</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">1000</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-graduation-cap fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Number of Counselors -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Counselors</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">50</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-user-tie fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Number of Staffs -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Staffs</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">3000</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-group fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Change Password -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Change Password</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Update</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-key fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Profile</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">View/Edit</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Counseling Activities -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                            Counseling Activities</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Ongoing</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


                    <!-- Content Row -->

                    
                               

                    <!-- Content Row -->
                   
            
                    </div>

             </div>
            
<script>
    
    function loadFile(event) {
        const output = document.getElementById('profileImage');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    }

</script>
   

    <?php 
        include('./inc/script.php'); 
        include('./inc/footer.php'); 
          
    ?>