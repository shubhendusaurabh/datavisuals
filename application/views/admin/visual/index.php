
	<h2>Visuals</h2>
	<?php echo anchor('admin/visual/edit', '<i class="icon-plus"></i> Add a visual'); ?>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Title</th>
				<th>Pubdate</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php if(count($visuals)): foreach ($visuals as $visual): ?>
			<tr>
				<td><?php echo anchor('admin/visual/edit/'.$visual->id, $visual->title); ?></td>
				<td><?php echo $visual->pubdate; ?></td>
				<td><?php echo btn_edit('admin/visual/edit/'.$visual->id); ?></td>
				<td><?php echo btn_delete('admin/visual/delete/'.$visual->id) ?></td>
			</tr>
			<?php endforeach; ?>
		<?php else: ?>
			<tr>
				<td colspan="3">We Could not find any visuals!</td>
			</tr>
		<?php endif; ?>
		</tbody>
	</table>
