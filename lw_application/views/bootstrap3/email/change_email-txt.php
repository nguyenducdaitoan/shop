<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
Hi<?php if (strlen($username) > 0) { ?> <?php echo $username; ?><?php } ?>,

<?php echo sprintf(__('You have changed your email address for %s'), $site_name); ?>

<?php echo __('Follow this link to confirm your new email address:'); ?>

<?php echo site_url('/auth/reset_email/'.$user_id.'/'.$new_email_key); ?>


<?php echo sprintf(__('Your email address: %s'), $new_email); ?>


<?php echo sprintf(__('You received this email, because it was requested by a %s user. If you have received this by mistake, please DO NOT click the confirmation link, and simply delete this email. After a short time, the request will be removed from the system.'), $site_name); ?>


<?php echo __('Thank you,'); ?>
<?php echo sprintf(__('The %s Team'), $site_name); ?>