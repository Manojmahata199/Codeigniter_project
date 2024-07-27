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
         
         

  }else{
    $this->session->set_flashdata('error_msg','Invalid Login! Please Login Now');
    redirect('Registration/logout', 'refresh');
  }
?>
<form id="msform" action="<?php echo base_url(); ?>Registration/step4_submit"  method="POST" enctype="multipart/form-data">
                                  <fieldset>
                                      <!-- important1 --><input type="hidden" class="form-control" name="appl_id" id="appl_id" value="<?php echo $apl_data[0]->id; ?>" readonly>                                  
                                      <!-- important3 --><input type="hidden" class="form-control" name="reg_id" id="reg_id" value="<?php echo $apl_data[0]->reg_id; ?>" readonly>                             
                                      <!-- important4 --><input type="hidden" class="form-control"name="name" id="name" value="<?php echo $apl_data[0]->name; ?>" readonly>
                                      <!-- important2 --><input type="hidden" class="form-control" name="email" id="email" value="<?php echo $apl_data[0]->email; ?>" readonly>
                                      <!-- important2 --><input type="hidden" class="form-control" name="phone" id="phone" value="<?php echo $apl_data[0]->phone; ?>" readonly>
                                      <!-- important2 --><input type="hidden" class="form-control" name="another_institute" id="another_institute" value="<?php echo $apl_data[0]->another_institute; ?>" readonly>
                                      <!-- important2 --><input type="hidden" class="form-control" name="third_institute" id="third_institute" value="<?php echo $apl_data[0]->third_institute; ?>" readonly>



                                    <div class="form-card">
                                        <h2 class="fs-title text-center" id="edu_det">Your Educational Background</h2>
                                        <p class="text-center mt-0 form-label" style="font-size: 16px;">Please state the most recent qualification first</p>
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                

                                                <div>
                                                    <label for class="form-label margin_label">Name of Institution <span
                                                            style="font-size: 14px;">(eg. School, University, etc.)</span><span class="text-danger">*</span></label>
                                                    <span class="text-danger d-none error-span"
                                                        id="error_org-name"></span>

                                                    <input class="form-control" type="text" name="school_name"
                                                        id="school_name"  maxlength="100" value="<?php echo $apl_data[0]->school_name; ?>">
                                                        <span class="text-danger error-span"><?php echo form_error('school_name'); ?></span>
                                                    <div class="invalid-feedback">
                                                        Input required
                                                    </div>
                                                </div>

                                                <div>
                                                    <label for class="form-label margin_label">City<span
                                                            class="text-danger">*</span></label>
                                                    <span class="text-danger d-none error-span"
                                                        id="error_designation"></span>

                                                    <input class="form-control" type="text" name="school_city"
                                                        id="school_city"  maxlength="255" value="<?php echo $apl_data[0]->school_city; ?>">
                                                        <span class="text-danger error-span"><?php echo form_error('school_city'); ?></span>

                                                </div>

                                                <div>
                                                    <label for class="form-label margin_label">Name of Programme Completed <span
                                                            style="font-size: 14px;">(eg. High School Diploma, Bachelor of Science in Mechanical Engineering, etc.)
                                                        </span><span
                                                            class="text-danger">*</span>
                                                        </label>
                                                    <span class="text-danger d-none error-span"
                                                        id="error_designation"></span>

                                                    <input class="form-control" type="text" name="school_programme"
                                                        id="school_programme"  maxlength="255" value="<?php echo $apl_data[0]->school_programme; ?>">
                                                        <span class="text-danger error-span"><?php echo form_error('school_programme'); ?></span>

                                                </div>

                                                
                                                <div>
                                                    <label for class="form-label margin_label">
                                                        Significant Honours Received (If Any) <span
                                                            style="font-size: 14px;">(Format: jpg, jpeg, pdf or png only, Max size - 5 MB)</span>
                                                    </label>
                                                    <span class="text-danger d-none error-span"
                                                        id="error_letter-from-organization"></span>
                                                    <input type="file" class="form-control submit-enable"
                                                        name="school_certificate" id="school_certificate">
                                                        <input type="text" class="file_file" name="school_certificate_name" id="school_certificate_name" value="<?php echo $apl_data[0]->school_certificate; ?>" readonly>
                                                        <span class="text-danger error-span"><?php echo form_error('school_certificate'); ?></span>
                                                </div>
                                                <hr>
                                                <?php if($apl_data[0]->another_institute!="1"){ ?>  
                                                    
                                                    <input type="submit" value="Add Another" name="step4_add1_submit" class="btn  text-center text-light py-2 px-4" style="background-color:#c8c9d2e8;font-weight: bold;margin-top: 10px;margin-bottom: 10px;" id="step4_add1_submit" />
                                                    
                                                    
                                                <?php } ?> 

                                            </div>

                                            

                                            <?php if($apl_data[0]->another_institute=="1"){ ?>    
                                            <div class="col-12 col-md-12 col-lg-12" id="add_another_institute">
                                                <?php if($apl_data[0]->another_institute=="1" && $apl_data[0]->third_institute!="1"){ ?>  

                                                    <span class="btn  text-center text-light py-2 px-4" id="close_another_btn" style="background-color:#c8c9d2e8;font-weight: bold;margin-top: 10px;margin-bottom: 10px;"><i class="fa fa-close mx-3"></i>Close</span>

                                                       
                                                <?php } ?>
                                                

                                                <div>
                                                    <label for class="form-label margin_label">Name of Institution <span
                                                            style="font-size: 14px;">(eg. School, University, etc.)</span><span class="text-danger">*</span></label>
                                                    <span class="text-danger d-none error-span"
                                                        id="error_org-name"></span>

                                                    <input class="form-control" type="text" name="college_name"
                                                        id="college_name"  maxlength="100" value="<?php echo $apl_data[0]->college_name; ?>">
                                                        <span class="text-danger error-span"><?php echo form_error('college_name'); ?></span>
                                                    <div class="invalid-feedback">
                                                        Input required
                                                    </div>
                                                </div>

                                                <div>
                                                    <label for class="form-label margin_label">City<span class="text-danger">*</span></label>
                                                    <span class="text-danger d-none error-span"
                                                        id="error_designation"></span>

                                                    <input class="form-control" type="text" name="college_city"
                                                        id="college_city"  maxlength="255" value="<?php echo $apl_data[0]->college_city; ?>">
                                                        <span class="text-danger error-span"><?php echo form_error('college_city'); ?></span>

                                                </div>


                                                <div>
                                                    <label for class="form-label margin_label">Name of Programme Completed <span
                                                            style="font-size: 14px;">(eg. High School Diploma, Bachelor of Science in Mechanical Engineering, etc.)
                                                        </span><span class="text-danger">*</span></label>
                                                    <span class="text-danger d-none error-span"
                                                        id="error_designation"></span>

                                                    <input class="form-control" type="text" name="college_programme"
                                                        id="college_programme"  maxlength="255" value="<?php echo $apl_data[0]->college_programme; ?>">
                                                        <span class="text-danger error-span"><?php echo form_error('college_programme'); ?></span>

                                                </div>

                                                <!-- // `school_name`, `school_city`, `school_year`, `school_certificate`, `college_name`, `college_city`, `college_programme` `college_certificate` -->
                                                

                                                <div>
                                                    <label for class="form-label margin_label">
                                                        Significant Honours Received (If Any) <span
                                                            style="font-size: 14px;">(Format: jpg, jpeg, pdf or png only, Max size - 5 MB)</span>
                                                    </label>
                                                    <span class="text-danger d-none error-span"
                                                        id="error_letter-from-organization"></span>
                                                    <input type="file" class="form-control submit-enable"
                                                        name="college_certificate" id="college_certificate">
                                                        <input type="text" class="file_file" name="college_certificate_name" id="college_certificate_name" value="<?php echo $apl_data[0]->college_certificate; ?>" readonly>
                                                        <span class="text-danger error-span"><?php echo form_error('college_certificate'); ?></span>
                                                </div>
                                                <hr>
                                                <?php if($apl_data[0]->third_institute!="1"){ ?> 


                                                    <input type="submit" value="Add Another" name="step4_add2_submit" class="btn  text-center text-light py-2 px-4" style="background-color:#c8c9d2e8;font-weight: bold;margin-top: 10px;margin-bottom: 10px;" id="step4_add2_submit" />
                                                 
                                                <?php } ?>

                                                

                                            </div>
                                            <?php } ?>

                                                

                                                <?php if($apl_data[0]->third_institute=="1"){ ?>    
                                                <div class="col-12 col-md-12 col-lg-12" id="add_third_institute">
                                                     <?php if($apl_data[0]->third_institute=="1"){ ?>
                                                         <span class="btn  text-center text-light py-2 px-4" id="close_third_btn" style="background-color:#c8c9d2e8;font-weight: bold;margin-top: 10px;margin-bottom: 10px;">      <i class="fa fa-close mx-3"></i>Close</span>
                                                     <?php } ?>
                                                    

                                                    <div>
                                                        <label for class="form-label margin_label">Name of Institution <span
                                                            style="font-size: 14px;">(eg. School, University, etc.)</span><span class="text-danger">*</span></label>
                                                        <span class="text-danger d-none error-span"
                                                            id="error_org-name"></span>

                                                        <input class="form-control" type="text" name="third_institute_name"
                                                            id="third_institute_name"  maxlength="100" value="<?php echo $apl_data[0]->third_institute_name; ?>">
                                                            <span class="text-danger error-span"><?php echo form_error('third_institute_name'); ?></span>
                                                        <div class="invalid-feedback">
                                                            Input required
                                                        </div>
                                                    </div>

                                                    <div>
                                                        <label for class="form-label margin_label">City<span class="text-danger">*</span></label>
                                                        <span class="text-danger d-none error-span"
                                                            id="error_designation"></span>

                                                        <input class="form-control" type="text" name="third_institute_city"
                                                            id="third_institute_city"  maxlength="255" value="<?php echo $apl_data[0]->third_institute_city; ?>">
                                                            <span class="text-danger error-span"><?php echo form_error('third_institute_city'); ?></span>

                                                    </div>


                                                    <div>
                                                        <label for class="form-label margin_label">Name of Programme Completed <span
                                                            style="font-size: 14px;">(eg. High School Diploma, Bachelor of Science in Mechanical Engineering, etc.)
                                                        </span><span class="text-danger">*</span></label>
                                                        <span class="text-danger d-none error-span"
                                                            id="error_designation"></span>

                                                        <input class="form-control" type="text" name="third_institute_programe"
                                                            id="third_institute_programe"  maxlength="255" value="<?php echo $apl_data[0]->third_institute_programe; ?>">
                                                            <span class="text-danger error-span"><?php echo form_error('third_institute_programe'); ?></span>

                                                    </div>

                                                   <!-- `third_institute`, `third_institute_name`, `third_institute_city`, `third_institute_programe`, `third_institute_certificate` -->
                                                    

                                                    <div>
                                                        <label for class="form-label margin_label">
                                                            Significant Honours Received (If Any) <span
                                                                style="font-size: 14px;">(Format: jpg, jpeg, pdf or png only, Max size - 5 MB)</span>
                                                        </label>
                                                        <span class="text-danger d-none error-span"
                                                            id="error_letter-from-organization"></span>
                                                        <input type="file" class="form-control submit-enable"
                                                            name="third_institute_certificate" id="third_institute_certificate">
                                                            <input type="text" class="file_file" name="third_institute_certificate_name" id="third_institute_certificate_name" value="<?php echo $apl_data[0]->third_institute_certificate; ?>" readonly>
                                                            <span class="text-danger error-span"><?php echo form_error('third_institute_certificate'); ?></span>
                                                    </div>

                                                    

                                                </div>
                                                <?php } ?>
                                            
                                            
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


                                    <input type="submit" value="Previous" name="previous"
                                        class="previous action-button-previous" id="step4_prev" />
                                    <input type="submit" value="Save & Next" name="step4_submit"
                                        class="next action-button organization-details" id="step4_submit" />
                                </fieldset>
                            </form>