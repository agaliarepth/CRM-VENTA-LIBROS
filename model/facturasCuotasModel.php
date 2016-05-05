<?php
class FacturasCuotas{
	static $tabla="facturasCuotas";
	static $idTabla="idfacturas";
	static $objeto;
	static $lastId;
	
	public  $fecha;
	public  $monto;
	public  $nombres;
	public $cinit;
	public  $descripcion;
	public  $pagoscuotainicial_idcuota_inicial;
	public  $numero;
	
	
	
  
  
	
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
				self::$lastId=$db->lastID("idfacturas"); 

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
			
	         public   function getId($id){
				global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}	
				 public   function getPorDocumento($id){
				global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE pagoscuotainicial_idcuota_inicial='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}	
				
				
				public   function reportePagos($fecha1,$fecha2){
				global $db;
				$sql="SELECT facturascuotas.fecha,facturascuotas.monto,facturascuotas.numero,view_contrato_credito.numcontrato,view_contrato_credito.nombres,view_contrato_credito.apellidomaterno,view_contrato_credito.apellidopaterno,view_contrato_credito.idvendedor FROM facturascuotas,pagoscuotainicial,view_contrato_credito WHERE facturascuotas.pagoscuotainicial_idcuota_inicial=pagoscuotainicial.idcuota_inicial AND pagoscuotainicial.credito_idcredito=view_contrato_credito.idcredito AND facturascuotas.fecha BETWEEN '".$fecha1."' AND '".$fecha2."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}	
	  
	
	
	}


	?>