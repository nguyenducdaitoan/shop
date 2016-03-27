<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
/**
   * Template Sidebar
   *
   * @package    JQuery PHP Store/Shop
   * @author    Vinod
   * @copyright  Copyright (c) 2013, LivelyWorks. (http://livelyworks.net)
   * @link    http://livelyworks.net
   * @since    Version 1.2.0
*/
?>
<div id="sidebar" role="navigation">
  
  <?php 
  if($this->tank_auth->is_logged_in()): ?>
       <div class="well sidebar-nav">
	   <h4><?php echo __('Admin Area'); ?></h4>
     <hr>
	   <ul class="nav">
      <li><a href="<?php echo site_url('settings/storeSettings'); ?>"><?php echo __('Store Settings'); ?></a></li>
          </ul>
          <h5><?php echo __('Products'); ?></h5>
          <ul>
			       <li><a href="<?php echo site_url('manage_categories'); ?>"><?php echo __('Manage Categories'); ?></a></li>
            <li><a href="<?php echo site_url('manage_products'); ?>"><?php echo __('Manage Products'); ?></a></li>
            <li><a href="<?php echo site_url('manage_products/add'); ?>"><?php echo __('Add Product'); ?></a></li>
            <li><a href="<?php echo site_url('manage_categories/add'); ?>"><?php echo __('Add Category'); ?></a></li>
          </ul>
          <h5><?php echo __('Admin Settings'); ?> </h5>
          <ul>
            <li><a href="<?php echo site_url('auth/change_password'); ?>"><?php echo __('Change Password'); ?></a></li>
			<li><a href="<?php echo site_url('auth/change_email'); ?>"><?php echo __('Change Email'); ?></a></li>
            <li><a href="<?php echo site_url('auth/logout'); ?>"><?php echo __('Logout'); ?></a></li>
          </ul>
        </div>
         <?php endIf; ?>

         <div class="panel panel-default">
  <div class="panel-heading"><?php echo __('Product Search'); ?></div>
  <div class="panel-body">
  <form action="<?php echo site_url('product/search'); ?>" accept-charset="utf-8" class="form-horizontal" method="GET">
  <div class="row input-search">
  <div class="col-md-11">
    <div class="input-group">
      <input type="text" name="search_query" class="form-control col-lg-4" value="<?php echo isset($last_search_query) ? $last_search_query : ''; ?>">
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit"><?php echo __('Search'); ?></button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div>
</form>
  </div>
</div>

          <div class="well">
 <h4><?php echo __('Categories'); ?></h4>
 <div class="list-group">
  <a class="list-group-item <?php echo (isset($currentCategory) and ($currentCategory == 0)) ? 'active' : ''; ?>" href="<?php echo site_url('product/'); ?>"><?php echo __('All Products'); ?> <i class="glyphicon glyphicon-arrow-right pull-right"></i></a>
   <?php if(isset($categories)): foreach($categories as $row): ?>
    <a class="list-group-item <?php echo (!empty($currentCategory) and ($currentCategory == $row->id)) ? 'active' : ''; ?>" href="<?php echo site_url('product/category/'.$row->id.'/'.url_title($row->name,"-",true)); ?>"><?php echo $row->name; ?> <i class="glyphicon glyphicon-arrow-right pull-right"></i></a>
    <?php endforeach; endIf; ?>
</div>
</div>
		  </div>
