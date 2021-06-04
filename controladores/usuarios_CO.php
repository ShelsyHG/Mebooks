<?php

require_once "modelos/usuarios_MO.php";

class usuarios_CO{

    function __construct(){}

    function verificarInicioSesion(){

        $usuario=$_POST["usuario"];
        $contrasena=$_POST["contrasena"];

        $conexion=new conexion('A');

        $usuarios_MO=new usuarios_MO($conexion);

        $arreglo_usuarios=$usuarios_MO->verificarInicioSesion($usuario,$contrasena);

        if($arreglo_usuarios)
        {
            $_SESSION["id_usuario"]=$arreglo_usuarios[0]->id_usuario;
            $_SESSION["nombre_rol"]=$arreglo_usuarios[0]->nombre_rol;

            $_SESSION["autenticado"]="SI";
            header("Location: index.php");
        }
        else
        {
            header("Location: index.php?error=ERROR: Usuario No Registrado&usuario=$usuario");
        }
    }

    function agregar(){

        $nombre=$_POST["nombre"];
        $editorial=$_POST["editorial"];
        $autor=$_POST["autor"];
        $descripcion=$_POST["descripcion"];
        $precio=$_POST["precio"];

        $conexion=new conexion('A');

        $usuarios_MO=new usuarios_MO($conexion);

        $arreglo_usuarios=$usuarios_MO->seleccionarPorUsuario($nombre);

        if($arreglo_usuarios)
        {
            $respuesta = [
                "estado" => "ADVERTENCIA",
                'mensaje' => "ADVERTENCIA: El libre <b>$nombre</b> ya existe"
            ];
        }else{

            $filas_afectadas=$usuarios_MO->agregarUsuario($nombre,$editorial,$autor,$descripcion,$precio);
            
            if($filas_afectadas){

                $arreglo_usuarios=$usuarios_MO->seleccionarPorUsuario($nombre);

                $id_usuario=$arreglo_usuarios[0]->id_libro;
                $nombre=$arreglo_usuarios[0]->nombre;
                $editorial=$arreglo_usuarios[0]->editorial;
                $autor=$arreglo_usuarios[0]->autor;
                $descripcion=$arreglo_usuarios[0]->descripcion;
                $precio=$arreglo_usuarios[0]->precio;
                
                $respuesta = [
                    "estado" => "EXITO",
                    'mensaje' => "EXITO: Registro Guardado",
                    'nombre' => $nombre,
                    'editorial' => $editorial,
                    'autor' => $autor,
                    'descripcion' => $descripcion,
                    'precio' => $precio
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

    function salir(){
        if (session_destroy()) {
            $respuesta = [
                "estado" => "EXITO",
                'mensaje' => "EXITO: Vuelve pronto",
            ];
        }
        echo json_encode($respuesta);
    }
}
?>