<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductController extends CI_Controller {

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

    public function addProduct(){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $catData['categories'] = $this->AdminModel->dataView('product_category','id,cat_name','cat_name','ASC');
        $this->load->view('admin_panel/products/addProduct',$catData);
    }

    public function submit_product()
    {
        if ($this->session->userdata('userLoggedIn') == null) {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error col-pink">', '</div>');
        $this->form_validation->set_rules('pid', 'Product ID', 'required|max_length[100]');
        $this->form_validation->set_rules('pname', 'Product Name', 'required|max_length[100]');
        $this->form_validation->set_rules('status', 'Post Status', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin_panel/products/addProduct');
        } else {
            if($_POST['percent']!='' && $_POST['percent']!='0.00'){
                $_POST['price_discount'] = '';
            }
            if($_POST['price_discount']!='' && $_POST['price_discount']!='0.00'){
                $_POST['percent'] = '';
            }
            $_POST['created_at'] = date('y-m-d h:i:s');
            $proID = $this->AdminModel->dataSubmit('product',$_POST);

            /* Update Images */
            $data = array();
            if(!empty($_FILES['product_images']['name'])) {
                $filesCount = count($_FILES['product_images']['name']);
                for ($i = 0; $i < $filesCount; $i++) {
                    $_FILES['product_image']['name'] = date('ymdhis').$_FILES['product_images']['name'][$i];
                    $_FILES['product_image']['type'] = $_FILES['product_images']['type'][$i];
                    $_FILES['product_image']['tmp_name'] = $_FILES['product_images']['tmp_name'][$i];
                    $_FILES['product_image']['error'] = $_FILES['product_images']['error'][$i];
                    $_FILES['product_image']['size'] = $_FILES['product_images']['size'][$i];

                    $uploadPath = './uploads/products';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = 'gif|jpg|png';

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('product_image')) {
                        $fileData = $this->upload->data();
                        $uploadData[$i]['file_name'] = $fileData['file_name'];
                        $uploadData[$i]['created'] = date("Y-m-d H:i:s");
                        $uploadData[$i]['modified'] = date("Y-m-d H:i:s");

                        $insArray = array('pid'=>$proID,'image_name'=>$uploadData[$i]['file_name']);
                        //print_r($insArray);
                        $this->AdminModel->dataSubmit('product_images',$insArray);
                    }
                }
            }

            $this->session->set_flashdata('post_submit', '<div class="alert alert-success alert-dismissible">Product added successfully!</div>');
            redirect("admin/add_product");
        }
    }

    public function viewProduct(){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $postData['tblData'] = $this->AdminModel->dataView('product');
        $this->load->view('admin_panel/products/viewProduct', $postData );
    }

    public function editProduct($postID){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $postID = customDecrypt($postID);
        $cond = array('id'=>$postID);
        $postData['proDet'] = $this->AdminModel->getSinglerecord('product','*',$cond);
        $postData['categories'] = $this->AdminModel->dataView('product_category','id,cat_name','cat_name','ASC');
        $condImg = array('pid'=>$postID);
        $postData['proImages'] = $this->AdminModel->dataView('product_images','*','id','ASC','100',$condImg);
        $this->load->view('admin_panel/products/editProduct', $postData );
    }

    public function deleteImage($imgID){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $imageID = customDecrypt($imgID);
        $cond = array('id'=>$imageID);

        $imgname = $this->AdminModel->getSinglerecord('product_images','*',$cond);
        unlink('./uploads/products/'.$imgname->image_name);
        $this->AdminModel->deleteRecord('product_images',$cond);
        $this->session->set_flashdata('record_update', '<div class="alert alert-info alert-dismissible">Image deleted successfully!</div>');
        redirect('admin/product/edit/'.customEncrypt($imgname->pid));
    }

    public function update_product(){

        if ($this->session->userdata('userLoggedIn') == null) {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $postID = $this->input->post('postID');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error col-pink">', '</div>');
        $this->form_validation->set_rules('pname', 'Product Name', 'required|max_length[100]');
        $this->form_validation->set_rules('status', 'Post Status', 'required');
        if ($this->form_validation->run() == FALSE) {
            $cond = array('id'=>customDecrypt($postID));
            $postData['proDet'] = $this->AdminModel->getSinglerecord('product','*',$cond);
            //print_r($cond); die;
            $this->load->view('admin_panel/products/editProduct',$postData);
        } else {
            $fileName = '';
            if($_POST['percent']!='' && $_POST['percent']!='0.00'){
                $_POST['price_discount'] = '';
            }
            if($_POST['price_discount']!='' && $_POST['price_discount']!='0.00'){
                $_POST['percent'] = '';
            }
            $_POST['updated_at'] = date('y-m-d h:i:s');
            $postIDNew = customDecrypt($postID);
            $cond = array('id'=>$postIDNew);
            unset($_POST['postID']);
            /* Update Images */
            $data = array();
            if(!empty($_FILES['product_images']['name'])) {
                $filesCount = count($_FILES['product_images']['name']);
                //echo $filesCount.'<pre>';
                //print_r($_FILES); die;
                for ($i = 0; $i < $filesCount; $i++) {
                    $_FILES['product_image']['name'] = date('ymdhis').$_FILES['product_images']['name'][$i];
                    $_FILES['product_image']['type'] = $_FILES['product_images']['type'][$i];
                    $_FILES['product_image']['tmp_name'] = $_FILES['product_images']['tmp_name'][$i];
                    $_FILES['product_image']['error'] = $_FILES['product_images']['error'][$i];
                    $_FILES['product_image']['size'] = $_FILES['product_images']['size'][$i];

                    $uploadPath = './uploads/products';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = 'gif|jpg|png';

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('product_image')) {
                        $fileData = $this->upload->data();
                        $uploadData[$i]['file_name'] = $fileData['file_name'];
                        $uploadData[$i]['created'] = date("Y-m-d H:i:s");
                        $uploadData[$i]['modified'] = date("Y-m-d H:i:s");

                        $insArray = array('pid'=>$postIDNew,'image_name'=>$uploadData[$i]['file_name']);
                        //print_r($insArray);
                        $this->AdminModel->dataSubmit('product_images',$insArray);
                    }
                }
            } //die;

            if($this->AdminModel->updateRecord('product',$_POST,$cond)==1){
                $this->session->set_flashdata('post_submit', '<div class="alert alert-success alert-dismissible">Product updated successfully!</div>');
                redirect('admin/product/edit/'.$postID);
            } else {
                $this->session->set_flashdata('post_submit', '<div class="alert alert-warning alert-dismissible">Some error occured! Please try again.</div>');
                redirect('admin/product/edit/'.$postID);
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
        $catData['categories'] = $this->AdminModel->dataView('product_category','*','cat_name','ASC');
        $this->load->view('admin_panel/products/category',$catData);
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

            $config['upload_path'] = './uploads/catImages';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size']    = '50000';

            //load upload class library
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('cat_images'))
            {
                $upload_error = array('error' => $this->upload->display_errors());
                $this->load->view('admin_panel/posts/category', $upload_error);
            }
            else
            {
                // case - success
                $upload_data = $this->upload->data();
            }

            $data = array(
                'pid' => '0',
                'cat_name' => $this->input->post('cat_name'),
                'file_name' => $this->upload->data()['file_name'],
                'created_at' => date('y-m-d h:i:s'),
                'created_by' => $this->session->userdata('userID'),
                'status' => '1'
            );
            $this->AdminModel->dataSubmit('product_category',$data);
            $this->session->set_flashdata('category_view', '<div class="alert alert-success alert-dismissible">Category added successfully!</div>');
            redirect("admin/product_categories");
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
        $catData['catDet'] = $this->AdminModel->getSinglerecord('product_category','*',$cond);
        $this->load->view('admin_panel/products/editCategory', $catData );
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

        /*if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin_panel/products/editCategory/'.customDecrypt($postID));
        } else {*/

            $config['upload_path'] = './uploads/catImages';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size']    = '50000';

            //load upload class library
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('cat_images'))
            {
                $upload_error = array('error' => $this->upload->display_errors());
                $this->load->view('admin_panel/posts/category', $upload_error);
            }
            else
            {
                // case - success
                $upload_data = $this->upload->data();
            }

            if($this->upload->data()['file_name'] != '' ){
                $data = array(
                    'cat_name' => $this->input->post('cat_name'),
                    'file_name' => $this->upload->data()['file_name'],
                    'updated_at' => date('y-m-d h:i:s'),
                    'updated_by' => $this->session->userdata('userID'),
                );
            } else {
                $data = array(
                    'cat_name' => $this->input->post('cat_name'),
                    'updated_at' => date('y-m-d h:i:s'),
                    'updated_by' => $this->session->userdata('userID'),
                );
            }

            $postIDNew = customDecrypt($postID);
            $cond = array('id'=>$postIDNew);
            if($this->AdminModel->updateRecord('product_category',$data,$cond)==1){
                $this->session->set_flashdata('category_view', '<div class="alert alert-success alert-dismissible">Category updated successfully!</div>');
                redirect('admin/product_categories');
            } else {
                $this->session->set_flashdata('category_view', '<div class="alert alert-warning alert-dismissible">Some error occured! Please try again.</div>');
                redirect('admin/product_categories');
            }
        //}
    }

    public function deleteCategory($postID=null){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $postIDNew = customDecrypt($postID);
        $cond = array('id'=>$postIDNew);
        if($this->AdminModel->deleteRecord('product_category',$cond)){
            $this->session->set_flashdata('category_view', '<div class="alert alert-danger alert-dismissible">Category deleted!</div>');
            redirect('admin/product_categories');
        } else {
            $this->session->set_flashdata('category_view', '<div class="alert alert-info alert-dismissible">Some error occured!</div>');
            redirect('admin/product_categories');
        }
    }

    public function deleteCategoryImage($catID=null){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }

        $catIDNew = customDecrypt($catID);
        $data = array('file_name'=>'');
        $condArr = array('id'=>$catIDNew);
        $this->AdminModel->updateRecord('product_category',$data,$condArr);
        redirect('admin/product/category/edit/'.$catID);
    }


}
