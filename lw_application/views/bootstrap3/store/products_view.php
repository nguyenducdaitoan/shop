<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
/**
	 * products view
	 *
	 * @package		JQuery PHP Store/Shop
	 * @author		Vinod
	 * @copyright	Copyright (c) 2013, LivelyWorks. (http://livelyworks.net)
	 * @link		http://livelyworks.net
	 * @since		Version 1.0
*/
?>
<div class="row col-xs-12 col-sm-12 col-lg-12 col-md-12">
<h3><?php echo __('Manage Products'); ?> <?php 
if($query):
if(isset($category_specifc)) echo ' from '.$query[0]->cat_name; ?></h3><hr>
<div class="navbar-right"><a class="btn btn-primary btn-xs cart-btn" href="<?php echo site_url('manage_products/add/'.$category_specifc); ?>"><?php echo __('Add Product'); ?></a>   <a class="btn btn-primary btn-xs cart-btn" href="<?php echo site_url('manage_categories/add'); ?>"><?php echo __('Add Category'); ?></a></div>
<table class="table table-striped table-bordere">
<thead>
    <tr>
      <th><a class="sort_items" href="<?php echo $my_segment_url;?>&sortBy=name&sort=<?php echo $sort_type ?>"><?php echo __('Name'); ?></a></th>
	  <th><a class="sort_items" href="<?php echo $my_segment_url;?>&sortBy=cat_name&sort=<?php echo $sort_type ?>"><?php echo __('Category'); ?></a></th>	  
      <th><?php echo __('Action'); ?></th>
    </tr>
  </thead>
  <tbody>
<?php foreach($query as $row): ?>
<tr>
<td><a class="show_details_link" href="<?php echo site_url('product/details/'.$row->id); ?>"><?php echo $row->name; ?></a></td>
<td><a href="<?php echo site_url("manage_products/show/".$row->cat_id); ?>"><?php echo $row->cat_name; ?></a></td>
<td><a class="btn btn-default btn-xs cart-btn" href="<?php echo site_url("manage_products/edit/".$row->id); ?>"><i class="glyphicon glyphicon-edit"></i> <?php echo __('Edit'); ?></a>    <a class="btn btn-danger btn-xs delete_product cart-btn" href="<?php echo site_url("manage_products/delete/".$row->id); ?>"><i class="glyphicon glyphicon-remove icon-white"></i> <?php echo __('Delete'); ?></a></td>

</tr>
<?php endforeach; else:?>
</h3><div class="navbar-right"><a class="btn btn-primary btn-xs" href="<?php echo site_url('manage_products/add'); ?>"><?php echo __('Add Product'); ?></a>   <a class="btn btn-primary btn-xs" href="<?php echo site_url('categories/add'); ?>"><?php echo __('Add Category'); ?></a></div>
<?php endif; ?>
</tbody>
</table>
<?php echo $this->pagination->create_links(); ?>
</div>