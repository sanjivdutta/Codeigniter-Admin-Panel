<?php
class AdminModel extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function CheckLogin($data){
        $rec = $this->db->where($data)->select('id,username,fname,lname,block,user_type,profileImage')->from('admin_users')->get()->result_array();
        if(empty($rec)) return 0;
        else return $rec;
    }

    function dataSubmit($tblname=null,$tblFields=null){
        if($this->db->insert($tblname,$tblFields)){
            return $this->db->insert_id();
        } else {
            return 0;
        }
    }

    function dataView($tblName=null,$tblFields=null,$tblOrderColumn=null,$tblOrderType=null,$limit=null,$tblCond=null){
        $tblFields = ($tblFields==null)?'*':$tblFields;
        $this->db->select($tblFields);
        if($tblCond!=null){
            $this->db->where($tblCond);
        }
        if($limit!=null){
            $this->db->limit($limit);
        }
        if($tblOrderColumn!=null && $tblOrderType!=null){
            $this->db->order_by($tblOrderColumn,$tblOrderType);
        } else {
            $this->db->order_by('id','DESC');
        }
        $tblRows = $this->db->from($tblName)->get()->result_array();
        return $tblRows;
    }

    function getSinglerecord($tblName=null,$tblFields=null,$tblCond=null){
        $this->db->select($tblFields);
        $this->db->from($tblName);
        $this->db->where($tblCond);
        $tblRecord = $this->db->get()->first_row();
        return $tblRecord;
    }

    function getIndividualCategory($catID = null){
        $this->db->select('cat_name');
        $this->db->from('post_category');
        $retval = $this->db->where('id',$catID)->get()->first_row();
        return isset($retval->cat_name)?$retval->cat_name:'NA';
    }

    function getIndividualProductCategory($catID = null){
        $this->db->select('cat_name');
        $this->db->from('product_category');
        $retval = $this->db->where('id',$catID)->get()->first_row();
        return isset($retval->cat_name)?$retval->cat_name:'NA';
    }


    function getIndividualClasifiedCategory($clasID = null){
        $this->db->select('cat_name');
        $this->db->from('classified_category');
        $retval = $this->db->where('id',$clasID)->get()->first_row();
        return isset($retval->cat_name)?$retval->cat_name:'NA';
    }


    function updateRecord($tblName=null,$tblFields=null,$tblCond=null){
        $this->db->where($tblCond);
        $this->db->update($tblName,$tblFields);
        return 1;
    }

    function deleteImage($tblName=null,$tblFields=null,$tblCond=null){
        $this->db->where($tblCond);
        $this->db->update($tblName,$tblFields);
        return 1;
    }

    function deleteRecord($tblName=null,$tblCond=null){
        $this->db->where($tblCond);
        $this->db->delete($tblName);
        return 1;
    }

    function dataRowCount($tblName=null,$tblCond=null){
        $this->db->select('id');
        if($tblCond!=null){
            $this->db->where($tblCond);
        }
        $totalRows = $this->db->from($tblName)->get()->num_rows();
        return $totalRows;
    }

    function galleryView(){
        $this->db->select('gallery.*,count(gallery_meta.id) as imgCount')->from('gallery');
        $this->db->join('gallery_meta','gallery.id=gallery_meta.gal_id');
        $this->db->group_by('gallery.id');
        $data = $this->db->get()->result_array();
        return $data;
    }

    function getGalImages($galID){
        $this->db->select('*')->from('gallery_meta');
        $this->db->where('gal_id',$galID);
        $rows = $this->db->get()->result_array();
        return $rows;
    }

    function getLastAlbumImages(){
        $this->db->select('*')->from('gallery_meta');
        $this->db->order_by('gallery_meta.id','DESC');
        $this->db->limit(10);
        $data = $this->db->get()->result_array();
        //echo $this->db->last_query(); die;
        return $data;
    }

    function siteInfo(){
        $this->db->select('*')->from('setting');
        $rows = $this->db->get()->result_array();
        return $rows;
    }

}
?>