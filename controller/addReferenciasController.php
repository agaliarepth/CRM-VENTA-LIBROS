<?php 
require_once("model/vendedoresModel.php");
require_once("model/contratosModel.php");
require_once("model/librosModel.php");
require_once("model/librosAlmacenesModel.php");
require_once("model/kardexVendedorModel.php");
require_once("model/detalle_contratoModel.php");
require_once("model/ReferenciasModel.php");
require_once("model/creditoModel.php");
require_once("model/contadoModel.php");
$ref=new Referencias();

if(isset($_POST["enviar"])&& $_POST["enviar"]=="enviar"){
	
	
	$ref->edad=strtoupper($_POST["edad"]);
	$ref->expedidoci=strtoupper($_POST["expedido_ci"]);
	$ref->nit=strtoupper($_POST["nit"]);
	$ref->direccion=strtoupper($_POST["direccion"]);
	$ref->dir_num=strtoupper($_POST["dir_num"]);
	$ref->telf=strtoupper($_POST["telf"]);
	$ref->cel=strtoupper($_POST["cel"]);
	$ref->barrio=strtoupper($_POST["barrio"]);
	$ref->zona=strtoupper($_POST["zona"]);
	$ref->tipocasa=strtoupper($_POST["tipo_casa"]);
	$ref->tiempovivemes=strtoupper($_POST["tiempo_vive_mes"]);
	$ref->tiempoviveanio=strtoupper($_POST["tiempo_vive_anio"]);
	$ref->fechavigente=strtoupper($_POST["fecha_contrato_vigente"]);
	$ref->nombrepropietariocasa=strtoupper($_POST["nombre_propietario_casa"]);
	$ref->detallecasa=strtoupper($_POST["detalle_casa"]);
	$ref->telfpropietario=strtoupper($_POST["telf_propietario"]);
	$ref->emailpropietario=strtoupper($_POST["email_propietario"]);
	$ref->centrotrabajo=strtoupper($_POST["centro_trabajo"]);
	$ref->cargoocupa=strtoupper($_POST["cargo_ocupa"]);
	$ref->antiguedad=strtoupper($_POST["antiguedad"]);
    $ref->jefeinmediato=strtoupper($_POST["jefe_inmediato"]);
	$ref->direcciontrabajo=strtoupper($_POST["direccion_trabajo"]);
	$ref->numtrabajo=$_POST["num_trabajo"];
	$ref->telftrabajo=strtoupper($_POST["telf_trabajo"]);	
	$ref->barriotrabajo=strtoupper($_POST["barrio_trabajo"]);
	$ref->zonatrabajo=strtoupper($_POST["zona_trabajo"]);
	$ref->ingreso=$_POST["ingreso"];
	$ref->otrosingresos=$_POST["otros_ingresos"];
	$ref->totalingresos=$_POST["total_ingresos"];
	$ref->nombrepareja=strtoupper($_POST["nombre_pareja"]);
	$ref->cipareja=$_POST["ci_pareja"];
	$ref->celpareja=$_POST["cel_pareja"];
	$ref->trabajopareja=strtoupper($_POST["trabajo_pareja"]);
	$ref->cargopareja=strtoupper($_POST["cargo_pareja"]);
	$ref->antiguedadpareja=strtoupper($_POST["antiguedad_pareja"]);
	$ref->dirtrabajopareja=strtoupper($_POST["dir_trabajo_pareja"]);
	$ref->numdirtrabajopareja=$_POST["num_dir_trabajo_pareja"];
	$ref->telftrabajopareja=$_POST["telf_trabajo_pareja"];
	$ref->barriotrabajopareja=strtoupper($_POST["barrio_trabajo_pareja"]);
	$ref->zonatrabajopareja=strtoupper($_POST["zona_trabajo_pareja"]);
	$ref->nombrehijos1=strtoupper($_POST["nombre_hijos1"]);
	$ref->colegiohijos1=strtoupper($_POST["colegio_hijos1"]);
	$ref->cursohijos1=strtoupper($_POST["curso_hijos1"]);
	$ref->zonahijos1=strtoupper($_POST["zona_hijos1"]);
	$ref->nombrehijos2=strtoupper($_POST["nombre_hijos2"]);
	$ref->colegiohijos2=strtoupper($_POST["colegio_hijos2"]);
	$ref->cursohijos2=strtoupper($_POST["curso_hijos2"]);
	$ref->zonahijos2=strtoupper($_POST["zona_hijos2"]);
    $ref->otrasref=$_POST["otras_ref"];
	$ref->nombregarante=strtoupper($_POST["nombre_garante"]);
	$ref->cigarante=$_POST["ci_garante"];
	$ref->expedidogarante=strtoupper($_POST["expedido_garante"]);
	$ref->dirgarante=strtoupper($_POST["dir_garante"]);
	$ref->numgarante=strtoupper($_POST["num_garante"]);
	$ref->telfgarante=strtoupper($_POST["telf_garante"]);
	$ref->celgarante=strtoupper($_POST["cel_garante"]);
	$ref->barriogarante=strtoupper($_POST["barrio_garante"]);
	$ref->zonagarante=strtoupper($_POST["zona_garante"]);
	$ref->trabajogarante=strtoupper($_POST["trabajo_garante"]);
	$ref->cargogarante=strtoupper($_POST["cargo_garante"]);
	$ref->antiguedadgarante=strtoupper($_POST["antiguedad_garante"]);
	$ref->dirtrabajogarante=strtoupper($_POST["dir_trabajo_garante"]);
	$ref->numtrabajogarante=strtoupper($_POST["num_trabajo_garante"]);
	$ref->telftrabajogarante=strtoupper($_POST["telf_trabajo_garante"]);
	$ref->barriotrabajogarante=strtoupper($_POST["barrio_trabajo_garante"]);
	$ref->zonatrabajogarante=strtoupper($_POST["zona_trabajo_garante"]);
	$ref->diacobrar=strtoupper($_POST["dia_cobrar"]);
	$ref->horascobrar=strtoupper($_POST["horas_cobrar"]);
	$ref->observaciones=strtoupper($_POST["observaciones"]);
	$ref->lugarcobranza=strtoupper($_POST["lugarcobranza"]);
	$ref->credito_idcredito=$_POST["idcredito"];
	if($_POST["nuevo"]==1)
	$ref->nuevo();
	else
	$ref->actualizar($_POST["idreferencias"]);
		 header("Location:".config::ruta()."?accion=addReferencias");


	
	
	}
require_once("view/addReferencias.php");
?>