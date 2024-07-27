$(document).ready(function () {
  //alert();
  $('input[name="company_incorporation_date"]').inputmask("date", {
    mask: "1/2/y",
    placeholder: "dd/mm/yyyy",
    leapday: "/02/29",
    separator: "/",
    alias: "dd/mm/yyyy"
  });
  $('input[name="dob"]').inputmask("date", {
    mask: "1/2/y",
    placeholder: "dd/mm/yyyy",
    leapday: "/02/29",
    separator: "/",
    alias: "dd/mm/yyyy"
  });
});
$(".account").click(function () {

  var APP_URL = $("#msform").attr('action');
  $("#step2").val(1);
  $.ajax({
    type: "POST",
    url: APP_URL,
    async: false,
    //dataType: "json",
    data: $("#msform").serialize(),
    // beforeSend: function() {
    //   $("#loader3").show();
    // },
    // complete: function() {
    //   $("#loader3").hide();
    // },
    success: function (data, textStatus, jqXHR) {
      if (data != '') {
        //alert(data);

      }
      else {
        alert('Something went wrong ! Please try again.. ')
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      //$(".submitting").html('<p>Message failed to send. Please try again!</p>');
    }
  });
  var current_fs, next_fs, previous_fs; //fieldsets
  var opacity;
  current_fs = $(this).parent();
  next_fs = $(this).parent().next();

  //Add Class Active
  $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

  //show the next fieldset
  next_fs.show();
  //hide the current fieldset with style
  current_fs.animate({ opacity: 0 }, {
    step: function (now) {
      // for making fielset appear animation
      opacity = 1 - now;

      current_fs.css({
        'display': 'none',
        'position': 'relative'
      });
      next_fs.css({ 'opacity': opacity });
    },
    duration: 600
  });
});


$(".organization-details").click(function () {
  var current_fs, next_fs, previous_fs; //fieldsets
  var opacity;

  var org_name = $("#org-name").val();
  var org_website = $("#org-website").val();
  var designation = $("#designation").val();
  var org_email = $("#org-email").val();
  var incorporation_date = $("#company-incorporation-date").val();
  var year_experience = $("#year-experience").val();

  var dp_linkedin = $("#dp-linkedin").val();
  var dp_facebook = $("#dp-facebook").val();
  var dp_twitter = $("#dp-twitter").val();
  var dp_instagram = $("#dp-instagram").val();
  $(".error-span").addClass('d-none');
  var error = 0;
  if ($.trim(org_name) == '') {
    $("#error_org-name").removeClass('d-none');
    error++;
  }
  if ($.trim(designation) == '') {
    $("#error_designation").removeClass('d-none');
    error++;
  }
  if ($.trim(incorporation_date) == '') {
    $("#error_company-incorporation-date").removeClass('d-none');
    error++;
  }
  else {
    //incorporation_date = incorporation_date.replace("/", "-");
    //incorporation_date = incorporation_date.replace("/", "-");
    var incorporation_date = moment(incorporation_date, ['DD-MM-YYYY', 'MM-DD-YYYY']).format('MMM DD YYYY h:mm A');
    var selectedDate = new Date(incorporation_date);
    var now = new Date();
    // alert(now2);
    //  alert(incorporation_date);
    //  alert(selectedDate);
    //  alert(now);
    // var newdate = incorporation_date.split("-");
    //var newdate = selectedDate.split("/");
    //alert('newdate',newdate[1]);
    if (selectedDate > now) {
      //alert();
      $("#error_company-incorporation-date").removeClass('d-none').text("Date must be in the past");
      error++;
    }
  }
  if ($.trim(year_experience) == '') {
    $("#error_year-experience").removeClass('d-none');
    error++;
  }
  if ($.trim(org_email) == '') {
    // $("#error_org-email").removeClass('d-none');
    // error++;
  }
  else {
    var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    if (!testEmail.test(org_email)) {
      $("#error_org-email").text('Invalid email format.').removeClass('d-none');
      error++;
    }
  }
  if ($.trim(org_website) != '') {
    var res = org_website.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
    if (res == null) {
      $("#error_org-website").removeClass('d-none');
      error++;
    }
  }
  if ($.trim(dp_linkedin) != '') {
    var res = dp_linkedin.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
    if (res == null) {
      $("#error_dp-linkedin").removeClass('d-none');
      error++;
    }
  }
  if ($.trim(dp_facebook) != '') {
    var res = dp_facebook.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
    if (res == null) {
      $("#error_dp-facebook").removeClass('d-none');
      error++;
    }
  }
  if ($.trim(dp_twitter) != '') {
    var res = dp_twitter.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
    if (res == null) {
      $("#error_dp-twitter").removeClass('d-none');
      error++;
    }
  }
  if ($.trim(dp_instagram) != '') {
    var res = dp_instagram.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
    if (res == null) {
      $("#error_dp-instagram").removeClass('d-none');
      error++;
    }
  }
  //if (org_name != '' && current_profile != '' && designation != '' && incorporation_date != '' && year_experience != '') {
  if (error == 0) {
    $("#step3").val(1);
    var APP_URL = $("#msform").attr('action');
    $.ajax({
      type: "POST",
      url: APP_URL,
      async: false,
      //dataType: "json",
      data: $("#msform").serialize(),
      // beforeSend: function() {
      //   $("#loader3").show();
      // },
      // complete: function() {
      //   $("#loader3").hide();
      // },
      success: function (data, textStatus, jqXHR) {
        if (data != '') {
          //alert(data);

        }
        else {
          alert('Something went wrong ! Please try again.. ')
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        //$(".submitting").html('<p>Message failed to send. Please try again!</p>');
      }
    });

    current_fs = $(this).parent();
    next_fs = $(this).parent().next();

    //Add Class Active
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate({ opacity: 0 }, {
      step: function (now) {
        // for making fielset appear animation
        opacity = 1 - now;

        current_fs.css({
          'display': 'none',
          'position': 'relative'
        });
        next_fs.css({ 'opacity': opacity });
      },
      duration: 600
    });
  }
  // }
});

$(".applicant-details").click(function () {
  var current_fs, next_fs, previous_fs; //fieldsets
  var opacity;

  var applicant_name = $("#applicant-name").val();
  var dob = $("#dob").val();
  var mobile = $("#mobile").val();
  var email_id = $("#email-id").val();
  //var social_media = $("#social-media").val();
  var linkedin_profile = $("#linkedin-profile").val();
  var your_role = $("#your-role").val();
  var bio_video = $("#bio-video").val();
  // var past_organization_name = $("#past-organization-name").val();
  // var validEmail = 0;
  // if (email_id == '') {
  //   // $("#error_modal_guest_email").removeClass('d-none');
  //   validEmail++;
  // }
  // else {
  //   var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
  //   if (!testEmail.test(email_id)) {
  //     //$("#error_modal_guest_email").text('Invalid email.').removeClass('d-none');
  //     validEmail++;
  //   }
  // }
  //if (applicant_name != '' && dob != '' && designation != '' && mobile != '' && email_id != '' && social_media != '' && linkedin_profile != '' && your_role != '' && validEmail == 0) {
  $(".error-span").addClass('d-none');
  var error = 0;
  if ($.trim(applicant_name) == '') {
    $("#error_applicant-name").removeClass('d-none');
    error++;
  }
  if ($.trim(dob) == '') {
    $("#error_dob").removeClass('d-none').text("DOB is not set");
    error++;
  }
  else {
    var dob = moment(dob, ['DD-MM-YYYY', 'MM-DD-YYYY']).format('MMM DD YYYY h:mm A');
    var selectedDate = new Date(dob);
    var now = new Date();
    if (selectedDate > now) {
      //alert();
      $("#error_dob").removeClass('d-none').text("Date must be in the past");
      error++;
    }
  }
  if ($.trim(mobile) == '') {
    $("#error_mobile").removeClass('d-none');
    error++;
  }
  else {
    if ($.trim(mobile).length != 10) {
      $("#error_mobile").removeClass('d-none').text('Invalid mobile number');
      error++;
    }
  }
  if ($.trim(email_id) == '') {
    $("#error_email-id").removeClass('d-none');
    error++;
  }
  else {
    var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    if (!testEmail.test(email_id)) {
      $("#error_email-id").text('Invalid email format.').removeClass('d-none');
      error++;
    }
  }
  if ($.trim(linkedin_profile) != '') {
    var res = linkedin_profile.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
    if (res == null) {
      $("#error_linkedin-profile").removeClass('d-none');
      error++;
    }
  }
  if (bio_video != '') {
    var ext = $('#bio-video').val().split('.').pop().toLowerCase();
    var file_size = $('#bio-video')[0].files[0].size;
    if ($.inArray(ext, ['mp4']) == -1) {
      //e.preventDefault();
      $("#error_bio-video").removeClass('d-none');
      error++;
    }
    if (file_size > 10485760) {
      $("#error_bio-video").removeClass('d-none').text('Filesize must 10 mb or below');
      error++;
    }
  }
  if (error == 0) {
    $("#step4").val(1);
    var APP_URL = $("#msform").attr('action');
    $.ajax({
      type: "POST",
      url: APP_URL,
      async: false,
      //dataType: "json",
      data: $("#msform").serialize(),
      // beforeSend: function() {
      //   $("#loader3").show();
      // },
      // complete: function() {
      //   $("#loader3").hide();
      // },
      success: function (data, textStatus, jqXHR) {
        if (data != '') {
          //alert(data);

        }
        else {
          alert('Something went wrong ! Please try again.. ')
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        //$(".submitting").html('<p>Message failed to send. Please try again!</p>');
      }
    });

    current_fs = $(this).parent();
    next_fs = $(this).parent().next();

    //Add Class Active
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate({ opacity: 0 }, {
      step: function (now) {
        // for making fielset appear animation
        opacity = 1 - now;

        current_fs.css({
          'display': 'none',
          'position': 'relative'
        });
        next_fs.css({ 'opacity': opacity });
      },
      duration: 600
    });
    //}
  }
});
$(".insightExpNext").click(function () {
  var current_fs, next_fs, previous_fs; //fieldsets
  var opacity;
  $(".error-span").addClass('d-none');
  var your_thoughts = $("textarea#your-thoughts").val();
  var womans_crown = $("textarea#womans-crown").val();
  //alert(your_thoughts);
  var error = 0;
  if ($.trim(your_thoughts) == '' && $.trim(womans_crown) == '') {
    $("#answeringOne").css('color', 'red');
    error++;
  }
  else {
    $("#answeringOne").css('color', '#9E9E9E');
  }
  if (error == 0) {
    $("#step5").val(1);
    var APP_URL = $("#msform").attr('action');
    $.ajax({
      type: "POST",
      url: APP_URL,
      async: false,
      //dataType: "json",
      data: $("#msform").serialize(),
      // beforeSend: function() {
      //   $("#loader3").show();
      // },
      // complete: function() {
      //   $("#loader3").hide();
      // },
      success: function (data, textStatus, jqXHR) {
        if (data != '') {
          //alert(data);

        }
        else {
          alert('Something went wrong ! Please try again.. ')
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        //$(".submitting").html('<p>Message failed to send. Please try again!</p>');
      }
    });

    current_fs = $(this).parent();
    next_fs = $(this).parent().next();

    //Add Class Active
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate({ opacity: 0 }, {
      step: function (now) {
        // for making fielset appear animation
        opacity = 1 - now;

        current_fs.css({
          'display': 'none',
          'position': 'relative'
        });
        next_fs.css({ 'opacity': opacity });
      },
      duration: 600
    });
  }
})
$(".uploadNextBtn").click(function () {
  var current_fs, next_fs, previous_fs; //fieldsets
  var opacity;
  var support = $('#support-entry').val();
  var videoo = $('#summarizing-work').val();
  var awards = $('#awards-recognition').val();
  var company = $('#company-incorporation-certificate').val();
  var letter = $('#letter-from-organization').val();
  var error = 0;
  $(".error-span").addClass('d-none');
  if (support != '') {
    var ext = $('#support-entry').val().split('.').pop().toLowerCase();
    //if ($.inArray(ext, ['jpg']) == -1) {
    if ($.inArray(ext, ['jpg', 'jpeg', 'png', 'pdf']) == -1) {
      //e.preventDefault();
      $("#error_support-entry").removeClass('d-none').text('Invalid file format.');
      error++;
    }
  }
  else {
    $("#error_support-entry").removeClass('d-none');
    error++;
  }
  // if (videoo != '') {
  //   var ext = $('#summarizing-work').val().split('.').pop().toLowerCase();
  //   if ($.inArray(ext, ['mp4']) == -1) {
  //     //e.preventDefault();
  //     $('#summarizing-error').css('display', 'block');
  //     error++;
  //   } else {
  //     $('#summarizing-error').css('display', 'none');
  //     $("#submit-form").prop('disabled', false);
  //   }
  // }
  if (awards != '') {
    var ext = $('#awards-recognition').val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['docx']) == -1) {
      //e.preventDefault();
      $("#error_awards-recognition").removeClass('d-none');
      error++;
    }
    // else {
    //   $('#awards-error').css('display', 'none');
    //   $("#submit-form").prop('disabled', false);
    // }
  }
  // if (company != '') {
  //   var ext = $('#company-incorporation-certificate').val().split('.').pop().toLowerCase();
  //   if ($.inArray(ext, ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx']) == -1) {
  //     //e.preventDefault();
  //     $('#company-error').css('display', 'block');
  //     error++;
  //   } else {
  //     $('#company-error').css('display', 'none');
  //     $("#submit-form").prop('disabled', false);
  //   }
  // }
  if (letter != '') {
    var ext = $('#letter-from-organization').val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx']) == -1) {
      //e.preventDefault();
      $("#error_letter-from-organization").removeClass('d-none');
      error++;
    }
    //  else {
    //   $('#letter-error').css('display', 'none');
    //   $("#submit-form").prop('disabled', false);
    // }
  }
  if (error == 0) {
    $("#step6").val(1);
    var APP_URL = $("#msform").attr('action');
    $.ajax({
      type: "POST",
      url: APP_URL,
      async: false,
      //dataType: "json",
      data: $("#msform").serialize(),
      // beforeSend: function() {
      //   $("#loader3").show();
      // },
      // complete: function() {
      //   $("#loader3").hide();
      // },
      success: function (data, textStatus, jqXHR) {
        if (data != '') {
          //alert(data);

        }
        else {
          alert('Something went wrong ! Please try again.. ')
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        //$(".submitting").html('<p>Message failed to send. Please try again!</p>');
      }
    });
    $("#step7").val(1);
    current_fs = $(this).parent();
    next_fs = $(this).parent().next();
    //Add Class Active
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate({ opacity: 0 }, {
      step: function (now) {
        // for making fielset appear animation
        opacity = 1 - now;

        current_fs.css({
          'display': 'none',
          'position': 'relative'
        });
        next_fs.css({ 'opacity': opacity });
      },
      duration: 600
    });
  }
});

$(".previous").click(function () {

  current_fs = $(this).parent();
  previous_fs = $(this).parent().prev();

  //Remove class active
  $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

  //show the previous fieldset
  previous_fs.show();

  //hide the current fieldset with style
  current_fs.animate({ opacity: 0 }, {
    step: function (now) {
      // for making fielset appear animation
      opacity = 1 - now;

      current_fs.css({
        'display': 'none',
        'position': 'relative'
      });
      previous_fs.css({ 'opacity': opacity });
    },
    duration: 600
  });
});

$('#msform').submit(function (e) {
  // alert('submit');
  let fl_check = true;
  if (!$('#checkbxstatus').is(':checked')) {
    e.preventDefault();
    $('#terms-error').css('display', 'block');
  }
var signature = $('#signature').val();
  var error = 0;
  if (signature != '') {
    var ext = $('#signature').val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['jpg', 'jpeg', 'png', 'pdf']) == -1) {
      e.preventDefault();
      $("#upload-signature-error").css('display', 'block').text('Invalid file format.');
    }
    else {
      $("#upload-signature-error").css('display', 'none');
    }
  }
  else {
    e.preventDefault();
    $("#upload-signature-error").css('display', 'block').text('Please upload your digital signature');
  }
  var support = $('#support-entry').val();
  var videoo = $('#summarizing-work').val();
  var awards = $('#awards-recognition').val();
  var company = $('#company-incorporation-certificate').val();
  var letter = $('#letter-from-organization').val();

  if (support != '') {
    var ext = $('#support-entry').val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['jpg', 'jpeg', 'png']) == -1) {
      e.preventDefault();
      $('#support-error').css('display', 'block');
      fl_check = false;
    } else {
      $('#support-error').css('display', 'none');
      $("#submit-form").prop('disabled', false);
    }
  }
  if (videoo != '') {
    var ext = $('#summarizing-work').val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['mp4']) == -1) {
      e.preventDefault();
      $('#summarizing-error').css('display', 'block');
      fl_check = false;
    } else {
      $('#summarizing-error').css('display', 'none');
      $("#submit-form").prop('disabled', false);
    }
  }
  if (awards != '') {
    var ext = $('#awards-recognition').val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx']) == -1) {
      e.preventDefault();
      $('#awards-error').css('display', 'block');
      fl_check = false;
    } else {
      $('#awards-error').css('display', 'none');
      $("#submit-form").prop('disabled', false);
    }
  }
  if (company != '') {
    var ext = $('#company-incorporation-certificate').val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx']) == -1) {
      e.preventDefault();
      $('#company-error').css('display', 'block');
      fl_check = false;
    } else {
      $('#company-error').css('display', 'none');
      $("#submit-form").prop('disabled', false);
    }
  }
  if (letter != '') {
    var ext = $('#letter-from-organization').val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx']) == -1) {
      e.preventDefault();
      $('#letter-error').css('display', 'block');
      fl_check = false;
    } else {
      $('#letter-error').css('display', 'none');
      $("#submit-form").prop('disabled', false);
    }
  }
  if (fl_check = true) {
    // alert('true');
    // $("#submit-form").attr('disabled','disabled');
    $("#submit-form").prop('disabled', true);
  } else {
    // alert('false');
    $("#submit-form").prop('disabled', false);
    // $("#submit-form").removeAttr('disabled');
  }


})

function terms_condition_check() {
  if ($("#checkbox").prop('checked') == false) {
    // alert('checked');
    $('#terms-error').css('display', 'block');
  } else {
    // alert('not checked');
    $('#terms-error').css('display', 'none');
  }
}



$(".allow-only-number").keyup(function () {
  var node = $(this);
  node.val(node.val().replace(/[^0-9]/g, ''));
});

$(".allow-only-alphabet-name").keyup(function () {
  var node = $(this);
  node.val(node.val().replace(/[^a-z^A-Z. ]/g, ''));
});

$(document).on("change", '.mobile-digit', function () {
  var value = $(this).val();
  if (value.length < 10) {
    $('#mobile-error').css('display', 'block');
  } else {
    $('#mobile-error').css('display', 'none');
  }
  // alert(value.length);
});

$(document).on("change", '.pin-digit', function () {
  var value = $(this).val();
  if (value.length < 6) {
    $('#pin-error').css('display', 'block');
  } else {
    $('#pin-error').css('display', 'none');
  }
});

$(document).on("change", '.email-pattern', function () {
  var value = $(this).val();
  var pattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
  if (!pattern.test($(this).val())) {
    $(this).css('border', '2px solid #ff0000');
    $(this).after('<label class="error" style="color: #ff0000">Invalid email</label>');
    valid = false;
  }
});

$(function () {
  $('.email-pattern').keyup(function () {
    $(this).next().remove('label');
    $(this).css('border', '1px solid #000000');
  });
});

$(".submit-enable").click(function () {
  $("#submit-form").prop('disabled', false);
});
$('input[name="category"]').on('change', function () {
  var sapnId = $(this).val();
  $(".categoryText").hide();
  $("#" + sapnId).show();
});
$("#you_shine").on('change', function () {
  var sapnId = $(this).val();
  $(".youshine").hide();
  if (sapnId != '') {
    $("#" + sapnId).show();
  }
});
// $(window).on('load', function () {
//   $("#modal_guest_name").val('');
//   $("#modal_guest_email").val('');
//   $("#modal_guest_phone").val('');
//   // $('#myModal').modal('show');
//   // $('#myModal').css("opacity", "1");
// });


$("#introNextBtn").on('click', function () {
  $(".error-span").addClass('d-none');
   $("#alreadySubmited").val(0);
  var modal_guest_name = $("#guest_name").val();
  var modal_guest_email = $("#guest_email").val();
  var modal_guest_phone = $("#guest_phone").val();
  var error = 0;
  if (modal_guest_name == '') {
    $("#error_guest_name").removeClass('d-none');
    error++;
  }
  if (modal_guest_email == '') {
    $("#error_guest_email").removeClass('d-none');
    error++;
  }
  else {
    var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    if (!testEmail.test(modal_guest_email)) {
      $("#error_guest_email").text('Invalid email format.').removeClass('d-none');
      error++;
    }
  }
  if (modal_guest_phone == '') {
    $("#error_guest_phone").removeClass('d-none');
    error++;
  }
  if (error == 0) {
    $("#step1").val(1);
    //$("#guest_name").val(modal_guest_name);
    //$("#guest_email").val(modal_guest_email);
    //$("#guest_phone").val(modal_guest_phone);
    var APP_URL = $("#msform").attr('introaction');;
    var csrfval = $("input[name=_token]").val();
    $.ajax({
      type: "POST",
      url: APP_URL,
      async: false,
      //dataType: "json",
      //data: $("#msform").serialize(),
      data: {
        "_token": csrfval,
        "guest_name": modal_guest_name,
        "guest_email": modal_guest_email,
        "guest_phone": modal_guest_phone,
      },
      // beforeSend: function() {
      //   $("#loader3").show();
      // },
      // complete: function() {
      //   $("#loader3").hide();
      // },
      success: function (data, textStatus, jqXHR) {
        //console.log(data);
        // alert(data.id);
        if (data.error == 'error') {
          $("#error_guest_isexists").removeClass('d-none').text('You have already filled the form.');
          $("#alreadySubmited").val(1);
        }
        else if (data != '' && data.id != '') {
          $("#guest_user_id").val(data.id);
          $('#category_' + data.category).attr('checked', 'checked');
          if (data.you_shine == 'under10') {
            $('#you_shine_u10').attr('checked', 'checked');
          }
          else if (data.you_shine == 'over10') {
            $('#you_shine_m10').attr('checked', 'checked');
          }
          $("#org-name").val(data.org_name);
          $("#designation").val(data.org_name);
          //$("#is_incorporated").val(data.org_name);
          $("#company_incorporation_is").val(data.is_incorporated).change();
          $("#company-incorporation-date").val(data.company_incorporation_date);
          $("#year-experience").val(data.year_experience);
          $("#org-address").val(data.org_address);
          $("#org-city").val(data.org_city);
          $("#org-state").val(data.org_state);
          $("#org-pin").val(data.org_pin);
          $("#org-email").val(data.org_email);
          $("#org-contactno").val(data.org_contactno);
          $("#org-website").val(data.org_website);
          if (data.digital_presence_instagram != '' && data.digital_presence_instagram != null) {
            $("#dp-instagram").val(data.digital_presence_instagram).show();
          }
          if (data.digital_presence_twitter != '' && data.digital_presence_twitter != null) {
            $("#dp-twitter").val(data.digital_presence_twitter).show();
          }
          if (data.digital_presence_facebook != '' && data.digital_presence_facebook != null) {
            $("#dp-facebook").val(data.digital_presence_facebook).show();
          }
          if (data.digital_presence_linkedin != '' && data.digital_presence_linkedin != null) {
            $("#dp-linkedin").val(data.digital_presence_linkedin).show();
          }
          $("#applicant-name").val(data.applicant_name);
          $("#dob").val(data.dob);
          $("#mobile").val(data.mobile);
          $("#email-id").val(data.email_id);
          $("#linkedin-profile").val(data.linkedin_profile);
          $("#your-role").text(data.your_role);
          if (data.past_organization_name != '' && data.past_organization_name != null) {
            var past_org_name = data.past_organization_name.split(",");
            $("#past-organization-name1").val(past_org_name[0]);
            $("#past-organization-name2").val(past_org_name[1]);
            $("#past-organization-name3").val(past_org_name[2]);
          }
          if (data.past_experience != '' && data.past_experience != null) {
            var past_org_exp = data.past_experience.split(",");
            $("#past-experience1").val(past_org_exp[0]);
            $("#past-experience2").val(past_org_exp[1]);
            $("#past-experience3").val(past_org_exp[2]);
          }
          //console.log(past_org_name);
          $("#your-thoughts").text(data.your_thoughts);
          $("#womans-crown").text(data.womans_crown);
          //$("#step1").val(data.step1);
          if (data.step2 != null) {
            $("#step2").val(data.step2);
          }
          if (data.step3 != null) {
            $("#step3").val(data.step3);
          }
          if (data.step4 != null) {
            $("#step4").val(data.step4);
          }
          if (data.step5 != null) {
            $("#step5").val(data.step5);
          }
          if (data.step6 != null) {
            $("#step6").val(data.step6);
          }
          if (data.step7 != null) {
            $("#step7").val(data.step7);
          }
          $('.modal-open').css("overflow", "visible");
          $(".modal-backdrop").removeClass("show");
          $(".modal-backdrop").css("display", "none");
        }
        else {
          alert('Something went wrong ! Please try again.. ')
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        //$(".submitting").html('<p>Message failed to send. Please try again!</p>');
      }
    });
    //setTimeout(function () {
    var alreadySubmited = $("#alreadySubmited").val();
    var moveid = '';
    if ($("#step2").val() == 1) {
      moveid = "introNextBtn";
    }
    if ($("#step3").val() == 1) {
      moveid = "catExpBtn";
    }
    if ($("#step4").val() == 1) {
      moveid = "orgDetId";
    }
    if ($("#step5").val() == 1) {
      moveid = "aplDetId";
    }
    if ($("#step6").val() == 1) {
      moveid = "qsnFieldId";
    }
    if ($("#step7").val() == 1) {
      moveid = "upldNextbtn";
    }
    allCheckConfirm();
    if (alreadySubmited == 0) {
    if (moveid != '') {
      //current_fs = $("#"+moveid).parent();
      current_fs = $("#introNextBtn").parent();
      next_fs = $("#" + moveid).parent().next();
      $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
      next_fs.show();
      current_fs.animate({ opacity: 0 }, {
        step: function (now) {
          opacity = 1 - now;
          current_fs.css({
            'display': 'none',
            'position': 'relative'
          });
          next_fs.css({ 'opacity': opacity });
        },
        duration: 600
      });
    }
    else {
      current_fs = $(this).parent();
      next_fs = $(this).parent().next();
      $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
      next_fs.show();
      current_fs.animate({ opacity: 0 }, {
        step: function (now) {
          opacity = 1 - now;
          current_fs.css({
            'display': 'none',
            'position': 'relative'
          });
          next_fs.css({ 'opacity': opacity });
        },
        duration: 600
      });
    }
    }
    //}, 1000);
  }
});
// $(document).on("change",'.category-change', function(){
//   var value = $(this).val();
//   // alert(value)
//   if(value == 'hairLifestyle'){
//     $('#hairLifestyle').css('display', 'block');
//     $('#visualArts').css('display', 'none');
//     $('#homeLifestyle').css('display', 'none');
//     $('#beautyWellness').css('display', 'none');
//     $('#advocacy').css('display', 'none');
//     $('#corporate').css('display', 'none');

//     $("#category-text").val('Women who have excelled and carved niche for themselves as writers orbproponents of the written or spoken word, whether in literary or non-literary context. We would also like to encourage submission across a range of Indian language.')
//   }
//   if(value == 'visualArts'){
//     $('#visualArts').css('display', 'block');
//     $('#hairLifestyle').css('display', 'none');
//     $('#homeLifestyle').css('display', 'none');
//     $('#beautyWellness').css('display', 'none');
//     $('#advocacy').css('display', 'none');
//     $('#corporate').css('display', 'none');
//     $('#category-text').val('Women who have excelled in the field of visual arts, which includes a variety of mediums painting and sketching to sculpture and printmaking and much more.');
//   }
//   if(value == 'homeLifestyle'){
//     $('#homeLifestyle').css('display', 'block');
//     $('#visualArts').css('display', 'none');
//     $('#hairLifestyle').css('display', 'none');
//     $('#beautyWellness').css('display', 'none');
//     $('#advocacy').css('display', 'none');
//     $('#corporate').css('display', 'none');
//     $('#category-text').val('Women who have excelled and been able to create models in the fields of home and lifestyle such as silverware, linen.');
//   }
//   if(value == 'beautyWellness'){
//     $('#beautyWellness').css('display', 'block');
//     $('#homeLifestyle').css('display', 'none');
//     $('#visualArts').css('display', 'none');
//     $('#hairLifestyle').css('display', 'none');
//     $('#advocacy').css('display', 'none');
//     $('#corporate').css('display', 'none');
//     $('#category-text').val('Women who have excelled and managed to carve a niche for themselves in the sectors of beauty and wellness, such as skincare, fitness, meditation and more.');
//   }
//   if(value == 'advocacy'){
//     $('#advocacy').css('display', 'block');
//     $('#beautyWellness').css('display', 'none');
//     $('#homeLifestyle').css('display', 'none');
//     $('#visualArts').css('display', 'none');
//     $('#hairLifestyle').css('display', 'none');
//     $('#corporate').css('display', 'none');
//     $('#category-text').val('Women who have excelled and managed to create a positive impact in their communities and have advocated and stood up for marginalised sesctions of society.');
//   }
//   if(value == 'corporate'){
//     $('#corporate').css('display', 'block');
//     $('#advocacy').css('display', 'none');
//     $('#beautyWellness').css('display', 'none');
//     $('#homeLifestyle').css('display', 'none');
//     $('#visualArts').css('display', 'none');
//     $('#hairLifestyle').css('display', 'none');
//     $('#category-text').val('Women who have excelled and made significant contributions in their organisations in the corporate sector.');
//   }
// });


$("#viewNext").on('click', function () {

  $('#finalMoal').modal('show');
  $('#finalMoal').css("opacity", "1");
});
$("#viewBack").on('click', function () {
  $('#finalMoal').modal('hide');
  $('#finalMoal').css({ "opacity": "0", "display": "none" });
  $('.modal-open').css("overflow", "visible");
  $(".modal-backdrop").removeClass("show");
  $(".modal-backdrop").css("display", "none");
});
function allCheckConfirm() {
  var guest_name = $("#guest_name").val();
  var guest_email = $("#guest_email").val();
  var guest_phone = $("#guest_phone").val();
  var category = $('input[name=category]:checked').data('text');
  // var you_shine = $("#you_shine option:selected").text();
  // var you_shine_val = $("#you_shine option:selected").val();
  // var shine_five = $("#shine-five").text();
  // var shine_fifteen = $("#shine-fifteen").text();
  // var shine_five = $('textarea#shine-five').val();
  // var shine_fifteen = $('textarea#shine-fifteen').val();
  var you_shine_val = $('input[name=you_shine]:checked').val();
  var you_shine_text = '';
  if (you_shine_val == 'under10') {
    you_shine_text = "You Shine (5 to 10 years of experience)";
  }
  else {
    you_shine_text = "You Inspire (More than 10 years of experience)";
  }
  var org_name = $("#org-name").val();
  var designation = $("#designation").val();
  var company_incorporation_is = $('#company_incorporation_is :selected').val();;
  var company_incorporation_date = $("#company-incorporation-date").val();
  var year_experience = $("#year-experience").val();
  //var digital_presence = $("#digital-presence").val();
  var org_address = $("#org-address").val();
  var org_city = $("#org-city").val();
  var org_state = $("#org-state").val();
  var org_pin = $("#org-pin").val();
  var org_email = $("#org-email").val();
  var org_contactno = $("#org-contactno").val();
  var org_website = $("#org-website").val();
  var applicant_name = $("#applicant-name").val();
  var dob = $("#dob").val();
  var mobile = $("#mobile").val();
  var email_id = $("#email-id").val();
  //var social_media = $("#social-media").val();
  var linkedin_profile = $("#linkedin-profile").val();
  //var your_role = $("#your-role").text();
  var your_role = $('textarea#your-role').val();
  var bio_video = $('#bio-video').val();
  var past_organization_name1 = $("#past-organization-name1").val();
  var past_experience1 = $("#past-experience1").val();
  var past_organization_name2 = $("#past-organization-name2").val();
  var past_experience2 = $("#past-experience2").val();
  var past_organization_name3 = $("#past-organization-name3").val();
  var past_experience3 = $("#past-experience3").val();
  var your_thoughts = $('textarea#your-thoughts').val();
  var womans_crown = $('textarea#womans-crown').val();
  var support_entry = $("#support-entry").val();
  var awards_recognition = $("#awards-recognition").val();
  var letter_from_organization = $("#letter-from-organization").val();

  var dp_linkedin = $("#dp-linkedin").val();
  var dp_facebook = $("#dp-facebook").val();
  var dp_twitter = $("#dp-twitter").val();
  var dp_instagram = $("#dp-instagram").val();
  var all_text_digital_presences = dp_linkedin + "," + dp_facebook + "," + dp_twitter + "," + dp_instagram;
  $('#text_guest_name').text(guest_name);
  $('#text_guest_email').text(guest_email);
  $('#text_guest_phone').text(guest_phone);
  $('#text_category').text(category);
  //$('#text_you_shine_heading').text('You Shine (' + you_shine + ')');
  //$('#text_you_shine').text(you_shine);
  //$('#text_shine_five').text(shine_five);
  $('#text_you_shine').text(you_shine_text);
  $('#text_org_name').text(org_name);
  $('#text_designation').text(designation);
  $('#text_company_incorporation_is').text(company_incorporation_is);
  $('#text_company_incorporation_date').text(company_incorporation_date);
  $('#text_year_experience').text(year_experience);
  //$('#text_digital_presence').text(digital_presence);
  $('#text_org_address').text(org_address);
  $('#text_org_city').text(org_city);
  $('#text_org_state').text(org_state);
  $('#text_org_pin').text(org_pin);
  $('#text_org_email').text(org_email);
  $("#text_org_digital_presences").text(all_text_digital_presences);
  $('#text_org_website').text(org_website);
  $('#text_applicant_name').text(applicant_name);
  $('#text_dob').text(dob);
  $('#text_mobile').text(mobile);
  $('#text_email_id').text(email_id);
  $('#text_linkedin_profile').text(linkedin_profile);
  $('#text_your_role').text(your_role);
  if (bio_video != '') {
    $('#text_bio_video').text('Uploaded');
  }
  else {
    $('#text_bio_video').text('');
  }
  $('#text_your_thoughts').text(your_thoughts);
  $('#text_womans_crown').text(womans_crown);

  if (support_entry != '') {
    $('#text_support_entry').text('Uploaded');
  }
  else {
    $('#text_support_entry').text('');
  }
  if (awards_recognition != '') {
    $('#text_awards_recognition').text('Uploaded');
  }
  else {
    $('#text_awards_recognition').text('');
  }
  if (letter_from_organization != '') {
    $('#text_letter_from_organization').text('Uploaded');
  }
  else {
    $('#text_letter_from_organization').text('');
  }
  $('#text_past_organization_name1').text(past_organization_name1);
  $('#text_past_experience1').text(past_experience1);
  $('#text_past_organization_name2').text(past_organization_name2);
  $('#text_past_experience2').text(past_experience2);
  $('#text_past_organization_name3').text(past_organization_name3);
  $('#text_past_experience3').text(past_experience3);


}
// $(document).ready(function () {

//   var multipleCancelButton = new Choices('#digital-presence', {
//     removeItemButton: true,
//     //maxItemCount: 5,
//     //searchResultLimit: 5,
//     //renderChoiceLimit: 5
//   });


// });
$("#digital-presence").on('change', function () {
  var value = $('#digital-presence :selected').val();
  $(".show_" + value).show();
  //alert(value);
});



