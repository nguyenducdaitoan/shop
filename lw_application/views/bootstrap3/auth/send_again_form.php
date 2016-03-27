<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
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
<?php echo form_open($this->uri->uri_string(), $form_attributes); ?>
<fieldset>
<legend><?php echo __('Send Activation Again'); ?></legend>
<div class="control-group">
	<?php echo form_label(__('Email Address'), $email['id'], $label_attributes); ?>
		<div class="controls">
			<?php echo form_input($email); ?>
		<span class="help-inline error_msg">
			<?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?></span>
	  </div>
	 </div>
</fieldset>
<div class="form-actions">
	<?php echo form_submit('send', __('Send'),'class="btn btn-primary"'); ?>
	<a class="btn" title="logout" href="<?php echo site_url('auth/logout'); ?>"> <?php echo __('Logout'); ?></a>
</div>
<?php echo form_close(); ?>