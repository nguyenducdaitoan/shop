<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
/**
	 * Paypal order submit email view
	 *
	 * @package		JQuery PHP Store/Shop
	 * @author		Vinod
	 * @copyright	Copyright (c) 2013, LivelyWorks. (http://livelyworks.net)
	 * @link		http://livelyworks.net
	 * @since		Version 1.0
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
<strong><?php echo __('Name'); ?>:</strong> <?php echo $address_name; ?><br/>
<strong><?php echo __('Email'); ?>:</strong> <?php echo $payer_email; ?><br/>
<strong><?php echo __('Address'); ?>:</strong> <?php echo $address_street; ?><br/>
<strong><?php echo __('City'); ?>:</strong> <?php echo $address_city; ?><br/>
<strong><?php echo __('Zip'); ?>:</strong> <?php echo $address_zip; ?><br/>
<strong><?php echo __('Country'); ?>:</strong> <?php echo $address_country; ?><br/>
<br />
<br />
<?php
$cartLength = $num_cart_items+1;
$totalGrossAmount = 0;
?>
<h2><strong><?php echo __('Order Details'); ?></strong></h2>
<table border='1' cellpadding='5' cellspacing='0'>
<thead>
<tr>
  <th><?php echo __('Item Description'); ?></th>
   <th><?php echo __('Item ID'); ?></th>
  <th><?php echo __('Price'); ?></th>
  <th><?php echo __('Qty.'); ?></th>
  <th style="text-align:right;"><?php echo __('Sub-Total'); ?></th>
</tr>
</thead>
<?php $i = 1; ?>
<tbody>
<?php for($counter = 1; $counter < $cartLength; $counter++): ?>
<tr>
          <td><?php echo ${"item_name" . $counter}; ?></td>
          <td><?php echo ${"item_number" . $counter}; ?></td>
          <td style="text-align:right;"><?php echo  priceFormat((${'mc_gross_'.$counter}) / (${'quantity'.$counter}) ); ?></td>
          <td style="text-align:right;"> <?php echo (${'quantity'.$counter}); ?> </td>
          <td style="text-align:right;"><?php echo priceFormat(${'mc_gross_'.$counter}); ?></td>
        </tr>
<?php 
$totalGrossAmount = $totalGrossAmount + ${'mc_gross_'.$counter};

$i++; ?>
</tbody>
<?php endfor; ?>
</table>
<br /><br />
<h3><?php echo __('Base-Total'); ?>: <?php echo priceFormat($totalGrossAmount); ?> + <?php echo __('Shipping'); ?>: <?php echo priceFormat($mc_handling); ?> = <strong><?php echo __('Total'); ?> : <?php echo priceFormat($mc_gross); ?></strong></h3>
<br />
<strong><?php echo __('Payment Status'); ?>:</strong> <?php echo $payment_status; ?>
<br />
<strong><?php echo __('Payment Method'); ?>:</strong> <?php echo $payment_method; ?>
<br />
<strong><?php echo __('Payment Note'); ?>:</strong> <?php echo $payment_msg; ?>
<br />
<strong><?php echo __('Transaction ID'); ?>:</strong> <?php echo $txn_id; ?>
<?php if(isset($pending_reason)): ?>
<br />
<strong><?php echo __('Pending Reason'); ?>:</strong> <?php echo $pending_reason; ?>
<?php endif; ?>
<br /><br />
<?php echo __('Thank You'); ?><br />
<?php echo sprintf(__('The %s Team'), $store_name); ?>
</td>
</tr>
</table>
</div>
</body>
</html>