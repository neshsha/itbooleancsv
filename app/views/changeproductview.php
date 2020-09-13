<div class="container">
  <h1 class="bg-primary text-center text-white">Update product</h1>
	<form class="p-2" method="post" action="<?=$r->url('product/updateProduct/' . $r->product->id)?>">
		<input class="form-control" type="text" name="model_number" value="<?=$r->product->model_number?>"><br>
		<input class="form-control" type="number" name="category_id" value="<?=$r->product->category_id?>"><br>
		<input class="form-control" type="text" name="department_name" value="<?=$r->product->department_name?>"><br>
		<input class="form-control" type="text" name="manufacturer_name" value="<?=$r->product->manufacturer_name?>"><br>
		<input class="form-control" type="text" name="upc" value="<?=$r->product->upc?>"><br>
		<input class="form-control" type="text" name="sku" value="<?=$r->product->sku?>"><br>
		<input class="form-control" type="number" name="regular_price" value="<?=$r->product->regular_price?>"><br>
		<input class="form-control" type="number" name="sale_price" value="<?=$r->product->sale_price?>"><br>
		<input class="form-control" type="text" name="description" value="<?=$r->product->description?>"><br>
		<input class="form-control" type="text" name="url" value="<?=$r->product->url?>"><br>
	  <input class="form-control btn btn-success mt-2" type="submit" value="Update">
</form>
</div>