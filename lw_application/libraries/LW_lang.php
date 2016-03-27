<?php 
/**
 * Store Language Library
 *
 * PHP version 5.2.4 or newer
 *
 * @category   LibraryFile
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
    
// define constants
if (!defined('PROJECT_DIR')) {
    define('PROJECT_DIR', realpath('./'));
}

if (!defined('LOCALE_DIR')) {
    define('LOCALE_DIR', PROJECT_DIR .'/locale');
}


/**
 * Store Settings Model
 *
 * @category   LibraryFile 
 * @package    JQueryPHPStoreShop
 * @author     Vinod <livelyworks@gmail.com>
 * @copyright  2013 LivelyWorks. (http://livelyworks.net)
 * @license    LivelyWorks (http://livelyworks.net)
 * @link       http://livelyworks.net
 * @since      Version 1.0
 * @deprecated NA
 */
class LW_Lang
{
    /**
         * Constructor
         *
         * @return void
    */
    function __construct()
    {
        if (!defined('DEFAULT_LOCALE')) {
             define('DEFAULT_LOCALE', config_item('default_language'));
        }

        $this->_setLocale();
    }

    /**
         * Modify Language
         *
         * @param string $language language          
         * 
         * @return boolean
    */
    function modifyLanguage($language)
    {

        $CI =& get_instance();

        $availableLanguages = config_item('availableLanguages');
        $locale = (isset($language) AND isset($availableLanguages[$language])) 
        ? $language : DEFAULT_LOCALE;

        $CI->session->set_userdata('current_store_lang', $locale);

        $this->_setLocale();

        return true;

    }

    /**
         * Setting Locale         
         * 
         * @return boolean
    */
    function _setLocale()
    {
        if (!function_exists("gettext"))
        {
            return false;
            
        }

        $CI =& get_instance();

        $encoding = 'utf-8';

        $locale = $CI->session->userdata('current_store_lang');

        $locale = isset($locale) ? $locale : DEFAULT_LOCALE;


        $domain = 'messages';

        putenv('LC_ALL='.$locale.".utf8");
        setlocale(LC_ALL, $locale.".utf8");

        bindtextdomain($domain, LOCALE_DIR);
        bind_textdomain_codeset($domain, 'UTF-8');
        textdomain($domain);

    }

    /**
         * Setting Default Language
         * 
         * @return boolean
    */
    function setDefaultLang()
    {
        putenv('LC_ALL='.DEFAULT_LOCALE.".utf8");
        setlocale(LC_ALL, DEFAULT_LOCALE.".utf8");
    }

    /**
         * Setting English Language
         * 
         * @return boolean
    */
    function setEngLang()
    {
        putenv("LC_ALL=en_US.utf8");
        setlocale(LC_ALL, "en_US.utf8");
    }

    /**
         * Restore last Language
         * 
         * @return boolean
    */
    function restoreLastLang()
    {
        $CI =& get_instance();
        $locale = $CI->session->userdata('current_store_lang');
        $locale = isset($locale) ? $locale : DEFAULT_LOCALE;
        putenv('LC_ALL='.$locale.".utf8");
        setlocale(LC_ALL, $locale.".utf8");
    }

}

/* End of file LW_lang.php */
/* Location: ./application/libraries/LW_lang.php */