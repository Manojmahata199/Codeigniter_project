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
<form id="msform" action="<?php echo base_url(); ?>Registration/step7_submit"  method="POST" enctype="multipart/form-data">
                              <fieldset>
                                          <!-- important1 --><input type="hidden" class="form-control" name="appl_id" value="<?php echo $apl_data[0]->id; ?>" readonly>                                     
                                          <!-- important3 --><input type="hidden" class="form-control" name="reg_id" value="<?php echo $apl_data[0]->reg_id; ?>" readonly>                             
                                          <!-- important4 --><input type="hidden" class="form-control"name="name" value="<?php echo $apl_data[0]->name; ?>" readonly>
                                          <!-- important2 --><input type="hidden" class="form-control" name="email" value="<?php echo $apl_data[0]->email; ?>" readonly>
                                          <!-- important2 --><input type="hidden" class="form-control" name="phone" value="<?php echo $apl_data[0]->phone; ?>" readonly>
                                    <div class="form-card">
                                        <h2 class="fs-title text-center">Documents to be Uploaded</h2>
                                        <p class="text-center mt-0 " style="font-size: 14px;">Please attach the required
                                            documents below to substantiate your application.</p>
                                        <p class="text-center mt-0 " style="font-size: 14px;">(Maximum 5 MB per file)
                                        </p>
                                        <div class="row">
                                            <div class="col-12">
                                                <div>
                                                    <label for class="form-label margin_label">
                                                        A high-resolution passport-sized photo that is not older than a
                                                        year <span style="font-size: 14px;">(Format: jpg, jpeg, pdf or png only, Max size - 5 MB)</span><span class="text-danger">*</span>
                                                    </label>
                                                    <span class="text-danger d-none error-span"
                                                        id="error_support-entry">Upload photo</span>
                                                    <input type="file" class="form-control submit-enable"
                                                        name="support_entry" id="support-entry">
                                                        <input type="text" value="<?php echo $apl_data[0]->support_entry; ?>" class="file_file" name="support_entry_name" id="support_entry_name" readonly>
                                                        <span class="text-danger error-span"><?php echo form_error('support_entry'); ?></span>
                                                </div>
                                                <!-- `support_entry`, `summarizing_work`, `awards_recognition`, `company_incorporation_certificate`, `letter_from_organization`, -->


                                                <div>
                                                    <label for class="form-label margin_label">
                                                        Please list any significant awards or honours you’ve received
                                                        <span style="font-size: 14px;">(Format: docs, doc or docx, Max size - 5 MB)</span>
                                                    </label>
                                                    <span class="text-danger d-none error-span"
                                                        id="error_awards-recognition">Invalid File Format.</span>
                                                    <input type="file" class="form-control submit-enable"
                                                        name="awards_recognition" id="awards-recognition">
                                                        <input type="text" value="<?php echo $apl_data[0]->awards_recognition; ?>" class="file_file" name="awards_recognition_name" id="awards_recognition_name" readonly>
                                                        <span class="text-danger error-span"><?php echo form_error('awards_recognition'); ?></span>
                                                </div>


                                                <div>
                                                    <label for class="form-label margin_label">
                                                        Letter from the organization stating your duration and
                                                        designation as on March 31 of the current year <span
                                                            style="font-size: 14px;">(Format: jpg, jpeg, pdf, png, doc, docs
                                                            or docx only, Max size - 5 MB)</span>
                                                    </label>
                                                    <span class="text-danger d-none error-span"
                                                        id="error_letter-from-organization">Invalid File Format.</span>
                                                    <input type="file" class="form-control submit-enable"
                                                        name="letter_from_organization" id="letter-from-organization">
                                                        <input type="text" value="<?php echo $apl_data[0]->letter_from_organization; ?>" class="file_file" name="letter_from_organization_name" id="letter_from_organization_name" readonly>
                                                        <span class="text-danger error-span"><?php echo form_error('letter_from_organization'); ?></span>
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
                                        class="previous action-button-previous" id="step7_prev" />
                                    <input type="submit" value="Save & Next" name="step7_submit"
                                        class="next action-button uploadNextBtn" onclick="allCheckConfirm()"
                                        id="step7_submit" />


                                </fieldset>
                            </form>