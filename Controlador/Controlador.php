<?php
class Controlador
{
    public function verPagina($ruta)
    {
        require_once $ruta;
    }
    
    public function mostrarProveedores(){
        $gestorProveedor = new GestorProveedor();
        $resultado=$gestorProveedor->traerProveedores();
        require_once 'Vista/html/proveedores.php';
    }

    public function agregarCliente($id, $nom, $tel, $dir)
    {
        $cliente = new Cliente($id, $nom, $tel, $dir);
        $gestor = new GestorCliente();
        $registros = $gestor->agregarCliente($cliente);
        if ($registros > 0) {
            echo '<script>alert("Cliente agregado con éxito");</script>';
        } else {
            echo '<script>alert("Cliente no ha podido ser ingresado");</script>';
        }
        echo '<script>
        setTimeout(function() {
            window.location.href = "index.php?accion=clientes";
        }, 500);
        </script>';
    }

    public function listarCliente()
    {
        $gestor = new GestorCliente();
        $resultClientes = $gestor->listarClientes();
        require_once 'Vista/html/clientes.php';
    }

    public function editarClientes($id, $nuevoNombre, $nuevoTelefono, $nuevaDireccion)
    {
        $gestor = new GestorCliente();
        $registros = $gestor->editarClientes($id, $nuevoNombre, $nuevoTelefono, $nuevaDireccion);

        echo '<script>';
        echo 'if (confirm("¿Estás seguro de que quieres realizar esta acción?")) {';
        echo '  window.location.href = "index.php?accion=clientes";';
        echo '}';
        echo '</script>';
    }

    public function agregarPedido($id, $cli, $rec, $can, $fec, $val, $est)
    {
        $pedido = new Pedido($id, $cli, $rec, $can, $fec, $val, $est);
        $gestor = new GestorPedido();
        $registros = $gestor->agregarPedido($pedido);

        if ($registros > 0) {
            echo '<script>alert("Pedido agregado con éxito");</script>';
        } else {
            echo '<script>alert("Pedido no ha podido ser ingresado");</script>';
        }
        echo '<script>
        setTimeout(function() {
            window.location.href = "index.php?accion=pedidos";
        }, 500);
        </script>';
    }

    public function listarPedidos()
    {
        $gestor = new GestorPedido();
        $gestor1 = new GestorCliente();
        $resultPedidos = $gestor->listarPedidos();
        $resultClientes = $gestor1->listarClientes();
        $resultReceta = $gestor->listarRecetas();
        require_once 'Vista/html/pedidos.php';
    }

    public function editarPedidos($id, $paquetes, $valor, $estado)
    {
        $gestor = new GestorPedido();
        $registros = $gestor->editarPedidos($id, $paquetes, $valor, $estado);

        echo '<script>';
        echo 'if (confirm("¿Estás seguro de que quieres realizar esta acción?")) {';
        echo '  window.location.href = "index.php?accion=pedidos";';
        echo '}';
        echo '</script>';
    }

    public function agregarPersonal($nomc, $corr, $tele, $usu, $contra, $usucar, $usuest)
    {   
        $gestor = new GestorTrabajador();
        $hashedPassword = password_hash($contra, PASSWORD_DEFAULT);
        $personal = new Personal($nomc, $corr, $tele, $usu, $hashedPassword, $usucar, $usuest);

        $registros = $gestor->agregarPersonal($personal);
        if ($registros > 0) {
            header("Location: index.php?accion=trabajadores");
            exit();
        } else {
            echo "<script>alert('Error al grabar el Trabajador'); window.location.href='index.php?accion=trabajadores';</script>";
        }
    }

    public function obtenerDatosUsuario($usu_id)
    {
        $gestor = new GestorTrabajador();
        $usuario = $gestor->obtenerDatosUsuario($usu_id);
        return $usuario;
    }

    public function verPaginaTrabajadores($filtro)
    {
        $gestor = new GestorTrabajador();
        $administradores = $gestor->obtenerAdministradoresPorFiltro($filtro);
        $empleados = $gestor->obtenerTrabajadoresPorFiltro($filtro);
        require_once 'Vista/html/trabajadores.php';
    }

    public function actualizarUsuario()
    {
        if (
            isset($_POST['usu_id']) && !empty($_POST['usu_id']) &&
            isset($_POST['Upnombre']) && !empty($_POST['Upnombre']) &&
            isset($_POST['Upcorreo']) && !empty($_POST['Upcorreo']) &&
            isset($_POST['Uptelefono']) && !empty($_POST['Uptelefono']) &&
            isset($_POST['Upusuario']) && !empty($_POST['Upusuario']) &&
            isset($_POST['Upcargo']) && !empty($_POST['Upcargo']) &&
            isset($_POST['Upestado']) && !empty($_POST['Upestado'])
        ) {

            $id = $_POST['usu_id'];
            $nombrec = $_POST['Upnombre'];
            $correo = $_POST['Upcorreo'];
            $telefono = $_POST['Uptelefono'];
            $usuario = $_POST['Upusuario'];
            $usuario_cargo = $_POST['Upcargo'];
            $usuarioEstado = $_POST['Upestado'];

            $gestor = new GestorTrabajador();
            $registros = $gestor->actualizarUsuario($id, $nombrec, $correo, $telefono, $usuario, $usuario_cargo, $usuarioEstado);

            if ($registros > 0) {
                header("Location: index.php?accion=trabajadores");
                    exit();
            } else {
                echo '<script>alert("Error al actualizar el usuario"); window.location.href="index.php?accion=trabajadores";</script>';
            }
        } else {
            echo '<script>alert("Faltan datos o el ID no es válido."); window.location.href="index.php?accion=trabajadores";</script>';
        }
    }
    public function actualizarProductos()
    {
        if (
            isset($_POST['prod_id']) && !empty($_POST['prod_id']) &&
            isset($_POST['Upnombreprod']) && !empty($_POST['Upnombreprod']) &&
            isset($_POST['Upunidad']) && !empty($_POST['Upunidad'])
        ) {

            $prod_id = $_POST['prod_id'];
            $prod_nombre = $_POST['Upnombreprod'];
            $prod_medida = $_POST['Upunidad'];

            $gestor = new GestorProducto();
            $registros = $gestor->actualizarProductos($prod_id, $prod_nombre, $prod_medida);

            if ($registros > 0) {
                header("Location: index.php?accion=productos");
                    exit();
            } else {
                echo '<script>alert("Error al actualizar la información"); window.location.href="index.php?accion=productos";</script>';
            }
        } else {
            echo '<script>alert("Faltan datos o el ID no es válido."); window.location.href="index.php?accion=productos";</script>';
        }
    }
    public function agregarProducto($proid, $pronom, $promed, $prodtent, $prodtsal)
    {
        // Encriptar la contraseña
       
        $gestor = new GestorProducto();
        $producto = new Producto($proid, $pronom, $promed, $prodtent, $prodtsal);

        $registros = $gestor->agregarProducto($producto);
        if ($registros > 0) {
            header("Location: index.php?accion=productos");
                exit();
        } else {
            
        }
    }

    public function obtenerDatosProductos()
    {
        $gestor = new GestorProducto();
        $producto = $gestor->obtenerDatosProductos();
        require_once 'Vista/html/productos.php';
    }


    public function verificar($user,$password)
    {
        $usuario = new Usuario(
            $user,
            $password
        );
        $gestorUsuario = new GestorUsuario();
        $result=$gestorUsuario->busqueda($usuario);
        return $_SESSION;
    }


    public function generarCodigo(){
        $gestorUsuario = new GestorUsuario();
        $codigo=$gestorUsuario->generarCodigo(8);
        return $codigo;
    }
    public function recordarContraseña($correo,$codigo)
    {
        $gestorUsuario = new GestorUsuario();
        
        $resultado=$gestorUsuario->existenciaCorreo($correo);
            if($resultado==true){
                $gestorUsuario->enviarCorreo($correo,$codigo);
    
            }else{
                $_SESSION['mensaje'] = "Ese correo no esta registrado";
            }
        
       
    }
    public function limpiezaLogin($usuario,$contraseña){
        $resultado=false;
       if( preg_match('/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $usuario) &&
        preg_match('/^[0-9a-zA-Z]+$/', $contraseña)){
            $resultado=true;
            return $resultado;
        }else{
            return $resultado;
        }
    }
    public function analisisValidarCodigo($entrada1,$entrada2,$entrada3,$entrada4,$entrada5,$entrada6,$entrada7,$entrada8,$codigo){
        $resultado=false;
        if(empty($entrada1) &&
            empty($entrada2) &&
            empty($entrada3) &&
            empty($entrada4) &&
            empty($entrada5) &&
            empty($entrada6) &&
            empty($entrada7) &&
            empty($entrada8)
        ){
            $_SESSION['mensaje']="Ningun campo debe estar vacio";
            
        }elseif(preg_match('/^[0-9a-zA-Z]+$/', $entrada1) &&
            preg_match('/^[0-9a-zA-Z]+$/', $entrada2) &&
            preg_match('/^[0-9a-zA-Z]+$/', $entrada3) &&
            preg_match('/^[0-9a-zA-Z]+$/', $entrada4) &&
            preg_match('/^[0-9a-zA-Z]+$/', $entrada5) &&
            preg_match('/^[0-9a-zA-Z]+$/', $entrada6) &&
            preg_match('/^[0-9a-zA-Z]+$/', $entrada7) &&
            preg_match('/^[0-9a-zA-Z]+$/', $entrada8) 
        ){
            $codigoIngresado=$entrada1.$entrada2.$entrada3.$entrada4.$entrada5.$entrada6.$entrada7.$entrada8;
            if(isset($_SESSION['tiempo']) && (time() - $_SESSION['tiempo'] < 300)){
                
                if($codigoIngresado==$codigo){
                    $resultado=true;
                  
                }else{
                    $_SESSION['mensaje']="El codigo es incorrecto";
                }
                
            }else{
                $_SESSION['mensaje']="Error: El código ha expirado";
                unset($_SESSION['codigo']);
                unset($_SESSION['correo']);
            
            }
            
        }else{
            $_SESSION['mensaje']="No se aceptan caracteres especiales";
           
        }
        return $resultado;
    }
    public function existenciaCorreo($correo){
        $gestorUsuario = new GestorUsuario();
        $resultado=$gestorUsuario->existenciaCorreo($correo);
        return $resultado;
    }
    public function analizarContraseña($contraseña1,$contraseña2){
        $resultado=false;
        if(preg_match('/^[0-9a-zA-Z]+$/', $contraseña1) &&
        preg_match('/^[0-9a-zA-Z]+$/', $contraseña2)
        ){
            if($contraseña1==$contraseña2){
                $resultado=true;
                
            }else{
                $_SESSION['mensaje']="Las contraseñas no coinciden";
            }
        }else{
            $_SESSION['mensaje']="No se aceptan caracteres especiales";
        }
        return $resultado;
    }
    public function actualizarContraseña($correo,$contraseña){
        $gestorUsuario = new GestorUsuario();
        $contraseñaSegura=password_hash($contraseña,PASSWORD_DEFAULT);
        $resultado=$gestorUsuario->actualizarContraseña($correo,$contraseñaSegura);
        return $resultado;
    }
}
