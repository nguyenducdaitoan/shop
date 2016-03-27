<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
/**
   * Template Sidebar
   *
   * @package    JQuery PHP Store/Shop
   * @author    Vinod
   * @copyright  Copyright (c) 2013, LivelyWorks. (http://livelyworks.net)
   * @link    http://livelyworks.net
   * @since    Version 1.0
*/
?>
<div class="sidebar">
  <?php 
  if($this->tank_auth->is_logged_in()): ?>
       <div class="well sidebar-nav">
	   <h4><?php echo __('Admin Area'); ?></h4>
     <hr>
	   <ul>
      <li><a href="<?php echo site_url('settings/storeSettings'); ?>"><?php echo __('Store Settings'); ?></a></li>
          </ul>
          <h5><?php echo __('Products'); ?></h5>
          <ul>
			<li><a href="<?php echo site_url('manage_categories'); ?>"><?php echo __('Manage Categories'); ?></a></li>
            <li><a href="<?php echo site_url('manage_products'); ?>"><?php echo __('Manage Products'); ?></a></li>
            <li><a href="<?php echo site_url('manage_products/add'); ?>"><?php echo __('Add Product'); ?></a></li>
            <li><a href="<?php echo site_url('manage_categories/add'); ?>"><?php echo __('Add Category'); ?></a></li>
          </ul>
          <h5><?php echo __('Admin Settings'); ?></h5>
          <ul>
            <li><a href="<?php echo site_url('auth/change_password'); ?>"><?php echo __('Change Password'); ?></a></li>
			<li><a href="<?php echo site_url('auth/change_email'); ?>"><?php echo __('Change Email'); ?></a></li>
            <li><a href="<?php echo site_url('auth/logout'); ?>"><?php echo __('Logout'); ?></a></li>
          </ul>
        </div>
         <?php endIf; ?>

          <div class="well">
    <ul class="nav nav-list">
  <li class="nav-header"><?php echo __('Search'); ?></li>
<form action="<?php echo site_url('product/search'); ?>" accept-charset="utf-8" class="form-search" method="GET">
  <div class="input-append">
    <input type="text" name="search_query" class="span6 search-query" value="<?php echo isset($last_search_query) ? $last_search_query : ''; ?>">
    <button type="submit" class="btn"><?php echo __('Search'); ?></button>
  </div>
</form>
 </ul>
<hr>
             <li class="nav-header"><?php echo __('Categories'); ?></li>
             <ul class="nav nav-list">
              <li> <a href="<?php echo site_url('product/'); ?>"><?php echo __('All Products'); ?></a></li>
              <?php if(isset($categories)): foreach($categories as $row): ?>
              <li> <a href="<?php echo site_url('product/category/'.$row->id.'/'.url_title($row->name,"-",true)); ?>"><?php echo $row->name; ?></a></li>
              <?php endforeach; endIf; ?>
             </ul>
          </div>
		  </div>
