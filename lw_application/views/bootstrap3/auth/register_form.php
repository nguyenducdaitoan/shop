<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
if ($use_username) {
	$username = array(
		'name'	=> 'username',
		'id'	=> 'username',
		'value' => set_value('username'),
		'maxlength'	=> $this->config->item('username_max_length', 'tank_auth'),
		'size'	=> 30,
		'required'	=> '',
		'autocomplete'	=> 'off',
		'class' => 'form-control',
	);
}
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> set_value('email'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'type'	=> 'email',
	'required'	=> '',
	'autocomplete'	=> 'off',
	'class' => 'form-control'
);
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'value' => set_value('password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
	'required'	=> '',
	'autocomplete'	=> 'off',
	'class' => 'form-control'
);
$confirm_password = array(
	'name'	=> 'confirm_password',
	'id'	=> 'confirm_password',
	'value' => set_value('confirm_password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
	'required'	=> '',
	'class' => 'form-control'
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
	'required'	=> '',
	'class' => 'form-control'
);

$form_attributes = array('class' => 'form-horizontal');

$label_attributes = array(
    'class' => 'col-sm-4 col-md-4 col-lg-3 control-label'
);

?>
<?php echo form_open($this->uri->uri_string(), $form_attributes); ?>
<fieldset>
<legend><?php echo __('Register'); ?></legend>
<div class="form-group">
	<?php if ($use_username) { ?>
		<?php echo form_label(__('Username'), $username['id'],$label_attributes); ?>
		<div class="col-sm-6 col-md-6 col-lg-4">
			<?php echo form_input($username); ?>
		<span class="help-inline error_msg"><?php echo form_error($username['name']); ?><?php echo isset($errors[$username['name']])?$errors[$username['name']]:''; ?></span>
	  </div>
	 </div>
	<?php } ?>
		<div class="form-group">
		<?php echo form_label(__('Email Address'), $email['id'],$label_attributes ); ?>
		<div class="col-sm-6 col-md-6 col-lg-4">
		<?php echo form_input($email); ?>
		<span class="help-inline error_msg">
			<?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?>
</span>
			 </div>
	 </div>
	<div class="form-group">
		<?php echo form_label(__('Password'), $password['id'],$label_attributes ); ?>
		<div class="col-sm-6 col-md-6 col-lg-4">
			<?php echo form_password($password); ?>
		<span class="help-inline error_msg">
			<?php echo form_error($password['name']); ?></span>
			 </div>
	 </div>
	<div class="form-group">
		<?php echo form_label(__('Confirm Password'), $confirm_password['id'],$label_attributes ); ?>
		<div class="col-sm-6 col-md-6 col-lg-4">
			<?php echo form_password($confirm_password); ?>
		<span class="help-inline error_msg">
			<?php echo form_error($confirm_password['name']); ?></span>
			 </div>
	 </div>

	<?php if ($captcha_registration) {
		if ($use_recaptcha) { ?>
	<div class="form-group">
		<div class="col-sm-6 col-md-6 col-lg-4">
			<div id="recaptcha_image"></div>
			<a href="javascript:Recaptcha.reload()"><?php echo __('Get another CAPTCHA'); ?></a>
			<div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')"><?php echo __('Get an audio CAPTCHA'); ?></a></div>
			<div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')"><?php echo __('Get an image CAPTCHA'); ?></a></div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-6 col-md-6 col-lg-4">
			<div class="recaptcha_only_if_image"><?php echo __('Enter the words above'); ?></div>
			<div class="recaptcha_only_if_audio"><?php echo __('Enter the numbers you hear'); ?></div>
		
		<input type="text" id="recaptcha_response_field" name="recaptcha_response_field" /></td>
		<span class="help-inline error_msg">
			<?php echo form_error('recaptcha_response_field'); ?>
		</span>
		</div>
		<?php echo $recaptcha_html; ?>
	</div>
	<?php } else { ?>
	<div class="form-group">
			<label class="col-sm-4 col-md-4 col-lg-3 control-label"></label>
			<div class="col-sm-6 col-md-6 col-lg-4">
				<img src="<?php echo site_url("auth/create_captcha");?>" id="captcha" /><br/>
				<a href="#" onclick="
				document.getElementById('captcha').src='<?php echo site_url("auth/create_captcha");?>?'+Math.random();
				document.getElementById('captcha-form').focus();"
				id="change-image"><?php echo __('Not readable? Change text.'); ?></a><br/><br/>
				<?php echo form_input($captcha); ?>
				<span class="help-inline error_msg">
				<?php echo form_error($captcha['name']); ?>
			</span>
			</div>

		</div>
	<?php }
	} ?>
<div class="form-actions">
	<?php echo form_submit('register', __('Register'),'class="btn btn-primary"'); ?>
</div>

<div class="form-group">
<div class="col-lg-offset-3 col-sm-offset-4 col-md-offset-4 col-sm-8 col-md-8 col-lg-8">
      <?php echo form_submit('register', __('Register'),'class="btn btn-primary"'); ?>
    </div>
  </div>
<?php echo form_close(); ?>