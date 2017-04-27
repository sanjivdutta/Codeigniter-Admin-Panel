<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SettingController extends CI_Controller {
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
        $settingArray['footerText'] = $this->AdminModel->getSinglerecord('setting','*',array('field_name'=>'footer_text'));
        $settingArray['copyrightText'] = $this->AdminModel->getSinglerecord('setting','*',array('field_name'=>'copyright_text'));
        $settingArray['siteImage'] = $this->AdminModel->getSinglerecord('setting','*',array('field_name'=>'site_logo_image'));
        $settingArray['siteAdminImage'] = $this->AdminModel->getSinglerecord('setting','',array('field_name'=>'site_admin_logo_image'));

        $this->load->view('admin_panel/setting/index',$settingArray);
    }

    public function setting_submit()
    {
        if ($this->session->userdata('userLoggedIn') == null) {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }
        $insArray = array();
        $insArray = $this->input->post();

        $config['upload_path'] = './uploads';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']    = '50000';

        //load upload class library
        $this->load->library('upload', $config);

        /* Upload Front Panel logo */
        if (!$this->upload->do_upload('site_logo_image'))
        {
            $upload_error = array('error' => $this->upload->display_errors());
            $this->load->view('admin_panel/setting/index', $upload_error);
        }
        else
        {
            // case - success
            $upload_data1 = $this->upload->data();
            $insArray['site_logo_image'] = $upload_data1['file_name'];
        }
        
        /* Upload Front Panel logo */

        foreach($insArray as $key=>$val) {
            $insArrayFull['field_name'] = $key;
            $insArrayFull['field_value'] = $val;

            $chkArray = $this->AdminModel->getSinglerecord('setting', '*', array('field_name' => $key));

            if (!empty($chkArray)) {
                $this->AdminModel->updateRecord('setting', array('field_value' => $val), array('field_name' => $key));
            } else {
                if ($val != '') {
                    $this->AdminModel->dataSubmit('setting', $insArrayFull);
                }
            }
        }
         $this->session->set_flashdata('setting_submit', '<div class="alert alert-success alert-dismissible">Settings added successfully!</div>');
         redirect("admin/setting");
    }

    public function deleteImage($settingID){
        if ( $this->session->userdata('userLoggedIn')== null)
        {
            $this->session->set_flashdata('login_error', 'Please login to continue!');
            redirect("/");
        }

        $settingIDNew = customDecrypt($settingID);
        $cond = array('id'=>$settingIDNew);

        $imgname = $this->AdminModel->getSinglerecord('setting','field_value',$cond);
        unlink('./uploads/'.$imgname->field_value);

        if($this->AdminModel->deleteRecord('setting',$cond) == 1){
            $this->session->set_flashdata('setting_submit', '<div class="alert alert-info alert-dismissible">Image deleted successfully!</div>');
            redirect('admin/setting');
        } else {
            $this->session->set_flashdata('setting_submit', '<div class="alert alert-danger alert-dismissible">Something wrong happened!</div>');
            redirect('admin/setting');
        }
    }
}
