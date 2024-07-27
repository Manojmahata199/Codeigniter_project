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
    
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

    <script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetSwal.fire2@11"></script>
    
    
    <!-- date picker -->

    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    
    <script>
        function PrintDiv() {

            $("#printLogo123").css("display", "block !important");
            document.getElementById("printLogo123").style.display = "block";
            var divToPrint = document.getElementById('divToPrint');
            var popupWin = window.open('', '_blank');

            popupWin.document.open();
            popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
        }

        $(document).ready(function () {
            $(window).scrollTop(0);
        });

        $(".next").click(function () {
            $(window).scrollTop(0);
        });

        $(".previous").click(function () {
            $(window).scrollTop(0);
        });

       
    </script>
    
    <script>
        $(function () {
            $("#dob").datepicker({
                dateFormat: "dd-mm-yy",
                changeYear: true,
                changeMonth: true,
                // yearRange: "1950:2024"
                yearRange: "100:+0",
            });
        });


        

        $(function () {
            $("#company-incorporation-date").datepicker({
                dateFormat: "dd-mm-yy",
                changeYear: true,
                changeMonth: true,
                // yearRange: "1950:2024"
                yearRange: "100:+0",
            });
        });

        $('#msform').on('keyup keypress', function(e) {
          if (e.key === 'Enter') { 
            e.preventDefault();
            return false;
          }
        });

        

    </script>
    
    
    <script>(function () { if (!document.body) return; var js = "window['__CF$cv$params']={r:'87c7c371be1a3f69',t:'MTcxNDQ4MjUzOC40OTEwMDA='};_cpo=document.createElement('script');_cpo.nonce='',_cpo.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js',document.getElementsByTagName('head')[0].appendChild(_cpo);"; var _0xh = document.createElement('iframe'); _0xh.height = 1; _0xh.width = 1; _0xh.style.position = 'absolute'; _0xh.style.top = 0; _0xh.style.left = 0; _0xh.style.border = 'none'; _0xh.style.visibility = 'hidden'; document.body.appendChild(_0xh); function handler() { var _0xi = _0xh.contentDocument || _0xh.contentWindow.document; if (_0xi) { var _0xj = _0xi.createElement('script'); _0xj.innerHTML = js; _0xi.getElementsByTagName('head')[0].appendChild(_0xj); } } if (document.readyState !== 'loading') { handler(); } else if (window.addEventListener) { document.addEventListener('DOMContentLoaded', handler); } else { var prev = document.onreadystatechange || function () { }; document.onreadystatechange = function (e) { prev(e); if (document.readyState !== 'loading') { document.onreadystatechange = prev; handler(); } }; } })();</script>
    
    
    <script type="text/javascript">

        $(document).ready(function(){

           
           
            $('.category_desc').hide();

        
            
            // $('#add_another_btn').show();
            // $('#close_another_btn').hide();
            
            // $('#add_another_institute').hide();
            // $('#college_name').hide();
            // $('#college_city').hide();
            // $('#college_programme').hide();
            // $('#college_certificate').hide();

            // org media link

           $('#linkedin-profile').on("change",function(){


                var url = $('#linkedin-profile').val();

                var url_validate=/(https?)?:?(\/\/)?(([w]{3}||\w\w)\.)?linkedin.com(\w+:{0,1}\w*@)?(\S+)(:([0-9])+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
                // var url_validate = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
                if(!url_validate.test(url)){

                   
                   
                     
                    $('#linkedin-profile').val("");
                    $('#linkedin-profile').focus();
                    
                    Swal.fire('Please enter a valid linkedin link');
                    return false; 

                }
                
            });




            $('#dp-linkedin').on("change",function(){


                var url = $('#dp-linkedin').val();
               var url_validate=/(https?)?:?(\/\/)?(([w]{3}||\w\w)\.)?linkedin.com(\w+:{0,1}\w*@)?(\S+)(:([0-9])+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
                // var url_validate = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
                if(!url_validate.test(url)){

                   
                   
                     
                    $('#dp-linkedin').val("");
                    $('#dp-linkedin').focus();
                    
                    Swal.fire('Please enter a valid linkedin link');
                    return false; 

                }
                
            });

 
  
   
            $('#dp-facebook').on("change",function(){

                var url = $('#dp-facebook').val();
                // var url_validate=/https?:\/\/facebook\.com\/[a-z0-9_]+$/i;
                var url_validate=/(https?)?:?(\/\/)?(([w]{3}||\w\w)\.)?facebook.com(\w+:{0,1}\w*@)?(\S+)(:([0-9])+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
                // var url_validate = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
                if(!url_validate.test(url)){

                   
                    
                    $("#dp-facebook").val("");
                    $("#dp-facebook").focus();
                    Swal.fire('Please enter a valid facebook link');
                    return false;
                }
                
            });
            $('#dp-twitter').on("change",function(){


                var url = $('#dp-twitter').val();
                // var url_validate=/https?:\/\/twitter\.com\/(#!\/)?[a-z0-9_]+$/i;
                var url_validate=/(https?)?:?(\/\/)?(([w]{3}||\w\w)\.)?x.com(\w+:{0,1}\w*@)?(\S+)(:([0-9])+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
                // var url_validate2=/(https?)?:?(\/\/)?(([w]{3}||\w\w)\.)?x.com(\w+:{0,1}\w*@)?(\S+)(:([0-9])+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
                // var url_validate = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
                if(!url_validate.test(url)){

                  
                    
                    $("#dp-twitter").val("");
                    $("#dp-twitter").focus();
                     Swal.fire('Please enter a valid twitter link');
                    return false;
                }
                
                
            });
            $('#dp-instagram').on("change",function(){


                var url = $('#dp-instagram').val();
                // var url_validate=/https?:\/\/instagram\.com\/(#!\/)?[a-z0-9_]+$/i;
                var url_validate=/(https?)?:?(\/\/)?(([w]{3}||\w\w)\.)?instagram.com(\w+:{0,1}\w*@)?(\S+)(:([0-9])+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
                // var url_validate = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
                if(!url_validate.test(url)){

                   
                    
                    $("#dp-instagram").val("");
                    $("#dp-instagram").focus();
                    Swal.fire('Please enter a valid instagram link');
                    return false;
                }
                
            });
            $('#org-website').on("change",function(){


                var url = $('#org-website').val();
                var url_validate = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
                if(!url_validate.test(url)){

                   

                    $("#org-website").val("");
                    $("#org-website").focus(); 
                     Swal.fire('Please enter a valid website link');
                    return false;  
                }
                
            });




            
            $("#company_incorporation_is").on("change", function(){

                var company_incorporation_is=$('#company_incorporation_is').val();
                if(company_incorporation_is=='Others'){


                    $('#specify_org_type_div').show();

                }
                else{
                    $('#specify_org_type_div').hide();
                }

            });
            $("#alternate_contact_relationship").on("change", function(){

                var relationship=$('#alternate_contact_relationship').val();
                if(relationship=='Other'){


                    $('#specify_reltion_div').show();

                }
                else{
                    $('#specify_reltion_div').hide();
                }

            });
          
            $("#close_another_btn").on("click", function(){
    

                var another_institute=0;
                var appl_id=$('#appl_id').val();
                var reg_id=$('#reg_id').val();
                var email=$('#email').val();
                var phone=$('#phone').val();
                
               $.ajax({
                        type: "POST",         
                        url: "<?php echo base_url('Registration/add_another_institute');?>",
                        // async: true,
                        // datatype: "JSON",
                        data: {

                          another_institute: another_institute,
                          appl_id:appl_id,
                          reg_id:reg_id,
                          email:email,
                          phone:phone
   
                        },
                        success: function(data)
                       {
                        if(data=true){

                            window.location.replace("<?php echo base_url('Registration/step4'); ?>");
                        }else{

                            window.location.replace("<?php echo base_url('Registration/step4'); ?>");

                        }
                                
                       }
                   });

            });
             $("#close_third_btn").on("click", function(){
    

                var another_institute=0;
                var appl_id=$('#appl_id').val();
                var reg_id=$('#reg_id').val();
                var email=$('#email').val();
                var phone=$('#phone').val();

                
               $.ajax({
                        type: "POST",         
                        url: "<?php echo base_url('Registration/add_third_institute');?>",
                        // data: formData,
                        // async: false,
                        // datatype: "JSON",
                        data: {

                          another_institute: another_institute,
                          appl_id:appl_id,
                          reg_id:reg_id,
                          email:email,
                          phone:phone
                        
                        },
                        success: function(data)
                       {
                        if(data=true){

                            window.location.replace("<?php echo base_url('Registration/step4'); ?>");
                        }else{

                            window.location.replace("<?php echo base_url('Registration/step4'); ?>");

                        }
                                
                       }
                   });

            });

            




           $('.category').click(function(){

              var category_val=$("input[type=radio][name=category]:checked").val();
              if(category_val=='Architecture & Space Design'){

          



                $('.category-text').html('<span id="literaryArts" class="categoryText form-label">Women who are blending functionality with aesthetics and transforming built environments, including female architects and space designers.</span>');

                $('#literaryArts').show();
                   $('#visualArts').hide();
                   $('#managementProfessionals').hide();
                   $('#homeLifestyle').hide();
                   $('#communityAdvocacy').hide();
                   $('#fashionLifestyle').hide();
              }
              else if(category_val=='Art (Performing & Visual)'){


                $('.category-text').html('<span id="visualArts" class="categoryText form-label">Women who have excelled in the field of visual arts, ranging from photography and filmmaking to painting and sketching to sculpture and printmaking and more; or the performing arts, including theater, dance, music and other forms of performed expression.</span>');

                $('#visualArts').show();
                $('#literaryArts').hide();
                   
                   $('#managementProfessionals').hide();
                   $('#homeLifestyle').hide();
                   $('#communityAdvocacy').hide();
                   $('#fashionLifestyle').hide();
              }
              else if(category_val=='Business & Entrepreneurship'){

                $('.category-text').html('<span id="managementProfessionals"  class="categoryText form-label">Women who have excelled and made significant contributions in their organisations in the corporate sector,  launched successful ventures, and inspire the next generation of female business leaders.</span>');

                $('#managementProfessionals').show();
                $('#literaryArts').hide();
                   $('#visualArts').hide();
                   
                   $('#homeLifestyle').hide();
                   $('#communityAdvocacy').hide();
                   $('#fashionLifestyle').hide();
              }
              else if(category_val=='Fashion'){

                $('.category-text').html('<span id="fashionLifestyle" class="categoryText form-label">Visionary female designers and stylists supporting women artisans and promoting inclusive and sustainable fashion.</span>');

                $('#fashionLifestyle').show();
                $('#literaryArts').hide();
                   $('#visualArts').hide();
                   $('#managementProfessionals').hide();
                   $('#homeLifestyle').hide();
                   $('#communityAdvocacy').hide();
                   
              }
              else if(category_val=='Gourmet'){

                $('.category-text').html('<span id="homeLifestyle" class="categoryText form-label">Women who deliver unforgettable dining experiences, are home chefs, promote farm-to-table or work with sustainably acquired or otherwise innovative produce & practices.</span>');

                $('#homeLifestyle').show();
                $('#literaryArts').hide();
                   $('#visualArts').hide();
                   $('#managementProfessionals').hide();
                   
                   $('#communityAdvocacy').hide();
                   $('#fashionLifestyle').hide();
              }
              else if(category_val=='Community Service & Advocacy'){

                $('.category-text').html('<span id="communityAdvocacy" class="categoryText form-label">Women who have excelled and managed to create a positive impact in their communities by addressing social and systemic barriers.</span>');

                $('#communityAdvocacy').show();
                $('#literaryArts').hide();
                   $('#visualArts').hide();
                   $('#managementProfessionals').hide();
                   $('#homeLifestyle').hide();
                   
                   $('#fashionLifestyle').hide();
              }
              else{

                $('.category-text').html('<span id="literaryArts" class="categoryText form-label">Women who have transformed built environments, including female architects and space designers.</span>');

                $('#literaryArts').show();
                
                   $('#visualArts').hide();
                   $('#managementProfessionals').hide();
                   $('#homeLifestyle').hide();
                   $('#communityAdvocacy').hide();
                   $('#fashionLifestyle').hide();
              }





           });

           

           // signiture

            $('#signature').change(function(){ 
                
              
              var signature=$('#signature').val();
               $('#signature_name').show();
              $('#signature_name').val(signature);

            });



            $("#register_submit").click(function(){

                var guest_name=$("#guest_name").val();
                var guest_email=$("#guest_email").val();
                var guest_phone=$("#guest_phone").val();
                   
                if(guest_name=="")
                {
                    Swal.fire('Please enter your full name');
                    return false;
                    $("#guest_name").val();
                    $("#guest_name").focus();
                            
                }
                else if(guest_email=="")
                {
                    Swal.fire('Please enter a valid E-mail ID');
                    return false;
                    $("#guest_email").val();
                    $("#guest_email").focus();
                            
                }
                else if(guest_phone=="")
                {
                    Swal.fire('Please enter a 10-digit phone number with relevant extensions');
                    return false;
                    $("#guest_phone").val();
                    $("#guest_phone").focus();
                            
                }
                else{
                    return true;
                }
            });

            $("#step2_prev").click(function(){
   
                if(!$("input[type=radio][name=category]:checked").val())
                {
                    Swal.fire('Please select the category');
                    return false;
                    !$("input[type=radio][name=category]:checked").val();
                    $("#category_literaryArts").focus();
                            
                }
                else if(!$("input[type=radio][name=you_shine]:checked").val())
                {
                    Swal.fire('Please select your years of experience');
                    return false;
                    !$("input[type=radio][name=you_shine]:checked").val();
                    $("#you_shine_u10").focus();
                            
                }
                else{
                    return true;
                }
            });
            $("#step2_submit").click(function(){
   
                if(!$("input[type=radio][name=category]:checked").val())
                {
                    Swal.fire('Please select the category');
                    return false;
                    !$("input[type=radio][name=category]:checked").val();
                    $("#category_literaryArts").focus();
                            
                }
                else if(!$("input[type=radio][name=you_shine]:checked").val())
                {
                    Swal.fire('Please select your years of experience');
                    return false;
                    !$("input[type=radio][name=you_shine]:checked").val();
                    $("#you_shine_u10").focus();
                            
                }
                else{
                    return true;
                }
            });


            // step4_add1_submit validation
            $("#step4_add1_submit").click(function(){

                var school_name=$("#school_name").val();
                var school_city=$("#school_city").val();
                var school_programme=$("#school_programme").val();
                
                   
                if(school_name=="")
                {
                    
                    $("#school_name").val();
                    $("#school_name").focus();
                    
                    Swal.fire('Please enter the name of institution');
                    return false;
                            
                }
                else if(school_city=="")
                {
                    
                    $("#school_city").val();
                    $("#school_city").focus();
                   
                    Swal.fire('Please enter the city of the institution');
                    return false;
                            
                }
                else if(school_programme=="")
                {
                    
                    $("#school_programme").val();
                    $("#school_programme").focus();
                   
                    Swal.fire('Please enter the name of programme you completed');
                    return false;
                            
                }
                else{
                    return true;
                }
            });

            // step4_add2_submit validation

            $("#step4_add2_submit").click(function(){

                var school_name=$("#school_name").val();
                var school_city=$("#school_city").val();
                var school_programme=$("#school_programme").val();
                var another_institute=$("#another_institute").val();
                // `college_name`, `college_city`, `college_programme`
                var college_name=$("#college_name").val();
                var college_city=$("#college_city").val();
                var college_programme=$("#college_programme").val();
                   
                if(school_name=="")
                {
                    
                    $("#school_name").val();
                    $("#school_name").focus();
                    
                    Swal.fire('Please enter the name of institution');
                    return false;
                            
                }
                else if(school_city=="")
                {
                    
                    $("#school_city").val();
                    $("#school_city").focus();
                   
                    Swal.fire('Please enter the city of the institution');
                    return false;
                            
                }
                else if(school_programme=="")
                {
                    
                    $("#school_programme").val();
                    $("#school_programme").focus();
                   
                    Swal.fire('Please enter the name of programme you completed');
                    return false;
                            
                }
                else if(another_institute==1 && college_name==""){
                    $("#college_name").val();
                    $("#college_name").focus();
                   
                    Swal.fire('Please enter the name of another institution');
                    return false;

                }
                else if(another_institute==1 && college_city==""){
                    $("#college_city").val();
                    $("#college_city").focus();
                   
                    Swal.fire('Please enter the name of another institution city');
                    return false;

                }
                else if(another_institute==1 && college_programme==""){
                    $("#college_programme").val();
                    $("#college_programme").focus();
                   
                    Swal.fire('Please enter the name of programme you completed in another institution');
                    return false;

                }
                else{
                    return true;
                }
            });

            // step 4 validation
             $("#step4_submit").click(function(){

                var school_name=$("#school_name").val();
                var school_city=$("#school_city").val();
                var school_programme=$("#school_programme").val();
                var another_institute=$("#another_institute").val();
                // `college_name`, `college_city`, `college_programme`
                var college_name=$("#college_name").val();
                var college_city=$("#college_city").val();
                var college_programme=$("#college_programme").val();

                var third_institute_name=$("#third_institute_name").val(); 
                var third_institute_city=$("#third_institute_city").val(); 
                var third_institute_programe=$("#third_institute_programe").val(); 

                var third_institute=$("#third_institute").val();
                  
                if(school_name=="")
                {
                    
                    $("#school_name").val();
                    $("#school_name").focus();
                    
                    Swal.fire('Please enter the name of institution');
                    return false;
                            
                }
                else if(school_city=="")
                {
                    
                    $("#school_city").val();
                    $("#school_city").focus();
                   
                    Swal.fire('Please enter the city of the institution');
                    return false;
                            
                }
                else if(school_programme=="")
                {
                    
                    $("#school_programme").val();
                    $("#school_programme").focus();
                   
                    Swal.fire('Please enter the name of programme you completed');
                    return false;
                            
                }
                else if(another_institute==1 && college_name==""){
                    $("#college_name").val();
                    $("#college_name").focus();
                   
                    Swal.fire('Please enter the name of another institution');
                    return false;

                }
                else if(another_institute==1 && college_city==""){
                    $("#college_city").val();
                    $("#college_city").focus();
                   
                    Swal.fire('Please enter the name of another institution city');
                    return false;

                }
                else if(another_institute==1 && college_programme==""){
                    $("#college_programme").val();
                    $("#college_programme").focus();
                   
                    Swal.fire('Please enter the name of programme you completed in another institution');
                    return false;

                }
 // `third_institute`, `third_institute_name`, `third_institute_city`, `third_institute_programe`, `third_institute_certificate`,
                else if(third_institute==1 && third_institute_name==""){
                    $("#third_institute_name").val();
                    $("#third_institute_name").focus();
                   
                    Swal.fire('Please enter the name of another institution');
                    return false;

                }
                else if(third_institute==1 && third_institute_city==""){
                    $("#third_institute_city").val();
                    $("#third_institute_city").focus();
                   
                    Swal.fire('Please enter the name of another institution city');
                    return false;

                }
                else if(third_institute==1 && third_institute_programe==""){
                    $("#third_institute_programe").val();
                    $("#third_institute_programe").focus();
                   
                    Swal.fire('Please enter the name of programme you completed in another institution');
                    return false;

                }
                else{
                    return true;
                }
            });

            $("#step4_prev").click(function(){

                var school_name=$("#school_name").val();
                var school_city=$("#school_city").val();
                var school_programme=$("#school_programme").val();
                var another_institute=$("#another_institute").val();
                // `college_name`, `college_city`, `college_programme`
                var college_name=$("#college_name").val();
                var college_city=$("#college_city").val();
                var college_programme=$("#college_programme").val();

                var third_institute_name=$("#third_institute_name").val(); 
                var third_institute_city=$("#third_institute_city").val(); 
                var third_institute_programe=$("#third_institute_programe").val(); 

                var third_institute=$("#third_institute").val();
   
                if(school_name=="")
                {
                    
                    $("#school_name").val();
                    $("#school_name").focus();
                    
                    Swal.fire('Please enter the name of institution');
                    return false;
                            
                }
                else if(school_city=="")
                {
                    
                    $("#school_city").val();
                    $("#school_city").focus();
                   
                    Swal.fire('Please enter the city of the institution');
                    return false;
                            
                }
                else if(school_programme=="")
                {
                    
                    $("#school_programme").val();
                    $("#school_programme").focus();
                   
                    Swal.fire('Please enter the name of programme you completed');
                    return false;
                            
                }
                else if(another_institute==1 && college_name==""){
                    $("#college_name").val();
                    $("#college_name").focus();
                   
                    Swal.fire('Please enter the name of another institution');
                    return false;

                }
                else if(another_institute==1 && college_city==""){
                    $("#college_city").val();
                    $("#college_city").focus();
                   
                    Swal.fire('Please enter the name of another institution city');
                    return false;

                }
                else if(another_institute==1 && college_programme==""){
                    $("#college_programme").val();
                    $("#college_programme").focus();
                   
                    Swal.fire('Please enter the name of programme you completed in another institution');
                    return false;

                }

                else if(third_institute==1 && third_institute_name==""){
                    $("#third_institute_name").val();
                    $("#third_institute_name").focus();
                   
                    Swal.fire('Please enter the name of another institution');
                    return false;

                }
                else if(third_institute==1 && third_institute_city==""){
                    $("#third_institute_city").val();
                    $("#third_institute_city").focus();
                   
                    Swal.fire('Please enter the name of another institution city');
                    return false;

                }
                else if(third_institute==1 && third_institute_programe==""){
                    $("#third_institute_programe").val();
                    $("#third_institute_programe").focus();
                   
                    Swal.fire('Please enter the name of programme you completed in another institution');
                    return false;

                }
                else{
                    return true;
                }
            });

            
            $("#step5_prev").click(function(){

                var org_name=$("#org-name").val();
                var designation=$("#designation").val();
                var company_incorporation_is=$("#company_incorporation_is").val();
                var company_incorporation_date=$("#company-incorporation-date").val();
                var year_experience=$('#year-experience').val();
                var specified_org_type=$('#specified_org_type').val();
                
                var org_address=$('#org-address').val();
                var org_city=$('#org-city').val();
                var org_state=$('#org-state').val();
                var org_pin=$('#org-pin').val();
                var org_email=$('#org-email').val();
                var org_contactno=$('#org-contactno').val();
                   
                if(org_name=="")
                {
                    
                    $("#org-name").val();
                    $("#org-name").focus();
                    $('#org_det').focus();
                    Swal.fire("Please enter organization's name");
                    return false;
                            
                }
                else if(designation=="")
                {
                    
                    $("#designation").val();
                    $("#designation").focus();
                    $('#org_det').focus();
                    Swal.fire("Please enter organization's designation and department");
                    return false;
                            
                }
                else if(company_incorporation_is==""){

                    $("#company_incorporation_is").val();
                    $("#company_incorporation_is").focus();
                    
                    Swal.fire("Please enter the type of organization");
                    return false;



                }
                else if(company_incorporation_is=='Others' && specified_org_type==""){
                    $("#specified_org_type").val();
                    $("#specified_org_type").focus();
                    
                    Swal.fire("Please specify the type of the organization");
                    return false;
                } 
                else if(company_incorporation_date=="" || company_incorporation_date=="01-01-1970")
                {
                    
                    $("#company-incorporation-date").val();
                    $("#company-incorporation-date").focus();
                    $('#org_det').focus();
                    Swal.fire("Please enter organization's date of formation");
                    return false;
                            
                }
                else if(year_experience=="")
                {
                    
                    $("#year-experience").val();
                    $("#year-experience").focus();
                    $('#org_det').focus();
                    Swal.fire("Please enter organization's years of work experience");
                    return false;
                            
                }
                 //org_address,org_city,org_state,org_pin,org_email,org_contactno
                else if(org_address=="")
                {
                    
                    $("#org-address").val();
                    $("#org-address").focus();
                    
                    Swal.fire("Please enter organization's address");
                    return false;
                            
                }
                else if(org_city=="")
                {
                    
                    $("#org-city").val();
                    $("#org-city").focus();
                  
                    Swal.fire("Please enter organization's city");
                    return false;
                            
                }
                else if(org_state=="")
                {
                    
                    $("#org-state").val();
                    $("#org-state").focus();
                   
                    Swal.fire("Please enter organization's state");
                    return false;
                            
                }
                else if(org_pin=="")
                {
                    
                    $("#org-pin").val();
                    $("#org-pin").focus();
                    
                    Swal.fire("Please enter organization's pincode");
                    return false;
                            
                }
                else if(org_email=="")
                {
                    
                    $("#org-email").val();
                    $("#org-email").focus();
                   
                    Swal.fire("Please enter organization's E-mail ID");
                    return false;
                            
                }
                else if(org_contactno=="")
                {
                    
                    $("#org-contactno").val();
                    $("#org-contactno").focus();
                    
                    Swal.fire("Please enter organization's contact number");
                    return false;
                            
                }
                else{
                    return true;
                }
            });

            $("#step5_submit").click(function(){

                var org_name=$("#org-name").val();
                var designation=$("#designation").val();
                var company_incorporation_is=$("#company_incorporation_is").val();
                var specified_org_type=$('#specified_org_type').val();
                var company_incorporation_date=$("#company-incorporation-date").val();
                var year_experience=$('#year-experience').val();

                var org_address=$('#org-address').val();
                var org_city=$('#org-city').val();
                var org_state=$('#org-state').val();
                var org_pin=$('#org-pin').val();
                var org_email=$('#org-email').val();
                var org_contactno=$('#org-contactno').val();
                   
                if(org_name=="")
                {
                    
                    $("#org-name").val();
                    $("#org-name").focus();
                    $('#org_det').focus();
                    Swal.fire("Please enter organization's name");
                    return false;
                            
                }
                else if(designation=="")
                {
                    
                    $("#designation").val();
                    $("#designation").focus();
                    $('#org_det').focus();
                    Swal.fire("Please enter organization's designation and department");
                    return false;
                            
                }
                else if(company_incorporation_is==""){

                    $("#company_incorporation_is").val();
                    $("#company_incorporation_is").focus();
                    
                    Swal.fire("Please enter the type of organization");
                    return false;



                }
                else if(company_incorporation_is=='Others' && specified_org_type==""){
                    $("#specified_org_type").val();
                    $("#specified_org_type").focus();
                    
                    Swal.fire("Please specify the type of the organization");
                    return false;
                } 
                else if(company_incorporation_date=="" || company_incorporation_date=="01-01-1970")
                {
                    
                    $("#company-incorporation-date").val();
                    $("#company-incorporation-date").focus();
                    $('#org_det').focus();
                    Swal.fire("Please enter organization's date of formation");
                    return false;
                            
                }
                else if(year_experience=="")
                {
                    
                    $("#year-experience").val();
                    $("#year-experience").focus();
                    $('#org_det').focus();
                    Swal.fire("Please enter organization's years of work experience");
                    return false;
                            
                }
                 //org_address,org_city,org_state,org_pin,org_email,org_contactno
                else if(org_address=="")
                {
                    
                    $("#org-address").val();
                    $("#org-address").focus();
                    
                    Swal.fire("Please enter organization's address");
                    return false;
                            
                }
                else if(org_city=="")
                {
                    
                    $("#org-city").val();
                    $("#org-city").focus();
                  
                    Swal.fire("Please enter organization's city");
                    return false;
                            
                }
                else if(org_state=="")
                {
                    
                    $("#org-state").val();
                    $("#org-state").focus();
                   
                    Swal.fire("Please enter organization's state");
                    return false;
                            
                }
                else if(org_pin=="")
                {
                    
                    $("#org-pin").val();
                    $("#org-pin").focus();
                    
                    Swal.fire("Please enter organization's pincode");
                    return false;
                            
                }
                else if(org_email=="")
                {
                    
                    $("#org-email").val();
                    $("#org-email").focus();
                   
                    Swal.fire("Please enter organization's E-mail ID");
                    return false;
                            
                }
                else if(org_contactno=="")
                {
                    
                    $("#org-contactno").val();
                    $("#org-contactno").focus();
                    
                    Swal.fire("Please enter organization's contact number");
                    return false;
                            
                }
                else{
                    return true;
                }
            });

            // step4_submit // `school_name`, `school_city`, `school_year`, `school_certificate`, `college_name`, `college_city`, `college_year`, `college_certificate`

           


            

            // step3_submit

            $("#step3_submit").click(function(){

                var applicant_name=$("#applicant-name").val();
                var dob=$("#dob").val();
                var mobile=$("#mobile").val();
                var email_id=$('#email-id').val();
                var your_role=$('#your-role').val();

                var alternate_contact_name=$('#alternate_contact_name').val();
                var alternate_contact=$('#alternate_contact').val();
                var alternate_contact_relationship=$('#alternate_contact_relationship').val();
                var specify_reltion=$('#specify_reltion').val();
                   
                if(applicant_name=="")
                {
                    
                    $("#applicant-name").val();
                    $("#applicant-name").focus();
                    
                    Swal.fire("Please enter applicant's name");
                    return false;
                            
                }
                else if(dob=="" || dob=="01-01-1970")
                {
                    
                    $("#dob").val();
                    $("#dob").focus();
                   
                    Swal.fire("Please enter applicant's date of birth");
                    return false;
                            
                }
                else if(mobile=="")
                {
                    
                    $("#mobile").val();
                    $("#mobile").focus();
                    
                    Swal.fire("Please enter applicant's mobile number");
                    return false;
                            
                }
                else if(email_id=="")
                {
                    
                    $("#email-id").val();
                    $("#email-id").focus();
                    
                    Swal.fire("Please enter applicant's E-mail ID");
                    return false;
                            
                }
                 else if(alternate_contact_name=="")
                {
                    
                    $("#alternate_contact_name").val();
                    $("#alternate_contact_name").focus();
                    
                    Swal.fire("Please enter the alternate contacts name");
                    return false;
                            
                }
                else if(alternate_contact=="")
                {
                    
                    $("#alternate_contact").val();
                    $("#alternate_contact").focus();
                    
                    Swal.fire("Please enter alternate contacts phone number");
                    return false;
                            
                }
                else if(alternate_contact_relationship=="")
                {
                    
                    $("#alternate_contact_relationship").val();
                    $("#alternate_contact_relationship").focus();
                    
                    Swal.fire("Please enter their relationship to you");
                    return false;
                            
                }
                else if(alternate_contact_relationship=='Other' && specify_reltion==""){
                    $("#specify_reltion").val();
                    $("#specify_reltion").focus();
                    
                    Swal.fire("Please specify the relationship to you");
                    return false;
                }
                else if(your_role==""){
                    $("#your-role").val();
                    $("#your-role").focus();
                    
                    Swal.fire("Write a brief bio about your role and the work you do and why it excites you");
                    return false;
                    
                }
                else{
                    return true;
                }
            });
            $("#step3_prev").click(function(){

                var applicant_name=$("#applicant-name").val();
                var dob=$("#dob").val();
                var mobile=$("#mobile").val();
                var email_id=$('#email-id').val();
                var your_role=$('#your-role').val();
               
                var alternate_contact_name=$('#alternate_contact_name').val();
                var alternate_contact=$('#alternate_contact').val();
                var alternate_contact_relationship=$('#alternate_contact_relationship').val();
                var specify_reltion=$('#specify_reltion').val();
                   
                if(applicant_name=="")
                {
                    
                    $("#applicant-name").val();
                    $("#applicant-name").focus();
                    
                    Swal.fire("Please enter applicant's name");
                    return false;
                            
                }
                else if(dob=="" || dob=="01-01-1970")
                {
                    
                    $("#dob").val();
                    $("#dob").focus();
                   
                    Swal.fire("Please enter applicant's date of birth");
                    return false;
                            
                }
                else if(mobile=="")
                {
                    
                    $("#mobile").val();
                    $("#mobile").focus();
                    
                    Swal.fire("Please enter applicant's mobile number");
                    return false;
                            
                }
                else if(email_id=="")
                {
                    
                    $("#email-id").val();
                    $("#email-id").focus();
                    
                    Swal.fire("Please enter applicant's E-mail ID");
                    return false;
                            
                }
                 else if(alternate_contact_name=="")
                {
                    
                    $("#alternate_contact_name").val();
                    $("#alternate_contact_name").focus();
                    
                    Swal.fire("Please enter the alternate contacts name");
                    return false;
                            
                }
                else if(alternate_contact=="")
                {
                    
                    $("#alternate_contact").val();
                    $("#alternate_contact").focus();
                    
                    Swal.fire("Please enter alternate contacts phone number");
                    return false;
                            
                }
                else if(alternate_contact_relationship=="")
                {
                    
                    $("#alternate_contact_relationship").val();
                    $("#alternate_contact_relationship").focus();
                    
                    Swal.fire("Please enter their relationship to you");
                    return false;
                            
                } 
                else if(alternate_contact_relationship=='Other' && specify_reltion==""){
                    $("#specify_reltion").val();
                    $("#specify_reltion").focus();
                    
                    Swal.fire("Please specify the relationship to you");
                    return false;
                }  
                else if(your_role==""){
                    $("#your-role").val();
                    $("#your-role").focus();
                    
                    Swal.fire("Write a brief bio about your role and the work you do and why it excites you");
                    return false;
                    
                }
                else{
                    return true;
                }
            });

            // step6_submit

            $("#step6_submit").click(function(){

                var your_thoughts=$("#your-thoughts").val();
                var womans_crown=$("#womans-crown").val();
                
                   
                if(your_thoughts=="" && womans_crown=="")
                {
                    
                    
                    $("#your-thoughts").focus();
                    
                    Swal.fire("Answering one question between 1 & 2 is mandatory");
                    return false;
                            
                }
                else{
                    return true;
                }
            });
            $("#step6_prev").click(function(){

                var your_thoughts=$("#your-thoughts").val();
                var womans_crown=$("#womans-crown").val();
                
                   
                if(your_thoughts=="" && womans_crown=="")
                {
                    
                    
                    $("#your-thoughts").focus();
                    
                    Swal.fire("Answering one question between 1 & 2 is mandatory");
                    return false;
                            
                }
                else{
                    return true;
                }
            });


            // step7_submit

            $("#step7_submit").click(function(){

                var support_entry=$("#support-entry").val();
                var support_entry_name=$("#support_entry_name").val();
            
                   
                if(support_entry=="" && support_entry_name=="")
                {
                    
                    
                    $("#support_entry_name").focus();
                    
                    Swal.fire("Please upload the passport-sized photo");
                    return false;
                            
                }
                else{
                    return true;
                }
            });
            $("#step7_prev").click(function(){

                var support_entry=$("#support-entry").val();
                var support_entry_name=$("#support_entry_name").val();
            
                   
                if(support_entry=="" && support_entry_name=="")
                {
                    
                    
                    $("#support_entry_name").focus();
                    
                    Swal.fire("Please upload the passport-sized photo");
                    return false;
                            
                }
                else{
                    return true;
                }
            });


            // final_submit

            $("#final_submit").click(function(){

                var signature=$("#signature").val();
                var signature_name=$("#signature_name").val();
                
                
                if(!$("input[type=checkbox][name=declaration]:checked").val())
                {
                    
                    
                    $("#declaration").focus();
                    
                    Swal.fire("Please accept the declaration");
                    return false;
                            
                }
                else if(!$("input[type=checkbox][name=terms]:checked").val())
                {
                    
                    
                    $("#terms").focus();
                    
                    Swal.fire("Please accept the term & conditions");
                    return false;
                            
                }
                else if(signature=="" && signature_name=="")
                {
                    
                    
                    $("#signature_name").focus();
                    
                    Swal.fire("Please upload your digital signature");
                    return false;
                            
                }
                
                else{
                    return true;
                }
            });
            $("#final_prev").click(function(){

                var signature=$("#signature").val();
                var signature_name=$("#signature_name").val();
                
                
                if(!$("input[type=checkbox][name=declaration]:checked").val())
                {
                    
                    
                    $("#declaration").focus();
                    
                    Swal.fire("Please accept the declaration");
                    return false;
                            
                }
                else if(!$("input[type=checkbox][name=terms]:checked").val())
                {
                    
                    
                    $("#terms").focus();
                    
                    Swal.fire("Please accept the term & conditions");
                    return false;
                            
                }
                else if(signature=="" && signature_name=="")
                {
                    
                    
                    $("#signature_name").focus();
                    
                    Swal.fire("Please upload your digital signature");
                    return false;
                            
                }
                
                else{
                    return true;
                }
            });


            // school certificate
            $('#school_certificate').change(function(){ 
                
             
              var school_certificate=$('#school_certificate').val();
              $('#school_certificate_name').val(school_certificate);

            });

            // college certificate
            $('#college_certificate').change(function(){ 
                
             
              var college_certificate=$('#college_certificate').val();
              $('#college_certificate_name').val(college_certificate);

            });

            // third institute certificate
            $('#third_institute_certificate').change(function(){ 
                
             
              var third_institute_certificate=$('#third_institute_certificate').val();
              $('#third_institute_certificate_name').val(third_institute_certificate);

            });

            $('#bio-video').change(function(){ 
                
             
              var bio_video=$('#bio-video').val();
              $('#bio_video_name').val(bio_video);

            });
            // support_entry

            $('#support-entry').change(function(){ 
                
             
              var support_entry=$('#support-entry').val();
              $('#support_entry_name').val(support_entry);

            });
            // awards_recognition

            $('#awards-recognition').change(function(){ 
                
             
              var awards_recognition=$('#awards-recognition').val();
              $('#awards_recognition_name').val(awards_recognition);

            });
            // letter_from_organization

            $('#letter-from-organization').change(function(){ 
                
             
              var letter_from_organization=$('#letter-from-organization').val();
              $('#letter_from_organization_name').val(letter_from_organization);

            });

            



            $("#org-pin").on("change", function() {
                var val = parseInt(this.value);
                if(val.toString().length!= 6)
                {
                    Swal.fire('Please enter a valid pincode');
                    this.value ='';        
                }
            });


            $("#guest_email").on("change", function() {
                 var email = $('#guest_email').val();

                var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if(!regex.test(email)) {
                   Swal.fire("Please enter a valid E-mail ID");

                    this.value ='';  
                }


              });

            // step three email validation
            $("#org-email").on("change", function() {
                 var email = $('#org-email').val();

                var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if(!regex.test(email)) {
                   Swal.fire("Please enter a valid E-mail ID");

                    this.value ='';  
                }


              });

            // step four email validation
            $("#email-id").on("change", function() {
                 var email = $('#email-id').val();

                var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if(!regex.test(email)) {
                   Swal.fire("Please enter a valid E-mail ID");

                    this.value ='';  
                }


              });

            // alternate_contact validation
            $("#alternate_contact").on("change", function() {
                  var val = parseInt(this.value);
                  if(val!=""){
                    if(val.toString().length!= 10)
                    {
                        Swal.fire('Please enter a valid alternate contacts number');
                        this.value ='';  
                        $("#alternate_contact").val("");      
                    }
                }
              });



            // step one phone validataion
             $("#guest_phone").on("change", function() {
                  var val = parseInt(this.value);
                  if(val!=""){
                    if(val.toString().length!= 10)
                    {
                        Swal.fire('Please enter a valid mobile number');
                        this.value ='';        
                    }
                }
              });
             // step three phone validation
             $("#org-contactno").on("change", function() {
                  var val = parseInt(this.value);
                  if(val!=""){
                    if(val.toString().length!= 10)
                    {
                        Swal.fire('Please enter a valid mobile number');
                        this.value ='';        
                    }
                }
              });


             // step four phone validation 
             $("#guest_phone").on("change", function() {
                  var val = parseInt(this.value);
                  if(val!=""){
                    if(val.toString().length!= 10)
                    {
                        Swal.fire('Please enter a valid mobile number');
                        this.value ='';        
                    }
                }
              });

              
              // school certificate.jpg, .jpeg, .png, .pdf
             $("#school_certificate").on("change", function() {

                  var file=$('#school_certificate').val();
                  var ext = $('#school_certificate').val().split('.').pop().toLowerCase();
                  var fileSize = $("#school_certificate")[0].files[0].size;//size in MB

                  if($.inArray(ext, ['png','jpg','jpeg','pdf']) == -1) {
                     Swal.fire('Please upload an acceptable file type');
                     this.value ='';
                      $("#school_certificate").val("");
                      $("#school_certificate_name").val("");
                  }
                  else if(fileSize>5000000){

                    Swal.fire('Do not exceed the file size limit (5MB)');
                     this.value ='';
                      $("#school_certificate").val("");
                      $("#school_certificate_name").val("");
                  }
                  
              });
             // college certificate.jpg, .jpeg, .png, .pdf
             $("#college_certificate").on("change", function() {

                  var file=$('#college_certificate').val();
                  var ext = $('#college_certificate').val().split('.').pop().toLowerCase();
                  var fileSize = $("#college_certificate")[0].files[0].size;//size in MB

                  if($.inArray(ext, ['png','jpg','jpeg','pdf']) == -1) {
                     Swal.fire('Please upload an acceptable file type');
                     this.value ='';
                      $("#college_certificate").val("");
                      $("#college_certificate_name").val("");
                  }
                  else if(fileSize>5000000){

                    Swal.fire('Do not exceed the file size limit (5MB)');
                     this.value ='';
                      $("#college_certificate").val("");
                      $("#college_certificate_name").val("");
                  }
                  
              });

             // support-entry.jpg, .jpeg, .png, .pdf
             $("#support-entry").on("change", function() {

                  var file=$('#support-entry').val();
                  var ext = $('#support-entry').val().split('.').pop().toLowerCase();
                  var fileSize = $("#support-entry")[0].files[0].size;//size in MB

                  if($.inArray(ext, ['png','jpg','jpeg','pdf']) == -1) {
                     Swal.fire('Please upload an acceptable file type');
                     this.value ='';
                      $("#support-entry").val("");
                      $("#support_entry_name").val("");
                  }
                  else if(fileSize>5000000){

                    Swal.fire('Do not exceed the file size limit (5MB)');
                     this.value ='';
                      $("#support-entry").val("");
                      $("#support_entry_name").val("");
                  }
                  
              });

             // awards-recognition
             $("#awards-recognition").on("change", function() {

                  var file=$('#awards-recognition').val();
                  var ext = $('#awards-recognition').val().split('.').pop().toLowerCase();
                  var fileSize = $("#awards-recognition")[0].files[0].size;//size in MB

                  if($.inArray(ext, ['doc','docs','docx']) == -1) {
                     Swal.fire('Please upload an acceptable file type');
                     this.value ='';
                      $("#awards-recognition").val("");
                      $("#awards_recognition_name").val("");
                  }
                  else if(fileSize>5000000){

                    Swal.fire('Do not exceed the file size limit (5MB)');
                     this.value ='';
                      $("#awards-recognition").val("");
                      $("#awards_recognition_name").val("");
                  }
                  
              });
             // letter-from-organization

             $("#letter-from-organization").on("change", function() {

                  var file=$('#letter-from-organization').val();
                  var ext = $('#letter-from-organization').val().split('.').pop().toLowerCase();
                  var fileSize = $("#letter-from-organization")[0].files[0].size;//size in MB

                  if($.inArray(ext, ['png','jpg','jpeg','pdf','doc','docs','docx']) == -1) {
                     Swal.fire('Please upload an acceptable file type');
                     this.value ='';
                      $("#letter-from-organization").val("");
                      $("#letter_from_organization_name").val("");
                  }
                  else if(fileSize>5000000){

                    Swal.fire('Do not exceed the file size limit (5MB)');
                     this.value ='';
                      $("#letter-from-organization").val("");
                      $("#letter_from_organization_name").val("");
                  }
                  
              });


             // bio video

             $("#bio-video").on("change", function() {

                  var file=$('#bio-video').val();
                  var ext = $('#bio-video').val().split('.').pop().toLowerCase();
                  var fileSize = $("#bio-video")[0].files[0].size;//size in MB

                  if($.inArray(ext, ['mp4','mov','mkv','avi','wmv','avchd','flv']) == -1) {
                     Swal.fire('Please upload an acceptable file type');
                     this.value ='';
                      $("#bio-video").val("");
                      $("#bio_video_name").val("");
                  }
                  else if(fileSize>10000000){

                    Swal.fire('Do not exceed the file size limit (10MB)');
                     this.value ='';
                      $("#bio-video").val("");
                      $("#bio_video_name").val("");
                  }
                  
              });

             // signature

             $("#signature").on("change", function() {

                  var file=$('#signature').val();
                  var ext = $('#signature').val().split('.').pop().toLowerCase();
                  var fileSize = $("#signature")[0].files[0].size;//size in MB

                  if($.inArray(ext, ['png','jpg','jpeg','pdf']) == -1) {
                     Swal.fire('Please upload an acceptable file type (example: png, jpg, jpeg, pdf)');
                     this.value ='';
                      $("#signature").val("");
                      $("#signature_name").val("");
                  }
                  else if(fileSize>5000000){

                    Swal.fire('Do not exceed the file size limit (5MB)');
                     this.value ='';
                      $("#signature").val("");
                      $("#signature_name").val("");
                  }
                  
              });



        });
    </script>
    </body>
</html>