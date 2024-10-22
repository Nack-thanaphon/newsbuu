<?php
require_once('backend/app/DB.php');
require_once('backend/app/config/Web.php');
require_once('backend/app/config/setURI.php');
require_once('backend/app/Language.php');
require_once('backend/app/Connect.php');
require_once('backend/app/Function.php');
require_once('backend/app/nocsrf.php');
require_once('backend/app/Model.php');
require_once('backend/app/Controller.php');
$Controller = new Controller($config,$db,$language,$setURI);
$Controller->output();

