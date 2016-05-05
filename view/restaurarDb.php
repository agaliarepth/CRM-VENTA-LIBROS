 <?php require_once("head.php");?>
 <?php if(isset($_SESSION["modulo_administracion"])){?> 

<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>


<!--  start nav-outer-repeat................................................... END -->
 
 
<script>
function verificar(){
	if($("#archivo").val()==""){
		
		alert("ERROR: INGRESE UN NOMBRE AL ARCHIVO");
		}
		else{
			
			if(confirm("SE HARA UN RESPALDO DE LA BASE DE DATOS . DEA CONTINUAR?")){
				$("#formulario").submit();
				
				}
			}
	}

</script>
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
 
      <h1>BASE DE DATOS > RESTAURAR </h1>
       
  <hr />
  </div>


<div id="table-content">
<?php

 function listar_archivos($carpeta){
	 
    if(is_dir($carpeta)){
        if($dir = opendir($carpeta)){
            while(($archivo = readdir($dir)) !== false){
                if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess'){
					
					
                    echo "<tr>";
					echo "<td><a target='_blank' href='".$carpeta."/".$archivo."'>".$archivo."</a></td>";
					echo "<td>".filesize($carpeta."/".$archivo)."bytes</td>";
					?><td>
                    
                    <a href="<?php config::ruta() ?>?accion=restaurarDb&e=d&id=<?php echo $carpeta."/".$archivo ?>"><img src="<?php echo config::ruta() ?>images/iconos/delete.png" width="25" height="25"/></a>
                    
                      <a href="<?php config::ruta() ?>?accion=restaurarDb&e=r&id=<?php echo  $carpeta."/".$archivo ?>">RESTAURAR</a>
                    
                    </td><?php 
					echo"</tr>";
                }
            }
            closedir($dir);
        }
    }
}


?>
		<TABLE border="1">
        <thead>
        <TR>
        <TH>NOMBRE DEL ARCHIVO</TH>
        <TH>TAMAÑO</TH>
        <TH>OPCIONES</TH>
        </TR>
        
        </thead>
        <tbody>
       
		<?php listar_archivos("backup"); ?>
		
        </tbody>
        </TABLE>
			</div>

</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer -->

 

<div class="clear">&nbsp;</div>
    
<!-- start footer -->         
<?php require_once("footer.php");?>
<!-- end footer -->
 
</body>
</html>
<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>