<?php
class Credito {
	static $tabla="credito";
	static $idTabla="idcredito";
	static $objeto;
	static $lastId;
	
	
public $cuotainicial; 	
public $numcuotas; 	
public $montocuotas; 	
public $montocomision; 	
public $porcentajecomision;
public $saldo; 	
public $saldocuota; 	
public $idcobrador;
public $numreporte; 	
public $contratos_idcontratos; 	
public $valorcomisionable;
public $numcuenta; 	
public $numdocumento;
public $tipodoc; 	
public $fechadoc; 	
public $montodoc; 
public $fechacobranza; 
public $cuentacomision;
public $estado;
 	



  
	
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
				self::$lastId=$db->lastID("idcredito"); 
				
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
				$sql="SELECT * FROM ".self::$tabla." ORDER BY ".self::$idTabla." DESC";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
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
				public   function getPorContrato($idcontrato){
				global $db;
				$sql="SELECT * FROM ".self::$tabla." WHERE contratos_idcontratos='".$idcontrato."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}	
				public   function getContrato($idcred){
				global $db;
				$sql="SELECT contratos_idcontratos FROM ".self::$tabla." WHERE ".self::$idTabla."='".$idcred."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["contratos_idcontratos"]);
				
				}	
				
				public function getNumCuenta(){
				   	global $db;
				$sql="SELECT max(numcuenta) as num FROM ".self::$tabla;
				$res=$db->query($sql)->fetchColumn();
				return ($res);
					
				   
				   }


                public  function actualizarVenta($id,$numcuenta,$numrecibo,$numreporte,$montorecibo,$fecharecibo,$idcobrador,$tipo){
				global $db;
	
				 
				$sql ="UPDATE ".self::$tabla." SET numcuenta = '".$numcuenta."', numdocumento = '".$numrecibo."', numreporte='".$numreporte."' ,montodoc='".$montorecibo."',fechadoc='".$fecharecibo."',tipodoc='".$tipo."',idcobrador='".$idcobrador."' WHERE ".self::$idTabla."='".$id."'";
				$res=$db->query($sql);
				return($res);
				}
				
				 public  function getContratos($numcontrato){
				global $db;
	
				$sql="SELECT * FROM  view_contrato_credito  where numcontrato='".$numcontrato."'";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				}
				 public  function getContratosId($idcontrato){
				global $db;
	
				$sql="SELECT * FROM  view_contrato_credito  where idcontratos='".$idcontrato."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				}

				 public  function getPorNumCuenta($numcuenta){
				global $db;
	
				$sql="SELECT * FROM  ".self::$tabla."   where numcuenta='".$numcuenta."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				}


    public function borrarPorContrato($idcontrato){

        global $db;
        $sql="delete  FROM ".self::$tabla." WHERE contratos_idcontratos='".$idcontrato."'";
        $res=$db->query($sql);

        return ($res);
    }


    public  function reasignarContrato($idcuenta,$idcontrato){
        global $db;


        $sql ="UPDATE ".self::$tabla." SET contratos_idcontratos = '".$idcontrato."' WHERE ".self::$idTabla."=".$idcuenta;
        $res=$db->query($sql);
        return($res);
    }
    public  function updateEstado($idcuenta,$estado){
        global $db;


        $sql ="UPDATE ".self::$tabla." SET estado = '".$estado."' WHERE ".self::$idTabla."=".$idcuenta;
        $res=$db->query($sql);
        return($res);
    }
 public function getCuentasMes($mes,$anio){
        global $db;
        $sql="SELECT  * FROM view_contrato_credito WHERE  MONTH(fechadoc)='".$mes."' AND YEAR(fechadoc)='".$anio."'  and estadocredito='C'";
        $res=$db->query($sql)->fetchAll();
        return ($res);
    }
     public function getCuentasPorNumCuenta($numcuenta){
        global $db;
        $sql="SELECT  * FROM view_contrato_credito WHERE  numcuenta='".$numcuenta."' and estadocredito='C'";
        $res=$db->query($sql)->fetchAll();
        return ($res);
        
    }

    public function getCuentasPorNumCuenta2($numcuenta){
        global $db;
        $sql="SELECT  * FROM view_contrato_credito WHERE  numcuenta='".$numcuenta."' and estadocredito='C'";
        $res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return ($res);
        
    }
    public function listarCuentasRango($f1,$f2){
        global $db;
        $sql="SELECT  * FROM view_contrato_credito WHERE  fechadoc BETWEEN ('".$f1."' AND '".$f2."')  and estadocredito='C'";
        $res=$db->query($sql)->fetchAll();
        return ($res);
    }

    public  function getCreditoContratoId($idcredito){
        global $db;

        $sql="SELECT * FROM  view_contrato_credito  where idcredito='".$idcredito."'";
        $res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return ($res);
    }

    public function cuentasPorCobrador2($idcobrador ,$fecha){

               global $db;
        $sql="SELECT * FROM view_contrato_credito WHERE idcobrador ='".$idcobrador."' and fechadoc BETWEEN '2013-01-01' and '".$fecha."'";
        $res=$db->query($sql)->fetchAll();
        return ($res);
    }
     public  function updateSaldos($idcredito,$saldo,$numcuotas,$montocuotas){
        global $db;
        $sql ="UPDATE ".self::$tabla." SET saldo = '".$saldo."',numcuotas = '".$numcuotas."',montocuotas = '".$montocuotas."'  WHERE ".self::$idTabla."=".$idcredito;
        $res=$db->query($sql);
        return($res);
    }

}




    



					
	
	


	?>