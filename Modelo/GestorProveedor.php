<?php
class GestorProveedor{
    public function traerProveedores(){
        $conexion = new Conexion();
        $enlace_conexion = $conexion->abrir();
        $sql = $enlace_conexion->prepare("SELECT * FROM proveedores;");
        $conexion->consulta($sql,1);
        $resultado=$conexion->obtenerResultado();
        $conexion->cerrar();
        return $resultado;
    }
}