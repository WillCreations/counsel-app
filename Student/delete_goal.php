<?php
session_start();
require_once '../config/config.php';

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $Id = $_GET['id'];

    $deleteResult = formQuery("DELETE FROM goals WHERE id='$Id'");
    if ($deleteResult) {
        header("Location: monitor_goals.php");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "Required parameters not provided.";
}
?>
