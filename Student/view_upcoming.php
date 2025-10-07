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

        <?php
        include('./inc/topbar.php');
        ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">View Past and Upcoming Appointments</h1>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Content Row -->
                <!-- Add Bootstrap UI code for students to view past and upcoming appointments -->
                <div class="container">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>Appointment ID</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Example data, replace with dynamic data -->
                                <tr>
                                    <td>1</td>
                                    <td>2023-08-15</td>
                                    <td>10:00 AM</td>
                                    <td>Room 101</td>
                                    <td>Past</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>2024-09-01</td>
                                    <td>02:00 PM</td>
                                    <td>Room 202</td>
                                    <td>Upcoming</td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- End of Content Row -->

            </div>
        </div>
        </div>

        <?php 
        include('./inc/script.php'); 
        include('./inc/footer.php'); 
        ?>
 