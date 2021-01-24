<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv=Content-Type content="text/html; charset=UTF-8" />
        <title>Mailing</title>
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <link rel="stylesheet" href="../scripts/styles.css" type="text/css" />
        <?php include_once '../scripts/estilos.php'; ?>
        <script src="script.js"></script>
    </head>
    <body>
        <div class="contenedor">
            <?php include '../calendario/calcular_dia.php'; ?>
            <header>
                <?php include_once '../scripts/cabecera.php'; ?>
            </header>
            <nav>
                <?php include_once '../scripts/menu.php'; ?>
            </nav>
            <div class="principal">
                <div class="banda">
                    <h2 style="padding:15px;" id="titulo">Mailing. Individual</h2>
                </div>
                <h2>Desde aquí podrás enviar un mailing a un cliente determinado:</h2>
                <div style="padding:15px"></div>
                <form style="background-color: #e1e1e1;padding: 20px;" action="correouno.php" method="post">
                    <label><b>Escribe o pega la dirección de correo:</b></label>
                    <input type="email" id="archivo" name="correo" style="width: 500px" ></input>
                    <br/><br/>
                    <label><b>Escribe o pega el nombre del cliente:</b></label>
                    <input type="text" id="archivo" name="nombre" style="width: 500px" ></input>
                    <br/>
                    <input type="submit" title="Enviar" value="Enviar correo" style="margin: 80px;width: 150px;height: 80px"></input>
                </form>
                <?php include_once '../scripts/pie.php'; ?>
            </div>
        </div>
    </body>
</html>