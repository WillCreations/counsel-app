
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
     
        <a href="counselor.php">  <button class="btn-primary rounded px-3 py-1">Back</button></a>
    </div>


        <!-- Content Row -->

    <div class="col-lg-12 container">
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
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = "SELECT * FROM counselor WHERE ID != ? ORDER BY id DESC";
                                $stmt = $conn->prepare($query);
                                $cstmt = $conn->prepare("SELECT id FROM counselor WHERE userid = ? LIMIT 1");
                                $cstmt->execute([$_SESSION['userid']]);
                                $counselorRow = $cstmt->fetch(PDO::FETCH_ASSOC);
                                $stmt->bindParam(1, $counselorRow['id']);
                                $stmt->execute();
                                $students = $stmt->fetchALL(PDO::FETCH_ASSOC);
                                if(count($students) > 0){ $num = 1;
                                foreach($students as $row){
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($num++) ?></td>
                                <td>
                                <img src="../stu_uploads/<?php echo htmlspecialchars($row['dphoto']); ?>" width="50" height="50" alt="">
                                </td>
                                <td><?php echo htmlspecialchars($row['dfname']); ?></td>
                                <td><?php echo htmlspecialchars($row['duname']); ?></td>
                                <td><?php echo htmlspecialchars($row['demail']); ?></td>
                                <td><?php echo htmlspecialchars($row['dphone']); ?></td>
                                <td><?php echo htmlspecialchars($row['daddress']); ?></td>
                                <td><?php echo htmlspecialchars($row['dgender']);        ?></td>
                                <td>
                                <form method="POST" action="process_counselor_profile.php">
                                        <input type='hidden' name='crow' value='<?php echo htmlspecialchars(json_encode($row)); ?>'/>
                                <button class="btn btn-primary btn-sm " name="view" type="submit" >View</button>
                                </form>
                                
                                </td>
                                <td>
                                    
                                <button class="btn btn-danger btn-sm deleteBtn" data-id="<?php echo htmlspecialchars($row['userid']); ?>" data-type="user">Delete</button>
                                
                                </td>
                            </tr>
                           
                            <?php } } ?>
                        </tbody>
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
        document.addEventListener('ondocumentLoaded', function() {
            documnent.querySelectorAll
        })
    </script>
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

