<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
define('DB_SERVER', '80.32.251.17');
define('DB_NAME', 'pedidos');
define('DB_USER', 'chechu');
define('DB_PASS', '');
$con = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
mysql_select_db(DB_NAME, $con);

mysql_query("DELETE FROM semanal WHERE id = " . $_GET['ide'] . ";");
