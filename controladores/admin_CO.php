<?php
require_once "modelos/admin_MO.php";
class admin_CO
{
    function __construct()
    {
        
    }

    function agregar()
    {
        $nombre=$_POST["nombre"];
        $nit=$_POST["nit"];
        $direccion=$_POST["direccion"];
        $usuario=$_POST["usuario"];
        $contrasena=$_POST["contrasena"];

        $conexion=new conexion('A');

        $admin_MO=new admin_MO($conexion);

        $arreglo_admin = $admin_MO->seleccionarPorUsuario($usuario);

        if($arreglo_admin)
        {
            $respuesta = [
                "estado" => "ADVERTENCIA",
                'mensaje' => "ADVERTENCIA: El usuario <b>$usuario</b> ya existe"
            ];
        }
        else
        {
            $filas_afectadas=$admin_MO->agregarUsuario($nombre,$nit,$direccion,$usuario,$contrasena);
            if($filas_afectadas)
            {
                $respuesta = [
                    "estado" => "EXITO",
                    'mensaje' => "EXITO: Registro Guardado"
                ];
            }
            else
            {
                $respuesta = [
                    "estado" => "ADVERTENCIA",
                    'mensaje' => "ADVERTENCIA: No se completo la consulta"
                ];
            }
        }
        echo json_encode($respuesta);
    }
}
?>