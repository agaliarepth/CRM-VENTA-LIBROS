
 <style type="text/css">
/* 
	Web20 Table Style
	written by Netway Media, http://www.netway-media.com
*/

table {
  border-collapse: collapse;
  border: 1px solid #666666;
  font: normal 11px verdana, arial, helvetica, sans-serif;
  color: #363636;
  background: #FFF;
  text-align:left;
  }
caption {
  text-align: center;
  font: bold 16px arial, helvetica, sans-serif;
  background: transparent;
  padding:6px 4px 8px 0px;
  color: #CC00FF;
  text-transform: uppercase;
}
thead, tfoot {
background:url(bg1.png) repeat-x;
text-align:left;
height:30px;
}
thead th, tfoot th {
padding:5px;
}
table a {
color: #333333;
text-decoration:none;
}
table a:hover {
text-decoration:underline;
}
tr.odd {
background: #f1f1f1;
}
tbody th, tbody td {
padding:5px;
}
.negrita{
	font-weight:bold;
	
	}
	.titulo{ font-size:14px; font-weight:bold;}
 </style>
 <?php require_once("head.php");?>

 <script src="<?php echo config::ruta();?>js/jquery-1.9.1.min.js" type="text/javascript"></script>
 <link rel="stylesheet" media="screen" type="text/css" href="<?php echo config::ruta();?>css/screen.css" />

<link rel="stylesheet" media="screen" type="text/css" href="<?php echo config::ruta();?>css/default1.css" />

	<script type="text/javascript" src="<?php echo config::ruta();?>js/zebra_datepicker.js"></script>
    <script src="<?php echo config::ruta();?>js/functions.js" type="text/javascript"></script>

 <script>
              $(document).ready(function() {
				  
				   $('#fecha').Zebra_DatePicker({
		  view: 'days',
		  days_abbr:['Dom', 'Lu', 'Mar', 'Mi', 'Jue', 'Vie', 'Sab']
		   
		 });
			  });</script>
 <script type="text/javascript">
    $(document).ready(function($)
  {  function imprimir(id)

        {

            var div, imp;

            div = document.getElementById(id);//seleccionamos el objeto

            imp = window.open(" ","Formato de Impresion"); //damos un titulo

            imp.document.open();     //abrimos

            imp.document.write('style: ...'); //tambien podriamos agregarle un <link ...

            imp.document.write(div.innerHTML);//agregamos el objeto

            imp.document.close();

            imp.print();   //Abrimos la opcion de imprimir

            imp.close(); //cerramos la ventana nueva

        }
  });
  
    function validarEnviar(){
			
					confirmForm($("#wizard"),"Se guardara la nota de remision con<br> fecha <b class='resaltar'>"+$("#fecha").val()+"</b>. <br> Desea continuar?.");
				
				
			
			}
 </script>
 
 
 <?php if(isset($_SESSION["modulo_almacenes"])){?> 
 <body>
 <div id="paraImprimir" style="width:600px; margin:auto 10px;">
<form  name="form" method="post"  id="wizard" action="<?php echo config::ruta();?>?accion=addNotasRemision&acc=nuevo">
<table width="755" border="1" align="center">
  <tr>
    <td colspan="2"><img src="<?php config::ruta();?>images/shared/logo.png"/></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="3" align="center" class="titulo"><p>REGISTRAR  NUEVA REMISION</p>
      <p><?php echo $res["desc_almacen"]; ?></p></td>
  </tr>
  <tr>
    <td  class="negrita">NOMBRE :    </td>
    <td width="400"><input name="nombre_vendedor" type="text"  id="nombre_vendedor" value="<?php echo $res["nombre_vendedor"]; ?>" size="50" readonly/></td>
    <td class="negrita">CI:<input name="ci_vendedor" type="text" id="ci_vendedor" size="15" value="<?php echo $res["ci_vendedor"]; ?>"/></td>
  </tr>
  <tr>
    <td class="negrita">FECHA ENVIO:</td>
    <td><input name="fecha" type="text" id="fecha" value="<?php echo $res["fecha"]; ?>"  class="fechas" />
     
    </td>
    <td class="negrita">N Req:<input name="idnota_pedido" type="text" id="idnota_pedido" value="<?php echo $res["idnota_pedido"]; ?>" size="5" readonly/></td>
  </tr>
  
</table>
<table width="675" border="1">
<thead>
  <tr>
  
    <td align="center" width="41" class="negrita">N</td>
    <td align="center" width="56" class="negrita">CODIGO</td>
    <td align="center" width="67" class="negrita">CANTIDAD</td>
    <td align="center" width="308" class="negrita">TITULO</td>
    <td align="center" width="39" class="negrita">VOL</td>
    <td width="124" align="center" class="negrita">OBS</td>
    
  </tr>
  </thead>
  <tbody>
  <?php $cont =0; foreach($res2 as $v){ ?>
  <tr>
   <td><?php echo $cont++; ?></td>
    <td><input type="text" readonly size="8" name="<?php echo "codigo[]";?>" value="<?php echo $v["codigo"]; ?>"/></td>
    <td><input type="text" readonly size="3" name="<?php echo "cantidad[]";?>" value="<?php echo $v["cantidad"]; ?>"/></td>
    <td><input type="text" readonly size="50" name="<?php echo "titulo[]";?>" value="<?php echo $v["titulo"]; ?>"/></td>
    <td><input type="text" readonly size="3" name="<?php echo "volumen[]";?>" value="<?php echo $v["volumen"]; ?>"/>
      <td colspan="2"><input type="text" size="20" name="<?php echo "obs[]";?>" /></td>
      <input type="hidden"  name="<?php echo "idlibros[]".$cont;?>" value="<?php echo $v["libros_idlibros"]; ?>"/></td>
  </tr>
  <?php }?>
  </tbody>
  <tfoot>
  <tr>
    <td class="negrita">TOTAL</td>
    <td><input type="text" readonly size="3" name="total" value="<?php echo $res["total"]; ?>"/></td>
    <td> <input type="hidden" value="Enviar" name="Enviar"/><input type="hidden" value="<?php echo $cont; ?>" name="num_filas"/>
    <input type="hidden" value="<?php echo $res["vendedores_idVendedores"]; ?>" name="idVendedor"/>
   </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
    <tr>
    
    <td colspan="5"><label>OBSERVACIONES</label><textarea name="obser" cols="50" id="obser" type="text" ></textarea></td>
    </tr>
  </tfoot>
</table>
<input type="hidden" value="<?php echo  $res["idalmacenes"]; ?>" name="idalmacenes"/>
<input type="hidden" value="<?php echo  $res["desc_almacen"];?>" name="desc_almacen"/>
 <input type="button" name="bEnviar" value="Guardar" style=" background-color:#0C3; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;" onClick="validarEnviar();"/> 
    <input type="reset" name="bReset" value="Cancelar" style=" background-color:#F00; color:#000; margin-left:15px; font-size:16px; font-family:calibri; height:35px;" onclick="javascript:window.location='<?php config::ruta()?>?accion=notasRequerimiento';"/>
</form>


 </div>
  
      
</body>

<?php } else
header("Location:".config::ruta()."?accion=error&m=2");

?>