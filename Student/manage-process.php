<?php
require_once '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $fullname = clean($_POST['name']);
    $date = clean($_POST['date']);
    $time = clean($_POST['time']);

    $sql = formQuery("INSERT INTO studentappointment SET dfname='$fullname', ddate='$date', dtime='$time', dstatus=''");
    if ($sql) {
        header("Location: manage_appt.php");
        echo "Successful!";
    } else {
        echo "Error: Could not execute the query.";
    }
}
?>
