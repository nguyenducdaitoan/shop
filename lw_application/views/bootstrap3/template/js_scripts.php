<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
/**
   * on page Javascript container 
   *
   * @package    JQuery PHP Store/Shop
   * @author     Vinod
   * @copyright  Copyright (c) 2013, LivelyWorks. (http://livelyworks.net)
   * @link       http://livelyworks.net
   * @since      Version 1.2.0
*/
$currentThemeName = 'bootstrap3/';
?>

<!-- SCIPRTs -->
<script src="<?php echo latestFile('assets/'.$currentThemeName.'js/bootstrap.min.js'); ?>" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo latestFile('assets/'.$currentThemeName.'js/custom.js'); ?>" type="text/javascript" charset="utf-8"></script>
<?php   if(isset($insertJS)): foreach($insertJS as $eachScript): ?>
<script src="<?php echo latestFile('assets/js/'.$eachScript.'.js'); ?>" type="text/javascript" charset="utf-8"></script>
<?php   endforeach; endif; ?>
<?php   if(isset($insertJS)): foreach($insertJS as $eachScript): ?>
<script src="<?php echo latestFile('assets/js/'.$eachScript.'.js'); ?>" type="text/javascript" charset="utf-8"></script>
<?php   endforeach; endif; ?>
<?php if(isset($insertScripts) AND !empty($insertScripts)): ?>
<script type="text/javascript">
$(document).ready(function() {

  <?php if(in_array('js_ajax_details', $insertScripts)): ?>
 /*Ajax Product details in Modal*/
  
      $alert_container =  $('.alert_container');

      $('.show_details_link').on('click', function(e){
        $alert_container.fadeOut();
        e.preventDefault();
            $ModelProductName = $('#cartContent');
            $ModelProductData = $('#cartModal');
            var toURL = $(this).attr('href');

         $ModelProductName.html('<div style="padding:10%; text-align:center;">  <img src="<?php echo base_url("assets/img/ajax-loader.gif"); ?>"></br> <?php echo __("Loading..."); ?></div>');
         $ModelProductData.modal('show');
        $.get(toURL, function(data, textStatus, xhr) {
          if(data.error){
            $alert_container.html('<div class="alert alert-error"> <button type="button" class="close" data-dismiss="alert">&times;</button> <strong><?php echo __("Warning!"); ?></strong> '+ data.error +'</div>').fadeIn();
            return false;
          }
          $ModelProductName.html(data);
        });
      });
  /*Ajax Product details in Modal End*/
  <?php endif; ?>
   <?php if(in_array('js_tags_input', $insertScripts)): ?>
     /*TAGs Input*/
  $("#product_sizes").tagsInput({defaultText:"<?php echo __('add size'); ?>"});
  $("#product_color").tagsInput({defaultText:"<?php echo __('add color'); ?>"});
    /*TAGs Input End*/
  <?php endif; ?>

   <?php if(in_array('js_delete_product', $insertScripts)): ?>
     /*Delete Product*/
  $(".delete_product").on("click",function(e){
    var r=confirm("<?php echo __('Do you really want to delete this Product?'); ?>"); 
    if (r==true)
    window.location = $(this).attr("href"); 
    e.preventDefault();
  });
  /*Delete Product End*/
  <?php endif; ?>

    <?php if(in_array('js_delete_category', $insertScripts)): ?>
     /*Delete Category*/
    $(".delete_category").on("click",function(e){ var r=confirm("<?php echo __('Do you really want to delete this Category? All the products within this category will be deleted!!'); ?>"); if(r==true)window.location = $(this).attr("href");  e.preventDefault(); });
    /*Delete Category End*/
  <?php endif; ?>

  <?php if(in_array('js_ajax_form', $insertScripts)): ?>
     /*AJAX form submit*/
    $('.page-container').on('submit','.ajax-form',ajaxFormRequest);
    function ajaxFormRequest(e){
        e.preventDefault();
         var $this = $(this),
            formAction = $this.attr('action');

             if($this.hasClass('disabled'))
             return false;

            $this.addClass('disabled').attr('disabled', 'disabled');

       $.post(formAction, $this.serialize(),function(data){
              $('.page-container').html(data);
       });
       };
    /*AJAX form submit*/
  <?php endif; ?>
});
</script>
<?php endif; ?>