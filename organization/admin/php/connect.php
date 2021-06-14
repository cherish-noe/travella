<?php
$host="localhost";
$user="root";
$pass="root";
$database="tourdb";
$connection=mysql_connect($host,$user,$pass)
or die("Couldn't connect to database");
mysql_select_db($database);
?>