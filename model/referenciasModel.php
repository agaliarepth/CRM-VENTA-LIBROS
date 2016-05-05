<?php
class Referencias{
	static $tabla="referencias";
	static $idTabla="idreferencias";
	static $objeto;
	static $lastId;
	
	
public $edad; 	
public $expedidoci; 	
public $nit; 	
public $direccion;
public $dir_num; 	
public $telf; 	
public $cel; 	
public $barrio;
public $zona; 	
public $tipocasa; 	
public $tiempovivemes; 
public $tiempoviveanio; 	
public $fechavigente;
public $nombrepropietariocasa; 	
public $detallecasa;
public $telfpropietario; 	
public $emailpropietario;
public $centrotrabajo; 	
public $cargoocupa; 	
public $antiguedad;
public $jefeinmediato; 	
public $direcciontrabajo; 	
public $numtrabajo;
public $telftrabajo; 	
public $barriotrabajo; 	
public $zonatrabajo;
public $ingreso; 	
public $otrosingresos; 	
public $totalingresos; 	
public $nombrepareja; 	
public $cipareja; 	
public $celpareja;
public $trabajopareja; 	
public $cargopareja; 	
public $antiguedadpareja;
public $dirtrabajopareja; 	
public $numdirtrabajopareja; 	
public $telftrabajopareja;
public $barriotrabajopareja; 	
public $zonatrabajopareja;
public $nombrehijos1; 	
public $colegiohijos1; 	
public $cursohijos1; 	
public $zonahijos1;
public $nombrehijos2; 	
public $colegiohijos2; 	
public $cursohijos2; 	
public $zonahijos2;
public $otrasref; 	
public $nombregarante; 	
public $cigarante; 	
public $expedidogarante;
public $dirgarante; 	
public $numgarante; 	
public $telfgarante; 	
public $celgarante; 	
public $barriogarante;
public $zonagarante; 	
public $trabajogarante; 	
public $cargogarante; 	
public $antiguedadgarante;
public $dirtrabajogarante; 	
public $numtrabajogarante; 	
public $telftrabajogarante;
public $barriotrabajogarante; 	
public $zonatrabajogarante; 	
public $diacobrar; 	
public $horascobrar; 	
public $observaciones; 	
public $lugarcobranza;
public $credito_idcredito;
	

	
	
  
  
	
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
				self::$lastId=$db->lastID("idingreso"); 

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
				
				  public   function getCredito($idcredito){
				global $db;
				$sql="SELECT idreferencias,zona,barrio,direccion,telf,lugarcobranza,diacobrar FROM ".self::$tabla." WHERE credito_idcredito='".$idcredito."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}

    public function getReferenciaCredito($idcredito){
        global $db;
        $sql="SELECT count(idreferencias)  FROM ".self::$tabla." WHERE credito_idcredito='".$idcredito."'";
        $res=$db->query($sql)->fetchColumn();
        return ($res);
    }
    public function getReferenciaPorCredito($idcredito){
        global $db;
        $sql="SELECT *  FROM ".self::$tabla." WHERE credito_idcredito='".$idcredito."'";
        $res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return ($res);
    }
	  
	
	
	}


	?>