<?php
session_start();
require '../config/config.php';

if (!isset($_SESSION['userid'])) {
    exit('Unauthorized access');
}
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

        <?php
        $sql = formQuery("SELECT * FROM student WHERE userid='$userid'");
        if ($sql->num_rows > 0) {
            $row = $sql->fetch_assoc();
        }
        ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="container mt-5">
                <div class="card text-center">
                    <div class="card-header">
                        <img class="img-profile rounded-circle card-img-top profile-img"
                             style="width: 200px; height: 200px; border-radius: 50%; object-fit: cover; margin-top: 75px;"
                             src="../uploads/<?php echo $row['dphoto']; ?>">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-primary"><?php echo ucfirst($row['duname']); ?></h5>
                        <p class="card-text">Fullname: <?php echo $row['dfname']; ?></p>
                        <p class="card-text">Phone: <?php echo $row['dphone']; ?></p>
                        <p class="card-text">Email: <?php echo $row['demail']; ?></p>

                        <a href="#" class="btn btn-primary" id="editProfileBtn" data-toggle="modal" data-target="#editProfileModal">Edit Profile</a>
                        <a href="logout.php" class="btn btn-warning">Logout</a>
                    </div>
                    <div class="card-footer text-muted">
                        Profile updated 3 days ago
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editProfileForm">
                        <div class="form-group">
                            <label for="fullname">Full Name</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $row['dfname']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="username">User Name</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $row['duname']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $row['dphone']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['demail']; ?>">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="updateBtn">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
include('./inc/script.php'); 
?>

<!-- Add the updateMessage element -->
<div id="updateMessage"></div>

<script>
document.getElementById('updateBtn').addEventListener('click', function() {
    var form = document.getElementById('editProfileForm');
    var formData = new FormData(form);

    fetch('update.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        var updateMessage = document.getElementById('updateMessage');
        updateMessage.textContent = data;
        updateMessage.classList.add('alert');
        updateMessage.classList.add(data.includes('successful') ? 'alert-success' : 'alert-danger');

        // Optionally close the modal after a delay
        setTimeout(() => {
            $('#editProfileModal').modal('hide');
        }, 2000);
    })
    .catch(error => {
        console.error('Error:', error);
        var updateMessage = document.getElementById('updateMessage');
        updateMessage.textContent = 'An error occurred while updating the profile.';
        updateMessage.classList.add('alert', 'alert-danger');
    });
});
</script>
</body>
</html>
