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
			
			if(confirm("SE HARA UN RESPALDO DE LA BASE DE DATOS . DESEA CONTINUAR?")){
				$("#formulario").submit();
				
				}
			}
	}

</script>
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
 
      <h1>BASE DE DATOS > RESPALDO </h1>
       
  <hr />
  </div>


<div id="table-content">

		<form   id="formulario" name="form" action="" method="post" style="margin:auto; width:50%"   >
        <table  cellpadding="0" cellpadding="0">
        <tr>
        <td colspan="2">
        <label>NOMBRE DEL ARCHIVO : </label>
        <input type="text"  name="archivo"  class="inp4-form"id="archivo"/>
        </td>
        </tr>
        <tr>
        <td align="center"><input type="button"   onclick="verificar();" value="RESPALDAR" name="respaldar" id="respaldar"/>
       <input type="button"  value="CANCELAR" name="respaldar" id="respaldar"/>
       <input type="hidden" name="enviar" value="enviar" />
       </td>
        </tr>
        
        </table>
        
        </form>
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