<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
	 * Store Dedicated Config File
	 *
	 * @package		JQuery PHP Store/Shop
	 * @author		Vinod
	 * @copyright	Copyright (c) 2013, LivelyWorks. (http://livelyworks.net)
	 * @link		http://livelyworks.net
	 * @since		Version 1.0
*/

/*your products thumbnails & logo folders parent path should be writable*/
$config['upload_path']					= 'uploads/';
/*your products thumbnails path should be writable*/
$config['thumb_path']					= $config['upload_path'].'thumb/';
/*your logo path should be writable*/
$config['logo_path']					= $config['upload_path'].'logo/';
/*How many products you want to show per page*/
$config['pagination_items_per_page'] 	=  10;

/*select theme from availabe eg.  bootstrap2, bootstrap3, foundation5*/

$config['apply_theme']					= 'bootstrap3';
/*If you set it as true, system will use paypal sandbox site for testing purpuses*/
$config['paypal_testing']				= true;
/*set your available lanaguages here as in given format*/
$config['availableLanguages']			= array(
												'en_US' => 'English',
												'mr_IN' => 'मराठी',
												'fr_FR' => 'français',
												'es_ES' => 'español',
											);
/*set your store default language from above array as given*/
$config['default_language']				= 'en_US';
/*do you want to get order email in your default lanaguage*/
$config['send_order_in_default_language']	= true;