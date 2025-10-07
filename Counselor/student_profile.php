
<?php
session_start();
    require_once '../config/config.php';

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

        <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Student Information</h1>
     

</div>

    <!-- Content Row -->
 <div class="row">

<!-- Users -->
<div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs  font-weight-bold text-primary text-uppercase mb-1">
                         Users</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">1000</div>
                        </div>
                    <div class="col-auto">
                            <i class="fa fa-user fa-2x text-gray-300"></i>
                        </div>
            </div>
                    </div>
        </div>
</div>

 
<!-- Available rooms -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Available Rooms</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">2000</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-home fa-2x text-gray-300"></i>
                    </div>
            </div>
        </div>
    </div>
</div>
                        
                        <!-- Booked Rooms -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Booked Rooms</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">1200</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-home fa-2x text-gray-300"></i>
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
                    </div>

                    <!-- Content Row -->

        <div class="container">
        <div class="row">
            <div class="col">
                <!-- <h1 class="text-center mt-5 mb-4">User Data Table</h1> -->
                <div class="table-responsive center-table">
                    <table class="table table-bordered table-striped table-light">
                        <thead class="thead-dark center-thead">
                            <tr>
                                <th>S/N</th>
                                <th>Image</th>
                                <th>Full Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Gender</th>
                                <th></th>
                            </tr>
                        </thead>
        <?php
            $sql = formQuery("SELECT * FROM student ORDER BY id DESC");
            if($sql->num_rows>0){ $num = 1;
            while($row=$sql->fetch_assoc()){
               
               
        ?>
                        <tbody>
                            <tr>
                                <td><?php echo $num++ ?></td>
                                <td>
                                <img src="../stu_uploads/<?php echo $row['dphoto']; ?>" width="50" height="50" alt="">
                                </td>
                                <td><?php echo ucfirst($row['dfname']) ?></td>
                                <td><?php echo ucfirst($row['duname']) ?></td>
                                <td><?php echo ($row['demail']) ?></td>
                                <td><?php echo ($row['dphone']) ?></td>
                                <td><?php echo ($row['daddress']) ?></td>
                                <td><?php echo ($row['dgender']) ?></td>
                                <td>
                                    
                                <button class="btn btn-danger btn-sm deleteBtn" data-id="<?php echo $row['userid'] ?>" data-type="user">Delete</button>
                                
                                </td>
                            </tr>
                           
                        </tbody>
                        <?php } } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

                <!-- Alert for Delete Confirmation -->
<div class="alert alert-success alert-dismissible fade show" role="alert" id="deleteSuccessAlert" style="display: none;">
  User deleted successfully!
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<!-- Alert for Delete Error -->
<div class="alert alert-danger alert-dismissible fade show" role="alert" id="deleteErrorAlert" style="display: none;">
  Error deleting user. Please try again later.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
                               

                    <!-- Content Row -->
                   
            
                    </div>

             </div>
            

   

    <?php 
        include('./inc/script.php'); 
        include('./inc/footer.php');    
    ?>
  <script>
        $(document).ready(function(){
            $(".deleteBtn").click(function() {
                var userId = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url: "delete.php",
                            data: { action: 'delete', id: userId },
                            dataType: "json",
                            success: function(response) {
                                if (response.status == 'success') {
                                    Swal.fire(
                                        'Deleted!',
                                        'User has been deleted.',
                                        'success'
                                    ).then(function() {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Error deleting user. Please try again later.',
                                        'error'
                                    );
                                }
                            },
                            error: function() {
                                Swal.fire(
                                    'Error!',
                                    'Error deleting user. Please try again later.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
</script>

