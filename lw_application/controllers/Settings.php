<?php 
/**
 * Store Settings Controller file
 *
 * PHP version 5.2.4 or newer
 *
 * @category   ControllerFile
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
 * Store Settings Controller
 *
 * @category   ControllerFile 
 * @package    JQueryPHPStoreShop
 * @author     Vinod <livelyworks@gmail.com>
 * @copyright  2013 LivelyWorks. (http://livelyworks.net)
 * @license    LivelyWorks (http://livelyworks.net)
 * @link       http://livelyworks.net
 * @since      Version 1.0
 * @deprecated NA
 */

class Settings extends Base_Controller
{
    /**
         * Cunstructor
         *
         * @return void
    */
    function __construct()
    {
        parent::__construct();
        $this->load->library('tank_auth');
        $this->load->helper('url');     
        if (!$this->tank_auth->is_logged_in()) {
            redirect('auth/login');
            return;
        }
    }
    
    /**
         * Show settings form
         *
         * @return void
    */
    function index()
    {
        $this->storeSettings();
    }
    
    /**
         * Show settings form
         *
         * @param string $isUpdated if the settings are updated
         *
         * @return void
    */
    function storeSettings($isUpdated = null)
    {
        $query = $this->store_settings->getSettings();
        $this->load->helper('form');

        $data['query'] = $query;

        $data['currencies_json'] = json_encode($this->getCurrency());

        if ($isUpdated) {
            $data['temp_msg'] = $isUpdated;
        };
        
        $data['page'] = 'store/store_settings_form';

        loadView($data);
        
    }
    
    /**
         * Update settings action
         *
         * @return void
    */
    function updateSettings()
    {
    
        $this->load->library('Form_validation');    
        $this->load->helper('form');
        
        $val = $this->form_validation;
                
        // Set form validation rules            
        $val->set_rules('logo', __('Logo'), 'trim|xss_clean');
        $val->set_rules('storeName', __('Store Name'), 'trim|xss_clean|required');
        $val->set_rules(
            'businessEmail', __('Business Email'), 
            'trim|xss_clean|required|valid_email'
        );
        $val->set_rules(
            'currency', __('Currency'),
            'trim|xss_clean|required|alpha'
        );
        $val->set_rules(
            'currencySymbol', __('Currency Symbol'), 
            'trim|xss_clean|required'
        );
        $val->set_rules(
            'usePaypal', __('Use Paypal'), 
            'trim|xss_clean|is_natural'
        );
        $val->set_rules(
            'useSubmitOrder', __('Use Submit Order'), 
            'trim|xss_clean|is_natural'
        );
        $val->set_rules(
            'shippingCharges', __('Shipping Charges'), 
            'trim|xss_clean|required|numeric|callback_anyPositiveNumber'
        );  
        $val->set_rules(
            'shippingFreeAfter', __('Shipping Free After'), 
            'trim|xss_clean|required|numeric|callback_anyPositiveNumber'
        );  

        $val->set_rules(
            'msgOrderSubmit', __('Message on Order Submit'), 
            'trim|xss_clean|required'
        );
        
        if ($val->run()) {

            if(IS_STORE_DEMO){
                $this->storeSettings();
                return true;
            }
        
            $query = $this->store_settings->getSettings();
            
            $config_upload['upload_path'] = $this->config->item('logo_path');
            $config_upload['allowed_types'] = 'gif|jpg|png';
            //  $config_upload['max_size']  = '100';
            //  $config_upload['max_width']  = '1024';
            //  $config_upload['max_height']  = '768';

            $this->load->library('upload', $config_upload);
            $upload = $this->upload;
            $updateArray = array();
            
            $updateCount = 0;

            if (!$upload->do_upload('logo')) {
                $error = array('error' => $upload->display_errors());
            } else {
                $logoImage = $this->config->item('logo_path').$query['logo'];

                $dataUpload     = array(
                        'upload_data'   => $upload->data()
                    );

                if (($query['logo'] && file_exists($logoImage)) and ($dataUpload['upload_data']['file_name'] != $query['logo'])) {
                    unlink($logoImage);
                }
            
                $updateArray[]  =  array(
                          'name'        => 'logo' ,
                          'value'       => $dataUpload['upload_data']['file_name'],
                       );
                       
                $updateCount++;
            }
            
            
            $thisInput = $this->input;

            $storeName = $thisInput->post('storeName');
            if ($storeName && $storeName !=  $query['store_name']) {
                    $updateArray[] =   array(
                      'name'    => 'store_name' ,
                      'value'   => $storeName,
                    );
                    $updateCount++;
            }
        
            $businessEmail = $thisInput->post('businessEmail');
            if ($businessEmail && $businessEmail !=  $query['business_email']) {
                $updateArray[] =   array(
                  'name'    => 'business_email',
                  'value'   => $businessEmail,
                );
                $updateCount++;
            } 
               
            $currency = $thisInput->post('currency');
            if ($currency && $currency !=  $query['currency']) {
                $updateArray[] =  array(
                  'name'    => 'currency',
                  'value'   => $currency,
                );
                $updateCount++;
            };
            
            $currencySymbol = $thisInput->post('currencySymbol');
            if ($currencySymbol && $currencySymbol !=  $query['currency_symbol']) {
                $updateArray[] =  array(
                  'name'    => 'currency_symbol' ,
                  'value'   => $currencySymbol,
                );
                $updateCount++;
            };
               
            $usePaypal = $thisInput->post('usePaypal');
            if ($usePaypal !=  $query['use_paypal']) {
                $updateArray[] =  array(
                  'name'    => 'use_paypal' ,
                  'value'   => $usePaypal,
                );
                $updateCount++;
            };
              
            $useSubmitOrder = $thisInput->post('useSubmitOrder'); 
            if ($useSubmitOrder != $query['use_submit_order']) {
                $updateArray[] =  array(
                  'name'    => 'use_submit_order' ,
                  'value'   => $thisInput->post('useSubmitOrder') ,
                );
                $updateCount++;
            };
             
            $shippingCharges = $thisInput->post('shippingCharges'); 
            if ($shippingCharges != $query['shipping_charges']) {
                $updateArray[] =  array(
                  'name'    => 'shipping_charges' ,
                  'value'   => $shippingCharges,
                );
                $updateCount++;
            };

            $shippingFreeAfter = $thisInput->post('shippingFreeAfter'); 
            if ($shippingFreeAfter != $query['shipping_free_after']) {
                $updateArray[] =  array(
                  'name'    => 'shipping_free_after' ,
                  'value'   => $shippingFreeAfter,
                );
                $updateCount++;
            };
            
            $msgOrderSubmit = $thisInput->post('msgOrderSubmit'); 
            if ($msgOrderSubmit && $msgOrderSubmit != $query['msg_on_order_submit']
            ) {
                $updateArray[] =  array(
                  'name'    => 'msg_on_order_submit',
                  'value'   => $msgOrderSubmit,
                );
                $updateCount++;
            };
             
            if ($updateCount > 0 ) {
                if ($this->store_settings->updateSettings($updateArray)) {
                    $this->storeSettings(__('Successfully Updated!!'));
                } else {
                    $this->storeSettings(__('No changes'));
                }
            } else {
                $this->storeSettings(__('No changes'));
            }
        } else {
            $this->storeSettings(validation_errors());
        }
    }

    /**
         * Validation method to check positive number
         *
         * @param number $amount amount
         *
         * @return boolean
    */
    function anyPositiveNumber($amount)
    {
        if ($amount < 0) {
             $this->form_validation->set_message(
                 'anyPositiveNumber', 
                 __('Shipping amount can not less than 0')
             );
              return false;
        } else {
             return true;
        }
    }

    /**
         * Currencies details
         *
         * @param string $currency_id currency id
         *
         * @return array
    */
    function getCurrency($currency_id = null)
    {
        
        $currencies = array(
            'AUD' => array(
                'name' => "Australian Dollar", 
                'symbol' => "A$", 'ASCII' => "A&#36;"
                ),
            'CAD' => array(
                'name' => "Canadian Dollar", 
                'symbol' => "$", 'ASCII' => "&#36;"
                ),
            'CZK' => array(
                'name' => "Czech Koruna", 
                'symbol' => "Kč", 'ASCII' => ""
                ),
            'DKK' => array(
                'name' => "Danish Krone", 
                'symbol' => "Kr", 
                'ASCII' => ""
                ),
            'EUR' => array(
                'name' => "Euro", 
                'symbol' => "€", 
                'ASCII' => "&#128;"
                ),
            'HKD' => array(
                'name' => "Hong Kong Dollar", 
                'symbol' => "$", 
                'ASCII' => "&#36;"
                ),
            'HUF' => array(
                'name' => "Hungarian Forint", 
                'symbol' => "Ft", 
                'ASCII' => ""
                ),
            'ILS' => array(
                'name' => "Israeli New Sheqel", 
                'symbol' => "₪", 
                'ASCII' => "&#8361;"
                ),
            'JPY' => array(
                'name' => "Japanese Yen", 
                'symbol' => "¥", 
                'ASCII' => "&#165;"
                ),
            'MXN' => array(
                'name' => "Mexican Peso", 
                'symbol' => "$", 
                'ASCII' => "&#36;"
                ),
            'NOK' => array(
                'name' => "Norwegian Krone", 
                'symbol' => "Kr", 
                'ASCII' => ""
                ),
            'NZD' => array(
                'name' => "New Zealand Dollar", 
                'symbol' => "$", 
                'ASCII' => "&#36;"
                ),
            'PHP' => array(
                'name' => "Philippine Peso", 
                'symbol' => "₱", 
                'ASCII' => ""
                ),
            'PLN' => array(
                'name' => "Polish Zloty", 
                'symbol' => "zł", 
                'ASCII' => ""
                ),
            'GBP' => array(
                'name' => "Pound Sterling", 
                'symbol' => "£", 
                'ASCII' => "&#163;"
                ),
            'SGD' => array(
                'name' => "Singapore Dollar", 
                'symbol' => "$", 
                'ASCII' => "&#36;"
                ),
            'SEK' => array(
                'name' => "Swedish Krona", 
                'symbol' => "kr", 
                'ASCII' => ""
                ),
            'CHF' => array(
                'name' => "Swiss Franc", 
                'symbol' => "CHF", 
                'ASCII' => ""
                ),
            'TWD' => array(
                'name' => "Taiwan New Dollar", 
                'symbol' => "NT$", 
                'ASCII' => "NT&#36;"
                ),
            'THB' => array(
                'name' => "Thai Baht", 
                'symbol' => "฿", 
                'ASCII' => "&#3647;"
                ),
            'USD' => array(
                'name' => "U.S. Dollar", 
                'symbol' => "$", 
                'ASCII' => "&#36;"
                )
        );

        if ($currency_id != null AND isset($currencies[$currency_id])) {

            if ($this->input->is_ajax_request()) {
                echo json_encode($currencies[$currency_id]);
            } else {
                return $currencies[$currency_id];
            }
        } else {
            if ($this->input->is_ajax_request()) {
                echo json_encode($currencies);
            } else {
                return $currencies;
            }
        }
    }

}

/* End of file settings.php */
/* Location: ./lw_application/controllers/settings.php */