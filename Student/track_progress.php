<?php
session_start();
require_once '../config/config.php';
?>

<?php 
include('./inc/header.php'); 
include('./inc/navbar.php'); 
?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php include('./inc/topbar.php'); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Track progress on the career goals set</h1>
            </div>
            
            <!-- Content Row -->
            <div class="row">
                <?php
                    $userid = $_SESSION['userid'];
                    $sql = formQuery("SELECT * FROM goals WHERE userid='$userid' ORDER BY id DESC");
                    if($sql->num_rows > 0) { 
                        $num = 1;
                        while($row = $sql->fetch_assoc()) {
                ?>
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Career Goal</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo ucfirst($row['dgoal']) ?></div>
                                    <div class="progress mt-3">
                                        <div class="progress-bar" role="progressbar" 
                                             style="width: <?php echo ($row['dprogress']) ?>%;" 
                                             aria-valuenow="<?php echo ($row['dprogress']) ?>" 
                                             aria-valuemin="0" aria-valuemax="100">
                                             <?php echo ($row['dprogress']) ?>%</div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-laptop-code fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                        } 
                    } 
                ?>
            </div>
            <!-- End of Content Row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <?php 
    include('./inc/footer.php'); 
    ?>

</div>
<!-- End of Content Wrapper -->

<?php 
include('./inc/script.php'); 
?>
