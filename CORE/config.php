<?php
	define('HOST',$_SERVER["SERVER_NAME"]);
	define('DOM','/'.explode("/", $_SERVER["SCRIPT_NAME"])[1]);
	define('CORE','/CORE/');
	define('APP','APP/');
	define('RES','RES/');
	define('SYS','SYS/');

	define('APP_NAME','Materials Inventory System');
	
	define('ROOT', 'http://'.HOST.DOM.'/');

	define('CSS',ROOT.APP.RES.'CSS/');
	define('IMG',ROOT.APP.RES.'IMG/');
	define('FNT',ROOT.APP.RES.'FNT/');
	define('JS',ROOT.APP.RES.'JS/');
	define('MD',APP.SYS.'MDL/');
	define('VW',APP.SYS.'VW/');
	define('CNT',APP.SYS.'CNT/');

	define('DEFA_PAGE','login');

	define('DOCTYPE','<!DOCTYPE html>');
	define('TITLE','Materials Inventory System');
	define('CHARSET','utf-8');
	define('LANG','en');
	define('FAVICON','favicon.ico');
	$GLOBALS['META'] = array(
		'application-name' => 'Materials Inventory System', 
		'author' => 'Ralph John Galindo', 
		'description' => 'Web-based Inventory System', 
		'generator' => 'Ralph John Galindo', 
		'viewport' => 'width=device-width, initial-scale=1.0', 
		'keywords' => '' 
		);
	$GLOBALS['STYLESHEET'] = array(
		'bootstrap.min.css',
		'font-awesome.css',
		'flattify.css',
		'jquery-ui.css',
		'gen.css'
		);
	$GLOBALS['SCRIPT'] = array(
		'jquery.js',
		'jquery-ui.js',
		'bootstrap.min.js',
		'bootbox.js',
		'Chart.js',
		'gen.js'
		);
?>