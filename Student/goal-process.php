<?php
require_once '../config/config.php';

session_start();
if (!isset($_SESSION['userid'])) {
    die('User not logged in');
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    $goal = clean($_POST['goal']);
    $start_date = clean($_POST['start_date']);
    $end_date = clean($_POST['end_date']);
    $progress = clean($_POST['progress']);
    $userid = $_SESSION['userid'];  // Get the user ID from the session

    // Server-side validation
    if (empty($goal) || empty($start_date) || empty($end_date) || empty($progress)) {
        echo "All fields are required.";
    } elseif (!is_numeric($progress) || $progress < 0 || $progress > 100) {
        echo "Progress must be a number between 0 and 100.";
    } else {
        $sql = formQuery("INSERT INTO goals SET dgoal='$goal', startDate='$start_date', endDate='$end_date', dprogress='$progress', userid='$userid'");
        if ($sql) {
            echo "Goal added successfully!";
            header("Location: monitor_goals.php");
            exit();
        } else {
            echo "Error: Could not execute the query.";
        }
    }
}
?>
