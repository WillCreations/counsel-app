<?php
session_start();
require_once '../config/config.php';

// Assume student ID is stored in session after login
$userid = $_SESSION['userid'];
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
                <h1 class="h3 mb-0 text-gray-800">Set academic and career goals</h1>
                <a href="track_progress.php"> <button class="btn-primary rounded px-3 py-1" >Back</button></a> 
            </div>

            <!-- Content Row -->
            <div class="row">
                <!-- Add New Goal Form -->
                <div class="col-xl-5 col-lg-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add New Goal</h6>
                        </div>
                        <div class="card-body">
                            <!-- Error messages will be displayed here -->
                            <div id="error-messages" style="color: red;"></div>

                            <form method="POST" action="goal-process.php" onsubmit="return validateForm()">
                                <div class="form-group">
                                    <label for="goal">Goal</label>
                                    <input type="text" name="goal" class="form-control" id="goal" placeholder="Enter your goal">
                                </div>
                                <div class="form-group">
                                    <label for="start-date">Start Date</label>
                                    <input type="date" name="start_date" class="form-control" id="start-date">
                                </div>
                                <div class="form-group">
                                    <label for="end-date">End Date</label>
                                    <input type="date" name="end_date" class="form-control" id="end-date">
                                </div>
                                <div class="form-group">
                                    <label for="progress">Progress (%)</label>
                                    <input type="text" name="progress" class="form-control" id="progress" placeholder="Enter progress">
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Add Goal</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Goals Table -->
                <div class="col-xl-7 col-lg-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Career Goals</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Goal</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Progress</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $modalid = 1;
                                        $userid = $_SESSION['userid'];

                                        if($userid){

                                        $query = "SELECT id FROM student WHERE userid= ? LIMIT 1";
                                        $stmt = $conn->prepare($query);
                                        $stmt->execute([$userid]);
                                        $srow = $stmt->fetch(PDO::FETCH_ASSOC);
                                        $query = "SELECT * FROM goals WHERE student_id = ? ORDER BY id DESC";
                                        $stmt = $conn->prepare($query);
                                        $stmt->execute([$srow['id']]);
                                        $goals = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        if(count($goals) > 0) { 
                                            foreach($goals as $row) {
                                    ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['goal_title']); ?></td>
                                            <td><?php echo htmlspecialchars($row['start_date']); ?></td>
                                            <td><?php echo htmlspecialchars($row['end_date']); ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" 
                                                    style="width: <?php echo htmlspecialchars($row['progress']); ?>%;" 
                                                    aria-valuenow="<?php echo htmlspecialchars($row['progress']); ?>" 
                                                    aria-valuemin="0" aria-valuemax="100">
                                                    <?php echo htmlspecialchars($row['progress']); ?>%</div>
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" 
                                                    class="btn btn-primary  my-1 editGoalBtn" 
                                                    data-toggle="modal" data-target="#editProfileModal"
                                                    data-id="<?php echo $row['id']; ?>"
                                                    data-title="<?php echo htmlspecialchars($row['goal_title'], ENT_QUOTES); ?>"
                                                    data-start="<?php echo htmlspecialchars($row['start_date'], ENT_QUOTES); ?>"
                                                    data-end="<?php echo htmlspecialchars($row['end_date'], ENT_QUOTES); ?>"
                                                    data-progress="<?php echo htmlspecialchars($row['progress'], ENT_QUOTES); ?>"
                                                    data-status="<?php echo htmlspecialchars($row['goal_status'] ?? 'Not Started', ENT_QUOTES); ?>"
                                                >Update</button>
                                                <a href="delete_goal.php?action=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger my-1 btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                    <?php 
                                            } 
                                        } }
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
              <!-- Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Update Goal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editProfileForm" method="POST" action="update_goal.php">
                        <input type="hidden" id="goal_id" name="id" value="">

                        <div class="form-group">
                            <label for="goal_title">Goal</label>
                            <input type="text" class="form-control" id="goal_title_input" name="goal_title" value="">
                        </div>
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" id="start_date_input" name="start_date" value="">
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" id="end_date_input" name="end_date" value="">
                        </div>
                        <div class="form-group">
                            <label for="goal_status">Status</label>
                            <select class="form-control" id="goal_status_input" name="goal_status">
                                <option value="Not Started">Not Started</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Completed">Completed</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="progress">Progress</label>
                            <input type="number" min="0" max="100" class="form-control" id="progress_input" name="progress" value="">
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

    <script>
        // Populate modal fields when Edit/Update button is clicked
        document.addEventListener('DOMContentLoaded', function () {
            const editButtons = document.querySelectorAll('.editGoalBtn');
            editButtons.forEach(btn => {
                btn.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    const title = this.getAttribute('data-title') || '';
                    const start = this.getAttribute('data-start') || '';
                    const end = this.getAttribute('data-end') || '';
                    const progress = this.getAttribute('data-progress') || '';
                    const status = this.getAttribute('data-status') || 'Not Started';

                    document.getElementById('goal_id').value = id;
                    document.getElementById('goal_title_input').value = title;
                    document.getElementById('start_date_input').value = start;
                    document.getElementById('end_date_input').value = end;
                    document.getElementById('progress_input').value = progress;
                    document.getElementById('goal_status_input').value = status;
                });
            });
        });
    </script>
</div>
            
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

<?php 
include('./inc/script.php'); 
include('./inc/footer.php'); 
?>
<script>
    function validateForm() {
        const goal = document.getElementById('goal').value.trim();
        const startDate = document.getElementById('start-date').value.trim();
        const endDate = document.getElementById('end-date').value.trim();
        const progress = document.getElementById('progress').value.trim();
        const errorDiv = document.getElementById('error-messages');
        let errorMessages = '';

        errorDiv.innerHTML = ''; 

        if (goal === '') {
            errorMessages += '<p>Goal is required.</p>';
        }
        if (startDate === '') {
            errorMessages += '<p>Start Date is required.</p>';
        }
        if (endDate === '') {
            errorMessages += '<p>End Date is required.</p>';
        }
        if (progress === '') {
            errorMessages += '<p>Progress is required.</p>';
        } else if (isNaN(progress) || progress < 0 || progress > 100) {
            errorMessages += '<p>Progress must be a number between 0 and 100.</p>';
        }

        if (errorMessages !== '') {
            errorDiv.innerHTML = errorMessages;
            return false;
        }

        return true;
    }
</script>
