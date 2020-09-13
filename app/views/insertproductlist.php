<div class="container">
	<form class="p-2" action="<?=$r->url('product/insertCSV')?>" method="post" enctype="multipart/form-data">
	<input class="form-control" type="file" name="csvfile" required="required"><br>
	<input class="form-control bg-primary text-white" type="submit" value="Upload">
	</form>
</div>