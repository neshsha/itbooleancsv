
	<table class="table table-bordered table-hover" >
		<thead class="thead-dark">
			<tr class="text-center">
				<th>Model number</th>
				<th>Category ID</th>
				<th>Department name</th>
				<th>Manufacturer name</th>
				<th>UPC</th>
				<th>SKU</th>
				<th>Regular price</th>
				<th>Sale price</th>
				<th>Description</th>
				<th>URL</th>
				<th>Action</th>

			</tr>
		</thead>

	<tbody>

		<?php foreach($r->products as $product): ?>
			<tr>
				<td><?=$product->model_number?></td>
				<td><?=$product->category_id?></td>
				<td><?=$product->department_name?></td>
				<td><?=$product->manufacturer_name?></td>
				<td><?=$product->upc?></td>
				<td><?=$product->sku?></td>
				<td><?=$product->regular_price?></td>
				<td><?=$product->sale_price?></td>
				<td><?=$product->description?></td>
				<td><a href="<?=$product->url?>">Show product</a></td>
				<td class="text-center">
					<a class="btn btn-danger" href="<?=$r->url('product/deleteProduct/' . $product->id)?>">Delete</a><br><br>
					<a class="btn btn-warning" href="<?=$r->url('product/changeProductView/' . $product->id)?>">Update product</a>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>

	</table>
