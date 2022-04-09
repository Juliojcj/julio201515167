<?php 
     include_once("conexion.php");
     $db= new db('localhost','root','','nuevo');
     if(isset($_POST['usuario'])){
        $strQuery=$db->query("SELECT u.id, u.usuario FROM usuarios as u  WHERE u.usuario='{$_POST['usuario']}' and u.contrasena={$_POST['contrasena']}");
        if($db->num_rows($strQuery) > 0){
            $usuario = $db->assoc($strQuery);
            header('Location: http://localhost/xampp/proyecto/ingresos.php');
            die();
        } 
        else {
            $strQueryUsuario=$db->query("SELECT id, usuario FROM usuarios   WHERE usuario='{$_POST['usuario']}'");
            if($db->num_rows($strQueryUsuario)){
                $usuario = $db->assoc($strQueryUsuario);
                $intentos = 1;
                $strQueryIntentos = $db->query("SELECT * FROM intentos WHERE usuario_id={$usuario['id']}");
                if($db->num_rows($strQueryIntentos)){
                    $usuarioIntentos = $db->assoc($strQueryIntentos);
                    if($usuarioIntentos['intentos'] < 3){
                        $intentos = $usuarioIntentos['intentos'] +1;
                        $db->query("UPDATE intentos SET intentos={$intentos} WHERE usuario_id={$usuario['id']}");
                        if($intentos == 3){
                            header('Location: http://localhost/xampp/proyecto/bloqueado.html');
                            die();
                        }
                    }
                    else {
                        header('Location: http://localhost/xampp/proyecto/bloqueado.html');
                        die();
                    }
                }
                else {
                    $db->query("INSERT INTO intentos (usuario_id, intentos) VALUES ({$usuario['id']}, {$intentos})");
                }
            }
            else {
                header('Location: http://localhost/xampp/proyecto/noExiste.html');
                die();
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title></title> 
	<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=3.0, minimum-scale=1.0">
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" >
	<link rel="stylesheet" href="estilos.css">
	

</head>  
<body>
    <form class="formulario" action="index.php" method="post">
    
    <h1>INGRESAR</h1>
     <div class="contenedor">
     
     
     
         
         <div class="input-contenedor">
         <i class="fas fa-envelope icon"></i>
         <input type="text" placeholder="Usuario" name="usuario">
         
         </div>
         
         <div class="input-contenedor">
        <i class="fas fa-key icon"></i>
         <input type="password" placeholder="Contraseña" name="contrasena">
         
         </div>
         <input type="submit" value="Ingresar" class="button">
         <p>Al registrarte, aceptas nuestras Condiciones de uso y Política de privacidad.</p>
     </div>
    </form>
</body>
</html>