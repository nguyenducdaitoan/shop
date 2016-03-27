<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
/**
   * shopping cart view
   *
   * @package    JQuery PHP Store/Shop
   * @author    Vinod
   * @copyright  Copyright (c) 2013, LivelyWorks. (http://livelyworks.net)
   * @link    http://livelyworks.net
   * @since    Version 1.2
*/
 $isAjaxReq = false;
if($this->input->is_ajax_request()): 
      $isAjaxReq = true;
endif;

?>


<div class="cartContainer" data-backtocart="">
  <?php 

$form_attributes = array('class' => 'form-horizontal ajax-cart-form', 'style' => 'margin:0;');
echo form_open('shopping_cart/update', $form_attributes); ?>
<div class="modal-header">
       <?php if($isAjaxReq): ?>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Close Details">&times;</button>
     <?php endif; ?>
    <h3 id="myModalLabel">Shopping Cart</h3>
  </div><br>
<div class="model-container table-responsive" id="ModelProductData">
 <table class="table table-striped table-bordered table-responsive">
<thead>
<tr>
  <th data-toggle="true" width="20%"><?php echo __('Item Description'); ?></th>
  <th data-hide="phone,tablet" width="15%"><?php echo __('Size'); ?></th>
  <th data-hide="phone,tablet" width="15%"><?php echo __('Color'); ?></th>
  <th data-hide="phone" width="15%"><?php echo __('Price'); ?></th>
  <th data-hide="phone" width="15%"><?php echo __('Qty.'); ?></th>
  <th style="text-align:right;" width="15%"><?php echo __('Sub-Total'); ?></th>
  <th width="5%"><?php echo __('Remove'); ?></th>
</tr>
</thead>
<?php $i = 1; ?>
<tbody>
<?php foreach ($this->cart->contents() as $items): ?>
<tr>
          <td><?php echo $items['name']; ?></td>
            
            <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>

                                         <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
                                                <td><?php echo $option_value; ?></td>
                                        <?php endforeach; ?>

                        <?php endif; ?>
          
          <td><?php echo priceFormat($items['price']); ?></td>
          <td>
           <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
         <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <div class="input-group">
                  <span class="input-group-btn">
                    <button type="submit" class="btn btn-default decrement_qty qty-btn jsr">-</button>
                  </span>
                  <?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5', 'type' => 'number', 'min' => 1, 'class' => 'form-control product_qty product_qty_size text-center')); ?>
                  <span class="input-group-btn">
                    <button type="submit" class="btn btn-default increment_qty qty-btn jsr">+</button>
                  </span>
                </div><!-- /input-group -->
              </div><!-- /.col-lg-6 -->
         </div>
         </td>
          <td style="text-align:right;"><?php echo priceFormat($items['subtotal']); ?></td>
          <td colspan="4"><a class="btn btn-default remove-item" href="<?php echo site_url('shopping_cart/remove/'.$items['rowid']); ?>"><i class="glyphicon glyphicon-remove"></i></a></td>
        </tr>
<?php $i++; ?>
</tbody>
<?php endforeach; ?>
</table>
</div>
 <div class="modal-footer">
<div id="shopping_cart_total" class="alert alert-info" style="text-align:right;"><?php echo __('Base-Total'); ?>: <?php echo priceFormat($this->cart->total()); ?> + <?php echo __('Shipping'); ?>: <?php echo priceFormat(calculateShipping($this->cart->total())); ?> = <strong><?php echo __('Total'); ?>: <?php echo priceFormat($this->cart->total() + calculateShipping($this->cart->total()),true); ?></strong>
<?php echo form_submit('', __('Update'), 'id="updateCartBtn" class="btn btn-default"');?>
</div>

  <a href="<?php echo site_url(); ?>" class="btn btn-default btn-sm cart-btn continue-shopping" class="close" data-dismiss="modal" aria-hidden="true" title="Continue Shopping"><i class="glyphicon glyphicon-arrow-left"></i>&nbsp;<?php echo __('Continue Shopping'); ?></a>
  

<?php if($use_submit_order): ?>
<a href="<?php echo site_url('shopping_cart/checkoutSubmitOrder'); ?>" class="btn btn-warning btn-sm cart-btn checkout_submit_order <?php echo ($totalCartItems <= 0) ? 'disabled' : '' ?>" href="#cartModal"><i><?php echo __('Submit Order'); ?></i> <i class="glyphicon glyphicon-envelope"></i></a>
<?php endif; if($use_paypal):?>
 <a href="<?php echo site_url('shopping_cart/checkoutWithPaypal'); ?>" class="btn btn-warning btn-sm cart-btn checkout_with_paypal <?php echo ($totalCartItems <= 0) ? 'disabled' : '' ?>"><i><?php echo __('Checkout with'); ?></i> <img src="<?php echo latestFile('assets/img/logo_paypal_106x28.png'); ?>"></a>
<?php endif; ?>
</div>
<?php echo form_close(); ?>
<script type="text/javascript">

  $(document).ready(function($) {

   $('.footable').footable();
     
    var isAjaxReq = true;
      <?php if(!$isAjaxReq): ?>
      isAjaxReq = false;
     <?php endif; ?>

   $('.qty-btn').on('click',function(e){
          var $this = $(this),
          $product_qty = $this.parent().parent().find('.product_qty');

          product_qty_val = Number($product_qty.val());

          if($this.hasClass('increment_qty')){
            $product_qty.val( product_qty_val + 1);
          }else{
            var newQtyVal = (product_qty_val - 1);
            $product_qty.val((newQtyVal <= 0) ? 1 : newQtyVal);
          };

      });


   $pageContainer = $('.main-container');
   $('.ajax-cart-form').on('submit',ajaxFormSubmit);

    $('.remove-item').on('click',removeItemRequest);

    $('.checkout_with_paypal').on('click', function(e){
         e.preventDefault();
        var $this = $(this);
         if($this.hasClass('disabled'))
         return false;

         window.location = $this.attr('href');
    });

    function ajaxFormSubmit(e){
        e.preventDefault();

         var $this = $(this),
            formAction = $this.attr('action');

             if($this.hasClass('disabled'))
             return false;

            $this.addClass('disabled').attr('disabled', 'disabled');

       $.post(formAction, $this.serialize(),function(data){
             updateCart(data);
       },'JSON');
       };

       function removeItemRequest(e){

       e.preventDefault();
          var $this = $(this),
           actionURL = $this.attr('href');

            $this.parents('tr').remove();

          $.post(actionURL, function(data){
             updateCart(data);
          },'JSON');
       };

       function updateCart(data){
            $('.cartContainer').replaceWith(data.page_data);

            $('.shopping-cart-btn').html(data.cartBtnMarkup).find('i.icon-shopping-cart').removeClass('icon-shopping-cart').addClass('glyphicon glyphicon-shopping-cart');
      
       };


       

    $('.checkout_submit_order').on('click', function(e){
        e.preventDefault();

        if ($('.cartContainer').data('backtocart') == 'cart') {
          isAjaxReq = false;
        }
        
        var $this = $(this);
        if($this.hasClass('disabled'))
        return false;
        $cartModal = isAjaxReq ? $('#cartModal') :  $('.cartContainer');

        $cartModal.finish().slideUp();
        
        if (isAjaxReq) {
          
          modalContent = 'modal-content';
          modalDialog  = 'modal-dialog';
          $('.cartContainer').data('backtocart','cart');

        } else {
          modalContent = '';
          modalDialog  = '';
          $('.cartContainer').data('backtocart','cart');
          
        }
        $cartModal.html('<div class="'+modalDialog+'"><div class="'+modalContent+'" id="cartContent"><div style="padding:10%; text-align:center;">  <img src="<?php echo base_url("assets/img/ajax-loader.gif"); ?>"></br> Loading...</div></div></div>');
        $cartModal.slideDown();
        var $this = $(this),
            requestURL = $this.attr('href');
            $.post(requestURL, function(data){
              $cartModal.html('<div class="'+modalDialog+'"><div class="'+modalContent+'" id="cartContent">'+data.page_data+'</div></div>');
         
            },'JSON');
      });

  });
</script>
</div>