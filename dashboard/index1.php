<?php
require "../config.php";
$uid = NULL;
if($user->checkLogin())
{
	$logedUser = true;
	$uid = $user->getUserId();
	$userName=$_SESSION['user']['username'];
}else {
	$logedUser = false;
}



function myComplaintsExist(){
	global $uid,$user;
	if($myComplaints = $user->myComplaints($uid)){
		return $myComplaints;
	}else{
		return false;
	}
}
function otherComplaintsExist(){
	global $user,$uid;
	if($otherComplaints = $user->otherComplaints($uid)){
		return $otherComplaints;
	}else{
		return false;
	}
}
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = md5(uniqid(rand(), TRUE));
}
$token = $_SESSION['token'];
if(isset($_POST['submit']) and $_POST['token'] and $_POST['title'] and $_POST['complaint'] and $logedUser){
	if($_POST['token']==$_SESSION['token']){
		$qid = substr(md5(uniqid(rand(), TRUE)),0,8);
		$title = $user->crtstr($_POST['title']);
		$prob = $user->crtstr($_POST['complaint']);
		if($user->addComplaints($qid,$prob,$uid,$title))
		{

		}
	}
}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Dashboard Community</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
	<meta name="HandheldFriendly" content="true" />

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Monoton" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="js/jquery.easy-autocomplete.min.js"></script>
	<link rel="stylesheet" href="js/easy-autocomplete.min.css">
<script>
var token = '<?php echo $token; ?>';

</script>

</head>
<body>
	<header>
		<div class="logo">
		<h1><span style="font-family: 'Pacifico', cursive;font-size:35px;">e</span><span style="font-family:'Monoton', cursive;color: #333;font-size:40px;">GOV</span></h1>
	</div>
	<div class="ui-widget">
	  <form method = "get" action="../report" >
	   <input id="example-ajax-post" name="mla" >
		 <input type='hidden' value="<?php echo $token; ?>" name= 'token' >
		 <input type="submit" value="genrate Report" name="submit" >
	  </form>
	</div>
	</header>

	<section>

		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="post">
						<form method="post" action="" >
						<table>
							<tr>
								<td>
									<label>Title</label>
								</td>
								<td>
									<div class="form-group">
										<input type="text" name="title" placeholder="Whats your complaint? Be specific" class="form-control" required>
									</div>
									<div >
										<input type="hidden" name="token" value="<?php echo $token; ?>">
									</div>
								</td>
								<td>
									<button>How to ask</button>
								</td>
							</tr>
						</table>

						<div class="form-group">
							<div class="upload">
								<label class="uploadlabel">
								Detailed Description of Your Complaint

								</label>
							</div>
						</div>

						<div class="form-group">
							<textarea class="form-control" name="complaint" required ></textarea>
						</div>
						<div >
							<input   required >
						</div> <div >
							<input    required >
						</div>

						<div class="butn">
						<?php 	if($logedUser){   ?>
							<button type="submit" name="submit" class="btn btn-primary">Register Your Complaint</button>

					  <?php }else{ ?>
							</form>
               <button  type="button" class="btn btn-primary" onclick="account();" >login and post</button>
						 <?php } ?>
						</div>

					</div>


					<div class="post-item">
						<h3>Complaints are here</h3>
						<?php if($myComplaints=myComplaintsExist()){foreach ($myComplaints as $key => $value): ?>
							<div class="panel panel-default"style="cursor: pointer;" onclick="redirect('<?php echo $myComplaints[$key]["qid"]; ?>')" >
								 <div class="panel-body">
									 <div class="views">
										 <center><h4><?php echo $myComplaints[$key]['views'];  ?><br>Views</h4></center>
									 </div>
									 <div class="link">

											 <span style="font-size: 19px;font-weight: bold;"><?php echo $myComplaints[$key]['title'];  ?></span>&nbsp&nbsp<span  style="font-size: 17px;" ><?php echo $myComplaints[$key]['prob'];  ?></span>
									 </div>
									 <div class="time">
										 <span >
											<?php echo $myComplaints[$key]['time'];  ?>
										 </span>
										 <span><a href="#">@<?php echo $userName;  ?></a></span>
									 </div>
								 </div>
						 </div>
					 <?php endforeach; }else {?>
						 <div class="panel panel-default">
				 			 <div class="panel-body">
				 				 <div class="views">
				 					 <center><h4>0<br>Views</h4></center>
				 				 </div>
				 				 <div class="link">

				 						 <span style="font-size: 19px;font-weight: bold;">Complaint Title</span>&nbsp&nbsp<span  style="font-size: 17px;" >Description.....</span>
				 				 </div>
				 				 <div class="time">
				 					 <span >
										 <?php
 	  										$time = time();
 	  										$actual_time = date('D M Y ,  H:i:s' ,$time);
 	  										echo $actual_time;
 	  									?>
				 					 </span>
				 					 <span><a href="#">@user</a></span>
				 				 </div>
				 			 </div>
				 	 </div>
<?php }?>
					</div>
				</div>

				<div class="col-md-4">
					<div class="other">
						<h4>Other Question?</h4>
					</div>
					<?php if($otherComplaints=otherComplaintsExist()){?>
 <?php foreach ($otherComplaints as $key => $value): ?>
	 <div class="other-post" style="cursor: pointer;" onclick="redirect('<?php echo $otherComplaints[$key]["qid"]; ?>')">
			<div class="link">

					<span style="font-size: 18px;font-weight: bold;"><?php echo $otherComplaints[$key]['title'];  ?></span>&nbsp&nbsp<span  style="font-size: 16px;" ><?php echo substr($otherComplaints[$key]['prob'],0,140).'.....';  ?> </span>
			</div>
			<div class="time">
				<span >
					<?php echo $otherComplaints[$key]['time'];  ?>
				</span>
				<span><a href="javascript:void(0)">@<?php echo $user->getNameByUID($otherComplaints[$key]['uid']); ?></a></span>
			</div>
		</div>
 <?php endforeach; }?>


				</div>
			</div>
		</div>
	</section>
	<div><?php include('../footer.php'); ?></div>
	<script src="js/script.js" ></script>

</body>
</html>
