<?php 
/**
 * Store Manage Categories Controller file
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
 * Store Manage Categories Controller
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

class Manage_Categories extends Base_Controller
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
        
        $this->load->model('categories_model', 'categories');
        
    }

    /**
         * List all categories_model
         *
         * @return void
    */
    public function index()
    {
        $data['insertScripts'] = array('js_delete_category');
        $data['query'] = $this->categories->fetchAll();
        $data['page'] = 'store/categories_view';
        loadView($data);
    }
    
    /**
         * Add new category
         *
         * @return void
    */
    function add()
    {
        if(IS_STORE_DEMO){
            redirect('manage_categories/add');
            return true;
        }
        $this->load->helper('form');
        $this->load->library('Form_validation');
        $val = $this->form_validation;
        
        $val->set_rules(
            'category_name', __('Category Name'), 
            'trim|xss_clean|required|min_length[4]|is_unique[categories.name]'
        );
        $val->set_error_delimiters(
            '<span class="help-inline error_msg">', 
            '</span>'
        );
        $val->set_message('is_unique', __('Same category already Exist!!'));
        
        if ($val->run()) {
            $data['name'] = $this->input->post('category_name');
            $categoryAdded = $this->categories->add($data);
            if ($categoryAdded) {
                $data['temp_msg'] = __('Category Added!!');
            }
        }
        
        $data['page'] = 'store/add_category_form';
        loadView($data);
        
    }
    
    /**
         * Edit new category
         *
         * @param number $cat_id category id     
         *                 
         * @return void
    */  
    function edit($cat_id = null)
    {
    
        if ($cat_id == null) {
            show_404();
        }
        
        $data['query'] = $this->categories->fetch($cat_id);

        if (!$data['query']) {
            show_404();
            exit();
        }

        $this->load->helper('form');
        $this->load->library('Form_validation');
        $val = $this->form_validation;
        
        $val->set_rules(
            'category_name', 
            __('Category Name'), 
            'trim|xss_clean|required|min_length[4]'
        );
        $val->set_rules(
            'category_id', 
            __('Category ID'), 
            'trim|xss_clean|required|numeric'
        );
        
        $val->set_error_delimiters(
            '<span class="help-inline error_msg">', 
            '</span>'
        );
        
        $category_id = $this->input->post('category_id', true);
        
        if ($val->run()) {

            if(IS_STORE_DEMO){
                redirect('manage_categories/edit/'.$cat_id);
                return true;
            }

            $category_name = $this->input->post('category_name');

            if ($data['query'][0]->name != $category_name ) {
                $update_data['name'] = $category_name;
            }
                

            if (isset($update_data) AND !empty($update_data)) {
                if ($this->categories->edit($category_id, $update_data)) {
                    $data['query'][0]->name = $category_name;
                    $data['temp_msg'] = __('Category Updated!!');
                }
            } else {
                $data['temp_msg'] = __('No changes!!');
            }
            
        }
        
        $data['page'] = 'store/edit_category_form';
        loadView($data);
    }
    
    /**
             * delete product category
             *
             * @param number $cat_id category id     
             *        
             * @return void
    */  
    function delete($cat_id = null)
    {
        if(IS_STORE_DEMO){
            redirect('manage_categories');
            return true;
        }
    
        if ($cat_id == null) {
            redirect('manage_categories');
        }
        
        $this->load->model('products_model', 'products');       
        $query = $this->products->fetchByCategory($cat_id);
        
        if ($query) {
            foreach ($query as $row) {
                $thumb_path = $this->config->item('thumb_path').$row->thumbnail;
                if (file_exists($thumb_path)) {
                    unlink($thumb_path);
                }
            }
        }
        
        if ($this->categories->delete($cat_id)) {
            setFlashMsg(__('Category Deleted'));
            redirect('manage_categories');
        }
        
    }
}

/* End of file manage_categories.php */
/* Location: ./lw_application/controllers/manage_categories.php */