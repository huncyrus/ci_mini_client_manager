<?php

/*
 * Admin_model
 * The model for the Admin app to the CI Mini Client Manager
 * @version 0.5b
 * @author Györk "huncyrus" Bakonyi <huncyrus@gmail.com>
 * @package ci_mini_client_manager
 * @uses CI 2.2 documentation
 * @todo finish it (email section implementation)
 */
class Admin_model extends CI_Model {
    /**
     *
     * process login
     * @param string $user_name
     * @param string $password
     * @return void
     * @access public
     */
    public function login_process($user_name, $password) {
        $this->db->where('username', $user_name);
        $this->db->where('pass', $password);
        $query = $this->db->get('admins');
        
        if($query->num_rows == 1) {
            return true;
        }
    }
    //
    

    /**
     * get_db_session_data
     * Serialize the session data stored in the database, 
     * store it in a new array and return it to the controller 
     * @return array
     * @access public
     */
    public function get_db_session_data() {
        $query = $this->db->select('user_data')->get('ci_sessions');
        $user = array(); /* array to store the user data we fetch */
        foreach ($query->result() as $row) {
            $udata = unserialize($row->user_data);
            /* put data in array using username as key */
            $user['username'] = $udata['username']; 
            $user['is_logged_in'] = $udata['is_logged_in']; 
        }
        return $user;
    }
    //
    
    
    /*
     * get_client_list
     * Get the clients list
     * @return mixed, boolean false if no row in db. string array if yupp.
     * @access public
     */
    public function get_client_list() {
        $this->db->select('*');
        $this->db->from('clients');
        $query = $this->db->get();
        
        if ($query->num_rows > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    //
    
    
    /*
     * get_client_by_id
     * Get the client by id (md5 hash) from the database
     * @param string $hash the md5 hash
     * @return void
     * @access public
     */
    public function get_client_by_id($hash = '') {
        $this->db->select('*');
        $this->db->from('clients');
        $this->db->where('MD5(MD5(id))', md5($hash));
        $query = $this->db->get();
        
        if ($query->num_rows > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    //
    
    
    /*
     * save_clients
     * Store the new item into the database
     * @param array $data - associative array with data to save
     * @return boolean
     * @access public
     */
    public function save_clients($data) {
        $insert = $this->db->insert('clients', $data);
        
        return $insert;
    }
    //
    
    
    /*
     * update_client
     * Update a client by id
     * @param string/number $id the client id in hash
     * @param array $data - associative array with data to upd
     * @return boolean
     * @access public
     */
    public function update_client($id, $data) {
        $this->db->trans_start();
        $this->db->where('MD5(id)', $id);
        $this->db->update('clients', $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        } else {
            return true;
        }
    }
    //

    
    /*
     * del_client
     * Delete client by id.
     * @param int $id - Client id
     * @return none
     * @access public
     */
    public function del_client($id) {
        $this->db->where('md5(md5(id))', md5($id) );
        $this->db->delete('clients'); 
    }
    //
    
}
//


