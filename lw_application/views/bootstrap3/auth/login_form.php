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
	'class' => 'form-control',
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
	'class' => 'form-control',
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
	'class' => 'form-control',
);

$form_attributes = array('class' => 'form-horizontal');

$label_attributes = array(
    'class' => 'col-xs-8 col-sm-4 col-md-4 col-lg-3  control-label'
);

?>

<?php echo form_open($this->uri->uri_string(),$form_attributes ); ?>

<div class="row col-lg-12 col-md-12 col-sm-12 col-xs-10">
	<h3><?php echo __('Login'); ?></h3><hr>

<?php if(isset($errors[$password['name']]) OR isset($errors[$login['name']])): ?>
<div class="alert alert-danger">
	<?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?>
	<?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?>
</div>
<?php endif; ?>

		<br><div class="form-group">
		<?php echo form_label($login_label, $login['id'],$label_attributes); ?>
			<div class="col-sm-8  col-md-8  col-lg-6 ">
			<?php echo form_input($login); ?>
			<span class="help-inline error_msg">
					<?php echo form_error($login['name']); ?></span>
			</div>
		</div>


		<div class="form-group">
		<?php echo form_label(__('Password'), $password['id'],$label_attributes); ?>
			<div class=" col-sm-8 col-md-8 col-lg-6 ">
			<?php echo form_password($password); ?>
		<span class="help-inline error_msg">
			<?php echo form_error($password['name']); ?></span>
			</div>
		</div>

	
	<?php if ($show_captcha) {
		if ($use_recaptcha) { ?>
	<div class="form-group">
		<div class="col-sm-4 col-md-4 col-lg-3 ">
			<div id="recaptcha_image"></div>
			<a href="javascript:Recaptcha.reload()"><?php echo __('Get another CAPTCHA'); ?></a>
			<div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')"><?php echo __('Get an audio CAPTCHA'); ?></a></div>
			<div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')"><?php echo __('Get an image CAPTCHA'); ?></a></div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-4 col-md-4  col-lg-3">
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
		<label for="inputEmail1" class="col-sm-4 col-md-4 col-lg-3 control-label"></label>
			<div class=" col-sm-8 col-md-8 col-lg-6 ">
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

	<div class="form-group">
		 <label for="inputEmail1" class=" col-sm-4 col-md-4 col-lg-3 control-label"></label>
			<div class="  col-sm-4 col-md-4 col-lg-3">
		 	<label class="checkbox">
			<?php echo form_checkbox($remember); ?>
				<span><?php echo __('Remember me'); ?></span>
               </label>
               </div>
               </div>

               <div class="form-group">
<div class="col-lg-offset-3 col-sm-offset-4 col-md-offset-4 col-sm-8 col-md-8 col-lg-8">
      <?php echo form_submit('submit',__('Login'),'class="btn btn-primary"'); ?>
	<a href="forgot_password" class="btn btn-default"><?php echo __('Forgot password'); ?></a>
	<?php if ($this->config->item('allow_registration', 'tank_auth')) echo anchor('/auth/register/', __('Register'),'class="btn btn-default cart-btn"'); ?>
    </div>
  </div>
               		

           </div>
<?php echo form_close(); ?>
