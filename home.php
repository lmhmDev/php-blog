<?php
    include("user_logged.php");
    include("database.php");

    $id = $_SESSION["user_id"];
    $query = "SELECT * FROM users WHERE id = '{$id}'";

    $name = "";

    try{

        $result = mysqli_query($conn, $query);
        
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $name = $row["name"];
        }

    } catch(mysqli_sql_exception) {
        echo "An error ocurred";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Home</title>
</head>
<body>
    <div style="display: flex; justify-content: space-between;align-items: center;">
        <h2>Blog Home</h2>
        <form action="logout.php" method="POST">
            <input type="submit" value="Logout">
        </form>
    </div>
    <form action="create_post.php" method="POST">
        <input type="text" name="content"> </textarea>
        <input type="submit">
    </form>
    <div>
        <?php
            include("posts_list.php")
        ?>
    </div>
</body>
</html>
