<?php

require "../config.php";
if(isset($_GET['on']) and isset($_GET['id'])){
	if($_GET['on']=='id' and $_GET['id']!=''){
		if($complaint = $user->getComplaintById($_GET['id'])){
		$status = $complaint['status'];
		if($mlaConst = $user->tagedMLA($complaint['eid'])){
				$mla = $mlaConst['electedMember'];
			  $constituency = $mlaConst['constituency'];
				$district = $mlaConst['did'];
				$district = $user->getDistrict($district);
		}}else {
			header('Location: ../dashboard');
			exit();
		}
	}else{
		header('Location: ../dashboard');
		exit();
	}
}else{
	header('Location: ../dashboard');
	exit();
}

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Dashboard Community</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Monoton" rel="stylesheet">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
 <meta name="HandheldFriendly" content="true" />
 <meta name="theme-color" content="#333">
</head>
<body>
	<header>
		<div class="logo">
		<h1><span style="font-family: 'Pacifico', cursive;font-size:35px;">e</span><span style="font-family:'Monoton', cursive;color: #333;font-size:40px;">GOV</span></h1>
	</div>

	</header>

	<section>
		<div class="main">
			<div class="container">
				<div class="ask">
					<h1><?php echo $complaint['title'];  ?> </h1><p style="font-size:16px"><?php echo $complaint['prob'];  ?></p>

				</div>
				<div class="abt-comp">
					<div class="row-fluid">
						<div class="col-md-8">
							<div class="post">
								<div class="complnt">
									<h4>Complaint registered description</h4>
									<table>
                  <tr><td><span style="font-size: 16px;font-weight: bold;" >Complaint Id</span></td><td><span>  <?php echo $complaint['qid'];  ?></span></td></tr>
									<tr><td><span style="font-size: 16px;font-weight: bold;" >views</span></td><td><span>  <?php echo $complaint['views'];  ?></span></td></tr>
									<tr><td><span style="font-size: 16px;font-weight: bold;" >Registered On</span></td><td><span> <?php echo $complaint['time'];  ?></span></td></tr>
									<tr><td><span style="font-size: 16px;font-weight: bold;" >Registered By</span></td><td><span> <?php print(strtoupper($user->registerBy($complaint['uid'])));  ?></span></td></tr>
									<tr><td><span style="font-size: 16px;font-weight: bold;" > Taged MLA</span></td><td><span> Mr.<?php if(isset($mla))echo strtoupper($mla);  ?></span><br>
									<tr><td><span style="font-size: 16px;font-weight: bold;" >District</span></td><td><span><?php if(isset($district))echo strtoupper($district);  ?></span><br></td></tr>
									<tr><td></table><div class="flowchart">
										<h3>Statuts of Complaint</h3>
										<div class="flow" style="background-color:#333;" >Unseen</div> <span> <i class="fa fa-arrow-right" aria-hidden="true"></i></span>
										<div class="flow" <?php if($status>=1) echo 'style="background-color:#333;"'; ?> >Seen</div><span> <i class="fa fa-arrow-right" aria-hidden="true"></i></span>
										<div class="flow" <?php if($status>=2) echo 'style="background-color:#333;"'; ?> >Onwork</div><span> <i class="fa fa-arrow-right" aria-hidden="true"></i></span>
										<div class="flow" <?php if($status>=3) echo 'style="background-color:#333;"'; ?> >Resolved</div>
									</div>
									<a href="../report?mla=<?php echo $mla.'&token='.$_SESSION['token']; ?>" ><button>Generate report</button></a>
									<a href="../dashboard" ><button>Register Complaint</button></a>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="other">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<div><?php include('../footer.php'); ?></div>
</body>
</html>
