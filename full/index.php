<?php
 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	# cargo autoload y config
	require "Config/Autoload.php";
	require "Config/Config.php";

	# hago uso de autoload, router y request
	use Config\Autoload as Autoload;
	use Config\Router 	as Router;
	use Config\Request 	as Request;
		
	Autoload::start();

	session_start();

	# header y footer eliminados
	# echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
	Router::Route(new Request());

?>