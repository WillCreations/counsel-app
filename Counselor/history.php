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

                                         $userid = $_SESSION['userid'] ?? null;
                                        if (!$userid) {
                                            echo "<tr><td colspan='6' class='text-center'>Please log in to view appointments.</td></tr>";
                                        } else {
                                            $sstmt = $conn->prepare('SELECT id FROM counselor WHERE userid = ? LIMIT 1');
                                            $sstmt->execute([$userid]);
                                            $srow = $sstmt->fetch(PDO::FETCH_ASSOC);
                                            $counselor_id = $srow['id'] ?? null;
        
                                            if ($counselor_id) {
                                                $query = "SELECT a.* , s.dfname AS student_name FROM appointment a LEFT JOIN student s ON a.student_id = s.id WHERE a.counselor_id = ? ORDER BY a.appointment_date DESC";
                                                $stmt = $conn->prepare($query);
                                                $stmt->execute([$counselor_id]);
                                                $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            if (count($appointments) > 0) {
                                                    $num = 1;
                                                    foreach ($appointments as $row) {
                                                        $dateTime = new DateTime($row['appointment_date']);
                                                        $date = $dateTime->format('Y-m-d');
                                                        $time = $dateTime->format('H:i');
                                                        $studentName = $row['student_name'] ?? 'TBD';
                                                        // handle status column name variants
                                                        $status = $row['status'] ?? ($row['appointment_status'] ?? 'Unknown');
                                        ?>
                                           <tr>
                                                 <td><?php echo $num++; ?></td>
                                                <td><?php echo htmlspecialchars($studentName); ?></td>
                                                <td><?php echo htmlspecialchars($date); ?></td>
                                                <td><?php echo htmlspecialchars($time); ?></td>
                                                <td><?php echo htmlspecialchars($status); ?></td>
                                                <td>
                                                    <form method='POST' action="update_appt.php" style='display:inline-block;'>
                                                        <input type='hidden' name='id' value='<?php echo ($row['id']) ?>'/>
                                                        <button type='submit' name='complete' class='btn btn-success btn-sm'>Complete</button>
                                                    </form>
                                                    
                                                    <form method='POST' action="update_appt.php" style='display:inline-block;'>
                                                        <input type='hidden' name='id' value='<?php echo ($row['id']) ?>'/>
                                                        <button type='submit' name='confirm' class='btn btn-primary btn-sm'>Confirm</button>
                                                    </form> 
                                                </td>
                                                <td>

                                                    <form method='POST' action="update_appt.php" style='display:inline-block;'>
                                                        <input type='hidden' name='id' value='<?php echo ($row['id']) ?>'/>
                                                        <button type='submit' name='cancel' class='btn btn-danger btn-sm'>Cancel</button>
                                                    </form> 
                                                    <a href="appmtDelete.php?action=delete&id=<?php echo $row['id']; ?>&table=appointment" class="btn btn-dark btn-sm">Delete</a>
                                                </td>
                                            </tr>
                                       <?php 
                                           }
                                                } else {
                                                    echo "<tr><td colspan='6' class='text-center'>No appointments found.</td></tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='6' class='text-center'>Counselor's record not found.</td></tr>";
                                            }
                                        }
                                        ?>
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
