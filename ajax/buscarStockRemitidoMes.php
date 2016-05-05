<?php

require_once("../helpers/conexion.php");
$user = $_POST['b'];

if(!empty($user)) {
    $f=date_parse($_GET["fecha"]);
    $mes=$f["month"];
    $anio=$f["year"];
    comprobar($user,$_GET["id"],$mes,$anio);

}

function comprobar($b,$v,$mes,$anio) {
    global $db;

    $sql ="SELECT count(cod_libro) as disponible FROM kardexVendedor WHERE cod_libro='".$b."' AND estado_libro ='Remitido' AND MONTH(fecha_remision)=".$mes." AND YEAR(fecha_remision)=".$anio."  AND vendedores_idVendedores='".$v."' AND (cargo=1 OR cargo=0)  AND traspaso=0";
    $result=$db->query($sql)->fetch();

    $contar = count($result);

    if($contar <= 0){
        echo "0";
    }else{
        echo $result["disponible"];
    }
}
?>