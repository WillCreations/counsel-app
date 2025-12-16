<?php

require_once '../config/config.php';

if ($_SERVER['REQUEST_METHOD']=="POST"){
    var_dump("post sequence fired");
    $error = false;
    
    if(empty($_POST['fname'])){
        $errFname = "Fullname is required!";
        $error = true;
    }else{
        $fullname = clean($_POST['fname']);
    }

    if(empty($_POST['username'])){
        $errUsername = "Username is required!";
        $error = true;
    }else{
        $username = strtolower(str_replace(' ', '', clean($_POST['username'])));

        $stmt = $conn->prepare('SELECT 1 FROM student WHERE duname = ? LIMIT 1');
        $stmt->execute([$username]);
        $exists = (bool) $stmt->fetchColumn();

        if ($exists) {
            $error = true;
            $errUsername = "Username already taken!";
            var_dump( $errUsername);
        }
    }
    
    if(empty($_POST['phone'])){
        $errPhone = "Phone number is required!";
        $error = true;
    }elseif(!is_numeric($_POST['phone'])){
        $errPhone = "Enter valid Phone number!";
        $error = true;
    }else{
        $phone = clean($_POST['phone']);
    }


    if(empty($_POST['email'])){
        $errEmail = "Email is required!";
        $error = true;
    }elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $errEmail = "Enter valid email address!";
        $error = true;
    }else{
        $email = clean($_POST['email']);

        
      $stmt = $conn->prepare('SELECT 1 FROM student WHERE demail = ? LIMIT 1');
        $stmt->execute([$email]);
        $exists = (bool) $stmt->fetchColumn();

        if ($exists) {
            $error = true;
            $errEmail = "Email already taken!";
            var_dump( $errEmail);
        }

         

    }

    if(empty($_POST['address'])){
        $errAddress = "Address is required!";
        $error = true;
    }else{
        $address = clean($_POST['address']);
    }

   
    $gender = clean($_POST['gender']);
    $day = clean($_POST['day']);
    $month = clean($_POST['month']);
    $year = clean($_POST['year']);
    $dob = sprintf('%04d-%02d-%02d', $year, $month, $day);
    $career_asp = clean($_POST['career_asp']);


    if(empty($_POST['pass'])){
        $errPass = "Password is required!";
        $error = true;
    }elseif(strlen($_POST['pass'])<3){
        $errPass = "Password is too short!";
        $error = true;
    }elseif(strlen($_POST['pass'])>20){ 
        $errPass = "Password is too long!";
        $error = true;
    }else{
        $pass = clean($_POST['pass']);
    }

    if(empty($_POST['cpass'])){
        $errCpass = "Confirm is required!";
        $error = true;
    }else{
        $cpass = clean($_POST['cpass']);
        if(empty($errPass) && ($pass != $cpass)){
            $errCpass = "Password doesn't match!";
            $error = true;
        }
    }
    
    
    // Profile picture validation
    if (!isset($_FILES['profilePic']) || $_FILES['profilePic']['error'] == UPLOAD_ERR_NO_FILE) {
        $errProfilePic = "Profile picture is required!";
        $error = true;
        var_dump("Profilepix Errors Check:", $errProfilePic); 
    } else {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES['profilePic']['type'], $allowedTypes)) {
            $errProfilePic = "Only JPG, PNG, and GIF files are allowed!";
            $error = true;
            var_dump("Profilepix Errors Check:", $errProfilePic); 
        } else {
            $profilePic = $_FILES['profilePic'];
            $profilePicPath = '../stu_uploads/' . basename($profilePic['name']);
            if (!move_uploaded_file($profilePic['tmp_name'], $profilePicPath)) {
                $errProfilePic = "Failed to upload profile picture!";
                $error = true;
                var_dump("Profilepix Errors Check:", $errProfilePic); 
            }
        }
    }

    

function generateUserId(PDO $conn, string $prefix = 'USR'): string {
    do {
        $bytes = random_bytes(16);
        // set version to 4 -- see RFC 4122
        $bytes[6] = chr((ord($bytes[6]) & 0x0f) | 0x40);
        // set variant to 10xx
        $bytes[8] = chr((ord($bytes[8]) & 0x3f) | 0x80);
        $hex = bin2hex($bytes);
        $uuid = sprintf('%s-%s-%s-%s-%s',
            substr($hex, 0, 8),
            substr($hex, 8, 4),
            substr($hex, 12, 4),
            substr($hex, 16, 4),
            substr($hex, 20, 12)
        );
        $userid = $prefix . '-' . $uuid;

        $stmt = $conn->prepare('SELECT 1 FROM student WHERE userid = ? LIMIT 1');
        $stmt->execute([$userid]);
        $exists = (bool) $stmt->fetchColumn();
    } while ($exists);

    return $userid;
}


    if($error == false){
        try {
       
        var_dump("Before database connect",$error); 
        
        $userid = date("Ymdhis");
        var_dump("date userid $userid");
        $userid = generateUserId($conn);
        var_dump("uuid userid $userid");
        var_dump("fired inside no error zone");
        
        
        
        $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
        
        var_dump( "dfname:$fullname", "duname:$username", "demail:$email", "dphone:$phone", "daddress:$address", "dgender:$gender", "ddob:$dob",  "dcareer:$career_asp", "dphoto:$profilePicPath", "dpass:$pass");
        var_dump("hashedPass", $hashedPass);

        $query = 'INSERT INTO student (userid, dfname, duname, demail, dphone, daddress, dgender, ddob, dcareer, dphoto, dpass) VALUES (:userid, :dfname, :duname, :demail, :dphone, :daddress, :dgender, :ddob, :dcareer, :dphoto, :dpass);';
        $insert = $conn->prepare($query);
        
        var_dump("connection", $conn);
        $insert->bindParam(":userid", $userid);
        $insert->bindParam(":dfname", $fullname);
        $insert->bindParam(":duname", $username);
        $insert->bindParam(":demail", $email);
        $insert->bindParam(":dphone", $phone);
        $insert->bindParam(":daddress", $address);
        $insert->bindParam(":dgender", $gender);
        $insert->bindParam(":ddob", $dob);
        $insert->bindParam(":dcareer", $career_asp);
        $insert->bindParam(":dphoto", $profilePicPath);
        $insert->bindParam(":dpass", $hashedPass);
        
      

        var_dump("insert value", $insert);
        $ok = $insert->execute();
        var_dump("insert execute", $insert);
        var_dump("executed", $ok);
        
        if($ok){
            var_dump("Success! User inserted.");
            header("Location: register.php");
            die();
        }

         } catch (PDOException $e) {
            var_dump("PDO Error: ", $e->getMessage());
            $error =true;
        }
    }


}



