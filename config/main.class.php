<?php

class User{
    private $pdo;

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

public function checkElectedMember($member){
  $pdo = $this->pdo;
  $stmt = $pdo->prepare('select id from assemblymembers where electedMember = ?');
  $stmt->execute([$member]);
  if($stmt->rowCount() == 1){
      $id = $stmt->fetch();
      return $id[0];
  }else{
      return false;
  }

}
public function reportVariable($name){
  $pdo = $this->pdo;
  $stmt = $pdo->prepare('SELECT * FROM `assemblymembers` WHERE electedMember = ? limit 1');
  $stmt->execute([$name]);
  if($stmt->rowCount() == 1){
      $id = $stmt->fetch();
      return $id;
  }else{
      return false;
  }
}

public function checkLogin(){
  if(isset($_SESSION['user']['login']) and isset($_SESSION['user']['username']) and
     isset($_SESSION['user']['id']) and isset($_SESSION['user']['fname']) and
    isset($_SESSION['user']['email']) and isset($_SESSION['user']['mobile']) ){
        if($_SESSION['user']['login'] == 'true'){
          return true;
        }else{
          return false;
        }
     }else{
       return false;
     }
   }

public function otherComplaints($id){
  $pdo = $this->pdo;
  $otherComplaints =array();
  if($id){
    $stmt = $pdo->prepare('select * from complaints where uid != ? group by time desc Limit 5');
    $stmt->execute([$id]);
    if($stmt->rowCount() > 0){
        while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
          $otherComplaints[]=$result;
        }
              return $otherComplaints;
    }else{
        return false;
    }
  }else{
  $stmt = $pdo->prepare('select * from complaints  group by time desc Limit 5');
  $stmt->execute([$id]);
  if($stmt->rowCount() > 0){
      while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $otherComplaints[]=$result;
      }
            return $otherComplaints;
  }else{
      return false;
  }
}

}
public function myComplaints($id){
  $pdo = $this->pdo;
  $stmt = $pdo->prepare('select * from complaints where uid = ? group by time desc Limit 5');
  $stmt->execute([$id]);
  if($stmt->rowCount() > 0){
      while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $myComplaints[]=$result;
      }
            return $myComplaints;
  }else{
      return false;
  }

}
public function addComplaints($qid,$prob,$uid,$title,$eid){
    $pdo = $this->pdo;
    $stmt = $pdo->prepare('INSERT INTO `complaints` (`qid`,`prob`,`uid`,`title`,`eid`) VALUES(?,?,?,?,?)');
    $stmt->execute([$qid,$prob,$uid,$title,$eid]);
    if($stmt->rowCount()==1){
      return true;
    }else {
      return false;
    }

}
  public  function crtstr($str){

		 $str =  trim($str);
		 $str = nl2br(htmlentities(addslashes((strip_tags($str)))));
		 return $str;
	 }
public function getUserId(){
  return $_SESSION['user']['id'];
}
public function getComplaintById($qid){
  $pdo = $this->pdo;
  $stmt = $pdo->prepare('select * from complaints where qid = ? ');
  $stmt->execute([$qid]);
  if($stmt->rowCount() == 1){
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
  }else{
      return false;
  }

}
public function registerBy($uid){
  $pdo = $this->pdo;
  $stmt = $pdo->prepare('select uname,fname from users where id = ? limit 1');
  $stmt->execute([$uid]);
  if($stmt->rowCount() == 1){
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['fname'];
  }else{
      return false;
  }
}
public function tagedMLA($eid){
  $pdo = $this->pdo;
  $stmt = $pdo->prepare('select electedMember,constituency,did from assemblymembers where eid = ? limit 1');
  $stmt->execute([$eid]);
  if($stmt->rowCount() == 1){
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
  }else{
      return false;
  }
}
public function getDistrict($did){
  $pdo = $this->pdo;
  $stmt = $pdo->prepare('select name from district where did = ? limit 1');
  $stmt->execute([$did]);
  if($stmt->rowCount() == 1){
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['name'];
  }else{
      return false;
  }
}
public function liveSearchData(){
  $pdo = $this->pdo;
  $stmt = $pdo->prepare('select electedMember from assemblymembers');
  $stmt->execute();
  if($stmt->rowCount() > 0){
      while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[]=$result['electedMember'];
      }
            return $data;
  }else{
      return false;
  }
}
public function getNameByUID($uid){
  $pdo = $this->pdo;
  $stmt = $pdo->prepare('select uname from users where id = ? limit 1');
  $stmt->execute([$uid]);
  if($stmt->rowCount() == 1){
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['uname'];
  }else{
      return false;
  }

}
public function areaSearchData(){
  $pdo = $this->pdo;
  $stmt = $pdo->prepare('select constituency from assemblymembers');
  $stmt->execute();
  if($stmt->rowCount() > 0){
      while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[]=$result['constituency'];
      }
            return $data;
  }else{
      return false;
  }
}
public function getEid($name){
  $pdo = $this->pdo;
  $stmt = $pdo->prepare('select eid  from assemblymembers where constituency = ? limit 1');
  $stmt->execute([$name]);
    if($stmt->rowCount() == 1){
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return  $result['eid'];


  }else{
      return 25;
  }
}
public function updateViews($qid){
  $pdo = $this->pdo;
  $stmt = $pdo->prepare('update complaints set views = views+1 where qid = ?');
  $stmt->execute([$qid]);
}
public function oldComplaints(){
  $pdo = $this->pdo;
  $stmt = $pdo->prepare('select * from complaints  Limit 3');
  $stmt->execute();
  if($stmt->rowCount() > 0){
      while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $myComplaints[]=$result;
      }
            return $myComplaints;
  }else{
      return false;
  }
}
}
