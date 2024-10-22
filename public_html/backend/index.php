<?php
require_once('app/DB.php');
require_once('app/config/Web.php');
require_once('app/config/setURI.php');
require_once('app/Language.php');
require_once('app/Connect.php');
require_once('app/Function.php');
require_once('app/nocsrf.php');
require_once('app/Model.php');
require_once('app/Controller.php');
$Controller = new Controller($config, $db, $language, $setURI);
$Controller->_output();
