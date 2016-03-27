<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
/**
   * manage products view
   *
   * @package   JQuery PHP Store/Shop
   * @author    Vinod
   * @copyright Copyright (c) 2013, LivelyWorks. (http://livelyworks.net)
   * @link      http://livelyworks.net
   * @since     Version 1.1
*/
?>
<div class="alert_container hide"></div>
<div class="btn-group navbar-right shortby">
  <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">
    <?php echo __('Sort by'); ?>: <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
    <li><a class="sort_items" href="<?php echo $my_segment_url;?>&sortBy=name&sort=<?php echo $sort_type ?>"><?php echo __('Name'); ?></a></li>
    <li><a class="sort_items" href="<?php echo $my_segment_url;?>&sortBy=price&sort=<?php echo $sort_type ?>"><?php echo __('Price'); ?></a></li>
    <li><a class="sort_items" href="<?php echo $my_segment_url;?>&sortBy=description&sort=<?php echo $sort_type ?>"><?php echo __('Description'); ?></a></li>
  </ul>
</div>
<div>
<div class="custom-product row custom-btn-sort">
<?php if(isset($product_query)):  foreach ($product_query as $row): ?>

<div class="col-lg-2 col-md-3 col-sm-4 col-xs-4 thumb thumb-image-view">
    <div class="thumbnail text-center">
        <div class="thumb-image">
      <a title="<?php echo $row->name; ?>" class="show_details_link" href="<?php echo site_url('product/details/'.$row->id); ?>/<?php echo url_title($row->name, '-', true); ?>"><img src="<?php echo latestFile('uploads/thumb/'.$row->thumbnail); ?>" class="img-responsive" alt=""></a>
      </div>
      <div class="caption"></div>
        <h4 title="<?php echo $row->name; ?>"><?php echo character_limiter($row->name, 6); ?></h4>
        <h3 class="store-product-price"><?php echo priceFormat($row->price); ?></h3>
        <a title="<?php echo $row->name; ?>" href="<?php echo site_url('product/details/'.$row->id); ?>/<?php echo url_title($row->name, '-', true); ?>" class="btn btn-warning btn-sm show_details_link"><?php echo __('View Details'); ?></a>
      </div>
  </div>
<?php endforeach; else: ?>
<div class="alert alert-info"><?php echo __('There are no products to show!!'); ?></div>
<?php endif; ?>
</div>
<div class="row">

<div class="pull-right">
   <?php echo $this->pagination->create_links(); ?>
</div>
   
</div>
<script>
  /*! Equal Heights */
var currentTallest=0,currentRowStart=0,rowDivs=new Array(),$el,topPosition=0;$(".thumb-image-view").each(function(){$el=$(this);topPostion=$el.position().top;if(currentRowStart!=topPostion){for(currentDiv=0;currentDiv<rowDivs.length;currentDiv++){rowDivs[currentDiv].height(currentTallest)}rowDivs.length=0;currentRowStart=topPostion;currentTallest=$el.height();rowDivs.push($el)}else{rowDivs.push($el);currentTallest=(currentTallest<$el.height())?($el.height()):(currentTallest)}for(currentDiv=0;currentDiv<rowDivs.length;currentDiv++){rowDivs[currentDiv].height(currentTallest)}});
</script>