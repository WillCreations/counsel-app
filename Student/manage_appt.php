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
                <a href="view_upcoming.php"> <button class="btn-primary rounded px-3 py-1" >Back</button></a> 
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
                            <form method="POST" action="manage-process.php">
                                <div class="form-group">
                                    <label for="Counselor">Counselor's Name</label>
                                    <select name="counselor_id" class="form-control" id="counselor_id" required>
                                        <option value="">Select Counselor</option>
                                        <?php
                                        // Load counselors for dropdown
                                        $query = "SELECT id, dfname FROM counselor ORDER BY dfname ASC";
                                        $stmt = $conn->prepare($query);
                                        $stmt->execute();
                                        $counselors = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        if (count($counselors) > 0) {
                                            foreach ($counselors as $c) {
                                                echo "<option value='" . htmlspecialchars($c['id']) . "'>" . htmlspecialchars($c['dfname']) . "</option>";
                                            }
                                        } else {
                                            echo "<option value=''>No counselors found</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" class="form-control" id="date" name="date" required>
                                </div>
                                <div class="form-group">
                                    <label for="time">Time</label>
                                    <input type="time" class="form-control" id="time" name="time" required>
                                </div>
                                <div class="form-group">
                                    <label for="notes">Notes</label>
                                    <textarea class="form-control" id="notes" rows="3" name="notes" required></textarea>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Schedule</button>
                            </form>
                        </div>
                    </div>
                </div>



                <!-- Manage and Track Appointments -->
                <div class="col-lg-8 mb-4">
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
                                            <th>Scheduled By</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Show appointments for logged-in student
                                        $userid = $_SESSION['userid'] ?? null;
                                        if (!$userid) {
                                            echo "<tr><td colspan='6' class='text-center'>Please log in to view appointments.</td></tr>";
                                        } else {
                                            // get student.id from userid
                                            $sstmt = $conn->prepare('SELECT id FROM student WHERE userid = ? LIMIT 1');
                                            $sstmt->execute([$userid]);
                                            $srow = $sstmt->fetch(PDO::FETCH_ASSOC);
                                            $student_id = $srow['id'] ?? null;

                                            if ($student_id) {
                                                $query = "SELECT a.* , c.dfname AS counselor_name FROM appointment a LEFT JOIN counselor c ON a.counselor_id = c.id WHERE a.student_id = ? ORDER BY a.appointment_date DESC";
                                                $stmt = $conn->prepare($query);
                                                $stmt->execute([$student_id]);
                                                $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                if (count($appointments) > 0) {
                                                    $num = 1;
                                                    foreach ($appointments as $row) {
                                                        $dateTime = new DateTime($row['appointment_date']);
                                                        $date = $dateTime->format('Y-m-d');
                                                        $time = $dateTime->format('H:i');
                                                        $counselorName = $row['counselor_name'] ?? 'TBD';
                                                        // handle status column name variants
                                                        $status = $row['status'] ?? ($row['appointment_status'] ?? 'Unknown');
                                                        $scheduledBy = ($row['student_id'] == $row['fixer_id']) ? 'Student' : 'Counselor';
                                        ?>
                                            <tr>
                                                <td><?php echo $num++; ?></td>
                                                <td><?php echo htmlspecialchars($counselorName); ?></td>
                                                <td><?php echo htmlspecialchars($date); ?></td>
                                                <td><?php echo htmlspecialchars($time); ?></td>
                                                <td><?php echo htmlspecialchars($scheduledBy); ?></td>
                                                <td class="<?php echo ($status === 'Confirmed') ? 'text-primary' : (($status === 'Completed') ? 'text-success' : (($status === 'Cancelled') ? 'text-danger' : 'text-warning')); ?>">
                                                    <?php echo htmlspecialchars($status); ?>
                                                </td>
                                                <td>
                                                    <?php if($row['student_id'] !== $row['fixer_id'] && $status !== "Confirmed" && $status !== "Cancelled" && $status !== "Completed") :?>
                                                    <form method='POST' action="update_appt.php" style='display:inline-block;'>
                                                        <input type='hidden' name='id' value='<?php echo (int)$row['id']; ?>'/>
                                                        <button type='submit' name='confirm' class='btn btn-primary my-1 btn-sm'>Confirm</button>
                                                    </form>
                                                    <?php endif; ?>
                                                     <?php if(  $status !== "Cancelled" && $status !== "Completed") :?>
                                                    <form method='POST' action="update_appt.php" style='display:inline-block;'>
                                                        <input type='hidden' name='id' value='<?php echo (int)$row['id']; ?>'/>
                                                        <button type='submit' name='cancel' class='btn btn-danger my-1 btn-sm'>Cancel</button>
                                                    </form>
                                                    <?php endif; ?>
                                                    
                                                </td>
                                                
                                                 <td>
                                                    <?php if($row['student_id'] === $row['fixer_id'] && $status !== "Confirmed" && $status !== "Completed") : ?>
                                                    <a href="appmtDelete_student.php?action=delete&id=<?php echo $row['id']; ?>&table=appointment" class="btn btn-dark btn-sm">Delete</a>
                                                    <?php endif; ?>


                                                </td>
                                            </tr>
                                        <?php
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='6' class='text-center'>No appointments found.</td></tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='6' class='text-center'>Student record not found.</td></tr>";
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>





   
                <!-- Start of Modal-->
        <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProfileModalLabel">View Appointment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        
                        <form id="editProfileForm" method="POST" action="update_all_appt.php">
                            <input type="hidden" id="appointment_id" name="id" value="">

                            <div class="form-group">
                                <label for="goal_title">Counselor</label>
                                <input type="text" class="form-control" id="counselor_name_input" name="counselor_name"/>
                            </div>
                            <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" class="form-control" id="date_input" name="date" value="">
                            </div>
                            <div class="form-group">
                                <label for="time">Time</label>
                                <input type="time" class="form-control" id="time_input" name="time" value="">
                            </div>
                            
                            <div class="form-group">
                                <label for="appointment_status">Status</label>
                                <select class="form-control" id="appointment_status_input" name="appointment_status">
                                    <option value="Pending">Pending</option>
                                    <option value="Confirmed">Confirmed</option>
                                    <option value="Completed">Completed</option>
                                    <option value="Cancelled">Cancelled</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea class="form-control" rows="3" id="notes_input" name="notes"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" form="editProfileForm" id="updateBtn">Update</button>
                    </div>
                </div>
            </div>
        </div>

    <!--End of Modal-->



            </div>

        </div>


            

    </div>

<?php 
include('./inc/script.php'); 
include('./inc/footer.php'); 
?>
</div>

