<?php
class peticiones_MO
{
    private $conexion;

    function __construct($conexion)
    {
        $this->conexion=$conexion;
    }

    function listarPeticiones()
    {
        $sql = "SELECT * FROM pagos";

        $this->conexion->consulta($sql);

        $arreglo_pagos=$this->conexion->extraerRegistro();

        return $arreglo_pagos;
    }

    function agregarPeticion($descripcion,$monto_pago,$id_comercio,$forma_pago,$comision,$franquicia,$token)
    {
        $sql = "INSERT INTO pagos(descripcion, monto_pagar, id_comercio, forma_pago, comision, franquicia, token) VALUES ('$descripcion','$monto_pago','$id_comercio','$forma_pago','$comision','$franquicia','$token')";

        $filas_afectadas=$this->conexion->consulta($sql);

        return $filas_afectadas;
    }

    function seleccionarPorPeticion($token)
    {
        $sql = "SELECT * FROM pagos WHERE token='$token'";

        $this->conexion->consulta($sql);

        $arreglo_pagos=$this->conexion->extraerRegistro();

        return $arreglo_pagos;
    }
    function seleccionarPeticion($usuario)
    {
        $sql = "SELECT * FROM usuarios LEFT JOIN roles ON usuarios.id_rol=roles.id_rol WHERE usuario='$usuario' AND ";

        $this->conexion->consulta($sql);

        $arreglo_accesos=$this->conexion->extraerRegistro();

        return $arreglo_accesos;
    }
    function seleccionarComercios()
    {
        $sql = "SELECT * FROM comercios";

        $this->conexion->consulta($sql);

        $arreglo_comercios=$this->conexion->extraerRegistro();

        return $arreglo_comercios;
    }
    function agregarComercios($nombre)
    {
        $sql = "INSERT INTO comercios(nombre) VALUES ('$nombre')";

        $filas_afectadas=$this->conexion->consulta($sql);

        return $filas_afectadas;
    }

    function actualizar($token)
    {
        $sql = "UPDATE pagos SET estado='pagado' WHERE token=''$token";

        $filas_afectadas=$this->conexion->consulta($sql);

        return $filas_afectadas;
    }
    function agregarCliente($nombre,$apellido,$direccion,$correo,$telefono,$referencia,$targeta)
    {
        $sql = "INSERT INTO clientes(nombre, apellido, direccion, correo, telefono, referencia, num_targeta) VALUES ('$nombre','$apellido','$direccion','$correo','$telefono','$referencia','$targeta')";
        
        $filas_afectadas=$this->conexion->consulta($sql);

        return $filas_afectadas;
    }
}
?>