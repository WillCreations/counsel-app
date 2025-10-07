<?php
session_start();
require_once '../config/config.php';

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id']) && isset($_GET['type'])) {
    $userId = $_GET['id'];
    $type = $_GET['type'];

    if ($type === 'admin') {
        $deleteResult = formQuery("DELETE FROM admintable WHERE userid='$userId'");
    } elseif ($type === 'user') {
        $deleteResult = formQuery("DELETE FROM user WHERE userid='$userId'");
    } else {
        echo json_encode(array("status" => "error"));
        exit;
    }

    if ($deleteResult) {
        echo json_encode(array("status" => "success"));
        exit;
    } else {
        echo json_encode(array("status" => "error"));
        exit;
    }
} else {
    echo json_encode(array("status" => "error"));
    exit;
}
?>
