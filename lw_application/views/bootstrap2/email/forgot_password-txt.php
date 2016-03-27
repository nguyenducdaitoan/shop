<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
Hi<?php if (strlen($username) > 0) { ?> <?php echo $username; ?><?php } ?>,

<?php echo __('Forgot your password, huh? No big deal.'); ?><br />

<?php echo __('To create a new password, just follow this link:'); ?>

<?php echo site_url('/auth/reset_password/'.$user_id.'/'.$new_pass_key); ?>


<?php echo __('You received this email, because it was requested by a user on'); ?> <?php echo sprintf(__('%s'), $site_name); ?>. <?php echo __('This is part of the procedure to create a new password on the system. If you DID NOT request a new password then please ignore this email and your password will remain the same.'); ?>


<?php echo __('Thank you,'); ?>
<?php echo sprintf(__('The %s Team'), $site_name); ?>