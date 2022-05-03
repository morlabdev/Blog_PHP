<?php

//Conexión

$server = 'localhost';
$username = 'root';
$pass = '';
$database = 'blog_master';

$db = mysqli_connect($server, $username, $pass, $database);

mysqli_query($db, "SET NAMES 'utf8'");

//INICIAR LA SESIÓN
if (!isset($_SESSION)) {
  session_start();
}
