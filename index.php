<?php
require_once "configuracion.php";
session_start();
require_once 'Controlador/Controlador.php';
require_once 'Modelo/Usuario.php';
require_once 'Modelo/GestorProveedor.php';
require_once 'Modelo/GestorProducto.php';
require_once 'Modelo/GestorUsuario.php';
require_once 'Modelo/GestorTrabajador.php';
require_once 'Modelo/GestorCliente.php';
require_once 'Modelo/GestorPedido.php';
require_once 'Modelo/Cliente.php';
require_once 'Modelo/Conexion.php';
require_once 'Modelo/Entradas.php';
require_once 'Modelo/Pedido.php';
require_once 'Modelo/Producto.php';
require_once 'Modelo/Proveedor.php';
require_once 'Modelo/Trabajador.php';
require_once 'Modelo/Producto.php';

$controlador = new Controlador();
$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : 1;
if (isset($_GET["accion"])) {
    if ($_GET["accion"] == "verificar") {
        $usuario = $_POST["usuario"];
        $contraseña = $_POST["contraseña"];
        if (empty($usuario) || empty($contraseña)) {
            $_SESSION['mensaje'] = "El usuario y la contraseña son requeridos.";
            $controlador->verPagina('Vista/html/login.php');
            exit();
        } elseif(!empty($usuario) && !empty($contraseña)){
            $resultado=$controlador->limpiezaLogin($usuario,$contraseña);

        }if($resultado==true){
            $controlador->verificar(
                $_POST["usuario"],
                $_POST["contraseña"]
            );
            if (isset($_SESSION['usuario'])) {
                $controlador->verPagina('Vista/html/principal.php');
                
            } else{
                 $_SESSION["mensaje"]="Las credenciales son incorrectas";
                $controlador->verPagina('Vista/html/login.php');
                exit();
            } 
        }elseif($resultado==false){
            $_SESSION['mensaje'] = "No se aceptan caracteres especiales.";
            $controlador->verPagina('Vista/html/login.php');
            exit();

        }
            
    }
    if ($_GET["accion"] == "principal") {
        if(isset($_SESSION["usuario"])){
            $controlador->verPagina('Vista/html/principal.php');
        }else{
            $_SESSION["mensaje"]="No ha iniciado sesion";
            $controlador->verPagina("Vista/html/login.php");
        }
        
    } elseif ($_GET["accion"] == "login") {
        $controlador->verPagina('Vista/html/login.php');
    } elseif ($_GET["accion"] == "trabajadores") {
        $controlador->verPaginaTrabajadores($filtro);
    } elseif ($_GET["accion"] == "clientes") {
        $controlador->listarCliente();
    } elseif ($_GET["accion"] == "pedidos") {
        $controlador->listarPedidos();
    } elseif ($_GET["accion"] == "entradas") {
        $controlador->verPagina('Vista/html/entradas.php');
    } elseif ($_GET["accion"] == "productos") {
        $controlador->obtenerDatosProductos();
    }  elseif ($_GET["accion"] == "gestion") {
        $controlador->verPagina('Vista/html/gestion.php');
    } elseif ($_GET["accion"] == "ingresarCliente") {
        $controlador->agregarCliente(
            null,
            $_POST["CliNombre"],
            $_POST["CliTelefono"],
            $_POST["CliDireccion"]
        );
    } elseif ($_GET["accion"] == "editarCliente") {
        $id = $_POST["id"] ?? "";
        $nuevoNombre = $_POST["nuevoNombre"] ?? "";
        $nuevoTelefono = $_POST["nuevoTelefono"] ?? "";
        $nuevoDireccion = $_POST["nuevoDireccion"] ?? "";

        if (empty($id) || empty($nuevoNombre) || empty($nuevoTelefono) || empty($nuevoDireccion)) {
            echo "<script>alert('Todos Los Campos Tienen Que Estar Llenos'); window.history.back();</script>";
        } else {
            $controlador->editarClientes($id, $nuevoNombre, $nuevoTelefono, $nuevoDireccion);
        }
    } elseif ($_GET["accion"] == "ingresarPedido") {
        $controlador->agregarPedido(
            null,
            $_POST['PedCliente'],
            $_POST['PedReceta'],
            $_POST['PedPaquetes'],
            $_POST['PedFecha'],
            $_POST['PedValor'],
            $_POST['PedEstado']
        );
    } elseif ($_GET["accion"] == "editarPedido") {
        $id = $_POST["id"] ?? "";
        $paquetes = $_POST["paquetes"] ?? "";
        $valor = $_POST["valor"] ?? "";
        $estado = $_POST["estado"] ?? "";

        if (empty($id) || empty($paquetes) || empty($valor) || empty($estado)) {
            echo "<script>alert('Todos los campos tienen que estar llenos'); window.history.back();</script>";
        } else {
            // Llama al método correspondiente del controlador para editar el pedido
            $controlador->editarPedidos($id, $paquetes, $valor, $estado);
        }
    } elseif ($_GET["accion"] == "actualizarUsuario") {
        $id = $_POST['usu_id'];
        $nombrec = $_POST['Upnombre'];
        $correo = $_POST['Upcorreo'];
        $telefono = $_POST['Uptelefono'];
        $usuario = $_POST['Upusuario'];
        $usuario_cargo = $_POST['Upcargo'];
        $usuarioEstado = $_POST['Upestado'];

        $controlador->actualizarUsuario($id, $nombrec, $correo, $telefono, $usuario, $usuario_cargo, $usuarioEstado);
    }   
    if ($_GET["accion"] == "verificar") {
        $usuario = $_POST["usuario"];
        $contraseña = $_POST["contraseña"];
        if (empty($usuario) || empty($contraseña)) {
            $_SESSION['mensaje'] = "El usuario y la contraseña son requeridos.";
            $controlador->verPagina('Vista/html/login.php');
            exit();
        } elseif(!empty($usuario) && !empty($contraseña)){
            $resultado=$controlador->limpiezaLogin($usuario,$contraseña);

        }if($resultado==true){
            $controlador->verificar(
                $_POST["usuario"],
                $_POST["contraseña"]
            );
            if (isset($_SESSION['usuario'])) {
                $controlador->verPagina('Vista/html/principal.php');
                
            } elseif (isset($_SESSION['mensaje'])) {
                 
                $controlador->verPagina('Vista/html/login.php');
                exit();
            } 
        }elseif($resultado==false){
            $_SESSION['mensaje'] = "No se aceptan caracteres especiales.";
            $controlador->verPagina('Vista/html/login.php');
            exit();

        }
            
    }


    if ($_GET["accion"] == "recuperar") {
      
        if (empty($_POST["correo"])) {
            $_SESSION['mensaje'] = "El campo no debe estar vacio";
            $controlador->verPagina('Vista/html/recuperarCuenta.php');
        } elseif (!empty($_POST["correo"])) {
            $correo = $_POST["correo"];
            if(preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',$correo)){
            $codigo=$controlador->generarCodigo();
            $controlador->recordarContraseña($correo,$codigo);
            $_SESSION['codigo']=$codigo;
            $_SESSION['correo']=$correo;
            
            $controlador->verPagina('Vista/html/recuperarCuenta.php');
            exit();
          
        }else{
            $_SESSION['mensaje']="Faltan datos o contiene caracteres especiales";
            $controlador->verPagina('Vista/html/recuperarCuenta.php');

        }
        }
    }
    if ($_GET["accion"] == "recordar") {
        $controlador->verPagina("Vista/html/recuperarCuenta.php");
    }
    if ($_GET["accion"] == "principal") {
        if (isset($_SESSION['usuario']) && isset($_SESSION['rol'])) {
            $controlador->verPagina("Vista/html/principal.php");
        } else {
            $controlador->verPagina("Vista/html/login.php");
        }
    }
    if ($_GET["accion"] == "destruirSesion") {
        session_destroy();
        $controlador->verPagina("Vista/html/login.php");
    }
    if ($_GET["accion"] == "clientes") {
        $controlador->verPagina("Vista/html/clientes.php");
    }
    if ($_GET["accion"] == "paginaValidar") {
        $controlador->verPagina("Vista/html/validarCodigo.php");
    }
    if ($_GET["accion"] == "validarCodigo") {
        $resultado=false;
        if(isset($_SESSION['codigo']) && isset($_SESSION['correo'])){
        $codigo=$_SESSION['codigo'];
        $_SESSION['tiempoCorreoCodigo']=time();
        $resultado=$controlador->analisisValidarCodigo(
            $_POST["entrada1"],
            $_POST["entrada2"],
            $_POST["entrada3"],
            $_POST["entrada4"],
            $_POST["entrada5"],
            $_POST["entrada6"],
            $_POST["entrada7"],
            $_POST["entrada8"],
            $codigo
        );
        if((time() - $_SESSION['tiempoCorreoCodigo']  <300)){
            if($resultado==true){   
                $correo=$_SESSION['correo'];
                $resultadoCorreo=$controlador->existenciaCorreo($correo);
                if($resultadoCorreo==true){
                    $controlador->verPagina("Vista/html/restablecerContraseña.php");
                }else{
                    $_SESSION['mensaje']="El correo no existe";
                    $controlador->verPagina('Vista/html/recuperarCuenta');
                }
                
            }else{
                $controlador->verPagina("Vista/html/validarCodigo.php");
            }
        }else{
            unset($_SESSION['codigo']);
            unset($_SESSION['correo']);
            $_SESSION['mensaje']="El tiempo para restablecer la contraseña expiró";
            $controlador->verPagina("Vista/html/validarCodigo.php");
        }
    }else{
        $_SESSION['mensaje']="Hubo un error, solicite un nuevo correo";
        $controlador->verPagina("Vista/html/validarCodigo.php");

    }
    
    }
    if ($_GET["accion"] == "validarNuevaContraseña") {
        $resultado=false;
        $_SESSION['tiempoRestablecer']=time();
        if (empty($_POST["contraseña1"]) || empty($_POST["contraseña2"])) {
            $_SESSION['mensaje'] = "Los campos no deben estar vacios";
            $controlador->verPagina('Vista/html/restablecerContraseña.php');
            exit();
        }elseif(!empty($_POST["contraseña1"]) && !empty($_POST["contraseña2"])){
            $resultado=$controlador->analizarContraseña($_POST["contraseña1"],$_POST["contraseña2"]);
            if($resultado==true){
                if(isset($_SESSION['tiempoRestablecer'])&& (time() - $_SESSION['tiempoRestablecer'] < 300)){

    
                if(isset($_SESSION['correo']) && isset($_SESSION['codigo'])){
                    $controlador->actualizarContraseña($_SESSION['correo'],$_POST["contraseña1"]);
                    if($resultado==True){
                        $_SESSION['mensaje']="Contraseña actualizada correctamente";
                        unset($_SESSION['correo']);
                        unset($_SESSION['codigo']);
                        $controlador->verPagina("Vista/html/restablecerContraseña.php");
                    }else{
                        $_SESSION['mensaje']="No se pudo actualizar la contraseña";
                        $controlador->verPagina("Vista/html/restablecerContraseña.php");
                    }
                }else{
                    $_SESSION['mensaje'] = "Hubo un error durante la ejecución";
                    $controlador->verPagina("Vista/html/restablecerContraseña.php");
                }
            }else{
                $_SESSION['mensaje'] = "El tiempo para restablecer contraseña ha acabado";
                unset($_SESSION['correo']);
                unset($_SESSION['codigo']);
                $controlador->verPagina("Vista/html/restablecerContraseña.php");
            }
                
            }else{
              
                $controlador->verPagina("Vista/html/restablecerContraseña.php");
            }
        }
    }elseif($_GET["accion"]=="paginaProveedor"){
        $resultado=$controlador->mostrarProveedores();
    }

    elseif ($_GET["accion"] == "ingresarPersonal") {
        $controlador->agregarPersonal(
            $_POST["PerNombre"],
            $_POST["PerCorreo"],
            $_POST["PerTelefono"],
            $_POST["PerUsuario"],
            $_POST["Percontra"],
            $_POST["Percargo"],
            $_POST["PerEstado"]

        );
    }   elseif ($_GET["accion"] == "actualizarProductos") {
        $prod_id = $_POST['prod_id'];
        $prod_nombre = $_POST['Upnombreprod'];
        $prod_medida = $_POST['Upunidad'];
        

        $controlador->actualizarProductos($prod_id, $prod_nombre, $prod_medida);
    }  elseif ($_GET["accion"] == "ingresarProducto") {
        $controlador->agregarProducto(
            null,
            $_POST["ProdNombre"],
            $_POST["unidmedida"],
            0,
            0
        );
    }
} else {
    $controlador->verPagina('Vista/html/login.php');
}
