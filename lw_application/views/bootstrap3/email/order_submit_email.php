<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
/**
   * Order submit email view
   *
   * @package    JQuery PHP Store/Shop
   * @author    Vinod
   * @copyright  Copyright (c) 2013, LivelyWorks. (http://livelyworks.net)
   * @link    http://livelyworks.net
   * @since    Version 1.0
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><title><?php echo sprintf(__('%s Order Details'), $store_name); ?></title></head>
<body>
<div style="max-width: 800px; margin: 0; padding: 30px 0;">
<table width="80%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="5%"></td>
<td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
<h2><?php echo sprintf(__('%s Order Details'), $store_name); ?></h2><br>
<h2><strong><?php echo __('Customer Details'); ?></strong></h2>
<strong><?php echo __('Name'); ?>:</strong> <?php echo $formData['fname'].' '.$formData['lname']; ?><br/>
<strong><?php echo __('Business Name'); ?>:</strong> <?php echo $formData['sof_bname'];?><br/>
<strong><?php echo __('Email'); ?>:</strong> <?php echo $formData['sof_email'];?><br/>
<strong><?php echo __('Address'); ?>:</strong> <?php echo $formData['sof_add'];?><br/>
<strong><?php echo __('City'); ?>:</strong> <?php echo $formData['sof_city'];?><br/>
<strong><?php echo __('Zip'); ?>:</strong> <?php echo $formData['sof_zip'];?><br/>
<strong><?php echo __('Phone'); ?>:</strong> <?php echo $formData['sof_ph'];?><br/>
<strong><?php echo __('Country'); ?>:</strong> <?php echo $formData['sof_country'];?><br/>
<strong><?php echo __('Message if any'); ?>:</strong> <?php echo $formData['sof_message'];?><br/>
<br />
<br />
<h2><strong><?php echo __('Order Details'); ?></strong></h2>
<table border='1' cellpadding='5' cellspacing='0'>
<thead>
<tr>
  <th><?php echo __('Item Description'); ?></th>
  <th><?php echo __('Size'); ?></th>
  <th><?php echo __('Color'); ?></th>
  <th><?php echo __('Price'); ?></th>
  <th><?php echo __('Qty.'); ?></th>
  <th style="text-align:right;"><?php echo __('Sub-Total'); ?></th>
</tr>
</thead>
<?php $i = 1; ?>
<tbody>
<?php foreach ($this->cart->contents() as $items): ?>
<tr>
          <td> <?php echo $items['name']; ?></td>
            
            <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>

                                         <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
                                                <td><?php echo $option_value ? $option_value : '&nbsp;'; ?></td>
                                        <?php endforeach; ?>

                        <?php endif; ?>
          
          <td style="text-align:right;"><?php echo priceFormat($items['price']); ?></td>
          <td style="text-align:right;"> <?php echo $items['qty']; ?> </td>
          <td style="text-align:right;"><?php echo priceFormat($items['subtotal']); ?></td>
        </tr>
<?php $i++; ?>
</tbody>
<?php endforeach; ?>
</table>
<br /><br />
<h3><?php echo __('Base-Total'); ?>: <?php echo priceFormat($this->cart->total()); ?> + <?php echo __('Shipping'); ?>: <?php echo priceFormat(calculateShipping($this->cart->total())); ?> = <strong><?php echo __('Total'); ?> : <?php echo priceFormat($this->cart->total() + calculateShipping($this->cart->total()),true); ?></strong></h3>
<br />
<strong><?php echo __('Payment Status'); ?>:</strong> <?php echo $payment_status; ?>
<br /><br />
<?php echo __('Thank You'); ?><br />
<?php echo sprintf(__('The %s Team'), $store_name); ?>
</td>
</tr>
</table>
</div>
</body>
</html>