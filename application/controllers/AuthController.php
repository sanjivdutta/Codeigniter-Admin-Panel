<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {

	function __construct()
	{
		parent::__construct();

        $this->load->helper('url');
		$this->load->model('AdminModel');
        $this->load->library('form_validation');
	}

	public function admin_login()
	{
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|max_length[15]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin_panel/auth/sign-in');
        } else {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password')),
            );
            $chkLoginVal = $this->AdminModel->CheckLogin($data);  // 1 -Valid, 0 - Invalid
            if($chkLoginVal==0){
                $this->session->set_flashdata('login_error', 'Please enter a valid Username and Password!');
                redirect("/");
            } else {
                $this->session->set_userdata(array(
                    'userLoggedIn' => True,
                    'userID' => $chkLoginVal[0]['id'],
                    'userFName' => $chkLoginVal[0]['fname'],
                    'userLName' => $chkLoginVal[0]['lname'],
                    'userName' => $chkLoginVal[0]['username'],
                    'userBlock' => $chkLoginVal[0]['block'],
                    'userType' => $chkLoginVal[0]['user_type'],
                    'profilePic' => $chkLoginVal[0]['profileImage'],

                ));
                //echo "<pre>"; print_r($this->session->all_userdata()); echo "</pre>";
                redirect("admin/dashboard");
            }
        }
	}

    public function admin_logout(){

        $this->AdminModel->updateRecord('admin_users',array('user_unique_identity' => ''),array('id' => $this->session->userdata('userID')));

        $this->session->unset_userdata('userLoggedIn');
        $this->session->unset_userdata('userID');
        $this->session->unset_userdata('userFName');
        $this->session->unset_userdata('userLName');
        $this->session->unset_userdata('userName');
        $this->session->unset_userdata('userBlock');
        $this->session->unset_userdata('userType');
        redirect("/");
    }

    public function resetPassword(){

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        $email = $this->input->post('email');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin_panel/auth/forget_password');
        } else {
            $recData = $this->AdminModel->getSinglerecord('admin_users','*', array('email' => $email));

            if (count($recData) != 1) {
                $this->session->set_flashdata('error_sec', '<div class="alert alert-warning alert-dismissible">This Email ID does not belong to our database!</div>');
                redirect('admin/forget_password');
            } else {

                $token = hash('sha256', $email).'.'.$email;
                $link = base_url().'admin/user/own/reset_password/'.urlencode($token);
                $this->AdminModel->updateRecord('admin_users',array('password_reset_token' => $token),array('id' => $recData->id));

               /* $config = Array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_port' => 465,
                    'smtp_user' => 'sanjiv.bitcanny@gmail.com', // change it to yours
                    'smtp_pass' => '8981683529', // change it to yours
                    'mailtype' => 'html',
                    'charset' => 'iso-8859-1',
                    'wordwrap' => TRUE
                );

                $this->load->library('email', $config);
                $from = 'sanjiv.bitcanny@gmail.com';
                $this->email->from($from, 'Site Admin');
                $this->email->to($email);
                //$this->email->cc('another@another-example.com');
                //$this->email->bcc('them@their-example.com');
                $this->email->subject('Password Reset');
                $this->email->message('Testing the email class.');
                $this->email->send();
                if($this->email->send()) {
                    $this->session->set_flashdata('error_sec', '<div class="alert alert-success alert-dismissible">A password reset email has been sent to you given Email ID. Please check your email to continue.</div>');
                    redirect('admin/forget_password');
                } else {
                    $this->session->set_flashdata('error_sec', '<div class="alert alert-danger alert-dismissible">Error occured! please try again later.</div>');
                    redirect('admin/forget_password');
                }*/

                $to = $email;
                $subject = "Password Reset Request - Terri's App!";
                $txt = "Hie ".$recData->fname." ".$recData->lname.",<br/>Your your password has been reset!<br/>Please click on the given link below to reset the password<br/><br/><a href=".$link.">".$link."</a>";
                //$txt .= "<br/><br/>";
                //$txt .= "<a href=".$link.">".$link."</a>";
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
                $headers .= "From: sanjiv.bitcanny@gmail.com" . "\r\n" .
                "Reply-To: sanjiv.bitcanny@gmail.com" . "\r\n" .
                "Bcc: sanjiv.bitcanny@gmail.com". "\r\n" .
                "X-Mailer: PHP/" . phpversion();
                //$headers = "From: webmaster@example.com" . "\r\n" ."CC: somebodyelse@example.com";

                if(mail($to,$subject,$txt,$headers)){
                    $this->session->set_flashdata('error_sec', '<div class="alert alert-success alert-dismissible">A password reset email has been sent to you given Email ID. Please check your email to continue.</div>');
                    redirect('admin/forget_password');
                } else {
                    $this->session->set_flashdata('error_sec', '<div class="alert alert-danger alert-dismissible">Error occured! please try again later.</div>');
                    redirect('admin/forget_password');
                }
            }
        }

    }


    public function password_reset_form(){
        $token = urldecode($this->uri->segment(5));
        $recData = $this->AdminModel->getSinglerecord('admin_users','*', array('password_reset_token' => $token));

        $this->session->set_userdata(array(
                    'passwordToken' => $token,
        ));

        if(empty($recData)){
             $this->session->set_flashdata('login_error', '<div class="alert alert-danger alert-dismissible">Sorry this is a not valid link!</div>');
                    redirect('/');
        }

        $this->load->view('admin_panel/auth/reset_password');
    }

    public function password_submit(){
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('repassword', 'Retype Password', 'trim|required|min_length[6]|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin_panel/auth/reset_password');
        } else { 
            $this->AdminModel->updateRecord('admin_users',array('password' => md5($this->input->post('password')),'password_reset_token'=>''),array('password_reset_token' => $this->input->post('user_token')));
            $this->session->unset_userdata('passwordToken');
            $this->session->set_flashdata('login_error', 'Password has been changed! Please login to continue!');
            redirect("/");     }
    }

}
