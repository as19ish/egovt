<?php
require "config.php";
header("content-type: application/json");

$object = array();
$object['status']=false;
$object['msg']="not set";
if(isset($_POST['username'])){

  if(isset($_POST['name'])      and
    isset($_POST['token'])      and
    isset($_POST['username'])   and
    isset($_POST['email'])      and
    isset($_POST['mobile'])     and
    isset($_POST['aadhar'])){

                      if($_POST['name'] == '' ||
                        $_POST['token'] == '' ||
                        $_POST['username'] == '' ||
                        $_POST['email'] == '' ||
                        $_POST['mobile'] == '' ||
                        $_POST['aadhar'] == '' ){

                       $object['msg'] = "Try Again";
                       echo json_encode($object);
        }
        else {
                $name = $user->crtstr($_POST['name']);
                $username = $user->crtstr($_POST['username']);
                $email = $user->crtstr($_POST['email']);
                $mobile = $user->crtstr($_POST['mobile']);
                $aadhar = $user->crtstr($_POST['aadhar']);



              if(!($user->registration($name,$username,$email,$mobile,$aadhar)))
              {
                          $_SESSION['user']['email']=$email;
                          $object['status'] = 'true';
                          $object['msg'] = "";
                          echo json_encode($object);
              }
              else {
                $object['msg'] = "Try Again";
                echo json_encode($object);
              }



        }
    }
    else {
      $object['msg'] = "Try Again";
      echo json_encode($object);
      }
}

if(isset($_POST['otp']) and isset($_POST['pass']) and isset($_POST['token']) ){
    if($_POST['otp'] == '' || $_POST['pass'] == '' || $_POST['token']== '' ){

  }
  else {
      $otp = $_POST['otp'];
      $pass = $user->hashPass($_POST['pass']);
      $email = $_SESSION['user']['email'];

      if($user->confirmUser($otp,$pass,$email)){
        $object['status'] = 'true';
        $object['msg'] = "";
        echo json_encode($object);
      }
  }
}
if(isset($_POST['user']) and isset($_POST['token']) and isset($_POST['passwrd'])){
if($_POST['token']==$_SESSION['token']){
  if($user->login($_POST['user'],$_POST['passwrd']) ){
    $object['status'] = 'true';
    $object['msg'] = "";
    echo json_encode($object);
  }
}
}
 ?>
