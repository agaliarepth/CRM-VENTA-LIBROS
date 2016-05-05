<?php
require_once("model/librosModel.php");
require_once("model/categoriasModel.php");
require_once("model/editorialesModel.php");



	 $c=new Libros();
	 $cate=new Categorias();
	 $edit=new Editoriales();
	$res= $cate->autocompletar();
	$res2=$edit->autocompletar();
	
	
 if(isset($_POST["id"])&& $_POST["id"]=="enviar"){
	 $e[]=array();
	  
    	if($_POST["codigo"]==""){$e[1]= '<span class="error">Ingrese su codigo</span>';}
		  else if($c->validarCodigo($_POST["codigo"])>0){$e[1]= '<span class="error">Este Codigo ya esta Registrado</span>';}
		  else if($_POST["titulo"]==""){$e[2]= '<span class="error">Ingrese un titulo</span>';}
		    //else if(!is_numeric($_POST["precio_base"])){$e[3]= '<span class="error">Ingrese un Numero</span>';}
		  
						
		else{	
	  $c->foto=$c->guardarFoto();
	  $c->codigo=$_POST["codigo"];
    	$c->titulo=htmlentities($_POST["titulo"], ENT_QUOTES,'UTF-8');
     $c->stock="0";
	 $c->stock_reservado="0";
		
	 $c->categorias_idcategorias=$_POST["categorias"];
	 $c->precio_base=str_replace(',','.',$_POST["precio_base"]);
	 $c->precio_final=str_replace(',','.',$_POST["precio_final"]);
	 $c->tomo=$_POST["tomo"];
	 $c->num_danados="0";
     $c->observacion=$_POST["observaciones"];
	 $cadena = explode("/",$_POST["editoriales"]);
      $c->ideditoriales=$cadena[0];
	  $c->nombre_editorial=$cadena[1];
	  $c->stock_minimo=$_POST["stock_minimo"];
	  if($_POST["stock"]==""){$c->stock_disponible=0;}
	  else{$c->stock_disponible=$_POST["stock"];}
	  
	  $c->nuevo();	
	header("Location:".config::ruta()."?accion=addLibros&m=1");

		}

	 
 }

require_once("view/addLibros.php");

?>