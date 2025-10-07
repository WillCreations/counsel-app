<?php
session_start(); 
require_once '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    

    if (isset($_POST['cancel'])) {
        $id = $_POST['id'];
        $sql = "UPDATE appointment SET dstatus='Cancelled' WHERE id='$id'";
        if (formQuery($sql)) {
            header("Location: manage_appt.php");
        } else {
            echo "Error: " . $sql->error;
        }
    }
}
?>
