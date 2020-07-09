  $(document).ready(function () {

$('.btn-delete').click(function(e){
       e.preventDefault();

       // $(".lock_inputs :input").prop("disabled", false);
       // $(".lock_items").css("display", 'block');
       // $(".unlock_inputs").css("display", 'none');
       // $('.send_btn').attr('disabled', 'disabled');
   });
  // $('.send_btn').attr('disabled', 'disabled');
  // $(".lock_inputs :input").prop("disabled", true);
  // $(".lock_items").css("display", 'none');
  $('.unlock_inputs').click(function(e){
         e.preventDefault();
         $(".lock_inputs :input").prop("disabled", false);
         $(".lock_items").css("display", 'block');
         $(".unlock_inputs").css("display", 'none');
         // $('.send_btn').attr('disabled', 'disabled');
     });
  $('#storeUserForm').validate({
        rules: {
          name: {
            required: true,
            minlength: 5
          },
          // email: {
          //   required: true,
          //   email: true,
          // },
          // password: {
          //   required: true,
          //   minlength: 8
          // },
          //
          // rpassword: {
          //   minlength : 5,
          //   equalTo : "#password"
          // },
          // role: {
          //   required: true,
          // },

        },
        messages: {
          name: {
            required: "Please enter a valid name",
            minlength: "Your name must be at least 5 characters long"
          },
          // email: {
          //   required: "Please enter a email address",
          //   email: "Please enter a vaild email address"
          // },
          //
          // password: {
          //   required: "Please provide a password",
          //   minlength: "Your password must be at least 8 characters long"
          // },
          // role: {
          //   required: "Please provide a role",
          // },

        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        },
  });



  //onvalidate enble submit button
  $('#storeUserForm  input').on('keyup blur', function(){
    if($('#storeUserForm').valid()){
      $('.send_btn').prop('disabled', false);
    }else{
      // $('.send_btn').prop('disabled', 'disabled');
    }
  });
//remove current record

  // post setup code
  $('.send_btn1').on('click', function(e) {
      e.preventDefault();
        alert("here");
      $(this).append(
        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"> Loading...</span> '
      );
      var formId = $(this).closest("form").attr('id');;
      var form = new FormData(document.getElementById(formId));
      var _form = $('#' + formId);
      var _url = _form.attr('action');
      //get profile picture
      if($("#profile_pic").length != 0){
    		var file = document.getElementById('profile_pic').files[0];
    		if (file && (file != null)) {
    				form.append('profile-pic', file);
    		}
    	}
      if($("#sign").length != 0){
    		var file = document.getElementById('sign').files[0];
    		if (file && (file != null)) {
    				form.append('sign', file);
    		}
    	}
      for (var pair of form.entries()) {
          console.log(pair[0]+ ', ' + pair[1]);
      }
      formAjaxSubmission(_url, form, formId);
      // alert(123);

      return false;
  });


  //sending post

  function formAjaxSubmission(_url, form, formId){
    $.ajax({
  		url: _url,
  		type: 'POST',
  		data: form,
  		cache: false,
  		contentType: false,
  		processData: false,
  		success: function (data) {
  			data = JSON.parse(data);
  			if (data.response == 200) {
          // resetForm(formId)
  				console.log("success 200");
  				console.log('data' + data);
  				notifySuccessOrError(200, data.success);
  				$('#update_html').html(data.html);
  			} else {
  				notifySuccessOrError(400, data.errors);
  			}
        $('.send_btn').find('span').remove();
  		}
  	});

  }

  function notifySuccessOrError( respCode, respType ) {
    console.log('notyfy');
    if(respCode == 200){
      console.log('200');
      showNotification('success', respType);
    }else{
      for (let value of Object.values(respType)) {
          showNotification('ERROR', value);
      }
    }
  }

  function showNotification(alertType, text){
        toastr.info(text,
        alertType,
        {
          closeButton : true,
          progressBar : true,
        });
  }

  function resetForm(formId)
    {
            form = $('#'+formId);
            element = ['input','select','textarea'];
            for(i=0; i<element.length; i++)
            {
                    $.each( form.find(element[i]), function(){
                            // if (i === 3) { continue; }
                            if ( $(this).attr('name') == '_token') { return; }
                            console.log($(this).attr('type'));
                            switch($(this).attr('type')) {
                                    case 'text':
                                    case 'email':
                                    case 'password':
                                    case 'select-one':
                                    case 'textarea':
                                    case 'hidden':
                                    case 'file':
                                            $(this).val('');
                                            break;
                                    case 'checkbox':
                                    case 'radio':
                                            $(this).attr('checked',false);
                                            break;
                                    case 'select':
                                           $(this).attr('selected',false);
                                    break;
                            }
                    });
            }

    }


});
