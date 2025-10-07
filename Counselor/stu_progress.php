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
                <h1 class="h3 mb-0 text-gray-800">Student Progress and Career Plan</h1>
            </div>

            <!-- Content Row -->
            <div class="row">
                <!-- Student Progress Section -->
                <div class="col-xl-6 col-lg-7">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Student Progress</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="progressChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Career Plan Section -->
                <div class="col-xl-6 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Career Plan</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="careerChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->
            

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->

    <?php 
    include('./inc/script.php'); 
    include('./inc/footer.php'); 
    ?>
</div>
<!-- End of Content Wrapper -->

<script>
    var ctxProgress = document.getElementById('progressChart').getContext('2d');
    var progressChart = new Chart(ctxProgress, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June'],
            datasets: [{
                label: 'Student Progress',
                data: [65, 59, 80, 81, 56, 55],
                backgroundColor: 'rgba(78, 115, 223, 0.2)',
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 1
            }]
        }
    });

    var ctxCareer = document.getElementById('careerChart').getContext('2d');
    var careerChart = new Chart(ctxCareer, {
        type: 'pie',
        data: {
            labels: ['Career 1', 'Career 2', 'Career 3', 'Career 4'],
            datasets: [{
                label: 'Career Plan',
                data: [10, 20, 30, 40],
                backgroundColor: [
                    'rgba(78, 115, 223, 0.2)',
                    'rgba(54, 185, 204, 0.2)',
                    'rgba(133, 135, 150, 0.2)',
                    'rgba(231, 74, 59, 0.2)'
                ],
                borderColor: [
                    'rgba(78, 115, 223, 1)',
                    'rgba(54, 185, 204, 1)',
                    'rgba(133, 135, 150, 1)',
                    'rgba(231, 74, 59, 1)'
                ],
                borderWidth: 1
            }]
        }
    });
</script>
