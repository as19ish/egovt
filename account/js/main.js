var url = window.location.protocol+window.location.host;
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

		$("#signup").validate({
			submitHandler: function(form) {
		 	 signUpSubmit();
		  },
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
			submitHandler: function(form) {
		    confirmSubmit();
		  },
  rules: {
    pass: {
			required : true,
			minlength : 6,
			maxlength : 14,
		},
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
function signUpSubmit(){
	$('#b_sign').attr('disabled','disabled');
	$('#b_sign').css({'background':"#33333324"});
	$.ajax({
		url:"process.php",
		type:"post",
		data:$('#signup').serialize(),
		success:function(data){
			if(data['match']=='true'){
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
			}else {
				$('#snackbar').text('Please Try Again ....');
				$('#snackbar').addClass('show');
				setTimeout(function(){
					$('#snackbar').removeClass('show');
					$('#b_sign').removeAttr('disabled');
					$('#b_sign').css({'background':"#333"});
			});}


		},
		error : function() {
			$('#snackbar').text("Something Goes Wrong");
		 $('#snackbar').addClass('show');
	setTimeout(function(){
		$('#snackbar').removeClass('show');
		$('#b_sign').removeAttr('disabled');
		$('#b_sign').css({'background':"#333"});

		 },3000);
		}
	});
};
function confirmSubmit(){

	$('#b_confirm').attr('disabled','disabled');
	$('#b_confirm').css({'background':"#33333324"});
	$.ajax({
		url : "process.php",
		type : "post",
		data : $('#confirm').serialize(),
		success :function(data){
			if(data['match']=='true'){
			if(data['status']=='true'){
				$('#snackbar').text('Now login...');
				$('#snackbar').addClass('show');
				setTimeout(function(){
					$('#snackbar').removeClass('show');
					$('.confirm').css({'display':'none'});
					$('.login').css({'display':'block'});

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
		}else {
			$('#snackbar').text("Session Expired");
			$('#snackbar').addClass('show');
	setTimeout(function(){
			location.reload();

		},2000);
		}
		},
		error : function() {
			$('#snackbar').text("Something Goes Wrong");
		 $('#snackbar').addClass('show');
	setTimeout(function(){
		$('#snackbar').removeClass('show');
		$('#b_confirm').removeAttr('disabled');
		$('#b_confirm').css({'background':"#333"});

		 },3000);
	 },

	});
};
$('#login').validate({
	submitHandler: function(form) {
    loginSubmit();
  },
	rules : {
       user : {
				 username : true,
				 required : true,
			 },
			 passwrd : {
				 required : true,
			 }
	},
	messages : {
       user : {
				 username : "",
				 required : "",
			 },
			 passwrd : {
				 required : "",
			 }
	},
	errorElement : "span",
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
function loginSubmit() {

	$('#b_login').attr("disabled","disabled");
	$('#b_login').css({'background':"#33333324"});
	$('#snackbar').text('processing...');
	$.ajax({
		url : "process.php",
		type : "post",
		data : $('#login').serialize(),
		success : function(data){
  if(data['match']=='true'){
		if(data['status']=='true'){
			$('#snackbar').removeClass('show');
			$('#snackbar').text('Redirecting..');
			$('#snackbar').addClass('show');
			setTimeout(function(){
					window.location.replace("../");
			},2000);

		}else{ $('#snackbar').removeClass('show');
					 $('#snackbar').text(data['msg']);
					 $('#snackbar').addClass('show');
	setTimeout(function(){
					 $('#snackbar').removeClass('show');
           $('#b_login').removeAttr('disabled');
					 $('#b_login').css({'background':"#333"});
					 },3000);
		}
	}else{
		$('#snackbar').removeClass('show');
		$('#snackbar').text("Session Expired");
		$('#snackbar').addClass('show');
setTimeout(function(){
		location.reload();

	},2000);
	}

		},
		error : function() {
			$('#snackbar').text("Something Goes Wrong");
		 $('#snackbar').addClass('show');
	setTimeout(function(){
		$('#snackbar').removeClass('show');
		$('#b_login').removeAttr('disabled');
		$('#b_login').css({'background':"#333"});

		 },3000);
		}
	});
};
