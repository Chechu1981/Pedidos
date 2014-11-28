<?php
mysql_connect("localhost", "chechu");
mysql_select_db("carrion");
mysql_query("DELETE FROM fiestas WHERE id = ".$_GET['id']."");