<?php

require_once("../helpers/conexion.php");


global $db;
$id=$_POST["id"];
$idvendedor=$_GET["idvendedor"];
$faltantes=array();
$fecha=$_GET["fecha"];

function comprobar($codlibro,$cantidad) {
    global $db;
    global $idvendedor;
    global $faltantes;
    global $fecha;
    $f=date_parse($fecha);
    $mes=$f["month"];
    $anio=$f["year"];
    $sql ="SELECT count(cod_libro) as disponible FROM kardexvendedor WHERE cod_libro='".$codlibro."' AND estado_libro ='Remitido' AND vendedores_idVendedores='".$idvendedor."' AND (cargo=1 OR cargo=0) AND traspaso=0 AND MONTH(fecha_remision)=".$mes." AND YEAR(fecha_remision)=".$anio;
    $result=$db->query($sql)->fetch();



    if($result["disponible"]< $cantidad){
        $c=$cantidad-$result["disponible"];
        array_push($faltantes,["codigo"=>$codlibro,"cantidad"=>$c]);
        return false;
    }else{
        return true;
    }
}


$sql="SELECT cantidad,codigo FROM detalle_traspaso WHERE traspasos_idtraspasos='".$id."'";
$res=$db->query($sql)->fetchAll();

foreach($res as $v){


    comprobar($v["codigo"],$v["cantidad"]);



}
if(count($faltantes)<=0)
    echo "1";
else
    echo json_encode($faltantes);
?>