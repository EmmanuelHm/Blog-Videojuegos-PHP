<?php

if( !isset($_SESSION) ){
    // Iniciar la sesion
    session_start();
}

if( !isset($_SESSION['usuario']) ){
    header('Location: index.php');
}