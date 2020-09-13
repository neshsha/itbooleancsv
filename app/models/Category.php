<?php

namespace App\Models;

class Category extends Tabela {

	use ModelTrait;

	protected static $table = 'categories';
	protected static $className = Category::class;

	private $id;
	private $category_name;

	public function __get($name) {
		if(isset($this->{$name})) {
			return $this->{$name};
		}

		return null;

	}

	public function __set($name,$value) {

		if(property_exists(Category::class, $name)) {
			$this->{$name} = $value;
		}

	}

	public function snimi() {
		$db = \App\Libs\Factory::getInstance('\App\Libs\Database');

		$db->insert('\App\Models\Category',
		'INSERT INTO ' . self::$table .' (`id`, `category_name`) VALUES (NULL, :cn);',
			[

				':cn' => $this->category_name,
				

			]

		 );

		return $db->lastInsertId();

	}


	public static function check_category($category_name) {

			$db = \App\Libs\Factory::getInstance('\App\Libs\Database');


			$query = 'SELECT * FROM categories WHERE category_name = :cn';

			$params = [
				':cn' => $category_name

			];

			$categories = $db->select('Category', $query, $params);

			foreach($categories as $category) {
				return $category;
			}

			return null;
	}

	public static function updateName($id,$category_name) {
		$db = \App\Libs\Factory::getInstance('\App\Libs\Database');

		$query = 'UPDATE categories SET category_name = :cn WHERE id = :id';

			$params = [
				':id' => $id,
				':cn' => $category_name,


			];

			$db->update('Category', $query, $params);
	}


}