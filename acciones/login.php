<?php
// INICIAR LA SESION Y LA CONEXION A BD
require_once '../includes/conexion.php';

// RECOGER LOS DATOS DEL FORMULARIO
if(isset($_POST)){
    // Limpiar errores antiguos
    if (isset($_SESSION['error_login'])) {
        session_unset($_SESSION['error_login']);
    }

    // Recojer datos
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // CONSULTA COMPROBAR USUARIO
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $login = mysqli_query($db, $sql);

    if($login && mysqli_num_rows($login) == 1){
        $usuario = mysqli_fetch_assoc($login);

        //COMPROBAR COMTRASEÑA
        $verify = password_verify($password, $usuario['password']);

        if($verify){
            // Utilizar sesión para guardar los datos del usuario logueado
            $_SESSION['usuario'] = $usuario;

        }else{
            // Si algo falla enviar una sesión con el fallo
            $_SESSION['error_login'] = "Login incorrecto!!";
        }
    }else{
        // Mensaje de error
        $_SESSION['error_login'] = "Login incorrecto!!";
    }

}

// REDIRIGIR AL INDEX
header('Location: ../index.php');
