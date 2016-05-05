<?php
class Cuotas {
	static $tabla="cuotas";
	static $idTabla="idcuotas";
	static $objeto;
	static $lastId;
	
	
public $monto; 	
public $fechavencimiento; 	
public $credito_idcredito;
public $numcuota; 	
public $estado; 
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
				self::$lastId=$db->lastID("idcuotas"); 
				
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
				
				 public function   listarTodos(){
				 global $db;
				 $this->get_objeto();
				$sql="SELECT * FROM ".self::$tabla." ORDER BY ".self::$idTabla." DESC";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
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
				
				 public   function getIdCuentas($id){
				global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE credito_idcredito='".$id."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}	
				
				 public   function getIdCuentasActivas($id){
				global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE credito_idcredito='".$id."' AND estado=1 AND sw=1";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}	
				
				 public   function updateEstado($cuentas_idcuentas,$estado,$sw,$estado_ant,$sw_ant){
				global $db;
				$sql="UPDATE ".self::$tabla." SET estado=".$estado." , sw=".$sw." WHERE credito_idcredito='".$cuentas_idcuentas."' AND estado='".$estado_ant."' AND  sw='".$sw_ant."'";
				$res=$db->query($sql);
				return ($res);
				
				}
    public   function updateEstadoCuota($idcuotas,$estado,$sw){
        global $db;
        $sql="UPDATE ".self::$tabla." SET estado=".$estado." , sw=".$sw." WHERE idcuotas='".$idcuotas."'";
        $res=$db->query($sql);
        return ($res);

    }
    public   function contarCuotas($idcredito){
				global $db;
				$sql="SELECT count(idcuotas) as numcuotas , monto FROM ".self::$tabla." WHERE credito_idcredito='".$idcredito."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				
				}
               public   function borrarCredito($idcredito){
               global $db;
               $sql="DELETE FROM  ".self::$tabla." WHERE credito_idcredito='".$idcredito."'";
               $res=$db->query($sql);
               return ($res);
               }

                public   function borrarPorEstado($idcredito,$estado,$sw){
               global $db;
               $sql="DELETE FROM  ".self::$tabla." WHERE credito_idcredito='".$idcredito."' AND estado='".$estado."' AND  sw='".$sw."'";
               $res=$db->query($sql);
               return ($res);
               }
               
               








}








					
	
	


	?>