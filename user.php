<?php

session_start();

if(!isset($_SESSION["username"])){
    header("location: index.html");
}

echo "<h2>Welcome, ".$_SESSION["username"].".</h2>";
echo "<h2 style=''><a href='logout.php'>Logout</a></h2>"
?>