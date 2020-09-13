<div class="container">

	<table class="table table-bordered table-hover" >
		<thead class="thead-dark">
			<tr class="text-center">
				<th>Category ID</th>
				<th>Category NAME</th>
				<th>Action</th>
			</tr>
		</thead>

	<tbody>

		<?php foreach($r->categories as $category): ?>
			<tr>
				<td><?=$category->id?></td>
				<td><a href="<?=$r->url('product/showByCategory/' . $category->id)?>"><?=$category->category_name?></a></td>
				<td class="text-center">
					<a class="btn btn-danger" href="<?=$r->url('category/deleteCategory/' . $category->id)?>">Delete</a>
					<a class="btn btn-warning" href="<?=$r->url('category/changeNameView/' . $category->id)?>">Update name</a>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>

	</table>

</div>	