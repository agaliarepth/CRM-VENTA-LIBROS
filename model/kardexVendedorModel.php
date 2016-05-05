<?php
//require_once("../helpers/conexion.php");
class kardexVendedor {
	static $tabla="kardexvendedor";
	static $idTabla="idkardexvendedor";
	static $objeto;
	static $consulta;
	
	public  $fecha_remision;
	public  $num_remision;
	public  $fecha_devolucion;
	public  $num_devolucion;
	public  $cod_libro;
	public $titulo_libro;
	public $estado_libro;
	public $num_contrato;
	public $reg_ventas;
    public $nombres_cliente;
    public $vendedores_idVendedores;
	public $idlibro;
	public $idalmacenes;
	public $tomo_libro;
	public $idcontrato;
	public $cargo;
	public $traspaso;
	public $idtraspaso;

  
	
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
				$sql.=") VALUES  ";
		        $sql.=self::$consulta;
				$res=$db->query($sql);
				self::$consulta="";
		
				
				}	
			public function insertar(){
				 $this->get_objeto();
				 
				
			   self::$consulta.= "('";
				self::$consulta.=join("','",array_values(self::$objeto));
				self::$consulta.="'),";



				}
     private function selectAll(){
         $this->get_objeto();

         $string=self::$idTabla.",";

         $string.=join(",",array_keys(self::$objeto));

         return($string);
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
				$sql="SELECT ".$this->selectAll()."  FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ( $res);
				
				}	
				 public   function getFilaContrato($id){
				global $db;
				$sql="SELECT  ".self::$idTabla.",fecha_remision,num_remision,cod_libro,titulo_libro,idalmacenes,idlibro,tomo_libro FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."' LIMIT 1";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ( $res);
				
				}	
					 
					 public   function getFilaContratoChofer($id,$idchofer){
				global $db;
				$sql="SELECT ".self::$idTabla.",fecha_remision,num_remision,cod_libro,titulo_libro,idalmacenes,idlibro,tomo_libro FROM ".self::$tabla." WHERE idcontrato='".$id."' AND vendedores_idVendedores='".$idchofer."'";
				$res=$db->query($sql)->fetchAll();
				return ( $res);
				
				}	
				
				
				
				 public   function getKardexTotal($idvendedor){
				global $db;
				$sql="SELECT ".$this->selectAll(). " FROM ".self::$tabla." WHERE vendedores_idVendedores='".$idvendedor."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}	
				 public   function getKardexMes($idvendedor,$mes,$anio,$orden){
				global $db;
				$sql="SELECT  ".$this->selectAll(). " FROM ".self::$tabla." WHERE vendedores_idVendedores='".$idvendedor."' AND MONTH(fecha_remision)='".$mes."' AND YEAR(fecha_remision)='".$anio."' ORDER BY ".$orden;
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}	
				 public   function getKardexMesAnterior($idvendedor,$mes,$anio,$orden){
					 global $db;
					 $mesActual; $mesAnte; $anioActual; $anioAnte;
					 $mesActual=$mes; $anioActual=$anio;
					 if($mesActual==1){
						 $mesAnte=12;
						 $anioAnte=$anioActual-1;
						 
						 }
						 else{
							 $mesAnte =$mesActual-1;
							 $anioAnte=$anioActual;
							 }
				$sql="SELECT  ".$this->selectAll(). " FROM ".self::$tabla." WHERE vendedores_idVendedores='".$idvendedor."' AND  MONTH(fecha_remision) BETWEEN ".$mesAnte." AND ".$mesActual." AND YEAR(fecha_remision) BETWEEN ".$anioAnte." AND ".$anioActual." ORDER BY ".$orden;
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}	
				
				public   function getRemisiones($idvendedor,$idalmacenes){
				global $db;
				$sql="SELECT  ".$this->selectAll(). " FROM ".self::$tabla." WHERE vendedores_idVendedores='".$idvendedor."' AND idalmacenes='".$idalmacenes."' AND estado_libro='Remitido'";
				$res=$db->query($sql)->fetchALL();
				return ($res);
				
				}	
				
			    public   function todasRemisiones($idvendedor){
				global $db;
				$sql="SELECT  ".$this->selectAll(). " FROM ".self::$tabla." WHERE vendedores_idVendedores='".$idvendedor."' AND estado_libro='Remitido'";
			
				$res=$db->query($sql)->fetchALL();
				return ($res);
				
				}
				public   function todasRemisionesPorCodigo($idvendedor,$cod_libro){
				global $db;
				$sql="SELECT  ".$this->selectAll(). " FROM ".self::$tabla." WHERE vendedores_idVendedores='".$idvendedor."' AND estado_libro='Remitido' AND cod_libro='".$cod_libro."'  AND cargo!=2 order by fecha_remision";
			
				$res=$db->query($sql)->fetchALL();
				return ($res);
				
				}
				
				public   function todasRemisionesPorCodigo1($cant,$idvendedor,$cod_libro){
				global $db;
				$sql="SELECT ".self::$idTabla."  FROM ".self::$tabla." WHERE vendedores_idVendedores='".$idvendedor."' AND estado_libro='Remitido' AND cod_libro='".$cod_libro."'  AND cargo!=2 order by fecha_remision LIMIT ".$cant;
			
				$res=$db->query($sql)->fetchALL();
				
				return ($res);
				
				}
				
				public   function todasRemisionesPorCodigoFecha($cant,$idvendedor,$cod_libro,$fecha){
				global $db;
				$f=date_parse($fecha);
				$mes=$f["month"];
				$anio=$f["year"];
				$sql="SELECT ".self::$idTabla."  FROM ".self::$tabla." WHERE vendedores_idVendedores='".$idvendedor."' AND estado_libro='Remitido' AND cod_libro='".$cod_libro."'  AND cargo!=2  AND MONTH(fecha_remision)=".$mes." AND YEAR(fecha_remision)=".$anio." order by fecha_remision LIMIT ".$cant;
			
				$res=$db->query($sql)->fetchALL();
				
				return ($res);
				
				}
					public   function todasRemisionesPorCodigoFecha2($cant,$idvendedor,$cod_libro,$fecha){
				global $db;
				$f=date_parse($fecha);
				$mes=$f["month"];
				$anio=$f["year"];
				$sql="SELECT ".self::$idTabla." FROM ".self::$tabla." WHERE vendedores_idVendedores='".$idvendedor."' AND estado_libro='Remitido' AND cod_libro='".$cod_libro."'  AND cargo!=2  AND MONTH(fecha_remision)=".$mes." AND YEAR(fecha_remision)=".$anio." order by fecha_remision LIMIT ".$cant;
			
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				
				return ($res);
				
				}
				
					public   function todasRemisionesPorCodigoTraspaso($cant,$idvendedor,$cod_libro){
				global $db;
				$sql="SELECT idkardexvendedor FROM ".self::$tabla." WHERE vendedores_idVendedores='".$idvendedor."' AND estado_libro='Remitido' AND cod_libro='".$cod_libro."'  AND (cargo=0 or cargo=1) order by fecha_remision asc LIMIT ".$cant;
			
				$res=$db->query($sql)->fetchALL();
				return ($res);
				
				}
				
				public   function todasRemisionesPorContrato($idvendedor,$numContrato){
				global $db;
				$sql="SELECT  ".$this->selectAll(). " FROM ".self::$tabla." WHERE vendedores_idVendedores='".$idvendedor."' AND num_contrato='".$numContrato."'";
			
				$res=$db->query($sql)->fetchALL();
				return ($res);
				
				}
				
				
				
				public function validarCodigo($cod){
					
					global $db;
				$sql="SELECT count(codigo) FROM ".self::$tabla." WHERE codigo ='".$cod."'";
				$res=$db->query($sql)->fetchColumn();
				return ($res);
					
					}
					public function borrarKardex($remi){
					
						global $db;
				$sql="DELETE FROM ".self::$tabla."  WHERE  num_remision='".$remi."'";
							$res=$db->query($sql);
					
					
					}
					
				public function actualizarEstadoDevuelto($id,$iddevuelto,$fecha){
					
						global $db;
				$sql="UPDATE ".self::$tabla." SET estado_libro='Devuelto' , num_devolucion='".$iddevuelto."' , fecha_devolucion='".$fecha."' WHERE ".self::$idTabla."='".$id."'";
							$res=$db->query($sql);
					
					
					}
					public function actualizarEstadoDevuelto1($id,$iddevuelto,$fecha){
					
						global $db;
			  $sql="UPDATE ".self::$tabla." SET estado_libro='Devuelto' , num_devolucion='".$iddevuelto."' , fecha_devolucion='".$fecha."' WHERE ".self::$idTabla."='".$id."' LIMIT 1";
							$res=$db->query($sql);
					
					
					}
					public function actualizarEstadoDevueltoObras($cod,$num,$iddevuelto,$fecha,$idvendedor){
					
						global $db;
				$sql="UPDATE ".self::$tabla." SET estado_libro='DevueltoObras' , num_devolucion='".$iddevuelto."' , fecha_devolucion='".$fecha."' WHERE num_contrato='".$num."' AND cod_libro='".$cod."' AND vendedores_idVendedores='".$idvendedor."'  AND cargo!=2";
							$res=$db->query($sql);
					
					
					}
						
					
						public function actualizarEstadoRemitido($id,$iddevolucion){
					
						global $db;
				$sql="UPDATE ".self::$tabla." SET estado_libro='Remitido' , num_devolucion='' , fecha_devolucion=''  WHERE idlibro='".$id."' AND num_devolucion='".$iddevolucion."'";
							$res=$db->query($sql);
					
					
					}
						public function actualizarEstadoRemitido1($iddevolucion){
					
						global $db;
				$sql="UPDATE ".self::$tabla." SET estado_libro='Remitido' , num_devolucion='' , fecha_devolucion=''  WHERE num_devolucion='".$iddevolucion."'";
							$res=$db->query($sql);
					
					
					}
					
					public function actualizarEstadoRemitido2($idkardex){
					
						global $db;
				$sql="UPDATE ".self::$tabla." SET estado_libro='Remitido' , num_devolucion='' , fecha_devolucion='' WHERE  idkardexvendedor='".$idkardex."'";
							$res=$db->query($sql);
					
					
					}
					public function actualizarEstadoRemitido3($idkardex){
					
						global $db;
				$sql="UPDATE ".self::$tabla." SET estado_libro='Remitido' , num_devolucion='' , fecha_devolucion='',nombres_cliente='',reg_ventas='',num_contrato='',cargo=0,traspaso=0 WHERE  idkardexvendedor='".$idkardex."'";
							$res=$db->query($sql);
					
					
					}
						public function actualizarEstadoRemitidoKardexDuplicados($idcontrato,$cant,$codigo,$idchofer){
					
						global $db;
				$sql="UPDATE ".self::$tabla." SET estado_libro='Remitido' , num_contrato='' ,reg_ventas='',nombres_cliente='', cargo=0,idcontrato='0',traspaso=0 WHERE  idcontrato='".$idcontrato."' AND cod_libro='".$codigo."' AND vendedores_idVendedores='".$idchofer."' LIMIT ".$cant;
							$res=$db->query($sql);
					
					
					}

							public function borrarKardexDuplicadosContratos($idcontrato,$cant, $codigo,$idvendedor){
					
						global $db;
				$sql="DELETE FROM  ".self::$tabla."  WHERE  idcontrato='".$idcontrato."' AND cod_libro='".$codigo."' AND vendedores_idVendedores='".$idvendedor."' LIMIT ".$cant;
							$res=$db->query($sql);
					
					
					}

						public function borrarKardexDuplicadosDevolucion($num_devolucion,$cant, $codigo,$idvendedor){
					
						global $db;
				$sql="DELETE FROM  ".self::$tabla."  WHERE  num_devolucion='".$num_devolucion."' AND cod_libro='".$codigo."' AND vendedores_idVendedores='".$idvendedor."' LIMIT ".$cant;
							$res=$db->query($sql);
					
					
					}
					
					public function actualizarEstadoContrato($id,$numContrato,$regVentas,$tipo,$nombresCliente){
					
						global $db;
				$sql="UPDATE ".self::$tabla." SET estado_libro='".$tipo."', num_contrato='".$numContrato."', reg_ventas='".$regVentas."', nombres_cliente='".$nombresCliente."'  WHERE ".self::$idTabla."='".$id."'";
							$res=$db->query($sql);
					
					
					}
					
					public function actualizarEstadoDiferido($idk,$cod_libro,$numContrato,$nombresCliente,$idcontrato){
					
						global $db;
				$sql="UPDATE ".self::$tabla." SET estado_libro='Diferido', num_contrato='".$numContrato."', nombres_cliente='".$nombresCliente."', idcontrato='".$idcontrato."' where  idkardexvendedor='".$idk."'";
							$res=$db->query($sql);
					
					
					}

					public function actualizarEstadoDiferidoTraspaso($idchofer,$idk,$cod_libro,$numContrato,$nombresCliente,$idcontrato){
					
						global $db;
				$sql="UPDATE ".self::$tabla." SET estado_libro='Traspaso', vendedores_idVendedores='".$idchofer."',  cargo=10,traspaso=1, num_contrato='".$numContrato."', nombres_cliente='".$nombresCliente."', idcontrato='".$idcontrato."' where   idkardexvendedor='".$idk."'";
							$res=$db->query($sql);
					
					
					}
					public function actualizarEstadoTraspasoVendedores($idchofer,$idk,$cod_libro,$idtraspaso){
					
						global $db;
				$sql="UPDATE ".self::$tabla." SET estado_libro='Traspaso', vendedores_idVendedores='".$idchofer."',  cargo=10,traspaso=1, idtraspaso='".$idtraspaso."' where  idkardexvendedor='".$idk."'";
							$res=$db->query($sql);
					
					
					}
					public function actualizarEstadoVenta($id,$numcuenta,$idcontrato){
					
						global $db;
				$sql="UPDATE ".self::$tabla." SET estado_libro='Venta', reg_ventas='".$numcuenta."' , idcontrato='".$idcontrato."' WHERE ".self::$idTabla."='".$id."' AND cargo!=2";
							$res=$db->query($sql);
					
					
					}
					
					public function eliminadoDiferido($id){
					
						global $db;
				$sql="UPDATE ".self::$tabla." SET estado_libro='Remitido', num_contrato='', nombres_cliente='', idcontrato=''  WHERE ".self::$idTabla."='".$id."'";
							$res=$db->query($sql);
					
					
					
					}
					
					public function eliminarEstadoVenta($id){
					
						global $db;
				$sql="UPDATE ".self::$tabla." SET estado_libro='Diferido', reg_ventas=''  WHERE ".self::$idTabla."='".$id."'";
							$res=$db->query($sql);
					
					
					}
					
					public function traspaso($id,$id_recibe,$fecha){
					
						global $db;
				$sql="UPDATE ".self::$tabla." SET vendedores_idVendedores='".$id_recibe."', fecha_remision='".$fecha."' WHERE ".self::$idTabla."='".$id."'";
							$res=$db->query($sql);
					
					
					}
						public function todosCargos($idvendedor){
					
						global $db;
				$sql="SELECT count( cod_libro ) AS cant, estado_libro, vendedores_idVendedores,cod_libro,tomo_libro,titulo_libro
FROM kardexvendedor
GROUP BY cod_libro, vendedores_idVendedores, estado_libro,cargo
HAVING estado_libro = 'Remitido'
AND vendedores_idVendedores ='".$idvendedor."' and cargo!=2";

							$res=$db->query($sql)->fetchALL();
				return ($res);
					
					
					}
    public function todosCargosMes($idvendedor,$mes,$anio){

        global $db;
        $sql="SELECT count( cod_libro ) AS cant,month(fecha_remision) as mes,  year(fecha_remision)as anio,estado_libro, vendedores_idVendedores,cod_libro,tomo_libro,titulo_libro
FROM kardexvendedor
GROUP BY cod_libro, vendedores_idVendedores, estado_libro,cargo,mes,anio
HAVING estado_libro = 'Remitido'
AND vendedores_idVendedores ='".$idvendedor."' AND cargo!=2 AND mes=".$mes."  AND anio=".$anio;

        $res=$db->query($sql)->fetchAll();
        return ($res);


    }
					public function sumaCargos($codlibro){
					
						global $db;
				$sql="SELECT idlibro, cod_libro,titulo_libro,tomo_libro,count(cod_libro)as cantidad  FROM ".self::$tabla." GROUP BY cod_libro having cod_libro='".$codlibro."'";
							$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
					
					
					}
					public   function todosContratosDiferidos($idcontrato){
				global $db;
				$sql="SELECT  ".$this->selectAll(). " FROM ".self::$tabla." WHERE idcontrato ='".$idcontrato."' AND estado_libro='Diferido'";
			
				$res=$db->query($sql)->fetchALL();
				return ($res);
				
				}
					public   function todosContratosVenta($idcontrato){
				global $db;
				$sql="SELECT  ".$this->selectAll(). " FROM ".self::$tabla." WHERE idcontrato ='".$idcontrato."' AND estado_libro='Venta'";
			
				$res=$db->query($sql)->fetchALL();
				return ($res);
				
				}
		public function pasarCargos($idvendedor,$mes,$anio){
				global $db;
				$sql="update  kardexvendedor SET  cargo='2' WHERE   vendedores_idVendedores='".$idvendedor."' AND estado_libro='Remitido' AND MONTH(fecha_remision)='".$mes."' AND YEAR(fecha_remision)='".$anio."'" ;
			
				$res=$db->query($sql);
				return ($res);
				
				}
				public function getValorCargo(){}
				
				public function pasarCargosDiferidos($idvendedor,$mes,$anio){
				global $db;
				$sql="update  kardexvendedor SET  cargo='2' WHERE   vendedores_idVendedores='".$idvendedor."' AND estado_libro='Diferido' AND MONTH(fecha_remision)='".$mes."' AND YEAR(fecha_remision)='".$anio."'";
			
				$res=$db->query($sql);
				return ($res);
				
				}
				
				public function ObtenerCargos($idvendedor,$mes,$anio){
				global $db;
				$sql="SELECT  fecha_remision,num_remision,cod_libro,titulo_libro , estado_libro,idlibro,idalmacenes,tomo_libro,cargo,vendedores_idVendedores FROM kardexvendedor WHERE   vendedores_idVendedores='".$idvendedor."' AND MONTH(fecha_remision)='".$mes."' AND YEAR(fecha_remision)='".$anio."'  AND estado_libro='Remitido' AND cargo!=2 ";
			
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}
				public function ObtenerCargosDiferidos($idvendedor,$mes,$anio){
				global $db;
				$sql="SELECT  fecha_remision,num_remision,cod_libro,titulo_libro , estado_libro,idlibro,idalmacenes,tomo_libro,cargo,vendedores_idVendedores,num_contrato, nombres_cliente,idcontrato FROM kardexvendedor WHERE   vendedores_idVendedores='".$idvendedor."' AND MONTH(fecha_remision)='".$mes."' AND YEAR(fecha_remision)='".$anio."'  AND estado_libro='Diferido' AND cargo!=2 ";
			
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}
				public function pasarCargos1($fr,$nr,$cl,$tl,$el,$il,$ia,$tl,$c,$idvendedores){
				global $db;
				$sql="insert into  kardexvendedor (fecha_remision,num_remision,cod_libro,titulo_libro, estado_libro,idlibro,idalmacenes,tomo_libro,cargo,vendedores_idVendedores )values('$fr','$nr','$cl','$tl','$el','$il','$ia','$tl','$c','$idvendedores')";
			
				$res=$db->query($sql);
				return ($res);
				
				}
				
				public function verRemisionesFila($idvendedor,$idlibro,$mes,$anio){
				global $db;
				$sql="SELECT count(cod_libro) as suma FROM `kardexvendedor` WHERE idlibro='".$idlibro."' AND MONTH(fecha_remision)='".$mes."' AND YEAR(fecha_remision)='".$anio."' AND vendedores_idVendedores='".$idvendedor."' AND estado_libro='Remitido'";
			
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}
				public function verRemisionescolumna($mes,$anio){
				global $db;
				$sql="SELECT DISTINCT  idlibro, cod_libro,titulo_libro,MONTH(fecha_remision)AS mes ,YEAR(fecha_remision)as anio FROM kardexvendedor  GROUP BY cod_libro,estado_libro,fecha_remision having estado_libro='Remitido' AND MONTH(fecha_remision)='".$mes."' AND YEAR(fecha_remision)='".$anio."'";
			
				$res=$db->query($sql)->fetchALL();
				return ($res);
				
				}
				
				public function verTotalColumna($mes,$anio,$idvendedor){
				global $db;
				$sql="SELECT count(cod_libro) as total FROM kardexvendedor  WHERE vendedores_idVendedores='".$idvendedor."'  AND MONTH(fecha_remision)='".$mes."' AND YEAR(fecha_remision)='".$anio."' AND estado_libro='Remitido'";
			
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}
				
				public function traspasoPorVenta($idk,$id,$fecha){
					
						global $db;
				$sql="UPDATE ".self::$tabla." SET vendedores_idVendedores='".$id."',  fecha_remision='".$fecha."' where  idkardexvendedor='".$idk."' LIMIT 1";
							$res=$db->query($sql);
					
					
					}	
					
						public function sumCargosVendedor($idvendedor){
				global $db;
				$sql="SELECT count(idkardexvendedor) as credito from kardexvendedor where (cargo=1 or cargo=0) AND vendedores_idVendedores='".$idvendedor."'";
			
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["credito"]);
				
				}
				
					public function buscarCargosVendedorLibro($idvendedor,$codigo,$limit){
				global $db;
				$sql="SELECT idkardexvendedor  FROM kardexvendedor WHERE cod_libro='".$codigo."'  AND vendedores_idVendedores='".$idvendedor."'  AND estado_libro='Remitido' AND traspaso=0 AND (cargo=1 or cargo=0)  order by fecha_remision asc LIMIT ".$limit;
				
				$res=$db->query($sql)->fetchALL();
				return ($res);
				
					}
    public function buscarCargosVendedorLibroMes($idvendedor,$codigo,$limit,$mes ,$anio){
        global $db;
        $sql="SELECT idkardexvendedor  FROM kardexvendedor WHERE cod_libro='".$codigo."'  AND vendedores_idVendedores='".$idvendedor."'  AND estado_libro='Remitido' AND traspaso=0 AND (cargo=1 or cargo=0) AND MONTH(fecha_remision)=".$mes." AND YEAR(fecha_remision)=".$anio." order by fecha_remision asc LIMIT ".$limit;

        $res=$db->query($sql)->fetchALL();
        return ($res);

    }
					
			
						public function verFilasKardexRemision($num_remision,$idvendedor){
				global $db;
				$sql="SELECT  ".$this->selectAll(). "  FROM kardexvendedor WHERE num_remision='".$num_remision."' AND vendedores_idVendedores=".$idvendedor;
				
				$res=$db->query($sql)->fetchALL();
				return ($res);
				
					}
					
					public function verFilasKardexDevolucion($numdevolucion){
				global $db;
				$sql="SELECT  ".$this->selectAll(). " FROM kardexvendedor WHERE num_devolucion='".$numdevolucion."'";
				
				$res=$db->query($sql)->fetchALL();
				return ($res);
				
					}
					
					public function verFilasKardexContrato($numcontrato){
				global $db;
				$sql="SELECT  ".$this->selectAll(). "  FROM kardexvendedor WHERE num_contrato='".$numcontrato."'";
				
				$res=$db->query($sql)->fetchALL();
				return ($res);
				
					}
					public function verFilasKardexIdContrato($id){
				global $db;
				$sql="SELECT  idkardexvendedor,".$this->selectAll(). "  FROM kardexvendedor WHERE idcontrato='".$id."'";
				
				$res=$db->query($sql)->fetchALL();
				return ($res);
				
					}

							public function verFilasKardexIdDevolucion($id){
				global $db;
				$sql="SELECT  idkardexvendedor,".$this->selectAll(). "  FROM kardexvendedor WHERE num_devolucion='".$id."'";
				
				$res=$db->query($sql)->fetchALL();
				return ($res);
				
					}
    public function verFilasKardexTraspaso($idtraspaso){
        global $db;
        $sql="SELECT  ".$this->selectAll(). "  FROM kardexvendedor WHERE idtraspaso='".$idtraspaso."'";

        $res=$db->query($sql)->fetchALL();
        return ($res);

    }
					public function actualizarDatosContrato($idcontrato,$numcontrato,$nombres,$idchofer,$estado){
				global $db;
				$sql="UPDATE kardexvendedor SET num_contrato='".$numcontrato."',nombres_cliente='".$nombres."', estado_libro='".$estado."' WHERE idcontrato='".$idcontrato."' AND estado_libro='".$estado."' AND cargo!=2";
				
				$res=$db->query($sql);
				return ($res);
				
					}
					public function actualizarDatosContrato2($numcontrato,$nombres){
				global $db;
				$sql="UPDATE kardexvendedor SET nombres_cliente='".$nombres."' WHERE num_contrato='".$numcontrato."' AND cargo!=2";
				
				$res=$db->query($sql);
				return ($res);
				
					}
					
					public function borrarRemisionPorVendedorContrato($idvendedor,$numcontrato){
					
						global $db;
				$sql="DELETE FROM ".self::$tabla."  WHERE  vendedores_idVendedores='".$idvendedor."' AND  num_contrato='".$numcontrato."'";
							$res=$db->query($sql);
					
					
					}
						public function actualizarEstadoRemitidoPorNumContrato($idvendedor,$numcontrato){
					
						global $db;
				$sql="UPDATE ".self::$tabla." SET estado_libro='Remitido' , num_devolucion='' , fecha_devolucion='',nombres_cliente='',reg_ventas='',num_contrato='',cargo=0,traspaso=0 WHERE  vendedores_idVendedores='".$idvendedor."' AND  num_contrato='".$numcontrato."'";
							$res=$db->query($sql);
					
					
					}
    public function actualizarEstadoRemitidoPorTraspaso($idvendedor,$idtraspaso){

        global $db;
        $sql="UPDATE ".self::$tabla." SET estado_libro='Remitido' , cargo=0,traspaso=0, idtraspaso=0 WHERE  vendedores_idVendedores='".$idvendedor."' AND  idtraspaso='".$idtraspaso."'";
        $res=$db->query($sql);


    }
    public function borrarRemisionPorVendedorTraspaso($idvendedor,$idtraspaso){

        global $db;
        $sql="DELETE FROM ".self::$tabla."  WHERE  vendedores_idVendedores='".$idvendedor."' AND idtraspaso='".$idtraspaso."'";
        $res=$db->query($sql);


    }
					public function   getCargosPorVendedorMes($idvendedor,$ini,$fin){
				 global $db;
				$sql="SELECT DISTINCT idlibro FROM  kardexvendedor WHERE vendedores_idVendedores='".$idvendedor."' AND (fecha_remision BETWEEN '".$ini."' AND '".$fin."') AND cargo=0 order by fecha_remision asc";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}
				
				public function   sumCargosPorItemMes($idlibro,$idvendedor,$ini,$fin){
				 global $db;
				$sql="SELECT COUNT(idlibro) as suma FROM  kardexvendedor WHERE idlibro='".$idlibro."' AND vendedores_idVendedores='".$idvendedor."' AND (fecha_remision between '".$ini."' AND '".$fin."') ";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["suma"]);
				
				}
				public function   sumCargosPorItemMes2($idlibro,$idvendedor,$ini,$fin){
				 global $db;
				$sql="SELECT COUNT(idlibro) as suma FROM  kardexvendedor WHERE idlibro='".$idlibro."' AND vendedores_idVendedores='".$idvendedor."' AND (fecha_remision between '".$ini."' AND '".$fin."') AND cargo=0  AND estado_libro='Remitido' ";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["suma"]);
				
				}
				
				public function   sumDevoPorItemMes($idlibro,$idvendedor,$ini,$fin){
				 global $db;
				$sql="SELECT COUNT(idlibro) as suma FROM  kardexvendedor WHERE idlibro='".$idlibro."' AND vendedores_idVendedores='".$idvendedor."' AND (fecha_remision between '".$ini."' AND '".$fin."') AND cargo!=2   AND (estado_libro='Devuelto' OR estado_libro='DevueltoObras')" ;
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["suma"]);
				
				}
				public function   sumOkPorItemMes($idlibro,$idvendedor,$ini,$fin){
				 global $db;
				$sql="SELECT COUNT(idlibro) as suma FROM  kardexvendedor WHERE idlibro='".$idlibro."' AND vendedores_idVendedores='".$idvendedor."'  AND (fecha_remision between '".$ini."' AND '".$fin."') AND cargo!=2   AND estado_libro='Venta'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["suma"]);
				
				}
				public function   sumDifPorItemMes($idlibro,$idvendedor,$ini,$fin){
				 global $db;
				$sql="SELECT COUNT(idlibro) as suma FROM  kardexvendedor WHERE idlibro='".$idlibro."' AND vendedores_idVendedores='".$idvendedor."' AND (fecha_remision between '".$ini."' AND '".$fin."') AND cargo!=2   AND estado_libro='Diferido'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["suma"]);
				
				}
				public function   sumTrasPorItemMes($idlibro,$idvendedor,$ini,$fin){
				 global $db;
				$sql="SELECT COUNT(idlibro) as suma FROM  kardexvendedor WHERE idlibro='".$idlibro."' AND vendedores_idVendedores='".$idvendedor."' AND (fecha_remision between '".$ini."' AND '".$fin."') AND cargo!=2   AND estado_libro='traspaso'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["suma"]);
				
				}

                  public function   movimientoItems($idlibro,$ini,$fin,$estado){
        global $db;
$sql="SELECT COUNT(idlibro) as suma FROM  kardexvendedor WHERE idlibro='".$idlibro."'  AND (fecha_remision between '".$ini."' AND '".$fin."') AND cargo!=2   AND estado_libro='".$estado."'";
$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
return ($res["suma"]);

}

              public function anularDevolucionVentas($num_devolucion,$numcontrato){

                  global $db;
                  $sql="UPDATE ".self::$tabla." SET estado_libro='Diferido' , num_devolucion='' , fecha_devolucion='' WHERE  num_devolucion='".$num_devolucion."' AND  num_contrato='".$numcontrato."'";
                  $res=$db->query($sql);

              }

    public function listarVendedoresCargos($mes,$anio){

        global $db;
        $sql="SELECT  DISTINCT vendedores_idVendedores from kardexvendedor  where (estado_libro='Remitido' or estado_libro='Diferido') and (cargo=1 or cargo=0) AND MONTH(fecha_remision)='".$mes."' and  YEAR(fecha_remision)='".$anio."'";
        $res=$db->query($sql)->fetchAll();
        return $res;

    }
    public function contarCargosVendedor($mes,$anio,$estado,$idvendedor){

        global $db;
        $sql="SELECT COUNT(vendedores_idVendedores) as cant from kardexvendedor  where  estado_libro='".$estado."' and (cargo=1 or cargo=0) AND MONTH(fecha_remision)='".$mes."' and  YEAR(fecha_remision)='".$anio."' AND vendedores_idVendedores='".$idvendedor."'";
        $res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);

        return $res["cant"];

    }
    public function contarCargosVendedor2($mes,$anio,$idvendedor){

        global $db;
        $sql="SELECT COUNT(vendedores_idVendedores) as cant from kardexvendedor  where    (estado_libro='Diferido' OR estado_libro='Remitido')AND (cargo=1 or cargo=0) AND MONTH(fecha_remision)='".$mes."' and  YEAR(fecha_remision)='".$anio."' AND vendedores_idVendedores='".$idvendedor."'";
        $res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);

        return $res["cant"];

    }
     public function contarFilasKardex($idcontrato,$codigo,$idvendedor,$estado_libro){

        global $db;
        $sql="SELECT COUNT(idkardexvendedor) as cant from kardexvendedor  WHERE   estado_libro='".$estado_libro."'  AND vendedores_idVendedores='".$idvendedor."' AND idcontrato='".$idcontrato."' AND cod_libro='".$codigo."'";
        $res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);

        return $res["cant"];

    }
	 public function contarFilasKardexDevolucion($num_devolucion,$codigo,$idvendedor,$estado_libro){

        global $db;
        $sql="SELECT COUNT(idkardexvendedor) as cant from kardexvendedor  WHERE   estado_libro='".$estado_libro."'  AND vendedores_idVendedores='".$idvendedor."' AND num_devolucion='".$num_devolucion."' AND cod_libro='".$codigo."'";
        $res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);

        return $res["cant"];

    }
	
	}

/*$v=new kardexvendedor();
$v->fecha_remision="fecah remisioon";
	$v->num_remision="r";
	$v->fecha_devolucion="fe";
	$v->num_devolucion="num";
	$v->cod_libro="cod";
	$v->titulo_libro="titulo";
	$v->estado_libro="estado";
	$v->num_contrato="contrato";
	$v->reg_ventas="reg";
   $v->nombres_cliente="cliente";
   $v->vendedores_idVendedores="vende";
	$v->idlibro="idlibro";
	$v->idalmacenes="idalama";
	$v->tomo_libro="tomo";
	$v->idcontrato="idcon";
	$v->cargo="cargo";

$v->insertar();
unset($v);
$v=new kardexvendedor();
    $v->fecha_remision="fecah remisioon";
	$v->num_remision="r";
	$v->fecha_devolucion="fe";
	$v->num_devolucion="num";
	$v->cod_libro="cod";
	$v->titulo_libro="titulo";
	$v->estado_libro="estado";
	$v->num_contrato="contrato";
	$v->reg_ventas="reg";
    $v->nombres_cliente="cliente";
    $v->vendedores_idVendedores="vende";
	$v->idlibro="idlibro";
	$v->idalmacenes="idalama";
	$v->tomo_libro="tomo";
	$v->idcontrato="idcon";
	$v->cargo="cargo";
$v->insertar();
unset($v);
$v=new kardexvendedor();
    $v->fecha_remision="fecah remisioon";
	$v->num_remision="r";
	$v->fecha_devolucion="fe";
	$v->num_devolucion="num";
	$v->cod_libro="cod";
	$v->titulo_libro="titulo";
	$v->estado_libro="estado";
	$v->num_contrato="contrato";
	$v->reg_ventas="reg";
    $v->nombres_cliente="cliente";
    $v->vendedores_idVendedores="vende";
	$v->idlibro="idlibro";
	$v->idalmacenes="idalama";
	$v->tomo_libro="tomo";
	$v->idcontrato="idcon";
	$v->cargo="cargo";
$v->insertar();
 kardexvendedor::$consulta=$myString = substr( kardexvendedor::$consulta, 0, -1);
echo $v->nuevo();*/
	?>