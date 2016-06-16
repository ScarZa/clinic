<?php
$hostname="10.0.0.253";
$user="admintoy";
$password="gotoytoynoy";
$dbname="hos";
$con = mysql_connect("$hostname", "$user", "$password") or die("can not connect database");
$db = mysql_select_db($dbname, $con) or die("can not select database");
mysql_query("SET NAMES 'utf8'", $con);
mysql_query("SET character_set_results=utf8");
mysql_query("SET character_set_client='utf8'");
mysql_query("SET character_set_connection='utf8'");
mysql_query("collation_connection = utf8_unicode_ci");
mysql_query("collation_database = utf8_unicode_ci");
mysql_query("collation_server = utf8_unicode_ci");
?>
