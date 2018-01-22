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
				 token : t,
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
					username : "Please enter vailid user name",
          remote : "Already exists"
				},
				mobile: {
					required: "",
					minlength: "Plese enter vailid Mobile no",
					maxlength: "Plese enter vailid Mobile no",
					digits: "Plese enter vailid Mobile no",
				},
				aadhar: {
          required : "",
					minlength: "Plese enter vailid 12 digit Aadhar no",
					maxlength: "Plese enter vailid 12 digit Aadhar no",
					digits: "Plese enter vailid 12 digit Aadhar no",
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
