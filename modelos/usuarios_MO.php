<?php
class usuarios_MO
{
    private $conexion;

    function __construct($conexion)
    {
        $this->conexion=$conexion;
    }

    function verificarInicioSesion($usuario,$contrasena)
    {
        $sql = "SELECT * FROM usuarios LEFT JOIN roles ON usuarios.id_rol=roles.id_rol WHERE usuario='$usuario' AND contrasena='$contrasena'";

        $this->conexion->consulta($sql);

        $arreglo_accesos=$this->conexion->extraerRegistro();

        return $arreglo_accesos;
    }

    function listarPuntos()
    {
        $sql = "SELECT * FROM libro";

        $this->conexion->consulta($sql);

        $arreglo_accesos=$this->conexion->extraerRegistro();

        return $arreglo_accesos;
    }

    function agregarUsuario($nombre,$editorial,$autor,$descripcion,$precio)
    {
        $sql = "INSERT INTO libro(nombre, editorial, autor, descripcion, precio) VALUES ('$nombre', '$editorial', '$autor', '$descripcion', '$precio')";

        $filas_afectadas=$this->conexion->consulta($sql);

        return $filas_afectadas;
    }

    function seleccionar($atributo='',$valor='')
    {
        $condicion="";
        
        if($atributo && $valor)
        {
            $condicion = " WHERE $atributo='$valor'";
        }

        $sql = "SELECT * FROM usuarios $condicion";
        
        $this->conexion->consulta($sql);

        $arreglo_accesos=$this->conexion->extraerRegistro();

        return $arreglo_accesos;
    }


    function seleccionarPorUsuario($nombre)
    {
        $sql = "SELECT * FROM libro WHERE nombre='$nombre'";

        $this->conexion->consulta($sql);

        $arreglo_accesos=$this->conexion->extraerRegistro();

        return $arreglo_accesos;
    }
    function seleccionarUsuario($usuario)
    {
        $sql = "SELECT * FROM usuarios LEFT JOIN roles ON usuarios.id_rol=roles.id_rol WHERE usuario='$usuario'";

        $this->conexion->consulta($sql);

        $arreglo_accesos=$this->conexion->extraerRegistro();

        return $arreglo_accesos;
    }
    
}
?>