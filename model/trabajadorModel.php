<?php
require_once("../helpers/ManagementDB.php");
class Trabajadores extends ManagementDB{
	static $tabla="trabajadores";
	static $objeto;
	static $idTabla="idtrabajadores";
	
	public  $num_ficha;
	public  $ci;
	public  $nua;
	public  $nombres;
	public  $apellidos;
	public  $direccion;
	public  $Profesion;
	public  $cargo;
	public  $fecha_nac;
  
  
	
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
	
	}
	
	
	$t=new Trabajadores();
	/*$t->apellidos="galindo";
	$t->cargo="gwerente";
	$t->ci="506649010";
	$t->direccion="asdasda";
	$t->fecha_nac="10/03/1983";
	$t->nombres="elver";
	$t->nua="23423";
	$t->num_ficha="123123";
	$t->Profesion="ingeniero";
	$t->nuevo($t->get_tabla(),$t->get_objeto());*/
	//print_r($t->listarTodos($t->get_tabla()));

	$t->borrar($t->get_id(),222,$t->get_tabla());
	?>