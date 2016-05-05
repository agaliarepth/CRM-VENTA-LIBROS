<?php
//require("../helpers/conexion.php");
class devolucionObras
 {
	static $tabla="devolucionobras";
	static $idTabla="iddevolucionObras";
	static $objeto;
	static $lastId;
	public  $fecha;
	public  $num_cuenta;
	public  $num_contrato;
	public  $cliente;
	public  $cobrador;
	public  $vendedor;
	public  $coordinador;
	public  $supervisor;
	public  $gerente;
	public  $estado;
	public  $tipo_devolucion;
	public  $obs;
	public  $nombre_usuario;
	public  $idcontrato;
	public  $idingreso;
	public  $monto_total;
	public  $cuota_inicial;
	public  $saldo;
	public  $pago_cuenta;
	public  $procedencia;
	public  $idvendedor;
	public  $idcobrador;




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

				 public function   listarTodos($estado){
				 global $db;
				$sql="SELECT * FROM ".self::$tabla." where estado='".$estado."' ORDER BY iddevolucionObras DESC  ";
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}
				 public function   listarTodosCobranzas(){
				 global $db;
				$sql="SELECT * FROM ".self::$tabla." where procedencia='COBRANZAS' ORDER BY iddevolucionObras ";
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}
				 public function   listarTodosCobranzasMes($mes,$anio){
				 global $db;
				$sql="SELECT * FROM ".self::$tabla." where procedencia='COBRANZAS' AND MONTH(fecha)=".$mes." AND YEAR(fecha)=".$anio."  ORDER BY iddevolucionObras ";
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}
			 public function   listarTodosVentas(){
				 global $db;
				$sql="SELECT * FROM ".self::$tabla." where procedencia='VENTAS' ORDER BY iddevolucionObras ";
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}
				 public function   listarTodosVentasEstado($estado){
				 global $db;
				$sql="SELECT * FROM ".self::$tabla." where  estado='".$estado."' AND  procedencia='VENTAS' ORDER BY iddevolucionObras ";
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}
				 public function   listarTodosCobranzasEstado($estado){
				 global $db;
				$sql="SELECT * FROM ".self::$tabla." where  estado='".$estado."' AND procedencia='COBRANZAS' ORDER BY iddevolucionObras ";
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}
				 public function   listarTodosVentasMes($mes,$anio){
				 global $db;
				$sql="SELECT * FROM ".self::$tabla." where procedencia='VENTAS' AND MONTH(fecha)=".$mes." AND YEAR(fecha)=".$anio."  ORDER BY iddevolucionObras ";
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
				self::$lastId=$db->lastID("iddevolucionObras");

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

			public  function updateEstado($id, $estado){
				global $db;

				$sql="UPDATE ".self::$tabla." SET  estado='".$estado."' WHERE ".self::$idTabla."='".$id."'";
				$db->query($sql);

				}
					public  function updateNotaIngreso($id, $estado){
				global $db;

				$sql="UPDATE ".self::$tabla." SET  idingreso='".$estado."' WHERE ".self::$idTabla."='".$id."'";
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
          public function sumMontoDevueltos($numcuenta){

            global $db;
          $sql="SELECT sum(monto_total) as total FROM ".self::$tabla." WHERE num_cuenta ='".$numcuenta."' AND  estado='aprobado'";
          $res=$db->query($sql)->fetchColumn();
          return ($res);

            }
					 public function  getDevolucionesCuenta($mes,$anio,$tipo){
				 global $db;
				$sql="SELECT * FROM ".self::$tabla." where procedencia='COBRANZAS' AND estado='aprobado' AND MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."' AND tipo_devolucion='".$tipo."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}
				 public function  getDevolucionesCuentaCobrador($mes,$anio, $idCobrador,$tipo){
				 global $db;
				$sql="SELECT * FROM ".self::$tabla." where procedencia='COBRANZAS' AND estado='aprobado' AND MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."' AND tipo_devolucion='".$tipo."' AND idcobrador='".$idCobrador."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}
				 public function  updatePagoCuenta($monto,$id){
				 global $db;
				$sql="UPDATE ".self::$tabla."  SET pago_cuenta='".$monto."' WHERE iddevolucionObras='".$id."'";
				$res=$db->query($sql);
				return ($res);

				}
    public function  updateContrato($id,$idcontrato){
        global $db;
        $sql="UPDATE ".self::$tabla."  SET idcontrato='".$idcontrato."' WHERE iddevolucionObras='".$id."'";
        $res=$db->query($sql);
        return ($res);

    }

				public function relacionObrasDevueltas($mes,$anio){

					global $db;
				$sql="SELECT DISTINCT detalle_devolucionobras.codigo ,detalle_devolucionobras.libros_idlibros FROM `detalle_devolucionobras`, devolucionobras WHERE  detalle_devolucionobras.devolucionObras_iddevolucionObras=devolucionobras.iddevolucionObras AND  devolucionobras.estado='aprobado' AND  devolucionobras.procedencia='VENTAS' AND MONTH(devolucionobras.fecha)='".$mes."' AND  YEAR(devolucionobras.fech)='".$anio."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);

					}

                 public function getPorContrato($numcontrato){

                     global $db;
                     $sql="SELECT * FROM ".self::$tabla." where num_contrato='".$numcontrato."'";
                     $res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
                     return ($res);
                 }

	}
	/*$dev=new devolucionObras();
$dev->fecha="";
	$dev->num_cuenta="";
	$dev->num_contrato="num_contrato";
	$dev->cliente="cliente";
	$dev->cobrador="cobrador";
	$dev->vendedor="vendedor";
	$dev->coordinador="coordinador";
	$dev->supervisor="supervisor";
	$dev->gerente="gerente";
	$dev->estado="sin enviar";
	$dev->tipo_devolucion="tipo_devolucion";
	$dev->obs="obs";
	$dev->nombre_usuario="nombres";
	$dev->idcontrato=0;
	$dev->idingreso=0;
	$dev->monto_total=0;
	$dev->cuota_inicial=0;
	$dev->saldo=0;
	$dev->pago_cuenta=0;
    $dev->nuevo();*/

	?>
