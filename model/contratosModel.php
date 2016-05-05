<?php
class Contrato {
	static $tabla="contratos";
	static $idTabla="idcontratos";
	static $objeto;
	static $lastId;


public $numcontrato;
public $tipocontrato;
public $fechacontrato;
public $localidad;
public $preciototal;
public $tipoventa;
public $idvendedor;
public $idchofer;
public $nombres;
public $apellidopaterno;
public $apellidomaterno;
public $ci;
public $terminado;
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
    private function selectAll(){
        $this->get_objeto();

        $string=self::$idTabla.",";

        $string.=join(",",array_keys(self::$objeto));

        return($string);
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
				self::$lastId=$db->lastID("idcontratos");

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
				$sql="SELECT ".$this->selectAll()." FROM ".self::$tabla." ORDER BY ".self::$idTabla." DESC";
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}
				 public function   listarTodosDiferidos(){
				 global $db;
				 $this->get_objeto();
				$sql="SELECT ".$this->selectAll()." FROM ".self::$tabla." where tipocontrato='DIFERIDO' ORDER BY ".self::$idTabla." DESC";
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}
				 public function   listarTodosDiferidosMes($mes ,$anio){
				 global $db;
				 $this->get_objeto();
				$sql="SELECT ".$this->selectAll()." FROM ".self::$tabla." where tipocontrato='DIFERIDO' AND MONTH(fechacontrato)='".$mes."' AND YEAR(fechacontrato)='".$anio."' ORDER BY ".self::$idTabla." DESC";
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}
				public function   listarBajaMes($mes ,$anio){
				global $db;
				$this->get_objeto();
			 $sql="SELECT ".$this->selectAll()." FROM ".self::$tabla." where tipocontrato='BAJA' AND MONTH(fechacontrato)='".$mes."' AND YEAR(fechacontrato)='".$anio."' ORDER BY ".self::$idTabla." DESC";
			 $res=$db->query($sql)->fetchAll();
			 return ($res);

			 }
			 public function   listarBajaRango($fecha1 ,$fecha2){
			 global $db;
			 $this->get_objeto();
			 $sql="SELECT ".$this->selectAll()." FROM ".self::$tabla." where  tipocontrato='BAJA' AND (fechacontrato BETWEEN '".$fecha1."' AND '".$fecha2."')  ORDER BY ".self::$idTabla." ASC";
			 $res=$db->query($sql)->fetchAll();
			 return ($res);

}

              public function   listarTodosDiferidosRango($fecha1 ,$fecha2){
              global $db;
              $this->get_objeto();
              $sql="SELECT ".$this->selectAll()." FROM ".self::$tabla." where  (tipocontrato='DIFERIDO' OR tipocontrato='ESPERA') AND (fechacontrato BETWEEN '".$fecha1."' AND '".$fecha2."')  ORDER BY ".self::$idTabla." ASC";
              $res=$db->query($sql)->fetchAll();
              return ($res);

    }
		public function   listarDiferidosRango($fecha1 ,$fecha2){
		global $db;
		$this->get_objeto();
		$sql="SELECT ".$this->selectAll()." FROM ".self::$tabla." where  tipocontrato='DIFERIDO' AND (fechacontrato BETWEEN '".$fecha1."' AND '".$fecha2."')  ORDER BY ".self::$idTabla." ASC";
		$res=$db->query($sql)->fetchAll();
		return ($res);

}
				 public function   listarTodosDiferidosEsperaMes($mes ,$anio){
				 global $db;
				 $this->get_objeto();
				$sql="SELECT ".$this->selectAll()." FROM ".self::$tabla." where (tipocontrato='DIFERIDO' OR tipocontrato='ESPERA' ) AND MONTH(fechacontrato)='".$mes."' AND YEAR(fechacontrato)='".$anio."' ORDER BY ".self::$idTabla." DESC";
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}

    public function   listarTodosAnuladosMes($mes ,$anio){
        global $db;
        $this->get_objeto();
        $sql="SELECT ".$this->selectAll()." FROM ".self::$tabla." where tipocontrato='ANULADO' AND MONTH(fechacontrato)='".$mes."' AND YEAR(fechacontrato)='".$anio."' ORDER BY ".self::$idTabla." DESC";
        $res=$db->query($sql)->fetchAll();
        return ($res);

    }

    public function   listarTodosAnuladosRango($fecha1 ,$fecha2){
        global $db;
        $this->get_objeto();
        $sql="SELECT ".$this->selectAll()." FROM ".self::$tabla." where  tipocontrato='ANULADO' AND (fechacontrato BETWEEN '".$fecha1."' AND '".$fecha2."')  ORDER BY ".self::$idTabla." ASC";
        $res=$db->query($sql)->fetchAll();
        return ($res);

    }
				 public function   listarTodosVentasMes($mes ,$anio){
				 global $db;
				 $this->get_objeto();
				$sql="SELECT ".$this->selectAll()." FROM ".self::$tabla." where tipocontrato='VENTA' AND MONTH(fechacontrato)='".$mes."' AND YEAR(fechacontrato)='".$anio."' ORDER BY ".self::$idTabla." DESC";
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}
				 public function   listarTodosMes($mes ,$anio){
				 global $db;
				 $this->get_objeto();
				$sql="SELECT ".$this->selectAll()." FROM ".self::$tabla." where MONTH(fechacontrato)='".$mes."' AND YEAR(fechacontrato)='".$anio."' AND  terminado=1 AND tipocontrato!='ANULADO' ORDER BY ".self::$idTabla." DESC";
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}
				public function   listarTodosMes1($mes ,$anio){
				 global $db;
				 $this->get_objeto();
				$sql="SELECT ".$this->selectAll()." FROM ".self::$tabla." where MONTH(fechacontrato)='".$mes."' AND YEAR(fechacontrato)='".$anio."'      ORDER BY ".self::$idTabla." DESC";
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}
				 public function   listarTodosNulos(){
				 global $db;
				$sql="SELECT ".$this->selectAll()." FROM ".self::$tabla." where tipocontrato='ANULADO' ORDER BY ".self::$idTabla." DESC";
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}
				 public function   listarTodosVentas1(){
				 global $db;
				$sql="SELECT ".$this->selectAll()." FROM ".self::$tabla." where tipocontrato='VENTA' OR tipocontrato='CUENTA' ORDER BY ".self::$idTabla." DESC";
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}
				 public function   listarTodosVentas2(){
				 global $db;
				$sql="SELECT ".$this->selectAll()." FROM view_contrato_credito where tipocontrato='VENTA' AND tipoventa='CREDITO' ORDER BY ".self::$idTabla." DESC";
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}

				 public function  getContratoId($idcontrato){
				 global $db;
				$sql="SELECT ".$this->selectAll()." FROM view_contrato_credito where tipocontrato='VENTA'  AND idcontratos='".$idcontrato."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);

				}










				public  function updateEstado($id,$estado){
				global $db;
				$this->get_objeto();


				$sql ="UPDATE `contratos` SET `tipocontrato`='".$estado."' WHERE `contratos`.`idcontratos` ='".$id."'";
				$db->query($sql);
				}

				public  function updateTerminado($id,$terminado){
				global $db;
				$this->get_objeto();


				$sql ="UPDATE `contratos` SET `terminado`='".$terminado."' ,tipocontrato='DIFERIDO' WHERE `contratos`.`idcontratos` ='".$id."'";
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
				   public   function getIdKardex($id){
				global $db;
				$sql="SELECT idcontratos,idchofer,idvendedor,fechacontrato,numcontrato FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."' LIMIT 1";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);

				}
				public   function getAsignaciones($id){
				global $db;
				$sql="SELECT diacobrar,montopagos FROM ".self::$tabla." WHERE ".self::$idTabla."='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);

				}

				 /* public   function getContratosVendidosFecha($mes, $anio,  $orden){
				global $db;
				$sql=" SELECT * FROM view_contrato_credito WHERE MONTH(fechadoc)='".$mes."' AND YEAR(fechacontrato)='".$anio."'  AND (tipocontrato='VENTA' OR tipocontrato='CUENTA')  ORDER BY ".$orden;
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}*/

				  public   function getContratosVendidosFechaCredito($mes, $anio,  $orden){
				global $db;
				$sql=" SELECT * FROM view_contrato_credito WHERE MONTH(fechadoc)='".$mes."' AND YEAR(fechacontrato)='".$anio."'  AND (tipocontrato='VENTA' OR tipocontrato='CUENTA')   AND tipoventa='CREDITO' ORDER BY ".$orden;
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}

    public   function getContratosVendidosFechaCreditoRango($fecha1,$fecha2, $orden){
        global $db;
        $sql=" SELECT * FROM view_contrato_credito WHERE (fechadoc BETWEEN '".$fecha1."' AND '".$fecha2."')  AND (tipocontrato='VENTA' OR tipocontrato='CUENTA')   AND tipoventa='CREDITO' ORDER BY ".$orden;
        $res=$db->query($sql)->fetchAll();
        return ($res);

    }

                public   function getContratosVendidosFechaContado($mes, $anio,  $orden){
				global $db;
				$sql=" SELECT * FROM view_contrato_credito WHERE MONTH(fechadoc)='".$mes."' AND YEAR(fechadoc)='".$anio."'  AND (tipocontrato='VENTA' OR tipocontrato='CUENTA')   AND tipoventa='CONTADO' ORDER BY ".$orden;
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}
    public   function getContratosVendidosFechaContadoRango($fecha1, $fecha2,  $orden){
        global $db;
        $sql=" SELECT * FROM view_contrato_credito WHERE (fechadoc BETWEEN '".$fecha1."' AND '".$fecha2."')  AND (tipocontrato='VENTA' OR tipocontrato='CUENTA')   AND tipoventa='CONTADO' ORDER BY ".$orden;
        $res=$db->query($sql)->fetchAll();
        return ($res);

    }
                public   function getContratosVendidosFechaContCred($mes, $anio,  $orden){
				global $db;
				$sql=" SELECT * FROM view_contrato_credito WHERE MONTH(fechadoc)='".$mes."' AND YEAR(fechadoc)='".$anio."'    AND (tipocontrato='VENTA' OR tipocontrato='CUENTA') AND (tipoventa='CONTADO' OR  tipoventa='CREDITO') ORDER BY ".$orden;
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}
    public   function getContratosVendidosFechaContCredRango($fecha1, $fecha2,  $orden){
        global $db;
        $sql=" SELECT * FROM view_contrato_credito WHERE (fechadoc BETWEEN '".$fecha1."' AND '".$fecha2."')  AND (tipocontrato='VENTA' OR tipocontrato='CUENTA') AND (tipoventa='CONTADO' OR  tipoventa='CREDITO') ORDER BY ".$orden;
        $res=$db->query($sql)->fetchAll();
        return ($res);

    }
				public   function getContratosVendidosFechaContCredCobrador($mes, $anio, $idcobrador, $orden){
				global $db;
				$sql=" SELECT * FROM view_contrato_credito WHERE MONTH(fechadoc)='".$mes."' AND YEAR(fechadoc)='".$anio."'   AND (tipocontrato='VENTA' OR tipocontrato='CUENTA') AND (tipoventa='CONTADO' OR  tipoventa='CREDITO') AND idcobrador='".$idcobrador."' ORDER BY ".$orden;
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}
				public   function getContratosVendidosFechaContCredVendedor($mes, $anio, $idvendedor, $orden){
				global $db;
					$sql=" SELECT * FROM view_contrato_credito WHERE MONTH(fechadoc)='".$mes."' AND YEAR(fechadoc)='".$anio."'   AND (tipocontrato='VENTA' OR tipocontrato='CUENTA') AND (tipoventa='CONTADO' OR  tipoventa='CREDITO') AND idvendedor='".$idvendedor."' ORDER BY ".$orden;
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}
				  public   function getContratosDiferidosFecha($mes, $anio,$orden){
				global $db;
				$sql="SELECT * FROM view_contrato_credito WHERE MONTH(fechacontrato)='".$mes."' AND YEAR(fechacontrato)='".$anio."' AND tipocontrato='DIFERIDO'     ORDER BY ".$orden;
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}
    public   function getContratosDiferidosFechaRango($fecha1, $fecha2,$orden){
        global $db;
        $sql="SELECT * FROM view_contrato_credito WHERE (fechacontrato BETWEEN '".$fecha1."' AND '".$fecha2."') AND tipocontrato='DIFERIDO'     ORDER BY ".$orden;
        $res=$db->query($sql)->fetchAll();
        return ($res);

    }
    public   function getContratosDiferidosFecha1($mes, $anio,$orden,$id){
				global $db;
				$sql="SELECT idcontrato,nombrevendedor,nombrecobrador,nombres,apellidopaterno,apellidomaterno,numcuentacontrato,numcontrato,preciototal,cuotainicial,saldo,montopagos,numpagos,porcentajecomision,montocomision,numreporte ,valorcomisionable FROM ".self::$tabla." WHERE MONTH(fechacontrato)='".$mes."' AND YEAR(fechacontrato)='".$anio."' AND tipocontrato='DIFERIDO'  AND idcontratos='".$id."'    ORDER BY ".$orden;
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}
				  public   function getContratosVendidosFecha1($mes, $anio,$orden,$id){
				global $db;
				$sql="SELECT idcontrato,nombrevendedor,nombrecobrador,nombres,apellidopaterno,apellidomaterno,numcuentacontrato,numcontrato,preciototal,cuotainicial,saldo,montopagos,numpagos,porcentajecomision,montocomision,numreporte,valorcomisionable  FROM ".self::$tabla." WHERE MONTH(fechadoc)='".$mes."' AND YEAR(fechadoc)='".$anio."' AND tipocontrato!='DIFERIDO'  AND idcontratos='".$id."'    ORDER BY ".$orden;
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}

				  public   function getContratosCreditoCobrador($mes, $anio,  $orden,$idcobrador){
				global $db;
				$sql=" SELECT * from view_contrato_credito WHERE MONTH(fechadoc)='".$mes."' AND YEAR(fechadoc)='".$anio."'  AND (tipocontrato='VENTA' OR tipocontrato='CUENTA')   AND tipoventa='CREDITO' AND idcobrador='".$idcobrador."' ORDER BY ".$orden;
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}


				  public   function getContratosContadoCobrador($mes, $anio,  $orden,$idcobrador){
				global $db;
				$sql=" SELECT * from view_contrato_credito WHERE MONTH(fechadoc)='".$mes."' AND YEAR(fechadoc)='".$anio."'  AND (tipocontrato='VENTA' OR tipocontrato='CUENTA')   AND tipoventa='CONTADO' AND idcobrador='".$idcobrador."' ORDER BY ".$orden;
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}




				  public   function getContratosDiferidosCobrador($mes, $anio,  $orden,$idCobrador){
				global $db;
				$sql="SELECT * from view_contrato_credito WHERE MONTH(fechacontrato)='".$mes."' AND YEAR(fechacontrato)='".$anio."'  AND tipocontrato='DIFERIDO' AND idcobrador='".$idCobrador."' ORDER BY ".$orden;
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}
				  public   function getContratosCreditoVendedor($mes, $anio,$orden, $idvendedor){
				global $db;
				$sql="SELECT * from view_contrato_credito WHERE MONTH(fechadoc)='".$mes."' AND YEAR(fechadoc)='".$anio."' AND (tipocontrato='VENTA' OR tipocontrato='CUENTA')   AND tipoventa='CREDITO' and idvendedor='".$idvendedor."'   ORDER BY ".$orden;
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}

				 public   function getContratosContadoVendedor($mes, $anio,$orden, $idvendedor){
				global $db;
				$sql="SELECT * from view_contrato_credito WHERE MONTH(fechadoc)='".$mes."' AND YEAR(fechadoc)='".$anio."' AND (tipocontrato='VENTA' OR tipocontrato='CUENTA')   AND tipoventa='CONTADO' and idvendedor='".$idvendedor."'   ORDER BY ".$orden;
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}

				  public   function getContratosDiferidosVendedor($mes, $anio,$orden,$idvendedor){
				global $db;
				$sql="SELECT * from view_contrato_credito WHERE MONTH(fechacontrato)='".$mes."' AND YEAR(fechacontrato)='".$anio."' AND tipocontrato='DIFERIDO'   and idvendedor='".$idvendedor."' ORDER BY ".$orden;
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}
				public function validarCodigo($cod){

					global $db;
				$sql="SELECT count(codigo) FROM ".self::$tabla." WHERE codigo ='".$cod."'";
				$res=$db->query($sql)->fetchColumn();
				return ($res);

					}

				public function getMesVendidos($mes,$anio){

					global $db;
				$sql="SELECT idcontrato  FROM ".self::$tabla." WHERE  (tipocontrato='VENTA' OR tipocontrato='CUENTA') AND MONTH(fechadoc)='".$mes."' AND YEAR(fechadoc)='".$anio."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);

					}

					public function getMesVendidos2($fecha){

					global $db;
				$sql="SELECT idcontrato  FROM ".self::$tabla." WHERE  (tipocontrato='VENTA' OR tipocontrato='CUENTA') AND fechadoc between '2013-1-1' AND '".$fecha."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);

					}

					public function kardexMayorTotal($mes,$anio){

					global $db;
				$sql="SELECT DISTINCT detalle_contrato.codigo ,detalle_contrato.libros_idlibros FROM `detalle_contrato`, view_contrato_credito WHERE  detalle_contrato.contratos_idcontratos=view_contrato_credito.idcontratos AND  (view_contrato_credito.tipocontrato='CUENTA' or view_contrato_credito.tipocontrato='VENTA') AND MONTH(view_contrato_credito.fechadoc)='".$mes."' AND  YEAR(view_contrato_credito.fechadoc)='".$anio."' order by codigo";
				$res=$db->query($sql)->fetchAll();
				return ($res);

					}


						public function reporteAsignaciones($id){

					global $db;
				$sql="SELECT diacobrar,montopagos FROM ".self::$tabla." WHERE idcontratos='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);

					}


				public function produccionDiaria($fecha){

					global $db;
					$f=explode('-',$fecha);
					$f1=$f[0]."-".$f[1]."-01";
				$sql="SELECT idvendedor, COUNT(numcuenta) as cont,SUM(preciototal) as ptotal,SUM(valorcomisionable) as comision, SUM(cuotainicial) as cuota ,fechadoc FROM view_contrato_credito GROUP BY idvendedor,fechadoc,tipocontrato HAVING (tipocontrato='VENTA' or tipocontrato='CUENTA') AND (fechadoc BETWEEN '".$f1."'  AND '".$fecha."')";
				$res=$db->query($sql)->fetchAll();
				return ($res);

					}


				public function produccionMensual($idVendedor,$mes,$anio){

					global $db;
				$sql="SELECT *   FROM view_contrato_credito WHERE (tipocontrato='VENTA' OR tipocontrato='CUENTA') AND idvendedor='".$idVendedor."' AND MONTH(fechadoc)='".$mes."' AND YEAR(fechadoc)='".$anio."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);

					}


			public function getVendedoresProduccion($mes ,$anio){

					global $db;
				$sql="SELECT distinct view_contrato_credito.idvendedor FROM view_contrato_credito WHERE (tipocontrato='VENTA' OR tipocontrato='CUENTA')AND MONTH(fechadoc)='".$mes."' AND YEAR(fechadoc)='".$anio."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);

					}



				   	public function getContratosContado($mes,$anio){

					global $db;
				$sql="SELECT sum(preciototal) as total, count(numcuenta)as cuentas FROM view_contrato_credito WHERE (tipocontrato='VENTA' or tipocontrato='CUENTA') and (numcuotas=1) AND saldo=0 and MONTH(fechadoc)='".$mes."' and YEAR(fechadoc)='".$anio."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);

					}
						public function getContratosDosPagos($mes,$anio){

					global $db;
				$sql="SELECT sum(preciototal) as total, count(numcuenta)as cuentas FROM view_contrato_credito WHERE (tipocontrato='VENTA' or tipocontrato='CUENTA') and numcuotas=2 AND MONTH(fechadoc)='".$mes."' and YEAR(fechadoc)='".$anio."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);

					}
					public function getContratosCuatroPagos($mes,$anio){

					global $db;
				$sql="SELECT sum(preciototal) as total, count(numcuenta)as cuentas FROM view_contrato_credito WHERE (tipocontrato='VENTA' or tipocontrato='CUENTA') and (numcuotas=3 or numcuotas=4) AND MONTH(fechadoc)='".$mes."' and YEAR(fechadoc)='".$anio."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);

					}
	public function getContratosSeisPagos($mes,$anio){

					global $db;
				$sql="SELECT sum(preciototal) as total, count(numcuenta)as cuentas FROM view_contrato_credito WHERE (tipocontrato='VENTA' or tipocontrato='CUENTA') and (numcuotas=5 or numcuotas=6) AND MONTH(fechadoc)='".$mes."' and YEAR(fechadoc)='".$anio."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);

					}
					public function getContratosOchoPagos($mes,$anio){

					global $db;
				$sql="SELECT sum(preciototal) as total, count(numcuenta)as cuentas FROM view_contrato_credito WHERE (tipocontrato='VENTA' or tipocontrato='CUENTA') and (numcuotas=7 or numcuotas=8) AND MONTH(fechadoc)='".$mes."' and YEAR(fechadoc)='".$anio."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);

					}
					public function getContratosDiezPagos($mes,$anio){

					global $db;
				$sql="SELECT sum(preciototal) as total, count(numcuenta)as cuentas FROM view_contrato_credito WHERE (tipocontrato='VENTA' or tipocontrato='CUENTA') AND (numcuotas=9 or numcuotas=10) AND MONTH(fechadoc)='".$mes."' and YEAR(fechadoc)='".$anio."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);

					}

					public function updateDevolucionParcial($idcontrato,$monto){

					global $db;
				$sql ="UPDATE `contratos` SET preciototal=preciototal-'".$monto."',terminado=0, tipocontrato='DIFERIDO', cuotainicial=' ',saldo='', numpagos='', montopagos='', montocomision='' , valorcomisionable ='' WHERE `contratos`.`idcontratos` ='".$idcontrato."'";
				$res=$db->query($sql);

				return ($res);

					}

					public function getVendedoresContratos($fecha1 ,$fecha2){

					global $db;
				//$sql="SELECT distinct idvendedor FROM view_contrato_credito WHERE  ( fechadoc   OR  fechacontrato BETWEEN '".$fecha1."' AND '".$fecha2."') AND 	(tipocontrato!='ANULADO' and tipocontrato!='BAJA' AND  tipocontrato!='espera') AND terminado=1";
				 $sql= "SELECT distinct idvendedor FROM view_contrato_credito WHERE   (fechadoc    BETWEEN '".$fecha1."' AND '".$fecha2."') OR (fechacontrato   BETWEEN '".$fecha1."' AND '".$fecha2."') AND 	(tipocontrato='DIFERIDO' or tipocontrato='VENTA') AND terminado=1";

				$res=$db->query($sql)->fetchAll();
				return ($res);

					}

				public function sumContratosTipoVendedor($tipo,$vendedor,$fecha1,$fecha2){

					global $db;
				$sql="SELECT sum(detalle_contrato.precio_unitario*detalle_contrato.cantidad) as monto  FROM detalle_contrato, view_contrato_credito WHERE view_contrato_credito.tipocontrato='".$tipo."' and view_contrato_credito.idvendedor='".$vendedor."' AND (view_contrato_credito.fechacontrato BETWEEN '".$fecha1."'  AND '".$fecha2."') AND view_contrato_credito.terminado=1 AND  view_contrato_credito.idcontratos=detalle_contrato.contratos_idcontratos";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["monto"]);


					}
					public function sumContratosTipoVendedor2($vendedor,$fecha1,$fecha2){

					global $db;
				$sql="SELECT sum(detalle_contrato.precio_unitario*detalle_contrato.cantidad) as monto  FROM detalle_contrato, view_contrato_credito WHERE  (view_contrato_credito.tipocontrato='VENTA' OR view_contrato_credito.tipocontrato='CUENTA') AND (fechadoc BETWEEN '".$fecha1."'  AND '".$fecha2."') AND view_contrato_credito.idvendedor='".$vendedor."' AND view_contrato_credito.idcontratos=detalle_contrato.contratos_idcontratos";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["monto"]);


					}

					public function contarContratosTipoVendedor($tipo,$vendedor,$fecha1,$fecha2){

					global $db;
				$sql="SELECT count(numcontrato) as cantidad  FROM  view_contrato_credito WHERE tipocontrato='".$tipo."' AND idvendedor='".$vendedor."' AND (fechacontrato BETWEEN '".$fecha1."'  AND '".$fecha2."') AND terminado=1";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["cantidad"]);


					}
						public function contarContratosTipoVendedor2($vendedor,$fecha1,$fecha2){

					global $db;
				$sql="SELECT count(numcontrato) as cantidad  FROM  view_contrato_credito WHERE (tipocontrato='VENTA' OR tipocontrato='CUENTA') AND (fechadoc BETWEEN '".$fecha1."'  AND '".$fecha2."') AND idvendedor='".$vendedor."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["cantidad"]);


					}

			public function updateNumContrato($idcontrato,$valor){

					global $db;
				$sql ="UPDATE `contratos` SET numcontrato='".$valor."' WHERE `contratos`.`idcontratos` ='".$idcontrato."'";
				$res=$db->query($sql);

				return ($res);

					}

					public   function getPorContrato($numcontrato){
				global $db;
				$sql="SELECT idcontratos, nombres, apellidopaterno,apellidomaterno,idchofer FROM ".self::$tabla." WHERE numcontrato='".$numcontrato."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);

				}

					public   function getNombresClientePorContrato($numcontrato){
				global $db;
				$sql="SELECT nombres, apellidopaterno,apellidomaterno FROM ".self::$tabla." WHERE numcontrato='".$numcontrato."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["nombres"]." ".$res["apellidopaterno"]." ".$res["apellidomaterno"]);

				}

				 public function   listarTodosVentasMesFacturados($mes ,$anio){
				 global $db;
				 $this->get_objeto();
				$sql="SELECT * FROM view_contrato_credito where tipocontrato='VENTA' AND MONTH(fechadoc)='".$mes."' AND YEAR(fechadoc)='".$anio."' ORDER BY ".self::$idTabla." DESC";
				$res=$db->query($sql)->fetchAll();
				return ($res);

				}
				public function   listarCuotasInicialesFecha($fecha1 ,$fecha2){
				 global $db;
				 $this->get_objeto();
				 $sql="SELECT * FROM view_contrato_credito WHERE  fechacobranza BETWEEN '".$fecha1."' AND '".$fecha2."' AND  tipocontrato='DIFERIDO' AND terminado=1";

				$res=$db->query($sql)->fetchAll();
				return ($res);

				}

				public function relacionObrasVendidasl($mes,$anio){

					global $db;
				$sql="SELECT DISTINCT detalle_contrato.codigo ,detalle_contrato.libros_idlibros FROM `detalle_contrato`, view_contrato_credito WHERE  detalle_contrato.contratos_idcontratos=view_contrato_credito.idcontratos AND  (view_contrato_credito.tipocontrato='CUENTA' or view_contrato_credito.tipocontrato='VENTA') AND MONTH(view_contrato_credito.fechadoc)='".$mes."' AND  YEAR(view_contrato_credito.fechadoc)='".$anio."' order by codigo";
				$res=$db->query($sql)->fetchAll();
				return ($res);

					}
    public function getVendedorChofer($idcontrato){

        global $db;
        $sql="SELECT idvendedor,idchofer FROM  ".self::$tabla." WHERE idcontratos=".$idcontrato;
        $res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return ($res);

    }

}





	?>
