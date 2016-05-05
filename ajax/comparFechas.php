<?php
 if(isset($_GET["f1"])&& isset($_GET["f2"])){

     $f1=date_parse($_GET["f1"]);
     $mes1=$f1["month"];
     $anio1=$f1["year"];
     $f2=date_parse($_GET["f2"]);
     $mes2=$f2["month"];
     $anio2=$f2["year"];
     $sw;
     if($anio1!=$anio2){
         $sw=1;

     }
     else{
         if($mes1!=$mes2){
             $sw=1;
         }
         else
            $sw=0;

     }

     echo json_encode(["sw"=>$sw]);






 }

?>