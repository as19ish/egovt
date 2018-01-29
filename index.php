<?php
header( "refresh:3;url=dashboard" );
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#889aa0">
	<title>eGOV | Uttarakhand Sarkaar Initiative</title>
	<link href="https://fonts.googleapis.com/css?family=Monoton|Open+Sans|Righteous" rel="stylesheet">
	<style>
		html{
			height: 100%;
			width: 100%;
		}

		body{
			margin: 0;
			background: url(mountains.png);
			background-position: center;
			background-attachment: fixed;
			background-size: cover;
			background-repeat: no-repeat;
			height: 100%;
			width: 100%;
		}

		.overlay{
			height: 100%;
			width: 100%;
			background: rgba(0,0,0, 0.36);
			text-align: center;
		}

		span{
			font-size: 44px;
			position: relative;
			top: 100px;
			margin: 0;
			color: #fff;
			font-weight: 900;
			letter-spacing: 4px;
			text-align: center;
		}

		@media(max-width: 749px){
			span{
				top: 60px;
			}
		}

		.overlay img{
			top: 120px;
			position: relative;
			height: 150px;
			width: 150px;
		}

		@media(max-width: 749px){
			.overlay img{
				top: 70px;
			}
		}

		h2{
			position: relative;
			top: 130px;
			color: #fff;
			letter-spacing: 2px;
			font-family: 'Open Sans', sans-serif;
		}

		@media(max-width: 749px){
			h2{
				top: 90px;
				font-size: 22px;
			}
		}

		p {
			position: absolute;
			right: 30px;
			bottom: 0;
			color: #fff;
			font-family: 'Open Sans', sans-serif;
		}
	</style>
</head>
<body>
	<div class="overlay">
		<span style="font-family: 'Righteous', cursive;">e</span><span style="font-family: 'Monoton', cursive;">GOV</span><br>
		<img src="uklogo.png" draggable="false">
		<h2>UTTARAKHAND Sarkaar Initiative</h2>
		<p>&copy; ShC</p>
	</div>
</body>
</html>
