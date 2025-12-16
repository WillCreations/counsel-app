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

        $stmt = $conn->prepare('SELECT id FROM student WHERE userid = ? LIMIT 1');
        $stmt->execute([$userid]);
        $studentid = $stmt->fetch(PDO::FETCH_ASSOC)['id'];
        $query = "INSERT INTO goals (goal_title, start_date, end_date, progress, student_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $sql = $stmt->execute([$goal, $start_date, $end_date, $progress, $studentid]);
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
