<?php
require_once("model/librosModel.php");
require_once("model/categoriasModel.php");
require_once("model/editorialesModel.php");
	 $c=new Libros();
 $cate=new Categorias();
	$res1= $cate->autocompletar();
	 $edit=new Editoriales();
	 $res2=$edit->autocompletar();
 if(isset($_GET["e"])&& $_GET["e"]=="el"){
	
	$res=$c->getId($_GET["il"]);
	 
	 }
	 
	 if(isset($_POST["id"])&& $_POST["id"]=="enviar"){
      $e[]=array();
	  
    	if($_POST["codigo"]==""){$e[1]= '<span class="error">Ingrese su codigo</span>';}
		  //else if($c->validarCodigo($_POST["codigo"])>0){$e[1]= '<span class="error">Este Codigo ya esta Registrado</span>';}
		  else if($_POST["titulo"]==""){$e[2]= '<span class="error">Ingrese un titulo</span>';}
		  else{
		  $la=new Libros();
		  $res3=$la->getId($_POST["idValor"]);
	 $c->foto=$c->guardarFoto();
	  $c->codigo=$_POST["codigo"];
   	$c->titulo=htmlentities($_POST["titulo"], ENT_QUOTES,'UTF-8');
     $c->stock=$res3["stock"];
	 $c->stock_reservado=$res3["stock_reservado"];
	  $c->stock_disponible=$res3["stock_disponible"];
	 $c->stock_minimo=$res3["stock_minimo"];
	 
	 $c->categorias_idcategorias=$_POST["categorias"];
	 $c->precio_base=str_replace(',','.',$_POST["precio_base"]);
	 $c->precio_final=str_replace(',','.',$_POST["precio_final"]);
	 $c->tomo=$_POST["tomo"];
	 $c->num_danados="0";
     $c->observacion=$_POST["observaciones"];
	 $cadena = explode("/",$_POST["editoriales"]);
      $c->ideditoriales=$cadena[0];
	  $c->nombre_editorial=$cadena[1];
	 
	 
	
	 $c->actualizar($_POST["idValor"]);
	 header("Location:".config::ruta()."?accion=libros");
		  }
	 
 }
require_once("view/editLibros.php");

?>