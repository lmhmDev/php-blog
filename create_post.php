<?php
    include("database.php");
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $content = $_POST["content"];

        if(empty($content)){
            echo "Type content";
        } else {
            $user_id = $_SESSION["user_id"];
            $query = "INSERT INTO posts (content, user_id) VALUES ('{$content}','$user_id');";

            try{
                mysqli_query($conn, $query);
                header("Location: home.php");
                exit();
            }catch(mysqli_sql_exception) {
                echo "Error creating post";
            }
        }
    }
    mysqli_close($conn);
?>
