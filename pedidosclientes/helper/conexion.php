<?php
define('DB_SERVER', '80.32.251.17');
define('DB_NAME', 'pedidos');
define('DB_USER', 'chechu');
define('DB_PASS', '');
$con = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
mysql_select_db(DB_NAME, $con);