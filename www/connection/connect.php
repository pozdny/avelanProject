<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname = "localhost";

$database = "u4617988_avelan";

$username = "root";

$password = "";

$connect = mysql_pconnect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_select_db($database, $connect);
mysql_query("SET NAMES cp1251;", $connect) or die(mysql_error());
mysql_query("SET CHARACTER SET cp1251;", $connect) or die(mysql_error());
$link = mysqli_connect($hostname, $username, $password, $database); 
mysqli_set_charset($link, "cp1251");
