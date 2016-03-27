<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><title><?php echo sprintf(__('Create a new password on %s'), $site_name); ?></title></head>
<body>
<div style="max-width: 800px; margin: 0; padding: 30px 0;">
<table width="80%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="5%"></td>
<td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
<h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;"><?php echo __('Create a new password'); ?></h2>
<?php echo __('Forgot your password, huh? No big deal.'); ?><br />
<?php echo __('To create a new password, just follow this link:'); ?><br />
<br />
<big style="font: 16px/18px Arial, Helvetica, sans-serif;"><b><a href="<?php echo site_url('/auth/reset_password/'.$user_id.'/'.$new_pass_key); ?>" style="color: #3366cc;"><?php echo __('Create a new password'); ?></a></b></big><br />
<br />
<?php echo __("Link doesn't work? Copy the following link to your browser address bar:"); ?><br />
<nobr><a href="<?php echo site_url('/auth/reset_password/'.$user_id.'/'.$new_pass_key); ?>" style="color: #3366cc;"><?php echo site_url('/auth/reset_password/'.$user_id.'/'.$new_pass_key); ?></a></nobr><br />
<br />
<br />
<?php echo __('You received this email, because it was requested by a user on'); ?> <a href="<?php echo site_url(''); ?>" style="color: #3366cc;"><?php echo sprintf(__('%s'), $site_name); ?></a>. <?php echo __('This is part of the procedure to create a new password on the system. If you DID NOT request a new password then please ignore this email and your password will remain the same.'); ?><br />
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