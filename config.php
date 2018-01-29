<?php
session_start();
require "config/main.class.php";
define('conString', 'mysql:host=sql12.freemysqlhosting.net;dbname=sql12217206');
define('dbUser', 'sql12217206');
define('dbPass', 'hnIfxlY1Er');
//define('conString', 'mysql:host=localhost;dbname=egov');
//define('dbUser', 'root');
//define('dbPass', '');
//define('conString', 'mysql:host=localhost;dbname=id4435209_egov');
//define('dbUser', 'id4435209_egovteam');
//define('dbPass', 'qazplm123');
$user = new User();
if(!$user->dbConnect(conString, dbUser, dbPass)){
  die('connection lost');

}
