<?php defined('BASEPATH') OR exit('No direct script access allowed');

class validator {
    protected $CI; // codeigniter instance hoak
    
    
    public function __construct() {
        $this->CI = & get_instance();
    }
    //
    
    
    /*
     * clear
     * Clear a string from codes and spec chars
     * @param string $text
     * @return string the cleared text
     * @access public
     */
    public function clear($text = '') {
        if (isset($text) && $text != '') {
            return strip_tags(htmlspecialchars($text));
        } else {
            return false;
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
    public function validate($field = '', $type = 'user') {
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
            // switch end
        } else {
            // empty field false
            return false;
        }
    }
    // fn end
    
    
    public function __destruct() {
        
    }
    //
    
}
//