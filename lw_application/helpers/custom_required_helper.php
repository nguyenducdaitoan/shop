<?php 
/**
 * Store required helper functions for simplyfing tasks
 *
 * PHP version 5.2.4 or newer
 *
 * @category   HelperFile
 * @package    JQueryPHPStoreShop
 * @author     Vinod <livelyworks@gmail.com>
 * @copyright  2013 LivelyWorks. (http://livelyworks.net)
 * @license    LivelyWorks (http://livelyworks.net)
 * @link       http://livelyworks.net
 * @since      Version 1.0
 * @deprecated NA
 */


if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * Store Products Controller
 *
 * @category   HelperFile 
 * @package    JQueryPHPStoreShop
 * @author     Vinod <livelyworks@gmail.com>
 * @copyright  2013 LivelyWorks. (http://livelyworks.net)
 * @license    LivelyWorks (http://livelyworks.net)
 * @link       http://livelyworks.net
 * @since      Version 1.0
 * @deprecated NA
 */

if (!function_exists('loadView')) {
    /**
     * Simpliyfied View loading function
     *
     * @param array   $data          available data     
     * @param string  $dataType      output datatype
     * @param boolean $preventOutput prevent output
     *    
     * @return void
    */
    function loadView($data, $dataType = "html", $preventOutput = false)
    {

        $CI =& get_instance();

        $config_apply_theme = $CI->config->item('apply_theme');
        $apply_theme = $config_apply_theme ? $config_apply_theme : 'bootstrap2';

        $data['apply_theme'] = $apply_theme;

        if ($preventOutput == true) {
            return $CI->load->view($apply_theme.'/'.$data['page'], $data, true);
        }

        if ($CI->input->is_ajax_request()) {
            if ($dataType == "JSON") {
                $data['page_data']= $CI->load->view(
                    $apply_theme.'/'.$data['page'], $data, true
                );
                echo json_encode($data);
            } else {
                $CI->load->view($apply_theme.'/'.$data['page'], $data);
            }

        } else {
            $CI->load->view($apply_theme.'/'.'template', $data);
        }
        
    }
}


if (!function_exists('latestFile')) {
    /**
     * Ensuring to get latest asset files like css, js by apending modified time.
     *   
     * @param string $filename file name
     *  
     * @return void
    */
    function latestFile($filename)
    {
        $filename = base_url($filename);
        $fileDetails = get_headers($filename, 1);
        if (isset($fileDetails['Last-Modified'])) {
            return $filename.'?'.strtotime($fileDetails['Last-Modified']);
        } else {
            return $filename;
        }
    
        /*if(file_exists($filename))
        $filename = base_url($filename.'?'.filemtime($filename));
        return $filename;*/
    }
}


if (!function_exists('setFlashMsg')) {
    /**
         * setting message in temporary message 
         *
         * @param string $str         message string     
         * @param string $redirectUrl redirect to URL
         *   
         * @return void
    */    
    function setFlashMsg($str, $redirectUrl = null)
    {

        $CI =& get_instance();

        $CI->session->set_flashdata('tempMsg', $str);

        if ($redirectUrl != null OR $redirectUrl != "") {
            redirect($redirectUrl);
            exit();
        }
    }

}

if (!function_exists('showFlashMsg')) {
    /**
         * showing temporary message 
         *
         * @return void
    */
    function showFlashMsg()
    {

        $CI =& get_instance();

        return $CI->session->flashdata('tempMsg') ? '<div class="alert">'
        .$CI->session->flashdata('tempMsg').'</div>' : null;
    }

}

if (!function_exists('priceFormat')) {
    /**
         * Formatting Price/Amount for store
         *
         * @param number  $amount             amount     
         * @param boolean $appendCurrencyCode Append Currency Code or Not
         *   
         * @return void
    */
    function priceFormat($amount = 0, $appendCurrencyCode = false)
    {
        $store_settings = storeConfigItem('store_settings');
        $formated_currency = $store_settings['settings']['currency_symbol'].''
        .number_format($amount, 2)
        . ($appendCurrencyCode ? ' '.$store_settings['settings']['currency'] : '');
        unset($store_settings);
        return $formated_currency;
    }

}


if (!function_exists('storeConfigItem')) {
    /**
         * getting store setting from session
         *
         * @return void
    */
    function storeConfigItem()
    {

        $CI =& get_instance();
        return $CI->session->tempdata('store_settings');
    }

}

if (!function_exists('getSettingsItem')) {
    /**
         * Getting store setting from session item specific or all
         *
         * @param string $getting_item getting settings item     
         *   
         * @return void
    */
    function getSettingsItem($getting_item = null)
    {
        $store_settings = storeConfigItem('store_settings');
        $item = $getting_item ? $store_settings['settings'][$getting_item] 
        : $store_settings['settings'];
        unset($store_settings);
        return $item;
    }

}


if (!function_exists('calculateShipping')) {
    /**
         * calculating shipping based on settings & cart amount
         *
         * @param number $totalAmount Total Amount     
         *   
         * @return void
    */
    function calculateShipping($totalAmount = null)
    {

        $store_settings = getSettingsItem();

        $calculatedShippingCharges = 0;

        if ($totalAmount == null) {
            $CI =& get_instance();
            $totalAmount = $CI->cart->total();
        }

        if ($totalAmount <= 0) {
             return 0;
        }
       
        $shipping_charges = $store_settings['shipping_charges'];
        $shipping_free_after = $store_settings['shipping_free_after'];

        if ($totalAmount > $shipping_free_after AND $shipping_free_after != 0) {
            $calculatedShippingCharges = 0;
        } else {
            $calculatedShippingCharges =  $shipping_charges;
        }

        return $calculatedShippingCharges;
    }

}

/**
     * Alias for Gettext
     *
     * @param string $message Message ID    
     *   
     * @return string
*/

function __($message = null) {

    if(!$message) {
       return $message; 
    }

    if (function_exists("gettext")) {
        return gettext($message);
    }

    return $message;
}