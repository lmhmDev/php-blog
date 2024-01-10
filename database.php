<?php
    $server = "localhost";
    $user = "root";
    $pass = "";
    $db_name = "blog";
    $conn = "";

    try {
        $conn = mysqli_connect($server,$user,$pass,$db_name);
    } catch(mysqli_sql_exception){
        echo "Error connecting to DB";
    }


?>
