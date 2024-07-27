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
<form id="msform" action="<?php echo base_url(); ?>Registration/step2_submit"  method="POST" enctype="multipart/form-data">
                                <fieldset>
                                    <div class="form-card">
                                        <h2 class="fs-title text-center mb-0">Category<span class="text-danger">*</span></h2>
                                        <p class="text-center mt-0 form-label" style="font-size: 16px;">Please select the category that best represents your field of work</p>
                                        <div class="row">
                                            <div class="col-12 col-md-5 ">



                                          <!-- important1 --><input type="hidden" class="form-control" name="appl_id" value="<?php echo $apl_data[0]->id; ?>" readonly>                                     
                                          <!-- important3 --><input type="hidden" class="form-control" name="reg_id" value="<?php echo $apl_data[0]->reg_id; ?>" readonly>                             
                                          <!-- important4 --><input type="hidden" class="form-control"name="name" value="<?php echo $apl_data[0]->name; ?>" readonly>
                                          <!-- important2 --><input type="hidden" class="form-control" name="email" value="<?php echo $apl_data[0]->email; ?>" readonly>
                                          <!-- important2 --><input type="hidden" class="form-control" name="phone" value="<?php echo $apl_data[0]->phone; ?>" readonly>

                                         

                                                <div class="mb-2 category">
                                                    <input type="radio" class="me-2" style="width: 40px;"
                                                        name="category" id="category_literaryArts" value="Architecture & Space Design" <?php print  ($apl_data[0]->category == 'Architecture & Space Design') ? "checked" : ""; ?>
                                                         data-text="Literary Arts" >

                                                         
                                                 
                                                    <label style=""
                                                        for="category_literaryArts" class="form-label">Architecture & Space Design</label>
                                                </div>

                                                <div class="mb-2 category">
                                                    <input type="radio" class="me-2" style="width: 40px;"
                                                        name="category" id="category_visualArts" value="Art (Performing & Visual)" <?php print  ($apl_data[0]->category == 'Art (Performing & Visual)') ? "checked" : ""; ?>
                                                        data-text="Visual Arts">

                                                        
                                                    <label style="" for="category_visualArts" class="form-label">Art (Performing & Visual)</label>
                                                </div>

                                                <div class="mb-2 category">
                                                    <input type="radio" class="me-2" style="width: 40px;"
                                                        name="category" id="category_managementProfessionals"
                                                        value="Business & Entrepreneurship" <?php print  ($apl_data[0]->category == 'Business & Entrepreneurship') ? "checked" : ""; ?>
                                                        data-text="Management professionals">

                                                        
                                                    <label style=""
                                                        for="category_managementProfessionals" class="form-label">Business & Entrepreneurship</label>
                                                </div>

                                                <div class="mb-2 category">
                                                    <input type="radio" class="me-2" style="width: 40px;"
                                                        name="category" id="category_fashionLifestyle"
                                                        value="Fashion" <?php print  ($apl_data[0]->category == 'Fashion') ? "checked" : ""; ?> data-text="Holistic Wellness">

                                                        
                                                    <label style=""
                                                        for="category_fashionLifestyle" class="form-label">Fashion</label>
                                                </div>

                                                <div class="mb-2 category">
                                                    <input type="radio" class="me-2" style="width: 40px;"
                                                        name="category" id="category_homeLifestyle"
                                                        value="Gourmet" <?php print  ($apl_data[0]->category == 'Gourmet') ? "checked" : ""; ?> data-text="Home & Lifestyle">

                                                        

                                                    <label style="" for="category_homeLifestyle" class="form-label">Gourmet</label>
                                                </div>

                                                <div class="mb-2 category">
                                                    <input type="radio" class="me-2" style="width: 40px;"
                                                        name="category" id="category_communityAdvocacy"
                                                        value="Community Service & Advocacy" <?php print  ($apl_data[0]->category == 'Community Service & Advocacy') ? "checked" : ""; ?>
                                                        data-text="Community Service and Advocacy">

                                                        
                                                    <label style=""
                                                        for="category_communityAdvocacy" class="form-label">Community Service & Advocacy</label>
                                                </div>


                                                <span class="text-danger error-span"><?php echo form_error('category'); ?></span>


                                            </div>

                                           
                                            
                                            <div class="col-12 col-md-7 category-text mt-3 mt-md-0 mt-lg-0 mt-xl-0" style="padding-top: 10px;">


                                                <?php if($apl_data[0]->category == 'Architecture & Space Design'){ ?>

                                                    <span id="literaryArts" class="categoryText form-label">Women who are blending functionality with aesthetics and transforming built environments, including female architects and space designers.</span>

                                                <?php }else if($apl_data[0]->category == 'Art (Performing & Visual)'){ ?>

                                                    <span id="visualArts" class="categoryText form-label">Women who have excelled in the field of visual arts, ranging from photography and filmmaking to painting and sketching to sculpture and printmaking and more; or the performing arts, including theater, dance, music and other forms of performed expression.</span>

                                                <?php }else if($apl_data[0]->category == 'Business & Entrepreneurship'){ ?>

                                                    <span id="managementProfessionals"  class="categoryText form-label">Women who have excelled and made significant contributions in their organisations in the corporate sector,  launched successful ventures, and inspire the next generation of female business leaders.</span>

                                                <?php }else if($apl_data[0]->category == 'Fashion'){ ?>

                                                    <span id="fashionLifestyle" class="categoryText form-label">Visionary female designers and stylists supporting women artisans and promoting inclusive and sustainable fashion.</span>


                                                <?php }else if($apl_data[0]->category == 'Gourmet'){ ?>

                                                    <span id="homeLifestyle" class="categoryText form-label">Women who deliver unforgettable dining experiences, are home chefs, promote farm-to-table or work with sustainably acquired or otherwise innovative produce & practices.</span>

                                                <?php }else if($apl_data[0]->category == 'Community Service & Advocacy'){ ?>

                                                    <span id="communityAdvocacy" class="categoryText form-label">Women who have excelled and managed to create a positive impact in their communities by addressing social and systemic barriers.</span>

                                                <?php }else{ ?>

                                                    <span id="literaryArts" class="categoryText form-label">Women who are blending functionality with aesthetics and transforming built environments, including female architects and space designers.</span>'

                                                <?php } ?>    

                                            </div>
                                            
                                            <h2 class="fs-title text-center">Years of Experience<span class="text-danger">*</span></h2>
                                            <p class="text-center mt-0 form-label" style="font-size: 16px;">as on 31st March of the current year</p>
                                            <div class="row">
                                                <div class="col-12 mb-4">

                                                    <div class="mb-2">
                                                        <input type="radio" class="me-2" style="width: 40px;"
                                                            name="you_shine" id="you_shine_u10" value="You Shine (5 to 10 years)" <?php print  ($apl_data[0]->you_shine == 'You Shine (5 to 10 years)') ? "checked" : ""; ?>>

                                                            
                                                        <label style="" for="you_shine_u10" class="form-label">You
                                                            Shine (5 to 10 years)</label>
                                                    </div>
                                                    <div class>
                                                        <input type="radio" class="me-2" style="width: 40px;"
                                                            name="you_shine" id="you_shine_m10" value="You
                                                            Inspire (More than 10 years)" <?php print  ($apl_data[0]->you_shine == 'You
                                                            Inspire (More than 10 years)') ? "checked" : ""; ?>>

                                                            
                                                        <label style="" for="you_shine_m10" class="form-label">You
                                                            Inspire (More than 10 years)</label>
                                                    </div>
                                                    <span class="text-danger error-span"><?php echo form_error('you_shine'); ?></span>

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
                                        class="previous action-button-previous" id="step2_prev" />
                                    <input type="submit" value="Save & Next" name="step2_submit"
                                        class="next action-button account" id="step2_submit" />
                                </fieldset>
                            </form>