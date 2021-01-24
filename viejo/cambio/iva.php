<body style="background-color: antiquewhite;background-image: none;" class="marco"> 
<link rel="stylesheet" type="text/css" href="../estilos/style.css" >
 <div style="margin: auto;text-align: center;margin-top:10px;" class="pvp">
     Importe
 </div><br/>
            <?php
			$es_numero=false;;
			if(isset($_POST['precio'])){
				if($_POST['precio']!="" and $_POST['dto']!=""){
					$dto=str_replace(",",".",$_POST['dto']);
					$pvp=str_replace(",",".",$_POST['precio']);
                                        $portes=str_replace(",",".",$_POST['portes']);
					if(is_numeric($pvp) and is_numeric($dto) and is_numeric($portes)){
						$es_numero=true;
						$dto=number_format($dto,2);
						$pvp=number_format($pvp,2);
                                                $portes=number_format($portes,2);
						echo "<div style='margin-left:15px'>Precio: ".str_replace(".",",",$pvp)." € </br>Descuento: ".str_replace(".",",",$dto)." % </br>Portes: ".str_replace(".",",",$portes)." €</div>";
					}else{
						$es_numero=false;
						echo "<div style='margin-left:15px'>Debes introducir números en las casillas.</div>";
					}
				}
			}
			?>
                 <div style="clear: both"></div>
            <div style="float:left;font-size: 22px;padding: 10px;position:fixed;top:120px;margin-left: 80px">
                <form name="cambio" action="iva.php" method="post" style="color:#03C" >
                    <table class="formulario">
                    <tr><td>PVP</td><td><input type="text" name="precio" /></td></tr>
                    <tr><td>Dto</td><td><input type="text" name="dto" value="0" />%</td></tr>
                    <tr><td>Portes</td><td><input type="text" name="portes" value="0" /></td></tr>
                    </table>
                <input style="font-size:12px;text-align:center;" type="submit" name="total" value="Calcular"/>
            </form>
            </div>
            <div style="font-size: 25px;width: 200px;position:fixed;top:300px; text-align: right" class="resultado">
            <?php
			if(isset($_POST['precio'])){
				if($_POST['precio']!="" and $_POST['dto']!="" ){
					echo str_replace(".",",",number_format(((((100-$dto)/100) * (str_replace(",",".",$_POST['precio']))+str_replace(",",".",$_POST['portes'])))*1.21,2)." €");
				}else
					echo "0,00 €";
			}else{
				echo "0,00 €";
			}
                        if(isset($_POST['precio'])){
                            if($_POST['precio']!="" and $_POST['dto']!="" and $es_numero){
                                
                            }
                        }
			?>
            </div>
</body>