


            <!--begin::Content wrapper-->
           <div class="d-flex flex-column flex-column-fluid">


              <!--begin::Content-->
              <div id="kt_app_content" class="app-content flex-column-fluid">


                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-fluid">



                    <!--begin::Row-->
                  <div class="row g-5 g-xxl-10">

                           


                      <!--begin::Col-->
                    <div class="col-xl-12 col-xxl-12 mb-5 mb-xxl-12">
                      <!--begin::Engage widget 2-->
                      <div class="card bgi-position-y-bottom bgi-position-x-end bgi-no-repeat bgi-size-cover min-h-250px h-xl-100 border-0 bg-gray-200" style="background-position: 100% 100%;background-size: 300px auto;">
                        <!--begin::Body-->

                        <div class="text-center text-white col-md-12 py-1" style="font-size: 15px;color:;margin-bottom: 10px;font-weight: bold;text-align: center;">this is error notification</div> 
                        <div class="col-md-12 d-flex flex_pos my-2">
                            <h3 class="col-md-7 text-center my-1 mx-3 heading">Incomplete Applications List</h3>
                            <form method="post" action="<?php echo base_url(); ?>Admin/incomplete_list" class="col-md-5 d-flex mx-2">
                            <div class="col-md-12 d-flex mx-2">
                             
                              <input class="col-md-9 form-control mx-1" type="text" name="search_input" placeholder="Search Here......." style="height:50px;">
                              <input class="col-md-2 btn btn-secondary mx-1" type="submit" name="search_submit" value="Search" style="height:50px;">
                             
                            </div>
                           </form>
                       </div>
                        <hr>
                        
                        <div class="col-md-12 d-flex flex_pos">
                            
                             <!-- <a class="btn btn-primary my-2 col-md-2" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">New Group</a> -->
                             <a href="<?php echo base_url(); ?>Admin/incomplete_list" class="btn btn-light mx-1 border-1 border border-dark btn_top"><i class="fa fa-refresh mx-1"></i><span class="txt">Refresh</span></a>
                             
                             

                             
                        </div>
                       
                      <hr>
                        <div class="card- d-flex flex-column justify-content-center ps-lg-15">
                            
                           <?php 
                               if ($this->session->flashdata('success_msg') != ''): 
                                    echo 
                                    '<div class="text-center text-white bg-success col-md-12 py-1" style="font-size: 15px;color: #2C3E50;margin-bottom: 10px;font-weight: bold;text-align: center;">'.$this->session->flashdata('success_msg').'</div>'; 
                                endif;
                                if ($this->session->flashdata('error_msg') != ''): 
                                    echo 
                                    '<div class="text-center text-white bg-danger col-md-12 py-1" style="font-size: 15px;color: #2C3E50;margin-bottom: 10px;font-weight: bold;text-align: center;">'.$this->session->flashdata('error_msg').'</div>'; 
                                endif;
                             ?>
                           
                        <div class="table-responsive">

                         <table class="table table-responsive table-striped table-bordered text-center" style="overflow:scroll;height: 500px;">
                            <thead>
                             <!--  <th width="5%">
                                 <div class="form-check my-1 col-md-12">
                                  <input type="checkbox" id="select_all" value=""/>
                                  <label class="form-check-label" for="flexRadioDefault1">
                                    <b>Select All</b>
                                  </label>
                                </div>
                              </th> -->
                                <th width="5%">Sr No</th>
                                <th width="5%">Name</th>
                                <th width="5%">Incorporated</th>                              
                                <th width="5%">Incorporated<br>Date</th>
                                <th width="5%">Category</th>
                                <th width="10%">Org Name</th>
                                <th width="5%">Org Desig</th>
                                <th width="10%">Org Addr</th>
                                <th width="10%">Org DP</th>
                                <th width="10%">Applicants</th>
                                <th width="5%">Applicants<br>Social</th>
                                <th width="25%">Docs</th>
                                
                                
                            </thead>
                            <tbody>
                         

            
                             <?php $i=1;
                              foreach($result as $value){ 
                                  $url_arr=array(
                                    "appl_id"=>$value->id,
                                    "user_id"=>$value->reg_id,
                                    "name"=>$value->name,
                                    "email"=>$value->email,
                                    "phone"=>$value->phone,
                                    "mail_count"=>$value->mail_count



                                  );
                                  $mail_url= http_build_query($url_arr);
                                                      
                                                     


                               
                                       if($value->step8!="1"){ 

                                        $company_incorporation_date=$value->company_incorporation_date;
                                        $new_company_incorporation_date=date('d-m-y H:i',strtotime($company_incorporation_date));

                                        $dob=$value->dob;
                                        $new_dob=date('d-m-y H:i',strtotime($dob));

                                       ?>
                                   
                                              
                                                <tr>
                                                 <!--  <td> 
                                                    <div class="col-md-2">
                                                       <input type="hidden" name="page" value="">

                                                        <input type="checkbox" name="checked_id[]" class="checkbox" value="<?php echo $value->id; ?>"/>
                                                    </div>
                                                  </td> -->
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $value->name; ?><br>
                                                        <?php echo $value->phone; ?><br>
                                                        <?php echo $value->email; ?><br>
                                                        <?php echo $value->unique_id; ?>
                                                    </td>
                                                    <td><?php echo $value->is_incorporated; ?></td>
                                                    <td><?php echo $new_company_incorporation_date; ?><br>
                                                        Exp:<?php echo $value->year_experience; ?>-Years</td>
                                                    <td><?php echo $value->category; ?></td>
                                                    <td><?php echo $value->org_name; ?><br>
                                                         <?php echo $value->org_contactno; ?><br>
                                                         <?php echo $value->org_email; ?>
                                                       </td>
                                                    <td><?php echo $value->designation; ?></td>
                                                    <td><?php echo $value->org_city; ?><br>
                                                        <?php echo $value->org_state; ?><br>
                                                        <?php echo $value->org_pin; ?>
                                                      
                                                    </td>
                                                    <td>
                                                      <a href="<?php echo $value->org_website; ?>"><?php echo $value->org_website; ?></a><br>
                                                      <a href="<?php echo $value->digital_presence_linkedin; ?>"><?php echo $value->digital_presence_linkedin; ?></a><br>
                                                      <a href="<?php echo $value->digital_presence_facebook; ?>"><?php echo $value->digital_presence_facebook; ?></a><br>
                                                      <a href="<?php echo $value->digital_presence_twitter; ?>"><?php echo $value->digital_presence_twitter; ?></a><br>
                                                      <a href="<?php echo $value->digital_presence_instagram; ?>"><?php echo $value->digital_presence_instagram; ?></a>

                                                    </td>
                                                    <td><?php echo $value->applicant_name; ?><br>
                                                        <?php echo $new_dob; ?><br>
                                                        <?php echo $value->mobile; ?><br>
                                                        <?php echo $value->email_id; ?>

                                                    </td>
                                                    <td>
                                                      <a href="<?php echo $value->social_media; ?>"><?php echo $value->social_media; ?></a><br>
                                                      <a href="<?php echo $value->linkedin_profile; ?>"><?php echo $value->linkedin_profile; ?></a>
                                                    </td>
                                                    

                                                    <td class="text-left">



                                        <a class="btn btn-primary text-center text-dark" href="<?php echo base_url(); ?>Admin/incomplete_mail/?<?php echo $mail_url; ?>">Mail(<?php echo $value->mail_count; ?>)</a>

                                                      <?php if($value->support_entry!=""){ ?>

                                                          <a target="_blank" class="btn btn-info my-1 border-1 border border-dark" href="<?php echo base_url();?>document_uploads/<?php echo $value->reg_id; ?>/support_entry/<?php echo $value->support_entry; ?>">image</a>
                                                      <?php } ?>
                                                      <?php if($value->awards_recognition!=""){ ?>

                                                          <a target="_blank" class="btn btn-info my-1 border-1 border border-dark" href="<?php echo base_url();?>document_uploads/<?php echo $value->reg_id; ?>/awards_recognition/<?php echo $value->awards_recognition; ?>">Award</a>
                                                      <?php } ?>
                                                      <?php if($value->letter_from_organization!=""){ ?>

                                                         <a target="_blank" class="btn btn-info my-1 border-1 border border-dark" href="<?php echo base_url();?>document_uploads/<?php echo $value->reg_id; ?>/letter_from_organization/<?php echo $value->letter_from_organization; ?>">letter</a>

                                                       <?php } ?>

                                                       <?php if($value->signature!=""){ ?>

                                                         <a target="_blank" class="btn btn-info my-1 border-1 border border-dark" href="<?php echo base_url();?>document_uploads/<?php echo $value->reg_id; ?>/signature/<?php echo $value->signature; ?>">Sign</a>

                                                       <?php } ?>

                                                       <?php if($value->bio_video!=""){ ?>

                                                         <a target="_blank" class="btn btn-info my-1 border-1 border border-dark" href="<?php echo base_url();?>document_uploads/<?php echo $value->reg_id; ?>/bio_video/<?php echo $value->bio_video; ?>">Bio</a>

                                                       <?php } ?>



                                                        <?php if($value->step8=="1"){ ?>

                                                         <a target="_blank" class="btn btn-info my-1 border-1 border border-dark" href="<?php echo base_url();?>document_uploads/form-<?php echo $value->reg_id; ?>.pdf">Pdf Card</a>

                                                       <?php } ?>

                                                       
                                                        
                                                       
                                                    </td>
                                                </tr>


                                      <?php }
                                      $i++;
                              } ?>
                            
                                                        

                            </tbody>
                             


                         </table>
                         </div>




                          
                        </div>
                      
                        <!--end::Body-->




                        
                     <!--  <div class="col-md-12 d-flex">
                      
                        <div class=" col-md-8 my-2">
                     
                          <nav aria-label="Page navigation example">
                              <ul class="pagination">
                                <li class="page-item">
                                  <a class="page-link" href="user_list.php?page=" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>First
                                  </a>
                                </li>
                                
                                <li class="page-item">
                                  <a class="page-link" href="user_list.php?page=">
                                   Previous
                                  </a>
                                </li>
                                
                                     <li class="page-item"><a class="page-link"  href="user_list.php?page=">1</a></li>
                              
                                <li class="page-item">
                                  <a class="page-link" href="user_list.php?page=">
                                    Next
                                  </a>
                                </li> 
                                <li class="page-item">
                                  <a class="page-link" href="user_list.php?page=" aria-label="Next">
                                    Last<span aria-hidden="true">&raquo;</span>
                                  </a>
                                </li>

                              </ul>
                            </nav>
                          
                        </div>
                        
                      </div> -->
                       




                      </div>
                      <!--end::Engage widget 2-->
                    </div>
                    <!--end::Col-->


                    </div>
                  <!--end::Row-->



                 </div>
                <!--end::Content container-->
              </div>
              <!--end::Content-->
            </div>
            <!--end::Content wrapper-->



            






