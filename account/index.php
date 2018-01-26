<?php
require "config.php";
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = md5(uniqid(rand(), TRUE));
}
$token = $_SESSION['token'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Accounts | eGov</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Kite+One|Pacifico" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Monoton" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" ></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
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
			<span><b>Power&nbsp&nbspTo&nbsp&nbspThe&nbsp&nbspPeople  </b></span></center>
			<hr>


			<div class="signup" >
				<form  id="signup"  >
				<div class="form-group">
					<input type="text" name="name"id="name" placeholder="Name" class="form-control" autocomplete="off" autocorrect="off">
				</div>
				<div>
          <input type="hidden" name="token" value="<?php echo $token; ?>" >
				</div>
				<div class="form-group">
					<input type="text" name="username" id="username" placeholder="Username" class="form-control" autocomplete="off"autocorrect="off">
				</div>

				<div class="form-group">
					<input type="text" name="email" id="email" placeholder="Email" class="form-control" autocomplete="off">
				</div>

				<div class="form-group">
					<input type="text" name="mobile" id="mobile" placeholder="Mobile no " class="form-control" autocomplete="off">
				</div>
                <div class="form-group">
					<input type="text" name="aadhar" id="aadhar" placeholder="Aadhar no " class="form-control" autocomplete="off">
				</div>
				<button type="submit" name="signup" value="signup" id="b_sign" >Sign up</button>

				<br><br>
				<center><p>If you have an Account? <span id="log_in">Login</span></p></center>

			</form>
			</div>

			<div class="login"  >
				<form class="lg-frm" id="login" >
				<div class="form-group">
					<input type="text" name="user" placeholder="Username" id="user"  class="form-control">
				</div>
        <div >
					<input type="hidden" name="token" value="<?php echo $token; ?>" >
				</div>
				<div class="form-group">
					<input type="password" name="passwrd" placeholder="Password" id="passwrd" class="form-control">
				</div>

				<p>Forgot password?</p>


				<button type="submit" name="login" value="login" id="b_login" >login</button>
				<p class="ln">Dont have an account? <span id="sign_up">Sign up</span></p>
			</form>
			</div>
      <div class="confirm" >
				<form class="lg-frm" id="confirm" >
				<div class="form-group">
					<input type="text" name="otp" id="otp" placeholder="otp [check your email]" class="form-control">
				</div>
        <div >
					<input type="hidden" name="token" id="token" placeholder="otp [check your email]" value="<?php echo $token; ?>">
				</div>
        <div class="form-group">
					<input type="password" name="pass" id="pass" placeholder="Password" class="form-control">
				</div>
				<div class="form-group">
					<input type="password" name="rpass" id="rpass" placeholder="Re-enter Password" class="form-control">
				</div>
				<button type="submit" value="submit" name="submit" id="b_confirm" >Submit</button>

			</form>
			</div>
	</div>
  <div id="snackbar"  ></div>
	<script src="js/validate.js" ></script>
  <script src="js/main.js" ></script>
</body>
</html>
