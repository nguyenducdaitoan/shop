<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
/**
   * manage products view
   *
   * @package    JQuery PHP Store/Shop
   * @author    Vinod
   * @copyright  Copyright (c) 2013, LivelyWorks. (http://livelyworks.net)
   * @link    http://livelyworks.net
   * @since    Version 1.0
*/
?>
<div class="alert_container hide"></div>
<div class="btn-group pull-right">
  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
    <?php echo __('Sort by'); ?>: <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
    <li><a class="sort_items" href="<?php echo $my_segment_url;?>&sortBy=name&sort=<?php echo $sort_type ?>"><?php echo __('Name'); ?></a></li>
    <li><a class="sort_items" href="<?php echo $my_segment_url;?>&sortBy=description&sort=<?php echo $sort_type ?>"><?php echo __('Description'); ?></a></li>
  </ul>
</div><br><br>
<div><ul class="thumbnails">
<?php if(isset($product_query)):	foreach ($product_query as $row): ?>
<li class="thumbnail-holder">
    <div class="thumbnail">
      <div class="thumb-image"><a class="show_details_link" href="<?php echo site_url('product/details/'.$row->id.'/'.url_title($row->name,"-",true)); ?>"><img src="<?php echo latestFile('uploads/thumb/'.$row->thumbnail); ?>" alt=""></a></div>
      <h4 title="<?php echo $row->name; ?>"><?php echo character_limiter($row->name, 10); ?></h4>
      <h3 class="store-product-price"><?php echo priceFormat($row->price); ?></h3>
      <a href="<?php echo site_url('product/details/'.$row->id.'/'.url_title($row->name,"-",true)); ?>" class="btn btn-warning btn-small show_details_link"><?php echo __('View Details'); ?></a>
    </div>
  </li>
<?php endforeach; else: ?>
<div class="alert alert-warning"><?php echo __('There are no products to show!!'); ?></div>
<?php endif; ?>
</ul></div>
<?php echo $this->pagination->create_links(); ?>