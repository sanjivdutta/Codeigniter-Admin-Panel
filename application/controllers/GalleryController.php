<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GalleryController extends CI_Controller {

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

    public function addGallery(){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $this->load->view('admin_panel/gallery/addGallery');
    }

    function submit_gallery(){
        if ($this->session->userdata('userLoggedIn') == null) {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error col-pink">', '</div>');
        $this->form_validation->set_rules('gname', 'Gallery Name', 'required|max_length[100]');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin_panel/gallery/addGallery');
        } else {
            $data = array(
                'gname' => $this->input->post('gname'),
                'gdesc' => $this->input->post('gdesc'),
                'publish' => 'Y',
                'status'=>'1',
                'created_at'=>date('Y-m-d h:i:s')
            );
            $galData = $this->AdminModel->dataSubmit('gallery',$data);
            $data = array();
            if(!empty($_FILES['userFiles']['name'])) {
                $filesCount = count($_FILES['userFiles']['name']);
                for ($i = 0; $i < $filesCount; $i++) {
                    $_FILES['userFile']['name'] = date('ymdhis').$_FILES['userFiles']['name'][$i];
                    $_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
                    $_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
                    $_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
                    $_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];

                    $uploadPath = './uploads/gallery';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = 'gif|jpg|png';

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('userFile')) {
                        $fileData = $this->upload->data();
                        $uploadData[$i]['file_name'] = $fileData['file_name'];
                        $uploadData[$i]['created'] = date("Y-m-d H:i:s");
                        $uploadData[$i]['modified'] = date("Y-m-d H:i:s");

                        $insArray = array('gal_id'=>$galData,'img_name'=>$uploadData[$i]['file_name']);
                        $this->AdminModel->dataSubmit('gallery_meta',$insArray);
                    }
                }
            }
        }
        $this->session->set_flashdata('gallery_submit', '<div class="alert alert-success alert-dismissible">Gallery added successfully!</div>');
        redirect("admin/add_gallery");
    }

    public function viewGallery(){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $galData['tblData'] = $this->AdminModel->galleryView();
        $this->load->view('admin_panel/gallery/viewGallery', $galData );
    }

    public function editGallery($postID){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $postID = customDecrypt($postID);
        $cond = array('id'=>$postID);
        $postData['postDet'] = $this->AdminModel->getSinglerecord('gallery','*',$cond);
        $this->load->view('admin_panel/gallery/editGallery', $postData );
    }

    public function update_gallery(){

        if ($this->session->userdata('userLoggedIn') == null) {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $galID = $this->input->post('galID');
        $galIDDec = customDecrypt($this->input->post('galID'));
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error col-pink">', '</div>');
        $this->form_validation->set_rules('gname', 'Gallery Name', 'required|max_length[100]');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('record_update', '<div class="alert alert-danger alert-dismissible">One or More field(s) are required!</div>');
            redirect('admin/gallery/edit/'.$galID);
        } else {
            $data = array(
                'gname' => $this->input->post('gname'),
                'gdesc' => $this->input->post('gdesc'),
                'publish' => $this->input->post('publish'),
                'status'=>'1',
                'updated_at'=>date('Y-m-d h:i:s')
            );
            $cond = array('id'=>$galIDDec);
            $galData = $this->AdminModel->updateRecord('gallery',$data,$cond);
            $data = array();
            if(!empty($_FILES['userFiles']['name'])) {
                $filesCount = count($_FILES['userFiles']['name']);
                for ($i = 0; $i < $filesCount; $i++) {
                    $_FILES['userFile']['name'] = date('ymdhis').$_FILES['userFiles']['name'][$i];
                    $_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
                    $_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
                    $_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
                    $_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];
                    
                    $uploadPath = './uploads/gallery';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = 'gif|jpg|png';

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('userFile')) {
                        $fileData = $this->upload->data();
                        $uploadData[$i]['file_name'] = $fileData['file_name'];
                        $uploadData[$i]['created'] = date("Y-m-d H:i:s");
                        $uploadData[$i]['modified'] = date("Y-m-d H:i:s");

                        $insArray = array('gal_id'=>$galIDDec,'img_name'=>$uploadData[$i]['file_name']);
                        $this->AdminModel->dataSubmit('gallery_meta',$insArray);
                    }
                }
            }
        }
        $this->session->set_flashdata('record_update', '<div class="alert alert-success alert-dismissible">Gallery updated successfully!</div>');
        redirect('admin/gallery/edit/'.$galID);
    }

    public function deleteGallery($postID=null){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $postIDNew = customDecrypt($postID);

        $cond = array('gal_id'=>$postIDNew);
        $cond1 = array('id'=>$postIDNew);
        $imgname = $this->AdminModel->dataView('gallery_meta','img_name',$cond);
        foreach($imgname as $img) {
            if ($img['img_name'] != '' && file_exists('./uploads/gallery/' . $img['img_name'])) {
                unlink('./uploads/gallery/' . $img['img_name']);
            }
        }
        $this->AdminModel->deleteRecord('gallery',$cond1);
        $this->AdminModel->deleteRecord('gallery_meta',$cond);
        $this->session->set_flashdata('record_update', '<div class="alert alert-danger alert-dismissible">Gallery deleted!</div>');
        redirect('admin/view_gallery');
    }

    public function deleteImage($postID){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }

        $postIDNew = customDecrypt($postID);
        $cond = array('id'=>$postIDNew);

        $imgname = $this->AdminModel->getSinglerecord('posts','file_name',$cond);
        unlink('./uploads/postImages/'.$imgname->file_name);
        $imgarray = array('file_name' => '');
        if($this->AdminModel->deleteImage('posts',$imgarray,$cond) == 1){
            $this->session->set_flashdata('record_update', '<div class="alert alert-info alert-dismissible">Image deleted successfully!</div>');
            redirect('admin/post/edit/'.$postID);
        } else {
            $this->session->set_flashdata('record_update', '<div class="alert alert-danger alert-dismissible">Something wrong happened!</div>');
            redirect('admin/post/edit/'.$postID);
        }
    }


}
