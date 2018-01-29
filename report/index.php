<?php

require "../config.php";
if(isset($_GET['mla']) and isset($_GET['token'])){

	if($_GET['mla'] != '' and $_GET['token'] != ''){
		if($var=$user->reportVariable($_GET['mla'])){

			$district = $user->getDistrict($var['did']);
      if($var['ctotal']>0){
				$vtotal = ($var['vtotal']*100)/$var['ctotal'];
				$unview = ($var['unview']*100)/$var['ctotal'];
				$resolved = ($var['resolved']*100)/$var['ctotal'];
				$unsatisfied = ($var['unsatisfied ']*100)/$var['ctotal'];
				$pending = ($var['pending']*100)/$var['ctotal'];


			}else{
				$vtotal = '14.7';
				$unview = '24.5';
				$resolved = '34.4';
				$unsatisfied = '12.6';
				$pending = '13.8';
			}
		}else {
			header('Location: ../dashboard');
			exit();
		}
	}else {
     header('Location: ../dashboard');
		 exit();
	}
}else {
	   header('Location: ../dashboard');
	  exit();
}




 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Online System</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  <link href="https://fonts.googleapis.com/css?family=Monoton" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
	    <meta name="HandheldFriendly" content="true" />
			<meta name="theme-color" content="#333">
	<style>
		body{
			background: #fff;
			font-family: 'Open Sans', sans-serif;
			-webkit-touch-callout: none;
			-webkit-user-select: none;
			-khtml-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}

header{
	height: 60px;
	width: 100%;
	background:#ecf0f1;
	top: 0;
	position: fixed;
	border-bottom: 1px solid #e2e2e2;
	z-index: 9999;
}
body{
			margin: 0;
			background: url(../mountains.png);
			background-position: center;
			background-attachment: fixed;
			background-size: cover;
			background-repeat: no-repeat;
			height: 100%;
			width: 100%;
		}

header h1{
	margin-top: 15px;
	margin-bottom: 15px;
	font-size: 24px;
	margin-left: 30px;
	font-family: 'Open Sans', sans-serif;
	letter-spacing: -1.5px;
	display: inline-block;
}
.hlogo{
	    margin-top: -6px;
}

.dropdown{
	display: inline-block;
	float: right;
	margin-top: 12px;
	margin-bottom: 12px;
	margin-right: 60px;
}


		.container{
			position: relative;
			top: 70px;
			border: 1px solid #e2e2e2;
			background-color: #FFF;
		}

		.col-xs-5{
			padding-left: 60px;
		}

		@media(max-width: 650px){
			.col-xs-5{
				margin: 0;
				padding-left: 6px;
				padding-right: 0;
			}
		}

		.logo{
			margin-top: 20px;
			border: 2px solid #e2e2e2;
			border-radius: 3px;
			height: 200px;
			width: 250px;
			padding: 3px;
		}

		.logo img{
			height: 100%;
			width: 100%;
		}

		@media(max-width: 650px){
			.logo{
				width: 100%;
			}
		}

		.logo button{
			margin-top: 10px;
			width: 100%;
		}

		h2{
			margin-top: 50px;
		}

		@media(max-width: 650px){
			h2{
				margin-top: 50px;
			}
		}

		.abt{
			position: relative;
			top: 10px;
		}

		/* Styling of Footer Section */
footer{
  background-color: #fff;
    border-top: 1px solid #e2e2e2;
  box-shadow: 0 0 8px 0 #444;
  position: relative;
  top: 90px;
  bottom: 0;
  margin:0 auto;
  height: auto;
  width: 100%;
  color: #c0392b;
  font-family: "Kite One",sans-serif;
  padding-bottom: 6px;
}

footer .content-wrap{
  width: 100%;
}

footer h3{
  margin-top: 4px;
  margin-left: 5%;
  margin-bottom: 3px;
  display: inline-block;
  font-family: 'Pacifico', cursive;
  color: #2c3e50;
}

.footer_head{
  border-bottom: 1px solid #e2e2e2;
  margin-left: 5%;
  margin-right: 5%;
}

footer h3 a{
  text-decoration: none;
  color: #2c3e50;
}

footer span{
  float: right;
  margin-right: 5%;
  margin-top: 5px;
  font-size: 12px;
}

footer ul{
  margin-top: 5px;
  margin-bottom: 0;
  margin-left: 6%;
  margin-right: 6%;
}

footer ul li{
  list-style-type:none;
  display: inline-block;
  margin: 8px;
}

footer ul li a{
  text-decoration: none;
  color: #2c3e50;
}

footer ul li a:hover{
  color: #3498db;
  text-decoration: underline;
}
/* Ended here */
	</style>
<script type="text/javascript">


	window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer", {
	exportEnabled: true,
	animationEnabled: true,
	title:{
		text: "Report chart of work"
	},
	legend:{
		cursor: "pointer",
		itemclick: explodePie
	},
	data: [{
		type: "pie",
		showInLegend: true,
		toolTipContent: "{name}: <strong>{y}%</strong>",
		indexLabel: "{name} - {y}%",
		dataPoints: [
			{ y: <?php echo $vtotal; ?>, name: "view" },
			{ y: <?php echo $unview; ?>, name: "unview" },
			{ y: <?php echo $resolved; ?>, name: "resolved", exploded: true },
			{ y: <?php echo $pending; ?>, name: "pending" },
			{ y: <?php echo $unsatisfied; ?>, name: "unSatisfied" },

		]
	}]
});
chart.render();
}

function explodePie (e) {
	if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
	} else {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
	}
	e.chart.render();

}

</script>
</head>
<body>

		<header>
			<div class="hlogo">
			<h1><span style="font-family: 'Pacifico', cursive;font-size:35px;">e</span><span style="font-family:'Monoton', cursive;color: #333;font-size:40px;">GOV</span></h1>
		</div>
	</header>

	<div class="container">
		<div class="row">
			<div class="col-xs-5">
				<div class="logo">
					<img src="download.jpg">



					<button class="btn btn-primary">
						<?php
                switch ($var['f']) {
                              	case 0:
           	                      	echo 'MLA';
           		                    break;
							                  case 1:
	                               		echo 'Cabinet Minister';
	                            		break;
							               	case 2:
		           		                echo 'Chief Minister';
		           		               break;
           }?></button>
				</div>
			</div>
			<div class="col-xs-7">
				<h2><?php echo ucwords($_GET['mla']); ?></h2>
				<div class="abt">
					<span style="font-size:18px" ><i class="fa fa-map-marker" style="font-size:22px"></i> &nbsp; &nbsp; <?php if(isset($var['constituency'])){ echo $var['constituency']; } ?></span>
					&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size:18px" ><i class="fa fa-bookmark" style="font-size:22px"></i> &nbsp; &nbsp; <?php if(isset($district) ){echo $district;  }?></span>
					&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size:18px" >2017-2018</span>
				</div>
			</div>
		</div>

		<div id="chartContainer" style="margin-top:40px;margin-bottom:40px;height: 400px; width: 100%;"></div>
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

	</div>

	<div><?php include('../footer.php');?>
</body>
</html>
