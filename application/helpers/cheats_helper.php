<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('test_method'))
{
    function CallPage($pageName = '')
    {
        $this->load->view('admin_panel/include/header');
        $this->load->view('admin_panel/include/top_bar');
        $this->load->view('admin_panel/include/left_menu');
        $this->load->view('admin_panel/include/right_bar');
        $this->load->view('admin_panel/'.$pageName);
        $this->load->view('admin_panel/include/footer');
    }

    function getCategory($catID){
        $CI =& get_instance();
        $CI->load->model('AdminModel');
        $catVal = $CI->AdminModel->getIndividualCategory($catID);
        echo $catVal;
    }

    function getProductCategory($catID){
        $CI =& get_instance();
        $CI->load->model('AdminModel');
        $catVal = $CI->AdminModel->getIndividualProductCategory($catID);
        echo $catVal;
    }

    function getClassifiedCategory($clasID){
        $CI =& get_instance();
        $CI->load->model('AdminModel');
        $catVal = $CI->AdminModel->getIndividualClasifiedCategory($clasID);
        echo $catVal;
    }

    function getGalImages($galID){
        $CI =& get_instance();
        $CI->load->model('AdminModel');
        return $CI->AdminModel->getGalImages($galID);
    }

    function customEncrypt($elem){
        return base64_encode(base64_encode(base64_encode(base64_encode($elem))));
    }

    function customDecrypt($elem){
        return base64_decode(base64_decode(base64_decode(base64_decode($elem))));
    }

    function getSiteDetails(){
        $CI =& get_instance();
        $CI->load->model('AdminModel');
        return $CI->AdminModel->siteInfo();
    }
}