<?php
class conexion
{
    private $conexion;
    private $resultado;

    function __construct($privilegio)
    {
        $ip_maquina=IP_MAQUINA;
        $base_de_datos=BASE_DE_DATOS;

        if($privilegio=="A")
        {
            $usuario=USUARIO_ADMINISTRADOR;
            $clave=CLAVE_ADMINISTRADOR;
        }
        else if($privilegio=="L")
        {
            $usuario=USUARIO_LIMITADO;
            $clave=CLAVE_LIMITADO;
        }
        else
        {
            exit("ERROR: PRIVILEGIO NO ESPECIFICADO");
        }

        try
        {
            $this->conexion = new PDO("mysql:host=$ip_maquina;dbname=$base_de_datos", $usuario, $clave);
        } 
        catch (PDOException $pe) 
        {
            //exit("ERROR: ".$pe->getMessage());
            exit("ERROR: NO HAY CONEXION A LA BASE DE DATOS");
        }
    }

    function consulta($sql)
    {
        $this->resultado=$this->conexion->query($sql) or exit("ERROR: CONSULTA MAL FORMULADA");
        
        return $this->resultado->rowCount();
    }

    function extraerRegistro()
    {
        $arreglo=array();
        
        //PDO::FETCH_BOTH
        //PDO::FETCH_OBJ
        //PDO::FETCH_ASSOC

        if($this->resultado)
        {
            $arreglo=$this->resultado->fetchAll(PDO::FETCH_OBJ);
        }

        return $arreglo;
    }
}
?>