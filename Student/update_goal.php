<?php
session_start(); 
require_once '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try{
      if(empty($_POST['goal_title'])){
        $errGoalTitle = "Goal title is required!";
        $error = true;
    }else{
        $goalTitle = clean($_POST['goal_title']);
    }
      if(empty($_POST['start_date'])){
        $errStartDate = "Start date is required!";
        $error = true;
    }else{
        $startDate = clean($_POST['start_date']);
    }
        if(empty($_POST['start_date'])){
            $errStartDate = "Start date is required!";
            $error = true;
        }else{
            $startDate = clean($_POST['start_date']);
        }
        if(empty($_POST['end_date'])){
            $errEndDate = "End date is required!";
            $error = true;
        }else{
            $endDate = clean($_POST['end_date']);
        }
        if(empty($_POST['progress'])){
            $errProgress = "Progress is required!";
            $error = true;
        }else{
            $progress = clean($_POST['progress']);
        }
        if(empty($_POST['goal_status'])){
            $errGoalStatus = "Goal status is required!";
            $error = true;
        }else{
            $goalStatus = clean($_POST['goal_status']);
        }




        $goalId = clean($_POST['id']);
        $userid = $_SESSION['userid'];
        $query = "UPDATE goals SET goal_title= ?, start_date= ?, end_date= ?, goal_status= ?, progress= ? WHERE id= ? AND student_id = (SELECT id FROM student WHERE userid = ?)";
        $stmt = $conn->prepare($query);
        $result = $stmt->execute([$goalTitle, $startDate, $endDate, $goalStatus, $progress, $goalId, $userid]);
        if ($result === TRUE) {
             header("Location: monitor_goals.php");
            echo "Update successfully!";
        } else {
            echo "Oops! try again later";
        }
          } catch (PDOException $e) {
        error_log('PDO Error in update_appt.php: ' . $e->getMessage());
        echo "<div class='alert alert-danger'>Database error. Please try again later.</div>";
        var_dump($e->getMessage());
    } catch (Exception $e) {
        error_log('Error in update_appt.php: ' . $e->getMessage());
        echo "<div class='alert alert-danger'>" . htmlspecialchars($e->getMessage()) . "</div>";
    }
}
?>
