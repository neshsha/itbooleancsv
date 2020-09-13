<?php
namespace App\Controllers;

use App\Libs\Factory;

class Root extends Controller {
	/**
	 * @param \App\Libs\Resource $r
	 * @return bool
	 */
	public function main($r) {
	
		$r->title = 'IT BOOLEAN ZADATAK';
		$r->main = __DIR__.'/../views/main/index.php';
		return parent::getTemplate('default');
	}

	public function error($r)  {
		header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	}

}