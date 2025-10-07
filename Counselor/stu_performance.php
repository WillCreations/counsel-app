
<?php
session_start();
    require_once '../config/config.php';
   
        // $userid =$_SESSION['userid'];   
        //     $sql = formQuery("SELECT * FROM admintable WHERE userid='$userid'");
        //         $row = $sql->fetch_assoc(); // Fetch the row
        //             if ($row) {
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
            // } else {
        
            //     // echo "User not found!";
            // }
            ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

        <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Student Performance & Interest</h1>
     
</div>

    <!-- Content Row -->
 <div class="row">

<!-- Users -->
<div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs  font-weight-bold text-primary text-uppercase mb-1">
                         Users</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">1000</div>
                        </div>
                    <div class="col-auto">
                            <i class="fa fa-user fa-2x text-gray-300"></i>
                        </div>
            </div>
                    </div>
        </div>
</div>

 
<!-- Available rooms -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Available Rooms</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">2000</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-home fa-2x text-gray-300"></i>
                    </div>
            </div>
        </div>
    </div>
</div>
                        
                        <!-- Booked Rooms -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Booked Rooms</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">1200</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-home fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Number of Staffs -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Staffs</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">3000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-group fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

    <!-- add Bootstrap UI code for student performance and interest here -->
    <div class="container">
      <div class="row">
        <!-- Student Performance -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary text-center">Student Performance</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Student ID</th>
                                    <th>Name</th>
                                    <th>Grade</th>
                                    <th>Subject</th>
                                    <th>Score</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                             
                                $sql = formQuery("SELECT * FROM student ORDER BY id DESC");
                                if($sql->num_rows>0){ $num = 1;
                                while($row=$sql->fetch_assoc()){
                                  
                            ?>
                                    <tr>
                                    <td><?php echo ($row['id']) ?></td>
                                    <td><?php echo ucfirst($row['dfname']) ?></td>
                                    <td><?php echo ($row['dgrade']) ?></td>
                                    <td><?php echo ($row['dsubject']) ?></td>
                                    <td><?php echo ($row['dscore']) ?></td>
                                        </tr>
                                
                            </tbody>
                            <?php } } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Student Interest -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Student Interest</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        </div>
        </div>        

                    <!-- Content Row -->
                   
            
    </di>
 </div>
        


    <?php 
        include('./inc/script.php'); 
        include('./inc/footer.php'); 
    ?>
    <script>
   var data = {
        labels: ["Science", "Arts", "Sports"],
        datasets: [{
            data: [55, 30, 15], // Example data, replace with your data
            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
            hoverBorderColor: "rgba(234, 236, 244, 1)"
        }]
    };

    // Configuration options
    var options = {
        maintainAspectRatio: false,
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
        },
        legend: {
            display: true,
            position: 'bottom',
        },
        cutoutPercentage: 0,
    };

    // Create the pie chart
    window.onload = function() {
        var ctx = document.getElementById("myPieChart").getContext('2d');
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: data,
            options: options
        });
    };
</script>