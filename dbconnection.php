<?php
define(DB_SERVER, 'localhost');
define(DB_USER, 'root');
define(DB_PASSWORD, '');
define(DB_NAME, 'rns');

$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

if(mysqli_connect_errno()){
    echo "Failed to connect to database: ".mysqli_connect_errno();
}
?>

