<?php
    include("database.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Login</title>
</head>
<body >
    <div style="display: flex; justify-content: space-around;">
        <form action="" method="POST" style="display:flex; flex-direction: column; width: 40%; gap: 20px;">
            <h2>Blog Register</h2>
            <input type="text" name="name" placeholder="name">
            <input type="email" name="email" placeholder="email">
            <input type="password" name="password" placeholder="password">
            <input type="submit" name="submit" value="Register">
        </form>
        <form action="" method="POST" style="display:flex; flex-direction: column; width: 40%; gap: 20px;">
            <h2>Blog Login</h2>
            <input type="email" name="email" placeholder="email">
            <input type="password" name="password" placeholder="password">
            <input type="submit" name="submit" value="Login">
        </form>
    </div>
</body>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $submit = $_POST["submit"];
        if($submit == "Register"){
            $name = filter_input(INPUT_POST,"name", FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST,"email", FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST,"password", FILTER_SANITIZE_SPECIAL_CHARS);
            $hash = password_hash($password, PASSWORD_DEFAULT);
    
            $query = "INSERT INTO users (name, email, password) VALUES ('{$name}','{$email}','{$hash}')";
    
            try{
                mysqli_query($conn, $query);
                echo "Registered successfully";
            } catch(mysqli_sql_exception){
                echo "Email taken";
            }
        } else {
            session_start();

            $email = filter_input(INPUT_POST,"email", FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST,"password", FILTER_SANITIZE_SPECIAL_CHARS);

            $query = "SELECT * FROM users WHERE email = '{$email}';";

            try{
                $result = mysqli_query($conn, $query);
                $row = mysqli_num_rows($result);
                if($row > 0){
                    $row = mysqli_fetch_assoc($result);
                    $hash = $row["password"];

                    if(password_verify($password, $hash)){

                        $_SESSION["user_id"] = $row["id"];
                        header("Location: home.php");
                        exit();
                    } else {
                        echo "Wrong password";
                    }

                } else {
                    echo "Wrong email";
                }
                
            }catch(mysqli_sql_exception){
                echo "Login error";
            }

        }

    }

    mysqli_close($conn);
    
?>
