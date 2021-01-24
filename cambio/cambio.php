<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" >
<html>
    <head>
        <meta http-equiv=Content-Type content="text/html; charset=UTF-8" />
        <title>Cambio</title>
        <?php include_once '../scripts/estilos.php'; ?>
        <link rel="stylesheet" href="../scripts/styles.css" type="text/css" />
        <?php include '../calendario/calcular_dia.php'; ?>
        <script>
            function objetoAjax(){
                var xmlhttp=false;
                try {
                    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                    try {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (E) {
                        xmlhttp = false;
                    }
                }
                if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
                    xmlhttp = new XMLHttpRequest();
                }
                return xmlhttp;
            }
            function closeIframe()
            {
                $("new").dialog('destroy');
                $("#nven").dialog('destroy');
                return false;
            }
        </script>
    </head>
    <body>
        <div class="contenedor">
            <header>
            <?php include_once '../scripts/cabecera.php'; ?>
                </header>
            <nav>
            <div class="principal">
                <?php include_once '../scripts/menu.php'; ?>
            </div>
                </nav>
            <div style="clear: both"></div>
            <div class="banda">
                <h2 style="padding:15px;">Cambio</h2>
            </div>
            <div id="cabecera" class="cambio" >

                <br/>
                <div style="clear:both;text-align:center;color:#03C;font-size:16px; height:10px;">
                </div>
                <div style="float:left">
                    <iframe style="border:none" width="420" height="600" src="change.php" ></iframe>
                </div>
                <div>
                    <iframe style="border:none" width="420" height="600" src="iva.php" ></iframe>
                </div>
            </div>
            <?php include_once '../scripts/pie.php'; ?>
        </div>

    </body>
</html>