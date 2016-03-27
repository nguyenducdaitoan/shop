<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php echo sprintf(__('Welcome to %s'), $site_name); ?>,

<?php echo sprintf(__('Thanks for joining %s. We listed your sign in details below, make sure you keep them safe.<br/>'), $site_name); ?>
<?php echo __('Follow this link to login on the site:'); ?>

<?php echo site_url('/auth/login/'); ?>

<?php if (strlen($username) > 0) { ?>

<?php echo __('Your username:'); ?> <?php echo $username; ?>
<?php } ?>

<?php echo __('Your email address:'); ?> <?php echo $email; ?>

<?php /* Your password: <?php echo $password; ?>

*/ ?>

<?php echo __('Have fun!'); ?>
<?php echo sprintf(__('The %s Team'), $site_name); ?>