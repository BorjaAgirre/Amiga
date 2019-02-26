<?php
session_start();
include("../../clases/class.login.php");
$login=new login();
$login->inicia();

include_once $_SERVER['DOCUMENT_ROOT']."/bd/include/fechas.php";
include_once $_SERVER['DOCUMENT_ROOT']."/bd/headers.php";
include_once $_SERVER['DOCUMENT_ROOT']."/clases/class.leer_mysqli.php"; 



?>

<!-- http://www.tutorialrepublic.com/faq/show-hide-divs-based-on-checkbox-selection-in-jquery.php   -->



<script type="text/javascript" src="../../jq/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('input[class="optativo"]').click(function(){
            if($(this).attr("id")=="items_1"){
                $(".items_1").toggle();
            }
            if($(this).attr("id")=="items_2"){
                $(".items_2").toggle();
            }
            if($(this).attr("id")=="items_3"){
                $(".items_3").toggle();
            }
            if($(this).attr("id")=="items_4"){
                $(".items_4").toggle();
            }
            if($(this).attr("id")=="items_5"){
                $(".items_5").toggle();
            }
            if($(this).attr("id")=="items_6"){
                $(".items_6").toggle();
            }
            if($(this).attr("id")=="items_7"){
                $(".items_7").toggle();
            }
            if($(this).attr("id")=="items_8"){
                $(".items_8").toggle();
            }
            if($(this).attr("id")=="items_9"){
                $(".items_9").toggle();
            }
            if($(this).attr("id")=="items_10"){
                $(".items_10").toggle();
            }
            if($(this).attr("id")=="items_11"){
                $(".items_11").toggle();
            }
            if($(this).attr("id")=="items_12"){
                $(".items_12").toggle();
            }
            if($(this).attr("id")=="name_3_8"){
                $(".cuadro_4").toggle();
            }

            if($(this).attr("id")=="name_12_3"){
                $(".cuadro_13").toggle();
            }
        });
    });
</script>
</head>
<body>
                               		


<?php


//	echo "<pre>"; print_r($form_ficha); echo "</pre>"; 

	// Imprime el formulario
//	echo "<pre>"; print_r($_SERVER); echo "</pre>"; 
	include_once "../datos/datos_situacion_social.php"; 
//	$pagina = "form_situacion_social"; 
//	header_principal("form_situacion_social");
	echo "<form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>";
	foreach ($form_ficha as $cuadro) {
		$id_cuadro = $cuadro['id'];
		$display_n = (array_search("cuadro_".$id_cuadro, $extra))? " style='display:none;'" : ""; 
		echo "\n\n<br>\n<div class='cuadro_".$id_cuadro."'  ".$display_n."><h3>".$cuadro['titulo']."</h3>"; 
		foreach ($cuadro['items'] as $id_item => $item) {
			$busca = "name_".$id_cuadro."_".$id_item; 
			// primero separa si tiene tratamiento diferente a checkbox: texto, lista desplegable...
			if (isset($tratam[$busca])) {
				// texto 
				if($tratam[$busca][0] == 't') echo "<br> \n\t".$tratam[$busca][1].": <input type='text' name = ".$tratam[$busca][2]." >";
				// desplegable
				if($tratam[$busca][0] == 'd') {
					echo "\n\t".$tratam[$busca][1].": ";
					echo "\n\t<select name='".$tratam[$busca][2]."'>";
					foreach ($tratam[$busca][3] as $id_option => $val_option) {
						echo "\n\t\t<option value='".$id_option."'>".$val_option."</option>";
					} 
					echo "\n\t</select>";
				}
			// en caso contrario, es checkbox normal
 			} else {
				// primer item de cada cuadro; hacen desaparecer al resto del cuadro
				if ($id_item == 0) {
					echo "\n\t<input type='checkbox'  class='optativo' name='name_".$id_cuadro."' id = 'items_".$id_cuadro."' value='0'>".$item."<br>";
				} else {
				// resto de items
					// $special es para los checkboxes que hacen desaparecer a cuadros y que no están al princpio
					$special = (isset($extra[$busca]))? "class='optativo' id='".$busca."'" : "";
					echo "\n\t<div class='items_".$id_cuadro."'>\n\t<input type='checkbox' ".$special." name='name_".$id_cuadro."' value='".$id_item."'>".$item."</div>";
				}
			}
		}
		echo "\n</div>";  // div cuadro_
	}
	echo "\n</form>"; 
?>


</body>
</html> 
