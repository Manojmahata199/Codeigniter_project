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
<form id="msform" action="<?php echo base_url(); ?>Registration/step6_submit"  method="POST" enctype="multipart/form-data">
                                <fieldset>
                                    <div class="form-card">
                                          <!-- important1 --><input type="hidden" class="form-control" name="appl_id" value="<?php echo $apl_data[0]->id; ?>" readonly>                                     
                                          <!-- important3 --><input type="hidden" class="form-control" name="reg_id" value="<?php echo $apl_data[0]->reg_id; ?>" readonly>                             
                                          <!-- important4 --><input type="hidden" class="form-control"name="name" value="<?php echo $apl_data[0]->name; ?>" readonly>
                                          <!-- important2 --><input type="hidden" class="form-control" name="email" value="<?php echo $apl_data[0]->email; ?>" readonly>
                                          <!-- important2 --><input type="hidden" class="form-control" name="phone" value="<?php echo $apl_data[0]->phone; ?>" readonly>

                                        <h2 class="fs-title text-center my-0">Insights & Experiences</h2>
                                        <p class="text-center mt-0 " style="font-size: 16px;" id="answeringOne">
                                            (Answering one question between 1 & 2 is mandatory)</p>
                                        <div class="row">
                                            <div class="col-12">

                                                <div>
                                                    <label for class="form-label d-flex margin_label">
                                                        <div class="me-1">
                                                            1.&nbsp;
                                                        </div>
                                                        <div>
                                                            “Always be kinder than necessary” - James Bary
                                                            </br>What are your thoughts or experiences regarding the
                                                            same? <span style="font-size: 14px;">(Word Limit- 200
                                                                words)</span>
                                                        </div>
                                                    </label>
                                                    <textarea class="form-control" name="your_thoughts"
                                                        id="your-thoughts" cols="30" rows="3" value
                                                        maxlength="1200"><?php echo $apl_data[0]->your_thoughts; ?></textarea>
                                                        <span class="text-danger error-span"><?php echo form_error('your_thoughts'); ?></span>
                                                </div>
                                                <div>
                                                    <label for class="form-label d-flex margin_label">
                                                        <div class="me-1">2.&nbsp;</div>
                                                        <div>
                                                            As an institution and a community, we strongly believe in
                                                            the importance of women supporting other women, especially
                                                            when we are surrounded by systems and societies that are not
                                                            designed for us. How have you supported or encouraged the
                                                            women around you? <span style="font-size: 14px;">(Word
                                                                Limit- 300 words)</span>
                                                        </div>
                                                    </label>
                                                    <textarea class="form-control" name="womans_crown" id="womans-crown"
                                                        cols="30" rows="3" value maxlength="1800"><?php echo $apl_data[0]->womans_crown; ?></textarea>
                                                        <span class="text-danger error-span"><?php echo form_error('womans_crown'); ?></span>
                                                </div>

                                                <div>
                                                    <label for class="form-label d-flex margin_label">
                                                        <div class="me-1">3A.&nbsp;</div>
                                                        <div>A social organisation or NGO that you support</div>
                                                        </label>
                                                    <span class="text-danger d-none error-span"
                                                        id="error_designation"></span>

                                                    <input class="form-control" type="text" name="social_org"
                                                        id="social_org"  maxlength="255" value="<?php echo $apl_data[0]->social_org; ?>">
                                                        <span class="text-danger error-span"><?php echo form_error('social_org'); ?></span>

                                                </div>

                                                <div>
                                                    <label for class="form-label d-flex margin_label"><div class="me-1">3B.&nbsp;</div>
                                                        <div>The cause it furthers</div>
                                                        </label>
                                                    <span class="text-danger d-none error-span"
                                                        id="error_designation"></span>

                                                    <input class="form-control" type="text" name="cause_furthers"
                                                        id="cause_furthers"  maxlength="255" value="<?php echo $apl_data[0]->cause_furthers; ?>">
                                                        <span class="text-danger error-span"><?php echo form_error('cause_furthers'); ?></span>

                                                </div>


                                                <div class="form-group">
                                                    <label for="name" class="form-label d-flex margin_label"><div class="me-1">3C.&nbsp;</div>
                                                        <div>Organisation's contact <span
                                                            style="font-size: 14px;">(Please provide an operational phone number)</span>
                                                        </div>
                                                    </label>

                                                    
                                                     <input type="tel" maxlength="10" name="org_contact" id="org_contact" value="<?php echo $apl_data[0]->org_contact; ?>" class="form-control" 
                                                     oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1').replace(/(\.\d\d)\d/g, '$1');">
                                                        <span class="text-danger error-span"><?php echo form_error('org_contact'); ?></span>
                                                </div>

                                                <div>
                                                    <label for class="form-label d-flex margin_label"><div class="me-1">3D.&nbsp;</div>
                                                        <div>Other details <span
                                                            style="font-size: 14px;">(Address, Website Link)</span>
                                                        </div>
                                                        </label>
                                                    <span class="text-danger d-none error-span"
                                                        id="error_designation"></span>

                                                    <input class="form-control" type="text" name="social_other"
                                                        id="social_other"  maxlength="255" value="<?php echo $apl_data[0]->social_other; ?>">
                                                        <span class="text-danger error-span"><?php echo form_error('social_other'); ?></span>

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
                                        class="previous action-button-previous" id="step6_prev" />
                                    <input type="submit" value="Save & Next" name="step6_submit"
                                        class="next action-button insightExpNext" id="step6_submit" />
                                </fieldset>
                            </form>