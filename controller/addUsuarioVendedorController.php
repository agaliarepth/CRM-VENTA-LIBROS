<?php 
require_once("model/usuariosModel.php");
require_once("model/perfilesModel.php");
require_once("model/vendedoresModel.php");
$v=new Vendedores();

	 $c=new Usuario();
	 $p=new Perfiles();
	 $res= $p->autocompletar();
 if(isset($_POST["id"])&& $_POST["id"]=="enviar"){
 $e[]=array();
	  
    	if($_POST["username"]==""){$e[1]= '<span class="error">Ingrese un nombre de Usuario</span>';}
		  else if($c->validarUsername($_POST["username"])>0){$e[1]= '<span class="error">Este Nombre de Usuario ya esta Registrado</span>';}
		  else if($_POST["cargo"]==""){$e[2]= '<span class="error">Ingrese su Cargo en la Empresa</span>';}
		  else if($_POST["nombres"]==""){$e[3]= '<span class="error">Ingrese su nombre y Apellidos</span>';}
		 
		  else{
		      
	         $c->username=$_POST["username"];
	         $c->password=$_POST["password"];
             $c->nombres=strtoupper($_POST["nombres"]);
	         $c->cargo=$_POST["cargo"];
	         $c->perfiles_idperfiles=$_POST["perfiles_idperfiles"];
             $c->idvendedores=$_POST["idvendedores"];
          	 $c->nuevo();
             $v->actualizarEstado($_POST["idvendedores"],"Usuario");
	
	header("Location:".config::ruta()."?accion=usuarios");

		  }
          
          
          
         
 }
 if(isset($_GET["id"])){
          
           $user=$v->getId($_GET["id"]);
          
            require_once("view/addUsuarioVendedor.php");
            
          }

require_once("view/addUsuarioVendedor.php");



?>