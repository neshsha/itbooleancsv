<?php

namespace App\Controllers;

class Category extends Controller {

	public function main($r) {
		
	}

	public function showall($r) {

		$r->categories = \App\Models\Category::vratiSve();
		$r->main =  __DIR__ . '/../views/allcategories.php';
		return parent::getTemplate('default');
		
	}

	public function deleteCategory($r) {
		
		$id = $r->treci;

		\App\Models\Category::obrisi($id);
		
		header('Location: ' . $r->url('category/showall'));

	}

	public function changeNameView($r) {

		$id = $r->treci;
		$r->category = \App\Models\Category::vratiZaId($id);
		$r->main =  __DIR__ . '/../views/changecatname.php';
		return parent::getTemplate('default');
		
	}

	public function updateName($r) {

		$id = $r->treci;
		$category_name = $r->category_name;

		\App\Models\Category::updateName($id,$category_name);
			header('Location: ' . $r->url('category/showall'));
		
	}

}