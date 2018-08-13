<?php
include("conn.php");

// Request method == POST
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Submit is set
    if(isset($_POST["submit"])){
        // Username and password is set
        if(isset($_POST["username"]) && isset($_POST["password"])){
            // Prevent empty fields
            if(empty($_POST["username"]) || empty($_POST["password"])){
                echo "Empty fields!";
                return;
            }
            // Prevent mysql injection + password hash
            $username = mysqli_real_escape_string($con, $_POST["username"]);
            $password = md5(mysqli_real_escape_string($con, $_POST["password"]));

            // Use prepared statement
            $stmt = $con->prepare("SELECT username, password FROM users WHERE username=? AND password=?");

            // Bind parameters
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute(); // Execute query

            // Bind result
            $stmt->bind_result($username, $password);
            $stmt->store_result();

            // Returned rows not null
            if($stmt->num_rows == 1){
                while($stmt->fetch()){ // Fetching content of the row
                    session_start();

                    $_SESSION["username"] = $username;

                    echo "Successfully login!";
                    header("location: user.php");
                    exit();
                }
            }else{
                echo "Bad username or password!";
                return;
            }
            $stmt->close();
        }else{
            header("location: index.html");
        }
    }else{
        header("location: index.html");
    }
}else{
    header("location: index.html");
}


?>