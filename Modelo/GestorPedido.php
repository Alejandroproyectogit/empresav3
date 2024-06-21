<?php
class GestorPedido
{

    public function agregarPedido(Pedido $pedido)
    {
        $conexion = new Conexion();
        $enlaceConexion = $conexion->abrir();
        $cliente = $pedido->obtenerCliente();
        $receta = $pedido->obtenerReceta();
        $paquetes = $pedido->obtenerPaquetes();
        $fecha = $pedido->obtenerFecha();
        $valor = $pedido->obtenerValor();
        $estado = $pedido->obtenerEstado();
        $sql = $enlaceConexion->prepare("INSERT INTO pedidos VALUES (NULL,:cliente,:receta,:paquetes,:fecha,:valor,:estado)");
        $sql->bindParam(":cliente", $cliente, PDO::PARAM_INT);
        $sql->bindParam(":receta", $receta, PDO::PARAM_INT);
        $sql->bindParam(":paquetes", $paquetes, PDO::PARAM_INT);
        $sql->bindParam(":fecha", $fecha, PDO::PARAM_STR);
        $sql->bindParam(":valor", $valor, PDO::PARAM_INT);
        $sql->bindParam(":estado", $estado, PDO::PARAM_STR);
        $conexion->consulta($sql,0);
        $filasAfectadas = $conexion->obtenerFilasAfectadas();
        $conexion->cerrar();
        return $filasAfectadas;
    }

    public function listarPedidos()
    {
        $conexion = new Conexion();
        $enlaceConexion = $conexion->abrir();
        $sql = $enlaceConexion->prepare("SELECT p.ped_id, c.cli_nombre AS nombre_cliente, c.cli_direccion AS direccion_cliente, 
                       r.rec_nombre AS nombre_receta,
                       p.ped_paquetes, p.ped_fecha, p.ped_valor, p.ped_estado
                FROM pedidos p
                JOIN clientes c ON p.ped_id_cliente = c.cli_id
                JOIN receta r ON p.ped_id_receta = r.rec_id");
        $conexion->consulta($sql,2);
        $result = $conexion->obtenerResultadoAll();
        $conexion->cerrar();
        return $result;
    }

    public function editarPedidos($id, $paquetes, $valor, $estado)
    {
        $conexion = new Conexion();
        $enlaceConexion=$conexion->abrir();
        $sql = $enlaceConexion->prepare("UPDATE pedidos SET ped_paquetes=:paquetes, ped_valor=:valor, ped_estado=:estado WHERE ped_id =:id");
        $sql->bindParam(":paquetes",$paquetes,PDO::PARAM_INT);
        $sql->bindParam(":valor",$valor,PDO::PARAM_INT);
        $sql->bindParam(":estado",$estado,PDO::PARAM_STR);
        $sql->bindParam(":id",$id,PDO::PARAM_INT);
        $conexion->consulta($sql,0);
        $filasAfectadas = $conexion->obtenerFilasAfectadas();
        $conexion->cerrar();
        return $filasAfectadas;
    }

    public function listarRecetas()
    {
        $conexion = new Conexion();
        $enlaceConexion=$conexion->abrir();
        $sql = $enlaceConexion->prepare("SELECT * FROM receta"); 
        $conexion->consulta($sql,2);
        $result = $conexion->obtenerResultadoAll();
        $conexion->cerrar();
        return $result;
    }
}