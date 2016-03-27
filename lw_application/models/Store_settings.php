<?php 
/**
 * Store Settings Model file
 *
 * PHP version 5.2.4 or newer
 *
 * @category   ModelFile
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
 * Store Settings Model
 *
 * @category   ModelFile 
 * @package    JQueryPHPStoreShop
 * @author     Vinod <livelyworks@gmail.com>
 * @copyright  2013 LivelyWorks. (http://livelyworks.net)
 * @license    LivelyWorks (http://livelyworks.net)
 * @link       http://livelyworks.net
 * @since      Version 1.0
 * @deprecated NA
 */

class Store_Settings extends CI_Model
{
    protected $table_name = 'store_settings';

    /**
         * Constructor
         *
         * @return void
    */
    function __construct()
    {
        parent::__construct();

        $this->load->library('cart');
        $this->load->library('LW_lang');
        $this->_getCategories();
    }

    /**
         * get store settings
         *
         * @return void
    */
    function getSettings()
    {
    
        $query = $this->db->get($this->table_name);
        
        if ($query->num_rows() > 0) {   
            $query_result =  $query->result();
            
            $settings = array();
            foreach ($query_result as $row) {
                $settings[$row->name] = $row->value;
            }
            
            $query->free_result();
            return $settings;
        }
    }
    
    /**
         * update store settings
         *
         * @param array $update_array update data          
         * 
         * @return object
    */
    function updateSettings($update_array)
    {
        if(IS_STORE_DEMO)
        {
            return true;
        }

        $this->session->unset_tempdata('store_settings');
        
        $this->db->update_batch($this->table_name, $update_array, 'name');

        $this->_createCategories();
        
        return $this->db->affected_rows();
    }

    /**
         * get or call store settings in session along with categories
         *
         * @return void
    */
    function _getCategories()
    {
        $store_settings = $this->session->tempdata('store_settings');

        if (!isset($store_settings)) {
            $this->_createCategories();
        } 
    }

    /**
         * store settings in session along with categories
         *
         * @return array
    */  
    function _createCategories()
    {
        
        $this->session->unset_tempdata('store_settings');

        $this->load->model('categories_model');

        $settings = $this->getSettings();
        $categories = $this->categories_model->fetchAll();


        if (isset($settings)) {
            $data_categories = array(
                    'categories' => ($categories),
                    'settings' => ($settings)
                    );

            return $this->session->set_tempdata(
                'store_settings', $data_categories, 600
            );
        } else {
            return false;
        }
    }

}

/* End of file store_settings.php */
/* Location: ./lw_application/models/store_settings.php */