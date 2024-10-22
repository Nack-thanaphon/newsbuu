<?php
@ob_start();
@session_start();

date_default_timezone_set('Asia/Bangkok');
/** MySQL hostname */
define('DB_HOST', 'localhost');
/** MySQL database username */
define('DB_USER', 'aree');
/** MySQL database password */
define('DB_PASSWORD', 'Ak@072039');
/** MySQL database name */
define('DB_NAME', 'news');

define('WEB_LANG', 'th');
/*
define('WEB_MODE', 'local');
define('FRONT_URL', '/news/');
define('BACK_URL', '/news/backend/');
define('FRONT_DIR', $_SERVER['DOCUMENT_ROOT'].'/news/');
define('BACK_DIR', $_SERVER['DOCUMENT_ROOT'].'/news/backend/');
*/
define('WEB_PHONE', '๐-๓๙๓๑-๐๐๐๐');
define('WEB_EMAIL', 'arees@go.buu.ac.th');


define('WEB_MODE', 'server');
define('FRONT_URL', 'http://10.201.1.10/~newsbuu/');
define('BACK_URL', 'http://10.201.1.10/~newsbuu/backend/');
define('FRONT_DIR', '/home/staff/newsbuu/public_html/');
define('BACK_DIR', '/home/staff/newsbuu/public_html/backend/');


$config = array(
	  "BASE_LANG"=> WEB_LANG,
	  "CONFIG_MODE"=> WEB_MODE,
		"BASE_WEB_PHONE"=> WEB_PHONE,
		"BASE_WEB_EMAIL"=> WEB_EMAIL,
		"BASE_FRONT_URL"=> FRONT_URL,
		"BASE_FRONT_DIR"=> FRONT_DIR,
		"BASE_FRONT_LAYOUT"=> 'resources/view/layout/',
		"BASE_FRONT_VIEW"=> 'resources/view/',
		"BASE_FRONT_ASSETS"=> FRONT_URL.'assets/',
		"BASE_BACK_URL"=> BACK_URL,
		"BASE_BACK_DIR"=> BACK_DIR,
    "BASE_BACK_ASSETS"=> BACK_URL.'public/template/default/assets/',
		"BASE_BACK_LAYOUT"=> 'resources/view/layout/',
		"BASE_BACK_VIEW"=> 'resources/view/',
    "PLUGINS"=> BACK_URL.'public/plugins/',
		"BASE_MEDIA"=> 'media/',
		"BASE_RESERVE_MEDIA"=> 'reserve/media/',
    "MEDIA"=> FRONT_URL.'media/',
		"RESERVE_MEDIA"=> FRONT_URL.'reserve/media/',
		"BASE_FILES"=> 'files/',
		"BASE_RESERVE_FILES"=> 'reserve/files/',
    "FILES"=> FRONT_URL.'files/',
		"RESERVE_FILES"=> FRONT_URL.'reserve/files/',
);
?>
