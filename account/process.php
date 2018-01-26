<?php
require "config.php";
header("content-type: application/json");
$object = array();
if(isset($_POST['username']) || isset($_POST['otp']) || isset($_POST['user'])){
if(isset($_POST['username']) and isset($_POST['token'])){

  if($_POST['token'] != $_SESSION['token'])
  {
    $object['match'] = "false";
    $object['token'] = $_POST['token'];
    $object['status'] = 'false';
    $object['msg'] = "Token Miss Match";
    echo json_encode($object);
    exit();
  }
  if(isset($_POST['name'])      and
    isset($_POST['username'])   and
    isset($_POST['email'])      and
    isset($_POST['mobile'])     and
    isset($_POST['aadhar'])){

                      if($_POST['name'] == ''  ||
                        $_POST['username'] == '' ||
                        $_POST['email'] == '' ||
                        $_POST['mobile'] == '' ||
                        $_POST['aadhar'] == '' ){
                      $object['match'] = "true";
                      $object['token'] = $_POST['token'];
                      $object['status'] = 'false';
                      $object['msg'] = "Try Again";
                      echo json_encode($object);
                      exit();
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
                          $object['match'] = "true";
                          $object['token'] = $_POST['token'];
                          $object['status'] = 'true';
                          $object['msg'] = "";
                          echo json_encode($object);
                          exit();
              }
              else {
                $object['match'] = "true";
                $object['token'] = $_POST['token'];
                $object['status'] = 'false';
                $object['msg'] = "Try Again";
                echo json_encode($object);
                exit();
              }



        }
    }
    else {
      $object['match'] = "true";
      $object['token'] = $_POST['token'];
      $object['status'] = 'false';
      $object['msg'] = "Try Again";
      echo json_encode($object);
      exit();
      }
}

if(isset($_POST['otp']) and isset($_POST['pass']) and isset($_POST['token']) ){
    if($_POST['otp'] == '' || $_POST['pass'] == '' || $_POST['token']== '' ){

  }
  else {
    if($_POST['token'] != $_SESSION['token']){
      $object['match'] = "false";
      $object['token'] = $_POST['token'];
      $object['status'] = 'false';
      $object['msg'] = "Token Miss Match";
      echo json_encode($object);
      exit();
    }
      $otp = $user->crtstr($_POST['otp']);
      $pass = $user->hashPass($_POST['pass']);
      $email = $_SESSION['user']['email'];

      if($user->confirmUser($otp,$pass,$email)){
        $object['match'] = "true";
        $object['token'] = $_POST['token'];
        $object['status'] = 'true';
        $object['msg'] = "";
        echo json_encode($object);
        exit();
      }
  }
}
   if(isset($_POST['user']) and isset($_POST['token']) and isset($_POST['passwrd'])){

             if($_POST['token']==$_SESSION['token']){
                    $uname = $user->crtstr($_POST['user']);
                               $return = $user->login($uname,$_POST['passwrd']);
                               switch ($return) {
                                 case 0:
                                         $object['status'] = 'false';
                                         $object['msg'] = "verify your account check email";
                                         $object['match'] = "true";
                                         $object['token'] = $_POST['token'];
                                         echo json_encode($object);
                                         exit();
                                   break;
                                   case 1:
                                   case 2:
                                   case 3:
                                         $object['match'] = "true";
                                         $object['token'] = $_POST['token'];
                                         $object['status'] = 'false';
                                         $object['msg'] = "Either Wrong Password or Wrong Username";
                                         echo json_encode($object);
                                         exit();
                                    break;
                                    case 4:
                                          $object['match'] = "true";
                                          $object['token'] = $_POST['token'];
                                          $object['status'] = 'true';
                                          $object['msg'] = "Redirecting...";
                                          echo json_encode($object);
                                          exit();
                               }




          }else {
                  $object['match'] = "false";
                  $object['token'] = $_POST['token'];
                  $object['status'] = 'false';
                  $object['msg'] = "Token Miss Match";
                  echo json_encode($object);
                  exit();
          }
}
}else {
  http_response_code(404);
  exit();
}
 ?>
