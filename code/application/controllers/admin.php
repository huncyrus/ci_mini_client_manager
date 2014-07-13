<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
 // for developing
 error_reporting(E_ALL);
 ini_set('display_errors', 1);
 
 
/*
 * admin
 * Admin app for CodeIgniter 2.2x framework. This is the CI Mini Client Manager
 * @author Györk "huncyrus" Bakonyi <huncyrus@gmail.com>
 * @todo finish it (implement email newsletter section, improve client management)
 * @version 0.6b
 */
class admin extends CI_Controller {
  
  /*
   * __construct
   * The class constructor
   * @return void
   * @access public
   */
  public function __construct() {
      parent::__construct();
      
      // pre-hoak
      $CI =& get_instance();
      $CI->load->library('session');
      // re-hoak ci session handling
      $this->load->library('session');
      $this->session = $CI->session;
      
      // init
      $this->load->helper('url');
      $this->load->helper('form');
      $this->load->library('form_validation');
      $this->load->model('Admin_model');
      
      $dbconnect = $this->load->database();
  }
  //

  
  /*
   * index
   * main method of ci class
   * @return void
   * @access public
   */
  public function index() {
    if(!isset($this->session->userdata['userdata'])) {
      redirect('admin/login');      
    } else if($this->session->userdata['userdata'] == 'is_logged_in') {
      $data['section'] = 'admin_welcome';
      $this->load->view('admin', $data);
    } else {
      redirect('admin/login');
    }
  }
  // index end
  
  
  /*
   * login
   * Form for user login
   * @return void
   * @access public 
   */
  public function login() {
    if (!isset($this->session->userdata['userdata']) || $this->session->userdata['userdata'] != 'is_logged_in') {
      $this->load->view('login');
    } else {
      redirect('admin/index');
    }
  }
  //
  

  /*
   * validate
   * Custom validate method.
   * @param string $field the data what we want to validate
   * @param string $type the type what validation type we looking for. be: user, pass
   * @return boolean
   * @access private
   * @todo move to library, finish it
   */
  private function validate($field = '', $type = 'user') {
    $this->debug('method: validate | field: ' . $field . ' | type: ' . $type);
    if (isset($field) && !empty($field)) {
      if (strlen($field) < 3 || strlen($field) > 200) {
	return false;
      }
      switch ($type) {
	case 'user':
	  if (preg_match("/^[A-Za-z0-9 ]+$/", $field)) {
	    return true;
	  } else {
	    return false;
	  }
	  break;
	case 'pass':
	  if (preg_match("/^[A-Za-z0-9 ]+$/", $field)) {
	    return true;
	  } else {
	    return false;
	  }
	  break;
	case 'date':
	  if(strlen($field) > 0) {
	    $date = date('Y', strtotime($field));
	    if ($date == "1969" || $date == '') {
	      return false;
	    } else {
	      return true;
	    }
	  } else {
	    return false;
	  }
	  break;
	case 'email':
	  if(strlen($field) > 0) {
	    $pattern = "/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)+/";
	    if (preg_match($pattern, $field)) {
	      return true;
	    } else {
	      return false;
	    }
	  } else {
	    return false;
	  }
	  break;
	case 'phone':
	  // not yet
	  break;
	case 'length3':
	  if (strlen($field) < 3) {
	    return false;
	  } else {
	    return true;
	  }
	  break;
      }
    } else {
      return false;
    }
  }
  // fn end
  
  
  /*
   * debug
   * Debug to file
   * @param string $msg the debug message
   * @access private
   * @return none
   */
  private function debug($msg = '') {
    $fo = fopen('log.txt', 'a');
    $log = '[' . date('Y-m-d H:i:s') .'] msg: ' . $msg . '[/close]' . "\r\n";
    fwrite($fo, $log);
    fclose($fo);
    unset($fo, $log, $msg);
  }
  // method end
  
  
  /*
   * do_login
   * The login process controller part
   * @return void
   * @access public
   */
  public function do_login() {
    if (isset($this->session->userdata['userdata']) && $this->session->userdata['userdata'] == 'is_logged_in') {
      redirect('admin/index');
    } else {
      if ($this->input->post('submit')) {

	$username = strip_tags( $this->input->post('user_name') );
	$pass = md5( strip_tags( $this->input->post('pass') ) );
	
	//$this->form_validation->set_rules('username', 'Username', 'required|min_length[3]|max_length[200]|xss_clean|alpha_numeric');
	//$this->form_validation->set_rules('pass', 'Password', 'required|xss_clean|alpha_numeric|min_lenght[3]|max_length[200]');
	
	if( ($this->validate($username, 'user') == true) && ($this->validate($pass, 'pass') == true) ) {
	  if ($this->Admin_model->login_process($username, $pass) == true) {
	    $data = array(
	      'userdata' => 'is_logged_in',
	      'username' => $username
	    );
	    $this->session->set_userdata($data);
	    redirect('admin');
	  } else {
	    $data['message_error'] = TRUE;
	    $this->load->view('login', $data);
	  }
	  // elsse end
	} else {
	  // validation fallback
	  $data['message_error'] = TRUE;
	  $this->load->view('login', $data);
	}
      } else {
	$data['message_error'] = TRUE;
	$this->load->view('login', $data);
      }
      // else end
    }
    // else end
  }
  // fn end
  
  
  /*
   * logout
   * Logout the user, kill the session etc...
   * @return void
   * @access public
   */
  public function logout() {
    $this->session->sess_destroy();
    redirect('admin');
  }
  //
  
  
  
  /*
   * emails
   * Email list view, all sended email news-letter
   * @param none
   * @return void
   * @access public
   * @todo finish it!
   */
  public function emails() {
    
  }
  //
  
  
  /*
   * email_send
   * Email sender form - ctrl/view
   * @param none
   * @return void
   * @access public
   * @todo finish it!
   */
  public function email_send() {
    
  }
  //
  
  
}
// class end

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */