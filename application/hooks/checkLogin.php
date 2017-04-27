<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  

class CheckLogin extends CI_Controller {  

public function login()  
    {  
    	//$CI =& get_instance();
    	//echo $this->router->fetch_class();  // Class Name/Controller Name
    	//echo $this->router->fetch_method(); // Method Name

        if ( $this->session->userdata('userLoggedIn')== null)
        {
            echo 'You have no permission here';
            die;
        }
    }  
}  
?>  