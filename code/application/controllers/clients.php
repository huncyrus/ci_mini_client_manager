<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
 // for developing
 error_reporting(E_ALL);
 ini_set('display_errors', 1);

 
/**
 *
 * clients
 * Client manager CI modul
 * @version 0.7.2b
 * @author Györk "huncyrus" Bakonyi <huncyrus@gmail.com>
 * @copyright Copyright (c) 2014, Györk "huncyrus" Bakonyi
 * @todo file upload config move into config file!
 */
 class clients extends CI_Controller {
  
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
      $this->load->library('validator');
      $this->load->model('Clients_model');
      
      $dbconnect = $this->load->database();
  }
  //

  
  /**
   * index
   * The main method of this class
   * @param none
   * @return void
   * @access public
   */
  public function index() {
    if(!isset($this->session->userdata['userdata'])) {
      redirect('admin/login');      
    } else if($this->session->userdata['userdata'] == 'is_logged_in') {
      $data['section'] = 'clients_list';
      $data['client_list'] = $this->Clients_model->get_client_list();
      $this->load->view('clients', $data);
    } else {
      redirect('admin/login');
    }
  }
  //
  
  
  /*
   * clients
   * Basic client management (with delete & update option), listing and an add form
   * @access public
   * @return void
   */
  public function clients_list() {
    if (!isset($this->session->userdata['userdata']) || $this->session->userdata['userdata'] != 'is_logged_in') {
      redirect('admin/login');
    } else {
      $data['client_list'] = $this->Clients_model->get_client_list();
      $data['section'] = 'clients_list';
      $this->load->view('clients', $data);
    }
  }
  //
  

  /*
   * add_client
   * Add a new client to the database, ctrl+view
   * @param none
   * @return void
   * @access public
   */
  public function add_client() {
    if (!isset($this->session->userdata['userdata']) || $this->session->userdata['userdata'] != 'is_logged_in') {
      redirect('admin/login');
    } else {
      $data['client_list'] = $this->Clients_model->get_client_list();
      $data['section'] = 'add_clients';
      $this->load->view('clients', $data);
    }
  }
  //
  
  
  /*
   * save_client
   * Saving the client data what sended via add_client form
   * @param none
   * @return void
   * @access public
   */
  public function save_client() {
    if (!isset($this->session->userdata['userdata']) || $this->session->userdata['userdata'] != 'is_logged_in') {
      redirect('admin/login');
    } else {
      $dataset = array(
	'name' => strip_tags(htmlspecialchars($this->input->post('name'))),
	'phone' => strip_tags(htmlspecialchars($this->input->post('phone'))),
	'email' => strip_tags(htmlspecialchars($this->input->post('email'))),
	'photo_url' => '',
	'birth' => strip_tags(htmlspecialchars($this->input->post('birth'))),
	'crdate' => date('Y-m-d H:i:s'),
	'other' => strip_tags(htmlspecialchars($this->input->post('other')))
      );

      $error = array('validation_error' => 0, 'error' => '');
      $error['validation_error'] = 0;
      //if ($this->validator->validate($dataset['name'], 'length3') == false) {
      if ($this->validator->validate($dataset['name'], 'length3') == false) {
	$error['validation_error'] = 1;
	$error['error'] .= 'name error, ';
      }
      if ($this->validator->validate($dataset['email'], 'email') == false) {
	$error['validation_error'] = 1;
	$error['error'] .= 'email error, ';
      }
      if ($dataset['birth'] == '') {
	$dataset['birth'] = date('Y-m-d');
      }

      if (isset($_FILES) && isset($_FILES['photo_url']) && !empty($_FILES['photo_url']['name']) ) {
	$this->form_validation->set_rules('photo_url', 'File', 'trim|xss_clean');
  
	if ($this->form_validation->run() == FALSE) {
	  $this->file();
	  $dataset['photo_url'] = '';
	  $error['validation_error'] = 1;
	  $error['error'] .= 'file error2, ';

	} else {
	  $config['upload_path']   = './assets/';
	  $config['allowed_types'] = 'gif|jpg|png';
	  $config['max_size']      = '2000';
	  $config['max_width']     = '4024';
	  $config['max_height']    = '3768';

	  $this->load->library('upload', $config);
	
	  if ( !$this->upload->do_upload('photo_url',FALSE)) {
	    $this->form_validation->set_message('checkdoc', $data['error'] = $this->upload->display_errors());
	    $error['validation_error'] = 1;
	    $error['error'] .= 'file error, ';
	    $dataset['photo_url'] = '';
	  } else {
	    $dataset['photo_url'] = 'assets/' . $_FILES['photo_url']['name'];
	  }
	}
      } else {
	$dataset['photo_url'] = '';
      }
      //

      if ($error['validation_error'] == 0) {
	$result = $this->Clients_model->save_clients($dataset);
	redirect('clients/clients_list');
      } else {
	$data['section'] = 'add_clients';
	$data['message_error'] = true;
	$data['error_msg'] = $error;
	$this->load->view('clients', $data);
      }
    }
  }
  //
  
  
  /*
   * del_client
   * Delete a client - controller.
   * @param string $hash the md5 hash of the client ID (db.table)
   * @access public
   * @return void
   */
  public function del_client($hash = '') {
    if (!isset($this->session->userdata['userdata']) || $this->session->userdata['userdata'] != 'is_logged_in') {
      redirect('admin/login');
    } else {
      if ($hash != '') {
	$hash = strip_tags(htmlspecialchars($hash));
	if ($this->validator->validate($hash, 'user') == true) {
	  $this->Clients_model->del_client($hash);
	  $data['section'] = 'clients_list';
	  $data['error'] = '';
	  $data['success'] = 'del_success';
	  
	  redirect('clients/clients_list');
	} else {
	  $data['section'] = 'clients_list';
	  $data['error'] = 'error_d2';
	  $this->load->view('clients', $data);
	}
      } else {
	$data['section'] = 'clients_list';
	$data['error'] = 'error_d1';
	$this->load->view('clients', $data);
      }
    }
  }
  //
  
  
  /*
   * updateclient
   * Update a client info - view/controller.
   * @param string $hash the md5 hash of client ID
   * @return void
   * @access public
   */
  public function update_client($hash = '') {
    if (!isset($this->session->userdata['userdata']) || $this->session->userdata['userdata'] != 'is_logged_in') {
      redirect('admin/login');
    } else {
      if (isset($hash) && $hash != '') {
	$hash = strip_tags(htmlspecialchars($hash));
	$result = $this->Clients_model->get_client_by_id($hash);
	
	$data['section'] = 'update_client';
	$data['error'] = '';
	$data['result'] = $result;
	$data['hash'] = $hash;
	$this->load->view('clients', $data);
      } else {
	redirect('clients/clients_list');
      }
    }
  }
  //
  
  
  /*
   * update_save_client
   * Update a client information
   * @param string $hash an md5 hash as client id
   * @return void
   * @access public
   */
  public function update_save_client($hash = '') {
    if (!isset($this->session->userdata['userdata']) || $this->session->userdata['userdata'] != 'is_logged_in') {
      redirect('admin/login');
    } else {
      if (isset($hash) && $hash != '') {
	$hash = strip_tags(htmlspecialchars($hash));
	$result = $this->Clients_model->get_client_by_id($hash);
	
	if ($result != false) {
	  // client exists
	  
	  $dataset = array(
	    'name' => strip_tags(htmlspecialchars($this->input->post('name'))),
	    'phone' => strip_tags(htmlspecialchars($this->input->post('phone'))),
	    'email' => strip_tags(htmlspecialchars($this->input->post('email'))),
	    'photo_url' => $result[0]['photo_url'],
	    'birth' => strip_tags(htmlspecialchars($this->input->post('birth'))),
	    'other' => strip_tags(htmlspecialchars($this->input->post('other')))
	  );
	  
	  $error = array('validation_error' => 0, 'error' => '');
	  $error['validation_error'] = 0;
	  if ($this->validator->validate($dataset['name'], 'length3') == false) {
	    $error['validation_error'] = 1;
	    $error['error'] .= 'name error, ';
	  }
	  if ($this->validator->validate($dataset['email'], 'email') == false) {
	    $error['validation_error'] = 1;
	    $error['error'] .= 'email error, ';
	  }
	  if ($dataset['birth'] == '') {
	    $dataset['birth'] = date('Y-m-d');
	  }
	  
	  if (isset($_FILES) && isset($_FILES['photo_url']) && !empty($_FILES['photo_url']['name']) ) {
	    $this->form_validation->set_rules('photo_url', 'File', 'trim|xss_clean');
      
	    if ($this->form_validation->run() == FALSE) {
	      $this->file();
	      $dataset['photo_url'] = '';
	      $error['validation_error'] = 1;
	      $error['error'] .= 'file error2, ';
	    } else {
	      $config['upload_path']   = './assets/';
	      $config['allowed_types'] = 'gif|jpg|png';
	      $config['max_size']      = '1800';
	      $config['max_width']     = '3024';
	      $config['max_height']    = '3768';
	    
	      $this->load->library('upload', $config);
	    
	      if ( !$this->upload->do_upload('photo_url',FALSE)) {
		$this->form_validation->set_message('checkdoc', $data['error'] = $this->upload->display_errors());
		$error['validation_error'] = 1;
		$error['error'] .= 'file error, ';
	      } else {
		// new image!
		$dataset['photo_url'] = 'assets/' . $_FILES['photo_url']['name'];
	      }
	    }
	  }
	  //
	  
	  if ($error['validation_error'] == 0) {
	    $new_result = $this->Admin_model->update_client($hash, $dataset);
	    if ($new_result == true) {
	      redirect('clients/clients_list');
	    } else {
	      $data['section'] = 'update_client';
	      $data['message_error'] = true;
	      $error .= 'Update error!';
	      $data['error_msg'] = $error;
	      $data['result'] = $result;
	      $data['hash'] = $hash;
	      $this->load->view('clients', $data);
	    }
	  } else {
	    $data['section'] = 'update_client';
	    $data['message_error'] = true;
	    $data['error_msg'] = $error;
	    $data['result'] = $result;
	    $data['hash'] = $hash;
	    $this->load->view('clients', $data);
	  }
	} else {
	  redirect('clients/clients_list');
	}
      } else {
	redirect('clients/clients_list');
      }
    }
  }
  //
  
  
  
 }
 // class end







  