
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
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  	<link href="https://fonts.googleapis.com/css?family=Monoton" rel="stylesheet">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="style.css">
	<script>
	var token = '<?php echo $token; ?>';

	</script>
</head>
<body>
	<header>
		<div class="logo">
			<h1>
				<span class="sp">e</span>
				<span class="sp2">GOV</span>
			</h1>
		</div>
		<div class="ui-widget">
			<table>
				<tr>
					<td>
		  				<form method = "get" action="../report" >
		  					<div class="form-group">
		   						<input type="text" id="example-ajax-post" class="form-control" placeholder="Ex. Trivendra singh rawat">
									<input type='hidden' value="<?php echo $token; ?>" name= 'token' >
		   					</div>

		  			</td>
		  			<td>
		  				<button type="submit" ><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Check report</button>
							</form>
		  			</td>
		  			<td>
		  				<button class="right">
						Sign in
						</button>
		  			</td>
		  		</tr>
		  	</table>
		</div>
	</header>

	<section>

		<div class="container">
			<div class="row">
				<div class="col-md-7">
					<div class="post">
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
										<input type="hidden" name="token" value="<?php echo $token; ?>" >
									</div>
								</td>
								<td>
									<button>How to ask?</button>
								</td>
							</tr>
						</table>


						<div class="desc">
							<div class="form-group">
								<h4>Discuss complaint</h4>
								<textarea class="form-control" name="complaint" placeholder="Full detail of complaint ,complaint should be clear" required class="form-control"></textarea>
							</div>

							<div class="dist">
								<h4>Select District</h4>
								<select>
									<option>Almora</option>
									<option>Bageshwar</option>
									<option>Chamoli</option>
									<option>Champawat</option>
									<option>Dehradun</option>
									<option>Haridwar</option>
									<option>Nainital</option>
									<option>Pauri</option>
									<option>Pithoragarh</option>
									<option>Rudraprayag</option>
									<option>Tehri</option>
									<option>U.S Nagar</option>
									<option>Uttarkashi</option>
								</select>
							</div>

							<div class="pin">
								<div class="form-group">
									<h4>Pincode</h4>
									<input type="text" name="" class="form-control" placeholder="Ex. 248713">
								</div>
							</div>

							<div class="addrs">
								<div class="form-group">
									<h4>Full address</h4>
									<input type="text" name="" placeholder="Ex. Behind church , Cement town  Dehradun" class="form-control">
								</div>
							</div>
						</div>

						<div class="butn">
               				<button  type="button" class="btn btn-primary" onclick="account();" >Post Complaint</button>
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
					</div>

					<div class="col-md-1">
					</div>

					<div class="col-md-4">
						<div class="posts">
							<h4>Other Complaints</h4>
							<?php if($otherComplaints=otherComplaintsExist()){?>
		 <?php foreach ($otherComplaints as $key => $value): ?>
			 <div class="other-post" style="cursor: pointer;" onclick="redirect('<?php echo $otherComplaints[$key]["qid"]; ?>')">
					<div class="link">

							<span style="font-size: 16px;font-weight: bold;"><?php echo $otherComplaints[$key]['title'];  ?></span>&nbsp&nbsp<span  style="font-size: 14px;" ><?php echo substr($otherComplaints[$key]['prob'],0,140).'.....';  ?> </span>
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
			</div>
			<footer>
    <div class="container-fluid">
      <div class="content-wrap">
        <div class="footer_head">
          <div class="flogo">e</div><h1><span style="font-family:'Monoton', cursive;font-size:36px;">GOV</span></h1>
        </div>
          <div class="footer-content">
            <ul>
              <li><a href="#">About us</a></li>
              <li><a href="#" id="click_about">Feedback us</a></li>
              <li><a href="#">Terms</a></li>
              <li><a href="#">Help</a></li>
              <li><a href="#">Privacy</a></li>
            </ul>
          </div>
          <span>&copy; &nbsp;Copyright 2k17 ShC.</span>
      </div>
    </div>
</footer>
	</section>
</body>
</html>
