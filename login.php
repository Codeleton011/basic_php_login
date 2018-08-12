<?php
include("con.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["submit"])){
        if(isset($_POST["username"]) && isset($_POST["password"])){
            if(empty($_POST["username"]) || empty($_POST["password"])){
                echo "Empty fields!";
                return;
            }

            $username = mysqli_real_escape_string($con, $_POST["username"]);
            $password = md5(mysqli_real_escape_string($con, $_POST["password"]));

            $stmt = mysqli_prepared($con, "SELECT username, password from users WHERE username=? and password=?");

            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();

            $stmt->bind_result();
            $stmt->store_result();

            if($stmt->num_rows == 1){
                while($stmt->fetch()){
                    session_start();

                    $_SESSION["username"] = $username;

                    echo "Successfully login!";

                    exit();
                }
            }else{
                echo "Bad username or password!";
                return;
            }
        }
    }
}

?>