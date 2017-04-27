<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

	function __construct()
	{
		parent::__construct();

        $this->load->helper('url');
        $this->load->library('form_validation');
		$this->load->helper('cheats');
        $this->load->model('AdminModel');
        $this->load->library('encrypt');
    }



	public function index()
	{
		$this->load->view('admin_panel/auth/sign-in');
	}

    public function addUser(){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        //$catData['categories'] = $this->AdminModel->dataView('post_category','id,cat_name','cat_name','ASC');
        $this->load->view('admin_panel/users/addUser');
    }

    public function submit_user()
    {
        if ($this->session->userdata('userLoggedIn') == null) {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error col-pink">', '</div>');
        $this->form_validation->set_rules('fname', 'First Name', 'required|max_length[100]');
        $this->form_validation->set_rules('lname', 'Last Name', 'required|max_length[100]');
        $this->form_validation->set_rules('email', 'Email ID', 'required|valid_email|is_unique[admin_users.email]',
            array('is_unique'=>'Email ID is already taken. Please try another one!'));
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[admin_users.username]|min_length[6]',
                                    array('is_unique'=>'Username is already taken. Please try another one!'));
        $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[100]|min_length[6]');
        $this->form_validation->set_rules('status', 'User Status', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin_panel/users/addUser');
        } else {
            $config['upload_path'] = './uploads/profileImages';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size']    = '50000';
            //load upload class library
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('user_image'))
            {
                $upload_error = array('error' => $this->upload->display_errors());
                $this->load->view('admin_panel/users/addUser', $upload_error);
            }
            else
            {
                // case - success
                $upload_data = $this->upload->data();
            }
            $data = array(
                'fname' => $this->input->post('fname'),
                'lname' => $this->input->post('lname'),
                'sex' => $this->input->post('sex'),
                'username' => $this->input->post('username'),
                'profileImage' => $this->upload->data()['file_name'],
                'email' => $this->input->post('email'),
                'status' => $this->input->post('status'),
                'user_bio' => $this->input->post('desc'),
                'user_type' => $this->input->post('user_type'),
                'user_address' => $this->input->post('delivery_address'),
                'password' => md5($this->input->post('password')),
            );
            //print_r($data); die;
            $this->AdminModel->dataSubmit('admin_users',$data);
            
            $email = $this->input->post('email');
            $fname = $this->input->post('fname');
            $lname = $this->input->post('lname');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $type = ($this->input->post('user_type')=='B')?'Buyer':'Seller';

            //Load email library SMTP Mail
            /*$this->load->library('email');

            $config = array();
            
            $config = Array(
              'protocol' => 'smtp',
              'smtp_host' => 'tls://smtp.gmail.com',
              'smtp_port' => 465,
              'smtp_user' => 'sanjiv.bitcanny@gmail.com', // change it to yours
              'smtp_pass' => '8981683529', // change it to yours
              'mailtype' => 'html',
              'charset' => 'iso-8859-1',
              'wordwrap' => TRUE
            );

            $this->email->initialize($config);

            $message = "Hie ".$fname." ".$lname.",<br/>Your account has been successfully created at Terri's App!<br/><br/>Your login details:<br/> username: ".$username."<br/>Password: ".$password."<br/> Plese login to continue!";
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from('sanjiv.bitcanny@gmail.com'); // change it to yours
            $this->email->to($email);// change it to yours
            $this->email->bcc('sanjiv.bitcanny@gmail.com');
            $this->email->subject("You have been added to the Terri's App!");
            $this->email->message($message);
            if($this->email->send())
            {
                echo 'Email sent.';
            }
            else
            {
                show_error($this->email->print_debugger());
            }*/

            $to = $email;
            $subject = "You have been added to the Terri's App!";
            $txt = "Hie ".$fname." ".$lname.",<br/>Your account has been successfully created at Terri's App as a '".$type."'!<br/><br/>Your login details:<br/> username: ".$username."<br/>Password: ".$password."<br/> Plese login to continue!";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
            $headers .= "From: sanjiv.bitcanny@gmail.com" . "\r\n" .
            "Reply-To: sanjiv.bitcanny@gmail.com" . "\r\n" .
            "Bcc: sanjiv.bitcanny@gmail.com". "\r\n" .
            "X-Mailer: PHP/" . phpversion();
            //$headers = "From: webmaster@example.com" . "\r\n" ."CC: somebodyelse@example.com";

            mail($to,$subject,$txt,$headers);

            $this->session->set_flashdata('user_submit', '<div class="alert alert-success alert-dismissible">User added successfully! An email has been sent to the given email id.</div>');
            redirect("admin/add_user");
        }
    }

    public function viewUser(){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $postData['tblData'] = $this->AdminModel->dataView('admin_users');
        $this->load->view('admin_panel/users/viewUser', $postData );
    }

    public function editUser($userID){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $userID = customDecrypt($userID);
        $cond = array('id'=>$userID);
        $postData['userDet'] = $this->AdminModel->getSinglerecord('admin_users','*',$cond);
        $this->load->view('admin_panel/users/editUser', $postData );
    }

    public function deleteImage($postID){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }

        $postIDNew = customDecrypt($postID);
        $cond = array('id'=>$postIDNew);

        $imgname = $this->AdminModel->getSinglerecord('admin_users','profileImage',$cond);
        unlink('./uploads/postImages/'.$imgname->profileImage);
        if($postIDNew==$this->session->userdata['userID']) {
            $this->session->set_userdata(array(
                'profilePic' => '',
            ));
        }
        $imgarray = array('profileImage' => '');
        if($this->AdminModel->deleteImage('admin_users',$imgarray,$cond) == 1){
            $this->session->set_flashdata('record_update', '<div class="alert alert-info alert-dismissible">Image deleted successfully!</div>');
            redirect('admin/user/edit/'.$postID);
        } else {
            $this->session->set_flashdata('record_update', '<div class="alert alert-danger alert-dismissible">Something wrong happened!</div>');
            redirect('admin/post/edit/'.$postID);
        }
    }

    public function update_user(){

        if ($this->session->userdata('userLoggedIn') == null) {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $userID = $this->input->post('userID');
        $userID1 = customDecrypt($userID);
        $this->form_validation->set_error_delimiters('<div class="error col-pink">', '</div>');
        $this->form_validation->set_rules('fname', 'First Name', 'required|max_length[100]');
        $this->form_validation->set_rules('lname', 'Last Name', 'required|max_length[100]');
        if ($this->form_validation->run() == FALSE) {
            $cond = array('id'=>$userID1);
            $postData['userDet'] = $this->AdminModel->getSinglerecord('admin_users','*',$cond);
            $this->load->view('admin_panel/users/editUser',$postData);
        } else {
            $fileName = '';
            if ($_FILES AND $_FILES['user_image']['name']){

                $config['upload_path'] = './uploads/profileImages';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = '50000';

                //load upload class library
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('user_image')) {
                    $upload_error = array('error' => $this->upload->display_errors());
                    $msg = '';
                    foreach ($upload_error as $k => $v) {
                        $msg .= $v . '<br/>';
                    }
                    $this->session->set_flashdata('record_update', '<div class="alert alert-warning alert-dismissible">' . $msg . '</div>');
                    redirect('admin/post/edit/' . $userID);
                } else {
                    // case - success
                    $upload_data = $this->upload->data();
                    $fileName = $this->upload->data()['file_name'];
                }
                $data = array(
                    'fname' => $this->input->post('fname'),
                    'lname' => $this->input->post('lname'),
                    'profileImage' => $fileName,
                    'user_bio' => $this->input->post('desc'),
                    'sex' => $this->input->post('sex'),
                    'user_type' => $this->input->post('user_type'),
                    'user_address' => $this->input->post('delivery_address'),
                );
                if($userID1==$this->session->userdata['userID']) {
                    $this->session->set_userdata(array(
                        'profilePic' => $fileName,
                    ));
                }
            } else {
                $data = array(
                    'fname' => $this->input->post('fname'),
                    'lname' => $this->input->post('lname'),
                    'user_bio' => $this->input->post('desc'),
                    'sex' => $this->input->post('sex'),
                    'user_type' => $this->input->post('user_type'),
                    'user_address' => $this->input->post('delivery_address'),
                );
            }
            $postIDNew = customDecrypt($userID);
            $cond = array('id'=>$postIDNew);
            if($this->AdminModel->updateRecord('admin_users',$data,$cond)==1){
                $this->session->set_flashdata('record_update', '<div class="alert alert-success alert-dismissible">User updated successfully!</div>');
                redirect('admin/user/edit/'.$userID);
            } else {
                $this->session->set_flashdata('record_update', '<div class="alert alert-warning alert-dismissible">Some error occured! Please try again.</div>');
                redirect('admin/user/edit/'.$userID);
            }
        }
    }

    public function deleteUser($postID=null){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $postIDNew = customDecrypt($postID);
        $cond = array('id'=>$postIDNew);
        $imgname = $this->AdminModel->getSinglerecord('admin_users','profileImage',$cond);
        if($imgname->file_name!='') {
            unlink('./uploads/profileImages/' . $imgname->profileImage);
        }

        if($this->AdminModel->deleteRecord('admin_users',$cond)){
            $this->session->set_flashdata('record_update', '<div class="alert alert-danger alert-dismissible">User deleted!</div>');
            redirect('admin/view_user');
        } else {
            $this->session->set_flashdata('record_update', '<div class="alert alert-info alert-dismissible">Some error occured!</div>');
            redirect('admin/view_user');
        }
    }




}
