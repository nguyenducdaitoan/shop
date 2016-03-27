<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
/**
	 * edit category form view
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
	'value'	=> $query[0]->name,
	'required'	=> '',
	'class' => 'form-control',
);

$category = array(
'category_id'=>$query[0]->id
);


$form_attributes = array('class' => 'form-horizontal');

$label_attributes = array(
    'class' => 'col-sm-2 col-md-2 col-lg-2 control-label'
);

?>
<div class="row col-sm-12 col-lg-12 col-md-12">
	<h3><?php echo __('Edit Category'); ?></h3><hr>
<?php echo form_open(null, $form_attributes); ?>	

<?php echo form_hidden($category); ?> 

<div class="form-group">
	<?php echo form_label(__('Name'), $category_name['id'],$label_attributes);?>
	<div class="col-sm-8 col-md-7 col-lg-6">
	  	<?php echo form_input($category_name); ?> 
		<?php echo form_error($category_name['name']); ?>
	</div>
</div>


<div class="form-group">
    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-sm-8 col-md-7 col-lg-7">
     <?php echo form_submit('submit', __('Edit Category'),'class="btn btn-primary"'); ?>
	<a href="<?php echo site_url('manage_categories');?>" class="btn btn-default"><?php echo __('Back to Categories'); ?></a>
    </div>
  </div>

<?php echo form_close()?>
</div>