<?php
namespace App\Models;

class Tabela {
	protected static $table;
	protected static $className;

	public static function vratiZaId($id) {

		$db = \App\Libs\Factory::getInstance('\App\Libs\Database');
		
		$niz = $db->select(static::$className, 
			'SELECT * FROM ' . static::$table .' WHERE `id` = :id',
			[

				':id' => $id
			]);

		foreach($niz as $element) {
			return $element;
		}
		return null;
	}

	public static function vratiSve() {
		$db = \App\Libs\Factory::getInstance('\App\Libs\Database');

		$niz = $db->select(static::$className, 
			'SELECT * FROM ' . static::$table);

		return $niz;
	}

	public static function obrisi($id) {
		$db = \App\Libs\Factory::getInstance('\App\Libs\Database');

		$db->delete(
			'DELETE FROM ' . static::$table . ' WHERE `id` = :id',
			[
				':id' => $id
			]);
	}
}