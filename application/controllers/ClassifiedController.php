<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClassifiedController extends CI_Controller {

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

    public function addClassified(){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $catData['categories'] = $this->AdminModel->dataView('classified_category','id,cat_name','cat_name','ASC');
        $this->load->view('admin_panel/classifieds/addClassified',$catData);
    }

    public function submit_classified()
    {
        if ($this->session->userdata('userLoggedIn') == null) {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error col-pink">', '</div>');
        $this->form_validation->set_rules('business_name', 'Business Name', 'required|max_length[255]');
        $this->form_validation->set_rules('address', 'Business Address', 'required');
        $this->form_validation->set_rules('phone', 'Business Phone', 'required');
        $this->form_validation->set_rules('email', 'Business Email', 'required|valid_email|is_unique[classified.email]');
        $this->form_validation->set_rules('phone', 'Business Phone', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin_panel/classifieds/addClassified');
        } else {
            

                if($_FILES['afda_logo']['name']!=''){
                    $errors= array();
                    $file_name = date('Ymdhis').'_'.$_FILES['afda_logo']['name'];
                    $file_size =$_FILES['afda_logo']['size'];
                    $file_tmp =$_FILES['afda_logo']['tmp_name'];
                    //$file_type=$_FILES['afda_logo']['type'];
                    //$file_ext=strtolower(end(explode('.',$_FILES['afda_logo']['name'])));

                    //$expensions= array("jpeg","jpg","png");
                    //if(in_array($file_ext,$expensions)=== TURE){
                    move_uploaded_file($file_tmp,"uploads/business_logo/".$file_name);
                    $_POST['afda_logo'] = $file_name;
                    //}
               }

               if($_FILES['business_logo']['name']!=''){
                    $errors= array();
                    $file_name = date('Ymdhis').'_'.$_FILES['business_logo']['name'];
                    $file_size =$_FILES['business_logo']['size'];
                    $file_tmp =$_FILES['business_logo']['tmp_name'];
                    move_uploaded_file($file_tmp,"uploads/business_logo/".$file_name);
                    $_POST['business_logo'] = $file_name;
                }
                
                $_POST['created_at'] = date('y-m-d h:i:s');
                $_POST['created_by'] = $this->session->userdata('userID');
                $proID = $this->AdminModel->dataSubmit('classified',$_POST);

                /* Update Images */
                $data = array();
                if(!empty($_FILES['gal_images']['name'])) {
                    $filesCount = count($_FILES['gal_images']['name']);
                    for ($i = 0; $i <= 5; $i++) {
                        $_FILES['product_image']['name'] = date('ymdhis').$_FILES['gal_images']['name'][$i];
                        $_FILES['product_image']['type'] = $_FILES['gal_images']['type'][$i];
                        $_FILES['product_image']['tmp_name'] = $_FILES['gal_images']['tmp_name'][$i];
                        $_FILES['product_image']['error'] = $_FILES['gal_images']['error'][$i];
                        $_FILES['product_image']['size'] = $_FILES['gal_images']['size'][$i];

                        $uploadPath = './uploads/business_logo';
                        $config['upload_path'] = $uploadPath;
                        $config['allowed_types'] = 'gif|jpg|png';

                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload('product_image')) {
                            $fileData = $this->upload->data();
                            $uploadData[$i]['file_name'] = $fileData['file_name'];
                            $insArray = array('business_id'=>$proID,'image_name'=>$uploadData[$i]['file_name']);
                            //print_r($insArray);
                            $this->AdminModel->dataSubmit('business_images',$insArray);
                        }
                    }
                }

                $this->session->set_flashdata('post_submit', '<div class="alert alert-success alert-dismissible">Business added successfully!</div>');
                redirect("admin/add_classified");
        }
    }

    public function viewClassified(){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $postData['tblData'] = $this->AdminModel->dataView('classified');
        $this->load->view('admin_panel/classifieds/viewClassified', $postData );
    }

    public function editClassified($postID){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $postID = customDecrypt($postID);
        $cond = array('id'=>$postID);
        $postData['clasiDet'] = $this->AdminModel->getSinglerecord('classified','*',$cond);
        $postData['categories'] = $this->AdminModel->dataView('classified_category','id,cat_name','cat_name','ASC');
        $condImg = array('business_id'=>$postID);
        $postData['businessImages'] = $this->AdminModel->dataView('business_images','*','id','ASC','5',$condImg);
        $this->load->view('admin_panel/classifieds/editClassified', $postData );
    }

    public function deleteImage($imgID){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $imageID = customDecrypt($imgID);
        $cond = array('id'=>$imageID);

        $imgname = $this->AdminModel->getSinglerecord('business_images','*',$cond);
        unlink('./uploads/business_logo/'.$imgname->image_name);
        $this->AdminModel->deleteRecord('business_images',$cond);
        $this->session->set_flashdata('record_update', '<div class="alert alert-info alert-dismissible">Image deleted successfully!</div>');
        redirect('admin/classified/edit/'.customEncrypt($imgname->business_id));
    }

    public function update_classified(){

        if ($this->session->userdata('userLoggedIn') == null) {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $postID = $this->input->post('postID');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error col-pink">', '</div>');
        $this->form_validation->set_rules('business_name', 'Business Name', 'required|max_length[255]');
        $this->form_validation->set_rules('address', 'Business Address', 'required');
        $this->form_validation->set_rules('phone', 'Business Phone', 'required');
        $this->form_validation->set_rules('phone', 'Business Phone', 'required');
        if ($this->form_validation->run() == FALSE) {
            $cond = array('id'=>$postID);
            $postData['clasiDet'] = $this->AdminModel->getSinglerecord('classified','*',$cond);
            $this->load->view('admin_panel/classifieds/editClassified',$postData);
        } else {

            if($_FILES['afda_logo']['name']!=''){
                $errors= array();
                $file_name = date('Ymdhis').'_'.$_FILES['afda_logo']['name'];
                $file_size =$_FILES['afda_logo']['size'];
                $file_tmp =$_FILES['afda_logo']['tmp_name'];
                //$file_type=$_FILES['afda_logo']['type'];
                //$file_ext=strtolower(end(explode('.',$_FILES['afda_logo']['name'])));

                //$expensions= array("jpeg","jpg","png");
                //if(in_array($file_ext,$expensions)=== TURE){
                move_uploaded_file($file_tmp,"uploads/business_logo/".$file_name);
                $_POST['afda_logo'] = $file_name;
                //}
           }

           if($_FILES['business_logo']['name']!=''){
                $errors= array();
                $file_name = date('Ymdhis').'_'.$_FILES['business_logo']['name'];
                $file_size =$_FILES['business_logo']['size'];
                $file_tmp =$_FILES['business_logo']['tmp_name'];
                move_uploaded_file($file_tmp,"uploads/business_logo/".$file_name);
                $_POST['business_logo'] = $file_name;
            }

            if($_POST['afda_member']=='N'){
                $_POST['afda_logo'] = '';
                $_POST['business_logo'] = '';
            }

            $condImg = array('business_id'=>customDecrypt($postID));
            $postData['businessImages'] = $this->AdminModel->dataView('business_images','*','id','ASC','5',$condImg);
            $totalImg = count($postData['businessImages']);
            /* Update Images */
            $data = array();
            if(!empty($_FILES['gal_images']['name'])) {
                $filesCount = count($postData['businessImages']);
                $count = (5-$filesCount);

                for ($i = 0; $i < $count; $i++) {
                    $_FILES['product_image']['name'] = date('ymdhis').$_FILES['gal_images']['name'][$i];
                    $_FILES['product_image']['type'] = $_FILES['gal_images']['type'][$i];
                    $_FILES['product_image']['tmp_name'] = $_FILES['gal_images']['tmp_name'][$i];
                    $_FILES['product_image']['error'] = $_FILES['gal_images']['error'][$i];
                    $_FILES['product_image']['size'] = $_FILES['gal_images']['size'][$i];

                    $uploadPath = './uploads/business_logo';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = 'gif|jpg|png';

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config); 
                    if ($this->upload->do_upload('product_image')) {
                        $fileData = $this->upload->data();
                        $uploadData[$i]['file_name'] = $fileData['file_name'];
                        $insArray = array('business_id'=>customDecrypt($postID),'image_name'=>$uploadData[$i]['file_name']);
                        //print_r($insArray);
                        $this->AdminModel->dataSubmit('business_images',$insArray);
                    }
                }
            }
            $_POST['updated_at'] = date('y-m-d h:i:s');
            $_POST['updated_by'] = $this->session->userdata('userID');
            $postIDNew = customDecrypt($postID);
            $cond = array('id'=>$postIDNew);
            unset($_POST['postID']);

            if($this->AdminModel->updateRecord('classified',$_POST,$cond)==1){
                $this->session->set_flashdata('post_submit', '<div class="alert alert-success alert-dismissible">Business updated successfully!</div>');
                redirect('admin/classified/edit/'.$postID);
            } else {
                $this->session->set_flashdata('post_submit', '<div class="alert alert-warning alert-dismissible">Some error occured! Please try again.</div>');
                redirect('admin/classified/edit/'.$postID);
            }
        }
    }

    public function deleteClassified($postID=null){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $postIDNew = customDecrypt($postID);
        $cond = array('id'=>$postIDNew);
        /*$imgname = $this->AdminModel->getSinglerecord('posts','file_name',$cond);
        if($imgname->file_name!='') {
            unlink('./uploads/postImages/' . $imgname->file_name);
        }*/

        if($this->AdminModel->deleteRecord('classified',$cond)){
            $this->session->set_flashdata('post_submit', '<div class="alert alert-delete alert-dismissible">Business deleted!</div>');
            redirect('admin/view_classified');
        } else {
            $this->session->set_flashdata('post_submit', '<div class="alert alert-info alert-dismissible">Some error occured!</div>');
            redirect('admin/view_classified');
        }
    }


    /** Category Section **/

    public function viewCategories(){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $catData['categories'] = $this->AdminModel->dataView('classified_category','*','cat_name','ASC');
        $this->load->view('admin_panel/classifieds/category',$catData);
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
            $this->load->view('admin_panel/classified/category');
        } else {
            $data = array(
                'pid' => '0',
                'cat_name' => $this->input->post('cat_name'),
                'created_at' => date('y-m-d h:i:s'),
                'created_by' => $this->session->userdata('userID'),
                'status' => '1'
            );
            $this->AdminModel->dataSubmit('classified_category',$data);
            $this->session->set_flashdata('category_view', '<div class="alert alert-success alert-dismissible">Category added successfully!</div>');
            redirect("admin/classified_categories");
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
        $catData['catDet'] = $this->AdminModel->getSinglerecord('classified_category','*',$cond);
        $this->load->view('admin_panel/classifieds/editCategory', $catData );
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
            $data = array(
                'cat_name' => $this->input->post('cat_name'),
                'updated_at' => date('y-m-d h:i:s'),
                'updated_by' => $this->session->userdata('userID'),
            );
            $postIDNew = customDecrypt($postID);
            $cond = array('id'=>$postIDNew);
            if($this->AdminModel->updateRecord('classified_category',$data,$cond)==1){
                $this->session->set_flashdata('category_view', '<div class="alert alert-success alert-dismissible">Category updated successfully!</div>');
                redirect('admin/classified_categories');
            } else {
                $this->session->set_flashdata('category_view', '<div class="alert alert-warning alert-dismissible">Some error occured! Please try again.</div>');
                redirect('admin/classified_categories');
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
        if($this->AdminModel->deleteRecord('classified_category',$cond)){
            $this->session->set_flashdata('category_view', '<div class="alert alert-danger alert-dismissible">Category deleted!</div>');
            redirect('admin/classified_categories');
        } else {
            $this->session->set_flashdata('category_view', '<div class="alert alert-info alert-dismissible">Some error occured!</div>');
            redirect('admin/classified_categories');
        }
    }


}
