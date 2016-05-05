<?php
require_once("model/kardexVendedorModel.php");
require_once("model/vendedoresModel.php");


$k=new kardexVendedor();
$v=new Vendedores();

if(isset($_POST["consulta"])){

    $res=$k->listarVendedoresCargos($_POST["mes"],$_POST["anio"]);

}
if(isset($_GET["mes"])&&isset($_GET["anio"])&&isset($_GET["id"])){
    $mes=0; $anio=0;
    if($_GET["mes"]=="12"){
        $mes=1;
        $anio=$_GET["anio"]+1;
    }
    else{
        $mes=$_GET["mes"]+1;
        $anio=$_GET["anio"];

    }


    $res5=$k->ObtenerCargos($_GET["id"],$_GET["mes"],$_GET["anio"]);
    $res6=$k->ObtenerCargosDiferidos($_GET["id"],$_GET["mes"],$_GET["anio"]);
    $k->pasarCargos($_GET["id"],$_GET["mes"],$_GET["anio"]);
    $k->pasarCargosDiferidos($_GET["id"],$_GET["mes"],$_GET["anio"]);
    if(count($res5)>0){
        foreach($res5 as $v){
            $k->fecha_remision=$anio."-".$mes."-1";
            $k->num_remision=$v["num_remision"];
            $k->fecha_devolucion="";
            $k->num_devolucion="";
            $k->cod_libro=$v["cod_libro"];
            $k->titulo_libro=$v["titulo_libro"];
            $k->estado_libro="Remitido";
            $k->num_contrato="";
            $k->reg_ventas="";
            $k->nombres_cliente="";
            $k->vendedores_idVendedores=$_GET["id"];
            $k->idlibro=$v["idlibro"];
            $k->idalmacenes=$v["idalmacenes"];
            $k->tomo_libro=$v["tomo_libro"];
            $k->idcontrato="";
            $k->cargo=1;
            $k->insertar();


        }

        $k->nuevo();
        unset($k);
    }
    if(count($res6)>0){
        $k=new kardexVendedor();


        foreach($res6 as $v){

            $k->fecha_remision=$anio."-".$mes."-1";
            $k->num_remision=$v["num_remision"];
            $k->fecha_devolucion="";
            $k->num_devolucion="";
            $k->cod_libro=$v["cod_libro"];
            $k->titulo_libro=$v["titulo_libro"];
            $k->estado_libro="Diferido";
            $k->num_contrato=$v["num_contrato"];
            $k->reg_ventas="";
            $k->nombres_cliente=$v["nombres_cliente"];
            $k->vendedores_idVendedores=$_GET["id"];
            $k->idlibro=$v["idlibro"];
            $k->idalmacenes=$v["idalmacenes"];
            $k->tomo_libro=$v["tomo_libro"];
            $k->idcontrato=$v["idcontrato"];
            $k->cargo=1;
            $k->insertar();


        }
        $k->nuevo();
        unset($k);
    }
    echo "<script type='text/javascript'>
			alert('LOS CARGOS SE HAN CONCRETADO');
			</script>";


}

require_once("view/gestionCargos.php");



?>