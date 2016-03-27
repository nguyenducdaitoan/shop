<?php 
/**
 * Store Manage Products Controller file
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
 * Store Manage Products Controller
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

class Manage_Products extends Base_Controller
{
    /**
         * Constructor
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
         * Index action
         *
         * @return void
    */
    public function index()
    {
        $this->show();
    }

    /**
         * List of all products
         *
         * @param number $cat_id category id     
         *    
         * @return void
    */
    
    function show($cat_id = null)
    {

        parse_str($_SERVER['QUERY_STRING'], $_GET);

        $sortBy = $inSortBy =  trim(strip_tags($this->input->get('sortBy', true)));
        $sort = trim(strip_tags($this->input->get('sort', true)));
        $urlSegment = trim(strip_tags($this->input->get('per_page', true)));

        if (!$sortBy OR !$sort) {
            $sortBy = 'name';
            $sort = 'DESC';
        }


        $sortArray = array('name', 'cat_name');

        $addtionalUrl = $cat_id ? $cat_id : '';
        $config['base_url'] = site_url('manage_products/show/'.$addtionalUrl.'?');

        $data['sort_type'] = "desc";
        $data['my_segment_url'] = $config['base_url'];
        
        if ($sortBy AND $sort) {
            $config['base_url'] = site_url('manage_products/show/'.$addtionalUrl.'?')
            .'sortBy='.$inSortBy.'&sort='.$sort;
        }

        if (!in_array($sortBy, $sortArray)) {
            $sortBy = 'name';
        }

        $data['my_base_url'] = $config['base_url'];

        if ($sort == "desc") {
            $data['sort_type'] = "asc";
        }

        //load pagination library
        $this->load->library('pagination');
    
        $this->load->model('products_model', 'products');

        $config['per_page'] = config_item('pagination_items_per_page');

        //set limit & offset
        $options = array(
            'limit' =>  $config['per_page'], 
            'offset' =>  $urlSegment, 
            'order_by' =>  $sortBy, 
            'order_type' =>  $sort
        );

        // Pagination config
        $config['page_query_string'] = true;
        $config['total_rows'] = $this->products->countProductsCategories($options);

        $this->pagination->initialize($config); 
        
        $data['query'] = $this->products->fetchProductsCategories(
            false, $cat_id, $options
        );
    
        $data['category_specifc'] =  $cat_id;
        
        $data['page'] = 'store/products_view';
        $data['insertScripts'] = array('js_delete_product', 'js_ajax_details');

        loadView($data);
    }

    /**
         * Add new Product
         *
         * @param number $selectedCategory selected category     
         *    
         * @return void
    */  
    
    function add($selectedCategory = '')
    {
        $this->load->helper('form');
    
        $this->load->model('store_settings', 'mdSS');
        $data['query'] = $this->mdSS->getSettings();
        
        $this->load->model('categories_model', 'categories');
        $data['all_categories'] = $this->categories->fetchAllDropDown(true);
        
        if (!$data['all_categories']) {
            redirect('manage_categories/add');
        }
        
        $data['selectedCategory'] = $selectedCategory;

        $toCategory = $selectedCategory;
        
        $this->load->library('Form_validation');
        $val = $this->form_validation;
        
        $val->set_rules(
            'product_name', __('Product Name'), 
            'trim|xss_clean|required'
        );
        $val->set_rules('thumb', __('Product Thumbnail'), 'callback_validateImage');
        $val->set_rules(
            'product_id', __('Product ID'), 
            'trim|xss_clean|required|alpha_dash|is_unique[products.product_id]'
        );
        $val->set_rules(
            'product_price', __('Product Price'), 
            'trim|xss_clean|required|numeric|greater_than[0]'
        );  
        $val->set_rules('product_sizes', __('Product Sizes'), 'trim|xss_clean');
        $val->set_rules('product_color', __('Product Colors'), 'trim|xss_clean');
        $val->set_rules(
            'product_details', __('Product Details'), 
            'trim|required|min_length[10]'
        );
        
        $val->set_error_delimiters(
            '<span class="help-inline error_msg">', 
            '</span>'
        );
        
        if ($val->run()) {

            if(IS_STORE_DEMO){
                redirect('manage_products/add/'.$selectedCategory);
                return true;
            }
        
            $config_upload['upload_path'] = 'uploads/thumb/';
            $config_upload['allowed_types'] = 'gif|jpg|png';
            //$config_upload['max_size']    = '100';
            //$config_upload['max_width']  = '1024';
            //$config_upload['max_height']  = '768';
            
            $this->load->library('upload', $config_upload);
            $upload = $this->upload;
            
            if (!$upload->do_upload('thumb')) {
                    $error = array('error' => $upload->display_errors());
            } else {
                $inputVal = $this->input;
                $dataUpload = array(
                    'upload_data' => $upload->data()
                );
            
                $insertData = array(
                    'name'          => $inputVal->post('product_name'),
                    'thumbnail'     => $dataUpload['upload_data']['file_name'],
                    'product_id'    => $inputVal->post('product_id'),
                    'price'         => $inputVal->post('product_price'),
                    'description'   
                    => htmlentities($inputVal->post('product_details')),
                    'category'      => $inputVal->post('category'),
                    'sizes'         => $inputVal->post('product_sizes'),
                    'colors'        => $inputVal->post('product_color'),
                );
                
                $this->load->model('products_model', 'products');
                $productAdded = $this->products->add($insertData);
                
                if ($productAdded) {
                    $data['temp_msg'] = __('New Product Added!!');
                }
                    
            }
        }

        
        $data['insertJS'] = array(
            "ckeditor/ckeditor",
            "jquery.tagsinput.min"
        );
        $data['insertCSS'] = array(
            "jquery.tagsinput"
        );
        $data['insertScripts'] = array(
            'js_ajax_details',
            'js_tags_input'
        );
        
        $data['page'] = 'store/add_product_form';
        loadView($data);
    }

    /**
         * Edit Product
         *
         * @param number $prod_id Product id     
         *    
         * @return void
    */
    function edit($prod_id = null)
    {

        if (!$prod_id) {
            show_404();
        }
        
        $this->load->helper('form');

        $this->load->model('store_settings', 'mdSS');
        $data['query'] = $this->mdSS->getSettings();
        
        $this->load->model('categories_model', 'categories');
        $data['all_categories'] = $this->categories->fetchAllDropDown(true);

        if (!$data['all_categories']) {
            redirect('manage_categories/add');
            exit();
        }       
        
        $this->load->model('products_model', 'products');
        $data['products_query'] = $this->products->fetch($prod_id);

        if (!$data['products_query']) {
            show_404();
            exit();
        }   
        

        $this->load->library('Form_validation');
        $val = $this->form_validation;
        
        $val->set_rules(
            'productID', 'productID', 
            'trim|xss_clean|required|numeric'
        );
        $val->set_rules(
            'product_name', __('Product Name'), 
            'trim|xss_clean|required'
        );
        $val->set_rules(
            'product_id', __('Product ID'),
            'trim|xss_clean|required|alpha_dash'
        );
        $val->set_rules(
            'product_price', __('Product Price'), 
            'trim|xss_clean|required|numeric|greater_than[0]'
        );  
        $val->set_rules('product_sizes', __('Product Sizes'), 'trim|xss_clean');
        $val->set_rules('product_color', __('Product Colors'), 'trim|xss_clean');
        $val->set_rules(
            'product_details', __('Product Details'),
            'trim|required|min_length[10]'
        );
        
        $val->set_error_delimiters(
            '<span class="help-inline error_msg">', 
            '</span>'
        );
        
        $thisInput = $this->input;
        $productID = $thisInput->post('productID');
        
        if ($val->run()) {

            if(IS_STORE_DEMO){
                redirect('manage_products/edit/'.$productID);
                return true;
            }
        
            $config_upload['upload_path'] = $this->config->item('thumb_path');
            $config_upload['allowed_types'] = 'gif|jpg|png';
            //$config_upload['max_size']    = '100';
            //$config_upload['max_width']  = '1024';
            //$config_upload['max_height']  = '768';
            
            $this->load->library('upload', $config_upload);
            $upload = $this->upload;
            
            $updateCount = 0;
            $updateArray = array();
            
            $this->load->model('products_model', 'products');
            $query_item = $this->products->fetch($productID, true);

            $query = $query_item[0];
            
            if (!$upload->do_upload('thumb')) {
                $error = array('error' => $upload->display_errors());

            } else {
                $thumbImage = $this->config->item('thumb_path').$query['thumbnail'];

                $dataUpload = array('upload_data' => $upload->data());
                
                if (($query['thumbnail'] && file_exists($thumbImage)) and ($dataUpload['upload_data']['file_name'] != $query['thumbnail']) ) {
                    unlink($thumbImage);
                }

                $updateArray['thumbnail'] = $dataUpload['upload_data']['file_name'];
                $updateCount++;
            }
            
            $product_name = $thisInput->post('product_name');
            if ($product_name && $product_name != $query['name']) {
                $updateArray['name'] = $product_name;
                $updateCount++;
            }
             
            $product_id = $thisInput->post('product_id');
            if ($product_id && $product_id != $query['product_id']) {
                $updateArray['product_id'] = $product_id;
                $updateCount++;
            } 
             
            $category = $thisInput->post('category');
            if ($category && $category != $query['category']) {
                $updateArray['category'] = $category;
                $updateCount++;
            }
             
            $product_price = $thisInput->post('product_price');
            if ($product_price && $product_price != $query['price']) {
                $updateArray['price'] = $product_price;
                $updateCount++;
            } 

            $product_sizes = $thisInput->post('product_sizes');
            if ($product_sizes != $query['sizes']) {
                $updateArray['sizes'] = $product_sizes;
                $updateCount++;
            }
             
            $product_color = $thisInput->post('product_color');
            if ($product_color !=  $query['colors']) {
                $updateArray['colors'] = $product_color;
                $updateCount++;
            }
             
            $product_details = htmlentities($thisInput->post('product_details'));
            if ($product_details && $product_details !=  $query['description']) {
                $updateArray['description'] = $product_details;
                $updateCount++;
            }
             
            if ($updateCount > 0 ) {
                if ($this->products->update($productID, $updateArray)
                ) {
                    setFlashMsg(
                        __('Successfully Updated!!'), 
                        "manage_products/edit/$prod_id"
                    );
                } else {
                    $data['temp_msg'] = __('No changes');
                }
            } else {
                $data['temp_msg'] = __('No changes');
            }
                 
        }       
        
        $data['insertJS'] = array(
            "ckeditor/ckeditor",
            "jquery.tagsinput.min"
        );

        $data['insertCSS'] = array(
            "jquery.tagsinput"
        );
        
        $data['page'] = 'store/edit_product_form';

        $data['insertScripts'] = array('js_ajax_details','js_tags_input');
        loadView($data);
    
    }
    
    /**
         * Delete Product
         *
         * @param number $prod_id Product id     
         *
         * @return void
    */
    function delete($prod_id = null)
    {
        if(IS_STORE_DEMO){
            redirect('manage_products');
            return true;
        }

        if ($prod_id == null) {
            redirect('manage_products');
        }
        
        $this->load->model('products_model', 'products');       
        $query = $this->products->fetch($prod_id);
        
        if ($query) {
            foreach ($query as $row) {
                $thumb_path = $this->config->item('thumb_path').$row->thumbnail;
                if (file_exists($thumb_path)) {
                    unlink($thumb_path);
                }
            }
        }
        
        if ($this->products->delete($prod_id)) {
            redirect('manage_products');
        }
        
    }
    
    /**
         * Thumbnail Validation
         *
         * @return void
    */
    function validateImage()
    {
        if ($_FILES['thumb']['size'] == 0) {
            $this->form_validation->set_message(
                'validateImage', 
                __('Thumbnail is required.')
            );
            return false;
        } else {
            return true;
        }
    }

    function _validate_product_name($product_name = ''){

       $product_name_rules  = '\w \-\.\:';

        if (! preg_match('/^['. $product_name_rules.']+$/i'.(UTF8_ENABLED ? 'u' : ''), $product_name))
        {
            $this->form_validation->set_message(
                '_validate_product_name', 
                __('The name can only contain alpha-numeric characters, dashes, underscores, colons, and spaces')
            );
            return FALSE;
        } else {
            return true;
        }
    }
}

/* End of file manage_products.php */
/* Location: ./lw_application/controllers/manage_products.php */