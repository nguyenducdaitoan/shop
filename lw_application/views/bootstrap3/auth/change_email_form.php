<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
	'required'	=> '',
	'class' => 'form-control',
);
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'type'	=> 'email',
	'required'	=> '',
	'class' => 'form-control',
);

$form_attributes = array('class' => 'form-horizontal');

$label_attributes = array(
    'class' => 'col-sm-4 col-md-4 col-lg-3 control-label'
);

?>
<?php echo form_open($this->uri->uri_string(),$form_attributes); ?>

<div class="row col-lg-12 col-md-12 col-sm-12">
<h3><?php echo __('Change Email'); ?></h3><hr>

	<div class="form-group">
    <?php echo form_label(__('Password'), $password['id'],$label_attributes); ?>
    <div class="col-sm-6 col-md-6 col-lg-4">
      <?php echo form_password($password); ?>
		<span class="help-inline error_msg">
			<?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?></span>
    </div>
  </div>
	<div class="form-group">
    <?php echo form_label(__('New email address'), $email['id'],$label_attributes); ?>
    <div class="col-sm-6 col-md-6 col-lg-4">
      <?php echo form_input($email); ?>
		<span class="help-inline error_msg">
			<?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?> </span>
    </div>
  </div>

<div class="form-group">
    <div class="col-lg-offset-3 col-md-offset-4 col-sm-offset-4 col-sm-8 col-md-8 col-lg-9">
      <?php echo form_submit('change', __('Send confirmation email'),'class="btn btn-primary"'); ?>
    </div>
  </div>
</div>
</div>
<?php echo form_close(); ?>