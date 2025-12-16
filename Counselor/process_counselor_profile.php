<?php
session_start();
require_once '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $error = false;

    
    if ($error == false) {
        // Expecting JSON string in 'crow' containing the counselor row
        $raw = $_POST['crow'];
        $decoded = json_decode($raw, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            // sanitize values minimally (escape handled on output)
            unset($_SESSION['counselor_profile_view']);
            $_SESSION['counselor_profile_view'] = $decoded;
            header("Location: profile.php");
            exit;
        } else {
            // If decoding failed, redirect with an error (or fallback)
            header("Location: counselor_profile.php?error=invalid_data");
            exit;
        }

    }
}
?>
