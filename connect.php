<?php
$host="localhost";
$user="root";
$pass="root";
$database="tourdb";
$connection=mysqli_connect($host,$user,$pass)
or die("Couldn't connect to database");
mysqli_select_db($connection,$database);
?>