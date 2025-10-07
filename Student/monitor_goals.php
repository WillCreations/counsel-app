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
                                        $userid = $_SESSION['userid'];
                                        $sql = formQuery("SELECT * FROM goals WHERE userid='$userid' ORDER BY id DESC");
                                        if($sql->num_rows > 0) { 
                                            while($row = $sql->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <td><?php echo ucfirst($row['dgoal']) ?></td>
                                            <td><?php echo ($row['startDate']) ?></td>
                                            <td><?php echo ($row['endDate']) ?></td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" 
                                                    style="width: <?php echo ($row['dprogress']) ?>%;" 
                                                    aria-valuenow="<?php echo ($row['dprogress']) ?>" 
                                                    aria-valuemin="0" aria-valuemax="100">
                                                    <?php echo ($row['dprogress']) ?>%</div>
                                                </div>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-primary">Update</button>
                                                <a href="delete_goal.php?action=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
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

            <!-- Content Row -->
            
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
