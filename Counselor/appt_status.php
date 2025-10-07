<?php
session_start(); 
require_once '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['complete'])) {
        $id = $_POST['id'];
        $sql = "UPDATE studentappointment SET dstatus='Completed' WHERE id='$id'";
        if (formQuery($sql)) {
            header("Location: history.php");
        } else {
            echo "Error: " . $sql->error;
        }
    }

    if (isset($_POST['cancel'])) {
        $id = $_POST['id'];
        $sql = "UPDATE studentappointment SET dstatus='Cancelled' WHERE id='$id'";
        if (formQuery($sql)) {
            header("Location: history.php");
        } else {
            echo "Error: " . $sql->error;
        }
    }
}
?>