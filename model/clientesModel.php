<?php

class Cliente {
	static $tabla="clientes";
	static $idTabla="idclientes";
	static $objeto;
	
idclientes 	
nombres 	
apellido_paterno 	
apellido_materno 	
edad 	
ci 
expedido_ci 	
nit 	
direccion 
dir_num 
telf 
cel 	
barrio 	
zona 	
tipo_casa 	
tiempo_vive 	
fecha_contrato_vigente 	
nombre_propietario_casa 	
detalle_casa 	
telf_propietario 	
email_propietario 	
centro_trabajo 	
cargo_ocupa 	
antiguedad 	
jefe_inmediato 	
direccion_trabajo 	
num_trabajo 	
telf_trabajo 	
barrio_trabajo 	
zona_trabajo 	
ingreso 	
otros_ingresos 	
total_ingresos 	
nombre_pareja 	
ci_pareja 	
cel_pareja 	
trabajo_pareja 	
cargo_pareja 	
antiguedad_pareja 	
dir_trabajo_pareja 	
num_dir_trabajo_pareja 	
telf_trabajo_pareja 	
barrio_trabajo_pareja 	
zona_trabajo_pareja 	
nombre_hijos1 	
colegio_hijos1 
curso_hijos1 	
zona_hijos1 	
nombre_hijos2 	
colegio_hijos2 	
curso_hijos2 	
zona_hijos2 	
otras_ref 	
nombre_garante 
ci_garante 	
expedido_garante 	
dir_garante 	
num_garante 	
telf_garante 	
cel_garante 	
barrio_garante 	
zona_garante 	
trabajo_garante 	
cargo_garante 	
antiguedad_garante 
dir_trabajo_garante 	
num_trabajo_garante 	
telf_trabajo_garante 	
barrio_trabajo_garante 	zona_trabajo_garante


  
  
	
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
				$sql="SELECT * FROM ".self::$tabla." ORDER BY ".self::$idTabla." DESC";
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
					public function getStock($id){
						global $db;
				         $sql="SELECT stock FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
						$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["stock"]);
						}
						public function getStockReservado($id){
						global $db;
				         $sql="SELECT stock_reservado FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
						$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				       return ($res["stock_reservado"]);
						}
						
						
						public function getStockDisponible($id){
						global $db;
				         $sql="SELECT stock_disponible FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
						$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				       return ($res["stock_disponible"]);
						}
						
						
						
						public function sumarStock($id,$cantidad){
					     $stock=$this->getStock($id);
						$dis=$this->getStockDisponible($id);
						$cant=$stock+$cantidad;
						$disponible=$dis+$cantidad;
						global $db;
						
							$sql="UPDATE ".self::$tabla." SET stock='".$cant."'".", stock_disponible='".$disponible."'"."WHERE ".self::$idTabla."='".$id."'";
							$res=$db->query($sql);
							}
							
							
					public function reservar($id,$cantidad){
						$res=$this->getStockReservado($id);
					     $stock=$this->getStock($id);
						$dis=$this->getStockDisponible($id);
						
						$cant_reservado=$res+$cantidad;
						if($cant_reservado>$stock)
						$cant_reservado=$stock;
						$disponible=$stock-$cant_reservado;
						global $db;
				$sql="UPDATE ".self::$tabla." SET stock_reservado='".$cant_reservado."'".", stock_disponible='".$disponible."'"." WHERE ".self::$idTabla."='".$id."'";
						$res=$db->query($sql);
						}
						
						public function quitarStock($id,$cantidad){
						$sr=$this->getStockReservado($id);
					     $stock=$this->getStock($id);
						$dis=$this->getStockDisponible($id);
						
						 $cant_reservado=$sr-$cantidad;
						 if($cant_reservado<=0)
						 $cant_reservado=0;
						 
						$stockActual=$stock-$cantidad;
						if($stockActual<=0){
						$stockActual=0;
						
						}
						$disponible=$stockActual-$cant_reservado;

						global $db;
				$sql="UPDATE ".self::$tabla." SET stock_reservado='".$cant_reservado."'".", stock_disponible='".$disponible."'".",stock='".$stockActual."'"." WHERE ".self::$idTabla."='".$id."'";
						$res=$db->query($sql);
						}
						
						public function reponerReserva($id,$cantidad){
						$res=$this->getStockReservado($id);
						$dis=$this->getStockDisponible($id);
					 $stock=$this->getStock($id);

						$sr=$res-$cantidad;
						$sd=$dis+$cantidad;
						if($sr<=0){
						$sr=0;
						$sd=$stock;
						}
						
						global $db;
				$sql="UPDATE ".self::$tabla." SET stock_reservado='".$sr."'".", stock_disponible='".$sd."'"." WHERE ".self::$idTabla."='".$id."'";
						$res=$db->query($sql);
						}
	  public function reponerStock($id,$cantidad){
				
						$dis=$this->getStockDisponible($id);
		                $stock=$this->getStock($id);

						$st=$stock+$cantidad;
						$sd=$dis+$cantidad;
										
						global $db;
				$sql="UPDATE ".self::$tabla." SET stock_disponible='".$sd."'".", stock='".$st."'"." WHERE ".self::$idTabla."='".$id."'" ;
						$res=$db->query($sql);
						}
	
	
	}
	//$thumb=new thumbnail();
/*$l=new Libros();
$l->sumarStock(2,10);*/
	?>