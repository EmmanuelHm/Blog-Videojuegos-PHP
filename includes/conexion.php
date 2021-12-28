<?php
// Conexion
$servidor = "localhost";
$usuario = "root";
$password = "";
$basededatos = "blog_master";

$db = mysqli_connect($servidor, $usuario, $password, $basededatos);

// Configuración de caracteres
mysqli_query($db, "SET NAMES 'utf8'");

if( !isset($_SESSION) ){
    // Iniciar la sesion
    session_start();
}