<?php

   if($this->session->userdata('id')!="" && $this->session->userdata('reg_id')!=""){
        
        $id=$this->session->userdata('id');
        $reg_id=$this->session->userdata('reg_id');
        $name=$this->session->userdata('name');
        $email=$this->session->userdata('email');
        $phone=$this->session->userdata('phone');


        $data_one=$this -> db -> where('id', $id);
        $data_one=$this -> db -> where('reg_id', $reg_id);
        $data_one= $this-> db ->get('aparajita_detail'); 
        $apl_data_one=$data_one->result();
 
        $step1=$apl_data_one[0]->step1;
        $step2=$apl_data_one[0]->step2;
        $step3=$apl_data_one[0]->step3;
        $step4=$apl_data_one[0]->step4;
        $step5=$apl_data_one[0]->step5;
        $step6=$apl_data_one[0]->step6;
        $step7=$apl_data_one[0]->step7;



    }
    else{

        $step1="";
        $step2="";
        $step3="";
        $step4="";
        $step5="";
        $step6="";
        $step7="";
    }

?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aparajita Registration Form 2024</title>
    <link rel = "icon" href ="<?php echo base_url(); ?>assets/img/aparajita_icon.png" type = "image/x-icon">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/datePicker.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity
        crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style type="text/css">
      
      .file_file{
        position: absolute;
        margin-top: -35px;
        margin-left:100px;
        /*border: 1 px solid grey;*/
        background-color: lightgrey;
        width: 90%;
        text-align: center;

        padding: 0px 8px 4px 8px;
        border: none;
        border-bottom: 1px solid #ccc;
        border-radius: 0px;
        
        font-weight: bold;
        
        box-sizing: border-box;
        color: #2C3E50;
        font-size: 16px;
        letter-spacing: 1px;
        font-family: 'Aktiv Grotesk' !important;
    

      }
      .inactive{
        color: darkgrey;
      }
      .margin_label{
        margin-top: 20px;
      }
      .fs-title{
        margin-top:10px;
      }
      .sign_label{
        font-size: 15px;
        height: 40px;
      }
      div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm {
        background-color: #ea4d55 !important;
      }
      @media screen and (max-width: 1400px) {
        .file_file{
            width: 85%;
        }
        #progressbar li {

            font-size: 14px;
            
        }
        .category label{
            font-size: 16px;
        }
        .form-label{
            font-size: 16px;
        }

      }
      @media screen and (max-width: 1200px) {
        .file_file{
            width: 80%;
        }
        #progressbar li {

            font-size: 12px;
            
        }
        .category label{
            font-size: 16px;
        }
        .form-label{
            font-size: 16px;
        }

      }
      @media screen and (max-width: 1000px) {
        .file_file{
            width: 75%;
        }
        #progressbar li {
            
            font-size: 10px;
            
        }
        .category label{
            font-size: 16px;
        }
        .form-label{
            font-size: 16px;
        }

      }
      @media screen and (max-width: 800px) {
        .file_file{
            width: 70%;
        }
        #progressbar li {
            
            font-size: 10px;
            
        }
        .form-label{
            font-size: 14px;
        }
        .fs-title{
            font-size: 18px;
        }
        .category label{
            font-size: 14px;
        }

        .sign_label{
            font-size: 13px;
            
        }
        .id_ListOfLi li{
            width: 90px;
            height: 60px;
        }
        

      }
      @media screen and (max-width: 500px) {
        .file_file{
            width: 60%;
        }
        #progressbar li {
            
            font-size: 8px;
            
        }
        .sign_label{
            font-size: 14px;
            height: 60px;
        }
        .id_ListOfLi li{
            width: 60px;
            height: 40px;
        }
        

      }
      @media screen and (max-width: 330px) {
        .sign_label{
            font-size: 12px;
            height: 50px;
        }
      }

      
    </style>
    
</head>

<body>
    <div class="container-fluid" id="grad1">
        <div class="row justify-content-center m-0 w-100">
            <div class="col-12 col-md-6 col-lg-4 text-center">
                <img src="<?php echo base_url(); ?>assets/img/Aparajita_Logo_Unit_2021_White.png" width="100%" alt>
            </div>
            <div class="col-12 col-md-12 col-lg-9 text-center p-0 mt-0 mb-2">
                <div class="card px-0 pt-4 pb-0 mt-0 mb-3" style="background: #ea4d55;">
                    <p class="text-white" style="font-size: 15px;color: #2C3E50;margin-bottom: 10px;font-weight: bold;text-align: center;">Fill all mandatory fields to go to the next step</p>
                    <div class="row">
                        <div class="col-md-12 mx-0">
                            
                                
                                <div>
                                    <ul id="progressbar" class="ps-0">

                                            <?php if($step1==1){ ?>

                                            <a href="<?php echo base_url(); ?>Registration/index">
                                              <li  class="<?php print  ($active == '1' || $active == '2' || $active == '3' || $active == '4' || $active == '5' || $active == '6' || $active == '7' || $active == '8') ? 'active' : 'inactive'; ?>" id="intro">
                                            
                                                <strong>Registration</strong>
                                            
                                              </li>
                                            </a>

                                            <?php }else{ ?>

                                            <li  class="<?php print  ($active == '1' || $active == '2' || $active == '3' || $active == '4' || $active == '5' || $active == '6' || $active == '7' || $active == '8') ? 'active' : 'inactive'; ?>" id="intro">
                                            
                                                <strong>Registration</strong>
                                            
                                            </li>
                                            <?php } ?>


                                        <?php if($step2==1){ ?>
                                        <a href="<?php echo base_url(); ?>Registration/step2">
                                            <li  class="<?php print  ($active == '2' || $active == '3' || $active == '4' || $active == '5' || $active == '6' || $active == '7' || $active == '8') ? 'active' : 'inactive'; ?>" id="account">

                                            
                                                <strong>Category</strong>
                                            </li>
                                        </a>
                                        <?php }else{ ?>
                                        <li  class="<?php print  ($active == '2' || $active == '3' || $active == '4' || $active == '5' || $active == '6' || $active == '7' || $active == '8') ? 'active' : 'inactive'; ?>" id="account">

                                            
                                            <strong>Category</strong>
                                        </li>
                                        <?php } ?>
                                        


                                        <?php if($step3==1){ ?>

                                        <a href="<?php echo base_url(); ?>Registration/step3">
                                            <li  class="<?php print  ($active == '3' || $active == '4' || $active == '5' || $active == '6' || $active == '7' || $active == '8') ? 'active' : 'inactive'; ?>" id="personal">
                                             
                                            <strong>Applicant Details</strong>
                                            </li>
                                        </a>
                                        <?php }else{ ?>
                                        <li  class="<?php print  ($active == '3' || $active == '4' || $active == '5' || $active == '6' || $active == '7' || $active == '8') ? 'active' : 'inactive'; ?>" id="personal">
                                             
                                            <strong>Applicant Details</strong>
                                        </li>
                                        <?php } ?>
                                        

                                        <?php if($step4==1){ ?>
                                        <a href="<?php echo base_url(); ?>Registration/step4">
                                            <li  class="<?php print  ($active == '4' || $active == '5' || $active == '6' || $active == '7' || $active == '8') ? 'active' : 'inactive'; ?>" id="payment">
                                             
                                                <strong>Educational Background</strong>
                                            </li>
                                        </a>
                                        <?php }else{ ?>
                                        <li  class="<?php print  ($active == '4' || $active == '5' || $active == '6' || $active == '7' || $active == '8') ? 'active' : 'inactive'; ?>" id="payment">
                                             
                                            <strong>Educational Background</strong>
                                        </li>
                                        <?php } ?>
                                        

                                        <?php if($step5==1){ ?>
                                        <a href="<?php echo base_url(); ?>Registration/step5">
                                            <li  class="<?php print  ($active == '5' || $active == '6' || $active == '7' || $active == '8') ? 'active' : 'inactive'; ?>" id="payment">
                                             
                                                <strong>Organization Details</strong>
                                            </li>
                                        </a>
                                        <?php }else{ ?>
                                        <li  class="<?php print  ($active == '5' || $active == '6' || $active == '7' || $active == '8') ? 'active' : 'inactive'; ?>" id="payment">
                                             
                                                <strong>Organization Details</strong>
                                        </li>
                                        <?php } ?>
                                        


                                         <?php if($step6==1){ ?>
                                        <a href="<?php echo base_url(); ?>Registration/step6">
                                            <li  class="<?php print  ($active == '6' || $active == '7' || $active == '8') ? 'active' : 'inactive'; ?>" id="case">
                                                
                                                    <strong>Insights & Experiences</strong>
                                            </li>
                                        </a>
                                        <?php }else{ ?>
                                        <li  class="<?php print  ($active == '6' || $active == '7' || $active == '8') ? 'active' : 'inactive'; ?>" id="case">
                                            
                                                <strong>Insights & Experiences</strong>
                                        </li>
                                        <?php } ?>
                                        


                                        <?php if($step7==1){ ?>
                                        <a href="<?php echo base_url(); ?>Registration/step7">
                                            <li  class="<?php print  ($active == '7' || $active == '8') ? 'active' : 'inactive'; ?>" id="confirm">
                                            
                                                <strong>Documents</strong>
                                            </li>
                                        </a>
                                        <?php }else{ ?>
                                            <li  class="<?php print  ($active == '7' || $active == '8') ? 'active' : 'inactive'; ?>" id="confirm">
                                            
                                                <strong>Documents</strong>
                                            </li>
                                        <?php } ?>
                                        
                                    </ul>
                                </div>

                             <?php 
                               if ($this->session->flashdata('success_msg') != ''): 
                                    echo 
                                    '<div class="text-center text-white  col-md-12 py-1" style="font-size: 15px;color: #2C3E50;margin-bottom: 10px;font-weight: bold;text-align: center;">'.$this->session->flashdata('success_msg').'</div>'; 
                                endif;
                                if ($this->session->flashdata('error_msg') != ''): 
                                    echo 
                                    '<div class="text-center text-white col-md-12 py-1" style="font-size: 15px;color: #2C3E50;margin-bottom: 10px;font-weight: bold;text-align: center;">'.$this->session->flashdata('error_msg').'</div>'; 
                                endif;
                             ?>