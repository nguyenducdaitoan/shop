<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
/**
	 * manage categories view
	 *
	 * @package		JQuery PHP Store/Shop
	 * @author		Vinod
	 * @copyright	Copyright (c) 2013, LivelyWorks. (http://livelyworks.net)
	 * @link		http://livelyworks.net
	 * @since		Version 1.0
*/
?>
<div class="row-fluid">
<h3><?php echo __('Manage Categories'); ?></h3>
<div class="pull-right"><a class="btn btn-primary btn-mini" href="<?php echo site_url('manage_products/add'); ?>"><?php echo __('Add Product'); ?></a>   <a class="btn btn-primary btn-mini" href="<?php echo site_url('manage_categories/add'); ?>"><?php echo __('Add Category'); ?></a></div>
<table class="table table-striped">
<thead>
    <tr>
      <th><?php echo __('Name'); ?></th>
	  <th><?php echo __('Products'); ?></th>	  
      <th><?php echo __('Action'); ?></th>
    </tr>
  </thead>
  <tbody>
<?php if($query): foreach($query as $row): ?>
<tr>
<td><a href="<?php echo site_url("manage_products/show/".$row->id); ?>"><?php echo $row->name; ?></a></td>
<td><a href="<?php echo site_url("manage_products/add/".$row->id); ?>"><?php echo __('Add Products'); ?></a></td>
<td><a class="btn" href="<?php echo site_url("manage_categories/edit/".$row->id); ?>"><i class="icon-edit"></i> <?php echo __('Edit'); ?></a>   <a class="btn btn-danger delete_category" href="<?php echo site_url("manage_categories/delete/".$row->id); ?>"><i class="icon-remove icon-white"></i> <?php echo __('Delete'); ?></a>

</td>
</tr>
<?php endforeach; endif; ?>
</tbody>
</table>
</div>