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
    
    
}
//


