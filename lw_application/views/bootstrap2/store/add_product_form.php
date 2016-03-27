<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
/**
	 * add product form view
	 *
	 * @package		JQuery PHP Store/Shop
	 * @author		Vinod
	 * @copyright	Copyright (c) 2013, LivelyWorks. (http://livelyworks.net)
	 * @link		http://livelyworks.net
	 * @since		Version 1.0
*/
$thumb = array(
	'name'	=> 'thumb',
	'id'	=> 'thumb',
	'required'	=> '',
);

$product_name = array(
	'name'	=> 'product_name',
	'id'	=> 'product_name',
	'value'	=> set_value('product_name'),
	'required'	=> '',
);

$product_id = array(
	'name'	=> 'product_id',
	'id'	=> 'product_id',
	'value'	=> set_value('product_id'),
	'required'	=> '',
); 

$product_size = array(
	'name'	=> 'product_sizes',
	'id'	=> 'product_sizes',
	'value'	=> set_value('product_sizes'),
);

$product_color = array(
	'name'	=> 'product_color',
	'id'	=> 'product_color',
	'value'	=> set_value('product_color'),
);

$product_price = array(
	'name'	=> 'product_price',
	'id'	=> 'product_price',
	'value'	=> set_value('product_price'),
	'type'	=> 'number',
	'step'	=> 'any',
	'required'	=> '',
);

$product_details = array(
	'name'	=> 'product_details',
	'id'	=> 'product_details',
	'class'	=> 'ckeditor',
	'value'	=> set_value('product_details'),
	'required'	=> '',
);

$categories = array(
	'name'	=> 'category',
	'id'	=> 'category',
	'required'	=> '',
	//'value' => ($query['currency'])
); 


$form_attributes = array('class' => 'form-horizontal');

$label_attributes = array(
    'class' => 'control-label'
);

?>
<div class="row-fluid">
<?php echo form_open_multipart('manage_products/add/'.$selectedCategory, $form_attributes); ?>	
<fieldset>
<legend>Add New Product</legend>
<div class="control-group">
	<?php echo form_label(__('Name'), $product_name['id'],$label_attributes);?>
	<div class="controls">
		<?php echo form_input($product_name); ?> 
		<?php echo form_error($product_name['name']); ?>
	</div>
</div>
<div class="control-group">
	<?php echo form_label(__('Product ID'), $product_id['id'],$label_attributes);?>
	<div class="controls">
		<?php echo form_input($product_id); ?> 
		<?php echo form_error($product_id['name']); ?>
	</div>
</div>
<div class="control-group">
	<?php echo form_label(__('Category'), $categories['id'],$label_attributes);?>
	<div class="controls">
		<?php echo  form_dropdown($categories['name'], $all_categories, $selectedCategory);  ?> 
		<span><a class="btn btn-primary btn-mini" href="<?php echo site_url('manage_categories/add'); ?>"><?php echo __('Add Category'); ?></a></span>
		<?php echo form_error($categories['name']); ?>
	</div>
</div>
<div class="control-group">
	<?php echo form_label(__('Thumbnail'), $thumb['id'], $label_attributes);?>
	<div class="controls">
		<?php echo form_upload($thumb); ?> 
		<?php echo form_error($thumb['name']); ?>
	</div>
</div>
<div class="control-group">
	<?php echo form_label(__('Price'), $product_price['id'], $label_attributes);?>
	<div class="controls">
              <div class="input-prepend input-append">
                <span class="add-on"><?php echo $query['currency_symbol']?></span><?php echo form_input($product_price); ?><span class="add-on"><?php echo $query['currency']?></span>
              </div>
		<?php echo form_error($product_price['name']); ?>
            </div>
</div>
<div class="control-group">
	<?php echo form_label(__('Product Details'), $product_details['id'], $label_attributes);?>
	<div class="controls">
		<?php echo form_textarea($product_details); ?> 
		<?php echo form_error($product_details['name']); ?>
	</div>
</div>
<div class="control-group">
	<?php echo form_label(__('Product Sizes'), $product_size['id'], $label_attributes);?>
	<div class="controls">
		<?php echo form_textarea($product_size); ?> 
		<?php echo form_error($product_size['name']); ?>
	</div>
</div>
<div class="control-group">
	<?php echo form_label(__('Product Colors'), $product_color['id'], $label_attributes);?>
	<div class="controls">
		<?php echo form_textarea($product_color); ?> 
		<?php echo form_error($product_color['name']); ?>
	</div>
</div>
</fieldset>
<div class="form-actions">
	<?php echo form_submit('submit', __('Add Product'),'class="btn btn-primary"'); ?>
</div>
<?php echo form_close()?>
</div>