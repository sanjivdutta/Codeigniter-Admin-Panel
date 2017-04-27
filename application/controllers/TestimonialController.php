<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestimonialController extends CI_Controller {

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

    public function addTestimonial(){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $this->load->view('admin_panel/testimonial/addTestimonial');
    }

    public function submit_testimonial()
    {
        if ($this->session->userdata('userLoggedIn') == null) {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error col-pink">', '</div>');
        $this->form_validation->set_rules('title', 'Author Title', 'required|max_length[100]');
        $this->form_validation->set_rules('status', 'Status', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin_panel/testimonial/addTestimonial');
        } else {
            $config['upload_path'] = './uploads/testiImages';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size']    = '50000';

            //load upload class library
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('post_image'))
            {
                $upload_error = array('error' => $this->upload->display_errors());
                $this->load->view('admin_panel/testimonial/addTestimonial', $upload_error);
            }
            else
            {
                // case - success
                $upload_data = $this->upload->data();
            }
            $data = array(
                'title' => $this->input->post('title'),
                'description_testi' => $this->input->post('description_testi'),
                'file_name' => $this->upload->data()['file_name'],
                'status' => $this->input->post('status'),
                'created_at' => date('y-m-d h:i:s'),
                'created_by' => $this->session->userdata('userID')
            );
            $this->AdminModel->dataSubmit('testimonial',$data);
            $this->session->set_flashdata('testimonial_submit', '<div class="alert alert-success alert-dismissible">Testimonial added successfully!</div>');
            redirect("admin/add_testimonial");
        }
    }

    public function viewTestimonial(){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $postData['tblData'] = $this->AdminModel->dataView('testimonial');
        $this->load->view('admin_panel/testimonial/viewTestimonial', $postData );
    }

    public function editTestimonial($postID){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $postID = customDecrypt($postID);
        $cond = array('id'=>$postID);
        $postData['postDet'] = $this->AdminModel->getSinglerecord('testimonial','*',$cond);
        $this->load->view('admin_panel/testimonial/editTestimonial', $postData );
    }

    public function deleteImage($postID){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }

        $postIDNew = customDecrypt($postID);
        $cond = array('id'=>$postIDNew);

        $imgname = $this->AdminModel->getSinglerecord('testimonial','file_name',$cond);
        unlink('./uploads/postImages/'.$imgname->file_name);
        $imgarray = array('file_name' => '');
        if($this->AdminModel->deleteImage('testimonial',$imgarray,$cond) == 1){
            $this->session->set_flashdata('record_update', '<div class="alert alert-info alert-dismissible">Image deleted successfully!</div>');
            redirect('admin/testimonial/edit/'.$postID);
        } else {
            $this->session->set_flashdata('record_update', '<div class="alert alert-danger alert-dismissible">Something wrong happened!</div>');
            redirect('admin/testimonial/edit/'.$postID);
        }
    }

    public function update_testimonial(){

        if ($this->session->userdata('userLoggedIn') == null) {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $postID = $this->input->post('postID');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error col-pink">', '</div>');
        $this->form_validation->set_rules('title', 'Testimonial Title', 'required|max_length[100]');
        $this->form_validation->set_rules('status', 'Status', 'required');
        if ($this->form_validation->run() == FALSE) {
            $cond = array('id'=>$postID);
            $postData['postDet'] = $this->AdminModel->getSinglerecord('posts','*',$cond);
            $this->load->view('admin_panel/testimonial/editTestimonial',$postData);
        } else {
            $fileName = '';
            if ($_FILES AND $_FILES['post_image']['name']){

                $config['upload_path'] = './uploads/testiImages';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = '50000';

                //load upload class library
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('post_image')) {
                    $upload_error = array('error' => $this->upload->display_errors());
                    $msg = '';
                    foreach ($upload_error as $k => $v) {
                        $msg .= $v . '<br/>';
                    }
                    $this->session->set_flashdata('record_update', '<div class="alert alert-warning alert-dismissible">' . $msg . '</div>');
                    redirect('admin/testimonial/edit/' . $postID);
                } else {
                    // case - success
                    $upload_data = $this->upload->data();
                    $fileName = $this->upload->data()['file_name'];
                }
                $data = array(
                    'title' => $this->input->post('title'),
                    'description_testi' => $this->input->post('description_testi'),
                    'file_name' => $fileName,
                    'status' => $this->input->post('status'),
                    'updated_at' => date('y-m-d h:i:s'),
                    'updated_by' => $this->session->userdata('userID')
                );
            } else {
                $data = array(
                    'title' => $this->input->post('title'),
                    'description_testi' => $this->input->post('description_testi'),
                    'status' => $this->input->post('status'),
                    'updated_at' => date('y-m-d h:i:s'),
                    'updated_by' => $this->session->userdata('userID')
                );
            }
            $postIDNew = customDecrypt($postID);
            $cond = array('id'=>$postIDNew);
            if($this->AdminModel->updateRecord('testimonial',$data,$cond)==1){
                $this->session->set_flashdata('record_update', '<div class="alert alert-success alert-dismissible">Post updated successfully!</div>');
                redirect('admin/testimonial/edit/'.$postID);
            } else {
                $this->session->set_flashdata('testimonial_submit', '<div class="alert alert-warning alert-dismissible">Some error occured! Please try again.</div>');
                redirect('admin/testimonial/edit/'.$postID);
            }
        }
    }

    public function deleteTestimonial($postID=null){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $postIDNew = customDecrypt($postID);

        $cond = array('id'=>$postIDNew);
        $imgname = $this->AdminModel->getSinglerecord('testimonial','file_name',$cond);
        if($imgname->file_name!='') {
            unlink('./uploads/testiImages/' . $imgname->file_name);
        }

        if($this->AdminModel->deleteRecord('testimonial',$cond)){
            $this->session->set_flashdata('testimonial_submit', '<div class="alert alert-delete alert-dismissible">Post deleted!</div>');
            redirect('admin/view_testimonial');
        } else {
            $this->session->set_flashdata('testimonial_submit', '<div class="alert alert-info alert-dismissible">Some error occured!</div>');
            redirect('admin/view_testimonial');
        }
    }
}
