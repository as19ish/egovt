<?php

class User{
        private $pdo;

        private $user;

        private $msg;

        private $permitedAttemps = 5;

    public function dbConnect($conString, $user, $pass){
        if(session_status() === PHP_SESSION_ACTIVE){
            try {
                $pdo = new PDO($conString, $user, $pass);
                $this->pdo = $pdo;
                return true;
            }catch(PDOException $e) {
                $this->msg = 'Connection did not work out!';
                return false;
            }
        }else{
            $this->msg = 'Session did not start.';
            return false;
        }
    }

    public function getUser(){
        return $this->user;
    }
    public function getMsg(){
        return $this->msg;
    }


    public function registration($name,$username,$email,$mobile,$aadhar){
        $pdo = $this->pdo;
        $confCode = mt_rand(100000,999999);
        $stmt = $pdo->prepare('INSERT INTO users (fname, uname, email, mobile,aadhar,confirm_code) VALUES (?, ?, ?, ?,?,?)');
        if($stmt->execute([$name,$username,$email,$mobile,$aadhar,$confCode])){
                  $this->sendMobileOtp($confCode,$mobile);
        }else{

            return false;
        }
    }
    private function sendMobileOtp($otp,$mobile){
    $url = "https://2factor.in/API/V1/0632f4ba-012f-11e8-a328-0200cd936042/SMS/+91{$mobile}/{$otp}";
    file_get_contents($url);
    return true;

    }
    private function sendConfirmationEmail($email){
        $pdo = $this->pdo;
        $stmt = $pdo->prepare('SELECT confirm_code FROM users WHERE email = ? limit 1');
        $stmt->execute([$email]);
        $code = $stmt->fetch();
        $subject = 'Confirm your registration';
        $message = 'Please confirm you registration by pasting this code in the confirmation box: '.$code['confirm_code'];
        $headers = 'X-Mailer: PHP/' . phpversion();

        if(mail($email, $subject, $message, $headers)){
            return true;
        }else{
            return false;
        }
    }

    public function passwordChange($id,$pass){
        $pdo = $this->pdo;
        if(isset($id) && isset($pass)){
            $stmt = $pdo->prepare('UPDATE users SET password = ? WHERE id = ?');
            if($stmt->execute([$id,$this->hashPass($pass)])){
                return true;
            }else{
                $this->msg = 'Password change failed.';
                return false;
            }
        }else{
            $this->msg = 'Provide an ID and a password.';
            return false;
        }
    }


    public function checkEmail($email){
        $pdo = $this->pdo;
        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ? limit 1');
        $stmt->execute([$email]);
        if($stmt->rowCount() > 0){
            return false;
        }else{
            return true;
        }
    }

     public function checkMobile($mobile){
            $pdo = $this->pdo;
            $stmt = $pdo->prepare('SELECT id FROM users WHERE mobile = ? limit 1');
            $stmt->execute([$mobile]);
            if($stmt->rowCount() > 0){
                return false;
            }else{
                return true;
            }
        }

     public function checkAadhar($aadhar){
            $pdo = $this->pdo;
            $stmt = $pdo->prepare('SELECT id FROM users WHERE aadhar = ? limit 1');
            $stmt->execute([$aadhar]);
            if($stmt->rowCount() > 0){
                return false;
            }else{
                return true;
            }
            }
    public function checkUname($uname){
            $pdo = $this->pdo;
            $stmt = $pdo->prepare('SELECT id FROM users WHERE uname = ? limit 1');
            $stmt->execute([$uname]);
            if($stmt->rowCount() > 0){
                return false;
            }else{
                return true;
            }
        }


    public function hashPass($pass){
        return password_hash($pass, PASSWORD_DEFAULT);
    }


    public function checkOtp($otp,$email){
        $pdo = $this->pdo;
        $stmt = $pdo->prepare('SELECT confirm_code FROM users WHERE email = ? limit 1');
        $stmt->execute([$email]);
        if($stmt->rowCount() > 0){
           $fotp = $stmt->fetch();

           if($fotp[0]==$otp)
           {
             return true;
           }
           else {
              return false;
             }
        }else{
            return false;
        }
    }

  public  function crtstr($str){

       $str =  trim($str);
       $str = strtolower(nl2br(htmlentities(addslashes((strip_tags($str))))));
       return $str;
      }
  public function redirectTo($location=NULL) {
    if ($location != NULL) {
    $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $actual_link = $actual_link."/egovt/".$location;
    header("Location: $actual_link");
    exit();
  }
}
  public function confirmUser($otp,$pass,$email){
    $pdo = $this->pdo;
    $active = 'a';
    if($this->checkOtp($otp,$email)){
      $stmt = $pdo->prepare('UPDATE `users` SET `hash` = ?,`active` = ? WHERE email = ?');
      if($stmt->execute([$pass,$active,$email])){
        return true;
      }
      else {

        return false;
      }
    }

  }
  public function login($uname,$password){

          $pdo = $this->pdo;
          if(!$this->checkUname($uname)){
          if($this->checkActive($uname)){
              $stmt = $pdo->prepare('SELECT * FROM users WHERE uname = ?  limit 1');
              $stmt->execute([$uname]);
                        if($stmt->rowCount()==1){
                        $user = $stmt->fetch();
                                if(password_verify($password,$user['hash'])){

                                $this->user = $user;
                                session_regenerate_id();
                                $_SESSION['user']['id'] = $user['id'];
                                $_SESSION['user']['fname'] = $user['fname'];
                                $_SESSION['user']['email'] = $user['email'];
                                return 4;

                               }else{

                               return 2; // wrong password
                            }
                       }else{
                         return 1;// not Any  data
                       }
         }else {
                return 0; // not active user
       }
     }else{
        return 3;
     }
  }
  public function checkActive($data){
    $pdo = $this->pdo;
    $stmt = $pdo->prepare('SELECT `active` FROM `users` WHERE uname = ? or email = ? LIMIT 1');
    $stmt->execute([$data,$data]);
        if($stmt->rowCount()==1){
        $result = $stmt->fetch();

        if($result['active']=='a'){
          return true;
        }else{
          return false;
        }
    }else {
      return false;
    }
  }


}
