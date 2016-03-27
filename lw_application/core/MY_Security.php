<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
	 * Security class extended
	 *
	 * @return void
*/

class MY_Security extends CI_Security {
 
 
    public function csrf_show_error()
	{
		//show_error('Error message');
		header('Location: '.$_SERVER['REQUEST_URI']);
	}
}

/* End of file My_Security.php */
/* Location: ./lw_application/core/My_Security.php */