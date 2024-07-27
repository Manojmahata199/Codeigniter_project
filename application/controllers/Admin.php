<?php
require_once FCPATH.'vendor/autoload.php';
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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


            // $this->load->helper('url');
             // $this->load->helper('session');
            $this->load->model('Admin_model');
	        $this->load->helper('url_helper');
	        $this->load->helper(array('form', 'url'));
	        $this->load->helper('form');
	        $this->load->library('form_validation');
	        $this->load->library('session');
	        $this->load->library('email');
	        $this->load->helper('url');

	        

    }
    public function login()
	{
	
      
        $this->load->view('admin/login');
        
		
	}
    // $name,$email,$phone
    public function incomplete_mail(){

       if(isset($_GET['name']) && isset($_GET['email']) && isset($_GET['phone'])){

            $name=$_GET['name'];
            $email=$_GET['email'];
            $phone=$_GET['phone'];
            $appl_id=$_GET['appl_id'];
            $reg_id=$_GET['user_id'];
            $mail_count=$_GET['mail_count'];
            $mail_count_plus=$mail_count+1;

            
            $data=array();
            $data=array(

                "mail_count"=>$mail_count_plus

            );

            $con_mail=$this->email_send($name,$email,$phone);
            $mail_counting=$this->Admin_model->mail_count($data,$appl_id,$reg_id,$email,$phone);

            


            if($con_mail==true && $mail_counting==true){
                 $this->session->set_flashdata('success_msg','Email Send Succesfully');
                    redirect('Admin/incomplete_list', 'refresh');

            }else{
                 $this->session->set_flashdata('error_msg','There is a problem to send mail to this user');
                    redirect('Admin/incomplete_list', 'refresh');
            }

        }else{
            $this->session->set_flashdata('error_msg','There is a problem to send mail to this user');
            redirect('Admin/incomplete_list', 'refresh');
        }
        
    }    
    public function email_send($name,$email,$phone){

      ob_start();

        // Load PHPMailer library
            $this->load->library('phpmailer_lib');

            // PHPMailer object
            $mail = $this->phpmailer_lib->load();

            // SMTP configuration
            $mail->isSMTP();
            //$mail->SMTPDebug =3;                                       // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';   // Specify main and backup SMTP servers
            $mail->Debugoutput = 'html';
            $mail->SMTPAuth = true;
            $mail->CharSet = "UTF-8";
            $mail->Username = '#################';               
            $mail->Password = '###############';  
            $mail->SMTPSecure = 'tls';
            $mail->Port     = 587;
            $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
            $mail->isHTML(true);                                     // Set email format to HTML
            
            $mail->setFrom('#############', 'TEAM APARAJITA');
            $mail->addReplyTo('#############', 'TEAM APARAJITA');
            // Add a recipient
            $mail->addAddress($email);
            // Email subject
            $mail->Subject = '################# REGISTRATION INVITATION MAIL';

            

            $Body=file_get_contents('incomplete_mail.html');
                               
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
	public function login_op(){

		$this->form_validation->set_rules('admin_email', 'Email', 'required|valid_email',array('required'=>'Your Email is Required'));
		$this->form_validation->set_rules('password', 'Password Field', 'required',array('required'=>'Your Password Is Required'));
		$this->form_validation->run();



		if($this->form_validation->run()==false) {

			$this->session->set_flashdata('errors', validation_errors());
			$this->session->set_flashdata('error_msg','Please Enter Valid Data');
			
			
	        $this->load->view('admin/login');
	       
			
			
		}
		else{
		 
		    	$mail=$_POST['admin_email'];
		    	$password=$_POST['password'];
		    	
		    	$date=array();
		    	$data=array(

		    		'mail'=>$mail,
		    		'password'=>$password
		    		
		    	);
		    	
		    	$res=$this->Admin_model->login_op($data);


		    	if($res!=false){	

		    		$this->session->set_userdata('id',$res->id);
			        $this->session->set_userdata('mail',$res->mail);
			        $this->session->set_userdata('name',$res->name);
			        $this->session->set_userdata('password',$res->password);
			        	
		        	$this->session->set_flashdata('success_msg','You Login Succesfully');
		    	    redirect('Admin/dashboard', 'refresh');
			    	    
			    }else{

			    	$this->session->set_flashdata('error_msg','Please Enter Valid Login Id');
			  
			        redirect('Admin/login', 'refresh');
			        

			    }


		   
		}

	}
	public function logout(){
       $this->session->sess_destroy();

        redirect('Admin/login', 'refresh');


	}
	
	public function application_list(){
       if($this->session->userdata('id')!=""){

			

		    if(isset($_POST['search_submit'])){

				$search=$_POST['search_input'];			   
			    $search_data['result']=$this->Admin_model->search_list($search);

	      
		    	$this->load->view('admin/header');
		        $this->load->view('admin/application_list',$search_data);
		        $this->load->view('admin/footer');

         	}else{
         		$data['result']=$this->Admin_model->application_list();

			    $this->load->view('admin/header');
		        $this->load->view('admin/application_list',$data);
		        $this->load->view('admin/footer');
         	}
			
			
		}else{
			$this->session->set_flashdata('error_msg','Invalid Login Id! Please Login Now');
            redirect('admin/login', 'refresh');

		}

	}
	public function dashboard(){

        if($this->session->userdata('id')!=""){


        	
        	$count['appl_count']=$this->Admin_model->appl_count();
        	

			$this->load->view('admin/header');
		    $this->load->view('admin/main',$count);
		    $this->load->view('admin/footer');
			
			
		}else{
			$this->session->set_flashdata('error_msg','Invalid Login Id! Please Login Now');
            redirect('admin/login', 'refresh');

		}



	}
	public function incomplete_list(){

        if($this->session->userdata('id')!=""){


        	if(isset($_POST['search_submit'])){

				$search=$_POST['search_input'];			   
			    $search_data['result']=$this->Admin_model->search_list($search);

	      
		    	$this->load->view('admin/header');
		        $this->load->view('admin/incomplete_registration',$search_data);
		        $this->load->view('admin/footer');

         	}else{


         		$data['result']=$this->Admin_model->application_list();

			    $this->load->view('admin/header');
		        $this->load->view('admin/incomplete_registration',$data);
		        $this->load->view('admin/footer');
         	
			}
			
		}else{
			$this->session->set_flashdata('error_msg','Invalid Login Id! Please Login Now');
            redirect('admin/login', 'refresh');

		}



	}

	
	public function export_application(){

        $TODAY_DATE=date('d-m-Y');

       $data=$this->Admin_model->application_list();

          


        $html='<table style="text-align:center;">
       <tr>
                <td>SR NO</td>
                <td>UNIQUE ID</td>
                <td>FILE FOLDER</td>
                <td>REGISTRATION CARD</td>
                <td>NAME</td>
                <td>EMAIL</td>
                <td>PHONE</td>
                <td>CATEGORY</td>
                <td>YOUR SHINE</td>
                <td>APPLICANTS NAME</td>
                <td>APPLICANTS DOB</td>
                <td>APPLICANTS MOBILE</td>
                <td>APPLICANTS EMAIL</td>
                <td>APPLICANTS SOCIAL MEDIA</td>
                <td>APPLICANTS LINKEDIN</td>
                <td>APPLICANTS ALTERNATE CONTACTS NAME</td>
                <td>APPLICANTS ALTERNATE CONTACTS NUMBER</td>
                <td>ALTERNATE CONTACTS NAME RELATIONS</td>
                <td>ALTERNATE CONTACTS NAME SPECIFIC RELATIONS</td>
                <td>APPLICANTS ROLE ON ORGANIZATIONS</td>
                <td>APPLICANTS BIO VIDEO</td>
                <td>APPLICANTS PAST ORGANIZATIONS</td>
                <td>YEARS OF ASSOCIATIONS WITH THE ORGANIZATIONS</td>
                <td>ANOTHER PAST ORGANIZATIONS</td>
                <td>YEARS OF ASSOCIATIONS WITH THE ORGANIZATIONS</td>
                <td>ANOTHER PAST ORGANIZATIONS</td>
                <td>YEARS OF ASSOCIATIONS WITH THE ORGANIZATIONS</td>
                <td>INSTITUTION NAME</td>
                <td>INSTITUTION CITY</td>
                <td>PROGRAMME YOU COMPLETED</td>
                <td>INSTITUTION SIGNIFICANT HONOURS</td>
                <td>ANOTHER INSTITUTION NAME</td>
                <td>ANOTHER INSTITUTION CITY</td>
                <td>ANOTHER PROGRAMME YOU COMPLETED</td>
                <td>ANOTHER INSTITUTION SIGNIFICANT HONOURS</td>
                <td>ANOTHER INSTITUTION NAME</td>
                <td>ANOTHER INSTITUTION CITY</td>
                <td>ANOTHER PROGRAMME YOU COMPLETED</td>
                <td>ANOTHER INSTITUTION SIGNIFICANT HONOURS</td>
                <td>ORGANIZATIONS NAME</td>
                 <td>DESIGNATION</td>
                <td>IS INCORPORATED</td>
                <td>INCORPORATED DATE</td>
                <td>YEARS OF EXPERIENCE</td>
                <td>INSTAGRAM LINK</td>
                <td>TWITTER LINK</td>
                <td>FACEBOOK LINK</td>
                <td>LINKEDIN LINK</td>
                <td>ORGANIZATIONS ADDRESS</td>
                <td>ORGANIZATIONS CITY</td>
                <td>ORGANIZATIONS STATE</td>
                <td>ORGANIZATIONS PIN</td>
                <td>ORGANIZATIONS EMAIL</td>
                <td>ORGANIZATIONS MOBILE NUMBER</td>
                <td>ORGANIZATIONS WEBSITE</td>
                <td>YOUR THOUGHTS ON QUESTIONS ONE</td>
                <td>HOW YOU SUPPORTED WOMEN</td>
                <td>NGO SUPPORT</td>
                <td>CAUSE IT FURTHERS</td>
                <td>NGO CONTACT</td>
                <td>NGO OTHER DETAILS</td>
                <td>PASSPORT SIZE PHOTO</td>
                <td>SIGNIFICANT AWARDS</td>
                <td>LETTER FROM ORGANIZATIONS</td>
                <td>DIGITAL SIGNITURE</td>
                <td>COMPLETE</td>
                <td>DECLARATION</td>
                <td>TERM & CONDITION</td>
                <td>APPLYING DATE & TIME</td>
                

                 
       </tr>';
               

  

                foreach($data as $result) {


                     

                	if($result->step8==1){

                		$complete="Complete";
                	}else{
                		$complete="Incomplete";
                	}

                	if($result->declaration=='on'){

                		$declaration="Yes";
                	}else{
                		$declaration="No";
                	}

                	if($result->terms=='on'){

                		$term_condition="Yes";
                	}else{
                		$term_condition="No";
                	}

                

                $created_time=$result->created_at;
                $new_created_time=date('d-m-y H:i',strtotime($created_time));


                $company_incorporation_date=$result->company_incorporation_date;
                $new_company_incorporation_date=date('d-m-y',strtotime($company_incorporation_date));

                $dob=$result->dob;
                $new_dob=date('d-m-y',strtotime($dob));
                
                    if($result->school_certificate!=""){                     
                        $school_certificate='https://aparajita.sanmarg.in/document_uploads/'.$result->reg_id.'/school_certificate/'.$result->school_certificate.'';
                    }else{
                    	$school_certificate="";
                    }

                    if($result->college_certificate!=""){
                        $college_certificate='https://aparajita.sanmarg.in/document_uploads/'.$result->reg_id.'/college_certificate/'.$result->college_certificate.'';
                    }else{
                    	$college_certificate="";
                    }

                    if($result->third_institute_certificate!=""){                    
                        $third_institute_certificate='https://aparajita.sanmarg.in/document_uploads/'.$result->reg_id.'/third_institute_certificate/'.$result->third_institute_certificate.'';
                    }else{
                    	$third_institute_certificate="";
                    }

                    if($result->third_institute_certificate!=""){                    
                        $third_institute_certificate='https://aparajita.sanmarg.in/document_uploads/'.$result->reg_id.'/third_institute_certificate/'.$result->third_institute_certificate.'';
                    }else{
                    	$third_institute_certificate="";
                    }

                    if($result->bio_video!=""){                    
                        $bio_video='https://aparajita.sanmarg.in/document_uploads/'.$result->reg_id.'/bio_video/'.$result->bio_video.'';
                    }else{
                    	$bio_video="";
                    }

                    if($result->support_entry!=""){                    
                        $support_entry='https://aparajita.sanmarg.in/document_uploads/'.$result->reg_id.'/support_entry/'.$result->support_entry.'';
                    }else{
                    	$support_entry="";
                    }

                    if($result->awards_recognition!=""){                    
                        $awards_recognition='https://aparajita.sanmarg.in/document_uploads/'.$result->reg_id.'/awards_recognition/'.$result->awards_recognition.'';
                    }else{
                    	$awards_recognition="";
                    }

                    if($result->letter_from_organization!=""){                    
                        $letter_from_organization='https://aparajita.sanmarg.in/document_uploads/'.$result->reg_id.'/letter_from_organization/'.$result->letter_from_organization.'';
                    }else{
                    	$letter_from_organization="";
                    }

                    if($result->signature!=""){                    
                        $signature='https://aparajita.sanmarg.in/document_uploads/'.$result->reg_id.'/signature/'.$result->signature.'';
                    }else{
                    	$signature="";
                    }

                    if($result->signature!=""){ 

                        $REGISTRATION_CARD='https://aparajita.sanmarg.in/document_uploads/form-'.$result->reg_id.'.pdf';
                    }else{

                    	$REGISTRATION_CARD='';
                    }

                    // `id`, `reg_id`, `name`, `email`, `phone`, `category`, `you_shine`, `shine_five`, `shine_fifteen`, `org_name`, `current_profile`, `designation`, `is_incorporated`, `company_incorporation_date`, `year_experience`, `digital_presence`, `digital_presence_instagram`, `digital_presence_twitter`, `digital_presence_facebook`, `digital_presence_linkedin`, `org_address`, `org_city`, `org_state`, `org_pin`, `org_email`, `org_contactno`, `org_website`, `school_name`, `school_city`, `school_programme`, `school_certificate`, `another_institute`, `college_name`, `college_city`, `college_programme`, `college_certificate`, `third_institute`, `third_institute_name`, `third_institute_city`, `third_institute_programe`, `third_institute_certificate`, `applicant_name`, `dob`, `mobile`, `email_id`, `social_media`, `linkedin_profile`, `alternate_contact_name`, `alternate_contact`, `alternate_contact_relationship`, `specify_reltion`, `your_role`, `bio_video`, `past_organization_name1`, `past_experience1`, `past_organization_name2`, `past_experience2`, `past_organization_name3`, `past_experience3`, `your_thoughts`, `womans_crown`, `social_org`, `cause_furthers`, `org_contact`, `social_other`, `how_aparajita`, `support_entry`, `summarizing_work`, `awards_recognition`, `company_incorporation_certificate`, `letter_from_organization`, `signature`, `is_active`, `declaration`, `terms`, `step1`, `step2`, `step3`, `step4`, `step5`, `step6`, `step7`, `step8`, `created_at`



                    $html.='<tr>                                
                                <td>'.$result->id.'</td>
                                <td>'.$result->unique_id.'</td>
                                <td>'.$result->reg_id.'</td>
                                <td>'.$REGISTRATION_CARD.'</td>
                                <td>'.$result->name.'</td>
                                <td>'.$result->email.'</td>
                                <td>'.$result->phone.'</td>
                                <td>'.$result->category.'</td>
                                <td>'.$result->you_shine.'</td>
                                <td>'.$result->applicant_name.'</td>
                                <td>'.$new_dob.'</td>
                                <td>'.$result->mobile.'</td>
                                <td>'.$result->email_id.'</td>
                                <td>'.$result->social_media.'</td>
                                <td>'.$result->linkedin_profile.'</td>
                                <td>'.$result->alternate_contact_name.'</td>
                                <td>'.$result->alternate_contact.'</td>
                                <td>'.$result->alternate_contact_relationship.'</td>
                                <td>'.$result->specify_reltion.'</td>
                                <td>'.$result->your_role.'</td>
                                <td>'.$bio_video.'</td>
                                <td>'.$result->past_organization_name1.'</td>
                                <td>'.$result->past_experience1.'</td>
                                <td>'.$result->past_organization_name2.'</td>
                                <td>'.$result->past_experience2.'</td>
                                <td>'.$result->past_organization_name3.'</td>
                                <td>'.$result->past_experience3.'</td>
                                 <td>'.$result->school_name.'</td>
                                <td>'.$result->school_city.'</td>
                                <td>'.$result->school_programme.'</td>
                                <td>'.$school_certificate.'</td>
                                <td>'.$result->college_name.'</td>
                                <td>'.$result->college_city.'</td>
                                <td>'.$result->college_programme.'</td>
                                <td>'.$college_certificate.'</td>
                                <td>'.$result->third_institute_name.'</td>
                                <td>'.$result->third_institute_city.'</td>
                                <td>'.$result->third_institute_programe.'</td>
                                <td>'.$third_institute_certificate.'</td>
                                <td>'.$result->org_name.'</td>
                                <td>'.$result->designation.'</td>
                                <td>'.$result->is_incorporated.'</td>
                                <td>'.$new_company_incorporation_date.'</td>
                                <td>'.$result->year_experience.'</td>
                                <td>'.$result->digital_presence_instagram.'</td>
                                <td>'.$result->digital_presence_twitter.'</td>
                                <td>'.$result->digital_presence_facebook.'</td>
                                <td>'.$result->digital_presence_linkedin.'</td>
                                <td>'.$result->org_address.'</td>
                                <td>'.$result->org_city.'</td>
                                <td>'.$result->org_state.'</td>
                                <td>'.$result->org_pin.'</td>
                                <td>'.$result->org_email.'</td>
                                <td>'.$result->org_contactno.'</td>
                                <td>'.$result->org_website.'</td>
                                <td>'.$result->your_thoughts.'</td>
                                <td>'.$result->womans_crown.'</td>
                                <td>'.$result->social_org.'</td>
                                <td>'.$result->cause_furthers.'</td>
                                <td>'.$result->org_contact.'</td>
                                <td>'.$result->social_other.'</td>
                                <td>'.$support_entry.'</td>
                                <td>'.$awards_recognition.'</td>
                                <td>'.$letter_from_organization.'</td>
                                <td>'.$signature.'</td>
                                <td>'.$complete.'</td>
                                <td>'.$declaration.'</td>
                                <td>'.$term_condition.'</td>
                                <td>'.$new_created_time.'</td>
                                
     
                           </tr>';
                                                                                               
                               
                } 
                

                $html.='</table>';

                

                header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
                header("Content-type:   application/x-msexcel; charset=utf-8");
                header("Content-Disposition: attachment; filename=SANMARG APARAJITA AWARD APPLICATIONS LIST(".$TODAY_DATE.").xls"); 
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Cache-Control: private",false);
            
                echo $html;

             exit();



	}
	
}
?>