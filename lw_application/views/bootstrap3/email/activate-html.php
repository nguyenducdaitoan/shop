<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><title><?php echo sprintf(__('Welcome to %s'), $site_name); ?>!</title></head>
<body>
<div style="max-width: 800px; margin: 0; padding: 30px 0;">
<table width="80%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="5%"></td>
<td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
<h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;"><?php echo sprintf(__('Welcome to %s'), $site_name); ?>!</h2>
<?php echo sprintf(__('Thanks for joining %s. We listed your sign in details below, make sure you keep them safe.'), $site_name); ?>
<br />
<?php echo __('To verify your email address, please follow this link:'); ?><br />
<br />
<big style="font: 16px/18px Arial, Helvetica, sans-serif;"><b><a href="<?php echo site_url('/auth/activate/'.$user_id.'/'.$new_email_key); ?>" style="color: #3366cc;"><?php echo __('Finish your registration...'); ?></a></b></big><br />
<br />
<?php echo __("Link doesn't work? Copy the following link to your browser address bar:"); ?><br />
<nobr><a href="<?php echo site_url('/auth/activate/'.$user_id.'/'.$new_email_key); ?>" style="color: #3366cc;"><?php echo site_url('/auth/activate/'.$user_id.'/'.$new_email_key); ?></a></nobr><br />
<br />
<?php echo sprintf(__('Please verify your email within %s hours, otherwise your registration will become invalid and you will have to register again.'), $activation_period); ?>
<br />
<br />
<br />
<?php if (strlen($username) > 0) { ?><?php echo __('Your username:'); ?> <?php echo $username; ?><br /><?php } ?>
Your email address: <?php echo $email; ?><br />
<?php if (isset($password)) { /* ?>Your password: <?php echo $password; ?><br /><?php */ } ?>
<br />
<br />
<?php echo __('Have fun!'); ?><br />
<?php echo sprintf(__('The %s Team'), $site_name); ?>
</td>
</tr>
</table>
</div>
</body>
</html>