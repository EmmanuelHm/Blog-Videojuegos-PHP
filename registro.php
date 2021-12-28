<?php

if(isset($_POST)){

    // Conexion a la base de datos
    require_once 'includes/conexion.php';
    // Iniciar sesión
    if(!isset($_SESSION)){
        session_start();
    }

    // Recoger los valores del formulario
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    $password = isset($_POST['pass']) ? mysqli_real_escape_string($db, $_POST['pass']) : false;
    // var_dump($_POST);

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
    // -----APELLIDOS-----
    // Validar que no este vacío, no sea numerico, y no contenga números
    if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos) ) {
        $apellidos_validado = true;
    }
    else{
        $apellidos_validado = false;
        $errores['apellidos'] = "Los apellidos no son validos.";
    }
    // -----EMAIL-----
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) ) {
        $email_validado = true;
    }
    else{
        $email_validado = false;
        $errores['email'] = "El email no es valido.";
    }
    // -----PASSWORD-----
    if (!empty($password) ) {
        $password_validado = true;
    }
    else{
        $password_validado = false;
        $errores['password'] = "La password no es valida.";
    }

    // Insertar en la base de datos solo si NO hay errores (array -> $errores)
    // var_dump($errores);

    $guardar_usuario = false;
    
    if( count($errores) == 0 ){
        $guardar_usuario = true;

        // Cifrar la contraseña
        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);
            // var_dump($password);
            // var_dump($password_segura);
            // Para decifrar una constraseña encriptada se usa -> password_verify($password, $password_segura)
            // die();

        // INSERTAR USUARIO EN LA BASE DE DATOS
        $sql = "INSERT INTO usuarios VALUES(null,'$nombre', '$apellidos', '$email', '$password_segura', CURDATE());";
        $guardar = mysqli_query($db, $sql);

        if($guardar){
            $_SESSION['completado'] = "El registro se ha completado con éxito";
        }
        else{
            $_SESSION['errores']['general'] = "Fallo al guardar el usuario";
        }


    }else{
        // Creamos una sesion de errores
        $_SESSION['errores'] = $errores;
    }
}

header('Location: index.php');