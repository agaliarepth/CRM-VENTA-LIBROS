<?php
require_once("../helpers/conexion.php");
$user = $_POST['b'];

if(!empty($user)) {
    comprobar($user);
}

function comprobar($b) {
    global $db;

    $sql ="SELECT count(idcontratos) FROM contratos WHERE ci='".$b."'";
    $result=$db->query($sql)->fetchColumn();

   echo $result;
}

?>