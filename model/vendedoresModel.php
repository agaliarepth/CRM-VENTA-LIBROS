<?php
//require_once("helpers/ManagementDB.php");
require_once("helpers/resize.php");

class Vendedores {
	static $tabla="vendedores";
	static $idTabla="idVendedores";
	static $objeto;
	
	public  $codigo;
	public  $nombres;
	public  $apellidos;
	public  $carnet;
	public  $telefono;
	public $email;
	public $direccion;
	public $estatus;
	public $nacionalidad;
	public $tipo_documento;
	public $supervisor;
	public $credito;
	public $tipocomisioncredito;
	public $valorcomisioncredito;
	public $tipocomisioncontado;
	public $valorcomisioncontado;
	
  
  
	
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
				$sql="SELECT * FROM ".self::$tabla." order by apellidos";
				$res=$db->query($sql)->fetchAll();
				return ($res);
				
				}
				
		    public function guardarFoto(){
				$ruta="";
				if($_FILES["logo"]["name"]==""){
					 $ruta=config::ruta()."images/fotos/libros/sinFoto.jpg";
					return $ruta;
					
					}
				
				else{
				copy($_FILES["logo"]["tmp_name"],"images/fotos/libros/".$_FILES["logo"]["name"]);
				
                $thumb=new thumbnail("images/fotos/libros/".$_FILES["logo"]["name"]);	
		        $thumb->size_width(80);//setea el ancho de la copia
		         $thumb->size_height(80);//setea el alto de la copia
		         $thumb->jpeg_quality(75);//setea la calidad jpg
		         $nom=$_POST["idlibros"].$_POST["codigo"].".jpg";
		         $thumb->save("images/fotos/libros/$nom");
				 	//guardarla en el servidor
		         //$thumb->show();	//mostrar la imagen copiada
		        unlink("images/fotos/libros/".$_FILES["logo"]["name"]);
				$ruta="images/fotos/libros/$nom";
				//$ruta=config::ruta()."images/fotos/editoriales/".$_FILES["logo"]["name"];
				return $ruta;
				}
				
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
                public function actualizarEstado($id,$estatus){
                    
                   global $db;
				$sql="UPDATE ".self::$tabla."SET estatus='".$estatus."' WHERE ".self::$idTabla."='".$id."'";
				$res=$db->query($sql);
				 
				return ($res); 
                    
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
				
				public function borrarFoto($dir){
					unlink($dir);
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
	     public   function getSupervisor($id){
				global $db;
				$sql="SELECT supervisor FROM ".self::$tabla." WHERE  idVendedores='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}	
				
				 public   function getNombreVendedor($id){
				global $db;
				$sql="SELECT nombres,apellidos FROM ".self::$tabla." WHERE  idVendedores='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}	
				 public   function getNombresVendedor($id){
				global $db;
				$sql="SELECT nombres,apellidos FROM ".self::$tabla." WHERE  idVendedores='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["nombres"]." ".$res["apellidos"]);
				
				}	
				 public   function getCredito($id){
				global $db;
				$sql="SELECT credito FROM ".self::$tabla." WHERE  idVendedores='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res["credito"]);
				
				}	
				
				 public   function getComisiones($id){
				global $db;
				$sql="SELECT tipocomisioncredito,valorcomisioncredito,tipocomisioncontado,valorcomisioncontado FROM ".self::$tabla." WHERE  idVendedores='".$id."'";
				$res=$db->query($sql)->fetch(PDO::FETCH_ASSOC);
				return ($res);
				
				}



	}


	?>