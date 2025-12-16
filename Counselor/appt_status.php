<?php
session_start(); 
require_once '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['complete'])) {

        try{


        $id = $_POST['id'];
        $query = "UPDATE studentappointment SET dstatus='Completed' WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            header("Location: history.php");
        }
        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
        }
       
    }

    if (isset($_POST['cancel'])) {
        try{
        $id = $_POST['id'];
        $query = "UPDATE studentappointment SET dstatus='Cancelled' WHERE id='$id'";
        $stmt = $conn->prepare($query);
        $stmt ->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
          if ($result) {
            header("Location: history.php");
        }
        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
        }
       
    
    }
}
?>