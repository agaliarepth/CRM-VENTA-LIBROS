<?php
class Pago{
	static $tabla="pagos";
	static $idTabla="idpagos";
	static $objeto;

	public  $monto;
	public  $fecha;
	public  $cliente;
	public  $num_reporte;
	public  $idcobrador;
	public  $estado;
	public  $numrecibo;
	public  $terminado;
	public  $credito_idcredito;
	public  $obs;

	static $lastId;



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
			 public function getPagos($num){

					 global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE cuotas_idcuotas='".$num."' order by fecha desc";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}



						 public function getPagosCuenta($idcredito){

					 global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE credito_idcredito='".$idcredito."' order by fecha desc";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}


				    public function getUltimoPago($num,$fecha){

					 global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE cuentas_idcuentas='".$num."' and fecha<='".$fecha."' order by fecha desc";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}

					 public function getUltimoPagoMes($num,$mes,$anio){

					 global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE cuentas_idcuentas='".$num."' and MONTH(fecha)='".$mes."' and YEAR(fecha)='".$anio."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}



	          public function sumPagos($num){

					 global $db;
				$sql="SELECT sum(monto)as monto FROM ".self::$tabla." WHERE credito_idcredito='".$num."' and terminado=1";
				$res=$db->query($sql)->fetchColumn();
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
				self::$lastId=$db->lastID("idpagos");

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
				public function updateSaldo($id,$monto){

							global $db;
				$sql="UPDATE ".self::$tabla." SET saldo='".$monto."' where ".self::$idTabla."='".$id."'";
				$res=$db->query($sql);

				return ($res);
						}

						public function updateEstado($id,$estado){

							global $db;
				$sql="UPDATE ".self::$tabla." SET estado='".$estado."' where ".self::$idTabla."='".$id."'";
				$res=$db->query($sql);

				return ($res);
						}






					public function reportePorMesTodos($idcobrador,$mes,$anio,$idcuenta){

					 global $db;

				$sql="SELECT  *  FROM pagos WHERE  MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."' AND idcobrador='".$idcobrador."' AND cuentas_idcuentas='".$idcuenta."'  order by  fecha desc ";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
					}




					public function getUltimoPago1($idcobrador,$mes,$anio,$idcuenta,$fecha){
					 global $db;
					$sql="SELECT  *  FROM pagos WHERE  fecha BETWEEN '2013-1-1' and '".$fecha."' AND idcobrador='".$idcobrador."' AND cuentas_idcuentas='".$idcuenta."'  order by  fecha desc ";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}

					public function devitoTotal($mes,$anio,$idco,$fecha){
					 global $db;
					$sql="SELECT  *  FROM pagos WHERE  fecha BETWEEN '2013-1-1' and '".$fecha."' AND idcobrador='".$idcobrador."' AND cuentas_idcuentas='".$idcuenta."'  order by  fecha desc ";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}

					public function bsPorCobrar($mes,$anio,$idco,$fecha){
					 global $db;
					$sql="SELECT  sum(monto)  FROM pagos WHERE   fecha BETWEEN '2013-1-1' and '".$fecha."' AND idcobrador='".$idco."'";
				$res=$db->query($sql)->fetchColumn();
				return ($res);
					}

					public function bsPorCobrarCuenta($mes,$anio,$idco,$idcuenta,$fecha){
					 global $db;
					$sql="SELECT  sum(monto) as suma  FROM pagos WHERE   fecha BETWEEN '2013-1-1' and '".$fecha."'  AND idcobrador='".$idco."' AND cuentas_idcuentas='".$idcuenta."'";
				$res=$db->query($sql)->fetchColumn();
				return ($res);
					}

					public function bsPorCobrarCuenta1($mes,$anio,$idco,$idcuenta,$fecha){
					 global $db;
					$sql="SELECT  monto  FROM pagos WHERE   fecha BETWEEN '2013-1-1' and '".$fecha."' AND idcobrador='".$idco."' AND cuentas_idcuentas='".$idcuenta."'";
				$res=$db->query($sql)->fetchColumn();
				return ($res);
					}
					public function saldoCuenta($mes,$anio,$idco,$idcuenta,$fecha){
					 global $db;
					$sql="SELECT  sum(saldo) as suma  FROM pagos WHERE   fecha BETWEEN '2013-1-1' and '".$fecha."' AND idcobrador='".$idco."' AND cuentas_idcuentas='".$idcuenta."'";
				$res=$db->query($sql)->fetchColumn();
				return ($res);
					}

					public function getCancelado($idcuenta){
					 global $db;
					$sql="SELECT  saldo ,fecha, monto FROM pagos WHERE  saldo=0 AND cuentas_idcuentas='".$idcuenta."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
					}

					public function cuentasNuevasCobradas($mes,$anio){
					 global $db;
				$sql="SELECT  *  FROM pagos WHERE  MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}
					public function cuentasNuevasCobradasCobrador($mes,$anio,$idco){
					  global $db;
				$sql="SELECT  *  FROM pagos WHERE  MONTH(fecha)='".$mes."' AND YEAR(fecha)='".$anio."' AND idcobrador='".$idco."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);
					}

					public function saldoTotal($mes,$anio,$idco,$fecha){
					 global $db;
					$sql="SELECT  sum(saldo) as suma  FROM pagos WHERE   fecha BETWEEN '2013-1-1' and '".$fecha."' AND idcobrador='".$idco."'";
				$res=$db->query($sql)->fetchColumn();
				return ($res);
					}
					public function montoTotal($mes,$anio,$idco,$fecha){
					 global $db;
					$sql="SELECT  sum(monto) as suma  FROM pagos WHERE   fecha BETWEEN '2013-1-1' and '".$fecha."' AND idcobrador='".$idco."'";
				$res=$db->query($sql)->fetchColumn();
				return ($res);
					}

					public function saldoCuota($idcuotas){
					 global $db;
					$sql="SELECT  sum(monto) as suma  FROM pagos WHERE  cuotas_idcuotas='".$idcuotas."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["suma"]);
					}
					 public function   listarTodosMes($mes, $anio){
				 global $db;
				$sql="SELECT * FROM ".self::$tabla ." WHERE YEAR(fecha)='".$anio."' and MONTH(fecha)='".$mes."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}

    public function sumPagosCredito($idcredito){
        global $db;
        $sql="SELECT  sum(pagos.monto) as suma  FROM pagos WHERE  credito_idcredito='".$idcredito."'";
        $res=$db->query($sql)->fetchColumn();
        return ($res);
    }
      public function sumPagosCreditoAcumulado($idcredito,$mes,$anio){
        global $db;
        $f=$anio.'-'.$mes.'-31';
        $sql="SELECT  sum(pagos.monto) as suma  FROM pagos,cuotas WHERE  pagos.cuotas_idcuotas=cuotas.idcuotas AND cuotas.credito_idcredito='".$idcredito."' AND (pagos.fecha BETWEEN '2014-1-1' AND '".$f."')";
        $res=$db->query($sql)->fetchColumn();
        return ($res);
    }
    public function getListaUltimosPagos($idcredito,$mes,$anio){
        global $db;

        $sql="SELECT  pagos.monto ,pagos.idpagos,pagos.fecha,pagos.quiencobro,pagos.cliente,pagos.num_reporte,pagos.idcobrador, pagos.numrecibo   FROM pagos,cuotas WHERE  pagos.cuotas_idcuotas=cuotas.idcuotas AND cuotas.credito_idcredito='".$idcredito."' AND MONTH(pagos.fecha)='".$mes."'  AND YEAR(pagos.fecha)='".$anio."' ORDER BY pagos.fecha,pagos.idpagos  DESC";
        $res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return ($res);
    }

}
?>
