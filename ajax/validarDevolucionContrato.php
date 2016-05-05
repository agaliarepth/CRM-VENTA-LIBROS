<?php

require_once("../helpers/conexion.php");



if(isset($_GET["idcontrato"])){

    global $db;
   $response=array();
    $sql ="SELECT numcontrato,fechacontrato,nombres,apellidopaterno,apellidomaterno FROM contratos WHERE idcontratos=".$_GET["idcontrato"];
    $result=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
    if(count($result)>1) {

        $sql2 = "SELECT COUNT(iddevolucion) as contar , iddevolucion FROM devolucion WHERE numcontrato=" . $result["numcontrato"]." AND estado!='ANULADO'";
        $result2=$db->query($sql2)->fetch(PDO::FETCH_ASSOC);
        if($result2["contar"]>0) {
            $response=$result;
            $response["msg"]=true;
            $response["iddevolucion"]=$result2["iddevolucion"];
        }
        else
            $response["msg"]=false;
    }
    else{

        $response["msg"]=false;
    }


    echo json_encode($response);

}

?>