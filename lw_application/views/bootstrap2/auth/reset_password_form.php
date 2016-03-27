<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$new_password = array(
	'name'	=> 'new_password',
	'id'	=> 'new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
	'required'	=> '',
);
$confirm_new_password = array(
	'name'	=> 'confirm_new_password',
	'id'	=> 'confirm_new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size' 	=> 30,
	'required'	=> '',
);

$form_attributes = array('class' => 'form-horizontal');

$label_attributes = array(
    'class' => 'control-label'
);

?>
<?php echo form_open($this->uri->uri_string(), $form_attributes); ?>
<fieldset>
<legend><?php echo __('Change Password'); ?></legend>
<div class="control-group">
		<?php echo form_label(__('New Password'), $new_password['id'],$label_attributes); ?>
		<div class="controls">
			<?php echo form_password($new_password); ?>
		<span class="help-inline error_msg">
			<?php echo form_error($new_password['name']); ?><?php echo isset($errors[$new_password['name']])?$errors[$new_password['name']]:''; ?></span>
	  </div>
	 </div>
	<div class="control-group">
		<?php echo form_label(__('Confirm New Password'), $confirm_new_password['id'], $label_attributes); ?>
		<div class="controls">
			<?php echo form_password($confirm_new_password); ?>
		<span class="help-inline error_msg"><?php echo form_error($confirm_new_password['name']); ?><?php echo isset($errors[$confirm_new_password['name']])?$errors[$confirm_new_password['name']]:''; ?></span>
	  </div>
	 </div>
</fieldset>
<div class="form-actions">
	<?php echo form_submit('change',__('Change Password'),'class="btn btn-primary"'); ?>
</div>
<?php echo form_close(); ?>