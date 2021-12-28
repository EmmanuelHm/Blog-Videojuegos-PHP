<?php

if( isset($_POST) ){

    //INICIAR LA SESION Y LA CONEXION A LA BASE DE DATOS
    require_once 'includes/conexion.php';

    // Conseguir los datos que llegan del formulario
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;

    // Array de errores
    $errores = array();

    // Validar los datos antes de guardarlos en la base de datos
    
    // -----NOMBRE-----
    // Validar que no este vacío, no sea numerico, y no contenga números
    if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre) ) {
        $nombre_validado = true;
    }
    else{
        $nombre_validado = false;
        $errores['nombre'] = "El nombre no es valido.";
    }

    if(count($errores) == 0){
        // INSERTAR CATEGORÍA
        $sql = "INSERT INTO categorias VALUES(null, '$nombre');";
        $guardar = mysqli_query($db, $sql);
    }
}

// Regresar al Index
header('Location: index.php');