<?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_almacenes"])){?>     
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>
<script src="<?php config::ruta()?>js/jquery/jquery.filestyle.js" type="text/javascript"></script>

<!--  start nav-outer-repeat................................................... END -->
 
 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
  

   <?php if(isset($_GET["m"])) {
	   
	   switch($_GET["m"]){
		   case '1':{?>  <div id="message-green">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="green-left">El Libro<?php echo $_POST["titulo"];?> se Ha Registrado Exitosamente..... <a href="<?php config::ruta()?>?accion=libros">Volver a la Lista de Libros.</a></td>
					<td class="green-right"><a class="close-green"><img src="images/table/icon_close_green.gif"   alt="" /></a></td>
				</tr>
				</table>
				</div><?php } break;
		   
		   
		   }
	   }?>
 
  <table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">

<tr>
	<td id="tbl-border-left"></td>
	<td>
	<!--  start content-table-inner -->
	<div id="content-table-inner">
	
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	<td>
	
	
		<h2>ITEM:<?php $rr=$li->getId($_GET["il"]); echo $rr["codigo"] ?> - <?php echo $rr["titulo"] ?></h2>



		<!-- start id-form -->
        <form method="post"   class="contacto"  action="" name="form" id="addLibros" enctype="multipart/form-data" >
        <fieldset>
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
       
        <tr>
			<div><th valign="top">STOCK FISICO:</th>
			<td><input type="text" class="inp-form" id="stock" name="stock" value="<?php echo $la->getStock($_GET["il"],$_GET["ia"]) ?>"/>
           
           <?php //echo $e[3] ?> </div></td>
			<td></td>
		</tr>
        <tr>
			<th valign="top">STOCK DISPONIBLE</th>
			<td><input type="text" class="inp-form" id="stock_disponible" name="stock_disponible" value="<?php echo $la->getStockDisponible($_GET["il"],$_GET["ia"]); ?>"/>
             
            </td>
			<td></td>
		</tr>
      <tr>
			<th valign="top">STOCK RESERVADO</th>
			<td><input type="text" class="inp-form" id="stock_reservado" name="stock_reservado" value="<?php echo $la->getStockReservado($_GET["il"],$_GET["ia"]);?>"/>
             
            </td>
			<td></td>
		</tr>    
       
	<tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="button" id="bEnviar" value="bEnviar" class="form-submit" name="bEnviar" onclick="document.form.submit();"/>
              <input type="hidden" name="il" value="<?php echo $_GET["il"]; ?>"/>
                 <input type="hidden" name="ia" value="<?php echo $_GET["ia"]; ?>"/>
            <input type="hidden" name="enviar" value="enviar"/>
			<input type="Limpiar" value="" class="form-reset"  onclick="cancelar('<?php config::ruta()?>?accion=almacenes&e=stock&id=<?php echo $_GET["ia"]; ?>');" />
		</td>
		<td></td>
	</tr>
	</table>
	</fieldset>
</form>

	</td>
	<td>

	<!--  start related-activities -->
	<div id="related-activities">
		
		<!--  start related-act-top -->
		
		<!-- end related-act-top -->
		
		<!--  start related-act-bottom -->
		<div id="related-act-bottom">
		
			<!--  start related-act-inner -->
			
			<!-- end related-act-inner -->
			<div class="clear"></div>
		
		</div>
		<!-- end related-act-bottom -->
	
	</div>
	<!-- end related-activities -->

</td>
</tr>
<tr>
<td><img src="images/shared/blank.gif" width="695" height="1" alt="blank" /></td>
<td></td>
</tr>
</table>
 
<div class="clear"></div>
 

</div>
<!--  end content-table-inner  -->
</td>
<td id="tbl-border-right"></td>
</tr>
<tr>
	<th class="sized bottomleft"></th>
	<td id="tbl-border-bottom">&nbsp;</td>
	<th class="sized bottomright"></th>
</tr>
</table>
  </div>
<div class="clear">&nbsp;</div>

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