<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
<?php 
if(isset($_GET["m"])){
switch($_GET["m"]){
	case "1":{} break;
	case "2":{echo "<h1>no tiene permiso  de acceso a esta Pagina </h1>";} break;
	case "3":{echo "<h1>NO SE PERMITE ESTA ACCION  <a href='".config::ruta()."?accion=contratos'>Volver</a></h1>";} break;
	case "4":{} break;
	case "5":{} break;
	
	}
}
?>

</body>
</html>