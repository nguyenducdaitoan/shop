<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
/**
	 * store settings form view
	 *
	 * @package		JQuery PHP Store/Shop
	 * @author		Vinod
	 * @copyright	Copyright (c) 2013, LivelyWorks. (http://livelyworks.net)
	 * @link		http://livelyworks.net
	 * @since		Version 1.0
*/
$storeName = array(
	'name'	=> 'storeName',
	'id'	=> 'storeName',
	'value' => set_value('storeName') ? set_value('storeName') : $query['store_name'],
	'required'	=> '',
);

$logo = array(
	'name'	=> 'logo',
	'id'	=> 'logo',
	//'value' => ($query['logo'])
);

$businessEmail = array(
	'name'	=> 'businessEmail',
	'id'	=> 'businessEmail',
	'value' => set_value('businessEmail') ? set_value('businessEmail') : $query['business_email'],
	'type'	=> 'email',
	'required'	=> '',
);

$currency = array(
	'name'	=> 'currency',
	'id'	=> 'currency',
	'value' => set_value('currency') ? set_value('currency') : $query['currency']
); 



$currencies_options = array(
                  'AUD'	=> __('Australian Dollar'),
                  'CAD'	=> __('Canadian Dollar'),
                  'EUR'	=> __('Euro'),
                  'GBP' => __('British Pound'),
                  'USD' => __('U.S. Dollar'),
                  'NZD' => __('New Zealand Dollar'),
                  'CHF' => __('Swiss Franc'),
                  'HKD' => __('Hong Kong Dollar'),
                  'SGD' => __('Singapore Dollar'),
                  'SEK' => __('Swedish Krona'),
                  'DKK' => __('Danish Krone'),
                  'PLN' => __('Polish Zloty'),
                  'NOK' => __('Norwegian Krone'),
                  'HUF' => __('Hungarian Forint'),
                  'CZK' => __('Czech Koruna'),
                  'ILS' => __('Israeli New Shekel'),
                  'MXN' => __('Mexican Peso'),
                  'BRL' => __('Brazilian Real (only for Brazilian members)'),
                  'MYR' => __('Malaysian Ringgit (only for Malaysian members)'),
                  'PHP' => __('Philippine Peso'),
                  'TWD' => __('New Taiwan Dollar'),
                  'THB' => __('Thai Baht'),
                  'TRY' => __('Turkish Lira (only for Turkish members)'),
                );

$currencySymbol = array(
	'name'	=> 'currencySymbol',
	'id'	=> 'currencySymbol',
	'value' => set_value('currencySymbol') ? htmlspecialchars(set_value('currencySymbol')) : htmlspecialchars($query['currency_symbol']),
	'required'	=> '',
);

$usePaypal = array(
	'name'	=> 'usePaypal',
	'id'	=> 'usePaypal',
	'value'	=> 1,
	'checked'	=> set_value('usePaypal') ? set_value('usePaypal') : $query['use_paypal']
);

$useSubmitOrder = array(
	'name'	=> 'useSubmitOrder',
	'id'	=> 'useSubmitOrder',
	'value'	=> 1,
	'checked'	=> set_value('useSubmitOrder') ? set_value('useSubmitOrder') : $query['use_submit_order']
);


$shippingCharges = array(
	'name'	=> 'shippingCharges',
	'id'	=> 'shippingCharges',
	'value' => set_value('shippingCharges') ? set_value('shippingCharges') : $query['shipping_charges'],
	'type'	=> 'number',
	'step'	=> 'any',
	'min'	=> '0',
	'required'	=> '',
);

$shippingFreeAfter = array(
	'name'	=> 'shippingFreeAfter',
	'id'	=> 'shippingFreeAfter',
	'value' => set_value('shippingFreeAfter') ? set_value('shippingFreeAfter') : $query['shipping_free_after'],
	'type'	=> 'number',
	'step'	=> 'any',
	'min'	=> '0',
	'required'	=> '',
);


$msgOrderSubmit = array(
	'name'	=> 'msgOrderSubmit',
	'id'	=> 'msgOrderSubmit',
	'value' => set_value('msgOrderSubmit') ? set_value('msgOrderSubmit') : $query['msg_on_order_submit'],
	'required'	=> '',
);

$form_attributes = array('class' => 'form-horizontal');

$label_attributes = array(
    'class' => 'control-label'
);

?>
<div class="row-fluid">
<?php echo form_open_multipart(site_url('settings/updateSettings'), $form_attributes); ?>	
<fieldset>
<legend><?php echo __('Edit Store Settings'); ?></legend>
<div class="control-group">
	<?php echo form_label(__('Store Name'), $storeName['id'],$label_attributes);?>
	<div class="controls">
		<?php echo form_input($storeName); ?> 
		<span class="help-inline error_msg">
		<?php echo form_error($storeName['name']); ?>
		</span>
	</div>
</div>
<div class="control-group">
	<?php echo form_label(__('Logo URL'), $logo['id'], $label_attributes);?>
	<div class="controls">
		<?php echo form_upload($logo); ?> 
		<span class="help-inline error_msg">
		<span class="help-inline"><?php echo __('Current Logo'); ?>: <strong><?php echo $query['logo']; ?> </strong></span>
		<?php echo form_error($logo['name']); ?>
		</span>
	</div>
</div>
<div class="control-group">
	<?php echo form_label(__('Business Email'), $businessEmail['id'],$label_attributes);?>
	<div class="controls">
		<?php echo form_input($businessEmail); ?> 
		<span class="help-inline error_msg">
		<span class="help-inline"><strong><?php echo __('Note'); ?>:</strong> <?php echo __('it will use for PayPal as well as Submit Order.'); ?></span>
		<?php echo form_error($businessEmail['name']); ?>
		</span>
	</div>
</div>
<div class="control-group">
	<label class="control-label"><?php echo __('Checkout Options'); ?></label>
            <div class="controls">
               <label class="checkbox">
                    <?php echo form_checkbox($usePaypal);?> 
                    <span><?php echo __('Use PayPal'); ?></span>
                  </label>
            </div>
          </div><!-- /control-group -->
<div class="control-group">
            <div class="controls">
               <label class="checkbox">
                    <?php echo form_checkbox($useSubmitOrder);?> 
                    <span><?php echo __('Use Submit Order by Email'); ?></span>
                  </label>
            </div>
          </div><!-- /control-group -->



<div class="control-group">
	<?php echo form_label(__('Currency'), $currency['id'],$label_attributes);?>
	<div class="controls">
		<?php echo  form_dropdown($currency['name'], $currencies_options, set_value('currency') ? set_value('currency') : $query['currency'], 'id="currency"');  ?> 
	<span class="help-inline error_msg">
		<?php echo form_error($currency['name']); ?>
		</span>
	</div>
</div>			  



<div class="control-group">
	<?php echo form_label(__('Currency Symbol'), $currencySymbol['id'],$label_attributes);?>
	<div class="controls">
		<div class="input-append">
		<?php echo form_input($currencySymbol); ?> 
		<span class="add-on" id="currencySymbolPreview"><?php echo htmlspecialchars_decode($currencySymbol['value']); ?></span>
		</div>
		<span class="help-inline error_msg">
		<span class="help-inline"><?php echo __('Refer for'); ?> <?php echo anchor('http://goo.gl/zRJRq',__('ASCII Codes'),'target=_blank'); ?></span>
		<?php echo form_error($currencySymbol['name']); ?>
		</span>
	</div>
</div>		
 <div class="control-group">
	<?php echo form_label(__('Shipping Charges'), $shippingCharges['id'],$label_attributes);?>
	<div class="controls">
		<?php echo form_input($shippingCharges); ?> 
		
		<span class="help-inline error_msg">
		<?php echo form_error($shippingCharges['name']); ?>
		</span>
	</div>
</div>	
 <div class="control-group">
	<?php echo form_label(__('Shipping Free After'), $shippingFreeAfter['id'],$label_attributes);?>
	<div class="controls">
		<?php echo form_input($shippingFreeAfter); ?> 
		
		<span class="help-inline error_msg">
		<?php echo form_error($shippingFreeAfter['name']); ?>
		<span class="help-inline">Use <strong>0</strong> for No Free Shipping</span>
		</span>
	</div>
</div>	
 <div class="control-group">
	<?php echo form_label(__('Message on Order Submit'), $msgOrderSubmit['id'],$label_attributes);?>
	<div class="controls">
		<?php echo form_textarea($msgOrderSubmit); ?> 
		
		<span class="help-inline error_msg">
		<?php echo form_error($msgOrderSubmit['name']); ?>
		</span>
	</div>
</div>
</fieldset>
<div class="form-actions">
	<?php echo form_submit('submit', __('Update'),'class="btn btn-primary"'); ?>
</div>

<?php echo form_close()?>
</div>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		var currencies_json = <?php echo $currencies_json; ?>;
		$('#currency').on('change', function(){
			var selectedCurrency = ($(this).val());
			if(currencies_json[selectedCurrency]){
				$('#currencySymbol').val(currencies_json[selectedCurrency].ASCII);
				$('#currencySymbolPreview').html(currencies_json[selectedCurrency].ASCII);
			}
		});

		$('#currencySymbol').on('change', function(){
			var selectedCurrency = $(this).val();
			$('#currencySymbolPreview').html(selectedCurrency);
		});
	});

</script>
