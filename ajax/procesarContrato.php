<?php
require_once("../helpers/conexion.php");

 if(isset($_GET["idcontrato"])) {
     global $db;
     $id=$_GET["idcontrato"];
     $idchofer=$_GET["idchofer"];
     $idvendedor=$_GET["idvendedor"];
     $faltantes=array();
     $fecha=$_GET["fecha"];
     $sql;

     function comprobar($codlibro,$cantidad) {
         global $db;
         global $idvendedor;
         global $idchofer;
         global $faltantes;
         global $fecha;
         global $sql;

         $f=date_parse($fecha);

         $mes=$f["month"];
         $anio=$f["year"];
         $sql ="SELECT count(cod_libro) as disponible FROM kardexvendedor WHERE cod_libro='".$codlibro."' AND estado_libro ='Remitido' AND vendedores_idVendedores='".$idchofer."' AND (cargo=1 OR cargo=0) AND traspaso=0 AND MONTH(fecha_remision)=".$mes." AND YEAR(fecha_remision)=".$anio;
         $result=$db->query($sql)->fetch(PDO::FETCH_ASSOC);



         if($result["disponible"]< $cantidad){
             $c=$cantidad-$result["disponible"];
             array_push($faltantes,["codigo"=>$codlibro,"cantidad"=>$c]);
             return false;
         }else{
             return true;
         }
     }// fin function

     $sql2="SELECT cantidad,codigo FROM detalle_contrato WHERE contratos_idcontratos='".$id."'";
     $res=$db->query($sql2)->fetchAll();

     foreach($res as $v){


         comprobar($v["codigo"],$v["cantidad"]);



     }
     if(count($faltantes)<=0)
         echo "1";
     else
         echo json_encode($faltantes);
 }
?>