<?php

define($host, "localhost");
define($username, "root");
define($password, "");
define($db, "test");

$con = mysqli_connect($host, $username, $password, $db);

if(!$con){
    echo "Error".mysqli_error();
    return;
}

?>