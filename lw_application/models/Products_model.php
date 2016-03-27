<?php 
/**
 * Store Products Model file
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
 * Store Products Model
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

class Products_Model extends CI_Model
{
    protected $table_name = 'products';

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
         * Add new product
         *
         * @param array $data product data          
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
            return $this->db->insert_id();
        }
    }

    /**
         * Fetching all products based on options provided
         *
         * @param boolean $isArray result in array or object          
         * @param array   $options retriving options              
         *  
         * @return object
    */  
    function fetchAll($isArray = false, $options = null)
    {
        if ($options != null AND is_array($options)) {
            extract($options);
        }

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
         * counting all products based on option provided
         *
         * @param array $where retriving options              
         *  
         * @return number
    */
    function countAll($where = null)
    {
        if (isset($where) AND is_array($where)) {
            $this->db->where($where);
        }

        return $this->db->count_all_results($this->table_name);
    }

    /**
         * fetching single product
         *
         * @param number  $prod_id product id          
         * @param boolean $isArray result in array or not              
         *  
         * @return object
    */  
    function fetch($prod_id = null, $isArray = false)
    {
        $this->db->where('id', $prod_id);
        $query = $this->db->get($this->table_name);
        
        if ($query->num_rows() > 0) {   
            if ($isArray) {
                $new_result = $query->result_array();
            } else {
                $new_result = $query->result();
            }
            
            $query->free_result();
            
            return $new_result;
        }
    }

    /**
         * fetching a products based on category
         *
         * @param number $cat_id  category id          
         * @param array  $options retriving options              
         *  
         * @return object
    */  
    function fetchByCategory($cat_id = null, $options = null)
    {
    
        if ($cat_id == null ) {
             return false;
        }

        if ($options != null AND is_array($options)) {
            extract($options);
        }

        $order_type = isset($order_type) ? $order_type : "desc";

        if (isset($limit) AND $limit != null) {
             $this->db->limit($limit, $offset);
        }
        

        if (isset($order_by) AND $order_by != null) {
             $this->db->order_by($order_by, $order_type);
        }
       
    
        $this->db->where('category', $cat_id); 
        $query = $this->db->get($this->table_name);
        
        if ($query->num_rows() > 0) {   
            $new_result = $query->result();
            $query->free_result();
            return $new_result;
        }
    }

    /**
         * Fetch product category
         *
         * @param boolean $isArray result in array or not  
         * @param number  $cat_id  category id                  
         * @param array   $options retriving options              
         *  
         * @return object
    */  
    function fetchProductsCategories(
        $isArray = false, $cat_id = null, $options = null
    ) {
    
        if ($cat_id !== null) {
            $this->db->where('categories.id', $cat_id);
        }
    
        $this->db->select(
            "products.*, categories.id cat_id, categories.name cat_name"
        );
        $this->db->from($this->table_name);
        $this->db->join('categories', 'categories.id = products.category');

        if ($options != null AND is_array($options)) {
            extract($options);
        }

        $order_type = isset($order_type) ? $order_type : "desc";

        if (isset($limit) AND $limit != null) {
            $this->db->limit($limit, $offset);
        }
         

        if (isset($order_by) AND $order_by != null) {
             $this->db->order_by($order_by, $order_type);
        }
       
        

        $query = $this->db->get();
        
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
         * count product categories
         *
         * @param array $options retriving options              
         *  
         * @return number
    */ 
    function countProductsCategories($options = null)
    {

        if ($options != null AND is_array($options)) {
            extract($options);
        }
    
        if (isset($cat_id)) {
            $this->db->where('categories.id', $cat_id);
        }
    
        $this->db->select(
            "products.*, categories.id cat_id, categories.name cat_name"
        );
        $this->db->join('categories', 'categories.id = products.category');

        $order_type = isset($order_type) ? $order_type : "desc";

        return $this->db->count_all_results($this->table_name);
    }
    
    /**
         * update product
         *
         * @param number $prod_id product id           
         * @param array  $data    update data              
         *  
         * @return boolean
    */  
    function update($prod_id, $data)
    {
        if(IS_STORE_DEMO)
        {
            return true;
        }

        $this->db->where('id', $prod_id);
        if ($this->db->update($this->table_name, $data)) {
            return true;
        } else {
            return false;
        }
    }

    /**
         * delete product
         *
         * @param number $prod_id product id            
         *
         * @return boolean
    */  
    function delete($prod_id = null)
    {
        if(IS_STORE_DEMO)
        {
            return true;
        }
    
        if ($prod_id == null ) {
            return false;
        }
        
        if ($this->db->delete($this->table_name, array('id' => $prod_id))) {
            return true;
        } else {
            return false;
        }
    }

    /**
         * search product
         *
         * @param string $search  search string   
         * @param array  $options retriving options                     
         *
         * @return object
    */
    function fetchSearchResult($search = '', $options = null )
    {
        $words = explode(' ', $search);

        $search_type = 2;

        if (isset($options) AND is_array($options)) {
            extract($options);
        }

        if ($search != '') {
            foreach ($words as $word) {
                $this->db->or_where("name REGEXP '[^<]*".$word."[[:>:]]'");
                $this->db->or_where("description REGEXP '[^<]*".$word."[[:>:]]'");
            }
        }
            
        if (isset($limit) AND $limit) {
            $this->db->limit($limit, $offset);
        }
        
        if (isset($orderBy) AND $orderBy) {
            $this->db->order_by($orderBy, $orderType);
        }
        
        $query = $this->db->get('products');
        if ($query->num_rows() > 0) {
            $newQueryResult = $query->result();
            $query->free_result();

            return $newQueryResult;
        }

        
    }

    /**
         * count search product
         *
         * @param string $search search string   
         *
         * @return number
    */
    function countSearchResult($search)
    {
        $words = explode(' ', $search);

        if (isset($options) AND is_array($options)) {
            extract($options);
        }
        


        if ($search != '') {
            foreach ($words as $word) {
                $this->db->or_where("name REGEXP '[^<]*".$word."[[:>:]]'");
                $this->db->or_where("description REGEXP '[^<]*".$word."[[:>:]]'");
            }
        }
            
        $query = $this->db->count_all_results('products');

        if ($query > 0) {
            return $query;
        }
       
    }
}

/* End of file products_model.php */
/* Location: ./lw_application/models/products_model.php */