<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EventController extends CI_Controller {

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

    public function events(){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $data['events'] = $this->AdminModel->dataView('events');
        $this->load->view('admin_panel/events/index',$data);
    }

    public function addEvents(){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $this->load->view('admin_panel/events/addEvent');
    }

    public function submit_event(){

        $_POST['date_diff'] = 0;
        $this->form_validation->set_error_delimiters('<div class="error col-red">', '</div>');
        $this->form_validation->set_rules('title', 'Event Title', 'required|max_length[255]');
        $this->form_validation->set_rules('start_date', 'Event Date', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin_panel/events/addEvent');
        }
        if(!empty($_POST['start_date'])) {
            $startDate = date_create($_POST['start_date']);
            $_POST['start_date'] = date_format($startDate, 'Y-m-d H:i:s');
        }
        if(!empty($_POST['end_date'])) {
            $endDate = date_create($_POST['end_date']);
            $_POST['end_date'] = date_format($endDate, 'Y-m-d H:i:s');
            $dt1 = strtotime(date_format($startDate, 'Y-m-d'));
            $dt2 = strtotime(date_format($endDate, 'Y-m-d'));
            $datediff = $dt2 - $dt1;
            $_POST['date_diff'] = floor($datediff / (60 * 60 * 24));
        }
        $this->AdminModel->dataSubmit('events', $_POST);
        redirect('admin/events');
    }



}
