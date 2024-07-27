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


         $dob=$apl_data[0]->dob;
         $new_dob = date( 'd-m-Y', strtotime( $dob ) );

  }else{
    $this->session->set_flashdata('error_msg','Invalid Login! Please Login Now');
    redirect('Registration/logout', 'refresh');
  }
?>
<form id="msform" action="<?php echo base_url(); ?>Registration/step3_submit"  method="POST" enctype="multipart/form-data">
                                 <fieldset>
                                    

                                          <!-- important1 --><input type="hidden" class="form-control" name="appl_id" value="<?php echo $apl_data[0]->id; ?>" readonly>                                     
                                          <!-- important3 --><input type="hidden" class="form-control" name="reg_id" value="<?php echo $apl_data[0]->reg_id; ?>" readonly>                             
                                          <!-- important4 --><input type="hidden" class="form-control"name="name" value="<?php echo $apl_data[0]->name; ?>" readonly>
                                          <!-- important2 --><input type="hidden" class="form-control" name="email" value="<?php echo $apl_data[0]->email; ?>" readonly>
                                          <!-- important2 --><input type="hidden" class="form-control" name="phone" value="<?php echo $apl_data[0]->phone; ?>" readonly>


                                    <div class="form-card">
                                        <h2 class="fs-title text-center">Applicant's Information</h2>
                                        <div class="row">
                                            <div class="col-12 ">
                                                <label for class="form-label margin_label">Applicant's Name<span
                                                        class="text-danger">*</span></label>
                                                <span class="text-danger d-none error-span"
                                                    id="error_applicant-name">Name is not set.</span>
                                                <input type="text" class="form-control allow-only-alphabet-name"
                                                    name="applicant_name" id="applicant-name"  maxlength="100"
                                                    oninput="this.value = this.value.replace(/[^a-zA-z. ]/g, '');" value="<?php echo $apl_data[0]->applicant_name; ?>">
                                                    <span class="text-danger error-span"><?php echo form_error('applicant_name'); ?></span>

                                            </div>
                                            <div class="col-12 ">
                                                <label for class="form-label margin_label">Date of Birth<span
                                                        class="text-danger">*</span></label>
                                                <span class="text-danger d-none error-span" id="error_dob">Dob is not
                                                    set.</span>
                                                <input type="text" class="form-control" name="dob" id="dob"
                                                    Placeholder="dd-mm-yyyy" value="<?php echo $new_dob; ?>" readonly>
                                                    <span class="text-danger error-span" readonly><?php echo form_error('dob'); ?></span>

                                            </div>
                                            <div class="col-12 ">
                                                <label for class="form-label margin_label">Applicant’s Mobile Number<span
                                                        class="text-danger">*</span></label>
                                                <span class="text-danger d-none error-span" id="error_mobile">Mobile is
                                                    not set.</span>
                                                <input type="tel" maxlength="10" class="form-control" name="mobile"
                                                    id="mobile" 
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1').replace(/(\.\d\d)\d/g, '$1');" value="<?php echo $apl_data[0]->mobile; ?>">
                                                    <span class="text-danger error-span"><?php echo form_error('mobile'); ?></span>


                                            </div>
                                            <div class="col-12">
                                                <label for class="form-label margin_label">Applicant’s E-mail ID<span
                                                        class="text-danger">*</span></label>
                                                <span class="text-danger d-none error-span" id="error_email-id">Email is
                                                    not set.</span>
                                                <input type="text" class="form-control" name="email_id" id="email-id"
                                                     maxlength="100" value="<?php echo $apl_data[0]->email_id; ?>">
                                                    <span class="text-danger error-span"><?php echo form_error('email_id'); ?></span>


                                            </div>

                                            <!-- `applicant_name`, `dob`, `mobile`, `email_id`, `social_media`, `linkedin_profile`, `your_role`, `bio_video`, `past_organization_name`, `past_experience`, -->

                                            <div class="col-12 ">
                                                <label for class="form-label margin_label">LinkedIn Profile Link</label>
                                                <span class="text-danger d-none error-span"
                                                    id="error_linkedin-profile">Invalid linkedIn profile link.</span>
                                                <input type="text" class="form-control " name="linkedin_profile"
                                                    id="linkedin-profile"  maxlength="100" value="<?php echo $apl_data[0]->linkedin_profile; ?>">
                                                    <span class="text-danger error-span"><?php echo form_error('linkedin_profile'); ?></span>

                                            </div>


                                            <h2 class="fs-title text-center">In case we cannot reach you, please provide an alternate contact</h2>
                                            

                                            <div class="form-group mb-2">
                                                <label for="name" class="form-label margin_label">Alternate Contact's Name</label><span
                                                    class="text-danger">*</span>

                                                
                                                <input type="text" name="alternate_contact_name" id="alternate_contact_name" class="form-control"value="<?php echo $apl_data[0]->alternate_contact_name; ?>" maxlength="100" oninput="this.value = this.value.replace(/[^a-zA-z. ]/g, '');">
                                                     <span class="text-danger error-span"><?php echo form_error('alternate_contact_name'); ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="form-label margin_label">Alternate Contact's Phone Number</label><span class="text-danger">*</span>

                                                
                                                 <input type="tel" maxlength="10" name="alternate_contact" id="alternate_contact" value="<?php echo $apl_data[0]->alternate_contact; ?>" class="form-control" 
                                                 oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1').replace(/(\.\d\d)\d/g, '$1');">
                                                    <span class="text-danger error-span"><?php echo form_error('alternate_contact'); ?></span>
                                            </div>


                                            <div>
                                                <label for class="form-label margin_label">Their Relationship to You<span
                                                    class="text-danger">*</span></label>

                                                <select onfocus="this.size=8;" onblur="this.size=0;"
                                                    onchange="this.size=1; this.blur();" class="form-select mb-4"
                                                    id="alternate_contact_relationship" name="alternate_contact_relationship">
                                                    <option <?php print  ($apl_data[0]->alternate_contact_relationship == '') ? "selected" : ""; ?> value="">Choose</option>
                                                    <option <?php print  ($apl_data[0]->alternate_contact_relationship == 'Parent') ? "selected" : ""; ?> value="Parent">Parent</option>
                                                    <option <?php print  ($apl_data[0]->alternate_contact_relationship == 'Child') ? "selected" : ""; ?> value="Child">Child</option>
                                                    <option <?php print  ($apl_data[0]->alternate_contact_relationship == 'Spouse') ? "selected" : ""; ?> value="Spouse">Spouse</option>
                                                    <option <?php print  ($apl_data[0]->alternate_contact_relationship == 'Family Member') ? "selected" : ""; ?> value="Family Member">Family Member</option>
                                                    <option <?php print  ($apl_data[0]->alternate_contact_relationship == 'Friend') ? "selected" : ""; ?> value="Friend">Friend</option>
                                                    <option <?php print  ($apl_data[0]->alternate_contact_relationship == 'Co-Worker') ? "selected" : ""; ?> value="Co-Worker">Co-Worker</option>
                                                    <option <?php print  ($apl_data[0]->alternate_contact_relationship == 'Other') ? "selected" : ""; ?> value="Other">Other</option>
                                                    
                                                </select>
                                                <span class="text-danger error-span"><?php echo form_error('alternate_contact_relationship'); ?></span>
                                                <div class="invalid-feedback">
                                                    Input required
                                                </div>
                                            </div>

                                           

                                            <div class="form-group" id="specify_reltion_div" style="display: none;">
                                                <label for="name" class="form-label margin_label">Please Specify Relationship to You</label><span class="text-danger">*</span>

                                                
                                                 <input type="text" name="specify_reltion" id="specify_reltion" value="<?php echo $apl_data[0]->specify_reltion; ?>" class="form-control" 
                                                 oninput="this.value = this.value.replace(/[^a-zA-z. ]/g, '');">
                                                    <span class="text-danger error-span"><?php echo form_error('specify_reltion'); ?></span>
                                            </div>
                                           

                                                
                                            




                                            <div class="col-12 ">
                                                <label for class="form-label margin_label">Write a brief bio about your role and the
                                                    work you do and why it excites you. Feel free to include any
                                                    initiatives you’ve headed or ideated that you’re particularly proud
                                                    of or how you feel like you’ve carved a niche for yourself. We want
                                                    to know more about your work- from your lens, not the
                                                    world’s. <span style="font-size: 14px;">(Word Limit- 200
                                                                words)</span><span
                                                        class="text-danger">*</span></label>
                                                <textarea class="form-control" name="your_role" id="your-role" cols="30"
                                                    rows="3"  maxlength="1200"><?php echo $apl_data[0]->your_role; ?></textarea>
                                                    <span class="text-danger error-span"><?php echo form_error('your_role'); ?></span>
                                            </div>
                                            <div class="col-12 ">
                                                <label for class="form-label margin_label">If you feel like you could articulate your
                                                    ideas and your response better in the form of a video, feel free to
                                                    do that too! <span style="font-size: 14px;">(Format - Mp4, Max size
                                                        - 10 MB)</span></label>
                                                <span class="text-danger d-none error-span" id="error_bio-video">Invalid
                                                    video format.</span>
                                                <input type="file" class="form-control submit-enable" name="bio_video"
                                                    id="bio-video">
                                                <input type="text" value="<?php echo $apl_data[0]->bio_video; ?>" class="file_file" name="bio_video_name" id="bio_video_name" readonly>

                                                    <span class="text-danger error-span"><?php echo form_error('bio_video'); ?></span>
                                            </div>
                                            <div class="col-12 col-md-12 col-lg-12">

                                                <h2 class="fs-title mb-3 text-center">Past Companies Worked With (If
                                                    Any)</h2>
                                                <div class="row">
                                                    <div class="col-12 col-md-6 col-lg-6">
                                                        <label for class="form-label margin_label">Name of the Organization</label>
                                                        <input type="text" name="past_organization_name1"
                                                            id="past-organization-name1" class="form-control"
                                                            maxlength="100" value="<?php echo $apl_data[0]->past_organization_name1; ?>">
                                                            <span class="text-danger error-span"><?php echo form_error('past_organization_name1'); ?></span>
                                                    </div>
                                                    <div class="col-12 col-md-6 col-lg-6">
                                                        <label for class="form-label margin_label">Years of Association with the Organization</label>
                                                        <input type="text" min="0" name="past_experience1"
                                                            id="past-experience1" class="form-control allow-only-number"
                                                            maxlength="2"
                                                            oninput="this.value = this.value.replace(/[^0-9]/g, '');" value="<?php echo $apl_data[0]->past_experience1; ?>">
                                                            <span class="text-danger error-span"><?php echo form_error('past_experience1'); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="row">
                                                    <div class="col-12 col-md-6 col-lg-6">
                                                        <label for class="form-label margin_label">Name of the Organization</label>
                                                        <input type="text" name="past_organization_name2"
                                                            id="past-organization-name2" class="form-control"
                                                            maxlength="100" value="<?php echo $apl_data[0]->past_organization_name2; ?>">
                                                            <span class="text-danger error-span"><?php echo form_error('past_organization_name2'); ?></span>
                                                    </div>
                                                    <div class="col-12 col-md-6 col-lg-6">
                                                        <label for class="form-label margin_label">Years of Association with the Organization</label>
                                                        <input type="text" min="0" name="past_experience2"
                                                            id="past-experience2" class="form-control allow-only-number"
                                                            maxlength="2"
                                                            oninput="this.value = this.value.replace(/[^0-9]/g, '');" value="<?php echo $apl_data[0]->past_experience2; ?>">
                                                            <span class="text-danger error-span"><?php echo form_error('past_experience2'); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="row">
                                                    <div class="col-12 col-md-6 col-lg-6">
                                                        <label for class="form-label margin_label">Name of the Organization</label>
                                                        <input type="text" name="past_organization_name3"
                                                            id="past-organization-name3" class="form-control"
                                                            maxlength="100" value="<?php echo $apl_data[0]->past_organization_name3; ?>">
                                                            <span class="text-danger error-span"><?php echo form_error('past_organization_name3'); ?></span>
                                                    </div>
                                                    <div class="col-12 col-md-6 col-lg-6">
                                                        <label for class="form-label margin_label">Years of Association with the Organization</label>
                                                        <input type="text" min="0" name="past_experience3"
                                                            id="past-experience3" class="form-control allow-only-number"
                                                            maxlength="2"
                                                            oninput="this.value = this.value.replace(/[^0-9]/g, '');" value="<?php echo $apl_data[0]->past_experience3; ?>">
                                                            <span class="text-danger error-span"><?php echo form_error('past_experience3'); ?></span>
                                                    </div>
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
                                        class="previous action-button-previous" id="step3_prev" />
                                    <input type="submit" value="Save & Next" name="step3_submit"
                                        class="next action-button applicant-details" id="step3_submit" />
                                </fieldset>
                            </form>