<html>
    <head>
        <meta http-equiv=Content-Type content="text/html; charset=UTF-8" />
    </head>
    <body style="background-color: #ADD8E6;background-image: none" class="marco">  
        <link rel="stylesheet" type="text/css" href="../estilos/style.css" >
        <div style="margin: auto;text-align: center;margin-top: 10px;" class="pvp">
            Cambio
        </div><br/>
        <?php
        $es_numero = false;
        ;
        if (isset($_POST['entrega'])) {
            if ($_POST['entrega'] != "" and $_POST['pvp'] != "") {
                $entrega = str_replace(",", ".", $_POST['entrega']);
                $pvp = str_replace(",", ".", $_POST['pvp']);
                if (is_numeric($pvp) and is_numeric($entrega)) {
                    $es_numero = true;
                    $entrega = number_format($entrega, 2);
                    $pvp = number_format($pvp, 2);
                    echo "<div style='margin-left:15px'>Precio: " . str_replace(".", ",", $pvp) . " € </br>Entrega: " . str_replace(".", ",", $entrega) . " €</div>";
                } else {
                    $es_numero = false;
                    echo "<div style='margin-left:15px'>Debes introducir números en las casillas.</div>";
                }
            }
        }
        ?>
        <div style="clear: both"></div>
        <div style="float:left;position:fixed;top:120px;margin-left: 80px">
            <form name="cambio" action="change.php" method="post" style="color:#03C" >
                <table class="formulario">
                    <tr><td>Importe</td><td><input type="text" name="pvp" /><td><tr>
                    <tr><td>Entrega</td><td><input type="text" name="entrega" /><td><tr>
                </table>
                <input style="font-size:12px;text-align:center;" type="submit" name="calc" value="Calcular"/>
            </form>         
        </div>
        <div style="font-size: 25px;width: 200px;position:fixed;top:300px;text-align: right
             " class="resultado">
            <?php
            if (isset($_POST['entrega'])) {
                if ($_POST['entrega'] != "" and $_POST['pvp'] != "" and $es_numero) {
                    echo str_replace(".", ",", number_format($entrega - $pvp, 2) . " €");
                }else
                    echo "0,00 €";
            }else {
                echo "0,00 €";
            }
            ?>
        </div>
    </body>
</html>