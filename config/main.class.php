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

    public function login($email,$password){
        if(is_null($this->pdo)){
            $this->msg = 'Connection did not work out!';
            return false;
        }else{
            $pdo = $this->pdo;
            $stmt = $pdo->prepare('SELECT id, fname, lname, email, wrong_logins, password, user_role FROM users WHERE email = ? and confirmed = 1 limit 1');
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if(password_verify($password,$user['password'])){
                if($user['wrong_logins'] <= $this->permitedAttemps){
                    $this->user = $user;
                    session_regenerate_id();
                    $_SESSION['user']['id'] = $user['id'];
                    $_SESSION['user']['fname'] = $user['fname'];
                    $_SESSION['user']['lname'] = $user['lname'];
                    $_SESSION['user']['email'] = $user['email'];
                    $_SESSION['user']['user_role'] = $user['user_role'];
                    return true;
                }else{
                    $this->msg = 'This user account is blocked, please contact our support department.';
                    return false;
                }
            }else{
                $this->registerWrongLoginAttemp($email);
                $this->msg = 'Invalid login information or the account is not activated.';
                return false;
            }
        }
    }

    public function registration($email,$fname,$lname,$pass){
        $pdo = $this->pdo;
        if($this->checkEmail($email)){
            $this->msg = 'This email is already taken.';
            return false;
        }
        if(!(isset($email) && isset($fname) && isset($lname) && isset($pass) && filter_var($email, FILTER_VALIDATE_EMAIL))){
            $this->msg = 'Inesrt all valid requered fields.';
            return false;
        }

        $pass = $this->hashPass($pass);
        $confCode = $this->hashPass(date('Y-m-d H:i:s').$email);
        $stmt = $pdo->prepare('INSERT INTO users (fname, lname, email, password, confirm_code) VALUES (?, ?, ?, ?, ?)');
        if($stmt->execute([$fname,$lname,$email,$pass,$confCode])){
            if($this->sendConfirmationEmail($email)){
                return true;
            }else{
                $this->msg = 'confirmation email sending has failed.';
                return false;
            }
        }else{
            $this->msg = 'Inesrting a new user failed.';
            return false;
        }
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


    public function emailActivation($email,$confCode){
        $pdo = $this->pdo;
        $stmt = $pdo->prepare('UPDATE users SET confirmed = 1 WHERE email = ? and confirm_code = ?');
        $stmt->execute([$email,$confCode]);
        if($stmt->rowCount()>0){
            $stmt = $pdo->prepare('SELECT id, fname, lname, email, wrong_logins, user_role FROM users WHERE email = ? and confirmed = 1 limit 1');
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            $this->user = $user;
            session_regenerate_id();
            if(!empty($user['email'])){
            	$_SESSION['user']['id'] = $user['id'];
	            $_SESSION['user']['fname'] = $user['fname'];
	            $_SESSION['user']['lname'] = $user['lname'];
	            $_SESSION['user']['email'] = $user['email'];
	            $_SESSION['user']['user_role'] = $user['user_role'];
	            return true;
            }else{
            	$this->msg = 'Account activitation failed.';
            	return false;
            }
        }else{
            $this->msg = 'Account activitation failed.';
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


    public function assignRole($id,$role){
        $pdo = $this->pdo;
        if(isset($id) && isset($role)){
            $stmt = $pdo->prepare('UPDATE users SET role = ? WHERE id = ?');
            if($stmt->execute([$id,$role])){
                return true;
            }else{
                $this->msg = 'Role assign failed.';
                return false;
            }
        }else{
            $this->msg = 'Provide a role for this user.';
            return false;
        }
    }


    public function userUpdate($id,$fname,$lname){
        $pdo = $this->pdo;
        if(isset($id) && isset($fname) && isset($lname)){
            $stmt = $pdo->prepare('UPDATE users SET fname = ?, lname = ? WHERE id = ?');
            if($stmt->execute([$id,$fname,$lname])){
                return true;
            }else{
                $this->msg = 'User information change failed.';
                return false;
            }
        }else{
            $this->msg = 'Provide a valid data.';
            return false;
        }
    }


    private function checkEmail($email){
        $pdo = $this->pdo;
        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ? limit 1');
        $stmt->execute([$email]);
        if($stmt->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }


    private function registerWrongLoginAttemp($email){
        $pdo = $this->pdo;
        $stmt = $pdo->prepare('UPDATE users SET wrong_logins = wrong_logins + 1 WHERE email = ?');
        $stmt->execute([$email]);
    }

    private function hashPass($pass){
        return password_hash($pass, PASSWORD_DEFAULT);
    }

    public function printMsg(){
        print $this->msg;
    }


    public function logout() {
        $_SESSION['user'] = null;
        session_regenerate_id();
        return true;
    }



    public function listUsers(){
        if(is_null($this->pdo)){
            $this->msg = 'Connection did not work out!';
            return [];
        }else{
            $pdo = $this->pdo;
            $stmt = $pdo->prepare('SELECT id, fname, lname, email FROM users WHERE confirmed = 1');
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }
    }

    public function render($path,$vars = '') {
        ob_start();
        include($path);
        return ob_get_clean();
    }

    public function indexHead() {
        print $this->render(indexHead);
    }

    public function indexTop() {
        print $this->render(indexTop);
    }

    public function loginForm() {
        print $this->render(loginForm);
    }

    public function activationForm() {
        print $this->render(activationForm);
    }

    public function indexMiddle() {
        print $this->render(indexMiddle);
    }

    public function registerForm() {
        print $this->render(registerForm);
    }

    public function indexFooter() {
        print $this->render(indexFooter);
    }

    public function userPage() {
	$users = [];
	if($_SESSION['user']['user_role'] == 2){
		$users = $this->listUsers();
	}
        print $this->render(userPage,$users);
    }
}
