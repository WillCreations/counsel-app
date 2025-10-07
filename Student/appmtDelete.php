<?php
session_start();
require_once '../config/config.php';

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $Id = $_GET['id'];

    $deleteResult = formQuery("DELETE FROM appointment WHERE id='$Id'");
    if ($deleteResult) {
        header("Location: schedule.php");
    } else {
        echo "Error deleting record: " . $deleteResult->error;
    }
}
?>
