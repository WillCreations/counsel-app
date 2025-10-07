
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

                    
                               

                    <!-- Content Row -->
                   
            
                    </div>

             </div>
            
   

    <?php 
        include('./inc/script.php'); 
        include('./inc/footer.php'); 
          
    ?>