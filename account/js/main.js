$('#log_in').click(function()
{
	$('.signup').hide();
	$('.login').show();
});
$('#sign_up').click(function()
{
	$('.signup').show();
	$('.login').hide();
});

jQuery.validator.addMethod("username", function(value, element) {
  return this.optional( element ) || /^[-\w\.\$@\*\!]{4,20}$/.test( value );
}, 'Please enter a valid username');
jQuery.validator.addMethod("vname", function(value, element) {
  return this.optional( element ) || /^[A-Za-z ]{3,20}$/.test( value );
}, 'Please enter a valid name');
jQuery.validator.addMethod("email", function(value, element) {
  return this.optional( element ) || /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test( value );
}, 'Please enter a valid email');

	var validator =	$("#signup").validate({

			rules: {
				name: {
					required: true,
					vname: true,
				},
				username: {
					required: true,
					username: true,
					remote: {
			 url: "ajax.php",
			 type: "post",
			 data: {
				 username: function() {
					 return $( "#username" ).val();
				 },

			 }
		 }},
				email: {
					required: true,
					email : true,
					remote: {
			 url: "ajax.php",
			 type: "post",
			 data: {
				 email: function() {
					 return $( "#email" ).val();
				 }
			 }
		 }
				},
				mobile: {
					required: true,
					minlength: 10,
					maxlength: 10,
					digits: true

				},
				aadhar: {
					required: true,
					minlength: 12,
					maxlength: 12,
					digits: true,
					remote: {
			 url: "ajax.php",
			 type: "post",
			 data: {
				 aadhar: function() {
					 return $( "#aadhar" ).val();
				 }
			 }
		 }
				}

			},
			messages: {
				name: {
					required: "",
				},
				username: {
					required : "",
					username : "Enter vailid user name",
          remote : "Already exists"
				},
				mobile: {
					required: "",
					minlength: "Enter vailid Mobile no",
					maxlength: "Enter vailid Mobile no",
					digits: "Enter vailid Mobile no",
				},
				aadhar: {
          required : "",
					minlength: "Enter vailid 12 digit Aadhar no",
					maxlength: "Enter vailid 12 digit Aadhar no",
					digits: "Enter vailid 12 digit Aadhar no",
					remote : "Already exists"
				},

				email:{
					required : "",
					remote : "Already exists"
			}

			},

       highlight: function(element, errorClass, validClass) {
               $('#'+element.id).css({"box-shadow": "0 0 5px rgba(245, 26, 26, 1)",
						  						            "border": "1px solid rgba(245, 26, 26, 1)"})
						 },
         unhighlight:function(element, errorClass, validClass) {
	               $('#'+element.id).css({"box-shadow": "0 0 5px rgba(10, 160, 13, 1)",
							   							     "border": "1px solid #e2e2e2"})
							 },
							 errorElement: "span",

		});
		$( "#confirm" ).validate({
  rules: {
    pass: "required",
    rpass: {
      equalTo: "#pass"
    },
		otp:{
			required : true,
			remote: {
	 url: "ajax.php",
	 type: "post",
	 data: {
		 otp : function() {
			 return $( "#otp" ).val();
		     },

	        }
  },
    minlength:6,
		maxlength:6,
		}
  },
	messages:
	{
	   otp:
		 {
			 required : "",
       minlength : "",
			 maxlength : "",
			 remote : ""
		 },
		 pass : "",
		 rpas : "",
	 },
		 errorElement: "span",
		 highlight: function(element, errorClass, validClass) {
			    console.log('#'+element.id);
						 $('#'+element.id).css({"box-shadow": "0 0 5px rgba(245, 26, 26, 1)",
																		"border": "1px solid rgba(245, 26, 26, 1)"})
					 },
			 unhighlight:function(element, errorClass, validClass) {
							 $('#'+element.id).css({"box-shadow": "0 0 5px rgba(10, 160, 13, 1)",
																 "border": "1px solid #e2e2e2"})
						 },


});
$('#signup').submit(function(e){
	e.preventDefault();
	$('#b_sign').attr('disabled','disabled');
	$('#b_sign').css({'background':"#33333324"});
	$.ajax({
		url:"process.php",
		type:"post",
		data:$('#signup').serialize(),

		success:function(data){
			console.log(data['status']);
 if(data['status']=='true'){
   $('#snackbar').text('Wait...');
	 $('#snackbar').addClass('show');
	 setTimeout(function(){
		 $('#snackbar').removeClass('show');
     $('.signup').css({'display':'none'});
     $('.confirm').css({'display':'block'});
	 }
		 ,3000);
 }else {
 	$('#snackbar').text('Please Try Again ....');
	$('#snackbar').addClass('show');
	setTimeout(function(){
		$('#snackbar').removeClass('show');
		$('#b_sign').removeAttr('disabled');
		$('#b_sign').css({'background':"#333"});

	}
		,3000);

 }

		}
	});
});
$('#confirm').submit(function(e){
	e.preventDefault();
	$('#b_confirm').attr('disabled','disabled');
	$('#b_confirm').css({'background':"#33333324"});
	$.ajax({
		url : "process.php",
		type : "post",
		data : $('#confirm').serialize(),
		success :function(data){
			if(data['status']=='true'){
				$('#snackbar').text('All Done...');
				$('#snackbar').addClass('show');
				setTimeout(function(){
					$('#snackbar').removeClass('show');

				}
					,3000);
			}else {
			 $('#snackbar').text('Please Try Again ....');
			 $('#snackbar').addClass('show');
			 setTimeout(function(){
				 $('#snackbar').removeClass('show');
				 $('#b_confirm').removeAttr('disabled');
				 $('#b_confirm').css({'background':"#333"});

			 }
				 ,3000);

			}
		},

	});
});
