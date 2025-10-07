<?php
    $host = "localhost";
     $user = "root";
     $pass = "";
     $dbname = "akim_secondary_school";

    


    $conn=new mysqli("localhost","root","","akim_secondary_school");

    
    function clean($field){
        GLOBAL $conn;
        $data = trim($field);
        $data = htmlentities($data);
        $data = strip_tags($data);
       return $data;
    }

    function formQuery($data){
        GLOBAL $conn;
        return $conn->query($data);
    }
