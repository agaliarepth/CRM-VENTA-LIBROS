<?php
class detalleContrato{
	static $tabla="detalle_contrato";
	static $idTabla="iddetalle_contrato";
	static $objeto;
	
	public  $cantidad;
	public  $codigo;
	public  $titulo;
	public  $volumen;
	public  $libros_idlibros;
	public  $contratos_idcontratos;
	public  $precio_unitario;
	public  $idkardex;
    public  $sw;
	
	
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
				$sql="SELECT * FROM ".self::$tabla." WHERE contratos_idcontratos ='".$id."' AND sw=1 order by codigo";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}


					public function getItem($id,$cod){
					
					 global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE contratos_idcontratos ='".$id."'  and codigo='".$cod."' order by codigo";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
					
					
					public function sumarPorCodigo($idlibro,$idcontrato){
					
					 global $db;
				$sql="SELECT sum(cantidad)  FROM ".self::$tabla." WHERE libros_idlibros ='".$idlibro."' AND contratos_idcontratos='".$idcontrato."'";
				$res=$db->query($sql)->fetchColumn();
				return ($res);
					}
					
					public function sumarPorCodigoKardexMayor($codigo,$mes, $anio){
					
					 global $db;
				$sql="SELECT sum(cantidad)  FROM ".self::$tabla."  , view_contrato_credito WHERE detalle_contrato.contratos_idcontratos=view_contrato_credito.idcontratos AND MONTH(view_contrato_credito.fechacontrato)='".$mes."' AND YEAR(view_contrato_credito.fechacontrato)='".$anio."' AND codigo ='".$codigo."'";
				$res=$db->query($sql)->fetchColumn();
				return ($res);
					}
					
					public function sumarPorCodigoObrasVendidas($codigo,$mes, $anio){
					
					 global $db;
				$sql="SELECT sum(cantidad)  FROM ".self::$tabla."  , view_contrato_credito WHERE detalle_contrato.contratos_idcontratos=view_contrato_credito.idcontratos AND MONTH(view_contrato_credito.fechadoc)='".$mes."' AND YEAR(view_contrato_credito.fechadoc)='".$anio."' AND codigo ='".$codigo."'";
				$res=$db->query($sql)->fetchColumn();
				return ($res);
					}
					
					public function getPrecioKardexMayor($codigo,$mes, $anio){
					
					 global $db;
				$sql="SELECT precio_unitario  FROM ".self::$tabla."  , contratos WHERE detalle_contrato.contratos_idcontratos=contratos.idcontratos AND MONTH(contratos.fechacontrato)='".$mes."' AND YEAR(contratos.fechacontrato)='".$anio."' AND codigo ='".$codigo."'";
				$res=$db->query($sql)->fetchColumn();
				return ($res);
					}
					
					public function getPrecioObrasVendidas($codigo,$mes, $anio){
					
					 global $db;
				$sql="SELECT precio_unitario  FROM ".self::$tabla."  ,view_contrato_credito WHERE detalle_contrato.contratos_idcontratos=view_contrato_credito.idcontratos AND MONTH(view_contrato_credito.fechadoc)='".$mes."' AND YEAR(view_contrato_credito.fechadoc)='".$anio."' AND detalle_contrato.codigo ='".$codigo."'";
				$res=$db->query($sql)->fetchColumn();
				return ($res);
					}
					public function ReporteVenta($cod,$mes,$anio){
					
					 global $db;
				$sql="SELECT *  FROM view_contratos_detalle WHERE codigo ='".$cod."' AND MONTH(fecharecibo)='".$mes."' AND YEAR(fecharecibo)='".$anio."'  AND tipocontrato!='DIFERIDO'";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
					public function ReporteDiferido($cod,$mes,$anio){
					
					 global $db;
				$sql="SELECT *  FROM view_contratos_detalle WHERE codigo ='".$cod."' AND MONTH(fechacontrato)='".$mes."' AND YEAR(fechacontrato)='".$anio."'  AND tipocontrato='DIFERIDO'";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
					
public function produccionVentas($vendedor){
					
					 global $db;
				$sql="SELECT *  FROM view_contratos_detalle WHERE tipocontrato='VENTA' OR tipocontrato='CUENTA' AND nombrevendedor='".$vendedor."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}	
			public function getVendedoresProduccion ($mes,$anio){
					
					 global $db;
				$sql="SELECT nombrevendedor FROM view_contratos_detalle WHERE MONTH(fecharecibo)='".$mes."' AND YEAR(fecharecibo)='".$anio."'  AND tipocontrato='VENTA' OR tipocontrato='CUENTA'";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}	
					
					public function getItemProduccion ($idcontrato){
					
					 global $db;
				$sql="SELECT max(precio_unitario) as max ,codigo,titulo, cantidad FROM `detalle_contrato` WHERE contratos_idcontratos='".$idcontrato."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
					}					
					public function BorrarFilasPorLibro ($idlibro,$idcontrato){
					
					 global $db;
				$sql=" DELETE FROM `detalle_contrato` WHERE libros_idlibros='".$idlibro."' AND  contratos_idcontratos='".$idcontrato."'";
                 $res=$db->query($sql);	
				 			return ($res);
					}	
					
						public function borrarFilasPorKardex ($idkardex,$idcontrato){
					
					 global $db;
				$sql=" DELETE FROM `detalle_contrato` WHERE idkardex='".$idkardex."' AND  contratos_idcontratos='".$idcontrato."'";
                 $res=$db->query($sql);	
				 			return ($res);
					}	
					
						 public   function sumContratosKardexMayor($fecha,$idlibro){
				global $db;
				$sql="SELECT sum(cantidad) as suma FROM view_contratos_detalle WHERE fechacontrato between '2013-1-1' AND '".$fecha."' AND libros_idlibros='".$idlibro."' AND (tipocontrato='VENTA' OR tipocontrato='CUENTA')";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}
				
				 public function   getMesSumado($idlibro,$ini,$fin){
				 global $db;
				$sql="SELECT sum(cantidad) as suma FROM  view_contratos_detalle WHERE libros_idlibros='".$idlibro."' AND fechacontrato between '".$ini."' AND '".$fin."' AND (tipocontrato='VENTA' OR tipocontrato='CUENTA') ";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}

    public   function sumRangoFechas($fecha1,$fecha2,$idlibro,$tipo){
        global $db;
        $sql="SELECT sum(cantidad) as suma FROM view_contratos_detalle WHERE fechacontrato between '".$fecha1."' AND '".$fecha2."' AND libros_idlibros='".$idlibro."' AND tipocontrato='".$tipo."' AND  terminado=1";
        $res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return ($res["suma"]);

    }

    public function actualizarVista($id,$sw){

        global $db;
        $sql="UPDATE  ".self::$tabla." SET sw='".$sw."' WHERE  ".self::$idTabla."='".$id."'";
        $res=$db->query($sql);
        return ($res);
    }
					
}
	  
	?>