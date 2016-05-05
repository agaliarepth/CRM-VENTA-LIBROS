<?php 
 require_once("model/devolucionObrasModel.php");
 require_once("model/creditoModel.php");
 require_once("model/cobradoresModel.php");
 require_once("model/pagosModel.php");



 $dev= new devolucionObras();
 $co=new Cobrador();
 $cred=new Credito();
 $pago=new Pago();
$res2=$co->listarTodos();
 if(isset($_POST["consulta"])){

 	
     if ($_POST["filtro"]=="todos") {
  $res=$dev->getDevolucionesCuenta($_POST["mes"],$_POST["anio"],$_POST["tipoDevolucion"]);
     }
     else {
     $res=$dev->getDevolucionesCuentaCobrador($_POST["mes"],$_POST["anio"],$_POST["filtro"],$_POST["tipoDevolucion"]);
     }

 }
require_once("view/devolucionCuentas.php");

 ?>