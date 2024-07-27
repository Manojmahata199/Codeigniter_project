<?php 

  $id=$this->session->userdata('id');
  $reg_id=$this->session->userdata('reg_id');
  $name=$this->session->userdata('name');
  $email=$this->session->userdata('email');
  $phone=$this->session->userdata('phone');


  if($id!="" && $reg_id!=""){

        $data_res=$this -> db -> where('id', $id);
        $data_res=$this -> db -> where('reg_id', $reg_id);
        $data_res= $this-> db ->get('aparajita_detail'); 
        $apl_data=$data_res->result();


        $dou=$apl_data[0]->company_incorporation_date;
        $company_incorporation_date_for_preview = date( 'd-m-Y', strtotime( $dou ) );

        $dob=$apl_data[0]->dob;
         $new_dob_for_preview = date( 'd-m-Y', strtotime( $dob ) );

  }else{
    $this->session->set_flashdata('error_msg','Invalid Login! Please Login Now');
    redirect('Registration/logout', 'refresh');
  }
?>
<form id="msform" action="<?php echo base_url(); ?>Registration/final_submit"  method="POST" enctype="multipart/form-data">
                                 <fieldset>
                                          <!-- important1 --><input type="hidden" class="form-control" name="appl_id" value="<?php echo $apl_data[0]->id; ?>" readonly>                                     
                                          <!-- important3 --><input type="hidden" class="form-control" name="reg_id" value="<?php echo $apl_data[0]->reg_id; ?>" readonly>                             
                                          <!-- important4 --><input type="hidden" class="form-control"name="name" value="<?php echo $apl_data[0]->name; ?>" readonly>
                                          <!-- important2 --><input type="hidden" class="form-control" name="email" value="<?php echo $apl_data[0]->email; ?>" readonly>
                                          <!-- important2 --><input type="hidden" class="form-control" name="phone" value="<?php echo $apl_data[0]->phone; ?>" readonly>


                                    <div class="form-card">
                                        
                                        <div class>

                                            <div class="col-12" style="padding: 10px;border: 2px solid grey;width: 100%;height: 300px;align-content: center;align-items: center;align-self: center;">
                                                <div class="col-12 text-center">
                                                    <img src="<?php echo base_url(); ?>assets/img/tick5.webp" width="100" height="100">

                                                </div>

                                                <h2 class="col-12 text-center" style="text-align:center;margin-top: 20px;">Thank you for registration</h2>
                                                <h5 class="col-12 text-center" style="text-align:center;margin-top: 20px;">
                                                <?php 
                                                    if ($this->session->flashdata('confirm_msg') != ''): 

                                                        echo $this->session->flashdata('confirm_msg'); 
                                                        
                                                    endif;
                                                ?></h5>

                                            </div>
                                            <div class="row mb-2" id="divToPrint" style="display:none;">
                                                <div class="col-12 col-md-6 col-lg-4 text-center " id="printLogo123"
                                                    style="display: none; text-align: center;">
                                                    <img src="https://aparajita.sanmarg.in/assets/images/Aparajita_Logo_Unit_2021_White.png"
                                                        width="300px" style="margin:0px auto ; " alt>
                                                </div>
                                                <div class="col-12">
                                                    <p class="mb-0" id></p>
                                                    <table border
                                                        style="border-collapse: collapse; width: 100%; margin-bottom: 10px;"
                                                        class="table table-responsive">
                                                        <thead style="background: #ea4d55;text-align: left;">
                                                            <tr>
                                                                <th>Introduction</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Name</td>
                                                                <td id="text_guest_name"><?php echo $apl_data[0]->name; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Email</td>
                                                                <td id="text_guest_email"><?php echo $apl_data[0]->email; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Phone No.</td>
                                                                <td id="text_guest_phone"><?php echo $apl_data[0]->phone; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <!-- `category`, `you_shine`, `shine_five`, `shine_fifteen`, `org_name`, `current_profile`, `designation`, `is_incorporated`, `company_incorporation_date`, `year_experience`, `digital_presence`,   -->

                                                <div class="col-12 mt-3">
                                                    <p class="mb-0"></p>
                                                    <table border
                                                        style="border-collapse: collapse; width: 100%; margin-bottom: 10px;"
                                                        class="table table-responsive">
                                                        <thead style="background: #ea4d55;text-align: left;">
                                                            <tr>
                                                                <th>Category</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Category</td>
                                                                <td id="text_category"><?php echo $apl_data[0]->category; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Years of Experience</td>
                                                                <td id="text_you_shine"><?php echo $apl_data[0]->you_shine; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>


                                                 <div class="col-12 mt-3">
                                                    <table border
                                                        style="border-collapse: collapse; width: 100%; margin-bottom: 10px;"
                                                        class="table table-responsive">
                                                        <thead style="background: #ea4d55;text-align: left;">
                                                            <tr>
                                                                <th>Applicant's Details</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Applicant's Name</td>
                                                                <td id="text_applicant_name"><?php echo $apl_data[0]->applicant_name; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Date of Birth</td>
                                                                <td id="text_dob"><?php echo $new_dob_for_preview; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Applicant’s Mobile Number</td>
                                                                <td id="text_mobile"><?php echo $apl_data[0]->mobile; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Applicant’s Email ID</td>
                                                                <td id="text_email_id"><?php echo $apl_data[0]->email_id; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Linkedin Profile Link</td>
                                                                <td id="text_linkedin_profile"><a href="<?php echo $apl_data[0]->linkedin_profile; ?>" target="_blank"><?php echo $apl_data[0]->linkedin_profile; ?></td>
                                                            </tr>

                                                             <tr>
                                                                <td>Alternate Contact's Name</td>
                                                                <td id="text_applicant_name"><?php echo $apl_data[0]->alternate_contact_name; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Alternate Contact's Phone Number</td>
                                                                <td id="text_dob"><?php echo $apl_data[0]->alternate_contact; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Their relationship to you</td>
                                                                <td id="text_mobile"><?php echo $apl_data[0]->alternate_contact_relationship; ?></td>
                                                            </tr>
                                                            <?php if($apl_data[0]->alternate_contact_relationship=='Other') { ?>
                                                                <tr>
                                                                    <td>Specified relationship to you</td>
                                                                    <td id="text_mobile"><?php echo $apl_data[0]->specify_reltion; ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                            <!-- `alternate_contact_name`, `alternate_contact`, `alternate_contact_relationship`, `specify_reltion` -->


                                                            <tr>
                                                                <td>Write a brief bio about your role and the work you
                                                                    do and why it excites you.</td>
                                                                <td id="text_your_role"><?php echo $apl_data[0]->your_role; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>If you feel like you could articulate your ideas and
                                                                    your response better in the form of a video, feel
                                                                    free to do that too!</td>
                                                                <td id="text_bio_video"><a target="_blank" href="<?php echo base_url(); ?>document_uploads/<?php echo $apl_data[0]->reg_id; ?>/bio_video/<?php echo $apl_data[0]->bio_video; ?>"><?php echo $apl_data[0]->bio_video; ?></a></td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <table border
                                                        style="border-collapse: collapse; width: 100%; margin-bottom: 10px;"
                                                        class="table table-responsive">
                                                        <thead style="background: #ea4d55;text-align: left;">
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
                                                                <td id="text_past_organization_name1"><?php echo $apl_data[0]->past_organization_name1; ?></td>
                                                                <td id="text_past_experience1"><?php echo $apl_data[0]->past_experience1; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td id="text_past_organization_name2"><?php echo $apl_data[0]->past_organization_name2; ?></td>
                                                                <td id="text_past_experience2"><?php echo $apl_data[0]->past_experience2; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td id="text_past_organization_name3"><?php echo $apl_data[0]->past_organization_name3; ?></td>
                                                                <td id="text_past_experience3"><?php echo $apl_data[0]->past_experience3; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="col-12 mt-3">
                                                    <table border
                                                        style="border-collapse: collapse; width: 100%; margin-bottom: 10px;"
                                                        class="table table-responsive">
                                                        <thead style="background: #ea4d55;text-align: left;">
                                                            <tr>
                                                                <th>Educational Background</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Name of Institution</td>
                                                                <td id="text_applicant_name"><?php echo $apl_data[0]->school_name; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>City</td>
                                                                <td id="text_dob"><?php echo $apl_data[0]->school_city; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Name of Programme Completed</td>
                                                                <td id="text_mobile"><?php echo $apl_data[0]->school_programme; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Significant Honours Received (If Any)</td>
                                                                <td id="text_email_id"><a href="<?php echo base_url(); ?>document_uploads/<?php echo $apl_data[0]->reg_id; ?>/school_certificate/<?php echo $apl_data[0]->school_certificate; ?>" target="_blank"><?php echo $apl_data[0]->school_certificate; ?></a></td>
                                                            </tr>
                                                            <?php if($apl_data[0]->another_institute=='1'){ ?>
                                                                <tr>
                                                                    <td>Another Name of Institution</td>
                                                                    <td id="text_applicant_name"><?php echo $apl_data[0]->college_name; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>City</td>
                                                                    <td id="text_dob"><?php echo $apl_data[0]->college_city; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Name of Programme Completed</td>
                                                                    <td id="text_mobile"><?php echo $apl_data[0]->college_programme; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Significant Honours Received (If Any)</td>
                                                                    <td id="text_email_id"><a href="<?php echo base_url(); ?>document_uploads/<?php echo $apl_data[0]->reg_id; ?>/college_certificate/<?php echo $apl_data[0]->college_certificate; ?>" target="_blank"><?php echo $apl_data[0]->college_certificate; ?></a></td>
                                                                </tr>
                                                            <?php } ?>

                                                            <?php if($apl_data[0]->third_institute=='1'){ ?>
                                                                <tr>
                                                                    <td>Another Name of Institution</td>
                                                                    <td id="text_applicant_name"><?php echo $apl_data[0]->third_institute_name; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>City</td>
                                                                    <td id="text_dob"><?php echo $apl_data[0]->third_institute_city; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Name of Programme Completed</td>
                                                                    <td id="text_mobile"><?php echo $apl_data[0]->third_institute_programe; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Significant Honours Received (If Any)</td>
                                                                    <td id="text_email_id"><a href="<?php echo base_url(); ?>document_uploads/<?php echo $apl_data[0]->reg_id; ?>/third_institute_certificate/<?php echo $apl_data[0]->third_institute_certificate; ?>" target="_blank"><?php echo $apl_data[0]->third_institute_certificate; ?></a></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="col-12 mt-3">
                                                    <table border
                                                        style="border-collapse: collapse; width: 100%; margin-bottom: 10px;"
                                                        class="table table-responsive">
                                                        <thead style="background: #ea4d55;text-align: left;">
                                                            <tr>
                                                                <th>Organization Details</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Organization's Name </td>
                                                                <td id="text_org_name"><?php echo $apl_data[0]->org_name; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Your Designation and Department</td>
                                                                <td id="text_designation"><?php echo $apl_data[0]->designation; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Type of Organization</td>
                                                                <td id="text_company_incorporation_is"><?php echo $apl_data[0]->is_incorporated; ?></td>
                                                            </tr>

                                                            <?php  if($apl_data[0]->specified_org_type!=""){ ?>


                                                             <tr>
                                                                <td>Specified Type of the Organization</td>
                                                                <td id="text_company_incorporation_is"><?php echo $apl_data[0]->specified_org_type; ?></td>
                                                            </tr>

                                                            <?php } ?>


                                                            <tr>
                                                                <td>Date of Formation</td>
                                                                <td id="text_company_incorporation_date"><?php echo $company_incorporation_date_for_preview; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Organization Contact Number</td>
                                                                <td id="text_company_incorporation_date"><?php echo $apl_data[0]->org_contactno; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Total Years of Work Experience as on March 31 of the Current Year
                                                                </td>
                                                                <td id="text_year_experience"><?php echo $apl_data[0]->year_experience; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Address</td>
                                                                <td id="text_org_address"><?php echo $apl_data[0]->org_address; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>City</td>
                                                                <td id="text_org_city"><?php echo $apl_data[0]->org_city; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>State</td>
                                                                <td id="text_org_state"><?php echo $apl_data[0]->org_state; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Pin Code</td>
                                                                <td id="text_org_pin"><?php echo $apl_data[0]->org_pin; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Email ID</td>
                                                                <td id="text_org_email"><?php echo $apl_data[0]->org_email; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Organization’s Linkedin Page</td>
                                                                <td><a href="<?php echo $apl_data[0]->digital_presence_linkedin; ?>" target="_blank">
                                                                    <?php echo $apl_data[0]->digital_presence_linkedin; ?>
                                                                        
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Organization’s Facebook Page</td>
                                                                <td><a href="<?php echo $apl_data[0]->digital_presence_facebook; ?>" target="_blank">
                                                                    <?php echo $apl_data[0]->digital_presence_facebook; ?>
                                                                        
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Organization’s Twitter Page</td>
                                                                <td><a href="<?php echo $apl_data[0]->digital_presence_twitter; ?>" target="_blank">
                                                                    <?php echo $apl_data[0]->digital_presence_twitter; ?>
                                                                        
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Organization’s Instagram Page</td>
                                                                <td><a href="<?php echo $apl_data[0]->digital_presence_instagram; ?>" target="_blank">
                                                                    <?php echo $apl_data[0]->digital_presence_instagram; ?>
                                                                        
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Organization’s Official Website</td>
                                                                <td id="text_org_website"><a href="<?php echo $apl_data[0]->org_website; ?>" target="_blank">
                                                                    <?php echo $apl_data[0]->org_website; ?>
                                                                        
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <!-- `org_address`, `org_city`, `org_state`, `org_pin`, `org_email`, `org_contactno`, `org_website`, `applicant_name`, `digital_presence_instagram`, `digital_presence_twitter`, `digital_presence_facebook`, `digital_presence_linkedin`,`dob`, `mobile`, `email_id`, `social_media`, `linkedin_profile`, `your_role`, `bio_video`,  -->


                                               

                                                <!-- `past_organization_name1`, `past_experience1`, `past_organization_name2`, `past_experience2`, `past_organization_name3`, `past_experience3`, `your_thoughts`, `womans_crown`, `how_aparajita`,  -->

                                                <div class="col-12 mt-3">
                                                    <table border
                                                        style="border-collapse: collapse; width: 100%; margin-bottom: 10px;"
                                                        class="table table-responsive">
                                                        <thead style="background: #ea4d55;text-align: left;">
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
                                                                <td id="text_your_thoughts"><?php echo $apl_data[0]->your_thoughts; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>2. As an institution and a community, we strongly
                                                                    believe in the importance of women supporting other
                                                                    women, especially when we are surrounded by systems
                                                                    and societies that are not designed for us. How have
                                                                    you supported or encouraged the women around you?
                                                                </td>
                                                                <td id="text_womans_crown"><?php echo $apl_data[0]->womans_crown; ?></td>
                                                            </tr>

                                                            <tr>
                                                                <td>3A.A social organisation or NGO that you support</td>
                                                                <td id="text_your_thoughts"><?php echo $apl_data[0]->social_org; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>3B.The cause it furthers</td>
                                                                <td id="text_your_thoughts"><?php echo $apl_data[0]->cause_furthers; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>3C.Organisation's contact</td>
                                                                <td id="text_your_thoughts"><?php echo $apl_data[0]->org_contact; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>3D.Other details</td>
                                                                <td id="text_your_thoughts"><?php echo $apl_data[0]->social_other; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <table border
                                                        style="border-collapse: collapse; width: 100%; margin-bottom: 10px;"
                                                        class="table table-responsive">
                                                        <thead style="background: #ea4d55;text-align: left;">
                                                            <tr>
                                                                <th>Documents to be Uploaded</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <!-- `support_entry`, `summarizing_work`, `awards_recognition`, `company_incorporation_certificate`, `letter_from_organization` -->
                                                        <tbody>
                                                            <tr>
                                                                <td>A high-resolution passport-sized photo that is not
                                                                    older than a year</td>
                                                                <td id="text_support_entry"><a target="_blank" href="<?php echo base_url(); ?>document_uploads/<?php echo $apl_data[0]->reg_id; ?>/support_entry/<?php echo $apl_data[0]->support_entry; ?>"><?php echo $apl_data[0]->support_entry; ?></a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Please list any significant awards or honours you’ve
                                                                    received</td>
                                                                <td id="text_awards_recognition"><a target="_blank" href="<?php echo base_url(); ?>document_uploads/<?php echo $apl_data[0]->reg_id; ?>/awards_recognition/<?php echo $apl_data[0]->awards_recognition; ?>"><?php echo $apl_data[0]->awards_recognition; ?></a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Letter from the organization stating your duration
                                                                    and designation</td>
                                                                <td id="text_letter_from_organization"><a target="_blank" href="<?php echo base_url(); ?>document_uploads/<?php echo $apl_data[0]->reg_id; ?>/letter_from_organization/<?php echo $apl_data[0]->letter_from_organization; ?>"><?php echo $apl_data[0]->letter_from_organization; ?></a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Your uploaded digital Signature</td>
                                                                <td id="signature"><a target="_blank" href="<?php echo base_url(); ?>document_uploads/<?php echo $apl_data[0]->reg_id; ?>/signature/<?php echo $apl_data[0]->signature; ?>"><?php echo $apl_data[0]->signature; ?></a></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        
                                        </div>
                                       <div class="logoSlider">
            <ul class="ps-0 d-flex align-items-center id_ListOfLi">
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/aaaDHOOT Logo.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/bbbBMD.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/cccBengal Energy.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/dddKutchina New logo.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/eeeMINU MOR  FINAL A.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/fffgolden Goenka.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/gggPackman outdoors and advertisment.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/hhhmb _ associates.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/iiiE _ Y.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/jjjsanmarg foundation.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/kkkJW Marriott (white).png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/lllaircom_logo.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/mmmsanmarg.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/nnn91.9 Fm.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/oooflutter wave.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/pppcreative grains.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/qqqSHE.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/rrrgokul vatika final logo.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/ssssan entertainment.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/tttSaviles logo.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/uuuprint factory.png"></li>


            </ul>
            <ul class="ps-0 d-flex align-items-center id_ListOfLi">
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/aaaDHOOT Logo.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/bbbBMD.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/cccBengal Energy.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/dddKutchina New logo.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/eeeMINU MOR  FINAL A.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/fffgolden Goenka.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/gggPackman outdoors and advertisment.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/hhhmb _ associates.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/iiiE _ Y.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/jjjsanmarg foundation.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/kkkJW Marriott (white).png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/lllaircom_logo.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/mmmsanmarg.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/nnn91.9 Fm.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/oooflutter wave.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/pppcreative grains.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/qqqSHE.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/rrrgokul vatika final logo.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/ssssan entertainment.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/tttSaviles logo.png"></li>
              <li><img src="<?php echo base_url(); ?>assets/sponsors-logo/uuuprint factory.png"></li>
            </ul>
        </div>
                                    </div>

                                    <div class="col-md-12 text-center">
                                    
                                        <a href="<?php echo base_url();?>Registration/logout" type="button" id="print-form" class="action-button btn" style="margin-top: 5px;padding-top: 5px;width: 200px !important;">Close Registration</a>

                                        <?php if($apl_data[0]->step1==true && $apl_data[0]->step2==true && $apl_data[0]->step3==true && $apl_data[0]->step4==true && $apl_data[0]->step5==true && $apl_data[0]->step6==true && $apl_data[0]->step7==true) { ?>
                                             <button type="button" id="print-form" class="action-button" style="width: 200px !important;"  onclick="PrintDiv();">Print Registration</button>

                                        <?php } ?>
                                    </div>
                                </fieldset>
                            </form>
                            
    