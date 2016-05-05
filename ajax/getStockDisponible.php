<?php

require_once("../helpers/conexion.php");
      $id= $_POST['idlibro'];
       $idalmacen=$_GET["idalmacen"];
      if(!empty($id)) {
            buscar($id,$idalmacen);
      }
       
      function buscar($idlibro,$idalmacenes) {
          global $db;
       $ing=0;
	   $devo=0;
	   $remi=0;
	   $egr=0;
            $sql ="SELECT sum(cantidad) as total  FROM detalleingreso,ingreso WHERE detalleingreso.libros_idlibros='".$idlibro."' AND detalleingreso.ingreso_idingreso=ingreso.idingreso AND ingreso.idalmacenes='".$idalmacenes."' AND ingreso.terminado=1 AND ingreso.estado='Enviado'";
			  $res1=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
			  
			  $ing=$res1["total"];
			  
			  
			  $sql ="SELECT sum(detalledevolucion.cantidad) as total  FROM detalledevolucion,devolucion WHERE detalledevolucion.libros_idlibros='".$idlibro."' AND detalledevolucion.devolucion_iddevolucion=devolucion.iddevolucion AND devolucion.idalmacenes='".$idalmacenes."' AND devolucion.terminado=1 AND devolucion.estado='Devuelto'";
			  $res1=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
			  
			  $devo=$res1["total"];
			  
			  $sql ="SELECT sum( detalle_remision.cantidad) as total  FROM remision,detalle_remision WHERE detalle_remision.libros_idlibros='".$idlibro."' AND detalle_remision.remision_idremision=remision.idremision AND remision.idalmacenes='".$idalmacenes."' AND remision.estado='registrado'";
			  $res1=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
			  
			  $remi=$res1["total"];
			  
			  
			  $sql ="SELECT sum(detalle_egreso.cantidad) as total  FROM detalle_egreso,egreso WHERE detalle_egreso.libros_idlibros='".$idlibro."' AND detalle_egreso.egreso_idegreso=egreso.idegreso AND egreso.idalmacenes='".$idalmacenes."' AND egreso.terminado=1 AND egreso.estado='Enviado'";
			  $res1=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
			  
			  $egr=$res1["total"];
             
			   $sql ="SELECT sum( detalle_nota_pedido.cantidad) as total  FROM detalle_nota_pedido,nota_pedido WHERE detalle_nota_pedido.libros_idlibros='".$idlibro."' AND detalle_nota_pedido.nota_pedido_idnota_pedido=nota_pedido.idnota_pedido AND nota_pedido.idalmacenes='".$idalmacenes."' AND nota_pedido.estado='SIN REMITIR' AND nota_pedido.terminado=1";
			  $res1=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
			  
			  $reservado=$res1["total"];
			  
			   $sql ="SELECT sum( detalle_traspaso_almacen.cantidad) as total  FROM detalle_traspaso_almacen,traspaso_almacen WHERE detalle_traspaso_almacen.traspaso_almacen_idtraspaso_almacen=traspaso_almacen.idtraspaso_almacen AND detalle_traspaso_almacen.libros_idlibros='".$idlibro."' AND  traspaso_almacen.idalmacen_recibe='".$idalmacenes."' AND traspaso_almacen.estado='ENVIADO' AND traspaso_almacen.terminado=1";
			  $res1=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
			  
			  $traspasosuma=$res1["total"];
			  
			   $sql ="SELECT sum( detalle_traspaso_almacen.cantidad) as total  FROM detalle_traspaso_almacen,traspaso_almacen WHERE detalle_traspaso_almacen.traspaso_almacen_idtraspaso_almacen=traspaso_almacen.idtraspaso_almacen AND detalle_traspaso_almacen.libros_idlibros='".$idlibro."' AND  traspaso_almacen.idalmacen_envia='".$idalmacenes."' AND traspaso_almacen.estado='ENVIADO' AND traspaso_almacen.terminado=1";
			  $res1=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
			  
			  $traspasoresta=$res1["total"];
			  
			 
			 
            $stock=($ing+$devo+$traspasosuma)-($remi+$egr);
			
             
            if($stock<= 0){
                  echo "0";
            }else{
                  echo $stock;
            }
      }    
?>