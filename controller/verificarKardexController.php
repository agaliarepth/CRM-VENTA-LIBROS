<?php 

require_once("model/vendedoresModel.php");
require_once("model/contratosModel.php");
require_once("model/librosModel.php");
require_once("model/kardexVendedorModel.php");
require_once("model/detalle_contratoModel.php");

$ve=new Vendedores();
$k=new kardexVendedor();
$li=new Libros();
$det=new detalleContrato();
$c=new Contrato();

if(isset($_POST["cancelar"])&&$_POST["cancelar"]=="cancelar"){
	$contrato=$c->getId($_POST["idcontrato"]);
 if($contrato["idvendedor"]==$contrato["idchofer"]){
	 
	 $k->actualizarEstadoRemitidoPorNumContrato($contrato["idchofer"],$contrato["numcontrato"]);
	 }
	 
	 else{
		 $k->borrarRemisionPorVendedorContrato($contrato["idvendedor"],$contrato["numcontrato"]);
		  $k->actualizarEstadoRemitidoPorNumContrato($contrato["idchofer"],$contrato["numcontrato"]);
		 
		 }
				
header("Location:".config::ruta()."?accion=editcontrato&id=".$contrato["idcontratos"]);


}


if (isset($_POST["consulta"])&&$_POST["consulta"]=="consulta"&&$_POST["cancelar"]=="0") {
	
	$c=new Contrato();
	$k=new kardexVendedor();
 $res = $c->getId($_POST["idcontrato"]);
 $nombreCompleto=$res["nombres"]." ".$res["apellidopaterno"]." ".$res["apellidomaterno"];
//print_r($_POST);
 if($res["idchofer"]!=$res["idvendedor"]){


 if($_POST["cont1"]>0){
	for($i=0;$i<$_POST["cont1"];$i++){
		 $f=0;

		$res3= $k->todasRemisionesPorCodigoFecha($_POST["error1_cant"][$i], $res["idchofer"], $_POST["error1_codigo"][$i], $res["fechacontrato"]);
	        foreach($res3 as $row){
		$k->actualizarEstadoDiferidoTraspaso($res["idchofer"],$row["idkardexvendedor"],$_POST["error1_codigo"][$i],$res["numcontrato"],$nombreCompleto, $res["idcontratos"]);
	        }

  
	}
}
	//-----------------------------------------------------
	//en caso de que se dupliquen los items del chofer
	 if($_POST["cont3"]>0){
  for($i=0;$i<$_POST["cont3"];$i++){
     $k->actualizarEstadoRemitidoKardexDuplicados($res["idcontratos"],$_POST["error3_cant"][$i],$_POST["error3_codigo"][$i],$res["idchofer"]);
   
	       } 
	   }
//-------------------------------------------------------

	       	//-----------------------------------------------------
	//en caso de que se dupliquen los items del vendedor
   if($_POST["cont4"]>0){
  for($i=0;$i<$_POST["cont4"];$i++){
     $k->borrarKardexDuplicadosContratos($res["idcontratos"],$_POST["error4_cant"][$i],$_POST["error4_codigo"][$i],$res["idvendedor"]);
   
	       } //-------------------------------------------------------
	   }

  if($_POST["cont2"]>0){
$res3= $k->getFilaContratoChofer($res["idcontratos"],$res["idchofer"]);
$i=0;
  foreach ($res3 as $r) {
                if($r["cod_libro"]==$_POST["error2_codigo"][$i]){
            $k->fecha_remision=$r["fecha_remision"];
            $k->num_remision=$r[$i]["num_remision"];
            $k->fecha_devolucion="";
            $k->num_devolucion="";
            $k->cod_libro=$r["cod_libro"];
            $k->titulo_libro=$r["titulo_libro"];
            $k->estado_libro="Diferido";
            $k->num_contrato=$res["numcontrato"];
            $k->reg_ventas="";
            $k->nombres_cliente=$nombreCompleto;
            $k->vendedores_idVendedores=$res["idvendedor"];
            $k->idlibro=$r["idlibro"];
            $k->idalmacenes=$r["idalmacenes"];
            $k->tomo_libro=$r["tomo_libro"];
            $k->idcontrato=$res["idcontratos"];
            $k->cargo=0;
            $k->traspaso=0;
            $k->insertar();
             $k->nuevo();
                	$i++;
               }
           }

       }


}//fin de if

if($res["idchofer"]==$res["idvendedor"]){

for($i=0;$i<$_POST["cont2"];$i++){
		 $f=0;

		$res3= $k->todasRemisionesPorCodigoFecha($_POST["error2_cant"][$i], $res["idchofer"], $_POST["error2_codigo"][$i], $res["fechacontrato"]);
	        foreach($res3 as $row){
        $k->actualizarEstadoDiferido($row["idkardexvendedor"], $_POST["error2_codigo"][$i], $res["numcontrato"], $nombreCompleto, $res["idcontratos"]);


	        }
	}
	for($i=0;$i<$_POST["cont4"];$i++){
     $k->borrarKardexDuplicadosContratos($res["idcontratos"],$_POST["error4_cant"][$i],$_POST["error4_codigo"][$i],$res["idvendedor"]);
   
	       }

}

	       header("Location:".config::ruta()."?accion=verificarKardex&id=".$res["idcontratos"]);

}
      

if(isset($_GET["id"])){
       $error1=array();
        $error2=array();
        $error3=array();
         $error4=array();

      $detalle=$det->getDetalle($_GET["id"]);
    
      $contrato=$c->getId($_GET["id"]);
      $filaskardex=$k->verFilasKardexIdContrato($_GET["id"]);

      if($contrato["idchofer"]!=$contrato["idvendedor"]){
      	$i=0;
      foreach ($detalle as $r) {
      	$c=$k->contarFilasKardex($contrato["idcontratos"],$r["codigo"],$contrato["idchofer"],"Traspaso");
      	$c1=$k->contarFilasKardex($contrato["idcontratos"],$r["codigo"],$contrato["idvendedor"],"Diferido");

      	if($r["cantidad"]>$c)
         $error1[$i]=["codigo"=>$r['codigo'],"cantidad"=>($r["cantidad"]-$c)];
      	if($r["cantidad"]>$c1)
           $error2[$i]=["codigo"=>$r['codigo'],"cantidad"=>($r["cantidad"]-$c1)];
      if($r["cantidad"]<$c)
      	  $error3[$i]=["codigo"=>$r['codigo'],"cantidad"=>($c-$r["cantidad"])];
      	 if($r["cantidad"]<$c1)
      	  $error4[$i]=["codigo"=>$r['codigo'],"cantidad"=>($c1-$r["cantidad"])];
     $i++;
      }

if(count($error1)>0||count($error2)>0||count($error3)>0||count($error4)>0){
       
	require_once("view/verificarKardex.php");
}
else{
	require_once("model/contratosModel.php");
  
	$cont=new Contrato();
	$cont->updateTerminado($_GET["id"],1);

	header("Location:".config::ruta()."?accion=contratos");
}

  }//fin if

   else{
      	$i=0;
      foreach ($detalle as $r) {
      	$c=$k->contarFilasKardex($contrato["idcontratos"],$r["codigo"],$contrato["idchofer"],"Diferido");
      

      	if($r["cantidad"]>$c)
         $error2[$i]=["codigo"=>$r['codigo'],"cantidad"=>($r["cantidad"]-$c)];
      	if($r["cantidad"]<$c)
         $error4[$i]=["codigo"=>$r['codigo'],"cantidad"=>($c-$r["cantidad"])];
     $i++;
      }
      
      
    
      
      if(count($error2)>0||count($error4)>0){

	require_once("view/verificarKardex.php");
}
else{
	require_once("model/contratosModel.php");
   
  
   	$cont=new Contrato();
	$cont->updateTerminado($_GET["id"],1);

	header("Location:".config::ruta()."?accion=contratos");
    }
  }//fin else

}


 ?>