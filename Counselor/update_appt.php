<?php
session_start(); 
require_once '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        // Validate appointment ID
        if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
            throw new Exception('Invalid appointment ID.');
        }
        
        $id = (int) $_POST['id'];
        
        if (isset($_POST['complete'])) {
            // Update appointment status to Completed
            $status = 'Completed';
            $query = "UPDATE appointment SET appointment_status = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->execute([$status, $id]);
            
            if ($stmt->rowCount() > 0) {
                header("Location: schedule.php");
                exit;
            } else {
                throw new Exception('No appointment found with that ID or no changes made.');
            }
        }

        if (isset($_POST['cancel'])) {
            // Update appointment status to Cancelled
            $status = 'Cancelled';
            $query = "UPDATE appointment SET appointment_status = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->execute([$status, $id]);
            
            if ($stmt->rowCount() > 0) {
                header("Location: schedule.php");
                exit;
            } else {
                throw new Exception('No appointment found with that ID or no changes made.');
            }
        }
        if (isset($_POST['confirm'])) {
            // Update appointment status to Cancelled
            $status = 'Confirmed';
            $query = "UPDATE appointment SET appointment_status = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->execute([$status, $id]);
            
            if ($stmt->rowCount() > 0) {
                header("Location: schedule.php");
                exit;
            } else {
                throw new Exception('No appointment found with that ID or no changes made.');
            }
        }

    } catch (PDOException $e) {
        error_log('PDO Error in update_appt.php: ' . $e->getMessage());
        echo "<div class='alert alert-danger'>Database error. Please try again later.</div>";
    } catch (Exception $e) {
        error_log('Error in update_appt.php: ' . $e->getMessage());
        echo "<div class='alert alert-danger'>" . htmlspecialchars($e->getMessage()) . "</div>";
    }
}
?>
