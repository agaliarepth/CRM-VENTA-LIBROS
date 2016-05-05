<?php
class TraspasoAlmacen{
	static $tabla="traspaso_almacen";
	static $idTabla="idtraspaso_almacen";
	static $objeto;
		static $lastId;

	
	public  $total;
	public  $fecha;
	public $estado;
	public $terminado;
	public $idalmacen_envia;
	public $idalmacen_recibe;
	public  $usuario;
	public $cargo;
	public $obs;
	public  $nombre_envia;
	public  $nombre_recibe;
	
	
	
	
	
	
	
	
	
  
  
	
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
				$sql="SELECT * FROM ".self::$tabla." ORDER BY ".self::$idTabla." DESC ";
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
				self::$lastId=$db->lastID("idtraspaso_almacen"); 
				
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
						
			public function getFecha($id){
				global $db;
				$sql="SELECT fecha FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
					return $res["fecha"];
				
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
	  public function updateEstado($estado,$terminado,$id){
					
					global $db;
				$sql="UPDATE ".self::$tabla." SET  estado ='".$estado."', terminado=".$terminado."  WHERE idtraspaso_almacen='".$id."'";
				$res=$db->query($sql);
				return ($res);
					
					}
	
	
	}


	?>