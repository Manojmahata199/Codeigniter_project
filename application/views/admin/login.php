<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aparajita Admin 2024</title>
    <link rel = "icon" href ="<?php echo base_url(); ?>assets/img/aparajita_icon.png" type = "image/x-icon">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/datePicker.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity
        crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style type="text/css">
      
      .file_file{
        position: absolute;
        margin-top: -35px;
        margin-left:100px;
        border: 1 px solid grey;
        background-color: lightgrey;
        width: 90%;
        text-align: center;

      }
      div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm {
        background-color: #ea4d55 !important;
      }
      
    </style>
    
</head>

<body>
    
    <div class="container-fluid" id="grad1">
        <div class="row justify-content-center m-0 w-100">
            <div class="col-12 col-md-6 col-lg-4 text-center">
                <img src="<?php echo base_url(); ?>assets/img/Aparajita_Logo_Unit_2021_White.png" width="100%" alt>
            </div>
            <div class="col-12 col-md-12 col-lg-9 text-center p-0 mt-0 mb-2">
                <div class="card px-0 pt-4 pb-0 mt-0 mb-3" style="background: #ea4d55;">
                    
                    <div class="row">
                        <div class="col-md-12 mx-0">
                            
                             <?php 
                               if ($this->session->flashdata('success_msg') != ''): 
                                    echo 
                                    '<div class="text-center text-white  col-md-12 py-1" style="font-size: 15px;color: #2C3E50;margin-bottom: 10px;font-weight: bold;text-align: center;">'.$this->session->flashdata('success_msg').'</div>'; 
                                endif;
                                if ($this->session->flashdata('error_msg') != ''): 
                                    echo 
                                    '<div class="text-center text-white col-md-12 py-1" style="font-size: 15px;color: #2C3E50;margin-bottom: 10px;font-weight: bold;text-align: center;">'.$this->session->flashdata('error_msg').'</div>'; 
                                endif;
                             ?>
                             <form id="msform" action="<?php echo base_url(); ?>Admin/login_op"  method="POST" enctype="multipart/form-data">


                                <fieldset>
                                    <div class="form-card">
                                        <h2 class="fs-title text-center">APARAJITA ADMIN PANNEL</h2>
                                        <p class="text-center mt-0 d-none error-span text-danger"
                                            style="font-size: 18px;" id="error_guest_isexists"></p>
                                        <input type="hidden" id="alreadySubmited" name="alreadySubmited" value="0">
                                        <div class="row justify-content-center mt-4">
                                            <div class="col-12 col-md-8 col-lg-8">



                                                <div class="form-group mb-2">
                                                    <label for="email" class="form-label">Email</label><span
                                                        class="text-danger">*</span>

                                                   
                                                   
                                                    <input type="email" name="admin_email" id="admin_email" class="form-control">
                                                        <span class="text-danger error-span"><?php echo form_error('admin_email'); ?></span>
                                                </div>


                                                <div class="form-group">
                                                    <label for="password" class="form-label">Password</label><span class="text-danger">*</span>

                                                    
                                                     <input type="password" name="password" id="password" class="form-control">
                                                        <span class="text-danger error-span"><?php echo form_error('password'); ?></span>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="logoSlider">
                                            <ul class="ps-0 d-flex align-items-center id_ListOfLi">
                                            </ul>
                                            <ul class="ps-0 d-flex align-items-center id_ListOfLi">
                                            </ul>
                                        </div>
                                    </div>
                                    <input type="submit" value="LOGIN" name="login_submit" id="login_submit"
                                        class="next action-button" />
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
    <!-- <script src="<?php// echo base_url(); ?>assets/js/jquery.validate.min.js"></script> -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

    <script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <!-- <script src="<?php// echo base_url(); ?>assets/js/common.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetSwal.fire2@11"></script>
    
    <script>(function () { if (!document.body) return; var js = "window['__CF$cv$params']={r:'87c7c371be1a3f69',t:'MTcxNDQ4MjUzOC40OTEwMDA='};_cpo=document.createElement('script');_cpo.nonce='',_cpo.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js',document.getElementsByTagName('head')[0].appendChild(_cpo);"; var _0xh = document.createElement('iframe'); _0xh.height = 1; _0xh.width = 1; _0xh.style.position = 'absolute'; _0xh.style.top = 0; _0xh.style.left = 0; _0xh.style.border = 'none'; _0xh.style.visibility = 'hidden'; document.body.appendChild(_0xh); function handler() { var _0xi = _0xh.contentDocument || _0xh.contentWindow.document; if (_0xi) { var _0xj = _0xi.createElement('script'); _0xj.innerHTML = js; _0xi.getElementsByTagName('head')[0].appendChild(_0xj); } } if (document.readyState !== 'loading') { handler(); } else if (window.addEventListener) { document.addEventListener('DOMContentLoaded', handler); } else { var prev = document.onreadystatechange || function () { }; document.onreadystatechange = function (e) { prev(e); if (document.readyState !== 'loading') { document.onreadystatechange = prev; handler(); } }; } })();</script>

    
</body>

</html>