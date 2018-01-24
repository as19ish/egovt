<?php
session_start();
require "config/main.class.php";
define('conString', 'mysql:host=sql12.freemysqlhosting.net;dbname=sql12217206');
define('dbUser', 'sql12217206');
define('dbPass', 'hnIfxlY1Er');
define('conString', 'mysql:host=localhost;dbname=egov');
define('dbUser', 'root');
define('dbPass', '');
$user = new User();
if(!$user->dbConnect(conString, dbUser, dbPass)){
  die($user->getMsg());

}
