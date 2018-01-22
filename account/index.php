<!DOCTYPE html>
<html>
<head>
	<title>Accounts | eGov</title>
	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/validate.js"></script>
<link href="https://fonts.googleapis.com/css?family=Kite+One|Pacifico" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Monoton" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="css/style.css">
<meta name="theme-color" content="#333">
</head>
<body>

	<div class="foto">
		<div class="wrap">
			<img src="static/photos/index.png" draggable="false" >
		</div>
	</div>

	<div class="log">
		<center><h1><span style="font-family: 'Pacifico', cursive;font-size:35px;">e</span>GOV</h1>
			<span><b>Sab Ka Sath Sab Ka Vikas</b></span></center>
			<hr>


			<div class="signup" >
				<form action="auth.php" method="post" id="signup">
				<div class="form-group">
					<input type="text" name="name"id="name" placeholder="Name" class="form-control" autocomplete="off" autocorrect="off">
				</div>

				<div class="form-group">
					<input type="text" name="username" id="username" placeholder="Username" class="form-control" autocomplete="off"autocorrect="off">
				</div>

				<div class="form-group">
					<input type="email" name="email" id="email" placeholder="Email" class="form-control" autocomplete="off">
				</div>

				<div class="form-group">
					<input type="text" name="mobile" id="mobile" placeholder="Mobile no " class="form-control" autocomplete="off">
				</div>
                <div class="form-group">
					<input type="text" name="aadhar" id="aadhar" placeholder="Aadhar no " class="form-control" autocomplete="off">
				</div>
				<button type="submit" name="signup" value="signup" >Sign up</button>

				<br><br>
				<center><p>If you have an Account? <span id="log_in">Login</span></p></center>

			</form>
			</div>

			<div class="login" >
				<form class="lg-frm">
				<div class="form-group">
					<input type="text" name="user or email" placeholder="Name" class="form-control">
				</div>

				<div class="form-group">
					<input type="password" name="passwrd" placeholder="Password" class="form-control">
				</div>

				<p>Forgot password?</p>


				<button>login</button>
				<p class="ln">Dont have an account? <span id="sign_up">Sign up</span></p>
			</form>
			</div>
	</div>
	<script>var t = 22515151;</script>	
<script src="js/main.js"></script>
</body>
</html>
