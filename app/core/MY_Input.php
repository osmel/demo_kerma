<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Input extends CI_Input {

    /**
     * Clean Keys
     *
     * This is a helper function. To prevent malicious users
     * from trying to exploit keys we make sure that keys are
     * only named with alpha-numeric text and a few other items.
     * 
     * Extended to allow: 
     *      - '.' (dot), 
     *      - '[' (open bracket),
     *      - ']' (close bracket)
     * 
     * @access  private
     * @param   string
     * @return  string
     */
        public function __construct()
        {
            
                parent::__construct();

              
        }

    public function _clean_input_keys($str) {   
        
  
        if ( ! preg_match("/^[.a-z0-9:_\/-]+$/i", $str))
        {
            exit('Disallowed Key Characters.');
        }

        // Clean UTF-8 if supported
        if (UTF8_ENABLED === TRUE)
        {
            $str = $this->uni->clean_string($str);
        }

        return $str;


    }

}

// /?/> /* Should never close php file - if you have a space after code, it can mess your life up */