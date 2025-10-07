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
                <h1 class="h3 mb-0 text-gray-800">View Appointment History</h1>
            </div>

            <!-- Content Row -->
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Appointment History</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Student</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                            <th>---</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = formQuery("SELECT * FROM studentappointment ORDER BY id DESC");

                                        if ($sql) {
                                            if ($sql->num_rows > 0) { 
                                                $num = 1;
                                                while ($row = $sql->fetch_assoc()) {
                                        ?>
                                            <tr>
                                                <td><?php echo ($row['id']) ?></td>
                                                <td><?php echo ucfirst($row['dfname']) ?></td>
                                                <td><?php echo ($row['ddate']) ?></td>
                                                <td><?php echo ($row['dtime']) ?></td>
                                                <td><?php echo ($row['dstatus']) ?></td>
                                                <td>
                                                    <form method='POST' action="appt_status.php" style='display:inline-block;'>
                                                        <input type='hidden' name='id' value='<?php echo ($row['id']) ?>'/>
                                                        <button type='submit' name='complete' class='btn btn-success btn-sm'>Complete</button>
                                                    </form>
                                                    <form method='POST' action="appt_status.php" style='display:inline-block;'>
                                                        <input type='hidden' name='id' value='<?php echo ($row['id']) ?>'/>
                                                        <button type='submit' name='cancel' class='btn btn-danger btn-sm'>Cancel</button>
                                                    </form> 
                                                    </td>
                                                    <td>
                                                    <a href="appmtDelete.php?action=delete&id=<?php echo $row['id']; ?>&table=studentappointment" class="btn btn-danger btn-sm">Delete</a>
                                                </td>
                                            </tr>
                                        <?php 
                                                } 
                                            } else {
                                                echo "<tr><td colspan='7'>No appointments found.</td></tr>";
                                            }
                                        } else {
                                            echo "Error: " . formQuery()->error;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->
            
        </div>
    </div>

<?php 
include('./inc/script.php'); 
include('./inc/footer.php'); 
?>
</div>
