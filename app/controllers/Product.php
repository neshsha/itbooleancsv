<?php

namespace App\Controllers;

class Product extends Controller {

	public function main($r) {
	
	}

	public function insertView($r) {
		
		$r->main =  __DIR__ . '/../views/insertproductlist.php';
		return parent::getTemplate('default');
	}

	public function insertCSV($r) {

		$file = $_FILES['csvfile']['tmp_name'];
		$handle=fopen($file, "r");

		while(($cont=fgetcsv($handle,1000,","))!==false) {

			$catcheck = \App\Models\Category::check_category($cont[1]);
			
			
			if($catcheck !== null) {
				$catid = $catcheck['id'];
			} else {
				$category = new \App\Models\Category();
				$category->category_name = $cont[1];
				$catid = $category->snimi();
			}

		$product = new \App\Models\Product();
		
		$product->model_number = $cont[0];
		$product->category_id = $catid;
		$product->department_name = $cont[2];
		$product->manufacturer_name = $cont[3];
		$product->upc = $cont[4];
		$product->sku = $cont[5];
		$product->regular_price = $cont[6];
		$product->sale_price = $cont[7];
		$product->description = $cont[8];
		$product->url = $cont[9];

		$id = $product->snimi();

		}

		if($id !== null) {

			header('Location: '.$r->url('product/showall'));

			die();

		}
	}

	public function showall($r) {

		$r->products = \App\Models\Product::vratiSve();
		$r->main =  __DIR__ . '/../views/allproducts.php';
		return parent::getTemplate('default');
		
	}

	public function deleteProduct($r) {
		
		$id = $r->treci;

		\App\Models\Product::obrisi($id);
		
		header('Location: ' . $r->url('product/showall'));

	}

	public function changeProductView($r) {

		$id = $r->treci;
		$r->product = \App\Models\Product::vratiZaId($id);
		$r->main =  __DIR__ . '/../views/changeproductview.php';
		return parent::getTemplate('default');
		
	}

	public function updateProduct($r) {

		$id = $r->treci;
		$model_number = $r->model_number;
		$category_id = $r->category_id;
		$department_name = $r->department_name;
		$manufacturer_name = $r->manufacturer_name;
		$upc = $r->upc;
		$sku = $r->sku;
		$regular_price = $r->regular_price;
		$sale_price = $r->sale_price;
		$description = $r->description;
		$url = $r->url;
		

		\App\Models\Product::updateProduct($id,$model_number,$category_id,$department_name,$manufacturer_name,$upc,$sku,$regular_price,$sale_price,$description,$url);
			header('Location: ' . $r->url('product/showall'));
		
	}

	public function showByCategory($r) {
		$cid = $r->treci;
		$r->products = \App\Models\Product::getByCategoryId($cid);
		$r->main =  __DIR__ . '/../views/productbycat.php';
		return parent::getTemplate('default');
		
	}

}