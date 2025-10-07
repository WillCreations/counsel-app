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
                <h1 class="h3 mb-0 text-gray-800">Appointment Scheduling</h1>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Schedule Appointment Form -->
                <div class="col-lg-4 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Schedule Appointment</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="schedule-process.php">
                                <div class="form-group">
                                    <label for="counselor">Counselor's Name</label>
                                    <input type="text" name="name" class="form-control" id="name">
                                </div>
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" class="form-control" id="date" name="date" required>
                                </div>
                                <div class="form-group">
                                    <label for="time">Time</label>
                                    <input type="time" class="form-control" id="time" name="time" required>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Schedule</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Manage and Track Appointments -->
                <div class="col-lg-7 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Manage and Track Appointments</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="appointmentTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Counselor</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                            <th>---</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = formQuery("SELECT * FROM appointment ORDER BY id DESC");
                                        if($sql->num_rows > 0) { 
                                            $num = 1;
                                            while($row = $sql->fetch_assoc()) {
                                        ?>
                                            <tr>
                                                <td><?php echo $num++ ?></td>
                                                <td><?php echo ucfirst($row['dfname']) ?></td>
                                                <td><?php echo ($row['ddate']) ?></td>
                                                <td><?php echo ($row['dtime']) ?></td>
                                                <td><?php echo ($row['dstatus']) ?></td>
                                                <td>
                                                    <form method='POST' action="update_appt.php" style='display:inline-block;'>
                                                        <input type='hidden' name='id' value='<?php echo ($row['id']) ?>'/>
                                                        <button type='submit' name='complete' class='btn btn-success btn-sm'>Complete</button>
                                                    </form>
                                                    <form method='POST' action="update_appt.php" style='display:inline-block;'>
                                                        <input type='hidden' name='id' value='<?php echo ($row['id']) ?>'/>
                                                        <button type='submit' name='cancel' class='btn btn-danger btn-sm'>Cancel</button>
                                                    </form> 
                                                    </td>
                                                    <td>
                                                    <a href="appmtDelete.php?action=delete&id=<?php echo $row['id']; ?>&table=appointment" class="btn btn-danger btn-sm">Delete</a>
                                                </td>
                                            </tr>
                                        <?php 
                                            } 
                                        } 
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

<?php 
include('./inc/script.php'); 
include('./inc/footer.php'); 
?>
</div>
