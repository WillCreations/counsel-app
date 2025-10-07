<?php
session_start();
require_once '../config/config.php';

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Delete from the student table only
    $deleteResult = formQuery("DELETE FROM student WHERE userid='$userId'");

    if ($deleteResult) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "error"));
    }
} else {
    echo json_encode(array("status" => "error"));
}
?>
