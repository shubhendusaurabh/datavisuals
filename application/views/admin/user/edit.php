
<h3><?php echo empty($user->id) ? 'Add a new user' : 'Edit User ' . $user->name ?></h3>

<?php if(isset($errors[0])): ?>
	<div class="alert alert-error">
		<?php echo $errors[0]; ?>
	</div>
<?php endif; ?>
<?php echo validation_errors(); ?>
<?php echo form_open(); ?>
<table class="table">
	<tr>
		<td>Name:</td>
		<td><?php echo form_input('name', set_value('name', $user->name)); ?></td>
	</tr>
	<tr>
		<td>Email:</td>
		<td><?php echo form_input('email', set_value('email', $user->email)); ?></td>
	</tr>
	<tr>
		<td>Password:</td>
		<td><?php echo form_password('password'); ?></td>
	</tr>
	<tr>
		<td>Confirm Password:</td>
		<td><?php echo form_password('confirm_password'); ?></td>
	</tr>
	<tr>
		<td></td>
		<td><?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?></td>
	</tr>
</table>
<?php echo form_close(); ?>
