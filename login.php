<?php

//INICIAR LA SESION Y LA CONEXION A LA BASE DE DATOS
require_once 'includes/conexion.php';

// Recoger datos del formulario
if(isset($_POST)){
    // Borrar error antiguo
    if(isset($_SESSION['error_login'])){
        unset($_SESSION['error_login']);
    }

    // Recoger datos del formulario
    $email = trim($_POST['email']);
    $password = $_POST['pass'];

    //Consulta para comprobar las credenciales del usuario
    $sql = "SELECT * FROM usuarios WHERE email = '$email';";
    $login = mysqli_query($db, $sql);

    if($login && mysqli_num_rows($login) == 1){
        // Convertir el resultado de la consulta a un objeto
        $usuario = mysqli_fetch_assoc($login);
        // Comprobar la contraseña / cifrar
         $verify = password_verify($password, $usuario['password']);

         if($verify){
            // Utilizar una sesion para guardar los datos del usuario logueado
            $_SESSION['usuario'] = $usuario;
            
         }else{
            // Si algo falla, enviar una sesion con el fallo
            $_SESSION['error_login'] = "Login incorrecto";
         }
    }else{
        // Mensaje de error
        $_SESSION['error_login'] = "Login incorrecto";
    }
}

// Redirigir al index
header('Location: index.php');