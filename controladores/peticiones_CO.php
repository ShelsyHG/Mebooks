<?php

require_once "modelos/peticiones_MO.php";

class peticiones_CO{

    function __construct(){}

    function agregar(){

        $descripcion=$_POST["descripcion"];
        $monto_pago=$_POST["monto_pago"];
        $id_comercio=$_POST["comercio"];
        $token = rand(1000,9999);
        $forma_pago=$_POST["forma_pago"];
        $comision=$_POST["comision"];
        $franquicia=$_POST["franquicia"];


        $conexion=new conexion('A');

        $peticiones_MO=new peticiones_MO($conexion);

        $arreglo_peticiones=$peticiones_MO->seleccionarPorPeticion($token);


        if($arreglo_peticiones)
        {
            $respuesta = [
                "estado" => "ADVERTENCIA",
                'mensaje' => "ADVERTENCIA: El token <b>$token</b> ya existe"
            ];
        }else{

            $filas_afectadas=$peticiones_MO->agregarPeticion($descripcion,$monto_pago,$id_comercio,$forma_pago,$comision,$franquicia,$token);
            if($filas_afectadas){
                
                $arreglo_usuarios=$peticiones_MO->seleccionarPorPeticion($token);

                $id_usuario=$arreglo_usuarios[0]->id_accesos;
                $descripcion=$arreglo_usuarios[0]->descripcion;
                $monto_pago=$arreglo_usuarios[0]->monto_pago;
                $forma_pago=$arreglo_usuarios[0]->forma_pago;
                $comision=$arreglo_usuarios[0]->comision;
                $franquicia=$arreglo_usuarios[0]->franquicia;
                $token=$arreglo_usuarios[0]->token;
                $estado=$arreglo_usuarios[0]->estado;

                $respuesta = [
                    "estado" => "EXITO",
                    'mensaje' => "EXITO: Registro Guardado",
                    'id_usuario' => $id_usuario,
                    'descripcion' => $descripcion,
                    'monto_pago' => $monto_pago,
                    'forma_pago' => $forma_pago,
                    'comision' => $comision,
                    'franquicia' => $franquicia,
                    'token' => $token,
                    'estado' => $estado
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

    function modificar()
    {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $direccion = $_POST['direccion'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $referencia = $_POST['referencia'];
        $targeta = $_POST['targeta'];
        $token = $_POST['token'];


        $conexion = new conexion('A');

        $peticiones_MO = new peticiones_MO($conexion);

        $filas_afectadas = $peticiones_MO->agregarCliente($nombre,$apellido,$direccion,$correo,$telefono,$referencia,$targeta);
      
        if($filas_afectadas) 
        {
            $peticiones_MO->actualizar($token);
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
        echo json_encode($respuesta);
    }
}
?>