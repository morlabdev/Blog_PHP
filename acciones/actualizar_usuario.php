<?php

if(isset($_POST)){
  // Conexión a la BBDD
    require_once '../includes/conexion.php';

    //Recoger los datos del formulario actualización evitando injeccion SQL

    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;

    // Array de errores
    $errores = array();

    //VALIDAR LOS DATOS ANTES DE GUARDAR EN BBDD
    //VALIDAR CAMPO NOMBRE
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
        $nombre_validado = true;
    }else{
        $nombre_validado = false;
        $errores['nombre'] = "El nombre no es válido";
    }

    //VALIDAR CAMPO APELLIDOS
    if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)){
        $apellidos_validado = true;
    }else{
        $apellidos_validado = false;
        $errores['apellidos'] = "Los apellidos no son válidos";
    }

    //VALIDAR CAMPO EMAIL
    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_validado = true;
    }else{
        $email_validado = false;
        $errores['email'] = "Email no válido";
    }

    $guardar_usuario = false;
    if(count($errores) === 0){
      $usuario = $_SESSION['usuario'];
      $guardar_usuario = true;

      // Comprobar si el email existe
      $sql = "SELECT id, email FROM usuarios WHERE email = '$email'";
      $isset_email = mysqli_query($db, $sql);
      $isset_user = mysqli_fetch_assoc($isset_email);

      if($isset_user['id'] == $_SESSION['usuario'] || empty($isset_user)){
        //ACTUALIZAR USUARIO EN LA BBDD
        $usuario = $_SESSION['usuario'];
        $sql = "UPDATE usuarios SET ".
                "nombre = '$nombre', ".
                "apellidos = '$apellidos', ".
                "email = '$email' ".
                "WHERE id = ".$usuario['id'];

        $guardar = mysqli_query($db, $sql);

        if($guardar){
          $_SESSION['usuario']['nombre'] = $nombre;
          $_SESSION['usuario']['apellidos'] = $apellidos;
          $_SESSION['usuario']['email'] = $email;

          $_SESSION['completado'] = "Usuario actualizado con éxito";
        }else{
          $_SESSION['errores']['general'] = "Fallo al actualizar el usuario!!";
        }
      }else {
        $_SESSION['errores']['general'] = "Usuario ya registrado";
      }
    }else{
        $_SESSION['errores'] = $errores;

    }
}

header('Location: ../mis_datos.php');
