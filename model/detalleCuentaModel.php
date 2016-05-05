<?php
class detalleCuenta{
	static $tabla="detalle_cuenta";
	static $idTabla="iddetalle_cuenta";
	static $objeto;
	
	public  $cantidad;
	public  $codigo;
	public  $titulo;
	public  $volumen;
	public  $libros_idlibros;
	public  $cuentas_idcuentas;
	public  $precio_unitario;
	public $sw;
	
	
	
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
			
			private  static function instanciar($reg){
					$obj=new self;
					foreach($reg as $atrib=>$valor){
						if($obj->atributos($atrib))
						$obj->$atrib=$valor;
						}
					return $obj;
					}
				private function atributos($atributo){
					$var=get_object_vars($this);
					return array_key_exists($atributo,$var);
					
					}	
				
				 public function   listarTodos(){
				 global $db;
				$sql="SELECT * FROM ".self::$tabla;
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}
			
			public function nuevo(){
				global $db;
				
				
			    $this->get_objeto();
				$sql="INSERT INTO ".self::$tabla."(";
				$sql.=join(",",array_keys(self::$objeto));
				$sql.=") VALUES ('";
				$sql.=join("','",array_values(self::$objeto));
				$sql.="')";
		
				$db->query($sql);
				//return  $sql;
				
				}	
				
				
			public  function actualizar($id){
				global $db;
				$this->get_objeto();
				  $pares=array();
				  foreach(self::$objeto as $key=>$value){
					  $pares[]="{$key}='{$value}'";
					  
					  }
				$sql="UPDATE ".self::$tabla." SET ";
				$sql.=join(", ",$pares);
				$sql.=" WHERE ".self::$idTabla."='".$id."'";
				$db->query($sql);
				
				}
				
				
				
			public function borrar($id){
							
							global $db;
				$sql="delete  FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
				$res=$db->query($sql);
				 
				return ($res);
						}
						
							public function borrarCuenta($id){
							
							global $db;
				$sql="delete  FROM ".self::$tabla." WHERE cuentas_idcuentas='".$id."'";
				$res=$db->query($sql);
				 
				return ($res);
						}
						
						public function borrarPorContrato($idContrato){
							
							global $db;
				$sql="delete  FROM ".self::$tabla." WHERE contratos_idcontratos='".$idContrato."'";
				$res=$db->query($sql);
				 
				return ($res);
						}
			
	         public   function getId($id){
				global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}	
				public function validarCodigo($cod){
					
					global $db;
				$sql="SELECT count(codigo) FROM ".self::$tabla." WHERE codigo ='".$cod."'";
				$res=$db->query($sql)->fetchColumn();
				return ($res);
					
					}
					public function getDetalle($id){
					
					 global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE cuentas_idcuentas ='".$id."' order by codigo";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
					
					public function getDetalleHabilitados($id){
					
					 global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE cuentas_idcuentas ='".$id."'  AND  sw=0 order by codigo";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
					
					public function sumarHabilitados($idcuenta){
					
					 global $db;
				$sql="SELECT sum(precio_unitario) as suma  FROM ".self::$tabla." WHERE sw =0 AND cuentas_idcuentas='".$idcuenta."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["suma"]);
					}
					public function sumarPorCodigo($idlibro,$idcontrato){
					
					 global $db;
				$sql="SELECT sum(cantidad)  FROM ".self::$tabla." WHERE libros_idlibros ='".$idlibro."' AND contratos_idcontratos='".$idcontrato."'";
				$res=$db->query($sql)->fetchColumn();
				return ($res);
					}
					
						public function actualizarVista($id,$sw){
					
					 global $db;
				$sql="UPDATE  ".self::$tabla." SET sw='".$sw."' WHERE  ".self::$idTabla."='".$id."'";
				$res=$db->query($sql);
				return ($res);
					}
					
}
	  
	?>