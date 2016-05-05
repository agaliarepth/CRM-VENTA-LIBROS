<?php
class CuotasPagos{
    static $tabla="cuotas_has_pagos";
    static $idTabla1="cuotas_idcuotas";
    static $idTabla2="pagos_idpagos";
    static $objeto;

    public  $cuotas_idcuotas;
    public  $pagos_idpagos;
    public  $monto;



    function __construct(){

        self::$objeto=get_object_vars($this);
    }
    public function get_objeto(){

        self::$objeto=get_object_vars($this);

        return self::$objeto;
    }

    public function get_tabla(){

        return self::$tabla;
    }

    public function get_id(){

        return self::$idTabla;
    }

    private  static function instanciar($reg){
        $obj=new self;
        foreach($reg as $atrib=>$valor){
            if($obj->atributos($atrib))
                $obj->$atrib=$valor;
        }
        return $obj;
    }
    private function atributos($atributo){
        $var=get_object_vars($this);
        return array_key_exists($atributo,$var);

    }


    public function nuevo(){
        global $db;


        $this->get_objeto();
        $sql="INSERT INTO ".self::$tabla."(";
        $sql.=join(",",array_keys(self::$objeto));
        $sql.=") VALUES ('";
        $sql.=join("','",array_values(self::$objeto));
        $sql.="')";

        $db->query($sql);


    }


    public  function actualizar($id){
        global $db;
        $this->get_objeto();
        $pares=array();
        foreach(self::$objeto as $key=>$value){
            $pares[]="{$key}='{$value}'";

        }
        $sql="UPDATE ".self::$tabla." SET ";
        $sql.=join(", ",$pares);
        $sql.=" WHERE ".self::$idTabla."='".$id."'";
        $db->query($sql);

    }
    public function sumPagosCuotas($idcuota){

   global $db;
  $sql="SELECT sum(monto)as monto FROM ".self::$tabla." WHERE cuotas_idcuotas='".$idcuota."'";
  $res=$db->query($sql)->fetchColumn();
  return ($res);
  }



    public function borrar($id){

        global $db;
        $sql="delete  FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
        $res=$db->query($sql);

        return ($res);
    }

    public   function getId($id){
        global $db;
        $sql="SELECT * FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
        $res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return ($res);

    }


}


?>
