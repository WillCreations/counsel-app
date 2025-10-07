<?php
session_start();
require_once '../config/config.php';

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id']) && isset($_GET['table'])) {
    $Id = $_GET['id'];
    $table = $_GET['table'];
    $allowedTables = ['appointment', 'studentappointment'];

    if (in_array($table, $allowedTables)) {
        $deleteResult = formQuery("DELETE FROM $table WHERE id='$Id'");
        if ($deleteResult) {
            if ($table == 'appointment') {
                header("Location: schedule.php");
            } elseif ($table == 'studentappointment') {
                header("Location: history.php");
            }
        } else {
            echo "Error deleting record: " . mysqli_error($deleteResult);
        }
    } else {
        echo "Invalid table specified.";
    }
} else {
    echo "Required parameters not provided.";
}
?>

