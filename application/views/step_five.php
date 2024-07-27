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
         $company_incorporation_date = date( 'd-m-Y', strtotime( $dou ) );
         
         

  }else{
    $this->session->set_flashdata('error_msg','Invalid Login! Please Login Now');
    redirect('Registration/logout', 'refresh');
  }
?>
<form id="msform" action="<?php echo base_url(); ?>Registration/step5_submit"  method="POST" enctype="multipart/form-data">
                                  <fieldset>
                                          <!-- important1 --><input type="hidden" class="form-control" name="appl_id" value="<?php echo $apl_data[0]->id; ?>" readonly>                                  
                                          <!-- important3 --><input type="hidden" class="form-control" name="reg_id" value="<?php echo $apl_data[0]->reg_id; ?>" readonly>                             
                                          <!-- important4 --><input type="hidden" class="form-control"name="name" value="<?php echo $apl_data[0]->name; ?>" readonly>
                                          <!-- important2 --><input type="hidden" class="form-control" name="email" value="<?php echo $apl_data[0]->email; ?>" readonly>
                                          <!-- important2 --><input type="hidden" class="form-control" name="phone" value="<?php echo $apl_data[0]->phone; ?>" readonly>



                                    <div class="form-card">
                                        <h2 class="fs-title text-center" id="org_det">Your Organization's Details</h2>
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-lg-12">

                                                <div>
                                                    <label for class="form-label margin_label">Organization's Name<span
                                                            class="text-danger">*</span></label>
                                                    <span class="text-danger d-none error-span"
                                                        id="error_org-name">Organization name is not set.</span>

                                                    <input class="form-control" type="text" name="org_name"
                                                        id="org-name"  maxlength="100" value="<?php echo $apl_data[0]->org_name; ?>">
                                                        <span class="text-danger error-span"><?php echo form_error('org_name'); ?></span>
                                                    <div class="invalid-feedback">
                                                        Input required
                                                    </div>
                                                </div>

                                                <div>
                                                    <label for class="form-label margin_label">Your Designation and Department<span
                                                            class="text-danger">*</span></label>
                                                    <span class="text-danger d-none error-span"
                                                        id="error_designation">Designation and Department is not
                                                        set.</span>

                                                    <input class="form-control" type="text" name="designation"
                                                        id="designation"  maxlength="255" value="<?php echo $apl_data[0]->designation; ?>">
                                                        <span class="text-danger error-span"><?php echo form_error('designation'); ?></span>

                                                </div>

                                                <div>
                                                    <label for class="form-label margin_label">Type of Organization<span
                                                            class="text-danger">*</span></label>

                                                    <select onfocus="this.size=8;" onblur="this.size=0;"
                                                        onchange="this.size=1; this.blur();" class="form-select mb-4"
                                                        id="company_incorporation_is" name="company_incorporation_is">
                                                        <option <?php print  ($apl_data[0]->is_incorporated == '') ? "selected" : ""; ?> value="">Choose</option>
                                                        <option <?php print  ($apl_data[0]->is_incorporated == 'Individual') ? "selected" : ""; ?> value="Individual">Individual</option>
                                                        <option <?php print  ($apl_data[0]->is_incorporated == 'Sole Proprietorship') ? "selected" : ""; ?> value="Sole Proprietorship">Sole Proprietorship</option>
                                                        <option <?php print  ($apl_data[0]->is_incorporated == 'Partnership') ? "selected" : ""; ?> value="Partnership">Partnership</option>
                                                        <option <?php print  ($apl_data[0]->is_incorporated == 'Private Limited') ? "selected" : ""; ?> value="Private Limited">Private Limited</option>
                                                        <option <?php print  ($apl_data[0]->is_incorporated == 'Limited Liability Company') ? "selected" : ""; ?> value="Limited Liability Company">Limited Liability
                                                            Company</option>
                                                        <option <?php print  ($apl_data[0]->is_incorporated == 'Limited Company') ? "selected" : ""; ?> value="Limited Company">Limited Company</option>
                                                        <option <?php print  ($apl_data[0]->is_incorporated == 'Others') ? "selected" : ""; ?> value="Others">Others</option>
                                                    </select>
                                                    <span class="text-danger error-span"><?php echo form_error('company_incorporation_is'); ?></span>
                                                    <div class="invalid-feedback">
                                                        Input required
                                                    </div>
                                                </div>

                                                

                                                <div class="form-group" id="specify_org_type_div" style="display: none;">
                                                    <label for="name" class="form-label margin_label">Please Specify the Type of Organization</label><span class="text-danger">*</span>

                                                    
                                                     <input type="text"  name="specified_org_type" id="specified_org_type" value="<?php echo $apl_data[0]->specified_org_type; ?>" class="form-control" 
                                                     oninput="this.value = this.value.replace(/[^a-zA-z. ]/g, '');">
                                                        <span class="text-danger error-span"><?php echo form_error('specified_org_type'); ?></span>
                                                </div>

                                                
                                                


                                                <div>
                                                    <label for class="form-label margin_label">Date of Formation<span
                                                            class="text-danger">*</span></label>
                                                    <span class="text-danger d-none error-span"
                                                        id="error_company-incorporation-date">Incorporation date is not
                                                        set.</span>

                                                    <input class="form-control js-datepicker"  type="text"
                                                        name="company_incorporation_date"
                                                        id="company-incorporation-date" Placeholder="dd-mm-yyyy" value="<?php echo $company_incorporation_date; ?>" readonly>
                                                        <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                                                        <span class="text-danger error-span"><?php echo form_error('company_incorporation_date'); ?></span>

                                                </div>

                                                <div>
                                                    <label for class="form-label margin_label">Total Years of Work Experience as on
                                                        March 31 of the Current Year<span class="text-danger">*</span></label>
                                                    <span class="text-danger d-none error-span"
                                                        id="error_year-experience">Years of work experience is not
                                                        set.</span>

                                                    <input class="form-control allow-only-number" type="text" min="0"
                                                        name="year_experience" id="year-experience" maxlength="2"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');" value="<?php echo $apl_data[0]->year_experience; ?>">
                                                        <span class="text-danger error-span"><?php echo form_error('year_experience'); ?></span>

                                                    <div class="invalid-feedback">
                                                        Input required
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <h2 class="fs-title text-center">Your Organization's Contact Details
                                                </h2>

                                                <div>
                                                    <label for class="form-label margin_label">Address<span
                                                            class="text-danger">*</span></label>

                                                    <textarea name="org_address" id="org-address" cols="30" rows="1"
                                                        class="form-control" ><?php echo $apl_data[0]->org_address; ?></textarea>
                                                        <span class="text-danger error-span"><?php echo form_error('org_address'); ?></span>

                                                    <div class="invalid-feedback">
                                                        Input required
                                                    </div>
                                                </div>

                                                <div>
                                                    <label for class="form-label margin_label">City<span
                                                            class="text-danger">*</span></label>

                                                    <input type="text" class="form-control" name="org_city"
                                                        id="org-city" value="<?php echo $apl_data[0]->org_city; ?>" maxlength="100">
                                                        <span class="text-danger error-span"><?php echo form_error('org_city'); ?></span>

                                                    <div class="invalid-feedback">
                                                        Input required
                                                    </div>
                                                </div>

                                                <!-- `org_name`, `current_profile`, `designation`, `is_incorporated`, `company_incorporation_date`, `year_experience`, `org_address`, `org_city`, `org_state`, `org_pin`, `org_email`, `org_contactno`, `org_website`, -->



                                                <div>
                                                    <label for class="form-label margin_label">State<span
                                                            class="text-danger">*</span></label>

                                                    <input type="text" class="form-control" name="org_state"
                                                        id="org-state" value="<?php echo $apl_data[0]->org_state; ?>" maxlength="100">
                                                        <span class="text-danger error-span"><?php echo form_error('org_state'); ?></span>

                                                    <div class="invalid-feedback">
                                                        Input required
                                                    </div>
                                                </div>

                                                <div>
                                                    <label for class="form-label margin_label">Pin Code<span
                                                            class="text-danger">*</span></label>

                                                    <input type="tel" maxlength="6" inputmode="numeric"
                                                        class="form-control allow-only-number pin-digit" name="org_pin"
                                                        id="org-pin" value="<?php echo $apl_data[0]->org_pin; ?>">
                                                        <span class="text-danger error-span"><?php echo form_error('org_pin'); ?></span>

                                                    <div class="invalid-feedback">
                                                        Input required
                                                    </div>
                                                    <span id="pin-error" style="display: none; color:red;">Please enter
                                                        6 digit</span>
                                                </div>

                                                <div>
                                                    <label for class="form-label margin_label">E-mail ID<span
                                                            class="text-danger">*</span></label>
                                                    <span class="text-danger d-none error-span"
                                                        id="error_org-email">Invalid Email ID.</span>

                                                    <input type="text" class="form-control email-pattern"
                                                        name="org_email" id="org-email"  maxlength="100" value="<?php echo $apl_data[0]->org_email; ?>">
                                                        <span class="text-danger error-span"><?php echo form_error('org_email'); ?></span>

                                                    <div class="invalid-feedback">
                                                        Input required
                                                    </div>

                                                </div>

                                                <div>
                                                    <label for class="form-label margin_label">Contact Number<span
                                                            class="text-danger">*</span></label>

                                                    <input type="tel" class="form-control" name="org_contactno"
                                                        id="org-contactno" maxlength="10"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1').replace(/(\.\d\d)\d/g, '$1');" value="<?php echo $apl_data[0]->org_contactno; ?>">
                                                        <span class="text-danger error-span"><?php echo form_error('org_contactno'); ?></span>

                                                    <div class="invalid-feedback">
                                                        Input required
                                                    </div>

                                                </div>

                                                <div class="mb-4">
                                                    
                                                    <!-- `digital_presence`, `digital_presence_instagram`, `digital_presence_twitter`, `digital_presence_facebook`, `digital_presence_linkedin`,  -->

                                                    
                                                    <label for class="form-label margin_label">Organization’s Linkedin Link</label>  
                                                    <span class="text-danger d-none error-span"
                                                        id="error_dp-linkedin">Invalid url format.</span>

                                                    <input type="text" class="form-control show_LinkedIn mb-1"
                                                        name="dp_linkedin" id="dp-linkedin"  maxlength="255"
                                                          value="<?php echo $apl_data[0]->digital_presence_linkedin; ?>">
                                                        <span class="text-danger error-span"><?php echo form_error('dp_linkedin'); ?></span>



                                                    <label for class="form-label margin_label">Organization’s Facebook Link</label>
                                                    <span class="text-danger d-none error-span"
                                                        id="error_dp-facebook">Invalid url format.</span>

                                                    <input type="text" class="form-control show_Facebook mb-1"
                                                        name="dp_facebook" id="dp-facebook"  maxlength="255"
                                                          value="<?php echo $apl_data[0]->digital_presence_facebook; ?>">
                                                        <span class="text-danger error-span"><?php echo form_error('dp_facebook'); ?></span>
                                                    
                                                    <label for class="form-label margin_label">Organization’s Twitter Link</label>
                                                    <span class="text-danger d-none error-span"
                                                        id="error_dp-twitter">Invalid url format.</span>

                                                    <input type="text" class="form-control show_Twitter mb-1"
                                                        name="dp_twitter" id="dp-twitter"  maxlength="255"
                                                          value="<?php echo $apl_data[0]->digital_presence_twitter; ?>">
                                                        <span class="text-danger error-span"><?php echo form_error('dp_twitter'); ?></span>
                                                    

                                                    <label for class="form-label margin_label">Organization’s Instagram Link</label>
                                                    <span class="text-danger d-none error-span"
                                                        id="error_dp-instagram">Invalid url format.</span>

                                                    <input type="text" class="form-control show_Instagram mb-1"
                                                        name="dp_instagram" id="dp-instagram"  maxlength="255"
                                                          value="<?php echo $apl_data[0]->digital_presence_instagram; ?>">
                                                        <span class="text-danger error-span"><?php echo form_error('dp_instagram'); ?></span>

                                                </div>

                                                <div>
                                                    <label for class="form-label margin_label">Organization’s Official
                                                        Website</label>
                                                    <span class="text-danger d-none error-span"
                                                        id="error_org-website">Invalid url format.</span>

                                                    <input type="text" class="form-control" name="org_website"
                                                        id="org-website" maxlength="255" placeholder value="<?php echo $apl_data[0]->org_website; ?>">
                                                        <span class="text-danger error-span"><?php echo form_error('org_website'); ?></span>
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


                                    <input type="submit" value="Previous" name="previous"
                                        class="previous action-button-previous" id="step5_prev" />
                                    <input type="submit" value="Save & Next" name="step5_submit"
                                        class="next action-button organization-details" id="step5_submit" />
                                </fieldset>
                            </form>