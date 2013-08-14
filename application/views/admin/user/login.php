<div class="modal-header">
	<h3>Log In</h3>
	<p>Please log in </p>
</div>
<?php if($this->session->flashdata('error')): ?>
	<div class="alert alert-error">
		<?php echo $this->session->flashdata('error'); ?>
	</div>
<?php endif; ?>
<div class="modal-body">
	<?php if(validation_errors()): ?>
		<div class="alert alert-error">
			<?php echo validation_errors(); ?>
		</div>
	<?php endif; ?>
	<?php echo form_open(); ?>
	<table class="table">
		<tr>
			<td>Email:</td>
			<td><?php echo form_input('email'); ?></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><?php echo form_password('password'); ?></td>
		</tr>
		<tr>
			<td></td>
			<td><?php echo form_submit('submit', 'Log in', 'class="btn btn-primary"'); ?></td>
		</tr>
	</table>
	<?php echo form_close(); ?>
</div>