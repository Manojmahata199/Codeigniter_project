<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model {




    public function login_op($data){

    	$user_email=$data['user_email'];
    	$password=$data['password'];

    	$arr=array();
    	$arr=array('user_email'=>$user_email,'password'=>$password);

    	$data_res=$this -> db -> where($arr);
    	$data_res= $this-> db ->get('user');
    	   
        $data_res->num_rows();
        
       if($data_res->num_rows()>0){

       	  return $data_res->row();

       }
       else{

       	  return false;
       }

    }
    public function add_another_institute($data,$appl_id,$reg_id,$email,$phone){
        if($data!="" && $appl_id!=""){

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
    public function add_third_institute($data,$appl_id,$reg_id,$email,$phone){

         if($data!="" && $appl_id!=""){

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

    public function log_appl_find($data){
        
        $name=$data['name'];
        $email=$data['email'];
        $phone=$data['phone'];

        

        $this -> db -> where('email',$email);
        // $this -> db -> where('phone',$phone);
        // $this -> db -> where('name',$name);
        $data_res= $this-> db ->get('aparajita_detail');
        $data_res->num_rows();
       
        if($data_res->num_rows()>0){

          return $data_res->row();
        }
        else{

          return false;
        }

    }
    

    public function register_user($data){

        $name=$data['name'];
        $email=$data['email'];
        $phone=$data['phone'];
       
        $this -> db -> where('email',$email);
        $this -> db -> where('phone',$phone);
        $data_res= $this-> db ->get('aparajita_detail');
        $data_res->num_rows();
      
       
        if($data_res->num_rows()>0){

         return false;
        }
        else{

            $this-> db ->insert('aparajita_detail',$data);
            $insert_id = $this->db->insert_id();

            return  $insert_id;
        }

    }
    public function update_regid($success_id,$unique_id){

        $id=$success_id['regid'];
        $reg_id='user'.$success_id['regid'];

        $data=$this->db->set('reg_id',$reg_id);
        $data=$this->db->set('unique_id',$unique_id);
        $data=$this->db->where('id',$id);
        $data=$this->db->update('aparajita_detail');
           
         return true;
    }
    public function update_name($name_data,$up_id,$up_reg_id,$up_email,$up_phone){
       if($name_data!="" && $up_id!=""){

            $data=$this->db->set($name_data);
            $data=$this->db->where('id',$up_id);
            $data=$this->db->where('reg_id',$up_reg_id);
            $data=$this->db->where('email',$up_email);
            $data=$this->db->where('phone',$up_phone);
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
    public function step2_submit($data,$appl_id,$reg_id,$email,$phone){
        if($data!="" && $appl_id!=""){

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
    public function step3_submit($data,$appl_id,$reg_id,$email,$phone){
        if($data!="" && $appl_id!=""){

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
    public function step4_submit($data,$appl_id,$reg_id,$email,$phone){
        if($data!="" && $appl_id!=""){

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
    public function step5_submit($data,$appl_id,$reg_id,$email,$phone){
        if($data!="" && $appl_id!=""){

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
    public function step6_submit($data,$appl_id,$reg_id,$email,$phone){
        if($data!="" && $appl_id!=""){

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
    public function step7_submit($data,$appl_id,$reg_id,$email,$phone){
        if($data!="" && $appl_id!=""){

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
    public function final_submit($data,$appl_id,$reg_id,$email,$phone){
        if($data!="" && $appl_id!=""){

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

}