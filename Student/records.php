
<?php 
        session_start();
        
        if (!isset($_SESSION['userid'])){
            header("Location:./index.php");
        }
        
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
                <h1 class="h3 mb-0 text-gray-800">Student Records</h1>
                <div class="row">
                    <form class="form-inline row " action="get_record.php" method="POST">
                        <div class="form-group mx-2">
                            <select name="term" class="form-control ">
                                <option value="">Term</option>
                                <option value="First">First</option>
                                <option value="Second">Second</option>
                                <option value="Third">Third</option>
                            </select>
                        </div>
                        <div class="form-group mx-2">
                            <select name="year" class="form-control">
                                <option value="">Year</option>
                                <?php for ($i = (int)date('Y'); $i >= 1970; $i--) : ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <button class="btn btn-primary mx-2" type="submit">Submit</button>
                    </form>

                    <a href="student.php"> <button class=" btn btn-primary rounded mx-2" > Back</button></a> 
                </div>
            </div>

 

                    <!-- Content Row -->
<div class="row">
<div class="col-lg-4 mb-4">
 <h5 class="bg-dark rounded px-3 py-2 text-white">Upload Grades</h5>
 <form action="record_process.php" method="POST">
        
     <div class="form-group">
            <select name="subject" class="form-control">
                <option value="">Subject</option>
                <option value="English">English</option>
                <option value="Mathematics">Mathematics</option>
                <option value="Biology">Biology</option>
                <option value="Government">Government</option>
                <option value="Physics">Physics</option>
                <option value="History">History</option>
                <option value="Literature">Literature</option>
                <option value="Chemistry">Chemistry</option>
                <option value="Economics">Economics</option>
                <option value="Accounting">Accounting</option>
                <option value="Commerce">Commerce</option>
                <option value="Computer Science">Computer Science</option>
                <option value="CRK">CRK</option>
            </select>
        </div>
        <div class="form-group">
            <input type="number" name="score" placeholder="Score" class="form-control">
        </div>
        <div class="form-group">
            <select name="term" class="form-control">
                <option value="">Term</option>
                <option value="First">First</option>
                <option value="Second">Second</option>
                <option value="Third">Third</option>
            </select>
        </div>
        <div class="form-group">
            <select name="year" class="form-control">
                    <option value="">Year</option>
                          <?php for ($i = (int)date('Y'); $i >= 1970; $i--) : ?>
                              <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                          <?php endfor; ?>
            </select>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
        <?php
            if (isset($_SESSION['record_success'])) {
                echo '<div class="alert alert-success mt-2">' . htmlspecialchars($_SESSION['record_success']) . '</div>';
                unset($_SESSION['record_success']);
            }
            if (isset($_SESSION['record_error'])) {
                echo '<div class="alert alert-danger mt-2">' . htmlspecialchars( $_SESSION['record_error']) . '</div>';
                unset($_SESSION['record_error']);
            }
        ?>
    </form>    
</div>

<!-- upload grade ends -->

<div class="col-lg-8 mb-4">
    <div class="bg-gray-200 rounded py-2 px-2">
        <?php
       $records = $_SESSION['records']
        ?>
        <table class="table table-bordered" id="recordTable" width="100%" cellspacing="0">

            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Subject</th>
                    <th>Score</th>
                    <th>Grade</th>
                    <th>Term</th>
                    <th>Year</th>
                </tr>
            </thead>
            <tbody>
        
     <?php if(count($records) > 0) : ?>
        <?php $num = 1; ?>
           <?php foreach($records as $row):  ?>
                <tr>
                    <td><?php echo $num++;  ?></td>
                    <td><?php echo htmlspecialchars(ucfirst($row['grade_subject'])); ?></td>
                    <td><?php echo htmlspecialchars($row['score']); ?></td>
                    <td><?php echo htmlspecialchars($row['grade']); ?></td>
                    <td><?php echo htmlspecialchars(ucfirst($row['term_title'])); ?></td>
                    <td><?php echo htmlspecialchars($row['year']); ?></td>
                </tr>
              <?php endforeach; ?>
        <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">No records found.</td>
                </tr>
        <?php endif; ?>
            </tbody>
            </table>

    </div>
    <div class="bg-gray-200 rounded py-2 px-2"></div>
    <div class="bg-gray-200 rounded py-2 px-2"></div>
    <div class="bg-gray-200 rounded py-2 px-2"></div>
</div>


        </div>
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


