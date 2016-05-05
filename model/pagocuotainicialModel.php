<?php
class pagosCuotaInicial{
	static $tabla="pagoscuotainicial";
	static $idTabla="idcuota_inicial";
	static $objeto;
	static $lastId;
	
	public  $monto;
	public  $fecha;
	public  $terminado;
	public $credito_idcredito;
	public $tipo;
	//public $facturas_idfacturas;
	//public $recibos_idrecibos;
	
	
  
  
	
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
				self::$lastId=$db->lastID("idcuota_inicial"); 

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
				
				
	         public   function getPagosCuotaCredito($id){
				global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE credito_idcredito='".$id."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}
				
				public   function getPagosCuotaCreditoTipo($id,$tipo){
				global $db;
				$sql="SELECT reciboscuotas.monto, reciboscuotas.numero,reciboscuotas.fecha from pagoscuotainicial,reciboscuotas where   pagoscuotainicial.idcuota_inicial=reciboscuotas.pagoscuotainicial_idcuota_inicial  AND pagoscuotainicial.credito_idcredito='".$id."' and pagoscuotainicial.tipo='".$tipo."' ORDER BY reciboscuotas.fecha asc";
				$res=$db->query($sql)->fetchAll();
				return($res);
				}
				
			public   function sumPagos($idcredito){
				global $db;
				$sql="SELECT sum(monto) as total FROM ".self::$tabla." WHERE credito_idcredito='".$idcredito."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["total"]);
				
				}
				
				
				
	  
	
	
	}


	?>