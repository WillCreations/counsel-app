<?php
session_start();
require_once '../config/config.php';

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id']) && isset($_GET['table'])) {
    $Id = $_GET['id'];
    
    
        try{
        $deleteResult = $conn->prepare("DELETE FROM appointment WHERE id = ?");
        $result = $deleteResult->execute([$Id]);
        if ($result) {
            
                header("Location: manage_appt.php");
                exit;
        }
        } catch (PDOException $e) {
            echo "Error deleting record: " . $e->getMessage();
        }
   
} else {
    echo "Required parameters not provided.";
}

?>

