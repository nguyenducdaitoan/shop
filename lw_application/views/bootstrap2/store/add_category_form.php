<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
/**
	 * add category form view
	 *
	 * @package		JQuery PHP Store/Shop
	 * @author		Vinod
	 * @copyright	Copyright (c) 2013, LivelyWorks. (http://livelyworks.net)
	 * @link		http://livelyworks.net
	 * @since		Version 1.0
*/
$category_name = array(
	'name'	=> 'category_name',
	'id'	=> 'category_name',
	'value'	=> set_value('category_name'),
	'required'	=> '',
);

$form_attributes = array('class' => 'form-horizontal');

$label_attributes = array(
    'class' => 'control-label'
);

?>
<div class="row-fluid">
<?php echo form_open('manage_categories/add', $form_attributes); ?>	
<fieldset>
<legend><?php echo __('Add New Category'); ?></legend>
<div class="control-group">
	<?php echo form_label(__('Name'), $category_name['id'],$label_attributes);?>
	<div class="controls">
		<?php echo form_input($category_name); ?> 
		<?php echo form_error($category_name['name']); ?>
	</div>
</div>
</fieldset>
<div class="form-actions">
	<?php echo form_submit('submit',__('Add Category'),'class="btn btn-primary"'); ?>
	<a href="<?php echo site_url('manage_categories');?>" class="btn"><?php echo __('Back to Categories'); ?></a>
</div>
<?php echo form_close()?>
</div>