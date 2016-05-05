<?php
//require_once("../helpers/conexion.php");
class librosAlmacenes {
	static $tabla="libros_has_almacenes";
	static $idTabla1="libros_idlibros";
	static $idTabla2="almacenes_idalmacenes";

	static $objeto;
	static $lastId;
	
	public  $libros_idlibros;
	public  $almacenes_idalmacenes;
	public  $stock;
	public  $stock_reservado;
	public  $stock_disponible;
	
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
			
			public function get_id1(){
							
			           return self::$idTabla1;
			}
			public function get_id2(){
							
			           return self::$idTabla2;
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
			
			
			 public function   verStockAlmacen($idalmacen,$idcategorias){
				 global $db;
				$sql="SELECT libros.codigo,libros.titulo,libros.foto, libros.tomo,libros.nombre_editorial,libros.precio_base,libros.categorias_idcategorias,libros_has_almacenes.stock,libros_has_almacenes.stock_reservado,libros_has_almacenes.stock_disponible FROM libros , libros_has_almacenes WHERE libros_has_almacenes.almacenes_idalmacenes='".$idalmacen."' AND libros_has_almacenes.libros_idlibros=libros.idlibros  AND libros.categorias_idcategorias='".$idcategorias."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}
				
				 public function   getStockAlmacen($idalmacen){
				 global $db;
				$sql="SELECT libros_idlibros,stock,stock_reservado,stock_disponible,almacenes_idalmacenes FROM  libros_has_almacenes WHERE libros_has_almacenes.almacenes_idalmacenes='".$idalmacen."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}
			
			public function nuevo(){
				global $db;
				$this->get_objeto();
			
			    $sql="INSERT INTO ".self::$tabla."(".self::$idTabla1.",".self::$idTabla2.",stock,stock_reservado,stock_disponible)";
				$sql.="VALUES ('";
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
			
	         public   function getId($id){
				global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}
				
				  public   function actualizarEstado($id,$estado){
				global $db;
				$sql="UPDATE ".self::$tabla." SET estado='".$estado."' WHERE ".self::$idTabla."='".$id."'";
				$res=$db->query($sql);
				return ($res);
				
				}	
				
				public function getStock($id1,$id2){
						global $db;
				         $sql="SELECT stock FROM ".self::$tabla." WHERE ".self::$idTabla1."='".$id1."' AND ".self::$idTabla2."='".$id2."'" ;
						$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["stock"]);
						}
						public function getStockReservado($id1,$id2){
						global $db;
				         $sql="SELECT stock_reservado FROM ".self::$tabla." WHERE ".self::$idTabla1."='".$id1."' AND ".self::$idTabla2."='".$id2."'" ;
						$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				       return ($res["stock_reservado"]);
						}
						
						
						public function getStockDisponible($id1,$id2){
						global $db;
				         $sql="SELECT stock_disponible FROM ".self::$tabla." WHERE ".self::$idTabla1."='".$id1."' AND ".self::$idTabla2."='".$id2."'" ;
						$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				       return ($res["stock_disponible"]);
						}
						
						public function sumarStock($id1,$id2,$cantidad){
					  
						global $db;
						
							$sql="UPDATE ".self::$tabla." SET stock=stock+".$cantidad." WHERE ".self::$idTabla1."='".$id1."' AND ".self::$idTabla2."='".$id2."'" ;
							$res=$db->query($sql);
							}
			
						
						
						public function reservar($id,$idalmacen,$cantidad){
						
						global $db;
				$sql="UPDATE ".self::$tabla." SET stock_reservado=stock_reservado+".$cantidad." WHERE ".self::$idTabla1."='".$id."' AND ".self::$idTabla2."='".$idalmacen."'";
						$res=$db->query($sql);
						}
						
						public function quitarStock($id1,$id2,$cantidad){
						global $db;
				$sql="UPDATE ".self::$tabla." SET stock=stock-".$cantidad." WHERE ".self::$idTabla1."='".$id1."' AND ".self::$idTabla2."='".$id2."'" ;
						$res=$db->query($sql);
						}
						
						public function quitarStockEgreso($id1,$id2,$cantidad){
						global $db;
				$sql="UPDATE ".self::$tabla." SET stock=stock-".$cantidad." WHERE ".self::$idTabla1."='".$id1."' AND ".self::$idTabla2."='".$id2."'" ;
						$res=$db->query($sql);
						}
						
						public function reponerReserva($id1,$id2,$cantidad){
						
						
						global $db;
				$sql="UPDATE ".self::$tabla." SET stock_reservado=stock_reservado-".$cantidad." WHERE ".self::$idTabla1."='".$id1."' AND ".self::$idTabla2."='".$id2."'" ;
						$res=$db->query($sql);
						}
						
						public function reponerStock($id1,$id2,$cantidad){
						
						global $db;
				$sql="UPDATE ".self::$tabla." SET stock=stock+".$cantidad."  WHERE ".self::$idTabla1."='".$id1."' AND ".self::$idTabla2."='".$id2."'" ;
						$res=$db->query($sql);
						}

				
				
				public function validarExiste($idlibros,$idalmacen){
					
					global $db;
				$sql="SELECT count(".self::$idTabla1.") FROM ".self::$tabla." WHERE ".self::$idTabla1." ='".$idlibros."' AND ".self::$idTabla2."='".$idalmacen."'";
				$res=$db->query($sql)->fetchColumn();
				return ($res);
					
					}
	  
	public function updateStockAlmacen($idlibros,$idalmacen,$stock,$stock_disponible,$stock_reservado){
					
					global $db;
					$sql="UPDATE ".self::$tabla." SET stock='".$stock."', stock_reservado='".$stock_reservado."', stock_disponible='".$stock_disponible."' WHERE ".self::$idTabla1."='".$idlibros."' AND ".self::$idTabla2."='".$idalmacen."'" ;
			$res=$db->query($sql);
				return ($res);
					
					}
	
	}
//$p=new librosAlmacenes();
/*$p->libros_idlibros="1";
$p->almacenes_idalmacenes="1";
$p->stock="200";
$p->stock_reservado="100";
$p->stock_disponible="100";
$p->nuevo();*/
//$p->reponerStock("13","3","10");



	?>