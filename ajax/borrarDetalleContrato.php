<?php
require_once("../helpers/conexion.php");
if(isset($_GET["idcontrato"])){


    global $db;


    $sql ="DELETE FROM detalle_contrato  WHERE contratos_idcontratos=".$_GET["idcontrato"];
    $result=$db->query($sql);
    if(result)

        echo json_encode(["response" => 1]);
            else
        echo json_encode(["response"=>0]);


}
?>