<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
/**
   * Main template file
   *
   * @package    JQuery PHP Store/Shop
   * @author    Vinod
   * @copyright  Copyright (c) 2013, LivelyWorks. (http://livelyworks.net)
   * @link    http://livelyworks.net
   * @since    Version 1.0
*/
$this->output->set_content_type('text/html', 'utf-8');
$store_settings = storeConfigItem();
$settings = ($store_settings['settings']);
$categories = ($store_settings['categories']);
$page_data['settings'] = $settings;
$page_data['categories'] = $categories;

$current_store_lang = $this->session->userdata('current_store_lang');
$current_store_lang = isset($current_store_lang) ? $current_store_lang : config_item('default_language');

$glo_total = $this->cart->total();
$glo_total_items = $this->cart->total_items();

$topButtomArray = array(
  '%total_items%' => $glo_total_items, 
  '%item_select%' => ($glo_total_items == 1) ? __('item') : __('items'), 
  '%glo_total%' => priceFormat($glo_total, true), 
  );
$cartBtnMarkup = __('<strong>%total_items%</strong> %item_select% of <strong>%glo_total%</strong> in your').' <i class="icon-shopping-cart"></i>';
$cartBtnMarkup =  strtr($cartBtnMarkup, $topButtomArray);

?>
<!DOCTYPE html>
<html lang="<?php echo substr($current_store_lang, 0, 2); ?>">
  <head>
    <meta charset="utf-8">
    <title><?php echo $settings['store_name']; ?> <?php if(isset($page_title)) echo ' - '. $page_title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="<?php echo latestFile('assets/js/html5shiv.min.js'); ?>"></script>
    <![endif]-->
   
   <!-- CSS -->
	 <link rel="stylesheet" href="<?php echo latestFile('assets/css/bootstrap.min.css'); ?>" type="text/css">
	 <link rel="stylesheet" href="<?php echo latestFile('assets/css/bootstrap-responsive.min.css'); ?>" type="text/css">
	 <link rel="stylesheet" href="<?php echo latestFile('assets/css/custom.css'); ?>" type="text/css">
   <link rel="stylesheet" href="<?php echo latestFile('assets/css/footable.core.min.css'); ?>" type="text/css">
	<?php 	if(isset($insertCSS)):	
  $insertCSS = array_filter($insertCSS);
  foreach($insertCSS as $eachCSS): ?>
	<link href="<?php echo latestFile('assets/css/'.$eachCSS.'.css'); ?>" rel="stylesheet">
	<?php 	endforeach;	endif; ?>	

<script src="<?php echo latestFile('assets/js/jquery-1.11.1.min.js'); ?>" type="text/javascript" charset="utf-8"></script>  

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="../assets/ico/favicon.png">

    <style type="text/css" id="modalModifiedStyle"></style>
  </head>

  <body>
    <!-- Part 1: Wrap all page content here -->
    <div id="wrap">
    <div class="store-header"> <a class="brand" href="<?php echo site_url(); ?>"><img src="<?php echo latestFile('uploads/logo/'.$settings['logo']); ?>" alt="<?php echo $this->config->item('store_name'); ?>"></a> <a id="shopping-cart-btn" href="<?php echo site_url('shopping_cart'); ?>" class="btn pull-right shopping-cart-btn" data-toggle="modal" data-target="#cartModal"><?php echo $cartBtnMarkup; ?></a></div>
      <!--  navbar -->
      <div class="navbar">
        <div class="navbar-inner no-border-radius">
          <div class="container-fluid">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <div class="nav-collapse collapse">
              <ul class="nav">
                 <li class="active"><a href="<?php echo base_url(); ?>"><?php echo __('Home'); ?></a></li>
      <?php if(!$this->tank_auth->is_logged_in()): ?>
            <li><a href="<?php echo site_url('auth/login'); ?>"><?php echo __('Login'); ?></a></li>
			  <?php endIf; ?>
              </ul>
               <?php 
               $availableLanguages = config_item('availableLanguages');
               if($this->tank_auth->is_logged_in() OR (isset($availableLanguages) AND count($availableLanguages) > 1)): ?>
              <ul class="nav pull-right">
                  <?php if($this->tank_auth->is_logged_in()): ?>
                 <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo __('Howdy'); ?> <?php echo $this->tank_auth->get_username(); ?> <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="<?php echo site_url('auth/change_password'); ?>"><?php echo __('Change Password'); ?></a></li>
                    <li><a href="<?php echo site_url('auth/change_email'); ?>"><?php echo __('Change Email'); ?></a></li>
                    <li class="divider"></li>
                    <li><a title="logout" href="<?php echo site_url('auth/logout'); ?>"> <i class="icon-off"></i> <?php echo __('Logout'); ?></a></li>
                  </ul>
                </li>
                <?php endIf; ?>
                <?php if(isset($availableLanguages) AND count($availableLanguages) > 1): ?>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $availableLanguages[$current_store_lang]; ?> <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <?php foreach($availableLanguages as $langRow => $langValue): 
                      if($langValue == $availableLanguages[$current_store_lang]) continue;
                    ?>
                      <li><a href="<?php echo site_url($this->uri->uri_string().'?lang='.$langRow); ?>"><?php echo $langValue; ?></a></li>
                    <?php endforeach; ?>
                  </ul>
                </li>
                 <?php endIf; ?>
              </ul>
               <?php endIf; ?>
            </div><!--/.nav-collapse -->
          </div>
        </div>
      </div>
      <!-- Begin page content -->
      <div class="container-fluid main-container">
	  <div class="row-fluid">
	  <div class="span3">
      <?php $this->load->view($apply_theme.'/'.'template/sidebar', $page_data); ?>
	  </div>
	  <div class="span9 page-container">
    <?php if (IS_STORE_DEMO): ?>
        <div class="alert alert-info" style="text-align:center;"><?php echo __('Demo purposes only. Nothing will save!!'); ?></div>
      <?php endif ?>
    <?php if(isset($page_title)) echo '<h3>'.$page_title.'</h3> <hr>'; ?>
	  <?php if(isset($temp_msg)) echo '<div class="alert">'.$temp_msg.'</div>'; ?>
     <?php echo showFlashMsg(); ?>
	<?php 
  if(isset($page))$this->load->view($apply_theme.'/'.$page, $page_data); ?>
    </div>
<div id="cartModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> </div>
	  </div>
</div>
      <div id="push"></div>
    </div>
    <div id="footer">
      <div class="container-fluid">

      <?php 
      $footerTextArray = array(
        '%year%'        => date('Y'), 
        '%store_name%'  => __($settings['store_name']), 
      );

      $footerHeadingMarkup = __('&copy; %year% %store_name%');
      $footerHeadingMarkup =  strtr($footerHeadingMarkup, $footerTextArray);

    ?>
        <p class="muted credit"><?php echo $footerHeadingMarkup; ?> 
        <?php if (config_item('show_lively_cart_credit')): ?><small class="pull-right"><?php echo __('Powered by <a href="http://livelycart.com" title="Powered by LivelyCart" target="_blank">LivelyCart</a> - '.LIVELYCART_VERSION.' by <a href="http://livelyworks.net" title="Design &amp; Developed by LivelyWorks" target="_blank">LivelyWorks</a>') ?></small><?php endif ?>

      </div>
      <?php $this->load->view($apply_theme.'/'.'template/js_scripts');  ?>

  <script type="text/javascript">
      $(document).ready(function($) {
      $(window).on('resize', onResizeWindow);
      function onResizeWindow(){
        var modalModifiedStyle = '.modal-body{max-height:'+($(window).height() * 0.35)+'px;}';
        $('#modalModifiedStyle').html(modalModifiedStyle);
      }

   onResizeWindow();

      $('#shopping-cart-btn, .shopping-cart-btn').on('click', function(e){
        e.preventDefault();
        var $this = $(this),
            $cartModal = $('#cartModal'),
            requestURL = $this.attr('href');
            $cartModal.html('<div style="padding:10%; text-align:center;">  <img src="<?php echo base_url("assets/img/ajax-loader.gif"); ?>"></br> <?php echo __("Loading..."); ?></div>');
           $.post(requestURL, function(data){
                $cartModal.html(data.page_data);
         },'JSON');
      });

    });
  </script>

<script src="<?php echo latestFile('assets/js/footable.min.js'); ?>" type="text/javascript"></script>

  </body>
</html>
<?php //$this->output->enable_profiler(TRUE); ?>