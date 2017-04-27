<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

	function __construct()
	{
		parent::__construct();

        $this->load->helper('url');
        $this->load->library('form_validation');
		$this->load->helper('cheats');
		$this->load->model('AdminModel');
	}

	public function index()
	{
        $this->load->view('admin_panel/auth/sign-in');
	}

    public function dashboard(){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $postCount['totPost'] = $this->AdminModel->dataRowCount('posts');
        $postCount['totUser'] = $this->AdminModel->dataRowCount('admin_users');
        $postCount['totCategory'] = $this->AdminModel->dataRowCount('post_category');
        $postCount['totImages'] = $this->AdminModel->dataRowCount('gallery_meta');
        $postCount['totProducts'] = $this->AdminModel->dataRowCount('product');
        $postCount['totTesti'] = $this->AdminModel->dataRowCount('testimonial');

        $postCount['sliderImg'] = $this->AdminModel->getLastAlbumImages();
        $postCount['events'] = $this->AdminModel->dataView('events',null,null,null,'6',null);
        $postCount['testimonial'] = $this->AdminModel->dataView('testimonial',null,null,null,'10',null);

        $this->load->view('admin_panel/dashboard',$postCount);
    }

    public function forget_password(){
        $data = array();
        $this->load->view('admin_panel/auth/forget_password',$data);
    }

}
