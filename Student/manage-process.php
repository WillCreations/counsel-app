<?php
session_start();
require_once '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $counselorid = clean($_POST['counselor_id']);
    $date = clean($_POST['date']);
    $time = clean($_POST['time']);
    $notes = clean($_POST['notes']);
    $userid = $_SESSION['userid'];

    var_dump("User Session id:" . $userid);
    var_dump("counselorid Session id:" . $counselorid);
    
    try {
        // First, get the actual student.id from the userid
        $stmt = $conn->prepare('SELECT id FROM student WHERE userid = ? LIMIT 1');
        $stmt->execute([$userid]);
        $studentRow = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$studentRow) {
            throw new Exception('Student not found');
        }
        $studentid = $studentRow['id'];
        
        // Insert appointment with correct column names and no quotes around placeholders
        $query = "INSERT INTO appointment (student_id, counselor_id,fixer_id, appointment_date, appointment_status, notes) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        
        $appointmentDate = $date . ' ' . $time;
        $appointmentStatus = 'Pending';
        
        $sql = $stmt->execute([$studentid, $counselorid, $studentid, $appointmentDate, $appointmentStatus, $notes]);

        if ($sql) {
            header("Location: manage_appt.php");
            exit;
        } else {
            throw new Exception('Failed to insert appointment');
        }

    } catch (PDOException $e) {
        var_dump("PDO Error: ", $e->getMessage());
    } catch (Exception $e) {
        var_dump("Error: ", $e->getMessage());
    }
}
?>
