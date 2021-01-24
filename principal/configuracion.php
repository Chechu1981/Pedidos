<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv=Content-Type content="text/html; charset=UTF-8" />
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
        <link rel="stylesheet" type="text/css" href="../scripts/styles.css" />
        <?php include_once '../scripts/estilos.php'; ?>
        <title>Configuración</title>
        <link rel="shortcut icon" href="../imagenes/chechu.ico" />
    </head>
    <body>    
        <div class="contenedor">
            <?php 
            include_once '../scripts/cabecera.php';
            include '../calendario/calcular_dia.php'; 
            ?>
            <div class="principal">
                <?php include_once '../scripts/menu.php'; ?>
                <div class="banda">
                <h2 style="padding:15px;">Configuración.<br/></h2>
                </div>
                <div style="clear:both"></div>
                <table>
                    <tr>
                        <td>
                            <a href="../principal/configuracion_agentes.php">
                                <div class="icono"><img src="../imagenes/agentes.png" /><br/>
                                    Agentes
                                </div>
                            </a>
                        </td>
                        <td>
                            <a href="../principal/configuracion_oferta.php">
                                <div class="icono"><img width="150" src="../imagenes/logo_citroen.jpg" /><br/><br/>
                                    Campaña
                                </div>
                            </a>
                        </td>
                        <td>
                            <a href="../principal/configuracion_tarificador.php">
                                <div class="icono"><img width="150" src="../imagenes/styleNeumaticos.gif" /><br/><br/>
                                    Tarificador
                                </div>
                            </a>
                        </td>
                        <td>
                            <a href="../principal/configuracion_aviso.php">
                                <div class="icono"><img width="150" src="../imagenes/aviso.png" /><br/>
                                    Aviso
                                </div>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="../principal/fiestas.php">
                                <div class="icono"><img width="150" src="../imagenes/fiesta.png" /><br/>
                                    Fiestas
                                </div>
                            </a>
                        </td>
                        <td>
                            <a href="../principal/acceso.php">
                                <div class="icono"><img width="150" src="../imagenes/mercado-cliente1.png" /><br/>
                                    Acceso a clientes
                                </div>
                            </a>
                        </td>
                        <td>
                            <a href="../principal/personal.php">
                                <div class="icono"><img width="150" src="../imagenes/personal.jpg" /><br/><br/>
                                    Personal
                                </div>
                            </a>
                        </td>
                    </tr>
                </table>
                
            </div>
            <?php include_once '../scripts/pie.php'; ?>
        </div>
    </body>
</html>