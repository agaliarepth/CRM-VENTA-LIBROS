 <?php require_once("head.php");?>
<?php if(isset($_SESSION["modulo_administracion"])){?> 
<script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>

<!--  start nav-outer-repeat................................................... END -->
 <script type="text/javascript">
 
    function validarCierre(){
					 var anio=$("#anio").val();
					 var mes=$("#mes").val();
					 var modulo=$("#modulo").val();
					 var sw;
					
					  $.ajax({
					  
                              type: "GET",
                              url: "ajax/validarCierre.php?anio="+anio+"&mes="+mes,
                              data: "modulo="+modulo,
                              dataType: "html",
							  async:false,
							
                              error: function(){
                                    alert("error petición ajax");
                              },
                              success: function(data){
								
									if(data==1)
								     sw=false;
									else
									sw=true;
									  
									                                                
                                  
                                  
                              }
                  });	
				 
				   return sw;
					 
					 } 
 function ValidarForm(){
	                            
	 if(!validarCierre()){
								
								alert("ERROR:: ESTE MES YA SE ENCUENTRA REGISTRADO.")
								return false;
								
								}
	 if(confirm("ESTA SEGURO DE CERRAR ESTE MES?"))
	 
	 return true;
	 else
	 return false;
	 
	 }
</script>
 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading">
   
 
  <h1>PASAR CARGOS DE VENDEDORES</h1>
  <hr />
  </div>


<div id="table-content">
		<form  class="contacto" action="" method="post" style="border:1px solid" onsubmit="return ValidarForm();">
		<table id="addCierre">
        
        <tr>
        <th><label for="mes">MES</label>
<select name="mes" id="mes" class="inp-form">
<option value="1" <?php if(date("m")==1) {?> selected="selected"<?php }?>>ENERO</option>
<option value="2"  <?php if(date("m")==2) {?> selected="selected"<?php }?>>FEBRERO</option>
<option value="3" <?php if(date("m")==3) {?> selected="selected"<?php }?>>MARZO</option>
<option value="4" <?php if(date("m")==4) {?> selected="selected"<?php }?>>ABRIL</option>
<option value="5" <?php if(date("m")==5) {?> selected="selected"<?php }?>>MAYO</option>
<option value="6" <?php if(date("m")==6) {?> selected="selected"<?php }?>>JUNIO</option>
<option value="7" <?php if(date("m")==7) {?> selected="selected"<?php }?>>JULIO</option>
<option value="8" <?php if(date("m")==8) {?> selected="selected"<?php }?>>AGOSTO</option>
<option value="9" <?php if(date("m")==9) {?> selected="selected"<?php }?>>SEPTIEMBRE</option>
<option value="10" <?php if(date("m")==10) {?> selected="selected"<?php }?>>OCTUBRE</option>
<option value="11" <?php if(date("m")==11) {?> selected="selected"<?php }?>>NOVIEMBRE</option>
<option value="12" <?php if(date("m")==12) {?> selected="selected"<?php }?>>DICIEMBRE</option>



</select></th>
<th><label for="anio">AÑO </label><select name="anio" id="anio" class="inp2-form">
<option value="2013"   <?php if(date("Y")==2013) {?> selected="selected"<?php }?>>2013</option>
<option value="2014"   <?php if(date("Y")==2014) {?> selected="selected"<?php }?>>2014</option>
<option value="2015"   <?php if(date("Y")==2015) {?> selected="selected"<?php }?>>2015</option>
<option value="2016"   <?php if(date("Y")==2016) {?> selected="selected"<?php }?>>2016</option>
<option value="2017"   <?php if(date("Y")==2017) {?> selected="selected"<?php }?>>2017</option>
<option value="2018"   <?php if(date("Y")==2018) {?> selected="selected"<?php }?>>2018</option>
<option value="2019">2019</option>
<option value="2020">2020</option>
<option value="2021">2021</option>
<option value="2022">2022</option>
<option value="2023">2023</option>
<option value="2024">2024</option>



</select>

</th>

<th><label>&nbsp;</label>
<input type="submit" class="botonRojo"  value="CERRAR MES" name="bEnviar"   />
<input type="hidden" name="guardar" id="guardar" value="guardar" /> 
</th>
        
        </tr>
        </table>
        </form>
				<table border="0" width="30%" cellpadding="0" cellspacing="0" id="categorias-table" style="margin:auto;" >
                <thead>
				<tr>
					
					<th class="">Vendedor </th>
                  
                    
                     <th class="">OPCION</th>
                      
                    
				</tr>
				</thead>
                <tbody>
                <?php 
				foreach($res as $v){?>
                <tr>
                <td><?php echo $v["idcierres"]?></td>
                
                <td><?php echo $v["anio"]?></td>
               
                </tr>
					<?php 
					
					}
				
				?>
                </tbody>
               
                
				</table>
				<!--  end product-table................................... --> 
				
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