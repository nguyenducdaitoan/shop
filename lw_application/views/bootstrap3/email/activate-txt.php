<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php echo sprintf(__('Welcome to %s'), $site_name); ?>,

<?php echo sprintf(__('Thanks for joining %s. We listed your sign in details below, make sure you keep them safe.'), $site_name); ?>
<?php echo __('To verify your email address, please follow this link:'); ?>

<?php echo site_url('/auth/activate/'.$user_id.'/'.$new_email_key); ?>


<?php echo sprintf(__('Please verify your email within %s hours, otherwise your registration will become invalid and you will have to register again.'), $activation_period); ?>
<?php if (strlen($username) > 0) { ?>

<?php echo __('Your username:'); ?> <?php echo $username; ?>
<?php } ?>

Your email address: <?php echo $email; ?>
<?php if (isset($password)) { /* ?>

Your password: <?php echo $password; ?>
<?php */ } ?>



<?php echo __('Have fun!'); ?>
<?php echo sprintf(__('The %s Team'), $site_name); ?>