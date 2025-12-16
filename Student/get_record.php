<?php
session_start();
require_once '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {



 if(empty($_POST['term'])){
        $errTerm = "term number is required!";
        $error = true;
    }else{
        $term = clean($_POST['term']);
    }

    if(empty($_POST['year'])){
        $errYear = "year number is required!";
        $error = true;
    }else{
        $year = clean($_POST['year']);
    }




$query = "SELECT id FROM student WHERE userid = ? LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->execute([$_SESSION['userid']]);
$srow = $stmt->fetch(PDO::FETCH_ASSOC);
$studentRowId = $srow['id'];
$query = "SELECT t.*, g.* FROM term t INNER JOIN grades g ON t.id = g.term_id WHERE g.student_id = ? AND t.year = ? AND t.term_title = ? ORDER BY g.grade_subject ASC"; 
$stmt = $conn->prepare($query);
$stmt->execute([$studentRowId, $year, $term]);
$records = $stmt->fetchALL(PDO::FETCH_ASSOC);

$_SESSION['records'] = $records;
header("Location: records.php");
}