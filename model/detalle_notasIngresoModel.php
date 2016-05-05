<?php
class detalleIngreso {
	static $tabla="detalleIngreso";
	static $idTabla="iddetalleIngreso";
	static $objeto;
	static $total;
	
	public  $cantidad;
	public  $codigo;
	public  $titulo;
	public  $volumen;
	public  $precio_unitario;
	public $precio_total;
	public $libros_idlibros;
	public $ingreso_idingreso;
	static $consulta;
	public  $obs;
	
  
  
	
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
						
							public function borrarPorNotaIngreso($idingreso){
							
							global $db;
				$sql="delete  FROM ".self::$tabla." WHERE ingreso_idingreso='".$idingreso."'";
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
				$sql="SELECT * FROM ".self::$tabla." WHERE ingreso_idingreso='".$id."' order by codigo";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
					//*vistas 
					
					public function reportePorMes($orden="codigo",$mes,$anio, $idalmacen,$concepto){
					
					 global $db;
				$sql="SELECT * FROM view_ingreso_detalle WHERE  MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."' AND idalmacenes='".$idalmacen."' AND concepto='".$concepto."' AND estado='Enviado'  order by  ".$orden;
				
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
					
					public function reportePorMesPaginado($orden="codigo",$mes,$anio, $idalmacen,$concepto,$page){
					
					 global $db;
				$sql="SELECT * FROM view_ingreso_detalle WHERE  MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."' AND idalmacenes='".$idalmacen."' AND concepto='".$concepto."' AND estado='Enviado'  order by  ".$orden." LIMIT ".(($page-1)*5000).", 5000 ";
				
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
					
					public function reportePorMesTodosPaginado($orden="codigo",$mes,$anio, $idalmacen,$page){
					
					 global $db;
					 
				$sql="SELECT  *  FROM view_ingreso_detalle WHERE  MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."' AND idalmacenes='".$idalmacen."' AND estado='Enviado'  order by  ".$orden." LIMIT ".(($page-1)*5000).", 5000  ";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
				
					
			
					public function reportePorMesTodos($orden="codigo",$mes,$anio, $idalmacen){
					
					 global $db;
					 
				$sql="SELECT  *  FROM view_ingreso_detalle WHERE  MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."' AND idalmacenes='".$idalmacen."' AND estado='Enviado'  order by  ".$orden." ";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
					
					
					
	   public   function sumIngresoInventario($mes , $anio,$idlibro,$id){
				global $db;
				$sql="SELECT sum(cantidad) as suma FROM view_ingreso_detalle WHERE MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."'  AND libros_idlibros='".$idlibro."' AND estado='Enviado' AND  idalmacenes='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["suma"]);
				
				}	
					 public   function sumIngresoInventarioAnt($mes , $anio,$idlibro,$id){
				global $db;
				$fecha=$anio."-".$mes."-31";
				$sql="SELECT sum(cantidad) as suma FROM view_ingreso_detalle WHERE fecha between '2013-1-1' AND '".$fecha."' AND libros_idlibros='".$idlibro."'  AND estado='Enviado' AND  idalmacenes='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["suma"]);
				
				}	
				
				 public   function sumIngresoInventarioTodos($mes , $anio,$idlibro){
				global $db;
				$sql="SELECT sum(cantidad) as suma FROM view_ingreso_detalle WHERE MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."'  AND libros_idlibros='".$idlibro."' AND estado='Enviado' ";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["suma"]);
				
				}	
					 public   function sumIngresoInventarioAntTodos($mes , $anio,$idlibro){
				global $db;
				$fecha=$anio."-".$mes."-31";
				$sql="SELECT sum(cantidad) as suma FROM view_ingreso_detalle WHERE fecha between '2013-1-1' AND '".$fecha."' AND libros_idlibros='".$idlibro."'  AND estado='Enviado' ";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["suma"]);
				
				}	
				
					 public function   getMes($idlibro,$ini,$fin){
				 global $db;
				$sql="SELECT * FROM  view_ingreso_detalle WHERE libros_idlibros='".$idlibro."' AND (fecha between '".$ini."' AND '".$fin."')  AND estado='Enviado' order by fecha asc";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}
                public   function sumIngreso($fecha,$idlibro){
				global $db;
				$sql="SELECT sum(cantidad) as suma FROM view_ingreso_detalle WHERE fecha between '2013-1-1' AND '".$fecha."' AND libros_idlibros='".$idlibro."' AND estado='Enviado'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}

    public   function sumIngresoRangoFechas($fecha1,$fecha2,$idlibro){
        global $db;
        $sql="SELECT sum(cantidad) as suma FROM view_ingreso_detalle WHERE fecha between '".$fecha1."' AND '".$fecha2."' AND libros_idlibros='".$idlibro."' AND estado='Enviado'";
        $res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return ($res["suma"]);

    }



}


	?>