<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ErrorController extends CI_Controller {
    function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('cheats');
        $this->load->model('AdminModel');
    }
	public function index()
	{
		$this->load->view('admin_panel/error/404');
	}
}
