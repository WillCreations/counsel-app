<?php
session_start();
require_once '../config/config.php';

if ($_SERVER['REQUEST_METHOD']=="POST"){
   
    $error = false;
    
    if(empty($_POST['subject'])){
        $errSubject = "Subject is required!";
        $error = true;
    }else{
        $subject = clean($_POST['subject']);
    }


    if(empty($_POST['score'])){
        $errScore = "score is required!";
        $error = true;
    }elseif(!is_numeric($_POST['score'])){
        $errScore = "Enter valid score number!";
        $error = true;
       
    }else{
        $score = clean($_POST['score']);
    }
            

   
    
   

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


    
    if($error == false){
        try {
       
        
            switch($score){
                case ($score >=80):
                    $grade="A";
                    break;
                case ($score >=60):
                    $grade="B";
                    break;
                case ($score >=50):
                    $grade="C";
                    break;
                case ($score >=45):
                    $grade="D";
                    break;
                default:
                    $grade="F";
            }
  
        
            var_dump( "subject:$subject", "grade:$grade", "score:$score", "term:$term", "year:$year");
            $query = "SELECT id FROM term WHERE year = ? AND term_title = ? LIMIT 1";
            $stmt = $conn->prepare($query);
            $stmt->execute([$year, $term]);
            $trow = $stmt->fetch(PDO::FETCH_ASSOC);
            $termRowId = $trow['id'];
            $period = "";
            
            if(!$termRowId){
                // Insert new term if not exists
                
                switch($term){
                case "First":
                    $period="September - December";
                    break;
                case "Second":
                    $period="January - April";
                    break;
                case "Third":
                    $period="April - July";
                    break;
                default:
                    $period="";
                }

                var_dump("Period:`$period`");
                $insertTermQuery = "INSERT INTO term (year, term_title, period) VALUES (?, ?, ?)";
                $insertTermStmt = $conn->prepare($insertTermQuery);
                $insertTermStmt->execute([$year, $term, $period]);
                $termRowId = $conn->lastInsertId();
            }

            $query = 'INSERT INTO grades (student_id, term_id, grade_subject, grade, score) VALUES (?,?,?,?,?);';
            $insert = $conn->prepare($query);
            
                $_SESSION['userid'];
                $stmt = $conn->prepare('SELECT id FROM student WHERE userid = ? LIMIT 1');
                $stmt->execute([$_SESSION['userid']]);
                $srow = $stmt->fetch(PDO::FETCH_ASSOC);
                $studentRowId = $srow['id'];
            var_dump("studentRowId:`$studentRowId`","termRowId:`$termRowId`","subject:`$subject`","grade:`$grade`","score:`$score`");

            $checkExistingQuery = "SELECT 1 FROM grades WHERE student_id = ? AND term_id = ? AND grade_subject = ? LIMIT 1";
            $checkStmt = $conn->prepare($checkExistingQuery);
            $checkStmt->execute([$studentRowId, $termRowId, $subject]);
            $exists = (bool) $checkStmt->fetchColumn();
            if ($exists) {
                throw new Exception('Record for this subject and term already exists.');
            }

            $ok = $insert->execute([$studentRowId, $termRowId, $subject, $grade, $score]);
            
            var_dump("executed", $ok);
            
            if($ok){
                var_dump("Success! User inserted.");
                $_SESSION['record_success'] = "Record added successfully.";
                $query = "SELECT t.*, g.* FROM term t INNER JOIN grades g ON t.id = g.term_id WHERE g.student_id = ? AND t.year = ? AND t.term_title = ? ORDER BY g.grade_subject ASC"; 
                $stmt = $conn->prepare($query);
                $stmt->execute([$studentRowId, $year, $term]);
                $records = $stmt->fetchALL(PDO::FETCH_ASSOC);
                $_SESSION['records'] = $records;
                header("Location: records.php");
                die();
            }

         } catch (PDOException $e) {
            var_dump("PDO Error: ", $e->getMessage());
            $_SESSION['record_error'] = $e->getMessage();
            $error =true;
            header("Location: records.php");
        } catch (Exception $e) {
            var_dump("Error: ", $e->getMessage());
            $_SESSION['record_error'] = $e->getMessage();
            $error =true;
             header("Location: records.php");
        }
    }else{
        
    var_dump("subject:$subject",  "score:$score", "term:$term", "year:$year");
        $_SESSION['record_error'] = "Enter all fields";
        header("Location: records.php");
    }


}



