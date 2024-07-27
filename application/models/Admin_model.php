<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {



	public function login_op($data){

    	$mail=$data['mail'];
    	$password=$data['password'];

    	$arr=array();
    	$arr=array('mail'=>$mail,'password'=>$password);

    	$data_res=$this -> db -> where($arr);
    	$data_res= $this-> db ->get('admin');
    	   
        $data_res->num_rows();
        
       if($data_res->num_rows()>0){

       	  return $data_res->row();

       }
       else{

       	  return false;
       }

    }

  public function mail_count($data,$appl_id,$reg_id,$email,$phone){
     if($appl_id!="" && $reg_id!=""){

            $data=$this->db->set($data);
            $data=$this->db->where('id',$appl_id);
            $data=$this->db->where('reg_id',$reg_id);
            $data=$this->db->where('email',$email);
            $data=$this->db->where('phone',$phone);
            $data=$this->db->update('aparajita_detail');
           


            if($data){
                return true;
            }
            else{
               return  false;
            }
        }
        else{
          return false;  
        }


  }

    
	public function application_list(){

	    
	    
	    $data= $this-> db ->order_by("id", "ASC");
	    // $data= $this-> db ->limit($limit, $arr_start);
	    $data= $this-> db ->get('aparajita_detail'); 
	    return $data->result(); 



	}
	public function search_list($search){


            $this->db->select('*');
            $this->db->from('aparajita_detail');
            $this->db->or_like('name',$search,'both');
            $this->db->or_like('email', $search,'both');
            $this->db->or_like('phone', $search,'both');
            $this->db->or_like('category', $search,'both');
            $this->db->or_like('you_shine', $search,'both');
            $this->db->or_like('shine_five', $search,'both');
            $this->db->or_like('org_name', $search,'both');
            $this->db->or_like('current_profile', $search,'both');
            $this->db->or_like('company_incorporation_date', $search,'both');
            $this->db->or_like('is_incorporated',$search,'both');
            $this->db->or_like('year_experience',$search,'both');
            $this->db->or_like('digital_presence_instagram',$search,'both');
            $this->db->or_like('digital_presence_twitter', $search,'both');
            $this->db->or_like('digital_presence_facebook', $search,'both');
            $this->db->or_like('digital_presence_linkedin', $search,'both');
            $this->db->or_like('org_address', $search,'both');
            $this->db->or_like('org_city', $search,'both');
            $this->db->or_like('org_state', $search,'both');
            $this->db->or_like('org_pin', $search,'both');
            $this->db->or_like('org_email', $search,'both');
            $this->db->or_like('org_contactno',$search,'both');
            $this->db->or_like('org_website',$search,'both');
            $this->db->or_like('applicant_name',$search,'both');
            $this->db->or_like('dob',$search,'both');
            $this->db->or_like('mobile',$search,'both');
            $this->db->or_like('email_id',$search,'both');
            $this->db->or_like('social_media',$search,'both');
            $this->db->or_like('linkedin_profile',$search,'both');
            $this->db->or_like('your_role',$search,'both');
            $this->db->or_like('bio_video',$search,'both');
            $this->db->or_like('past_organization_name1',$search,'both');
            $this->db->or_like('past_organization_name2',$search,'both');
            $this->db->or_like('past_organization_name3',$search,'both');
            $this->db->or_like('your_thoughts',$search,'both');
            $this->db->or_like('womans_crown',$search,'both');
            $this->db->or_like('support_entry',$search,'both');
            $this->db->or_like('awards_recognition',$search,'both');
            $this->db->or_like('letter_from_organization',$search,'both');
            $this->db->or_like('signature',$search,'both');
            $query= $this-> db ->get();
            return $query->result();

         
         

     }
    
     
    
       public function appl_count(){

          $step8=1;
          $data=$this-> db ->where('step8',$step8);
          $data= $this-> db ->get('aparajita_detail'); 
          
           return $value=$data->num_rows(); 


       }
       


}
?>