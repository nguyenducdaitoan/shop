<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends Base_Controller
{

    public $current_locale = '';

    /**
     * cunstructor
     *
     * @return void
     */
    function __construct()
    {
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        //$this->load->library('security');
        $this->load->library('tank_auth');
        $this->lang->load('tank_auth');

    }

    /**
     * index action
     *
     * @return void
     */
    function index()
    {
        if ($message = $this->session->flashdata('message')) {
            $data['message'] = $message;
            $data['page'] = 'auth/general_message';
            loadView($data);

        } else {
            redirect('/auth/login/');
        }
    }

    /**
     * Login user on the site
     *
     * @return void
     */
    function login()
    {
        if ($this->tank_auth->is_logged_in()) {                                 // logged in
            redirect('');

        } elseif ($this->tank_auth->is_logged_in(false)) {                      // logged in, not activated
            redirect('/auth/send_again/');

        } else {
            $data['login_by_username'] = ($this->config->item('login_by_username', 'tank_auth') AND
                    $this->config->item('use_username', 'tank_auth'));
            $data['login_by_email'] = $this->config->item('login_by_email', 'tank_auth');

            $this->form_validation->set_rules('login', __('Login'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', __('Password'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('remember', __('Remember me'), 'integer');

            // Get login for counting attempts to login
            if ($this->config->item('login_count_attempts', 'tank_auth') AND ($login = $this->input->post('login'))) {
                $login = $this->security->xss_clean($login);
            } else {
                $login = '';
            }

            $data['use_recaptcha'] = $this->config->item('use_recaptcha', 'tank_auth');
            if ($this->tank_auth->is_max_login_attempts_exceeded($login)) {
                if ($data['use_recaptcha'])
                    $this->form_validation->set_rules('recaptcha_response_field', __('Confirmation Code'), 'trim|xss_clean|required|callback__check_recaptcha');
                else {
                    $this->form_validation->set_rules('captcha', __('Confirmation Code'), 'trim|required|xss_clean|callback_check_captcha');
                }
                    
            }
            $data['errors'] = array();

            if ($this->form_validation->run()) {                                // validation ok
                if ($this->tank_auth->login(
                    $this->form_validation->set_value('login'),
                    $this->form_validation->set_value('password'),
                    $this->form_validation->set_value('remember'),
                    $data['login_by_username'],
                    $data['login_by_email']
                )) {                             // success
                    redirect('');
                } else {
                    $errors = $this->tank_auth->get_error_message();
                    if (isset($errors['banned'])) {                             // banned user
                        $this->_show_message($this->lang->line('auth_message_banned').' '.$errors['banned']);

                    } elseif (isset($errors['not_activated'])) {                // not activated user
                        redirect('/auth/send_again/');

                    } else {                                                    // fail
                        foreach ($errors as $k => $v)   $data['errors'][$k] = $this->lang->line($v);
                    }
                }
            }
            $data['show_captcha'] = false;
            if ($this->tank_auth->is_max_login_attempts_exceeded($login)) {
                $data['show_captcha'] = true;
                if ($data['use_recaptcha']) {
                    $data['recaptcha_html'] = $this->_create_recaptcha();
                } else {
                    $data['captcha_html'] = '';
                }
            }
            
            $data['page'] = 'auth/login_form';

            loadView($data);

        }
    }

    /**
     * Logout user
     *
     * @return void
     */
    function logout()
    {
        $this->current_locale = $this->session->userdata('current_store_lang');

        $this->tank_auth->logout();

        $this->_show_message($this->lang->line('auth_message_logged_out'), false);

        redirect('/auth/?lang='.$this->current_locale);
    }

    /**
     * Register user on the site
     *
     * @return void
     */
    function register()
    {
        if(IS_STORE_DEMO){
            redirect();     return true;
        }
        
        if ($this->tank_auth->is_logged_in()) {                                 // logged in
            redirect('');

        } elseif ($this->tank_auth->is_logged_in(false)) {                      // logged in, not activated
            redirect('/auth/send_again/');

        } elseif (!$this->config->item('allow_registration', 'tank_auth')) {    // registration is off
            $this->_show_message($this->lang->line('auth_message_registration_disabled'));

        } else {
            $use_username = $this->config->item('use_username', 'tank_auth');
            if ($use_username) {
                $this->form_validation->set_rules('username', __('Username'), 'trim|required|xss_clean|min_length['.$this->config->item('username_min_length', 'tank_auth').']|max_length['.$this->config->item('username_max_length', 'tank_auth').']|alpha_dash');
            }
            $this->form_validation->set_rules('email', __('Email'), 'trim|required|xss_clean|valid_email');
            $this->form_validation->set_rules('password', __('Password'), 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
            $this->form_validation->set_rules('confirm_password', __('Confirm Password'), 'trim|required|xss_clean|matches[password]');

            $captcha_registration   = $this->config->item('captcha_registration', 'tank_auth');
            $use_recaptcha          = $this->config->item('use_recaptcha', 'tank_auth');
            if ($captcha_registration) {
                if ($use_recaptcha) {
                    $this->form_validation->set_rules('recaptcha_response_field', __('Confirmation Code'), 'trim|xss_clean|required|callback__check_recaptcha');
                } else {
                    $this->form_validation->set_rules('captcha', __('Confirmation Code'), 'trim|required|xss_clean|callback_check_captcha');
                }
            }
            $data['errors'] = array();

            $email_activation = $this->config->item('email_activation', 'tank_auth');

            if ($this->form_validation->run()) {                                // validation ok
                if (!is_null(
                    $data = $this->tank_auth->create_user(
                        $use_username ? $this->form_validation->set_value('username') : '',
                        $this->form_validation->set_value('email'),
                        $this->form_validation->set_value('password'),
                        $email_activation
                    )
                )) {                                  // success

                    $store_settings = getSettingsItem();
                    $site_name = $store_settings['store_name'];

                    $data['site_name'] = $site_name;

                    if ($email_activation) {                                    // send "activate" email
                        $data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

                        $this->_send_email('activate', $data['email'], $data);

                        unset($data['password']); // Clear password (just for any case)

                        $this->_show_message($this->lang->line('auth_message_registration_completed_1'));

                    } else {
                        if ($this->config->item('email_account_details', 'tank_auth')) {    // send "welcome" email

                            $this->_send_email('welcome', $data['email'], $data);
                        }
                        unset($data['password']); // Clear password (just for any case)

                        $this->_show_message($this->lang->line('auth_message_registration_completed_2').' '.anchor('/auth/login/', __('Login')));
                    }
                } else {
                    $errors = $this->tank_auth->get_error_message();
                    foreach ($errors as $k => $v)   $data['errors'][$k] = $this->lang->line($v);
                }
            }
            if ($captcha_registration) {
                if ($use_recaptcha) {
                    $data['recaptcha_html'] = $this->_create_recaptcha();
                } else {
                    $data['captcha_html'] = '';
                }
            }
            $data['use_username'] = $use_username;
            $data['captcha_registration'] = $captcha_registration;
            $data['use_recaptcha'] = $use_recaptcha;
            

            $data['page'] = 'auth/register_form';
            loadView($data);

        }
    }

    /**
     * Send activation email again, to the same or new email address
     *
     * @return void
     */
    function send_again()
    {
        if(IS_STORE_DEMO){
            redirect();     return true;
        }

        if (!$this->tank_auth->is_logged_in(false)) {                           // not logged in or activated
            redirect('/auth/login/');

        } else {
            $this->form_validation->set_rules('email', __('Email'), 'trim|required|xss_clean|valid_email');

            $data['errors'] = array();

            if ($this->form_validation->run()) {                                // validation ok
                if (!is_null($data = $this->tank_auth->change_email(
                        $this->form_validation->set_value('email')))) {         // success

                    $store_settings = getSettingsItem();
                    $site_name = $store_settings['store_name'];

                    $data['site_name']  = $site_name;
                    $data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

                    $this->_send_email('activate', $data['email'], $data);

                    $this->_show_message(sprintf($this->lang->line('auth_message_activation_email_sent'), $data['email']));

                } else {
                    $errors = $this->tank_auth->get_error_message();
                    foreach ($errors as $k => $v)   $data['errors'][$k] = $this->lang->line($v);
                }
            }
            
            $data['page'] = 'auth/send_again_form';
            loadView($data);
        }
    }

    /**
     * Activate user account.
     * User is verified by user_id and authentication code in the URL.
     * Can be called by clicking on link in mail.
     *
     * @return void
     */
    function activate()
    {
        if(IS_STORE_DEMO){
            redirect();     return true;
        }

        $user_id        = $this->uri->segment(3);
        $new_email_key  = $this->uri->segment(4);

        // Activate user
        if ($this->tank_auth->activate_user($user_id, $new_email_key)) {        // success
            $this->tank_auth->logout();
            $this->_show_message($this->lang->line('auth_message_activation_completed').' '.anchor('/auth/login/', __('Login')));

        } else {                                                                // fail
            $this->_show_message($this->lang->line('auth_message_activation_failed'));
        }
    }

    /**
     * Generate reset code (to change password) and send it to user
     *
     * @return void
     */
    function forgot_password()
    {
        if ($this->tank_auth->is_logged_in()) {                                 // logged in
            redirect('');

        } elseif ($this->tank_auth->is_logged_in(false)) {                      // logged in, not activated
            redirect('/auth/send_again/');

        } else {
            $this->form_validation->set_rules('login', __('Email or login'), 'trim|required|xss_clean');

            $data['errors'] = array();

            if ($this->form_validation->run()) {                                // validation ok
                if (!is_null($data = $this->tank_auth->forgot_password(
                        $this->form_validation->set_value('login')))) {

                    if(IS_STORE_DEMO){
                        redirect();     return true;
                    }

                    $store_settings = getSettingsItem();
                    $site_name = $store_settings['store_name'];

                    $data['site_name'] = $site_name;

                    // Send email with password activation link
                    $this->_send_email('forgot_password', $data['email'], $data);

                    $this->_show_message($this->lang->line('auth_message_new_password_sent'));

                } else {
                    $errors = $this->tank_auth->get_error_message();
                    foreach ($errors as $k => $v)   $data['errors'][$k] = $this->lang->line($v);
                }
            }

            $data['page'] = 'auth/forgot_password_form';
            loadView($data);
        }
    }

    /**
     * Replace user password (forgotten) with a new one (set by user).
     * User is verified by user_id and authentication code in the URL.
     * Can be called by clicking on link in mail.
     *
     * @return void
     */
    function reset_password()
    {
        $user_id        = $this->uri->segment(3);
        $new_pass_key   = $this->uri->segment(4);

        $this->form_validation->set_rules('new_password', __('New Password'), 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
        $this->form_validation->set_rules('confirm_new_password', __('Confirm new Password'), 'trim|required|xss_clean|matches[new_password]');

        $data['errors'] = array();

        if ($this->form_validation->run()) {                                // validation ok

            if(IS_STORE_DEMO){
                redirect();     return true;
            }

            if (!is_null($data = $this->tank_auth->reset_password(
                    $user_id, $new_pass_key,
                    $this->form_validation->set_value('new_password')))) {  // success

                $store_settings = getSettingsItem();
                $site_name = $store_settings['store_name'];

                $data['site_name'] = $site_name;

                // Send email with new password
                $this->_send_email('reset_password', $data['email'], $data);

                $this->_show_message($this->lang->line('auth_message_new_password_activated').' '.anchor('/auth/login/', __('Login')));

            } else {                                                        // fail
                $this->_show_message($this->lang->line('auth_message_new_password_failed'));
            }
        } else {
            // Try to activate user by password key (if not activated yet)
            if ($this->config->item('email_activation', 'tank_auth')) {
                $this->tank_auth->activate_user($user_id, $new_pass_key, false);
            }

            if (!$this->tank_auth->can_reset_password($user_id, $new_pass_key)) {
                $this->_show_message($this->lang->line('auth_message_new_password_failed'));
            }
        }
        
            $data['page'] = 'auth/reset_password_form';
            loadView($data);
    }

    /**
     * Change user password
     *
     * @return void
     */
    function change_password()
    {
        if (!$this->tank_auth->is_logged_in()) {                                // not logged in or not activated
            redirect('/auth/login/');

        } else {
            $this->form_validation->set_rules('old_password', __('Old Password'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('new_password', __('New Password'), 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
            $this->form_validation->set_rules('confirm_new_password', __('Confirm new Password'), 'trim|required|xss_clean|matches[new_password]');

            $data['errors'] = array();

            if ($this->form_validation->run()) {   

                if(IS_STORE_DEMO){
                    redirect();     return true;
                }
                                         // validation ok
                if ($this->tank_auth->change_password(
                        $this->form_validation->set_value('old_password'),
                        $this->form_validation->set_value('new_password'))) {   // success
                    $this->_show_message($this->lang->line('auth_message_password_changed'));

                } else {                                                        // fail
                    $errors = $this->tank_auth->get_error_message();
                    foreach ($errors as $k => $v)   $data['errors'][$k] = $this->lang->line($v);
                }
            }
            
            $data['page'] = 'auth/change_password_form';
            loadView($data);
        }
    }

    /**
     * Change user email
     *
     * @return void
     */
    function change_email()
    {
        if (!$this->tank_auth->is_logged_in()) {                                // not logged in or not activated
            redirect('/auth/login/');

        } else {
            $this->form_validation->set_rules('password', __('Password'), 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', __('Email'), 'trim|required|xss_clean|valid_email');

            $data['errors'] = array();

            if ($this->form_validation->run()) {                                // validation ok

                if(IS_STORE_DEMO){
                    redirect();     return true;
                }

                if (!is_null($data = $this->tank_auth->set_new_email(
                        $this->form_validation->set_value('email'),
                        $this->form_validation->set_value('password')))) {          // success

                    $store_settings = getSettingsItem();
                    $site_name = $store_settings['store_name'];

                    $data['site_name'] = $site_name;

                    // Send email with new email address and its activation link
                    $this->_send_email('change_email', $data['new_email'], $data);

                    $this->_show_message(sprintf($this->lang->line('auth_message_new_email_sent'), $data['new_email']));

                } else {
                    $errors = $this->tank_auth->get_error_message();
                    foreach ($errors as $k => $v)   $data['errors'][$k] = $this->lang->line($v);
                }
            }
            
            $data['page'] = 'auth/change_email_form';
            loadView($data);
        }
    }

    /**
     * Replace user email with a new one.
     * User is verified by user_id and authentication code in the URL.
     * Can be called by clicking on link in mail.
     *
     * @return void
     */
    function reset_email()
    {
        if(IS_STORE_DEMO){
            redirect();     return true;
        }

        $user_id        = $this->uri->segment(3);
        $new_email_key  = $this->uri->segment(4);

        // Reset email
        if ($this->tank_auth->activate_new_email($user_id, $new_email_key)) {   // success
            $this->tank_auth->logout();
            $this->_show_message($this->lang->line('auth_message_new_email_activated').' '.anchor('/auth/login/', __('Login')));

        } else {                                                                // fail
            $this->_show_message($this->lang->line('auth_message_new_email_failed'));
        }
    }

    /**
     * Delete user from the site (only when user is logged in)
     *
     * @return void
     */
    function unregister()
    {
        if(IS_STORE_DEMO){
            redirect();     return true;
        }

        if (!$this->tank_auth->is_logged_in()) {                                // not logged in or not activated
            redirect('/auth/login/');

        } else {
            $this->form_validation->set_rules('password', __('Password'), 'trim|required|xss_clean');

            $data['errors'] = array();

            if ($this->form_validation->run()) {                                // validation ok
                if ($this->tank_auth->delete_user(
                        $this->form_validation->set_value('password'))) {       // success
                    $this->_show_message($this->lang->line('auth_message_unregistered'));

                } else {                                                        // fail
                    $errors = $this->tank_auth->get_error_message();
                    foreach ($errors as $k => $v)   $data['errors'][$k] = $this->lang->line($v);
                }
            }
            
            $data['page'] = 'auth/unregister_form';
            loadView($data);
        }
    }

    /**
     * Show info message
     *
     * @param   string
     * @return  void
     */
    function _show_message($message, $doRedirect = true)
    {

        $set_message = '<div class="alert alert-info">'.$message.'</div>';

        $this->session->set_flashdata('message', $set_message);

        if ($doRedirect == true)
        redirect('/auth/');
    }

    /**
     * Send email message of given type (activate, forgot_password, etc.)
     *
     * @param   string
     * @param   string
     * @param   array
     * @return  void
     */
    function _send_email($type, $email, &$data)
    {
        if(IS_STORE_DEMO){
            redirect();
            return true;
        }

        $this->load->library('email');

        $store_settings = getSettingsItem();
        $businessEmail = $store_settings['business_email'];
        $site_name = $store_settings['store_name'];

        $this->email->from($businessEmail, $site_name);
        $this->email->reply_to($businessEmail, $site_name);
        $this->email->to($email);
        $this->email->subject(sprintf($this->lang->line('auth_subject_'.$type), $site_name));
        $data['page'] = 'email/'.$type.'-html'; //;$this->load->view('email/'.$type.'-html', $data, true)
        $this->email->message(loadView($data,null, true));
        $data['page'] = 'email/'.$type.'-txt'; //; $this->load->view('email/'.$type.'-txt', $data, true)
        $this->email->set_alt_message(loadView($data,null, true));
        $this->email->send();
    }

    /**
     * Create CAPTCHA image to verify user as a human
     *
     * @return  string
     */
    function _create_captcha()
    {
        $this->load->helper('captcha');

        $cap = create_captcha(array(
            'img_path'      => './'.$this->config->item('captcha_path', 'tank_auth'),
            'img_url'       => base_url().$this->config->item('captcha_path', 'tank_auth'),
            'font_path'     => './'.$this->config->item('captcha_fonts_path', 'tank_auth'),
            'font_size'     => $this->config->item('captcha_font_size', 'tank_auth'),
            'img_width'     => $this->config->item('captcha_width', 'tank_auth'),
            'img_height'    => $this->config->item('captcha_height', 'tank_auth'),
            'show_grid'     => $this->config->item('captcha_grid', 'tank_auth'),
            'expiration'    =>  $this->config->item('captcha_expire', 'tank_auth'),
            //'word'    => 'Vinod'
        ));

        // Save captcha params in session
        // $this->session->set_flashdata(array(
        //      'captcha_word' => $cap['word'],
        //      'captcha_time' => $cap['time'],
        // ));

        $newdata = array(
                   'captcha_word'  => $cap['word'],
                   'captcha_time'     => $cap['time']
               );

        $this->session->set_userdata($newdata);

        return $cap['image'];
    }

    /**
     * Callback function. Check if CAPTCHA test is passed.
     *
     * @param   string
     * @return  bool
     */
    function _check_captcha($code)
    {
        //$time = $this->session->flashdata('captcha_time');
        //$word = $this->session->flashdata('captcha_word');

        $word = $this->session->userdata('captcha_word');
        $time = $this->session->userdata('captcha_time');

        list($usec, $sec) = explode(" ", microtime());
        $now = ((float)$usec + (float)$sec);

        if ($now - $time > $this->config->item('captcha_expire', 'tank_auth')) {
            $this->form_validation->set_message('_check_captcha',$this->lang->line('auth_captcha_expired') );

            $this->session->unset_userdata('captcha_word');
            $this->session->unset_userdata('captcha_time');
            return false;

        } elseif (($this->config->item('captcha_case_sensitive', 'tank_auth') AND
                $code != $word) OR
                strtolower($code) != strtolower($word)) {
            $this->form_validation->set_message('_check_captcha', $this->lang->line('auth_incorrect_captcha'));

            $this->session->unset_userdata('captcha_word');
            $this->session->unset_userdata('captcha_time');

            return false;
        }
        return true;
    }

    /**
     * Create reCAPTCHA JS and non-JS HTML to verify user as a human
     *
     * @return  string
     */
    function _create_recaptcha()
    {
        $this->load->helper('recaptcha');

        // Add custom theme so we can get only image
        $options = "<script>var RecaptchaOptions = {theme: 'custom', custom_theme_widget: 'recaptcha_widget'};</script>\n";

        // Get reCAPTCHA JS and non-JS HTML
        $html = recaptcha_get_html($this->config->item('recaptcha_public_key', 'tank_auth'));

        return $options.$html;
    }

    /**
     * Callback function. Check if reCAPTCHA test is passed.
     *
     * @return  bool
     */
    function _check_recaptcha()
    {
        $this->load->helper('recaptcha');

        $resp = recaptcha_check_answer($this->config->item('recaptcha_private_key', 'tank_auth'),
                $_SERVER['REMOTE_ADDR'],
                $_POST['recaptcha_challenge_field'],
                $_POST['recaptcha_response_field']);

        if (!$resp->is_valid) {
            $this->form_validation->set_message('_check_recaptcha', $this->lang->line('auth_incorrect_captcha'));
            return false;
        }
        return true;
    }
    
    /// Custom cool captcha functions
    function create_captcha(){

        require_once('libs/Captcha.php');
        $captcha = new SimpleCaptcha();
        $captcha->CreateImage();
    }
    /**
     * Check Captcha on the site
     *
     * @return void
     */
    function check_captcha($captcha_code){
        if (!empty($captcha_code)) {    
            if (empty($_SESSION['captcha']) || trim(strtolower($captcha_code)) != $_SESSION['captcha']) {
                $this->form_validation->set_message('check_captcha', __('Verification code incorrect'));
                unset($_SESSION['captcha']);
                return false;
            } 
            else 
            {
                $this->load->model('tank_auth/login_attempts','loginattmp');
                $this->loginattmp->clear_attempts($this->input->ip_address());

                unset($_SESSION['captcha']);
                return true;
            }
        }else{
                $this->form_validation->set_message('check_captcha', __('Verification code incorrect'));
                unset($_SESSION['captcha']);
                return false;
        }
    }

}

/* End of file auth.php */
/* Location: ./lw_application/controllers/auth.php */