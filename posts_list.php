<?php
    include("database.php");

    $query = "SELECT * FROM posts";

    try{
        $result = mysqli_query($conn, $query);
    
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $user_query = "SELECT * FROM users WHERE id = {$row["user_id"]}";

                $user_result = mysqli_query($conn,$user_query);

                $user = mysqli_fetch_assoc($user_result);
                echo "<div style='display:flex;justify-content:space-between;'><p>{$row["content"]}</p> <p>by:{$user["name"]}</p></div><hr>";
            }
        } else {
            echo "No posts yet";
        }
    } catch(mysqli_sql_exception){
        echo "Error retrieving posts";
    }

    mysqli_close($conn)
?>
