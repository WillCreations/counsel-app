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
                <div>
                    <a href="manage_appt.php"> <button class="btn-primary rounded px-3 py-1" >Manage</button></a>
                    <a href="student.php"> <button class="btn-primary rounded px-3 py-1" >Back</button></a>
                </div> 
            </div>

            <!-- Content Row -->
            <div class=" row">

                <!-- Content Row -->
                <!-- Add Bootstrap UI code for students to view past and upcoming appointments -->
                <div class="  col-lg-12 container">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>Appointment ID</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Counselor</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

    <?php
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
            
        
        if ($appointments && count($appointments) > 0) {
            $num = 1;
            foreach ($appointments as $row) {
                // Format date/time from DATETIME column
                $dateTime = new DateTime($row['appointment_date']);
                $counselorName = $row['counselor_name'] ?? 'TBD';
                $date = $dateTime->format('Y-m-d');
                $time = $dateTime->format('H:i');
                $status = $row['appointment_status'];
                 // Fetch ALL rows
                ?>
         
    
                            <tr>
                                <td><?php echo $num++; ?></td>
                                <td><?php echo htmlspecialchars($date); ?></td>
                                <td><?php echo htmlspecialchars($time); ?></td>
                                <td><?php echo htmlspecialchars($row['counselor_name']); ?></td>
                                <td class="<?php echo ($status === 'Confirmed') ? 'text-primary' : (($status === 'Completed') ? 'text-success' : (($status === 'Cancelled') ? 'text-danger' : 'text-warning')); ?>"><?php echo htmlspecialchars($row['appointment_status']); ?></td>
                                <td>
                                                     <button type="button" 
                                                    class="btn btn-primary editAppointBtn" 
                                                    data-toggle="modal" data-target="#editProfileModal"
                                                    data-id="<?php echo htmlspecialchars($row['id'], ENT_QUOTES); ?>"
                                                    data-counselor="<?php echo htmlspecialchars($counselorName, ENT_QUOTES); ?>"
                                                    data-date="<?php echo htmlspecialchars($date, ENT_QUOTES); ?>"
                                                    data-time="<?php echo htmlspecialchars($time, ENT_QUOTES); ?>"
                                                    data-status="<?php echo htmlspecialchars($status ?? 'Not Started', ENT_QUOTES); ?>"
                                                    data-notes="<?php echo htmlspecialchars($row['notes'], ENT_QUOTES); ?>"
                                                    >View</button>
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

                <!-- End of Content Row -->


                <!-- Start of Modal-->
        <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProfileModalLabel">View Appointment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="false">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                            <div class="mb-2">
                                <label for="appointment_id">Appointment ID:</label>
                                <div id="appointment_id" class="border rounded border-primary px-3 py-1"></div>
                            </div>

                            <div class="mb-2">
                                <label for="counselor_name_input">Counselor</label>
                                <div type="text" class="border rounded border-primary px-3 py-1" id="counselor_name_input" name="counselor_name"></div>
                            </div>
                
                            <div class="mb-2">
                                    <label for="date">Date</label>
                                    <div type="date" class="border rounded border-primary px-3 py-1" id="date_input" name="date" ></div>
                            </div>
                            <div class="mb-2">
                                <label for="time">Time</label>
                                <div type="time" class="border rounded border-primary px-3 py-1" id="time_input" name="time" ></div>
                            </div>
                            
                            <div class="mb-2">
                                <label for="appointment_status">Status</label>
                                <div class="border rounded border-primary px-3 py-1" id="appointment_status_input" name="appointment_status">
                                  
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="notes">Notes</label>
                                <div class="border rounded border-primary px-3 py-1" id="notes_input" name="notes"></div>
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    <!--End of Modal-->

            </div>
        </div>
        <script>
    document.addEventListener('DOMContentLoaded', function() {
        var editButtons = document.querySelectorAll('.editAppointBtn');
            editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                // read attributes (appointment id added to the button)
                const appointmentId = this.getAttribute('data-id');
                const counselor_Name = this.getAttribute('data-counselor');
                const date = this.getAttribute('data-date');
                const time = this.getAttribute('data-time');
                const status = this.getAttribute('data-status');
                const notes = this.getAttribute('data-notes');

                console.log({appointmentId, counselor_Name, date, time, status, notes});

                const appointEl = document.getElementById('appointment_id');
                if (appointEl) appointEl.innerText = appointmentId || '';

                const counselorEl = document.getElementById('counselor_name_input');
                if (counselorEl) counselorEl.innerText = counselor_Name || 'TBD';

                const dateEl = document.getElementById('date_input');
                const timeEl = document.getElementById('time_input');
                const statusEl = document.getElementById('appointment_status_input');
                const notesEl = document.getElementById('notes_input');

                // Load moment.js dynamically once if it's not available, then format date/time
                const loadMoment = (function(){
                    let p = null;
                    return function(){
                        if (window.moment) return Promise.resolve(window.moment);
                        if (p) return p;
                        p = new Promise((resolve) => {
                            const s = document.createElement('script');
                            s.src = 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js';
                            s.onload = () => resolve(window.moment || null);
                            s.onerror = () => resolve(null);
                            document.head.appendChild(s);
                        });
                        return p;
                    };
                })();

                loadMoment().then(() => {
                    // format date (YYYY-MM-DD) -> 'Mon, Jan 2, 2024' etc.
                    if (dateEl) {
                        if (window.moment && date) {
                            dateEl.innerText = moment(date, 'YYYY-MM-DD').format('dddd, MMM D, YYYY');
                        } else {
                            // fallback: local date string
                            try {
                                const parts = (date || '').split('-');
                                if (parts.length >= 3) {
                                    const dt = new Date(parts[0], Number(parts[1]) - 1, parts[2]);
                                    dateEl.innerText = dt.toLocaleDateString(undefined, { weekday: 'long', month: 'short', day: 'numeric', year: 'numeric' });
                                } else {
                                    dateEl.innerText = date || '';
                                }
                            } catch (e) {
                                dateEl.innerText = date || '';
                            }
                        }
                    }

                    if (timeEl) {
                        if (window.moment && time) {
                            timeEl.innerText = moment(time, 'HH:mm').format('h:mm A');
                        } else {
                            timeEl.innerText = time || '';
                        }
                    }

                    if (statusEl) statusEl.innerText = status || '';
                    if (notesEl) notesEl.innerText = notes || '';
                });
            });
        });
    });
</script>
        </div>

        <?php 
        include('./inc/script.php'); 
        include('./inc/footer.php'); 
        ?>
 