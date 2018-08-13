<?php

session_start();

if(!isset($_SESSION["username"])){
    header("location: index.html");
}

session_unset();
session_destroy();

echo "Logging out...";
header("location: index.html");

?>