<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
/**
	 * edit product form view
	 *
	 * @package		JQuery PHP Store/Shop
	 * @author		Vinod
	 * @copyright	Copyright (c) 2013, LivelyWorks. (http://livelyworks.net)
	 * @link		http://livelyworks.net
	 * @since		Version 1.0
*/
$product= $products_query[0];
$thumb = array(
	'name'	=> 'thumb',
	'id'	=> 'thumb',
);

$product_name = array(
	'name'	=> 'product_name',
	'id'	=> 'product_name',
	'value'	=> set_value('product_name') ? set_value('product_name') : $product->name,
	'required'	=> '',
);

$product_id = array(
	'name'	=> 'product_id',
	'id'	=> 'product_id',
	'value'	=> set_value('product_id') ? set_value('product_id') : $product->product_id,
	'required'	=> '',
); 

$product_size = array(
	'name'	=> 'product_sizes',
	'id'	=> 'product_sizes',
	'value'	=> set_value('product_sizes') ? set_value('product_sizes') : $product->sizes,
);

$product_color = array(
	'name'	=> 'product_color',
	'id'	=> 'product_color',
	'value'	=> set_value('product_color') ? set_value('product_color') : $product->colors,
);

$product_price = array(
	'name'	=> 'product_price',
	'id'	=> 'product_price',
	'value'	=> set_value('product_price') ? set_value('product_price') : $product->price,
	'type'	=> 'number',
	'step'	=> 'any',
	'required'	=> '',
);

$product_details = array(
	'name'	=> 'product_details',
	'id'	=> 'product_details',
	'class'	=> 'ckeditor',
	'value'	=> set_value('product_details') ? set_value('product_details') : $product->description,
	'required'	=> '',
);

$categories = array(
	'name'	=> 'category',
	'id'	=> 'category',
	'required'	=> '',
	//'value' => ($query['currency'])
); 

$productID = array(
	'productID'=>$product->id
);


$form_attributes = array('class' => 'form-horizontal');

$label_attributes = array(
    'class' => 'control-label'
);

?>
<div class="row-fluid">
<?php echo form_open_multipart('manage_products/edit/'.$product->id, $form_attributes); ?>	
<fieldset>
<legend><?php echo __('Edit'); ?> <?php echo $product->name ?></legend>
<?php echo form_hidden($productID); ?> 
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
		<?php echo  form_dropdown($categories['name'], $all_categories, set_value('category') ? set_value('category') : $product->category );  ?> 
		<?php echo form_error($categories['name']); ?>
	</div>
</div>
<div class="control-group">
	<?php echo form_label(__('Thumbnail'), $thumb['id'], $label_attributes);?>
	<div class="controls">
		<?php echo form_upload($thumb); ?> 
		<?php echo form_error($thumb['name']); ?>
		<span class="help-inline"><?php echo __('Current Thumbnail'); ?>: <a href="<?php echo latestFile('uploads/thumb/'.$product->thumbnail); ?>" target="_blank"> <strong><?php echo $product->thumbnail; ?>  </strong></a></span>
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
	<?php echo form_submit('submit', __('Update Product'),'class="btn btn-primary"'); ?>
	<a href="<?php echo site_url('product/details/'.$product->id); ?>" class="btn show_details_link"> <?php echo __('View Product'); ?></a>
</div>
<?php echo form_close()?>
</div>