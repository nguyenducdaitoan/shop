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
	'class' => 'form-control',
);

$form_attributes = array('class' => 'form-horizontal');

$label_attributes = array(
    'class' => 'col-sm-2 col-md-2 col-lg-2 control-label'
);

?>
<div class="row col-sm-12 col-md-12 col-lg-12">
<h3><?php echo __('Add New Category'); ?></h3><hr>
<?php echo form_open('manage_categories/add', $form_attributes); ?>	

<div class="form-group">
	<?php echo form_label(__('Name'), $category_name['id'],$label_attributes);?>
	<div class="col-sm-6 col-md-4 col-lg-4">
	  	<?php echo form_input($category_name); ?> 
		<?php echo form_error($category_name['name']); ?>
	</div>
</div>

<div class="form-group">
<div class="col-lg-offset-2 col-sm-offset-2 col-md-offset-2 col-sm-10 col-md-10 col-lg-10">
      <?php echo form_submit('submit',__('Add Category'),'class="btn btn-primary"'); ?>
	<a href="<?php echo site_url('manage_categories');?>" class="btn btn-default"><?php echo __('Back to Categories'); ?></a>
    </div>
  </div>

<?php echo form_close()?>
</div>