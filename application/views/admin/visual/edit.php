<h3><?php echo empty($visual->id) ? 'Add a new visual' : 'Edit visual ' . $visual->title ?></h3>


<?php echo validation_errors(); ?>
<?php echo form_open(); ?>
<table class="table">
	<tr>
		<td>Pubdate:</td>
		<td><?php echo form_input('pubdate', set_value('pubdate', $visual->pubdate), 'class="datepicker"'); ?></td>
	</tr>
	<tr>
		<td>Title:</td>
		<td><?php echo form_input('title', set_value('title', $visual->title)); ?></td>
	</tr>
	<tr>
		<td>Slug:</td>
		<td><?php echo form_input('slug', set_value('slug', $visual->slug)); ?></td>
	</tr>
	<tr>
		<td>Body:</td>
		<td><?php echo form_textarea('body', set_value('body', $visual->body), 'class="tinymce"'); ?></td>
	</tr>
	<tr>
		<td></td>
		<td><?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?></td>
	</tr>
</table>
<?php echo form_close(); ?>
<script src="<?= site_url('assests/js/jquery-2.0.0.min.js') ?>"></script>
<script src="<?= site_url('assests/js/bootstrap.js') ?>"></script>
<script src="<?= site_url('assests/js/bootstrap-datepicker.js') ?>"></script>
<script>
	$(function(){
		$('.datepicker').datepicker({ format: 'yyyy-mm-dd'});
	})
</script>