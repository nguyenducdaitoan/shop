<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$new_password = array(
	'name'	=> 'new_password',
	'id'	=> 'new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
	'required'	=> '',
	'class' 	=> 'form-control'
);
$confirm_new_password = array(
	'name'	=> 'confirm_new_password',
	'id'	=> 'confirm_new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size' 	=> 30,
	'required'	=> '',
	'class' 	=> 'form-control'
);

$form_attributes = array('class' => 'form-horizontal');

$label_attributes = array(
    'class' => 'col-sm-4 col-md-4 col-lg-3 control-label'
);

?>
<?php echo form_open($this->uri->uri_string(), $form_attributes); ?>
<div class="row col-sm-12 col-md-12 col-lg-12">

<h3><?php echo __('Change Password'); ?></h3><hr>
<div class="form-group">
		<?php echo form_label(__('New Password'), $new_password['id'],$label_attributes); ?>
		<div class="col-sm-6 col-md-6 col-lg-4">
			<?php echo form_password($new_password); ?>
		<span class="help-inline error_msg">
			<?php echo form_error($new_password['name']); ?><?php echo isset($errors[$new_password['name']])?$errors[$new_password['name']]:''; ?></span>
	  </div>
	 </div>




	<div class="form-group">
		<?php echo form_label(__('Confirm New Password'), $confirm_new_password['id'], $label_attributes); ?>
		<div class="col-sm-6 col-md-6 col-lg-4">
			<?php echo form_password($confirm_new_password); ?>
		<span class="help-inline error_msg"><?php echo form_error($confirm_new_password['name']); ?><?php echo isset($errors[$confirm_new_password['name']])?$errors[$confirm_new_password['name']]:''; ?></span>
	  </div>
	 </div>
<div class="form-group">
    <div class="col-lg-offset-3 col-md-offset-4 col-sm-offset-4 col-sm-8 col-md-8 col-lg-9">
      <?php echo form_submit('change',__('Change Password'),'class="btn btn-primary"'); ?>
    </div>
  </div>
</div>
<?php echo form_close(); ?>