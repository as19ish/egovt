<?php
require "config.php";
header('content-type: application/json');

if(isset($_POST['otp']) and isset($_SESSION['user']['email']))
{
  if($user->checkOtp($_POST['otp'],$_SESSION['user']['email']))
  {
    echo 'true';
  }
  else {
    echo "false";
  }
}
if(isset($_POST['email']))
{
  if($user->checkEmail($_POST['email'])){echo "true";}else{echo "false";}
}
if(isset($_POST['username']))
{
  if($user->checkUname($_POST['username'])){echo "true";}else{echo "false";}
}
if(isset($_POST['mobile']))
{
  if($user->checkMobile($_POST['mobile'])){echo "true";}else{echo "false";}
}
if(isset($_POST['aadhar']))
{
  if($user->checkAadhar($_POST['aadhar'])){echo "true";}else{echo "false";}
}

 ?>
