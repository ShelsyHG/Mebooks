<?php
class admin_MO
{
    private $conexion;

    function __construct($conexion)
    {
        $this->conexion=$conexion;
    }

    function seleccionarPorUsuario($usuario)
    {
        $sql = "SELECT * FROM usuarios WHERE usuario='$usuario'";

        $this->conexion->consulta($sql);

        $arreglo_accesos=$this->conexion->extraerRegistro();

        return $arreglo_accesos;
    }
    function agregarUsuario($nombre,$nit,$direccion,$usuario,$contrasena)
    {
        $sql = "INSERT INTO usuarios(id_rol, nombre, nit, direccion, usuario, contrasena) VALUES (1, '$nombre', '$nit', '$direccion', '$usuario', '$contrasena')";

        $filas_afectadas=$this->conexion->consulta($sql);

        return $filas_afectadas;
    }
}
?>