<?php 

require_once("model/vendedoresModel.php");
require_once("model/librosModel.php");
require_once("model/kardexVendedorModel.php");
require_once("model/detalle_devolucionModel.php");
require_once("model/devolucionModel.php");
require_once("model/devolucionObrasModel.php");


$ve=new Vendedores();
$k=new kardexVendedor();
$li=new Libros();
$det=new detalleDevolucion();
$dev=new Devolucion();
$devob=new devolucionObras();


if(isset($_POST["cancelar"])&&$_POST["cancelar"]=="cancelar"){
	 $res3=$dev->getId($_POST["iddevolucion"]);
      if($res3["numcontrato"]!=""){

          $notaDev=$devob->getPorContrato($res3["numcontrato"]);

          $devob->updateEstado($notaDev["iddevolucionObras"],"enviado");

          $k->anularDevolucionVentas($res3["iddevolucion"],$res3["numcontrato"]);
          $dev->actualizarEstado1($_GET["id"], "ANULADO");



      }
    else {


        $dev->actualizarEstado1($_POST["iddevolucion"], "ANULADO");


        $k->actualizarEstadoRemitido1($_POST["iddevolucion"]);





    }
				
header("Location:".config::ruta()."?accion=notasDevolucion");


}


if (isset($_POST["consulta"])&&$_POST["consulta"]=="consulta"&&$_POST["cancelar"]=="0") {
	
print_r($_POST);
 $res = $dev->getId($_POST["iddevolucion"]);



for($i=0;$i<$_POST["cont1"];$i++){
		 $f=0;

		$res3= $k->todasRemisionesPorCodigoFecha($_POST["error1_cant"][$i], $res["vendedores_idVendedores"], $_POST["error1_codigo"][$i], $res["fecha"]);
	        foreach($res3 as $row){
        $k->actualizarEstadoDevuelto1($row["idkardexvendedor"],$res["iddevolucion"],$res["fecha"]);


	        }
	}
	for($i=0;$i<$_POST["cont2"];$i++){
     $k->borrarKardexDuplicadosDevolucion($res["iddevolucion"],$_POST["error2_cant"][$i],$_POST["error2_codigo"][$i],$res["vendedores_idVendedores"]);
   
	       }


	       header("Location:".config::ruta()."?accion=verificarDevolucion&id=".$res["iddevolucion"]);

}
      

////////////////////////////////////////////////////////////////////////////////
      if(isset($_GET["id"])){
       $error1=array();
        $error2=array();
        

      $detalle=$det->getDetalle($_GET["id"]);
    
      $devolucion=$dev->getId($_GET["id"]);
      $filaskardex=$k->verFilasKardexIdDevolucion($_GET["id"]);

          $i=0;
      foreach ($detalle as $r) {
      	$c=$k->contarFilasKardexDevolucion($devolucion["iddevolucion"],$r["codigo"],$devolucion["vendedores_idVendedores"],"Devuelto");
      

      	if($r["cantidad"]>$c)
         $error1[$i]=["codigo"=>$r['codigo'],"cantidad"=>($r["cantidad"]-$c)];
      	if($r["cantidad"]<$c)
         $error2[$i]=["codigo"=>$r['codigo'],"cantidad"=>($c-$r["cantidad"])];
     $i++;
      }
      
      
    
      
      if(count($error1)>0||count($error2)>0){

	require_once("view/verificarDevolucion.php");
}
else{
  echo "carajitosd";

  $dev->actualizarEstado($devolucion["iddevolucion"]);

	header("Location:".config::ruta()."?accion=notasDevolucion");
    }


}


 ?>