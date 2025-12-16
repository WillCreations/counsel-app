<?php
session_start(); 
require_once '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try{
     
        if(empty($_POST['date'])){
            $errDate = "Date is required!";
            $error = true;
        }else{
            $date = clean($_POST['date']);
        }
    
        if(empty($_POST['time'])){
            $errTime = "Time is required!";
            $error = true;
        }else{
            $time = clean($_POST['time']);
        }

        if(empty($_POST['appointment_status'])){
            $errAppoint = "Progress is required!";
            $error = true;
        }else{
            $appointment_status = clean($_POST['appointment_status']);
        }
        if(empty($_POST['notes'])){
            $errNotes = "Notes are required!";
            $error = true;
        }else{
            $notes = clean($_POST['notes']);
        }


        


        $appointmentId = clean($_POST['id']);
        $userid = $_SESSION['userid'];
        $appoitmentDate = $date. ' ' . $time;
        $query = "SELECT id FROM counselor WHERE userid = ? ";
        $stmt = $conn->prepare($query);
         $stmt->execute([$userid]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $fixerid = $result['id'];

        $query = "UPDATE appointment SET fixer_id = ?, appointment_date = ?, appointment_status = ?, notes = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $result = $stmt->execute([$fixerid, $appoitmentDate, $appointment_status, $notes, $appointmentId, ]);
        if ($result === TRUE) {
             header("Location: schedule.php");
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
