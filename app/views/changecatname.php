<div class="container">
  <h1 class="bg-primary text-center text-white">Update category name</h1>
	<form class="p-2" method="post" action="<?=$r->url('category/updateName/' . $r->category->id)?>">
		<input class="form-control" type="text" name="category_name" value="<?=$r->category->category_name?>"><br>
	  <input class="form-control btn btn-success mt-2" type="submit" value="Update">
</form>
</div>