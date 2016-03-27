<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
Hi<?php if (strlen($username) > 0) { ?> <?php echo $username; ?><?php } ?>,

<?php echo __('You have changed your password.'); ?>
<?php echo __("Please, keep it in your records so you don't forget it."); ?>
<?php if (strlen($username) > 0) { ?>

<?php echo __('Your username:'); ?> <?php echo $username; ?>
<?php } ?>

<?php echo __('Your email address:'); ?> <?php echo $email; ?>

<?php /* Your new password: <?php echo $new_password; ?>

*/ ?>

<?php echo __('Thank you,'); ?>
<?php echo sprintf(__('The %s Team'), $site_name); ?>