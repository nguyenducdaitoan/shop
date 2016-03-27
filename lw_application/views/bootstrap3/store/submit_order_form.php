<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
/**
   * submit order by email form view
   *
   * @package    JQuery PHP Store/Shop
   * @author    Vinod
   * @copyright  Copyright (c) 2013, LivelyWorks. (http://livelyworks.net)
   * @link    http://livelyworks.net
   * @since    Version 1.1
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
  'class' => 'form-control',
);

$lname = array(
  'name'  => 'lname',
  'id'  => 'lname',
  'value' => set_value('lname'),
  'class'  => 'input-small',
  'placeholder'=> __('Last Name'),
  'class' => 'form-control',
);

$sof_bname = array(
  'name'  => 'sof_bname',
  'id'  => 'sof_bname',
  'class'  => 'input-xlarge',
  'value' => set_value('sof_bname'),
  'class' => 'form-control',
);

$sof_email = array(
  'name'  => 'sof_email',
  'type'  => 'email',
  'id'  => 'sof_email',
  'value' => set_value('sof_email'),
  'class'  => 'input-xlarge',
  'required'  => '',
  'class' => 'form-control',
);

$sof_add = array(
  'name'  => 'sof_add',
  'id'  => 'sof_add',
  'value' => set_value('sof_add'),
  'class' => 'form-control',
);

$sof_city = array(
  'name'  => 'sof_city',
  'id'  => 'sof_city',
  'value' => set_value('sof_city'),
  'class' => 'form-control',
);

$sof_zip = array(
  'name'  => 'sof_zip',
  'id'  => 'sof_zip',
  'value' => set_value('sof_zip'),
  'class' => 'form-control',
);

$sof_ph = array(
  'name'  => 'sof_ph',
    'type'  => 'tel',
  'id'  => 'sof_ph',
  'value' => set_value('sof_ph'),
  'class' => 'form-control',
);

$sof_country = array(
  'name'  => 'sof_country',
  'id'  => 'sof_country',
  'value' => set_value('sof_country'),
  'class' => 'form-control',
);

$sof_message = array(
  'name'  => 'sof_message',
  'id'  => 'sof_message',
  'value' => set_value('sof_message'),
  'class'  => 'input-xlarge',
  'class' => 'form-control',
);

?>
<div class="submitOrderContainer">
<div class="modal-header clearfix">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Close Details">×</button>
<h3 id="submitOrderContainerHeading"><?php echo form_hidden('hidden',''); echo __('We need some details'); ?></h3>
</div>
<?php 
      $form_attributes = array('id' => 'submitOrderForm', 'class' => 'form-horizontal', 'style' => 'margin:0;');
      echo form_open('shopping_cart/checkoutSubmitOrder', $form_attributes);
    ?>
<div class="clearfix">
  <div class="col-sm-12 col-md-12 col-lg-12" id="ModelSubmitOrderData"><br>
    <!--  Name -->
      <div class="form-group">
          <label for="fname" class="col-sm-3 col-md-3 col-lg-3 control-label"><?php echo __('Name'); ?>: </label>
          <div class="col-sm-3 col-md-3 col-lg-3">
            <?php echo form_input($fname); ?> 
          </diV>
          <div class="col-sm-3 col-md-3 col-lg-3">
            <?php echo form_input($lname); ?> 
          </div>
            <?php echo form_error('fname'); ?>
      </div>
    <!--  /Name --> 
          <!--  Business Name -->
          <div class="form-group">
            <label for="sof_bname" class="col-sm-3 col-md-3 col-lg-3 control-label"><?php echo __('Business Name'); ?>: </label>
            <div class="col-sm-6 col-md-6 col-lg-6">
             <?php echo form_input($sof_bname); ?> 
            </div>
          </div>
    <!--  /Business Name --> 
    <!--  Email -->
    <div class="form-group">
            <label for="sof_email" class="col-sm-3 col-md-3 col-lg-3 control-label"><?php echo __('Email'); ?>: </label>
            <div class="col-sm-6 col-md-6 col-lg-6">
             <?php echo form_input($sof_email); ?> 
              <?php echo form_error('sof_email'); ?>
            </div>
          </div>
          <!--  /Email --> 
          <!--  Address -->
          <div class="form-group">
<label for="sof_add" class="col-sm-3 col-md-3 col-lg-3 control-label"><?php echo __('Address'); ?>: </label>
            <div class="col-sm-6 col-md-6 col-lg-6">
             <div class="input-group">
              <span class="input-group-addon"><?php echo __('Street'); ?></span>
              <?php echo form_input($sof_add); ?>
            </div>
            </div>
          </div>
            <!--  /Street --> 
            <!--  City -->
      <div class="form-group">
              <label for="" class="col-sm-3 col-md-3 col-lg-3 control-label"></label>
              <div class="col-sm-6 col-md-6 col-lg-6">
               <div class="input-group">
                <span class="input-group-addon"><?php echo __('City'); ?></span>
                <?php echo form_input($sof_city); ?> 
              </div>
              </div>
            </div>

            <!--  /City --> 
            <!--  Zip code -->
            <div class="form-group">
<label for="" class="col-sm-3 col-md-3 col-lg-3 control-label"></label>
              <div class="col-sm-6 col-md-6 col-lg-6">
               <div class="input-group">
                <span class="input-group-addon"><?php echo __('ZIP'); ?></span>
                <?php echo form_input($sof_zip); ?> 
              </div>
              </div>
            </div>

            <!--  /Zip code --> 
            <!--  Phone -->

            <div class="form-group">
<label for="" class="col-sm-3 col-md-3 col-lg-3 control-label"></label>
              <div class="col-sm-6 col-md-6 col-lg-6">
               <div class="input-group">
                <span class="input-group-addon"><?php echo __('Ph'); ?></span>
                <?php echo form_input($sof_ph); ?>
              </div>
              </div>
            </div>
            <!--  /Phone --> 
            <!--  Country -->
            <div class="form-group">
<label for="" class="col-sm-3 col-md-3 col-lg-3 control-label"></label>
              <div class="col-sm-6 col-md-6 col-lg-6">
               <div class="input-group">
                <span class="input-group-addon"><?php echo __('Country'); ?></span>
                <?php echo form_input($sof_country); ?> 
              </div>
              </div>
            </div>

            <!--  /Country --> 

          
          <!--  /Address --> 
          <!--  Message -->
          <div class="form-group">
 <label for="sof_message" class="col-sm-3 col-md-3 col-lg-3 control-label"><?php echo __('Message if any'); ?>: </label>
              <div class="col-sm-8 col-md-8 col-lg-8">
                <?php echo form_textarea($sof_message); ?>
            </div>
            </div>
          <!--  /Message -->

  </div>

</div>

<div class="modal-footer">
  <a href="<?php echo site_url('shopping_cart'); ?>" class="btn btn-default cart-btn back-to-cart" title="<?php echo __('Back to Cart'); ?>"><i class="glyphicon glyphicon-arrow-left"></i> <?php echo __('Back to Cart'); ?></a>
  <?php 
  $submitBtnState = ($totalCartItems <= 0) ? 'disabled' : "";
echo form_submit('', __("Submit Order"), 'id="submitOrderBtn" class="btn btn-warning cart-btn process_submit_order '.$submitBtnState.'"'); ?>
</div>
<?php echo form_close(); ?>

</div>

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
          formAction       = $this.attr('action'),
          $submitOrderBtn  = $('#submitOrderBtn'),
          $backToCart      = $('.back-to-cart');

          if($submitOrderBtn.hasClass('disabled'))
             return false;

            isOrderProcessing = true;

          $backToCart.remove();
          $submitOrderBtn.val('<?php echo __("Processing..."); ?>').addClass('disabled');

           $cartModal = isAjaxReq ? $('#cartModal') : $('.submitOrderContainer');

           $.post(formAction, $this.serialize(), function(data){
              if(data.email_result == true){
                  $('.shopping-cart-btn').html(data.cartBtnMarkup);
                  $('#ModelSubmitOrderData').html(data.msg_on_order_submit);
                  $('#submitOrderContainerHeading').text("<?php echo __('Order Submitted Successfully'); ?>");
                  $submitOrderBtn.replaceWith('&nbsp;');
              }else{
                  isOrderProcessing = false;
                  $cartModal.html(data.page_data);
                  $('#submitOrderContainerHeading').text("<?php echo __('Error Occured. Try Again'); ?>");
                }
         },'JSON');
      });
  });
</script>