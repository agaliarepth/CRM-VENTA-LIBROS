<?php 
require_once("model/administracionModel.php");

$admin=new Administracion();
$admin->limpiarBaseDatos();
header("Location:".config::ruta()."?accion=home");

/*require_once("view/restaurarDb.php");

if(isset($_GET["e"])&& $_GET["e"]=="d"){
	
	unlink($_GET["id"]);
	header("Location:".config::ruta()."?accion=restaurarDb");
	
	}
	
	if(isset($_GET["e"])&& $_GET["e"]=="r"){
	
	global $db;
	
	
//$file = $_GET["id"];
$file=config::ruta().$_GET["id"];
$dbuser="root";
$dbpass="";
$dbname="panamericansantacruz";
$dbhost="localhost";
 flush();
      $conn = mysql_connect($dbhost,$dbuser,$dbpass) or die(mysql_error());
	$filename = $file;
	set_time_limit(1000);
	$file=fread(fopen($file, "r"), filesize($file));
	$query=explode(";#$$\n",$file);
	for ($i=0;$i < count($query)-1;$i++) {
		mysql_db_query($dbname,$query[$i],$conn) or die(mysql_error());
	}
			 header("Location:".config::ruta()."?accion=home");

	}
 ?>*/