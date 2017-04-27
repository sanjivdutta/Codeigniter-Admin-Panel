<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PostController extends CI_Controller {

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

    public function addPost(){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $catData['categories'] = $this->AdminModel->dataView('post_category','id,cat_name','cat_name','ASC');
        $this->load->view('admin_panel/posts/addPost',$catData);
    }

    public function submit_post()
    {
        if ($this->session->userdata('userLoggedIn') == null) {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error col-pink">', '</div>');
        $this->form_validation->set_rules('title', 'Post Title', 'required|max_length[100]');
        $this->form_validation->set_rules('status', 'Post Status', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin_panel/posts/addPost');
        } else {
            $config['upload_path'] = './uploads/postImages';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size']    = '50000';

            //load upload class library
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('post_image'))
            {
                $upload_error = array('error' => $this->upload->display_errors());
                $this->load->view('admin_panel/posts/addPost', $upload_error);
            }
            else
            {
                // case - success
                $upload_data = $this->upload->data();
            }
            $data = array(
                //'post_title' => hash('sha256', $this->input->post('title')),
                'post_title' => $this->input->post('title'),
                'page_name' => $this->input->post('page_name'),
                'post_desc' => $this->input->post('desc'),
                'file_name' => $this->upload->data()['file_name'],
                'cat_id' => $this->input->post('postCat'),
                'status' => $this->input->post('status'),
                'created_at' => date('y-m-d h:i:s'),
                'created_by' => $this->session->userdata('userID')
            );
            $this->AdminModel->dataSubmit('posts',$data);
            $this->session->set_flashdata('post_submit', '<div class="alert alert-success alert-dismissible">Post added successfully!</div>');
            redirect("admin/add_post");
        }
    }

    public function viewPost(){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $postData['tblData'] = $this->AdminModel->dataView('posts');
        $this->load->view('admin_panel/posts/viewPost', $postData );
    }

    public function editPost($postID){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $postID = customDecrypt($postID);
        $cond = array('id'=>$postID);
        $postData['postDet'] = $this->AdminModel->getSinglerecord('posts','*',$cond);
        $postData['categories'] = $this->AdminModel->dataView('post_category','id,cat_name','cat_name','ASC');
        $this->load->view('admin_panel/posts/editPost', $postData );
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

    public function update_post(){

        if ($this->session->userdata('userLoggedIn') == null) {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $postID = $this->input->post('postID');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error col-pink">', '</div>');
        $this->form_validation->set_rules('title', 'Post Title', 'required|max_length[100]');
        $this->form_validation->set_rules('status', 'Post Status', 'required');
        if ($this->form_validation->run() == FALSE) {
            $cond = array('id'=>$postID);
            $postData['postDet'] = $this->AdminModel->getSinglerecord('posts','*',$cond);
            $this->load->view('admin_panel/posts/editPost',$postData);
        } else {
            $fileName = '';
            if ($_FILES AND $_FILES['post_image']['name']){

                $config['upload_path'] = './uploads/postImages';
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
                    redirect('admin/post/edit/' . $postID);
                } else {
                    // case - success
                    $upload_data = $this->upload->data();
                    $fileName = $this->upload->data()['file_name'];
                }
                $data = array(
                    'post_title' => $this->input->post('title'),
                    'page_name' => $this->input->post('page_name'),
                    'post_desc' => $this->input->post('desc'),
                    'file_name' => $fileName,
                    'cat_id' => $this->input->post('postCat'),
                    'status' => $this->input->post('status'),
                    'updated_at' => date('y-m-d h:i:s'),
                    'updated_by' => $this->session->userdata('userID')
                );
            } else {
                $data = array(
                    'post_title' => $this->input->post('title'),
                    'page_name' => $this->input->post('page_name'),
                    'post_desc' => $this->input->post('desc'),
                    'cat_id' => $this->input->post('postCat'),
                    'status' => $this->input->post('status'),
                    'updated_at' => date('y-m-d h:i:s'),
                    'updated_by' => $this->session->userdata('userID')
                );
            }
            $postIDNew = customDecrypt($postID);
            $cond = array('id'=>$postIDNew);
            if($this->AdminModel->updateRecord('posts',$data,$cond)==1){
                $this->session->set_flashdata('record_update', '<div class="alert alert-success alert-dismissible">Post updated successfully!</div>');
                redirect('admin/post/edit/'.$postID);
            } else {
                $this->session->set_flashdata('post_submit', '<div class="alert alert-warning alert-dismissible">Some error occured! Please try again.</div>');
                redirect('admin/post/edit/'.$postID);
            }
        }
    }

    public function deletePost($postID=null){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $postIDNew = customDecrypt($postID);
        $cond = array('id'=>$postIDNew);
        $imgname = $this->AdminModel->getSinglerecord('posts','file_name',$cond);
        if($imgname->file_name!='') {
            unlink('./uploads/postImages/' . $imgname->file_name);
        }

        if($this->AdminModel->deleteRecord('posts',$cond)){
            $this->session->set_flashdata('post_submit', '<div class="alert alert-delete alert-dismissible">Post deleted!</div>');
            redirect('admin/view_post');
        } else {
            $this->session->set_flashdata('post_submit', '<div class="alert alert-info alert-dismissible">Some error occured!</div>');
            redirect('admin/view_post');
        }
    }

    public function viewCategories(){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $catData['categories'] = $this->AdminModel->dataView('post_category','*','cat_name','ASC');
        $this->load->view('admin_panel/posts/category',$catData);
    }


    public function submit_category()
    {
        if ($this->session->userdata('userLoggedIn') == null) {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('cat_name', 'Category Name', 'required|max_length[255]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin_panel/posts/category');
        } else {
            $data = array(
                'cat_name' => $this->input->post('cat_name'),
                'created_at' => date('y-m-d h:i:s'),
                'created_by' => $this->session->userdata('userID'),
                'status' => '1'
            );
            $this->AdminModel->dataSubmit('post_category',$data);
            $this->session->set_flashdata('category_view', '<div class="alert alert-success alert-dismissible">Category added successfully!</div>');
            redirect("admin/categories");
        }
    }

    public function editCategory($catID){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $catID = customDecrypt($catID);
        $cond = array('id'=>$catID);
        $catData['catDet'] = $this->AdminModel->getSinglerecord('post_category','*',$cond);
        $this->load->view('admin_panel/posts/editCategory', $catData );
    }

    public function update_category(){

        if ($this->session->userdata('userLoggedIn') == null) {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $postID = $this->input->post('catID');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('cat_name', 'Category Name', 'required|max_length[255]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin_panel/posts/editCategory/'.$postID);
        } else {
            $data = array(
                'cat_name' => $this->input->post('cat_name'),
                'updated_at' => date('y-m-d h:i:s'),
                'updated_by' => $this->session->userdata('userID'),
            );
            $postIDNew = customDecrypt($postID);
            $cond = array('id'=>$postIDNew);
            if($this->AdminModel->updateRecord('post_category',$data,$cond)==1){
                $this->session->set_flashdata('category_view', '<div class="alert alert-success alert-dismissible">Category updated successfully!</div>');
                redirect('admin/categories');
            } else {
                $this->session->set_flashdata('category_view', '<div class="alert alert-warning alert-dismissible">Some error occured! Please try again.</div>');
                redirect('admin/categories');
            }
        }
    }

    public function deleteCategory($postID=null){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $postIDNew = customDecrypt($postID);
        $cond = array('id'=>$postIDNew);
        if($this->AdminModel->deleteRecord('post_category',$cond)){
            $this->session->set_flashdata('category_view', '<div class="alert alert-danger alert-dismissible">Category deleted!</div>');
            redirect('admin/categories');
        } else {
            $this->session->set_flashdata('category_view', '<div class="alert alert-info alert-dismissible">Some error occured!</div>');
            redirect('admin/categories');
        }
    }


}
