
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
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            </div>

 

                    <!-- Content Row -->

                <div class="row">

               <?php $goalQuery = "SELECT * FROM goals  WHERE student_id = ? ORDER BY id DESC";
                $goalStmt = $conn->prepare($goalQuery);
                $stuQuery = "SELECT * FROM student WHERE userid = ? LIMIT 1";
                $stuStmt = $conn->prepare($stuQuery);
                $stuStmt->execute([$_SESSION['userid']]);
                $stuRow = $stuStmt->fetch(PDO::FETCH_ASSOC);
                $goalStmt->execute([$stuRow['id']]);
                $goals = $goalStmt->fetchALL(PDO::FETCH_ASSOC);
                $goalCount = count($goals);
                
                ?>
                            <!-- Users -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <a href="track_progress.php">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs  font-weight-bold text-primary text-uppercase mb-1">
                                            Goals</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo htmlspecialchars($goalCount); ?></div>
                                        </div>
                                        <div class="col-auto">
                                                <i class="fa fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>

 
                        <!-- Available rooms -->
                         <?php 
                            $recordQuery = "SELECT t.*, g.Student_id FROM term t INNER JOIN grades g ON t.id = g.term_id WHERE g.student_id = ? ORDER BY t.id DESC";
                            $recordStmt = $conn->prepare($recordQuery);
                            $stuQuery = "SELECT id FROM student WHERE userid = ? LIMIT 1";
                            $stuStmt = $conn->prepare($stuQuery);
                            $stuStmt->execute([$_SESSION['userid']]);
                            $stuRow = $stuStmt->fetch(PDO::FETCH_ASSOC);
                            $recordStmt->execute([$stuRow['id']]);
                            $records = $recordStmt->fetchALL(PDO::FETCH_ASSOC);
                            $recordCount = count($records);
                            
                        ?>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <a href="records.php">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Records</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo htmlspecialchars($recordCount); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-home fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Booked Rooms -->
                           <?php 
                            $apptQuery = "SELECT * FROM appointment WHERE student_id = ? ORDER BY id DESC";
                            $apptStmt = $conn->prepare($apptQuery);
                            $stuQuery = "SELECT id FROM student WHERE userid = ? LIMIT 1";
                            $stuStmt = $conn->prepare($stuQuery);
                            $stuStmt->execute([$_SESSION['userid']]);
                            $stuRow = $stuStmt->fetch(PDO::FETCH_ASSOC);
                            $apptStmt->execute([$stuRow['id']]);
                            $appointments = $apptStmt->fetchALL(PDO::FETCH_ASSOC);
                            $appointmentCount = count($appointments);
                            
                        ?>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <a href="view_upcoming.php">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Appointments</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo htmlspecialchars($appointmentCount); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-home fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Number of Appointments-->
                         <?php 
                            $apptQuery = "SELECT * FROM counselor  ORDER BY id DESC";
                            $apptStmt = $conn->prepare($apptQuery);
                           
                            $apptStmt->execute();
                            $counselors = $apptStmt->fetchALL(PDO::FETCH_ASSOC);
                            $counselorCount = count($counselors);
                            
                        ?>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <a href="counselor_profile.php">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Counselors</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo htmlspecialchars($counselorCount); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-group fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    

    
                    

                    <!-- Content Row -->
                    </div>
            
   

    <?php 
        include('./inc/script.php'); 
        include('./inc/footer.php'); 
          
    ?>