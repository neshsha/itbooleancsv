<?php
require_once __DIR__ . '/../../config.php';

spl_autoload_register(function($class) {
	$path_arr = explode('\\', $class);
	$path_arr_length = count($path_arr);
	$path = __DIR__ . DS . '..' . DS . '..' . DS;
	for($i = 0; $i < $path_arr_length-1; $i++)
		$path .= strtolower($path_arr[$i]) . '/';
	$path .= $path_arr[$path_arr_length-1] . '.php';
	if(file_exists($path))
		require $path;
});
use App\Libs\Factory;
global $session, $resource, $r;
$session = Factory::getInstance('App\Libs\Session');
$resource = Factory::getInstance('App\Libs\Resource');
$r = &$resource;
Factory::getInstance('App\Libs\Router');