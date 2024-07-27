<!DOCTYPE html>
<html>
  <!--begin::Head-->
  <head>
    <title>Aparajita 2024 Admin Pannel</title>
    <link rel = "icon" href ="<?php echo base_url(); ?>/assets/img/aparajita_icon.png" type = "image/x-icon">
    <meta charset="utf-8" />
    <meta name="description" content="Good admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
    <meta name="keywords" content="Good, bootstrap, bootstrap 5, admin themes, free admin themes, bootstrap admin, bootstrap dashboard, bootstrap dark mode" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Good - Bootstrap 5 HTML Admin Dashboard Template" />
    <meta property="og:url" content="https://themes.getbootstrap.com/product/good-bootstrap-5-admin-dashboard-template" />
    <meta property="og:site_name" content="Keenthemes | Good" />

     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <link rel="canonical" href="https://preview.keenthemes.com/good" />
    <!-- <link rel="shortcut icon" href="../asset/img/favicon.ico" /> -->
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js">


    <!--end::Page Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admin-assets/css/bootstrap.min.css">


    <!--end::Global Stylesheets Bundle-->
    <!--Begin::Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&amp;l='+l:'';j.async=true;j.src= 'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-5FS8GGP');</script>
    <!--End::Google Tag Manager -->


    <style type="text/css">
      
        .set_in{

          font-size: 12px;
         

          
        }
        .navbar-brand{
          font-size: 20px;
        }
        .set_in_radio{


          
        }
        #setting_view{
          font-size: 12px;
          background-color: grey;
        }
        #setting_view h4{
          font-size: 10px;
        }
        .form-label{
          text-overflow: ellipsis;
        }

      @media (max-width: 1350px) {
    
      .table{
        font-size: 8px;
       
      }
      .btn{
        font-size: 8px;
      }
      .heading{
       
      }
      .form-label{
        font-size: 8px;
      }
      
        
        
    }
     @media (max-width: 1600px) {
      .form-label{
        font-size: 8px;
      }
      .nav-item{
        font-size: 12px;
      }
     }
     @media (max-width: 1400px) {
      .nav-item{
        font-size: 10px;
      }
     }
     @media (max-width: 1200px) {
      .nav-item{
        font-size: 8px;
      }
     }
     @media (max-width: 1050px) {
      .nav-item{
        font-size: 7px;
      }
      .navbar-brand{
        font-size:15px;
      }
     }
     @media (max-width: 650px) {
      .btn_top{
        
        
        margin: 5px;

      }
      .navbar-brand{
        font-size:8px;
      }
      .flex_pos{
         display: flex;
         flex-wrap: wrap;
      }
      .btn_top_search{
        width: 60px;
      }
     }
     @media (min-width: 992px) {
 

        body {
          --kt-app-sidebar-width: 0px;
          --kt-app-sidebar-width-actual: 300px;
          --kt-app-sidebar-gap-start: 0px;
          --kt-app-sidebar-gap-end: 0px;
          --kt-app-sidebar-gap-top: 0px;
          --kt-app-sidebar-gap-bottom: 0px;
        }
      }






    </style>
  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body id="kt_app_body" data-kt-app-layout="light-sidebar" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" class="app-default">
    <!--Begin::Google Tag Manager (noscript) -->
    <noscript>
      <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FS8GGP" height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!--End::Google Tag Manager (noscript) -->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root">




      <!--begin::Page-->
      <div class="app-page flex-column flex-column-fluid" id="kt_app_page">





       <nav class="navbar navbar-expand-lg bg-dark text-light" style="position: fixed;width: 100%;z-index: +1;">
          <div class="container-fluid">
            <a class="navbar-brand text-light" href="<?php echo base_url(); ?>Admin/dashboard"><img style="width:60px; height:60px;" src="<?php echo base_url(); ?>assets/img/aparajita_icon.png"> SANMARG APARAJITA ADMIN PANEL</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon bg-light"><i class="fa fa-bars"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
              <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="<?php echo base_url(); ?>Admin/dashboard">Dashboard</a>
                </li>
                

                

                 
                 <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    All Applications List
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item my-3" href="<?php echo base_url(); ?>Admin/dashboard"><i class="fa-solid fa-house"></i> Dashboard</a></li>
                    <li><a class="dropdown-item my-3" href="<?php echo base_url(); ?>Admin/application_list"><i class="fa-solid fa-file"></i> Application List</a></li>
                    <li><a class="dropdown-item my-3" href="<?php echo base_url(); ?>Admin/incomplete_list"><i class="fa-solid fa-file"></i> Incomplete Application</a></li>
                    
                    
                  </ul>
                </li>
                 




                
                 
                


                
                 <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-user mx-2" style="color: #f5f5f5;"></i>hello <?php echo $this->session->userdata('name'); ?>
                  </a>
                  <ul class="dropdown-menu">
                    <li><i class="fa fa-user"></i>ADMIN PROFILE</li>
                    
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#"><i class="fa fa-earth"></i>Version : 1.00.1</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url(); ?>Admin/logout"><i class="fa-solid fa-right-from-bracket mx-2" style="color: #050505;"></i>Sign Out</a></li>
                    
                    
                  </ul>
                </li>
                
                
                 
              </ul>
              <!-- <form class="d-flex" autocomplete="on" action="../operation/search_op.php" method="post" role="search">
                <input class="form-control me-2" style="height:40px;width:250px;" type="search" placeholder="Search" name="search_key" id="search_key" aria-label="Search">
                <button class="btn btn-outline-success bg-light text-dark" name="key_submit" type="submit">Search</button>
              </form> -->
            </div>
          </div>
        </nav>




         <!--begin::Wrapper-->
        <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper" style="margin-top:80px;">