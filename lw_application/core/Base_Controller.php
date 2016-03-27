<?php 
/**
 * Store Base Controller
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
 * Store Settings Model
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
class Base_Controller extends CI_Controller
{

    /**
     * Constructor
     *
     * @return void
    */
    public function __construct()
    {
        parent::__construct();

        $lang = trim(strip_tags($this->input->get('lang', true)));
        $availableThemes = $this->config->item('available_themes');

        if (isset($lang) and $lang != '') {
             $this->lw_lang->modifyLanguage($lang);
        }

        $theme = trim(strip_tags($this->input->get('theme', true)));

        if (isset($theme) and $theme != '') {

            if(in_array($theme, $availableThemes))
            {
                $this->session->set_userdata('current_store_theme', $theme);
                $this->config->set_item('apply_theme', $theme);
            }
        } else {
            
            $currentTheme = $this->session->userdata('current_store_theme');
            if (isset($currentTheme)) {
                if(in_array($currentTheme, $availableThemes))
                {
                    $this->session->set_userdata('current_store_theme', $currentTheme);
                    $this->config->set_item('apply_theme', $currentTheme);
                }
            } 
        }
       
    }
}

/* End of file Base_Controller.php */
/* Location: ./lw_application/core/Base_Controller.php */