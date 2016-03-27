<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'required'	=> '',
	'class' => 'form-control',
);
if ($this->config->item('use_username', 'tank_auth')) {
	$login_label = __('Email or login');
} else {
	$login_label = __('Email');
	$login['type'] = 'email';
}

$form_attributes = array('class' => 'form-horizontal');

$label_attributes = array(
    'class' => 'col-lg-3 control-label'
);


?>

<?php echo form_open($this->uri->uri_string(), $form_attributes); ?>

<div class="row col-lg-12">
	<h3><?php echo __('Get a New Password'); ?></h3><hr>

<div class="form-group">
		<?php echo form_label($login_label, $login['id'],$label_attributes); ?>
			<div class="col-lg-6">
			<?php echo form_input($login); ?>
			<span class="help-inline error_msg">
			<?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?></span>
			</div>
		</div>
	<div class="form-group">
    <div class="col-lg-offset-3 col-lg-9">
      <?php echo form_submit('reset', __('Get a new password'),'class="btn btn-primary"'); ?>
    </div>
  </div>
	</div>
<?php echo form_close(); ?>