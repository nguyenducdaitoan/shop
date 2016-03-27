<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
/**
   * submit order by email form view
   *
   * @package    JQuery PHP Store/Shop
   * @author    Vinod
   * @copyright  Copyright (c) 2013, LivelyWorks. (http://livelyworks.net)
   * @link    http://livelyworks.net
   * @since    Version 1.0
*/
 $isAjaxReq = false;
if($this->input->is_ajax_request()): 
      $isAjaxReq = true;
endif;
$fname = array(
  'name'  => 'fname',
  'id'  => 'fname',
  'value' => set_value('fname'),
  'class'  => 'input-small',
  'placeholder'=> __('First Name'),
  'required'  => '',
  'autofocus'  => '',
);

$lname = array(
  'name'  => 'lname',
  'id'  => 'lname',
  'value' => set_value('lname'),
  'class'  => 'input-small',
  'placeholder'=> __('Last Name'),
);

$sof_bname = array(
  'name'  => 'sof_bname',
  'id'  => 'sof_bname',
  'class'  => 'input-xlarge',
  'value' => set_value('sof_bname'),
);

$sof_email = array(
  'name'  => 'sof_email',
  'type'  => 'email',
  'id'  => 'sof_email',
  'value' => set_value('sof_email'),
  'class'  => 'input-xlarge',
  'required'  => '',
);

$sof_add = array(
  'name'  => 'sof_add',
  'id'  => 'sof_add',
  'value' => set_value('sof_add'),
);

$sof_city = array(
  'name'  => 'sof_city',
  'id'  => 'sof_city',
  'value' => set_value('sof_city'),
);

$sof_zip = array(
  'name'  => 'sof_zip',
  'id'  => 'sof_zip',
  'value' => set_value('sof_zip'),
);

$sof_ph = array(
  'name'  => 'sof_ph',
    'type'  => 'tel',
  'id'  => 'sof_ph',
  'value' => set_value('sof_ph'),
);

$sof_country = array(
  'name'  => 'sof_country',
  'id'  => 'sof_country',
  'value' => set_value('sof_country'),
);

$sof_message = array(
  'name'  => 'sof_message',
  'id'  => 'sof_message',
  'value' => set_value('sof_message'),
  'class'  => 'input-xlarge',
);

?>
<div class="submitOrderContainer">
<div class="modal-header">
    <?php if(!$isAjaxReq): ?>
    <button type="button" class="close modalCloseBtn" data-dismiss="modal" aria-hidden="true" title="Close Details">&times;</button>
     <?php endif; ?>
    <h3 id="submitOrderContainerHeading"><?php echo __('We need some details'); ?></h3></div>
  <?php 
$form_attributes = array('id' => 'submitOrderForm', 'class' => 'form-horizontal', 'style' => 'margin:0;');
  echo form_open('shopping_cart/checkoutSubmitOrder', $form_attributes); ?>
  <div class="<?php echo (!$isAjaxReq) ? '' : 'modal-body'; ?>" id="ModelSubmitOrderData"><br>
          <!--  Name -->
          <div class="control-group">
            <label class="control-label" for="fname"><?php echo __('Name'); ?>: </label>
            <div class="controls form-inline">
              <?php echo form_input($fname); ?> 
              <?php echo form_input($lname); ?> 
              <?php echo form_error('fname'); ?>
            </div>
          </div>
          <!--  /Name --> 
          <!--  Business Name -->
          <div class="control-group">
            <label class="control-label" for="sof_bname"><?php echo __('Business Name'); ?>: </label>
            <div class="controls">
              <?php echo form_input($sof_bname); ?> 
            </div>
          </div>
          <!--  /Business Name --> 
          <!--  Email -->
          <div class="control-group">
            <label class="control-label" for="sof_email"><?php echo __('Email'); ?>: </label>
            <div class="controls">
              <?php echo form_input($sof_email); ?> 
              <?php echo form_error('sof_email'); ?>
            </div>
          </div>
          <!--  /Email --> 
          <!--  Address -->
          <div class="control-group">
            <label class="control-label" for="sof_add"><?php echo __('Address'); ?>: </label>
            <!--  Street -->
            <div class="controls">
              <div class="input-prepend"> <span class="add-on"><?php echo __('Street'); ?></span>
                <?php echo form_input($sof_add); ?> 
              </div>
            </div>
            <!--  /Street --> 
            <!--  City -->
            <div class="controls">
              <div class="input-prepend"> <span class="add-on"><?php echo __('City'); ?></span>
                 <?php echo form_input($sof_city); ?> 
              </div>
            </div>
            <!--  /City --> 
            <!--  Zip code -->
            <div class="controls">
              <div class="input-prepend"> <span class="add-on"><?php echo __('ZIP'); ?></span>
                <?php echo form_input($sof_zip); ?> 
              </div>
            </div>
            <!--  /Zip code --> 
            <!--  Phone -->
            <div class="controls">
              <div class="input-prepend"> <span class="add-on"><?php echo __('Ph'); ?></span>
                <?php echo form_input($sof_ph); ?> 
              </div>
            </div>
            <!--  /Phone --> 
            <!--  Country -->
            <div class="controls">
              <div class="input-prepend"> <span class="add-on"><?php echo __('Country'); ?></span>
                <?php echo form_input($sof_country); ?> 
              </div>
            </div>
            <!--  /Country --> 
          </div>
          <!--  /Address --> 
          <!--  Message -->
          <div class="control-group">
            <label class="control-label" for="sof_message"><?php echo __('Message if any'); ?>: </label>
            <div class="controls">
               <?php echo form_textarea($sof_message); ?> 
            </div>
          </div>
          <!--  /Message -->
</div>
 <div class="modal-footer">
  <a href="<?php echo site_url('shopping_cart'); ?>" class="btn back-to-cart" title="<?php echo __('Back to Cart'); ?>"><i class="icon-arrow-left"></i><?php echo __('Back to Cart'); ?></a>
  <?php 
  $submitBtnState = ($totalCartItems <= 0) ? 'disabled' : "";
  echo form_submit('', __("Submit Order"), 'id="submitOrderBtn" class="btn btn-warning process_submit_order '.$submitBtnState.'"'); ?>
</div>
<?php echo form_close(); ?>
<script type="text/javascript">
  $(document).ready(function($) {
    var isAjaxReq = true;
      <?php if(!$isAjaxReq): ?>
      isAjaxReq = false;
     <?php endif; ?>
      $('.back-to-cart').on('click', function(e){
        e.preventDefault();
        $cartModal = $('.submitOrderContainer');
        $cartModal.slideUp();

        $cartModal.html('<div style="padding:10%; text-align:center;">  <img src="<?php echo base_url("assets/img/ajax-loader.gif"); ?>"></br> <?php echo __("Loading..."); ?></div>');
        $cartModal.slideDown();

        var $this = $(this),
           requestURL = $this.attr('href');
           $.post(requestURL, function(data){
                $cartModal.replaceWith(data.page_data);
         },'JSON');
      });

      var isOrderProcessing = false;

      $('#submitOrderForm').on('submit', function(e){
         e.preventDefault();

         if(isOrderProcessing)
          return false;

         var $this = $(this),
           formAction = $this.attr('action'),
           $submitOrderBtn = $('#submitOrderBtn'),
            $backToCart = $('.back-to-cart');

          if($submitOrderBtn.hasClass('disabled'))
             return false;

            isOrderProcessing = true;

          $backToCart.remove();
          $submitOrderBtn.val('<?php echo __("Processing..."); ?>').addClass('disabled');

           $cartModal = isAjaxReq ? $('#cartModal') : $('.submitOrderContainer');

           $.post(formAction, $this.serialize(), function(data){
                if(data.email_result == true){
                   $('#shopping-cart-btn').html(data.cartBtnMarkup);
                   $('#ModelSubmitOrderData').html(data.msg_on_order_submit);
                   $('#submitOrderContainerHeading').text("<?php echo __('Order Submitted Successfully'); ?>");
                   $submitOrderBtn.replaceWith('<button type="button" class="btn btn-warning" data-dismiss="modal" aria-hidden="true" title="<?php echo __("Close Details"); ?>"><?php echo __("Close"); ?></button>');
                }else{
                   isOrderProcessing = false;
                  $cartModal.html(data.page_data);
                  $('#submitOrderContainerHeading').text("<?php echo __('Error Occured. Try Again'); ?>");
                }
         },'JSON');
      });

  });
</script>
</div>