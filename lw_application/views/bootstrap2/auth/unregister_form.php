<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
	'required'	=> '',
);

$form_attributes = array('class' => 'form-horizontal');

$label_attributes = array(
    'class' => 'control-label'
);

?>
<?php echo form_open($this->uri->uri_string()); ?>
<fieldset>
<legend><?php echo __('Delete Account'); ?></legend>
<div class="control-group">
	<?php echo form_label(__('Password'), $password['id']); ?>
	<div class="controls"><?php echo form_password($password); ?>
	<span class="help-inline error_msg">
		<?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?></span>
	  </div>
	 </div>
</fieldset>
<div class="form-actions">
	<?php echo form_submit('cancel', __('Delete account'),'class="btn btn-danger"'); ?>
</div>
<?php echo form_close(); ?>