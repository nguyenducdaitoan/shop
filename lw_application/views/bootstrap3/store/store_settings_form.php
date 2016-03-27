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
	'class' => 'form-control',
	
);

$logo = array(
	'name'	=> 'logo',
	'id'	=> 'logo',
	//'value' => ($query['logo'])	
	'class' 	=> 'filestyle',
	'data-buttonText' => 'Browse',
	'data-input' => 'false'
);

$businessEmail = array(
	'name'	=> 'businessEmail',
	'id'	=> 'businessEmail',
	'value' => set_value('businessEmail') ? set_value('businessEmail') : $query['business_email'],
	'type'	=> 'email',
	'required'	=> '',
	'class' => 'form-control',
);

$currency = array(
	'name'	=> 'currency',
	'id'	=> 'currency',
	'value' => set_value('currency') ? set_value('currency') : $query['currency'],
	'class' => 'form-control',
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
	'class' => 'form-control',
);

$usePaypal = array(
	'name'	=> 'usePaypal',
	'id'	=> 'usePaypal',
	'value'	=> 1,
	'checked'	=> set_value('usePaypal') ? set_value('usePaypal') : $query['use_paypal'],
);

$useSubmitOrder = array(
	'name'	=> 'useSubmitOrder',
	'id'	=> 'useSubmitOrder',
	'value'	=> 1,
	'checked'	=> set_value('useSubmitOrder') ? set_value('useSubmitOrder') : $query['use_submit_order'],
);


$shippingCharges = array(
	'name'	=> 'shippingCharges',
	'id'	=> 'shippingCharges',
	'value' => set_value('shippingCharges') ? set_value('shippingCharges') : $query['shipping_charges'],
	'type'	=> 'number',
	'step'	=> 'any',
	'min'	=> '0',
	'required'	=> '',
	'class' => 'form-control',
);

$shippingFreeAfter = array(
	'name'	=> 'shippingFreeAfter',
	'id'	=> 'shippingFreeAfter',
	'value' => set_value('shippingFreeAfter') ? set_value('shippingFreeAfter') : $query['shipping_free_after'],
	'type'	=> 'number',
	'step'	=> 'any',
	'min'	=> '0',
	'required'	=> '',
	'class' => 'form-control',
);


$msgOrderSubmit = array(
	'name'	=> 'msgOrderSubmit',
	'id'	=> 'msgOrderSubmit',
	'value' => set_value('msgOrderSubmit') ? set_value('msgOrderSubmit') : $query['msg_on_order_submit'],
	'required'	=> '',
	'class' => 'form-control',
);

$form_attributes = array('class' => 'form-horizontal');

$label_attributes = array(
    'class' => 'col-md-3 col-lg-2 control-label'
);

$topButtomArray = array(
  '%shipping_charge%' => 0, 
  );
$shippingChargMarkup = __('<span class="help-inline">Use <strong>%shipping_charge%</strong> for No Free Shipping</span>');
$shippingChargMarkup =  strtr($shippingChargMarkup, $topButtomArray);


?>

<div class="row col-md-12 col-lg-12">
	<h3><?php echo __('Edit Store Settings'); ?></h3><hr>
<?php echo form_open_multipart(site_url('settings/updateSettings'), $form_attributes); ?>	

<div class="form-group">
	<?php echo form_label(__('Store Name'), $storeName['id'],$label_attributes);?>
    <div class="col-md-5 col-lg-4">
      <?php echo form_input($storeName); ?> 
		<span class="help-inline error_msg">
		<?php echo form_error($storeName['name']); ?>
		</span>
    </div>
  </div>

  <div class="form-group">
	<?php echo form_label(__('Logo URL'), $logo['id'], $label_attributes);?>
    <div class="col-md-2 col-lg-1">
      <?php echo form_upload($logo); ?> 
    </div>
    <div class="col-md-4 col-lg-5 custom-note">
		<span class="help-inline"><?php echo __('Current Logo'); ?>: <strong><?php echo $query['logo']; ?> </strong></span>
	</div>
	<?php echo form_error($logo['name']); ?>
  </div>

  <div class="form-group">
	<?php echo form_label(__('Business Email'), $businessEmail['id'],$label_attributes);?>
    <div class="col-md-5 col-lg-4">
      <?php echo form_input($businessEmail); ?> 
	</div>
	<div class="col-lg-6">
	<span class="help-inline">
		<div class="custom-note"></div>
		<span class="help-inline"><strong><?php echo __('Note'); ?>:</strong> <?php echo __('it will use for PayPal as well as Submit Order.'); ?></span>
		<?php echo form_error($businessEmail['name']); ?>
		</span>
	</div>
  </div>
	<div class="form-group">
	<label class="col-md-3 col-lg-2 control-label"><?php echo __('Checkout Options'); ?></label>
            <div class="col-md-7 col-lg-5">
            	<label class="checkbox-inline" for="usePaypal">
				  <?php echo form_checkbox($usePaypal);?>  <?php echo __('Use PayPal'); ?>
				</label>
				<label class="checkbox-inline custom-btn" for="useSubmitOrder" >
				  <?php echo form_checkbox($useSubmitOrder);?> <?php echo __('Use Submit Order by Email'); ?>
				</label>
            </div>
          </div><!-- /control-group -->

		<div class="form-group">
		<?php echo form_label(__('Currency'), $currency['id'],$label_attributes);?>
			<div class="col-md-5 col-lg-4">
				<?php echo  form_dropdown($currency['name'], $currencies_options, set_value('currency') ? set_value('currency') : $query['currency'], 'id="currency" class="form-control"');  ?> 
				<span class="help-inline error_msg">
				<?php echo form_error($currency['name']); ?>
				</span>
			</div>
		</div>
		<div class="form-group">
		<?php echo form_label(__('Currency Symbol'), $currencySymbol['id'],$label_attributes);?>
			<div class="col-md-5 col-lg-4">
				<div class="input-group">
				  <?php echo form_input($currencySymbol); ?> 
				  <span class="input-group-addon" id="currencySymbolPreview"><?php echo htmlspecialchars_decode($currencySymbol['value']); ?></span>
				</div>
			</div>
			<div class="col-lg-6">
			<div class="custom-note"></div>
			<span class="help-inline">
				<span class="help-inline"><?php echo __('Refer for'); ?> <?php echo anchor('http://goo.gl/zRJRq',__('ASCII Codes'),'target=_blank'); ?></span>
				<?php echo form_error($currencySymbol['name']); ?>
				</span>
			</div>
		</div>

		<div class="form-group">
		<?php echo form_label(__('Shipping Charges'), $shippingCharges['id'],$label_attributes);?>
			<div class="col-md-5 col-lg-4">
				<?php echo form_input($shippingCharges); ?> 
				<span class="help-inline error_msg">
				<?php echo form_error($shippingCharges['name']); ?>
				</span>
			</div>
		</div>

		<div class="form-group">
		<?php echo form_label(__('Shipping Free After'), $shippingFreeAfter['id'],$label_attributes);?>
			<div class="col-md-5 col-lg-4">
				<?php echo form_input($shippingFreeAfter); ?> 
			</div>
			<div class="col-lg-4">
			<div class="custom-note"></div>
			<span class="help-inline">
				<?php echo form_error($shippingFreeAfter['name']); ?>
				<?php echo $shippingChargMarkup; ?>
				</span>
			</div>
		</div>

		
		<div class="form-group">
		<?php echo form_label(__('Message on Order Submit'), $msgOrderSubmit['id'],$label_attributes);?>
			<div class="col-md-5 col-lg-4">
				<?php echo form_textarea($msgOrderSubmit); ?> 
			</div>
			<span class="help-inline error_msg">
				<?php echo form_error($msgOrderSubmit['name']); ?>
				</span>
		</div>


 <div class="form-group">
    <div class="col-md-offset-3 col-lg-offset-2 col-md-9 col-lg-10">
      <?php echo form_submit('submit', __('Update'),'class="btn btn-primary"'); ?>
    </div>
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
