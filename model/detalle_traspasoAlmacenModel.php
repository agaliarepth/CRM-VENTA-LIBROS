<?php
class detalleTraspasoAlmacen {
	static $tabla="detalle_traspaso_almacen";
	static $idTabla="iddetalle_traspaso_almacen";
	static $objeto;
	static $consulta;
	
	public  $cantidad;
	public  $codigo;
	public  $titulo;
	public  $volumen;
	public  $obs;
	public  $libros_idlibros;
	public  $traspaso_almacen_idtraspaso_almacen;
	
	
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
				
				self::$consulta=substr(self::$consulta, 0, -1);
			    $this->get_objeto();
				$sql="INSERT INTO ".self::$tabla."(";
				$sql.=join(",",array_keys(self::$objeto));
				$sql.=") VALUES ";
		        $sql.=self::$consulta;
				$db->query($sql);
				self::$consulta="";
				return  $sql;
				
				}	
			public function insertar(){
				 $this->get_objeto();
				 
				
			   self::$consulta.= "('";
				self::$consulta.=join("','",array_values(self::$objeto));
				self::$consulta.="'),";
				
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
						
			public function borrarPorTraspaso($id){
							
							global $db;
				$sql="delete  FROM ".self::$tabla." WHERE traspaso_almacen_idtraspaso_almacen='".$id."'";
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
				$sql="SELECT * FROM ".self::$tabla." WHERE traspaso_almacen_idtraspaso_almacen ='".$id."' order by codigo";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
					
					 public   function sumIngresoInventarioEnvia($mes , $anio,$idlibro,$id){
				global $db;
				$sql="SELECT sum( detalle_traspaso_almacen.cantidad) as suma  FROM detalle_traspaso_almacen,traspaso_almacen WHERE  MONTH(traspaso_almacen.fecha)='".$mes."' AND YEAR(traspaso_almacen.fecha)='".$anio."' AND detalle_traspaso_almacen.traspaso_almacen_idtraspaso_almacen=traspaso_almacen.idtraspaso_almacen AND detalle_traspaso_almacen.libros_idlibros='".$idlibro."' AND  traspaso_almacen.idalmacen_envia='".$id."' AND traspaso_almacen.estado='ENVIADO' AND traspaso_almacen.terminado=1";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["suma"]);
				
				}	
					 public   function sumIngresoInventarioAntEnvia($mes , $anio,$idlibro,$id){
				global $db;
				$fecha=$anio."-".$mes."-31";
				$sql="SELECT sum( detalle_traspaso_almacen.cantidad) as suma  FROM detalle_traspaso_almacen,traspaso_almacen WHERE  traspaso_almacen.fecha between '2013-1-1' AND '".$fecha."' AND detalle_traspaso_almacen.traspaso_almacen_idtraspaso_almacen=traspaso_almacen.idtraspaso_almacen AND detalle_traspaso_almacen.libros_idlibros='".$idlibro."' AND  traspaso_almacen.idalmacen_envia='".$id."' AND traspaso_almacen.estado='ENVIADO' AND traspaso_almacen.terminado=1";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["suma"]);
				
				}	
					
					 public   function sumIngresoInventarioRecibe($mes , $anio,$idlibro,$id){
				global $db;
				$sql="SELECT sum( detalle_traspaso_almacen.cantidad) as suma  FROM detalle_traspaso_almacen,traspaso_almacen WHERE  MONTH(traspaso_almacen.fecha)='".$mes."' AND YEAR(traspaso_almacen.fecha)='".$anio."' AND detalle_traspaso_almacen.traspaso_almacen_idtraspaso_almacen=traspaso_almacen.idtraspaso_almacen AND detalle_traspaso_almacen.libros_idlibros='".$idlibro."' AND  traspaso_almacen.idalmacen_recibe='".$id."' AND traspaso_almacen.estado='ENVIADO' AND traspaso_almacen.terminado=1";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["suma"]);
				
				}	
					 public   function sumIngresoInventarioAntRecibe($mes , $anio,$idlibro,$id){
				global $db;
				$fecha=$anio."-".$mes."-31";
				$sql="SELECT sum( detalle_traspaso_almacen.cantidad) as suma  FROM detalle_traspaso_almacen,traspaso_almacen WHERE  traspaso_almacen.fecha between '2013-1-1' AND '".$fecha."' AND detalle_traspaso_almacen.traspaso_almacen_idtraspaso_almacen=traspaso_almacen.idtraspaso_almacen AND detalle_traspaso_almacen.libros_idlibros='".$idlibro."' AND  traspaso_almacen.idalmacen_recibe='".$id."' AND traspaso_almacen.estado='ENVIADO' AND traspaso_almacen.terminado=1";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["suma"]);
				
				}	
				
				
				 public function   getMesRecibe($idlibro,$ini,$fin,$id){
				 global $db;
				$sql="SELECT * FROM  view_traspasoalmacen_detalle WHERE libros_idlibros='".$idlibro."' AND (fecha between '".$ini."' AND '".$fin."')  AND estado='ENVIADO' AND terminado=1 AND idalmacen_recibe='".$id."' order by fecha asc";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}
					 public   function sumTraspasoRecibe($fecha,$idlibro,$id){
				global $db;
				$sql="SELECT sum(cantidad) as suma FROM view_traspasoalmacen_detalle WHERE fecha between '2013-1-1' AND '".$fecha."' AND libros_idlibros='".$idlibro."' AND idalmacen_recibe='".$id."' AND estado='ENVIADO' AND  terminado=1 ";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}	
				
				
				 public function   getMesEnvia($idlibro,$ini,$fin,$id){
				 global $db;
				$sql="SELECT * FROM  view_traspasoalmacen_detalle WHERE libros_idlibros='".$idlibro."' AND (fecha between '".$ini."' AND '".$fin."')  AND estado='ENVIADO' AND terminado=1 AND idalmacen_envia='".$id."' order by fecha asc";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}
					 public   function sumTraspasoEnvia($fecha,$idlibro,$id){
				global $db;
				$sql="SELECT sum(cantidad) as suma FROM view_traspasoalmacen_detalle WHERE fecha between '2013-1-1' AND '".$fecha."' AND libros_idlibros='".$idlibro."' AND idalmacen_envia='".$id."' AND estado='ENVIADO' AND  terminado=1 ";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}	
					
}
	  
	?>