<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
	'required'	=> '',
);
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'type'	=> 'email',
	'required'	=> '',
);

$form_attributes = array('class' => 'form-horizontal');

$label_attributes = array(
    'class' => 'control-label'
);

?>
<?php echo form_open($this->uri->uri_string(),$form_attributes); ?>
<fieldset>
<legend><?php echo __('Change Email'); ?></legend>
<div class="control-group">
		<?php echo form_label(__('Password'), $password['id'],$label_attributes); ?>
		<div class="controls">
			<?php echo form_password($password); ?>
		<span class="help-inline error_msg">
			<?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?></span>
	  </div>
	 </div>
	<div class="control-group">
		<?php echo form_label(__('New email address'), $email['id'],$label_attributes); ?>
		<div class="controls">
		<?php echo form_input($email); ?>
		<span class="help-inline error_msg">
			<?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?> </span>
	</div>
	</div>
</fieldset>
<div class="form-actions">
	<?php echo form_submit('change', __('Send confirmation email'),'class="btn btn-primary"'); ?>
</div>
<?php echo form_close(); ?>