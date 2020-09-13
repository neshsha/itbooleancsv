<?php

namespace App\Models;

class Product extends Tabela {

	use ModelTrait;

	protected static $table = 'products';
	protected static $className = Product::class;

	private $id;
	private $model_number;
	private $category_id;
	private $department_name;
	private $manufacturer_name;
	private $upc;
	private $sku;
	private $regular_price;
	private $sale_price;
	private $description;
	private $url;

	public function __get($name) {
		if(isset($this->{$name})) {
			return $this->{$name};
		}

		return null;

	}

	public function __set($name,$value) {

		if(property_exists(Product::class, $name)) {
			$this->{$name} = $value;
		}

	}

	public function snimi() {
		$db = \App\Libs\Factory::getInstance('\App\Libs\Database');

		$db->insert('\App\Models\Product',
		'INSERT INTO ' . self::$table .' (`id`, `model_number`, `category_id`, `department_name`, `manufacturer_name`, `upc`, `sku`, `regular_price`, `sale_price`, `description`, `url`) VALUES (NULL, :mnum, :cid, :dn, :mn, :up, :sk, :rp, :sp, :d, :u);',
			[

				':mnum' => $this->model_number,
				':cid' => $this->category_id,
				':dn' => $this->department_name,
				':mn' => $this->manufacturer_name,
				':up' => $this->upc,
				':sk' => $this->sku,
				':rp' => $this->regular_price,
				':sp' => $this->sale_price,
				':d' => $this->description,
				':u' => $this->url,

			]

		 );

		return $db->lastInsertId();

	}

	public static function updateProduct($id,$model_number,$category_id,$department_name,$manufacturer_name,$upc,$sku,$regular_price,$sale_price,$description,$url) {
		$db = \App\Libs\Factory::getInstance('\App\Libs\Database');

		$query = 'UPDATE products SET model_number = :mnum, category_id = :cid, department_name = :dn, manufacturer_name = :mn, upc = :up, sku = :sk, regular_price = :rp, sale_price = :sp, description = :d, url = :u WHERE id = :id';

			$params = [
				':id' => $id,
				':mnum' => $model_number,
				':cid' => $category_id,
				':dn' => $department_name,
				':mn' => $manufacturer_name,
				':up' => $upc,
				':sk' => $sku,
				':rp' => $regular_price,
				':sp' => $sale_price,
				':d' => $description,
				':u' => $url,

			];

			$db->update('Product', $query, $params);
	}

	public static function getByCategoryId($cid) {

			$db = \App\Libs\Factory::getInstance('\App\Libs\Database');


			$query = 'SELECT * FROM products WHERE category_id = :cid';

			$params = [
				':cid' => $cid

			];

			$products = $db->select('Product', $query, $params);


			return $products;
	}


}