<?php
require_once FCPATH.'vendor/autoload.php';
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */


	public function __construct()
    {
            parent::__construct();


            $this->load->helper('url');
            // $this->load->helper('session');
            $this->load->model('Main_model');
	        $this->load->helper('url_helper');
	        $this->load->helper('form');
	        $this->load->library('form_validation');
	        $this->load->library('session');
	        $timezone=date_default_timezone_set("Asia/Calcutta");
	        
    }
    public function closed(){

        $active['active']='1';
		$this->load->view('header',$active);
		$this->load->view('closed');
		$this->load->view('footer');

    }
	public function index()
	{
		$active['active']='1';
		$this->load->view('header',$active);
		$this->load->view('step_one');
		$this->load->view('footer');
	}
	public function logout(){


	   $this->session->sess_destroy();

       redirect('', 'refresh');



	}
	
	public function register(){
        
     
    	$this->form_validation->set_rules('guest_name', 'User Name', 'required',array('required'=>'Please enter your full name'));
		$this->form_validation->set_rules('guest_email', 'User Mail', 'required|valid_email',array('required'=>'Please enter a valid E-mail ID'));
		$this->form_validation->set_rules('guest_phone', 'Mobile Number', 'required|numeric|exact_length[10]',array('required'=>'Please enter a 10-digit phone number with relevant extensions'));
		$this->form_validation->run();

       // `id`, `reg_id`, `name`, `email`, `phone`, 
		if ($this->form_validation->run()==false) {

			$this->session->set_flashdata('error_msg','Please enter valid details');
			$this->session->set_flashdata('errors', validation_errors());
            $active['active']='1';
			$this->load->view('header',$active);
			$this->load->view('step_one');
			$this->load->view('footer');
		}
		else{

		    

		    	$guest_name=$_POST['guest_name'];
		    	$guest_email=$_POST['guest_email'];
		    	$guest_phone=$_POST['guest_phone'];
		    	$step1='1';
		    	
		    	


		    	$date=array();
		    	$data=array(

		    		"name"=>"$guest_name",
		    		"email"=>"$guest_email",
		    		"phone"=>"$guest_phone",
		    		"step1"=>"$step1"
		    		
		    		
		    	);

		    	

		    	$appl_find=$this->Main_model->log_appl_find($data);


		    	if($appl_find!=false){


		    		$up_id=$appl_find->id;
		    		$up_reg_id=$appl_find->reg_id;
		    		$up_name=$guest_name;
		    		$up_email=$appl_find->email;
		    		$up_phone=$appl_find->phone;

		    		if($up_email==$guest_email && $up_phone==$guest_phone){

			    		$name_data=array();
			    		$name_data=array(

						/* important 5*/ "name"=>$up_name,
						                  "phone"=>$guest_phone
							
						);

	                     $up_name=$this->Main_model->update_name($name_data,$up_id,$up_reg_id,$up_email,$up_phone);

			    		 $this->session->set_userdata('id',$appl_find->id);
			    		 $this->session->set_userdata('reg_id',$appl_find->reg_id);
				         $this->session->set_userdata('name',$appl_find->name);
				         $this->session->set_userdata('email',$appl_find->email);
				         $this->session->set_userdata('phone',$appl_find->phone);

				         if(!file_exists('document_uploads/'.$this->session->userdata('reg_id').'/')){

				        	$d=mkdir('document_uploads/'.$this->session->userdata('reg_id').'/', 0777, true);
				        
				          }
	 

	                    $this->session->set_flashdata('success_msg','You have completed Step 1 successfully');
			    	    redirect('Registration/step2', 'refresh');
			    	}else{

                        $this->session->set_flashdata('log_faild_msg','E-mail ID already registered with us, please enter registered E-mail & Mobile Number!');
			    	    redirect('Registration/index', 'refresh');  

			    	}





		    	}
		    	else{

		    		$success_id['regid']=$this->Main_model->register_user($data);
		    		
			    	$seven_no=str_pad($success_id['regid'],7,"0",STR_PAD_LEFT);
			    	$unique_id='APARAJITA-'.$seven_no.'';
			    	$success=$this->Main_model->update_regid($success_id,$unique_id);

			    	
			    	if($success==true){

			    		 $reg_id='user'.$success_id['regid'];

			    		 $this->session->set_userdata('id',$success_id['regid']);
			    		 $this->session->set_userdata('reg_id',$reg_id);
				         $this->session->set_userdata('name',$guest_name);
				         $this->session->set_userdata('email',$guest_email);
				         $this->session->set_userdata('phone',$guest_phone);

				            if(!file_exists('document_uploads/'.$this->session->userdata('reg_id').'/')){

					        	$d=mkdir('document_uploads/'.$this->session->userdata('reg_id').'/', 0777, true);
					        
					        }


					       $first_mail=$this->first_step_mail($guest_name,$guest_email,$guest_phone);
				 		   if($first_mail==true){

				 		   	   $this->session->set_flashdata('success_msg','You have completed Step 1 successfully, a confirmation E-mail has been sent to your E-mail ID');
			    	           redirect('Registration/step2', 'refresh');
				 		   }
				 		   else{
				 		   	    $this->session->set_flashdata('success_msg','You have completed Step 1 successfully, a confirmation E-mail has been sent to you soon');
			    	            redirect('Registration/step2', 'refresh');
				 		   }

					    
			    	}
			    	else{
	                    $this->session->set_flashdata('error_msg','Email and mobile number not valid');
			    	    redirect('Registration/index', 'refresh');

			    	}

		    	}
		    	
	 
		}
		
    }

    public function first_step_mail($name,$email,$phone){

           ob_start();

    	// Load PHPMailer library
	        $this->load->library('phpmailer_lib');

	        // PHPMailer object
	        $mail = $this->phpmailer_lib->load();

	        // SMTP configuration
	        $mail->isSMTP();
	        // $mail->SMTPDebug =3;                                       // Set mailer to use SMTP
	        $mail->Host = 'smtp.gmail.com';   // Specify main and backup SMTP servers
	        $mail->Debugoutput = 'html';
	        $mail->SMTPAuth = true;
	        $mail->CharSet = "UTF-8";
	      
	        $mail->Username = '#########################';               
            $mail->Password = '######################';  
	        $mail->SMTPSecure = 'tls';
	        $mail->Port     = 587;
	        $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
	        $mail->isHTML(true);                                     // Set email format to HTML
	        
	        $mail->setFrom('############', 'TEAM APARAJITA');
	        $mail->addReplyTo('############', 'TEAM APARAJITA');
	        // Add a recipient
	        $mail->addAddress($email);
	        // Email subject
	        $mail->Subject = '############ FIRST STEP REGISTRATION CONFIRMATION MAIL';

	        

	        $Body=file_get_contents('first_step_mail.html');
	                           
	        $Body=str_ireplace("REGNAME", $name, $Body);
	        $Body=str_ireplace("USER_MAIL", $email, $Body);
	        $Body=str_ireplace("USER_PHONE", $phone, $Body);  
	        $mail->Body=$Body;

	        // Send email
	        if(!$mail->send()){
	            return false;
	        }else{
	            return true;
	        }
    }
	public function step2()
	{
		$active['active']='2';
		$this->load->view('header',$active);
		$this->load->view('step_two');
		$this->load->view('footer');
	}
	public function step2_submit(){
		/* important 1*/  $this->form_validation->set_rules('appl_id', 'appl_id', 'required',array('required'=>'Something went wrong! login again'));
        /* important 3*/  $this->form_validation->set_rules('reg_id', 'reg_id', 'required',array('required'=>'Something went wrong! login again'));
		/* important 4*/  $this->form_validation->set_rules('name', 'name', 'required',array('required'=>'Something went wrong! login again'));
		/* important 4*/  $this->form_validation->set_rules('email', 'email', 'required',array('required'=>'Something went wrong! login again'));
		/* important 4*/  $this->form_validation->set_rules('phone', 'phone', 'required',array('required'=>'Something went wrong! login again'));

		/* important 5*/  $this->form_validation->set_rules('category', 'Category', 'required',array('required'=>'Please select the category'));
		/* important 6*/  $this->form_validation->set_rules('you_shine', 'You shine', 'required',array('required'=>'Please select the years of experience'));

       // `id`, `reg_id`, `name`, `email`, `phone`, `category`, `you_shine`, `shine_five`, `shine_fifteen`,
		$this->form_validation->run();


		if ($this->form_validation->run()==false) {
			$this->session->set_flashdata('error_msg','Please enter valid details');

			$this->session->set_flashdata('errors', validation_errors());
                $active['active']='2';
	            $this->load->view('header',$active);
				$this->load->view('step_two');
				$this->load->view('footer');
			
			// redirect($_SERVER["HTTP_REFERER"]);

		}
		else{
			if(isset($_POST['step2_submit'])){

				/* important 1*/$appl_id=$_POST['appl_id'];
				/* important 4*/$reg_id=$_POST['reg_id'];
				/* important 4*/$name=$_POST['name'];
				/* important 4*/$email=$_POST['email'];
				/* important 4*/$phone=$_POST['phone'];

				/* important 5*/$category=$_POST['category'];
				/* important 6*/$you_shine=$_POST['you_shine'];
				                $step2='1';
				
				$data=array();
				$data=array(

				/* important 5*/ "category"=>$category,
				/* important 6*/ "you_shine"=>$you_shine,
				                  "step2"=>$step2
				
					
				);
				$success=$this->Main_model->step2_submit($data,$appl_id,$reg_id,$email,$phone);

		    	if($success==true){ 

	                   $this->session->set_flashdata('success_msg','You have completed Step 2 successfully');
			 	       redirect('Registration/step3', 'refresh');
				}else{
					$this->session->set_flashdata('error_msg','Email and mobile number not valid');
		    	    redirect('Registration/step2', 'refresh');
				}
			}
			else{
				/* important 1*/$appl_id=$_POST['appl_id'];
				/* important 4*/$reg_id=$_POST['reg_id'];
				/* important 4*/$name=$_POST['name'];
				/* important 4*/$email=$_POST['email'];
				/* important 4*/$phone=$_POST['phone'];

				/* important 5*/$category=$_POST['category'];
				/* important 6*/$you_shine=$_POST['you_shine'];
				               $step2='1';
				
				$data=array();
				$data=array(

				/* important 5*/ "category"=>$category,
				/* important 6*/ "you_shine"=>$you_shine,
				                 "step2"=>$step2
				
					
				);
				$success=$this->Main_model->step2_submit($data,$appl_id,$reg_id,$email,$phone);

		    	if($success==true){  
		    		    
	                   $this->session->set_flashdata('success_msg','Applications step 2 save successfully');	                  
			 	       redirect('Registration/index', 'refresh');

				}else{
					$this->session->set_flashdata('error_msg','Email and mobile number not valid');
		    	    redirect('Registration/step2', 'refresh');
				}
			}
		}
	}
	public function step3()
	{
		$active['active']='3';
		$this->load->view('header',$active);
		$this->load->view('step_three');
		$this->load->view('footer');
	}
	public function add_another_institute(){

		if(isset($_POST['another_institute'])  && isset($_POST['appl_id']) && isset($_POST['reg_id'])){

          $another_institute=$_POST['another_institute'];
          $appl_id=$_POST['appl_id'];
          $reg_id=$_POST['reg_id'];
          $email=$_POST['email'];
          $phone=$_POST['phone'];  

          $college_name="";
          $college_city="";
          $college_programme=""; 
          $college_certificate_name="";  


            $date=array();
	    	$data=array(

	    		"another_institute"=>$another_institute,
	    		"college_name"=>$college_name, 
                "college_city"=>$college_city, 
                "college_programme"=>$college_programme, 
                "college_certificate"=>$college_certificate_name
	    		
	    		
	    	);

		   $appl_find=$this->Main_model->add_another_institute($data,$appl_id,$reg_id,$email,$phone);

		   if($appl_find==true){

		   	  return true;

		   }else{

               return false;

		   }
		}else{

           return false;


		}


	}
	public function add_third_institute(){

		if(isset($_POST['another_institute'])  && isset($_POST['appl_id']) && isset($_POST['reg_id'])){

          $another_institute=$_POST['another_institute'];
          $appl_id=$_POST['appl_id'];
          $reg_id=$_POST['reg_id'];
          $email=$_POST['email'];
          $phone=$_POST['phone'];

          $third_institute_name="";
          $third_institute_city="";
          $third_institute_programe=""; 
          $third_institute_certificate_name="";

            $date=array();
	    	$data=array(

	    		                 "third_institute"=>$another_institute,
    		   /* important 10*/ 'third_institute_name'=>$third_institute_name, 
				/* important 11*/ 'third_institute_city'=>$third_institute_city, 
				/* important 12*/ 'third_institute_programe'=>$third_institute_programe, 
				/* important 13*/ 'third_institute_certificate'=>$third_institute_certificate_name, 
	    		
	    		
	    	);

		   $appl_find=$this->Main_model->add_third_institute($data,$appl_id,$reg_id,$email,$phone);

		   if($appl_find==true){

		   	  return true;

		   }else{

               return false;

		   }
		}else{

           return false;


		}


	}
	public function step3_submit(){
		/* important 1*/  $this->form_validation->set_rules('appl_id', 'appl_id', 'required',array('required'=>'Something went wrong! login again'));
        /* important 2*/  $this->form_validation->set_rules('reg_id', 'reg_id', 'required',array('required'=>'Something went wrong! login again'));
		/* important 3*/  $this->form_validation->set_rules('name', 'name', 'required',array('required'=>'Something went wrong! login again'));
		/* important 4*/  $this->form_validation->set_rules('email', 'email', 'required',array('required'=>'Something went wrong! login again'));
		/* important 5*/  $this->form_validation->set_rules('phone', 'phone', 'required',array('required'=>'Something went wrong! login again'));

		/* important 6*/  $this->form_validation->set_rules('applicant_name', 'Applicant name', 'required',array('required'=>'Please enter the applicant name'));
		/* important 7*/  $this->form_validation->set_rules('dob', 'Date of birth', 'required',array('required'=>'Please enter the applicant’s date of birth'));
		/* important 8*/  $this->form_validation->set_rules('mobile', 'Mobile number', 'required|numeric|exact_length[10]',array('required'=>'Please enter the applicant mobile number'));
		/* important 9*/  $this->form_validation->set_rules('email_id', 'Email id', 'required|valid_email',array('required'=>'Please enter the applicant email id'));

		/* important 9*/  $this->form_validation->set_rules('alternate_contact_name', 'Alternate contacts name', 'required',array('required'=>'Please enter the alternate contacts name'));
		/* important 9*/  $this->form_validation->set_rules('alternate_contact', 'Alternate contacts number', 'required|numeric|exact_length[10]',array('required'=>'Please enter alternate contacts phone number'));
		/* important 9*/  $this->form_validation->set_rules('alternate_contact_relationship', 'Their relationship to you', 'required',array('required'=>'Please enter their relationship to you'));

		
		// /* important 10*/  $this->form_validation->set_rules('linkedin_profile', 'Linkedin Profile', 'required',array('required'=>'Please Enter The Linkedin Profile'));
		 /* important 11*/  $this->form_validation->set_rules('your_role', 'Your Role', 'required',array('required'=>'Please Enter Your Role'));
		
		
		

		

       // `id`, `reg_id`, `name`, `email`, `phone`, `category`, `you_shine`, `shine_five`, `shine_fifteen`,
		$this->form_validation->run();


		if ($this->form_validation->run()==false) {
			$this->session->set_flashdata('error_msg','Please enter valid details');

			$this->session->set_flashdata('errors', validation_errors());
                $active['active']='3';
	            $this->load->view('header',$active);
				$this->load->view('step_three');
				$this->load->view('footer');
			
			// redirect($_SERVER["HTTP_REFERER"]);

		}
		else{
			if(isset($_POST['step3_submit'])){

				/* important 1*/  $appl_id=$_POST['appl_id'];
				/* important 2*/  $reg_id=$_POST['reg_id'];
				/* important 3*/  $name=$_POST['name'];
				/* important 4*/  $email=$_POST['email'];
				/* important 5*/  $phone=$_POST['phone'];

				/* important 6*/  $applicant_name=$_POST['applicant_name'];
				/* important 7*/  $old_dob=$_POST['dob'];
								  $dob = date('Y-m-d', strtotime( $old_dob ) );
				/* important 8*/  $mobile=$_POST['mobile'];
				/* important 9*/  $email_id=$_POST['email_id'];
				/* important 10*/ $linkedin_profile=$_POST['linkedin_profile'];

				/* important 10*/ $alternate_contact_name=$_POST['alternate_contact_name'];
				/* important 10*/ $alternate_contact=$_POST['alternate_contact'];
				/* important 10*/ $alternate_contact_relationship=$_POST['alternate_contact_relationship'];
				/* important 10*/

				                
				                 $specify_reltion=$_POST['specify_reltion'];

				/* important 11*/ $your_role=$_POST['your_role'];
				
				/* important 13*/ $past_organization_name1=$_POST['past_organization_name1'];
				/* important 14*/ $past_experience1=$_POST['past_experience1'];

				/* important 13*/ $past_organization_name2=$_POST['past_organization_name2'];
				/* important 14*/ $past_experience2=$_POST['past_experience2'];

				/* important 13*/ $past_organization_name3=$_POST['past_organization_name3'];
				/* important 14*/ $past_experience3=$_POST['past_experience3'];
				                  $step3='1';	
				
				
                if(!isset($_FILES['bio_video']) && $_FILES['bio_video']['name']=="" && $_FILES['bio_video']['tmp_name']==""){

                    $file_bio_name=$_POST['bio_video_name'];   
                    $m1=true; 

                }else{
                        
                   $file_bio=$_FILES['bio_video'];
				   $file_bio_name=$file_bio['name'];
			       $file_bio_path=$file_bio['tmp_name'];

			       $path1='document_uploads/'.$reg_id.'/bio_video/'.$file_bio_name.'';
				    if(!file_exists('document_uploads/'.$reg_id.'/bio_video/')){

				        $d=mkdir('document_uploads/'.$reg_id.'/bio_video/', 0777, true);
				    }

				    if($file_bio_name!="" and $file_bio_path!=""){
			            $m1=copy($file_bio_path, $path1); 
			        }else{
			             $file_bio_name=$_POST['bio_video_name'];   
                         $m1=true; 
			        }
				          

                }

				// `applicant_name`, `dob`, `mobile`, `email_id`, `social_media`, `linkedin_profile`, `your_role`, `bio_video`, `past_organization_name`, `past_experience`,
				
				$data=array();
				$data=array(


					 /* important 6*/ 'applicant_name'=>$applicant_name, 
					 /* important 7*/ 'dob'=>$dob, 
					 /* important 8*/ 'mobile'=>$mobile, 
					 /* important 9*/ 'email_id'=>$email_id, 
					/* important 10*/ 'linkedin_profile'=>$linkedin_profile,
					/* important 10*/ 'alternate_contact_name'=>$alternate_contact_name,
					/* important 10*/ 'alternate_contact'=>$alternate_contact,
					/* important 10*/ 'alternate_contact_relationship'=>$alternate_contact_relationship, 
					/* important 10*/ 'specify_reltion'=>$specify_reltion,
					/* important 11*/ 'your_role'=>$your_role, 
					/* important 12*/ 'bio_video'=>$file_bio_name, 
					/* important 13*/ 'past_organization_name1'=>$past_organization_name1, 
					/* important 14*/ 'past_experience1'=>$past_experience1,
					/* important 13*/ 'past_organization_name2'=>$past_organization_name2, 
					/* important 14*/ 'past_experience2'=>$past_experience2,
					/* important 13*/ 'past_organization_name3'=>$past_organization_name3, 
					/* important 14*/ 'past_experience3'=>$past_experience3,
					                   'step3'=>$step3	
	
				); 
				 // `alternate_contact_name`, `alternate_contact`, `alternate_contact_relationship`
				if($m1==true){
					$success=$this->Main_model->step3_submit($data,$appl_id,$reg_id,$email,$phone);

			    	if($success==true){  
				 		    
		                   $this->session->set_flashdata('success_msg','You have completed Step 3 successfully');
				 	       redirect('Registration/step4', 'refresh');
					}else{
						$this->session->set_flashdata('error_msg','Email and mobile number not valid');
			    	    redirect('Registration/step3', 'refresh');
					}
				}else{ 

					        
	                   $this->session->set_flashdata('error_msg','There was a problem to uploading the bio video, Please reupload it!');
			 	       redirect('Registration/step3', 'refresh');
				}
			}
			else{
				/* important 1*/ $appl_id=$_POST['appl_id'];
				/* important 2*/ $reg_id=$_POST['reg_id'];
				/* important 3*/ $name=$_POST['name'];
				/* important 4*/ $email=$_POST['email'];
				/* important 5*/ $phone=$_POST['phone'];

				/* important 6*/ $applicant_name=$_POST['applicant_name'];
				/* important 7*/ $old_dob=$_POST['dob'];
								 $dob = date('Y-m-d', strtotime( $old_dob ) );
				/* important 8*/ $mobile=$_POST['mobile'];
				/* important 9*/ $email_id=$_POST['email_id'];
				/* important 10*/$linkedin_profile=$_POST['linkedin_profile'];

				/* important 10*/ $alternate_contact_name=$_POST['alternate_contact_name'];
				/* important 10*/ $alternate_contact=$_POST['alternate_contact'];
				/* important 10*/ $alternate_contact_relationship=$_POST['alternate_contact_relationship'];


				                 
				/* important 10*/ $specify_reltion=$_POST['specify_reltion'];

				/* important 11*/$your_role=$_POST['your_role'];
				
				/* important 13*/ $past_organization_name1=$_POST['past_organization_name1'];
				/* important 14*/ $past_experience1=$_POST['past_experience1'];

				/* important 13*/ $past_organization_name2=$_POST['past_organization_name2'];
				/* important 14*/ $past_experience2=$_POST['past_experience2'];

				/* important 13*/ $past_organization_name3=$_POST['past_organization_name3'];
				/* important 14*/ $past_experience3=$_POST['past_experience3'];
				                    $step3='1';

				if(!isset($_FILES['bio_video']) && $_FILES['bio_video']['name']=="" && $_FILES['bio_video']['tmp_name']==""){

                    $file_bio_name=$_POST['bio_video_name'];   
                    $m1=true; 

                }else{
                        
                   $file_bio=$_FILES['bio_video'];
				   $file_bio_name=$file_bio['name'];
			       $file_bio_path=$file_bio['tmp_name'];

			       $path1='document_uploads/'.$reg_id.'/bio_video/'.$file_bio_name.'';
				    if(!file_exists('document_uploads/'.$reg_id.'/bio_video/')){

				        $d=mkdir('document_uploads/'.$reg_id.'/bio_video/', 0777, true);
				    }

				    if($file_bio_name!="" and $file_bio_path!=""){
			            $m1=copy($file_bio_path, $path1); 
			        }else{
			             $file_bio_name=$_POST['bio_video_name'];   
                         $m1=true; 
			        }
				          

                }

				
				$data=array();
				$data=array(

				     /* important 6*/ 'applicant_name'=>$applicant_name, 
					 /* important 7*/ 'dob'=>$dob, 
					 /* important 8*/ 'mobile'=>$mobile, 
					 /* important 9*/ 'email_id'=>$email_id, 
					/* important 10*/ 'linkedin_profile'=>$linkedin_profile, 
					/* important 10*/ 'alternate_contact_name'=>$alternate_contact_name,
					/* important 10*/ 'alternate_contact'=>$alternate_contact,
					/* important 10*/ 'alternate_contact_relationship'=>$alternate_contact_relationship, 
					/* important 10*/ 'specify_reltion'=>$specify_reltion,
					/* important 11*/ 'your_role'=>$your_role, 
					/* important 12*/ 'bio_video'=>$file_bio_name, 
					/* important 13*/ 'past_organization_name1'=>$past_organization_name1, 
					/* important 14*/ 'past_experience1'=>$past_experience1,
					/* important 13*/ 'past_organization_name2'=>$past_organization_name2, 
					/* important 14*/ 'past_experience2'=>$past_experience2,
					/* important 13*/ 'past_organization_name3'=>$past_organization_name3, 
					/* important 14*/ 'past_experience3'=>$past_experience3,
					                  'step3'=>$step3	
				
					
				);
				if($m1==true){

					$success=$this->Main_model->step3_submit($data,$appl_id,$reg_id,$email,$phone);
					

			    	if($success==true){ 
				 		    
		                   $this->session->set_flashdata('success_msg','Applications step 3 save successfully');
				 	       redirect('Registration/step2', 'refresh');
					}else{
						$this->session->set_flashdata('error_msg','Email and mobile number not valid');
			    	    redirect('Registration/step3', 'refresh');
					}
				}else{ 

			        
                   $this->session->set_flashdata('error_msg','There was a problem to uploading the bio video, Please reupload it!');
		 	       redirect('Registration/step3', 'refresh');



				}
			}
		}
	}
	public function step4()
	{
		$active['active']='4';
	    $this->load->view('header',$active);
		$this->load->view('step_four');
		$this->load->view('footer');
	}
	
	
	public function step4_submit(){

		/* important 1*/  $this->form_validation->set_rules('appl_id', 'appl_id', 'required',array('required'=>'Something went wrong! login again'));
        /* important 2*/  $this->form_validation->set_rules('reg_id', 'reg_id', 'required',array('required'=>'Something went wrong! login again'));
		/* important 3*/  $this->form_validation->set_rules('name', 'name', 'required',array('required'=>'Something went wrong! login again'));
		/* important 4*/  $this->form_validation->set_rules('email', 'email', 'required',array('required'=>'Something went wrong! login again'));
		/* important 5*/  $this->form_validation->set_rules('phone', 'phone', 'required',array('required'=>'Something went wrong! login again'));

		/* important 6*/  $this->form_validation->set_rules('school_name', 'Name of institution', 'required',array('required'=>'Please enter the name of institution'));
		/* important 7*/  $this->form_validation->set_rules('school_city', 'City of institution', 'required',array('required'=>'Please enter the city of the institution'));
		/* important 7*/  $this->form_validation->set_rules('school_programme', 'Name of programme you completed', 'required',array('required'=>'Please enter the name of programme you completed'));

		
		

	// `school_programme`,`college_programme`

		$this->form_validation->run();


		if ($this->form_validation->run()==false) {
			$this->session->set_flashdata('error_msg','Please enter valid details');

			$this->session->set_flashdata('errors', validation_errors());


                $active['active']='4';
	            $this->load->view('header',$active);
				$this->load->view('step_four');
				$this->load->view('footer');
			
			// redirect($_SERVER["HTTP_REFERER"]);

		}
		else{

			if(isset($_POST['step4_add1_submit'])){

                /* important 1*/  $appl_id=$_POST['appl_id'];
				/* important 2*/  $reg_id=$_POST['reg_id'];
				/* important 3*/  $name=$_POST['name'];
				/* important 4*/  $email=$_POST['email'];
				/* important 5*/  $phone=$_POST['phone'];

				/* important 6*/  $school_name=$_POST['school_name'];
				/* important 7*/  $school_city=$_POST['school_city'];
				/* important 8*/  $school_programme=$_POST['school_programme'];
				                  $step4='1';

				 // school certificate
				if(!isset($_FILES['school_certificate']) && $_FILES['school_certificate']['name']=="" && $_FILES['school_certificate']['tmp_name']==""){

                    $school_certificate_name=$_POST['school_certificate_name'];   
                    $m16a4=true; 

                }else{
                        
                   $school_certificate=$_FILES['school_certificate'];
				   $school_certificate_name=$school_certificate['name'];
			       $school_certificate_path=$school_certificate['tmp_name'];

			       $path1='document_uploads/'.$reg_id.'/school_certificate/'.$school_certificate_name.'';
				    if(!file_exists('document_uploads/'.$reg_id.'/school_certificate/')){

				        $d=mkdir('document_uploads/'.$reg_id.'/school_certificate/', 0777, true);
				    }

				    if($school_certificate_name!="" and $school_certificate_path!=""){
			            $m16a4=copy($school_certificate_path, $path1); 
			        }else{
			             $school_certificate_name=$_POST['school_certificate_name'];   
                         $m16a4=true; 
			        }
				          

                }

                $data=array();
				$data=array(

                  
					 /* important 6*/ 'school_name'=>$school_name, 
					 /* important 7*/ 'school_city'=>$school_city, 
					 /* important 8*/ 'school_programme'=>$school_programme, 
					 /* important 9*/ 'school_certificate'=>$school_certificate_name,
					                  'another_institute'=>'1'
					
					
				);

				
				
				if($m16a4==true){
					$success=$this->Main_model->step4_submit($data,$appl_id,$reg_id,$email,$phone);

			    	if($success==true){  
				 		    
		                   
				 	       redirect('Registration/step4', 'refresh');
					}else{
						$this->session->set_flashdata('error_msg','Email and mobile number not valid');
			    	    redirect('Registration/step4', 'refresh');
					}
				}else{ 

					        
	                   $this->session->set_flashdata('error_msg','There was a problem to uploading the certificate, Please reupload it!');
			 	       redirect('Registration/step4', 'refresh');
				}

			 
			}
			// step3_add2_submit
			else if(isset($_POST['step4_add2_submit'])){


                /* important 1*/  $appl_id=$_POST['appl_id'];
				/* important 2*/  $reg_id=$_POST['reg_id'];
				/* important 3*/  $name=$_POST['name'];
				/* important 4*/  $email=$_POST['email'];
				/* important 5*/  $phone=$_POST['phone'];

				/* important 6*/  $school_name=$_POST['school_name'];
				/* important 7*/  $school_city=$_POST['school_city'];
				/* important 8*/  $school_programme=$_POST['school_programme'];
				                  $step4='1';


				if(isset($_POST['another_institute']) && $_POST['another_institute']==1){
					/* important 9*/  $college_name=$_POST['college_name'];
					/* important 10*/ $college_city=$_POST['college_city'];
					/* important 11*/ $college_programme=$_POST['college_programme'];
				}else{
				    /* important 9*/  $college_name="";
					/* important 10*/ $college_city="";
					/* important 11*/ $college_programme="";	
				}


				// school certificate
				if(!isset($_FILES['school_certificate']) && $_FILES['school_certificate']['name']=="" && $_FILES['school_certificate']['tmp_name']==""){

                    $school_certificate_name=$_POST['school_certificate_name'];   
                    $m16a4=true; 

                }else{
                        
                   $school_certificate=$_FILES['school_certificate'];
				   $school_certificate_name=$school_certificate['name'];
			       $school_certificate_path=$school_certificate['tmp_name'];

			       $path1='document_uploads/'.$reg_id.'/school_certificate/'.$school_certificate_name.'';
				    if(!file_exists('document_uploads/'.$reg_id.'/school_certificate/')){

				        $d=mkdir('document_uploads/'.$reg_id.'/school_certificate/', 0777, true);
				    }

				    if($school_certificate_name!="" and $school_certificate_path!=""){
			            $m16a4=copy($school_certificate_path, $path1); 
			        }else{
			             $school_certificate_name=$_POST['school_certificate_name'];   
                         $m16a4=true; 
			        }
				          

                }

                if(isset($_POST['another_institute']) && $_POST['another_institute']==1){

	                // college certificate
	                if(!isset($_FILES['college_certificate']) && $_FILES['college_certificate']['name']=="" && $_FILES['college_certificate']['tmp_name']==""){

	                    $college_certificate_name=$_POST['college_certificate_name'];   
	                    $ak47=true; 

	                }else{
	                        
	                   $college_certificate=$_FILES['college_certificate'];
					   $college_certificate_name=$college_certificate['name'];
				       $college_certificate_path=$college_certificate['tmp_name'];

				       $path1='document_uploads/'.$reg_id.'/college_certificate/'.$college_certificate_name.'';
					    if(!file_exists('document_uploads/'.$reg_id.'/college_certificate/')){

					        $d=mkdir('document_uploads/'.$reg_id.'/college_certificate/', 0777, true);
					    }

					    if($college_certificate_name!="" and $college_certificate_path!=""){
				            $ak47=copy($college_certificate_path, $path1); 
				        }else{
				             $college_certificate_name=$_POST['college_certificate_name'];   
	                         $ak47=true; 
				        }
					          

	                }
	            }else{

                   $college_certificate_name="";   
	               $ak47=true; 

	            }

                $data=array();
				$data=array(

                  
					 /* important 6*/ 'school_name'=>$school_name, 
					 /* important 7*/ 'school_city'=>$school_city, 
					 /* important 8*/ 'school_programme'=>$school_programme, 
					 /* important 9*/ 'school_certificate'=>$school_certificate_name, 
					/* important 10*/ 'college_name'=>$college_name, 
					/* important 11*/ 'college_city'=>$college_city, 
					/* important 12*/ 'college_programme'=>$college_programme, 
					/* important 13*/ 'college_certificate'=>$college_certificate_name,
					                   'third_institute'=>'1'
					
				);

				
				
				if($m16a4==true && $ak47==true){
					$success=$this->Main_model->step4_submit($data,$appl_id,$reg_id,$email,$phone);

			    	if($success==true){  
				 		    
		                   
				 	       redirect('Registration/step4', 'refresh');
					}else{
						$this->session->set_flashdata('error_msg','Email and mobile number not valid');
			    	    redirect('Registration/step4', 'refresh');
					}
				}else{ 

					        
	                   $this->session->set_flashdata('error_msg','There was a problem to uploading the certificate, Please reupload it!');
			 	       redirect('Registration/step4', 'refresh');
				}


			}else if(isset($_POST['step4_submit'])){

			    /* important 1*/  $appl_id=$_POST['appl_id'];
				/* important 2*/  $reg_id=$_POST['reg_id'];
				/* important 3*/  $name=$_POST['name'];
				/* important 4*/  $email=$_POST['email'];
				/* important 5*/  $phone=$_POST['phone'];

				/* important 6*/  $school_name=$_POST['school_name'];
				/* important 7*/  $school_city=$_POST['school_city'];
				/* important 8*/  $school_programme=$_POST['school_programme'];
				                  $step4='1';


				if(isset($_POST['another_institute']) && $_POST['another_institute']==1){
					/* important 9*/  $college_name=$_POST['college_name'];
					/* important 10*/ $college_city=$_POST['college_city'];
					/* important 11*/ $college_programme=$_POST['college_programme'];
				}else{
				    /* important 9*/  $college_name="";
					/* important 10*/ $college_city="";
					/* important 11*/ $college_programme="";	
				}


				if(isset($_POST['third_institute']) && $_POST['third_institute']==1){
					/* important 9*/  $third_institute_name=$_POST['third_institute_name'];
					/* important 10*/ $third_institute_city=$_POST['third_institute_city'];
					/* important 11*/ $third_institute_programe=$_POST['third_institute_programe'];
				}else{
				    /* important 9*/  $third_institute_name="";
					/* important 10*/ $third_institute_city="";
					/* important 11*/ $third_institute_programe="";	
				}
				                  
                // <!-- `third_institute`, `third_institute_name`, `third_institute_city`, `third_institute_programe`, `third_institute_certificate` -->
               
                // school certificate
				if(!isset($_FILES['school_certificate']) && $_FILES['school_certificate']['name']=="" && $_FILES['school_certificate']['tmp_name']==""){

                    $school_certificate_name=$_POST['school_certificate_name'];   
                    $m16a4=true; 

                }else{
                        
                   $school_certificate=$_FILES['school_certificate'];
				   $school_certificate_name=$school_certificate['name'];
			       $school_certificate_path=$school_certificate['tmp_name'];

			       $path1='document_uploads/'.$reg_id.'/school_certificate/'.$school_certificate_name.'';
				    if(!file_exists('document_uploads/'.$reg_id.'/school_certificate/')){

				        $d=mkdir('document_uploads/'.$reg_id.'/school_certificate/', 0777, true);
				    }

				    if($school_certificate_name!="" and $school_certificate_path!=""){
			            $m16a4=copy($school_certificate_path, $path1); 
			        }else{
			             $school_certificate_name=$_POST['school_certificate_name'];   
                         $m16a4=true; 
			        }
				          

                }

                if(isset($_POST['another_institute']) && $_POST['another_institute']==1){

	                // college certificate
	                if(!isset($_FILES['college_certificate']) && $_FILES['college_certificate']['name']=="" && $_FILES['college_certificate']['tmp_name']==""){

	                    $college_certificate_name=$_POST['college_certificate_name'];   
	                    $ak47=true; 

	                }else{
	                        
	                   $college_certificate=$_FILES['college_certificate'];
					   $college_certificate_name=$college_certificate['name'];
				       $college_certificate_path=$college_certificate['tmp_name'];

				       $path1='document_uploads/'.$reg_id.'/college_certificate/'.$college_certificate_name.'';
					    if(!file_exists('document_uploads/'.$reg_id.'/college_certificate/')){

					        $d=mkdir('document_uploads/'.$reg_id.'/college_certificate/', 0777, true);
					    }

					    if($college_certificate_name!="" and $college_certificate_path!=""){
				            $ak47=copy($college_certificate_path, $path1); 
				        }else{
				             $college_certificate_name=$_POST['college_certificate_name'];   
	                         $ak47=true; 
				        }
					          

	                }
	            }else{

                   $college_certificate_name="";   
	               $ak47=true; 

	            }


                // for third institute file
	            if(isset($_POST['third_institute']) && $_POST['third_institute']==1){

	                // college certificate
	                if(!isset($_FILES['third_institute_certificate']) && $_FILES['third_institute_certificate']['name']=="" && $_FILES['third_institute_certificate']['tmp_name']==""){

	                    $third_institute_certificate_name=$_POST['third_institute_certificate_name'];   
	                    $Kar98=true; 

	                }else{
	                        
	                   $third_institute_certificate=$_FILES['third_institute_certificate'];
					   $third_institute_certificate_name=$third_institute_certificate['name'];
				       $third_institute_certificate_path=$third_institute_certificate['tmp_name'];

				       $path1='document_uploads/'.$reg_id.'/third_institute_certificate/'.$third_institute_certificate_name.'';
					    if(!file_exists('document_uploads/'.$reg_id.'/third_institute_certificate/')){

					        $d=mkdir('document_uploads/'.$reg_id.'/third_institute_certificate/', 0777, true);
					    }

					    if($third_institute_certificate_name!="" and $third_institute_certificate_path!=""){
				            $Kar98=copy($third_institute_certificate_path, $path1); 
				        }else{
				             $third_institute_certificate_name=$_POST['third_institute_certificate_name'];   
	                         $Kar98=true; 
				        }
					          

	                }
	            }else{

                   $third_institute_certificate_name="";   
	               $Kar98=true; 

	            }
                // `school_name`, `school_city`, `school_year`, `school_certificate`, `college_name`, `college_city`, `college_year`, `college_certificate`// <!-- `third_institute`, `third_institute_name`, `third_institute_city`, `third_institute_programe`, `third_institute_certificate` -->

                $data=array();
				$data=array(

                  
					 /* important 6*/ 'school_name'=>$school_name, 
					 /* important 7*/ 'school_city'=>$school_city, 
					 /* important 8*/ 'school_programme'=>$school_programme, 
					 /* important 9*/ 'school_certificate'=>$school_certificate_name, 
					/* important 10*/ 'college_name'=>$college_name, 
					/* important 11*/ 'college_city'=>$college_city, 
					/* important 12*/ 'college_programme'=>$college_programme, 
					/* important 13*/ 'college_certificate'=>$college_certificate_name, 
					/* important 10*/ 'third_institute_name'=>$third_institute_name, 
					/* important 11*/ 'third_institute_city'=>$third_institute_city, 
					/* important 12*/ 'third_institute_programe'=>$third_institute_programe, 
					/* important 13*/ 'third_institute_certificate'=>$third_institute_certificate_name, 
					                   'step4'=>$step4 
					
				);

				
				
				if($m16a4==true && $ak47==true && $Kar98==true){
					$success=$this->Main_model->step3_submit($data,$appl_id,$reg_id,$email,$phone);

			    	if($success==true){  
				 		    
		                   $this->session->set_flashdata('success_msg','You have completed Step 4 successfully');
				 	       redirect('Registration/step5', 'refresh');
					}else{
						$this->session->set_flashdata('error_msg','Email and mobile number not valid');
			    	    redirect('Registration/step4', 'refresh');
					}
				}else{ 

					        
	                   $this->session->set_flashdata('error_msg','There was a problem to uploading the certificate, Please reupload it!');
			 	       redirect('Registration/step4', 'refresh');
				}

		   
			}else{


				/* important 1*/  $appl_id=$_POST['appl_id'];
				/* important 2*/  $reg_id=$_POST['reg_id'];
				/* important 3*/  $name=$_POST['name'];
				/* important 4*/  $email=$_POST['email'];
				/* important 5*/  $phone=$_POST['phone'];

				/* important 6*/  $school_name=$_POST['school_name'];
				/* important 7*/  $school_city=$_POST['school_city'];
				/* important 8*/  $school_programme=$_POST['school_programme'];
				                  $step4='1';


				if(isset($_POST['another_institute']) && $_POST['another_institute']==1){
					/* important 9*/  $college_name=$_POST['college_name'];
					/* important 10*/ $college_city=$_POST['college_city'];
					/* important 11*/ $college_programme=$_POST['college_programme'];
				}else{
				    /* important 9*/  $college_name="";
					/* important 10*/ $college_city="";
					/* important 11*/ $college_programme="";	
				}


				if(isset($_POST['third_institute']) && $_POST['third_institute']==1){
					/* important 9*/  $third_institute_name=$_POST['third_institute_name'];
					/* important 10*/ $third_institute_city=$_POST['third_institute_city'];
					/* important 11*/ $third_institute_programe=$_POST['third_institute_programe'];
				}else{
				    /* important 9*/  $third_institute_name="";
					/* important 10*/ $third_institute_city="";
					/* important 11*/ $third_institute_programe="";	
				}
				                  
                

                // school certificate
				if(!isset($_FILES['school_certificate']) && $_FILES['school_certificate']['name']=="" && $_FILES['school_certificate']['tmp_name']==""){

                    $school_certificate_name=$_POST['school_certificate_name'];   
                    $m16a4=true; 

                }else{
                        
                   $school_certificate=$_FILES['school_certificate'];
				   $school_certificate_name=$school_certificate['name'];
			       $school_certificate_path=$school_certificate['tmp_name'];

			       $path1='document_uploads/'.$reg_id.'/school_certificate/'.$school_certificate_name.'';
				    if(!file_exists('document_uploads/'.$reg_id.'/school_certificate/')){

				        $d=mkdir('document_uploads/'.$reg_id.'/school_certificate/', 0777, true);
				    }

				    if($school_certificate_name!="" and $school_certificate_path!=""){
			            $m16a4=copy($school_certificate_path, $path1); 
			        }else{
			             $school_certificate_name=$_POST['school_certificate_name'];   
                         $m16a4=true; 
			        }
				          

                }

                
                if(isset($_POST['another_institute']) && $_POST['another_institute']==1){
	                // college certificate
	                if(!isset($_FILES['college_certificate']) && $_FILES['college_certificate']['name']=="" && $_FILES['college_certificate']['tmp_name']==""){

	                    $college_certificate_name=$_POST['college_certificate_name'];   
	                    $ak47=true; 

	                }else{
	                        
	                   $college_certificate=$_FILES['college_certificate'];
					   $college_certificate_name=$college_certificate['name'];
				       $college_certificate_path=$college_certificate['tmp_name'];

				       $path1='document_uploads/'.$reg_id.'/college_certificate/'.$college_certificate_name.'';
					    if(!file_exists('document_uploads/'.$reg_id.'/college_certificate/')){

					        $d=mkdir('document_uploads/'.$reg_id.'/college_certificate/', 0777, true);
					    }

					    if($college_certificate_name!="" and $college_certificate_path!=""){
				            $ak47=copy($college_certificate_path, $path1); 
				        }else{
				             $college_certificate_name=$_POST['college_certificate_name'];   
	                         $ak47=true; 
				        }
					          

	                }
                }else{

                   $college_certificate_name="";   
	               $ak47=true; 

	            }


	            // for third institute file
	            if(isset($_POST['third_institute']) && $_POST['third_institute']==1){

	                // college certificate
	                if(!isset($_FILES['third_institute_certificate']) && $_FILES['third_institute_certificate']['name']=="" && $_FILES['third_institute_certificate']['tmp_name']==""){

	                    $third_institute_certificate_name=$_POST['third_institute_certificate_name'];   
	                    $Kar98=true; 

	                }else{
	                        
	                   $third_institute_certificate=$_FILES['third_institute_certificate'];
					   $third_institute_certificate_name=$third_institute_certificate['name'];
				       $third_institute_certificate_path=$third_institute_certificate['tmp_name'];

				       $path1='document_uploads/'.$reg_id.'/third_institute_certificate/'.$third_institute_certificate_name.'';
					    if(!file_exists('document_uploads/'.$reg_id.'/third_institute_certificate/')){

					        $d=mkdir('document_uploads/'.$reg_id.'/third_institute_certificate/', 0777, true);
					    }

					    if($third_institute_certificate_name!="" and $third_institute_certificate_path!=""){
				            $Kar98=copy($third_institute_certificate_path, $path1); 
				        }else{
				             $third_institute_certificate_name=$_POST['third_institute_certificate_name'];   
	                         $Kar98=true; 
				        }
					          

	                }
	            }else{

                   $third_institute_certificate_name="";   
	               $Kar98=true; 

	            }
                // `school_name`, `school_city`, `school_year`, `school_certificate`, `college_name`, `college_city`, `college_year`, `college_certificate`

                $data=array();
				$data=array(

                  
					 /* important 6*/ 'school_name'=>$school_name, 
					 /* important 7*/ 'school_city'=>$school_city, 
					 /* important 8*/ 'school_programme'=>$school_programme, 
					 /* important 9*/ 'school_certificate'=>$school_certificate_name, 
					/* important 10*/ 'college_name'=>$college_name, 
					/* important 11*/ 'college_city'=>$college_city, 
					/* important 12*/ 'college_programme'=>$college_programme, 
					/* important 13*/ 'college_certificate'=>$college_certificate_name,
					/* important 10*/ 'third_institute_name'=>$third_institute_name, 
					/* important 11*/ 'third_institute_city'=>$third_institute_city, 
					/* important 12*/ 'third_institute_programe'=>$third_institute_programe, 
					/* important 13*/ 'third_institute_certificate'=>$third_institute_certificate_name,  
					                   'step4'=>$step4 
					
				);

				
				if($m16a4==true && $ak47==true){
					$success=$this->Main_model->step4_submit($data,$appl_id,$reg_id,$email,$phone);

			    	if($success==true){  
				 		    
		                   $this->session->set_flashdata('success_msg','Applications step 4 save successfully');
				 	       redirect('Registration/step3', 'refresh');
					}else{
						$this->session->set_flashdata('error_msg','Email and mobile number not valid');
			    	    redirect('Registration/step4', 'refresh');
					}
				}else{ 

					        
                    $this->session->set_flashdata('error_msg','There was a problem to uploading the certificate, Please reupload it!');
		 	        redirect('Registration/step4', 'refresh');
				}



			}

	    } 
	
	}
	
	
	public function step5()
	{
		$active['active']='5';
	    $this->load->view('header',$active);
		$this->load->view('step_five');
		$this->load->view('footer');
	}
	public function step5_submit(){
		/* important 1*/  $this->form_validation->set_rules('appl_id', 'appl_id', 'required',array('required'=>'Something went wrong! login again'));
        /* important 2*/  $this->form_validation->set_rules('reg_id', 'reg_id', 'required',array('required'=>'Something went wrong! login again'));
		/* important 3*/  $this->form_validation->set_rules('name', 'name', 'required',array('required'=>'Something went wrong! login again'));
		/* important 4*/  $this->form_validation->set_rules('email', 'email', 'required',array('required'=>'Something went wrong! login again'));
		/* important 5*/  $this->form_validation->set_rules('phone', 'phone', 'required',array('required'=>'Something went wrong! login again'));

		/* important 6*/  $this->form_validation->set_rules('org_name', 'Organization Name', 'required',array('required'=>'Please enter the organization name'));
		/* important 7*/  $this->form_validation->set_rules('designation', 'Designation', 'required',array('required'=>'Please enter the designation name'));
	     /* important 8*/  $this->form_validation->set_rules('company_incorporation_is', 'Type of Organization', 'required',array('required'=>'Please select the type of organization'));
	      /* important 8*/  //$this->form_validation->set_rules('specified_org_type', 'Specified Organization Type', 'required',array('required'=>'Please specify the type of the organization'));
		/* important 9*/  $this->form_validation->set_rules('company_incorporation_date', 'Date of Formation', 'required',array('required'=>'Please enter the date of formation'));
		/* important 10*/  $this->form_validation->set_rules('year_experience', 'Work Experience', 'required',array('required'=>'Please enter the work experience'));

		/* important 11*/  $this->form_validation->set_rules('org_address', 'Organization Address', 'required',array('required'=>'Please enter the organization address'));
		/* important 12*/  $this->form_validation->set_rules('org_city', 'Organization City', 'required',array('required'=>'Please enter the organization city'));
		/* important 13*/  $this->form_validation->set_rules('org_state', 'Organization State', 'required',array('required'=>'Please enter the organization state'));
		/* important 14*/  $this->form_validation->set_rules('org_pin', 'Organization Pin', 'required',array('required'=>'Please enter the organization pin'));
		/* important 15*/  $this->form_validation->set_rules('org_email', 'Organization Enail', 'required',array('required'=>'Please enter the organization E-mail'));
		/* important 16*/  $this->form_validation->set_rules('org_contactno', 'Organization Contact Number', 'required',array('required'=>'Please enter the organization contact number'));
		// /* important 17*/  $this->form_validation->set_rules('org_website', 'Organization Website', 'required',array('required'=>'Please Enter The Organization Website'));

		// /* important 18*/  $this->form_validation->set_rules('dp_linkedin', 'Linkedin Link', 'required',array('required'=>'Please Enter The Organization Linkedin Link'));
		// /* important 19*/  $this->form_validation->set_rules('dp_facebook', 'Facebook Link', 'required',array('required'=>'Please Enter The Organization Facebook Link'));
		// /* important 20*/  $this->form_validation->set_rules('dp_twitter', 'Twitter Link', 'required',array('required'=>'Please Enter The Organization Twitter Link'));
		// /* important 21*/  $this->form_validation->set_rules('dp_instagram', 'Instagram Link', 'required',array('required'=>'Please Enter The Organization Instagram Link'));

		
       //org_address,org_city,org_state,org_pin,org_email,org_contactno
       // `id`, `reg_id`, `name`, `email`, `phone`, `category`, `you_shine`, `shine_five`, `shine_fifteen`,
		$this->form_validation->run();


		if ($this->form_validation->run()==false) {
			$this->session->set_flashdata('error_msg','Please enter valid details');

			$this->session->set_flashdata('errors', validation_errors());
                $active['active']='5';
	            $this->load->view('header',$active);
				$this->load->view('step_five');
				$this->load->view('footer');
			
			// redirect($_SERVER["HTTP_REFERER"]);

		}
		else{
			if(isset($_POST['step5_submit'])){

				/* important 1*/ $appl_id=$_POST['appl_id'];
				/* important 2*/ $reg_id=$_POST['reg_id'];
				/* important 3*/ $name=$_POST['name'];
				/* important 4*/ $email=$_POST['email'];
				/* important 5*/ $phone=$_POST['phone'];
				/* important 6*/ $org_name=$_POST['org_name'];
				/* important 7*/ $designation=$_POST['designation'];
				/* important 8*/ $company_incorporation_is=$_POST['company_incorporation_is'];

				                 
				/* important 8*/ $specified_org_type=$_POST['specified_org_type'];
				/* important 9*/ $dou=$_POST['company_incorporation_date'];
				                 $company_incorporation_date = date( 'Y-m-d', strtotime( $dou ) );
				/* important 10*/$year_experience=$_POST['year_experience'];
				/* important 11*/$org_address=$_POST['org_address'];
				/* important 12*/$org_city=$_POST['org_city'];
				/* important 13*/$org_state=$_POST['org_state'];
				/* important 14*/$org_pin=$_POST['org_pin'];
				/* important 15*/$org_email=$_POST['org_email'];
				/* important 16*/$org_contactno=$_POST['org_contactno'];
				/* important 17*/$org_website=$_POST['org_website'];
				/* important 18*/$dp_linkedin=$_POST['dp_linkedin'];
				/* important 19*/$dp_facebook=$_POST['dp_facebook'];
				/* important 20*/$dp_twitter=$_POST['dp_twitter'];
				/* important 21*/$dp_instagram=$_POST['dp_instagram'];
				                  $step5='1';
				
                

				// `org_name`, `current_profile`, `designation`, `is_incorporated`, `company_incorporation_date`, `year_experience`, `digital_presence`, `digital_presence_instagram`, `digital_presence_twitter`, `digital_presence_facebook`, `digital_presence_linkedin`, `org_address`, `org_city`, `org_state`, `org_pin`, `org_email`, `org_contactno`, `org_website`,
				
				$data=array();
				$data=array(

				 /* important 6*/  'org_name'=>$org_name,
				 /* important 7*/  'designation'=>$designation, 
				 /* important 8*/  'is_incorporated'=>$company_incorporation_is, 
				                   'specified_org_type'=>$specified_org_type,
				 /* important 9*/  'company_incorporation_date'=>$company_incorporation_date, 
				 /* important 10*/ 'year_experience'=>$year_experience,  
				 /* important 11*/ 'digital_presence_instagram'=>$dp_instagram, 
				 /* important 12*/ 'digital_presence_twitter'=>$dp_twitter, 
				 /* important 13*/ 'digital_presence_facebook'=>$dp_facebook, 
				 /* important 14*/ 'digital_presence_linkedin'=>$dp_linkedin, 
				 /* important 15*/ 'org_address'=>$org_address, 
				 /* important 16*/ 'org_city'=>$org_city, 
				 /* important 17*/ 'org_state'=>$org_state, 
				 /* important 18*/ 'org_pin'=>$org_pin, 
				 /* important 19*/ 'org_email'=>$org_email, 
				 /* important 20*/ 'org_contactno'=>$org_contactno, 
				 /* important 21*/ 'org_website'=>$org_website,
				                    'step5'=>$step5				
					
				); 

				
			   $success=$this->Main_model->step5_submit($data,$appl_id,$reg_id,$email,$phone);
				

		    	if($success==true){  
			 		   
	                   $this->session->set_flashdata('success_msg','You have completed Step 5 successfully');
			 	       redirect('Registration/step6', 'refresh');
				}else{
					$this->session->set_flashdata('error_msg','Email and mobile number not valid');
		    	    redirect('Registration/step5', 'refresh');
				}
			}
			else{
				/* important 1*/ $appl_id=$_POST['appl_id'];
				/* important 2*/ $reg_id=$_POST['reg_id'];
				/* important 3*/ $name=$_POST['name'];
				/* important 4*/ $email=$_POST['email'];
				/* important 5*/ $phone=$_POST['phone'];
				/* important 6*/ $org_name=$_POST['org_name'];
				/* important 7*/ $designation=$_POST['designation'];
				/* important 8*/ $company_incorporation_is=$_POST['company_incorporation_is'];
				                 
				                 $specified_org_type=$_POST['specified_org_type'];
				/* important 9*/ $dou=$_POST['company_incorporation_date'];
				                 $company_incorporation_date = date( 'Y-m-d', strtotime( $dou ) );
				/* important 10*/$year_experience=$_POST['year_experience'];
				/* important 11*/$org_address=$_POST['org_address'];
				/* important 12*/$org_city=$_POST['org_city'];
				/* important 13*/$org_state=$_POST['org_state'];
				/* important 14*/$org_pin=$_POST['org_pin'];
				/* important 15*/$org_email=$_POST['org_email'];
				/* important 16*/$org_contactno=$_POST['org_contactno'];
				/* important 17*/$org_website=$_POST['org_website'];
				/* important 18*/$dp_linkedin=$_POST['dp_linkedin'];
				/* important 19*/$dp_facebook=$_POST['dp_facebook'];
				/* important 20*/$dp_twitter=$_POST['dp_twitter'];
				/* important 21*/$dp_instagram=$_POST['dp_instagram'];
				                 $step5='1';

				
				$data=array();
				$data=array(

				 /* important 6*/  'org_name'=>$org_name,
				 /* important 7*/  'designation'=>$designation, 
				 /* important 8*/  'is_incorporated'=>$company_incorporation_is, 
				                    'specified_org_type'=>$specified_org_type,
				 /* important 9*/  'company_incorporation_date'=>$company_incorporation_date, 
				 /* important 10*/ 'year_experience'=>$year_experience, 
				 /* important 11*/ 'digital_presence_instagram'=>$dp_instagram, 
				 /* important 12*/ 'digital_presence_twitter'=>$dp_twitter, 
				 /* important 13*/ 'digital_presence_facebook'=>$dp_facebook, 
				 /* important 14*/ 'digital_presence_linkedin'=>$dp_linkedin, 
				 /* important 15*/ 'org_address'=>$org_address, 
				 /* important 16*/ 'org_city'=>$org_city, 
				 /* important 17*/ 'org_state'=>$org_state, 
				 /* important 18*/ 'org_pin'=>$org_pin, 
				 /* important 19*/ 'org_email'=>$org_email, 
				 /* important 20*/ 'org_contactno'=>$org_contactno, 
				 /* important 21*/ 'org_website'=>$org_website,
				                   'step5'=>$step5	
				
					
				);

				$success=$this->Main_model->step5_submit($data,$appl_id,$reg_id,$email,$phone);
				

		    	if($success==true){ 
			 		   
	                   $this->session->set_flashdata('success_msg','Applications step 5 save successfully');
			 	       redirect('Registration/step4', 'refresh');
				}else{
					$this->session->set_flashdata('error_msg','Email and mobile number not valid');
		    	    redirect('Registration/step5', 'refresh');
				}
			}
		}
	}
	
	public function step6()
	{
		$active['active']='6';
	    $this->load->view('header',$active);
		$this->load->view('step_six');
		$this->load->view('footer');
	}
	public function step6_submit(){
		/* important 1*/  $this->form_validation->set_rules('appl_id', 'appl_id', 'required',array('required'=>'Something went wrong! login again'));
        /* important 2*/  $this->form_validation->set_rules('reg_id', 'reg_id', 'required',array('required'=>'Something went wrong! login again'));
		/* important 3*/  $this->form_validation->set_rules('name', 'name', 'required',array('required'=>'Something went wrong! login again'));
		/* important 4*/  $this->form_validation->set_rules('email', 'email', 'required',array('required'=>'Something went wrong! login again'));
		/* important 5*/  $this->form_validation->set_rules('phone', 'phone', 'required',array('required'=>'Something went wrong! login again'));

		// /* important 6*/  $this->form_validation->set_rules('your_thoughts', 'Organization Name', 'required',array('required'=>'Please Enter your thoughts or Experiences regarding the same'));
		// /* important 7*/  $this->form_validation->set_rules('womans_crown', 'Designation', 'required',array('required'=>'Please Enter How have you supported or encouraged the women around you'));
		

      // `your_thoughts`, `womans_crown`
		$this->form_validation->run();


		if ($this->form_validation->run()==false) {
			$this->session->set_flashdata('error_msg','Please enter valid details');

			$this->session->set_flashdata('errors', validation_errors());
                $active['active']='6';
	            $this->load->view('header',$active);
				$this->load->view('step_six');
				$this->load->view('footer');
			
			// redirect($_SERVER["HTTP_REFERER"]);

		}
		else{
			if(isset($_POST['step6_submit'])){

				/* important 1*/ $appl_id=$_POST['appl_id'];
				/* important 2*/ $reg_id=$_POST['reg_id'];
				/* important 3*/ $name=$_POST['name'];
				/* important 4*/ $email=$_POST['email'];
				/* important 5*/ $phone=$_POST['phone'];
				/* important 6*/ $your_thoughts=$_POST['your_thoughts'];
				/* important 7*/ $womans_crown=$_POST['womans_crown'];

				/* important 7*/ $social_org=$_POST['social_org'];
				/* important 7*/ $cause_furthers=$_POST['cause_furthers'];
				/* important 7*/ $org_contact=$_POST['org_contact'];
				/* important 7*/ $social_other=$_POST['social_other'];
				                  $step6='1';
				
			
				
				$data=array();
				$data=array(

				 /* important 6*/  'your_thoughts'=>$your_thoughts,
				 /* important 7*/  'womans_crown'=>$womans_crown,
				 /* important 7*/  'social_org'=>$social_org,
				 /* important 7*/  'cause_furthers'=>$cause_furthers,
				 /* important 7*/  'org_contact'=>$org_contact,
				 /* important 7*/  'social_other'=>$social_other,
				                    'step6'=>$step6
				 				
				); 

			   $success=$this->Main_model->step6_submit($data,$appl_id,$reg_id,$email,$phone);
				

		    	if($success==true){ 
			 		   
	                   $this->session->set_flashdata('success_msg','You have completed Step 6 successfully');
			 	       redirect('Registration/step7', 'refresh');
				}else{
					$this->session->set_flashdata('error_msg','Email and mobile number not valid');
		    	    redirect('Registration/step6', 'refresh');
				}
			}
			else{
				/* important 1*/ $appl_id=$_POST['appl_id'];
				/* important 2*/ $reg_id=$_POST['reg_id'];
				/* important 3*/ $name=$_POST['name'];
				/* important 4*/ $email=$_POST['email'];
				/* important 5*/ $phone=$_POST['phone'];
				/* important 6*/ $your_thoughts=$_POST['your_thoughts'];
				/* important 7*/ $womans_crown=$_POST['womans_crown'];

				/* important 7*/ $social_org=$_POST['social_org'];
				/* important 7*/ $cause_furthers=$_POST['cause_furthers'];
				/* important 7*/ $org_contact=$_POST['org_contact'];
				/* important 7*/ $social_other=$_POST['social_other'];
				                  $step6='1';

				
				$data=array();
				$data=array(

				 /* important 6*/  'your_thoughts'=>$your_thoughts,
				 /* important 7*/  'womans_crown'=>$womans_crown,
				 /* important 7*/  'social_org'=>$social_org,
				 /* important 7*/  'cause_furthers'=>$cause_furthers,
				 /* important 7*/  'org_contact'=>$org_contact,
				 /* important 7*/  'social_other'=>$social_other,
				                    'step6'=>$step6
				 
					
				);

				$success=$this->Main_model->step6_submit($data,$appl_id,$reg_id,$email,$phone);
				

		    	if($success==true){  
			 		    
	                   $this->session->set_flashdata('success_msg','Applications step 5 save successfully');
			 	       redirect('Registration/step5', 'refresh');
				}else{
					$this->session->set_flashdata('error_msg','Email and mobile number not valid');
		    	    redirect('Registration/step6', 'refresh');
				}
			}
		}
	}
	public function step7()
	{
		$active['active']='7';
	    $this->load->view('header',$active);
		$this->load->view('step_seven');
		$this->load->view('footer');
	}
	public function step7_submit(){
		/* important 1*/  $this->form_validation->set_rules('appl_id', 'appl_id', 'required',array('required'=>'Something went wrong! login again'));
        /* important 2*/  $this->form_validation->set_rules('reg_id', 'reg_id', 'required',array('required'=>'Something went wrong! login again'));
		/* important 3*/  $this->form_validation->set_rules('name', 'name', 'required',array('required'=>'Something went wrong! login again'));
		/* important 4*/  $this->form_validation->set_rules('email', 'email', 'required',array('required'=>'Something went wrong! login again'));
		/* important 5*/  $this->form_validation->set_rules('phone', 'phone', 'required',array('required'=>'Something went wrong! login again'));


		if (empty($_FILES['support_entry']['name']) && $_POST['support_entry_name']=="")
		{
		    $this->form_validation->set_rules('support_entry', 'Passport Sized Photo', 'required' ,array('required'=>'Please upload your passport sized photo'));
		}

		$this->form_validation->run();


		if ($this->form_validation->run()==false) {
			$this->session->set_flashdata('error_msg','Please enter valid details');

			$this->session->set_flashdata('errors', validation_errors());
                $active['active']='7';
	            $this->load->view('header',$active);
				$this->load->view('step_seven');
				$this->load->view('footer');
			
			// redirect($_SERVER["HTTP_REFERER"]);

		}
		else{
			if(isset($_POST['step7_submit'])){

				/* important 1*/  $appl_id=$_POST['appl_id'];
				/* important 2*/  $reg_id=$_POST['reg_id'];
				/* important 3*/  $name=$_POST['name'];
				/* important 4*/  $email=$_POST['email'];
				/* important 5*/  $phone=$_POST['phone'];
				                  $step7='1';

				
			// `support_entry`, 
				
                if(!isset($_FILES['support_entry']) && $_FILES['support_entry']['name']=="" && $_FILES['support_entry']['tmp_name']==""){

                    $file_support_entry_name=$_POST['support_entry_name'];   
                    $m1=true; 

                }else{
                        
                   $file_support_entry=$_FILES['support_entry'];
				   $file_support_entry_name=$file_support_entry['name'];
			       $file_support_entry_path=$file_support_entry['tmp_name'];

			       $path1='document_uploads/'.$reg_id.'/support_entry/'.$file_support_entry_name.'';
				    if(!file_exists('document_uploads/'.$reg_id.'/support_entry/')){

				        $d=mkdir('document_uploads/'.$reg_id.'/support_entry/', 0777, true);
				    }

				    if($file_support_entry_name!="" and $file_support_entry_path!=""){
			            $m1=copy($file_support_entry_path, $path1); 
			        }else{
			             $file_support_entry_name=$_POST['support_entry_name'];   
                         $m1=true; 
			        }
				          

                }

                // `awards_recognition`,

                if(!isset($_FILES['awards_recognition']) && $_FILES['awards_recognition']['name']=="" && $_FILES['awards_recognition']['tmp_name']==""){

                    $file_awards_recognition_name=$_POST['awards_recognition_name'];   
                    $m2=true; 

                }else{
                        
                   $file_awards_recognition=$_FILES['awards_recognition'];
				   $file_awards_recognition_name=$file_awards_recognition['name'];
			       $file_awards_recognition_path=$file_awards_recognition['tmp_name'];

			       $path2='document_uploads/'.$reg_id.'/awards_recognition/'.$file_awards_recognition_name.'';
				    if(!file_exists('document_uploads/'.$reg_id.'/awards_recognition/')){

				        $d=mkdir('document_uploads/'.$reg_id.'/awards_recognition/', 0777, true);
				    }

				    if($file_awards_recognition_name!="" and $file_awards_recognition_path!=""){
			            $m2=copy($file_awards_recognition_path, $path2); 
			        }else{
			             $file_awards_recognition_name=$_POST['awards_recognition_name'];   
                         $m2=true; 
			        }
				          

                }

                // `letter_from_organization`


                if(!isset($_FILES['letter_from_organization']) && $_FILES['letter_from_organization']['name']=="" && $_FILES['letter_from_organization']['tmp_name']==""){

                    $file_letter_from_organization_name=$_POST['letter_from_organization_name'];   
                    $m3=true; 

                }else{
                        
                   $file_letter_from_organization=$_FILES['letter_from_organization'];
				   $file_letter_from_organization_name=$file_letter_from_organization['name'];
			       $file_letter_from_organization_path=$file_letter_from_organization['tmp_name'];

			       $path3='document_uploads/'.$reg_id.'/letter_from_organization/'.$file_letter_from_organization_name.'';
				    if(!file_exists('document_uploads/'.$reg_id.'/letter_from_organization/')){

				        $d=mkdir('document_uploads/'.$reg_id.'/letter_from_organization/', 0777, true);
				    }

				    if($file_letter_from_organization_name!="" and $file_letter_from_organization_path!=""){
			            $m3=copy($file_letter_from_organization_path, $path3); 
			        }else{
			             $file_letter_from_organization_name=$_POST['letter_from_organization_name'];   
                         $m3=true; 
			        }
				          

                }

				
				$data=array();
				$data=array(


					 /* important 6*/ 'support_entry'=>$file_support_entry_name, 
					 /* important 7*/ 'awards_recognition'=>$file_awards_recognition_name, 
					 /* important 8*/ 'letter_from_organization'=>$file_letter_from_organization_name,
					                 'step7'=>$step7
					 

				 
					
				); 
				
				if($m1==true && $m2==true && $m3==true){
					$success=$this->Main_model->step7_submit($data,$appl_id,$reg_id,$email,$phone);

			    	if($success==true){  
				 		    
		                   $this->session->set_flashdata('success_msg','You have completed Step 7 successfully');
				 	       redirect('Registration/step8', 'refresh');
					}else{
						$this->session->set_flashdata('error_msg','Email and mobile number not valid');
			    	    redirect('Registration/step7', 'refresh');
					}
				}else{ 

					       
                   $this->session->set_flashdata('error_msg','There was a problem to uploading the files, Please reupload it!');
		 	       redirect('Registration/step7', 'refresh');
				}
			}
			else{
				/* important 1*/ $appl_id=$_POST['appl_id'];
				/* important 2*/ $reg_id=$_POST['reg_id'];
				/* important 3*/ $name=$_POST['name'];
				/* important 4*/ $email=$_POST['email'];
				/* important 5*/ $phone=$_POST['phone'];
				                  $step7='1';

				
				// `support_entry`, 
				
                if(!isset($_FILES['support_entry']) && $_FILES['support_entry']['name']=="" && $_FILES['support_entry']['tmp_name']==""){

                    $file_support_entry_name=$_POST['support_entry_name'];   
                    $m1=true; 

                }else{
                        
                   $file_support_entry=$_FILES['support_entry'];
				   $file_support_entry_name=$file_support_entry['name'];
			       $file_support_entry_path=$file_support_entry['tmp_name'];

			       $path1='document_uploads/'.$reg_id.'/support_entry/'.$file_support_entry_name.'';
				    if(!file_exists('document_uploads/'.$reg_id.'/support_entry/')){

				        $d=mkdir('document_uploads/'.$reg_id.'/support_entry/', 0777, true);
				    }

				    if($file_support_entry_name!="" and $file_support_entry_path!=""){
			            $m1=copy($file_support_entry_path, $path1); 
			        }else{
			             $file_support_entry_name=$_POST['support_entry_name'];   
                         $m1=true; 
			        }
				          

                }

                // `awards_recognition`,

                if(!isset($_FILES['awards_recognition']) && $_FILES['awards_recognition']['name']=="" && $_FILES['awards_recognition']['tmp_name']==""){

                    $file_awards_recognition_name=$_POST['awards_recognition_name'];   
                    $m2=true; 

                }else{
                        
                   $file_awards_recognition=$_FILES['awards_recognition'];
				   $file_awards_recognition_name=$file_awards_recognition['name'];
			       $file_awards_recognition_path=$file_awards_recognition['tmp_name'];

			       $path2='document_uploads/'.$reg_id.'/awards_recognition/'.$file_awards_recognition_name.'';
				    if(!file_exists('document_uploads/'.$reg_id.'/awards_recognition/')){

				        $d=mkdir('document_uploads/'.$reg_id.'/awards_recognition/', 0777, true);
				    }

				    if($file_awards_recognition_name!="" and $file_awards_recognition_path!=""){
			            $m2=copy($file_awards_recognition_path, $path2); 
			        }else{
			             $file_awards_recognition_name=$_POST['awards_recognition_name'];   
                         $m2=true; 
			        }
				          

                }

                // `letter_from_organization`


                if(!isset($_FILES['letter_from_organization']) && $_FILES['letter_from_organization']['name']=="" && $_FILES['letter_from_organization']['tmp_name']==""){

                    $file_letter_from_organization_name=$_POST['letter_from_organization_name'];   
                    $m3=true; 

                }else{
                        
                   $file_letter_from_organization=$_FILES['letter_from_organization'];
				   $file_letter_from_organization_name=$file_letter_from_organization['name'];
			       $file_letter_from_organization_path=$file_letter_from_organization['tmp_name'];

			       $path3='document_uploads/'.$reg_id.'/letter_from_organization/'.$file_letter_from_organization_name.'';
				    if(!file_exists('document_uploads/'.$reg_id.'/letter_from_organization/')){

				        $d=mkdir('document_uploads/'.$reg_id.'/letter_from_organization/', 0777, true);
				    }

				    if($file_letter_from_organization_name!="" and $file_letter_from_organization_path!=""){
			            $m3=copy($file_bio_path, $path3); 
			        }else{
			             $file_letter_from_organization_name=$_POST['letter_from_organization_name'];   
                         $m3=true; 
			        }
				          

                }

				
				$data=array();
				$data=array(


					 /* important 6*/ 'support_entry'=>$file_support_entry_name, 
					 /* important 7*/ 'awards_recognition'=>$file_awards_recognition_name, 
					 /* important 8*/ 'letter_from_organization'=>$file_letter_from_organization_name,
					                  'step7'=>$step7
					 

				 
					
				);
				if($m1==true && $m2==true && $m3==true){

					$success=$this->Main_model->step7_submit($data,$appl_id,$reg_id,$email,$phone);
					

			    	if($success==true){  
				 		   
		                   $this->session->set_flashdata('success_msg','Applications step 7 save successfully');
				 	       redirect('Registration/step6', 'refresh');
					}else{
						$this->session->set_flashdata('error_msg','Email and mobile number not valid');
			    	    redirect('Registration/step7', 'refresh');
					}
				}else{ 

			        
                   $this->session->set_flashdata('error_msg','There was a problem to uploading the files, Please reupload it!');
		 	       redirect('Registration/step7', 'refresh');



				}
			}
		}
	}


	public function step8()
	{
		$active['active']='8';
	    $this->load->view('header',$active);
		$this->load->view('step_eight');
		$this->load->view('footer');
	}
	public function final_submit(){

       /* important 1*/  $this->form_validation->set_rules('appl_id', 'appl_id', 'required',array('required'=>'Something went wrong! login again'));
        /* important 2*/  $this->form_validation->set_rules('reg_id', 'reg_id', 'required',array('required'=>'Something went wrong! login again'));
		/* important 3*/  $this->form_validation->set_rules('name', 'name', 'required',array('required'=>'Something went wrong! login again'));
		/* important 4*/  $this->form_validation->set_rules('email', 'email', 'required',array('required'=>'Something went Wrong! login again'));
		/* important 5*/  $this->form_validation->set_rules('phone', 'phone', 'required',array('required'=>'Something went wrong! login again'));

		/* important 6*/  $this->form_validation->set_rules('declaration', 'Declaration', 'required',array('required'=>'Please accept the declaration'));
		/* important 7*/  $this->form_validation->set_rules('terms', 'Terms & Condition', 'required',array('required'=>'Please accept the term & conditions'));
		/* important 7*/  //$this->form_validation->set_rules('signature', 'Signature', 'required',array('required'=>'Please upload your digital signature'));

		if ($_POST['signature_name']=="" && empty($_FILES['signature']['name']))
		{
		    $this->form_validation->set_rules('signature', 'Digital Signature', 'required' ,array('required'=>'Please upload your digital signature'));
		}
		

      // `your_thoughts`, `womans_crown`
		$this->form_validation->run();


		if ($this->form_validation->run()==false) {
			$this->session->set_flashdata('error_msg','Please enter valid details');

			$this->session->set_flashdata('errors', validation_errors());
                $active['active']='8';
	            $this->load->view('header',$active);
				$this->load->view('step_eight');
				$this->load->view('footer');
			
			// redirect($_SERVER["HTTP_REFERER"]);

		}
		else{
			if(isset($_POST['final_submit'])){

				/* important 1*/ $appl_id=$_POST['appl_id'];
				/* important 2*/ $reg_id=$_POST['reg_id'];
				/* important 3*/ $name=$_POST['name'];
				/* important 4*/ $email=$_POST['email'];
				/* important 5*/ $phone=$_POST['phone'];
				/* important 6*/ $declaration=$_POST['declaration'];
				/* important 7*/ $terms=$_POST['terms'];
				                 $step8='1';
				
				

				// `signature`,

                if(!isset($_FILES['signature']) && $_FILES['signature']['name']=="" && $_FILES['signature']['tmp_name']==""){

                    $file_signature_name=$_POST['signature_name'];   
                    $m416=true; 

                }else{
                        
                   $file_signature=$_FILES['signature'];
				   $file_signature_name=$file_signature['name'];
			       $file_signature_path=$file_signature['tmp_name'];

			       $path_sign='document_uploads/'.$reg_id.'/signature/'.$file_signature_name.'';
				    if(!file_exists('document_uploads/'.$reg_id.'/signature/')){

				        $d=mkdir('document_uploads/'.$reg_id.'/signature/', 0777, true);
				    }

				    if($file_signature_name!="" and $file_signature_path!=""){
			            $m416=copy($file_signature_path, $path_sign); 
			        }else{
			             $file_signature_name=$_POST['signature_name'];   
                         $m416=true; 
			        }
				          

                }


			
				
				$data=array();
				$data=array(

				 /* important 6*/  'declaration'=>$declaration,
				 /* important 7*/  'terms'=>$terms,
				 /* important 7*/  'signature'=>$file_signature_name,
				                    'step8'=>$step8
				 				
				); 

				if($m416==true){

				    $success=$this->Main_model->final_submit($data,$appl_id,$reg_id,$email,$phone);
					

			    	if($success==true){ 


				 		   $con_mail=$this->email_submit($appl_id,$reg_id,$name,$email,$phone);
				 		   if($con_mail==true){

				 		   	   $this->session->set_flashdata('success_msg','Applications registered successfully');
		                       $this->session->set_flashdata('confirm_msg','Confirmation E-mail has been sent to your E-mail ID');
				 	           redirect('Registration/thankyou', 'refresh');
				 		   }
				 		   else{
				 		   	    $this->session->set_flashdata('success_msg','Applications registered successfully');
			                    $this->session->set_flashdata('confirm_msg','Confirmation E-mail has been sent to you soon');
					 	        redirect('Registration/thankyou', 'refresh');
				 		   }
		                  
					}else{
						$this->session->set_flashdata('error_msg','Email and mobile number not valid');
			    	    redirect('Registration/step8', 'refresh');
					}
				}else{

					
                   $this->session->set_flashdata('error_msg','There was a problem to uploading the digital signiture, Please reupload it!');
		 	       redirect('Registration/step8', 'refresh');
				}
			}
			else{
				/* important 1*/ $appl_id=$_POST['appl_id'];
				/* important 2*/ $reg_id=$_POST['reg_id'];
				/* important 3*/ $name=$_POST['name'];
				/* important 4*/ $email=$_POST['email'];
				/* important 5*/ $phone=$_POST['phone'];
				/* important 6*/ $declaration=$_POST['declaration'];
				/* important 7*/ $terms=$_POST['terms'];
				                  $step8='1';

				// `signature`,

                if(!isset($_FILES['signature']) && $_FILES['signature']['name']=="" && $_FILES['signature']['tmp_name']==""){

                    $file_signature_name=$_POST['signature_name'];   
                    $m416=true; 

                }else{
                        
                   $file_signature=$_FILES['signature'];
				   $file_signature_name=$file_signature['name'];
			       $file_signature_path=$file_signature['tmp_name'];

			       $path_sign='document_uploads/'.$reg_id.'/signature/'.$file_signature_name.'';
				    if(!file_exists('document_uploads/'.$reg_id.'/signature/')){

				        $d=mkdir('document_uploads/'.$reg_id.'/signature/', 0777, true);
				    }

				    if($file_signature_name!="" and $file_signature_path!=""){
			            $m416=copy($file_signature_path, $path_sign); 
			        }else{
			             $file_signature_name=$_POST['signature_name'];   
                         $m416=true; 
			        }
				          

                }

				$data=array();
				$data=array(

				 /* important 6*/  'declaration'=>$declaration,
				 /* important 7*/  'terms'=>$terms,
				 /* important 7*/  'signature'=>$file_signature_name,
				                   'step8'=>$step8
				 
					
				);

				if($m416==true){

					$success=$this->Main_model->final_submit($data,$appl_id,$reg_id,$email,$phone);
					

			    	if($success==true){  
				 		    
		                   $this->session->set_flashdata('success_msg','Applications step 7 save successfully');
				 	       redirect('Registration/step7', 'refresh');
					}else{
						$this->session->set_flashdata('error_msg','Email and mobile number not valid');
			    	    redirect('Registration/step8', 'refresh');
					}
				}else{ 

                   
                   $this->session->set_flashdata('error_msg','There was a problem to uploading the digital signiture, Please reupload it!');
		 	       redirect('Registration/step8', 'refresh');

				}
			}
		}





	}

	public function thankyou()
	{
		$active['active']='8';
	    $this->load->view('header',$active);
		$this->load->view('last_step');
		$this->load->view('footer');
	}

	public function email_submit($appl_id,$reg_id,$name,$email,$phone){

	    ob_start();
	    
	    $data_res=$this -> db -> where('id', $appl_id);
	    $data_res=$this -> db -> where('reg_id', $reg_id);
	    $data_res=$this -> db -> where('email', $email);
	    $data_res=$this -> db -> where('phone', $phone);
	    $data_res= $this-> db ->get('aparajita_detail'); 
	    $apl_data=$data_res->result();


	    if($apl_data[0]->another_institute==1){
	    	$inst_one='<tr>
		            <td>Another Name of Institution</td>
		            <td id="text_applicant_name">'.$apl_data[0]->college_name.'</td>
		        </tr>
		        <tr>
		            <td>City</td>
		            <td id="text_dob">'.$apl_data[0]->college_city.'</td>
		        </tr>
		        <tr>
		            <td>Name of Programme Completed</td>
		            <td id="text_mobile">'.$apl_data[0]->college_programme.'</td>
		        </tr>
		        <tr>
		            <td>Significant honours received (if any)</td>
		            <td id="text_email_id"><a target="_blank" href="'.base_url().'document_uploads/'.$apl_data[0]->reg_id.'/college_certificate/'.$apl_data[0]->college_certificate.'">'.$apl_data[0]->college_certificate.'</a></td>
		        </tr>';

		    }else{

              $inst_one='';


	        }


        if($apl_data[0]->third_institute==1){
        	$inst_two='<tr>
	                <td>Another Name of Institution</td>
	                <td id="text_applicant_name">'.$apl_data[0]->third_institute_name.'</td>
	            </tr>
	            <tr>
	                <td>City</td>
	                <td id="text_dob">'.$apl_data[0]->third_institute_city.'</td>
	            </tr>
	            <tr>
	                <td>Name of Programme Completed</td>
	                <td id="text_mobile">'.$apl_data[0]->third_institute_programe.'</td>
	            </tr>
	            <tr>
	                <td>Significant honours received (if any)</td>
	                <td id="text_email_id"><a target="_blank" href="'.base_url().'document_uploads/'.$apl_data[0]->reg_id.'/third_institute_certificate/'.$apl_data[0]->third_institute_certificate.'">'.$apl_data[0]->third_institute_certificate.'</a></td>
	            </tr>';
	        }else{

              $inst_two='';


	        }


	         if($apl_data[0]->specify_reltion!="") { 
               $specify_reltion='<tr>
                    <td>Specified relationship to you</td>
                    <td id="text_mobile">'.$apl_data[0]->specify_reltion.'</td>
                </tr>';
             }else{
             	$specify_reltion="";
             }

             if($apl_data[0]->specified_org_type!="") { 
               $specified_org_type='<tr>
                    <td>Specified relationship to you</td>
                    <td id="text_mobile">'.$apl_data[0]->specified_org_type.'</td>
                </tr>';
             }else{
             	$specified_org_type="";
             }





        // $content = file_get_contents("".base_url()."print.html");
        $content='<!DOCTYPE html>
						<html lang="en">

						<head>
						    <meta charset="UTF-8">
						    <meta name="viewport" content="width=device-width, initial-scale=1.0">
						    <title>Aparajita Registration Form 2024</title>
						    <link rel = "icon" href ="assets/img/aparajita_icon.png" type = "image/x-icon">
						    <link rel="stylesheet" href="assets/css/style.css">
						    <link rel="stylesheet" href="assets/css/datePicker.css">
						    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity
						        crossorigin="anonymous">

						    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
						    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">

						    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
						    <style>
						    table{
						    	font-size:10px;
						    }
						    table tr td{
						    	border:0.5px solid black;
						    }
						    table tr{
						    	border-top:0.5px solid black;
						    	border-bottom:0.5px solid black;
						    }
						    #msform fieldset .form-card{
							    width:90% !important;
							    margin-top:10px !important;
							}
						    </style>


						    
						</head>

						<body>
						    
						    <div class="container-fluid" id="grad1">
						        <div class="row justify-content-center m-0 w-100">
						            <div class="col-12 col-md-6 col-lg-4 text-center">
						                <img src="assets/img/Aparajita_Logo_Unit_2021_White.png" width="200px" height="100px">
						            <div class="col-12 col-md-12 col-lg-9 text-center p-0 mt-2 mb-2">
						                <div class="card px-0 pt-4 pb-0 mt-0 mb-3" style="background: #ea4d55;">
						                    
						                    <div class="row">
						                        <div class="col-md-12 mx-0">
						                            
						                                
						                            <form id="msform" action="<?php echo base_url();Registration/final_submit"  method="POST" enctype="multipart/form-data">
						                                 <fieldset>
						                                          


						                                    <div class="form-card">
						                                        <h5 class="fs-title text-center mb-3">Registration Card</h5>
						                                        <div class>
						                                            <div class="row mb-2" id="divToPrint">
						                                                <div class="col-12 col-md-6 col-lg-4 text-center " id="printLogo123"
						                                                    style="display: none; text-align: center;">
						                                                    <img src="https://aparajita.sanmarg.in/assets/images/Aparajita_Logo_Unit_2021_White.png"
						                                                        width="300px" height="100px" style="margin:0px auto ; " alt>
						                                                </div>
						                                                <div class="col-12">
						                                                    <p class="mb-0" id></p>
						                                                    <table border="1"
						                                                        style="border-collapse: collapse; width: 100%; margin-bottom: 5px;font-size:10px;"
						                                                        class="table table-responsive">
						                                                        <thead style="background: #ea4d55;">
						                                                            <tr>
						                                                                <th>Introduction</th>
						                                                                <th></th>
						                                                            </tr>
						                                                        </thead>
						                                                        <tbody>
						                                                            <tr>
						                                                                <td>Name</td>
						                                                                <td id="text_guest_name">'.$apl_data[0]->name.'</td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td>Email</td>
						                                                                <td id="text_guest_email">'.$apl_data[0]->email.'</td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td>Phone No.</td>
						                                                                <td id="text_guest_phone">'.$apl_data[0]->phone.'</td>
						                                                            </tr>
						                                                        </tbody>
						                                                    </table>
						                                                </div>


						                                                 <div class="col-12 mt-3">
						                                                    <table border
						                                                        style="border-collapse: collapse; width: 100%; margin-bottom: 15px;"
						                                                        class="table table-responsive">
						                                                        <thead style="background: #ea4d55;">
						                                                            <tr>
						                                                                <th>Application Details</th>
						                                                                <th></th>
						                                                            </tr>
						                                                        </thead>
						                                                        <tbody>
						                                                            <tr>
						                                                                <td>Applicant’s Name</td>
						                                                                <td id="text_applicant_name">'.$apl_data[0]->applicant_name.'</td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td>Date of Birth</td>
						                                                                <td id="text_dob">'.$apl_data[0]->dob.'</td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td>Applicant’s Mobile Number</td>
						                                                                <td id="text_mobile">'.$apl_data[0]->mobile.'</td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td>Applicant’s Email ID</td>
						                                                                <td id="text_email_id">'.$apl_data[0]->email_id.'</td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td>Linkedin Profile Link</td>
						                                                                <td id="text_linkedin_profile"><a href="'.$apl_data[0]->linkedin_profile.'" target="_blank">'.$apl_data[0]->linkedin_profile.'</td>
						                                                            </tr>

						                                                             <tr>
						                                                                <td>Alternate Contacts Name</td>
						                                                                <td id="text_applicant_name">'.$apl_data[0]->alternate_contact_name.'</td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td>Alternate Contacts Phone Number</td>
						                                                                <td id="text_dob">'.$apl_data[0]->alternate_contact.'</td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td>Their relationship to you</td>
						                                                                <td id="text_mobile">'.$apl_data[0]->alternate_contact_relationship.'</td>
						                                                            </tr>'.$specify_reltion.'
						                                                            
						                                                                

						                                                            <tr>
						                                                                <td>Write a brief bio about your role and the work you
						                                                                    do and why it excites you.</td>
						                                                                <td id="text_your_role">'.$apl_data[0]->your_role.'</td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td>If you feel like you could articulate your ideas and
						                                                                    your response better in the form of a video, feel
						                                                                    free to do that too!</td>
						                                                                <td id="text_bio_video"><a target="_blank" href="'.base_url().'document_uploads/'.$apl_data[0]->reg_id.'/bio_video/'.$apl_data[0]->bio_video.'">'.$apl_data[0]->bio_video.'</a></td>
						                                                            </tr>

						                                                        </tbody>
						                                                    </table>
						                                                </div>
						                                                <div class="col-12 mt-3">
						                                                    <table border
						                                                        style="border-collapse: collapse; width: 100%; margin-bottom: 15px;"
						                                                        class="table table-responsive">
						                                                        <thead style="background: #ea4d55;">
						                                                            <tr>
						                                                                <th>Past Companies Worked With</th>
						                                                                <th></th>
						                                                            </tr>
						                                                        </thead>
						                                                        <tbody>
						                                                            <tr>
						                                                                <td><strong>Name of the Organization</strong></td>
						                                                                <td><strong>Years of Association with the
						                                                                        Organization</strong></td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td id="text_past_organization_name1">'.$apl_data[0]->past_organization_name1.'</td>
						                                                                <td id="text_past_experience1">'.$apl_data[0]->past_experience1.'</td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td id="text_past_organization_name2">'.$apl_data[0]->past_organization_name2.'</td>
						                                                                <td id="text_past_experience2">'.$apl_data[0]->past_experience2.'</td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td id="text_past_organization_name3">'.$apl_data[0]->past_organization_name3.'</td>
						                                                                <td id="text_past_experience3">'.$apl_data[0]->past_experience3.'</td>
						                                                            </tr>
						                                                        </tbody>
						                                                    </table>
						                                                </div>

						                                                

						                                                <div class="col-12 mt-3">
						                                                    <p class="mb-0"></p>
						                                                    <table border
						                                                        style="border-collapse: collapse; width: 100%; margin-bottom: 15px;"
						                                                        class="table table-responsive">
						                                                        <thead style="background: #ea4d55;">
						                                                            <tr>
						                                                                <th>Category</th>
						                                                                <th></th>
						                                                            </tr>
						                                                        </thead>
						                                                        <tbody>
						                                                            <tr>
						                                                                <td>Category</td>
						                                                                <td id="text_category">'.$apl_data[0]->category.'</td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td>Years of Experience</td>
						                                                                <td id="text_you_shine">'.$apl_data[0]->you_shine.'</td>
						                                                            </tr>
						                                                        </tbody>
						                                                    </table>
						                                                </div>

						                                                <div class="col-12 mt-3">
						                                                    <table border
						                                                        style="border-collapse: collapse; width: 100%; margin-bottom: 15px;"
						                                                        class="table table-responsive">
						                                                        <thead style="background: #ea4d55;">
						                                                            <tr>
						                                                                <th>Educational Background</th>
						                                                                <th></th>
						                                                            </tr>
						                                                        </thead>
						                                                        <tbody>
						                                                            <tr>
						                                                                <td>Name of Institution</td>
						                                                                <td id="text_applicant_name">'.$apl_data[0]->school_name.'</td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td>City</td>
						                                                                <td id="text_dob">'.$apl_data[0]->school_city.'</td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td>Name of Programme Completed</td>
						                                                                <td id="text_mobile">'.$apl_data[0]->school_programme.'</td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td>Significant honours received (if any)</td>
						                                                                <td id="text_email_id"><a target="_blank" href="'.base_url().'document_uploads/'.$apl_data[0]->reg_id.'/school_certificate/'.$apl_data[0]->school_certificate.'">'.$apl_data[0]->school_certificate.'</a></td>
						                                                            </tr>'.$inst_one.''.$inst_two.'

						                                                            

						                                                        </tbody>
						                                                    </table>
						                                                </div>


						                                                <div class="col-12 mt-3">
						                                                    <table border
						                                                        style="border-collapse: collapse; width: 100%; margin-bottom: 15px;"
						                                                        class="table table-responsive">
						                                                        <thead style="background: #ea4d55;">
						                                                            <tr>
						                                                                <th>Organization Details</th>
						                                                                <th></th>
						                                                            </tr>
						                                                        </thead>
						                                                        <tbody>
						                                                            <tr>
						                                                                <td>Organization’s Name </td>
						                                                                <td id="text_org_name">'.$apl_data[0]->org_name.'</td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td>Your Designation and Department</td>
						                                                                <td id="text_designation">'.$apl_data[0]->designation.'</td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td>Type of Organization</td>
						                                                                <td id="text_company_incorporation_is">'.$apl_data[0]->is_incorporated.'</td>
						                                                            </tr>'.$specified_org_type.'
						                                                            <tr>
						                                                                <td>Date of Formation</td>
						                                                                <td id="text_company_incorporation_date">'.$apl_data[0]->company_incorporation_date.'</td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td>Organization Contact Number</td>
						                                                                <td id="text_company_incorporation_date">'.$apl_data[0]->org_contactno.'</td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td>Total Years of Work Experience as on March 31, 2023
						                                                                </td>
						                                                                <td id="text_year_experience">'.$apl_data[0]->year_experience.'</td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td>Address</td>
						                                                                <td id="text_org_address">'.$apl_data[0]->org_address.'</td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td>City</td>
						                                                                <td id="text_org_city">'.$apl_data[0]->org_city.'</td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td>State</td>
						                                                                <td id="text_org_state">'.$apl_data[0]->org_state.'</td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td>Pin Code</td>
						                                                                <td id="text_org_pin">'.$apl_data[0]->org_pin.'</td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td>Email ID</td>
						                                                                <td id="text_org_email">'.$apl_data[0]->org_email.'</td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td>Organization’s Linkedin Page</td>
						                                                                <td><a href="'.$apl_data[0]->digital_presence_linkedin.'" target="_blank">
						                                                                    '.$apl_data[0]->digital_presence_linkedin.'
						                                                                        
						                                                                    </a>
						                                                                </td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td>Organization’s Facebook Page</td>
						                                                                <td><a href="'.$apl_data[0]->digital_presence_facebook.'" target="_blank">
						                                                                    '.$apl_data[0]->digital_presence_facebook.'
						                                                                        
						                                                                    </a>
						                                                                </td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td>Organization’s Twitter Page</td>
						                                                                <td><a href="'.$apl_data[0]->digital_presence_twitter.'" target="_blank">
						                                                                    '.$apl_data[0]->digital_presence_twitter.'
						                                                                        
						                                                                    </a>
						                                                                </td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td>Organization’s Instagram Page</td>
						                                                                <td><a href="'.$apl_data[0]->digital_presence_instagram.'" target="_blank">
						                                                                    '.$apl_data[0]->digital_presence_instagram.'
						                                                                        
						                                                                    </a>
						                                                                </td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td>Organization’s Official Website</td>
						                                                                <td id="text_org_website"><a href="'.$apl_data[0]->org_website.'" target="_blank">
						                                                                    '.$apl_data[0]->org_website.'
						                                                                        
						                                                                    </a>
						                                                                </td>
						                                                            </tr>
						                                                        </tbody>
						                                                    </table>
						                                                </div>

						                                               


						                                               

						                                                

						                                                <div class="col-12 mt-3">
						                                                    <table border
						                                                        style="border-collapse: collapse; width: 100%; margin-bottom: 15px;"
						                                                        class="table table-responsive">
						                                                        <thead style="background: #ea4d55;">
						                                                            <tr>
						                                                                <th>Insights & Experiences</th>
						                                                                <th></th>
						                                                            </tr>
						                                                        </thead>
						                                                        <tbody>
						                                                            <tr>
						                                                                <td>1. “Always be kinder than necessary” - James Bary
						                                                                    </br> What are your thoughts or experiences
						                                                                    regarding the same?</td>
						                                                                <td id="text_your_thoughts">'.$apl_data[0]->your_thoughts.'</td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td>2. As an institution and a community, we strongly
						                                                                    believe in the importance of women supporting other
						                                                                    women, especially when we are surrounded by systems
						                                                                    and societies that are not designed for us. How have
						                                                                    you supported or encouraged the women around you?
						                                                                </td>
						                                                                <td id="text_womans_crown">'.$apl_data[0]->womans_crown.'</td>
						                                                            </tr>

						                                                            <tr>
						                                                                <td>A social organisation or NGO that you support</td>
						                                                                <td id="text_your_thoughts">'.$apl_data[0]->social_org.'</td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td>The cause it furthers</td>
						                                                                <td id="text_your_thoughts">'.$apl_data[0]->cause_furthers.'</td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td>Organisations contact</td>
						                                                                <td id="text_your_thoughts">'.$apl_data[0]->org_contact.'</td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td>Other details</td>
						                                                                <td id="text_your_thoughts">'.$apl_data[0]->social_other.'</td>
						                                                            </tr>


						                                                        </tbody>
						                                                    </table>
						                                                </div>
						                                                <div class="col-12 mt-3">
						                                                    <table border
						                                                        style="border-collapse: collapse; width: 100%; margin-bottom: 15px;"
						                                                        class="table table-responsive">
						                                                        <thead style="background: #ea4d55;">
						                                                            <tr>
						                                                                <th>Documents to be Uploaded</th>
						                                                                <th></th>
						                                                            </tr>
						                                                        </thead>
						                                                        
						                                                        <tbody>
						                                                            <tr>
						                                                                <td>A high-resolution passport-sized photo that is not
						                                                                    older than a year</td>
						                                                                <td id="text_support_entry"><a target="_blank" href="'.base_url().'document_uploads/'.$apl_data[0]->reg_id.'/support_entry/'.$apl_data[0]->support_entry.'">'.$apl_data[0]->support_entry.'</a></td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td>Please list any significant awards or honours you’ve
						                                                                    received</td>
						                                                                <td id="text_awards_recognition"><a target="_blank" href="'.base_url().'document_uploads/'.$apl_data[0]->reg_id.'/awards_recognition/'.$apl_data[0]->awards_recognition.'">'.$apl_data[0]->awards_recognition.'</a></td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td>Letter from the organization stating your duration
						                                                                    and designation</td>
						                                                                <td id="text_letter_from_organization"><a target="_blank" href="'.base_url().'document_uploads/'.$apl_data[0]->reg_id.'/letter_from_organization/'.$apl_data[0]->letter_from_organization.'">'.$apl_data[0]->letter_from_organization.'</a></td>
						                                                            </tr>
						                                                            <tr>
						                                                                <td>Your uploaded digital Signature</td>
						                                                                <td id="signature"><a target="_blank" href="'.base_url().'document_uploads/'.$apl_data[0]->reg_id.'/signature/'.$apl_data[0]->signature.'">'.$apl_data[0]->signature.'</a></td>
						                                                            </tr>
						                                                        </tbody>
						                                                    </table>
						                                                </div>
						                                            </div>

						                                        
						                                        </div>
						                                        
						                                    </div>

						                                    
						                                </fieldset>
						                            </form>

						                             </div>
						                    </div>
						                </div>
						            </div>
						        </div>
						    </div>

						    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
						    
						    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity
						        crossorigin="anonymous"></script>
						    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

						    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
						    

						    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
						    <!-- <script src="<?php// echo base_url();assets/js/jquery.validate.min.js"></script> -->
						    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

						    <script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
						    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
						    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
						    <!-- <script src="<?php// echo base_url();assets/js/common.js"></script> -->
						    <script src="https://cdn.jsdelivr.net/npm/sweetSwal.fire2@11"></script>
						   
						    

						    </body>

						</html>';
	    


        // $mpdf = new \Mpdf\Mpdf();
       	$mpdf = new \Mpdf\Mpdf([
						    'mode' => 'utf-8',
						    'format' => 'A4-P',
						    'orientation' => 'P',
						    0,    // margin_left
						    0,    // margin right
						    0,    // margin top
						    0,    // margin bottom
						    0,    // margin header
						    0     // margin footer
						]);

       	     $file='document_uploads/form-'.$reg_id.'.pdf';
							
             $mpdf->WriteHTML($content);              
		 	 $mpdf->Output($file,'F');
		 	 $emailAttachment=$mpdf->Output($file, 'S');
	
	        // Load PHPMailer library
	        $this->load->library('phpmailer_lib');

	        // PHPMailer object
	        $mail = $this->phpmailer_lib->load();

	        // SMTP configuration
	        $mail->isSMTP();
	        // $mail->SMTPDebug =3;                                       // Set mailer to use SMTP
	        $mail->Host = 'smtp.gmail.com';   // Specify main and backup SMTP servers
	        $mail->Debugoutput = 'html';
	        $mail->SMTPAuth = true;
	        $mail->CharSet = "UTF-8";
	 
	        $mail->Username = '############';               
            $mail->Password = '############';  
	        $mail->SMTPSecure = 'tls';
	        $mail->Port     = 587;
	        $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
	        $mail->isHTML(true);                                     // Set email format to HTML
	        
	        $mail->setFrom('##############', '##################');
	        $mail->addReplyTo('#############', '#######################');
	        // Add a recipient
	        $mail->addAddress($email);
	        // Email subject
	        $mail->Subject = '###############################';

	        

	        $Body=file_get_contents('registration-email.html');
	                           
	        $Body=str_ireplace("REGNAME", $name, $Body);
	        $Body=str_ireplace("USER_MAIL", $email, $Body);
	        $Body=str_ireplace("USER_PHONE", $phone, $Body);  
	        $mail->Body=$Body;

	        $mail->AddStringAttachment($emailAttachment,'aparajita-registration-2024.pdf','base64','application/pdf');

	        // Send email
	        if(!$mail->send()){
	            return false;
	        }else{
	            return true;
	        }
    }
	

}
