<?php
require_once "librerias/configuraciones.php";
require_once "librerias/conexion.php";

if(isset($_SESSION["autenticado"]) && $_SESSION["autenticado"]=="SI")
{
    if(isset($_SESSION["nombre_rol"]) && $_SESSION["nombre_rol"]=="administrador")
    {
        if(isset($_POST["modulo"]) && isset($_POST["accion"]))
        {
            $modulo=$_POST["modulo"];
            $accion=$_POST["accion"];

            if($modulo=='punto')
            {
                require_once "vistas/punto_VI.php";
                require_once "controladores/usuarios_CO.php";

                $punto_VI = new punto_VI();
                $usuarios_CO = new usuarios_CO();

                if($accion == 'LISTAR')
                {
                    $punto_VI->listar();
                }
                else if($accion=='VISTA_AGREGAR_PUNTOS')
                {
                    $punto_VI->agregar();
                }
                else if($accion=='CONTROLADOR_AGREGAR_PUNTOS')
                {
                    $usuarios_CO->agregar();
                }
                else if($accion=='salir')
                {
                    $usuarios_CO->salir();
                }
            }
        }else
        {
            require_once "vistas/menu_admin_VI.php";
            $menu_admin_VI=new menu_admin_VI();
            $menu_admin_VI->verMenu();
        }
    }
    else if(isset($_SESSION["nombre_rol"]) && $_SESSION["nombre_rol"]=="puntoventa")
    {
        if(isset($_POST["modulo"]) && isset($_POST["accion"])){
            $modulo=$_POST["modulo"];
            $accion=$_POST["accion"];

            if($modulo=='peticion')
            {
                require_once "vistas/peticiones_VI.php";
                require_once "controladores/peticiones_CO.php";

                $peticiones_VI = new peticiones_VI();
                $peticiones_CO = new peticiones_CO();

                if($accion == 'LISTAR')
                {
                    $peticiones_VI->listar();
                }
                else if($accion=='VISTA_AGREGAR_PETICION')
                {
                    $peticiones_VI->agregar();
                }
                else if($accion=='CONTROLADOR_AGREGAR_PETICION')
                {
                    $peticiones_CO->agregar();
                }
            }
        }else
        {
            require_once "vistas/menu_punto_VI.php";
            $menu_punto_VI=new menu_punto_VI();
            $menu_punto_VI->verMenu();
        }
    }
}
else if(isset($_POST["usuario"]) && isset($_POST["contrasena"]))
{
    require_once "controladores/usuarios_CO.php";
    $usuarios_CO=new usuarios_CO();
    $usuarios_CO->verificarInicioSesion();
}
else if(isset($_POST["modu"]) && isset($_POST["acci"]))
{
    require_once "controladores/admin_CO.php";
    require_once "vistas/admin_VI.php";

    $modu = $_POST["modu"];
    $acci = $_POST["acci"];

    if($modu == "admin")
    {
        if($acci == "VISTA_AGREGAR_ADMINISTRADOR")
        {
            $admin_VI = new admin_VI();
            $admin_VI->agregar();
        }
        else if($acci == "CONTROLADOR_AGREGAR_ADMIN"){
            $admin_CO = new admin_CO();
            $admin_CO->agregar();
        }
        
    }
}
else if(isset($_POST["mod"]) && isset($_POST["acc"]))
{
    require_once "controladores/peticiones_CO.php";

    $modu = $_POST["mod"];
    $acci = $_POST["acc"];

    if($modu == "pago")
    {
        if($acci == "CONTROLADOR_AGREGAR_PAGO")
        {
            $peticiones_CO = new peticiones_CO();
            $peticiones_CO->modificar();
        }
        
    }
}
else
{
    require_once "vistas/usuarios_VI.php";
    $usuarios_VI=new usuarios_VI();
    $usuarios_VI->formularioInicioSesion();
}

