<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'required'	=> '',
);
if ($this->config->item('use_username', 'tank_auth')) {
	$login_label = __('Email or login');
} else {
	$login_label = __('Email');
	$login['type'] = 'email';
}

$form_attributes = array('class' => 'form-horizontal');

$label_attributes = array(
    'class' => 'control-label'
);


?>
<?php echo form_open($this->uri->uri_string(), $form_attributes); ?>
<fieldset>
<legend><?php echo __('Get a New Password'); ?></legend>
<div class="control-group">
		<?php echo form_label($login_label, $login['id'],$label_attributes); ?>
		<div class="controls">
			<?php echo form_input($login); ?>
		<span class="help-inline error_msg">
			<?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?></span>
	</div>
	</div>
	</fieldset>
<div class="form-actions">
	<?php echo form_submit('reset', __('Get a new password'),'class="btn btn-primary"'); ?>
</div>
<?php echo form_close(); ?>