<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
/**
    * product details view
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
  $hidden_data = array(
              'product_id'  => $query['id'],
            );

  $form_ttributes = array(
              'class'  => 'form-inline',
              'id'  => 'addToCart',
              'name'  => 'addToCart',
            );

$product_qty = array(
              'class'   => 'input-mini',
              'id'      => 'product_qty',
              'name'    => 'product_qty',
              'value'   => $qty_in_cart ? $qty_in_cart : 1,
              'style'   => 'width:35px;text-align:center;',
              'required' => '',
              'type'    => 'number',
              'min'     => 1
            );

?>

<?php if($isAjaxReq): ?>
 <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Close Details">&times;</button>
    <h3 id="myModalLabel"><?php echo $query['name']; ?></h3>
    <h4><small> <?php echo __('Category'); ?>: <strong><?php echo $categories_array[$query['category']]; ?></strong> <?php echo __('Product ID'); ?>: <strong><?php echo $query['product_id']; ?></strong> </small><strong class="store-product-price"> &nbsp; <?php echo __('Price'); ?>: <?php echo priceFormat($query['price']); ?></strong> </h4>
  </div>
  <?php else: ?> 
   <h4><small> <?php echo __('Category'); ?>: <strong><?php echo $categories_array[$query['category']]; ?></strong> <?php echo __('Product ID'); ?>: <strong><?php echo $query['product_id']; ?></strong> </small><strong class="store-product-price"> &nbsp; <?php echo __('Price'); ?>: <?php echo priceFormat($query['price']); ?></strong> </h4><hr>
 <?php endif; ?>   
  <div class="<?php echo (!$isAjaxReq) ? '' : 'modal-body'; ?>" id="ModelProductData">
   <p><?php echo html_entity_decode($query['description']); ?></p>
  </div>
  <div class="modal-footer">
    <?php echo form_open('shopping_cart/addToCart', $form_ttributes); 
      echo form_hidden($hidden_data);
    ?>
<?php if(isset($query['sizes_option'])): ?> 
<div class="input-prepend">
  <span class="add-on"><label class="control-label" for="size"> <?php echo __('Select Size'); ?>: </label>  </span> 
<?php echo form_dropdown('size', $query['sizes_option'],null, 'class="input-small" id="size"'); ?>
</div>
<?php endif; ?> <?php if(isset($query['colors_option'])): ?> 
<div class="input-prepend">
  <span class="add-on"><label class="control-label" for="color">&nbsp; <?php echo __('Select Color'); ?>: </label> </span> 
<?php echo form_dropdown('color', $query['colors_option'],null ,'class="input-small" id="color"'); ?>
</div>
<?php endif; ?>
<div class="input-prepend input-append">
  <a href="#" class="btn decrement_qty qty-btn">-</a>
  <?php echo form_input($product_qty); ?>
  <a href="#" class="btn increment_qty qty-btn">+</a>
  <?php if($qty_in_cart > 0): ?>
<button type="submit" name="addToCartBtn" id="addToCartBtn" class="btn btn-warning"> <?php echo __('Update'); ?> <i class="icon-shopping-cart icon-white"></i></button>
<?php else: ?>
<button type="submit" name="addToCartBtn" id="addToCartBtn" class="btn btn-warning"> <?php echo __('Add to'); ?> <i class="icon-shopping-cart icon-white"></i></button>
  <?php endif; ?>
</div>
<?php if($this->tank_auth->is_logged_in()): ?> <a class="btn btn-primary" href="<?php echo site_url("manage_products/edit/".$query['id']); ?>"><i class="icon-edit icon-white"></i><?php echo __('Edit'); ?></a>
  <?php endif; 
echo form_close(); ?>
</div>

<script type="text/javascript">
  $(document).ready(function($) {
    var isAjaxReq = true;
       <?php if(!$isAjaxReq): ?>
      isAjaxReq = false;
     <?php endif; ?>

      var $addToCartBtn = $('#addToCartBtn'),
                $product_qty = $('#product_qty'),
              $shopping_cart_btn = $('#shopping-cart-btn')
                ;

      $('#addToCart').submit(function(e){
        e.preventDefault();

        product_qty = $product_qty.val();

        if(product_qty <= 0)
        return false;

        var $this = $(this),
            formAction = $this.attr('action');

             if($addToCartBtn.hasClass('disabled'))
              return false;

            $addToCartBtn.addClass('disabled');


       $.post(formAction, $this.serialize(),function(data){
              $addToCartBtn.html('<?php echo __("Update"); ?><i class="icon-shopping-cart icon-white"></i>')
              .removeClass('disabled');

              $shopping_cart_btn.html(data.cartBtnString);

       }, "JSON")
       .fail(function(error){

       });

       });

      $('#size,#color').on('change', checkCartForItem);

      function checkCartForItem(){

        $addToCartBtn.addClass('disabled');


        var cartCheckURL = "<?php echo site_url('product/checkOldQty/'.$query['id']); ?>";//+ sizeEl+ '/' + colorEl;

      $.post(cartCheckURL, $('#addToCart').serialize(), function(data){
              $product_qty.val(data.qty ? data.qty : 1);

              if(data.qty > 0){
                 $addToCartBtn.html('<?php echo __("Update"); ?> <i class="icon-shopping-cart icon-white"></i>');
              }else{
                 $addToCartBtn.html('<?php echo __("Add to"); ?> <i class="icon-shopping-cart icon-white"></i>');
              }

              $addToCartBtn.removeClass('disabled');

       }, "JSON")
       .fail(function(error){
          /* if(error)
          console.log(error.responseText);*/
       });

      }

      $('.qty-btn').on('click',function(e){
         e.preventDefault();
          var $this = $(this),
          product_qty_val = Number($product_qty.val());

          if($this.hasClass('increment_qty')){
            $product_qty.val( product_qty_val + 1);
          }else{
            var newQtyVal = (product_qty_val - 1);
            $product_qty.val((newQtyVal <= 0) ? 1 : newQtyVal);
          }
      });
  });
</script>