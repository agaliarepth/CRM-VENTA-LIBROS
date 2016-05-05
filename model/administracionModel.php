<?php

class Administracion {
	static $tabla="administracion";
	static $objeto;
	static $idTabla="idadministracion";
	
	public  $nombre;
	public  $username;
	public  $password;
	
  
  
	
	function __construct(){
		
		self::$objeto=get_object_vars($this);
		}
		public function get_objeto(){
			
			self::$objeto=get_object_vars($this);
			
			return self::$objeto;
			}
			
			public function get_tabla(){
							
			           return self::$tabla;
			}
			
			public function get_id(){
							
			           return self::$idTabla;
			}
			
			public function logout(){
				session_destroy();
				header("Location:".config::ruta()."?accion=index&m=3");
				
				
				}
			
			public function logeo(){
				global $db;
				if($_POST["username"]==""&&$_POST["password"]=="" ){
					
					header("Location:".config::ruta()."?accion=index&m=1");exit;
					
					}
					$sql="SELECT ".self::$idTabla." FROM ".self::$tabla." WHERE username='".$_POST["username"]."' AND password='".$_POST["password"]."'";
					$res=$db->query($sql)->fetchColumn() ;
					
					if($res==0){
						return false;
						header("Location:".config::ruta()."?accion=index&m=2");exit;
						
						}
						else{
							if($res1=$db->query($sql)->fetchObject())
							{
								$_SESSION["ses_id"]=$res1->idadministracion;
								$_SESSION["ses_login"]=$_POST["username"];
								$_SESSION["modulo_administracion"]="1";
								return true;
								header("Location:".config::ruta()."?accion=home");
								
							}
							
							
							}
										
				
			}
			function limpiarBaseDatos(){
				 global $db;
				$sql="";
$sql.=" TRUNCATE TABLE pagoscuotainicial; ";
$sql.=" TRUNCATE TABLE CREDITO; ";
$sql.=" TRUNCATE TABLE detalle_contrato; ";
$sql.=" TRUNCATE TABLE CONTADO; ";
$sql.=" TRUNCATE TABLE contratos; ";
$sql.=" TRUNCATE TABLE detalle_cuenta; ";
$sql.=" TRUNCATE TABLE cuentas; ";
 $sql.=" TRUNCATE TABLE detalledevolucion; ";
$sql.=" TRUNCATE TABLE detalleingreso; "; 
$sql.=" TRUNCATE TABLE detalle_devolucionobras; ";
$sql.=" TRUNCATE TABLE detalle_egreso; ";
$sql.=" TRUNCATE TABLE detalle_nota_pedido; ";
$sql.=" TRUNCATE TABLE detalle_remision; ";
$sql.=" TRUNCATE TABLE detalle_traspaso; ";
$sql.=" TRUNCATE TABLE detalle_traspaso_almacen; ";

$sql.=" TRUNCATE TABLE devolucion; ";
$sql.=" TRUNCATE TABLE devolucionobras; ";
$sql.=" TRUNCATE TABLE editoriales; ";
$sql.=" TRUNCATE TABLE egreso; ";
$sql.=" TRUNCATE TABLE facturas; ";
$sql.=" TRUNCATE TABLE ingreso; ";
$sql.=" TRUNCATE TABLE kardexvendedor; ";
$sql.=" TRUNCATE TABLE nota_pedido; ";
$sql.=" TRUNCATE TABLE pagos; ";
$sql.=" TRUNCATE TABLE pagoscontado; ";
$sql.=" TRUNCATE TABLE pagoscuotas; ";

$sql.=" TRUNCATE TABLE recibos; ";
$sql.=" TRUNCATE TABLE referencias; ";
$sql.=" TRUNCATE TABLE remision ;";

$sql.=" TRUNCATE TABLE traspasos; ";
$sql.=" TRUNCATE TABLE traspaso_almacen; ";


$res=$db->query($sql);
				
				}
				
	
	}
		
	/*$u=new Usuarios();
	$u->logeo("123","123");*/
	
	?>