<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><title><?php echo sprintf(__('Your new password on %s'), $site_name); ?></title></head>
<body>
<div style="max-width: 800px; margin: 0; padding: 30px 0;">
<table width="80%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="5%"></td>
<td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
<h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;"><?php echo sprintf(__('Your new password on %s'), $site_name); ?></h2>
<?php echo __('You have changed your password.'); ?><br />
<?php echo __("Please, keep it in your records so you don't forget it."); ?><br />
<br />
<?php if (strlen($username) > 0) { ?><?php echo __('Your username:'); ?> <?php echo $username; ?><br /><?php } ?>
<?php echo __('Your email address:'); ?> <?php echo $email; ?><br />
<?php /* Your new password: <?php echo $new_password; ?><br /> */ ?>
<br />
<br />
<?php echo __('Thank you,'); ?><br />
<?php echo sprintf(__('The %s Team'), $site_name); ?>
</td>
</tr>
</table>
</div>
</body>
</html>