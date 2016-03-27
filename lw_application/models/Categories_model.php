<?php 
/**
 * Store Categories Model file
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
 * Store Categories Model
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

class Categories_Model extends CI_Model
{
    protected $table_name = 'categories';
    protected $products_table = 'products';

     /**
         * Constructor
         *
         * @return void
    */
    function __construct()
    {
        parent::__construct();
    }

    /**
         * Fetching all categories based on provided options
         *
         * @param boolean $isArray Fetch as array     
         * @param array   $options retriving options          
         *        
         * @return object
    */
    function fetchAll($isArray = false, $options = null)
    {
        $order_type = isset($order_type) ? $order_type : "desc";

        if (isset($limit) AND $limit != null) {
            $this->db->limit($limit, $offset);
        }
         

        if (isset($order_by) AND $order_by != null) {
             $this->db->order_by($order_by, $order_type);
        }
 
        if (isset($where) AND is_array($where)) {
             $this->db->where($where);
        }
       
        $query = $this->db->get($this->table_name);
        
        if ($query->num_rows() > 0) {   
            if ($isArray == true) {
                 $new_result = $query->result_array();
            } else {
                $new_result = $query->result();
            }
 
            $query->free_result();
            
            return $new_result;
        }
    }

    /**
         * Fetching single category
         *
         * @param number $cat_id category id            
         *
         * @return object
    */  
    function fetch($cat_id = null)
    {
        
        $this->db->where('id', $cat_id); 
        $query = $this->db->get($this->table_name);
        
        if ($query->num_rows() > 0) {   
            $new_result = $query->result();
            $query->free_result();
            return $new_result;
        }
    }

    /**
         * Fetching categories for dropdown
         *
         * @return object
    */  
    function fetchAllDropDown()
    {
        $query = $this->db->get($this->table_name);
        
        if ($query->num_rows() > 0) {   
            $query_result =  $query->result();
            
            $new_result = array();
            foreach ($query_result as $row) {
                $new_result[$row->id] = $row->name;
            }
        
            $query->free_result();
            return $new_result;
        } else {
            return false;
        }
    }
    /**
         * Add new category
         *
         * @param array $data category data  
         *                 
         * @return number
    */  
    function add($data)
    {
        if(IS_STORE_DEMO)
        {
            return true;
        }

        $data['created_at'] = date('Y-m-d H:i:s');
        if ($this->db->insert($this->table_name, $data)) {
            $insert_id = $this->db->insert_id();
            $this->store_settings->_createCategories();
            return $insert_id;
        }
    }

    /**
         * editing a catgeory
         *
         * @param number $cat_id category id  
         * @param array  $data   category data          
         * 
         * @return boolean
    */  
    function edit($cat_id, $data)
    {
        if(IS_STORE_DEMO)
        {
            return true;
        }

        $this->db->where('id', $cat_id);
        if ($this->db->update($this->table_name, $data)) {
            $this->store_settings->_createCategories();
            return true;
        } else {
            return false;
        }
    }
    
    /**
         * deleting category
         *
         * @param number $cat_id category id  
         * 
         * @return boolean
    */  
    function delete($cat_id)
    {
        if(IS_STORE_DEMO)
        {
            return true;
        }
        
        if ($cat_id == null ) {
            return false;
        }
        
        if ($this->db->delete($this->table_name, array('id' => $cat_id))) {
            $this->store_settings->_createCategories();
            return true;
        } else {
            return false;
        }
    }
}

/* End of file categories_model.php */
/* Location: ./lw_application/models/categories_model.php */