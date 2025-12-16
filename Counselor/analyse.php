<?php
session_start();
require_once '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
$student_id = clean($_POST['id']);



    try{

        $query = 'SELECT s.*, g.*, t.* FROM student s INNER JOIN grades g ON s.id = g.student_id INNER JOIN term t ON g.term_id = t.id  WHERE s.id = ? ORDER BY t.created_at DESC';
        $stmt = $conn->prepare($query);
        $stmt->execute([$student_id]);
        $array = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $_SESSION['student_name'] = $array[0]['dfname'];
        $_SESSION['student_id'] = $student_id;
        $_SESSION['analyse'] = $array;
        header('Location: stu_progress.php');
        exit;
        


    }catch(PDOException $e){
       echo $e->get_message();
    }
   


}