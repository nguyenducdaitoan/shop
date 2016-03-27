<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
	'required'	=> '',
	'autocomplete'	=> 'off',
);
if ($login_by_username AND $login_by_email) {
	$login_label = __('Email or login');
} else if ($login_by_username) {
	$login_label = __('Login');
} else {
	$login_label = __('Email');
}
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
	'required'	=> '',
	'autocomplete'	=> 'off',
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);

$form_attributes = array('class' => 'form-horizontal');

$label_attributes = array(
    'class' => 'control-label'
);

?>
<?php echo form_open($this->uri->uri_string(),$form_attributes ); ?>
<fieldset>
<legend><?php echo __('Login'); ?></legend>
<?php if(isset($errors[$password['name']]) OR isset($errors[$login['name']])): ?>
<div class="alert alert-danger">
	<?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?>
	<?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?>
</div>
<?php endif; ?>
<div class="control-group">
	<?php echo form_label($login_label, $login['id'],$label_attributes); ?>
		<div class="controls">
			<?php echo form_input($login); ?>
			<span class="help-inline error_msg">
				<?php echo form_error($login['name']); ?></span>
	  </div>
	 </div>
	<div class="control-group">
		<?php echo form_label(__('Password'), $password['id'],$label_attributes); ?>
<div class="controls">
		<?php echo form_password($password); ?>
		<span class="help-inline error_msg">
			<?php echo form_error($password['name']); ?></span>
	  </div>
	 </div>
	
	<?php if ($show_captcha) {
		if ($use_recaptcha) { ?>
	<div class="control-group">
		<div class="controls">
			<div id="recaptcha_image"></div>
			<a href="javascript:Recaptcha.reload()"><?php echo __('Get another CAPTCHA'); ?></a>
			<div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')"><?php echo __('Get an audio CAPTCHA'); ?></a></div>
			<div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')"><?php echo __('Get an image CAPTCHA'); ?></a></div>
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
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
	<div class="control-group">
			<label class="control-label"></label>
			<div class="controls">
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

	<div class="control-group">
		 <div class="controls">
		 	<label class="checkbox">
			<?php echo form_checkbox($remember); ?>
				<span><?php echo __('Remember me'); ?></span>
               </label>
               </div>
               </div>
               		
</fieldset>
<div class="form-actions">
	<?php echo form_submit('submit', __('Login'),'class="btn btn-primary"'); ?>
	<?php echo anchor('/auth/forgot_password/', __('Forgot password'),'class="btn"'); ?>
			<?php if ($this->config->item('allow_registration', 'tank_auth')) echo anchor('/auth/register/', __('Register'),'class="btn"'); ?>
</div>
<?php echo form_close(); ?>