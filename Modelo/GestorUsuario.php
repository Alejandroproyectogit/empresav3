<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'Vista/lib/PHPMailer/src/Exception.php';
require 'Vista/lib/PHPMailer/src/PHPMailer.php';
require 'Vista/lib/PHPMailer/src/SMTP.php';

class GestorUsuario
{
    public function busqueda(Usuario $usuario)
    {
        $conexion = new Conexion();
        $enlace_conexion = $conexion->abrir();
        $user_sql = $usuario->obtenerUsuario();
        $password = $usuario->obtenerContraseña();
        $sql = $enlace_conexion->prepare("SELECT * FROM usuarios WHERE usu_usuario=:user_sql;");
        $sql->bindParam(":user_sql", $user_sql, PDO::PARAM_STR);
        $conexion->consulta($sql,1);
        $resultado = $conexion->obtenerResultado();
        $conexion->cerrar();
        
        $correcto=false;
        if ($resultado) {
            if ($resultado["usu_usuario"] == $user_sql and password_verify($password,$resultado["usu_contrasena"])) {
                $_SESSION['usuario']=$resultado["usu_usuario"];
            }
        } 
        
    }
 

    public function generarCodigo($length){
        $codigoCorrecto=false;
        while($codigoCorrecto==false){
        $datos="abcdefghjkmnopqrstuvwxyzABCDEFGHJKMNOPQRSTUVWXYZ1234567890";
        $codigo=str_shuffle($datos);
        $codigo=substr($codigo,0,$length);
        if(preg_match('/^[0-9a-zA-Z]+$/', $codigo)){
            $codigoCorrecto=true;
            return $codigo;
        }
        }
    }
    public function existenciaCorreo($correo)
    {
        $conexion = new Conexion();
        $enlace_conexion = $conexion->abrir();
        $sql = $enlace_conexion->prepare("SELECT * FROM usuarios WHERE usu_correo=:correo_sql and usu_estado = 1;");
        $sql->bindParam("correo_sql", $correo, PDO::PARAM_STR);
        $conexion->consulta($sql,1);
        $resultado = $conexion->obtenerResultado();
        $conexion->cerrar();
        if ($resultado) {
            if ($resultado["usu_correo"] == $correo and $resultado["usu_estado"] == 1) {
                $resultado=true;
                return $resultado;
            }else{
                $resultado=false;
                return $resultado;
            }
            
        } 
        
    }
    public function actualizarContraseña($correo,$contraseñaSegura){
        $conexion = new Conexion();
        $enlace_conexion = $conexion->abrir();
        $sql = $enlace_conexion->prepare("UPDATE usuarios SET usu_contrasena=:contrasena_sql WHERE usu_correo=:correo_sql and usu_estado = 1;");
        $sql->bindParam("correo_sql", $correo, PDO::PARAM_STR);
        $sql->bindParam("contrasena_sql", $contraseñaSegura, PDO::PARAM_STR);
        $resultado=$conexion->consulta($sql,0);
        $conexion->cerrar();
        return $resultado;
    }
 
    public function enviarCorreo($correo,$codigo){
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'servicioSaborT@gmail.com';                     //SMTP username
            $mail->Password   = 'tdoftcaotoknfoag';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('servicioSaborT@gmail.com', 'Atencion Sabor Tolimense');
            $mail->addAddress($correo, 'Usuario del Sistema');     //Add a recipient


            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Recuperacion de contraseña';
            $mail->Body    = 'Hola, recientemente nos ha llegado una solicitud para un restablecimiento de contraseña.<br>
            Utiliza el siguiente codigo:  <b>'. $codigo .'</b><br>
            <p>Si no has sido tú, contactate al siguiente correo servicioSaborT@gmail.com</p>';
            

            $mail->send();
            $_SESSION['exito']="Mensaje enviado con éxito";
            $_SESSION['enviado']=time();
            $_SESSION['tiempo']=time();
            
        } catch (Exception $e) {
            $_SESSION['mensaje']="El mensaje no se pudo enviar";
        }
    }
}