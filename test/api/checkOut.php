<?php 
 include_once '../config/database.php';
 include_once '../class/users.php';
 $database = new DB();
 $db =$database->getConnection();

 $userIn = new UserInfo($db);
 $getAll = $userIn->getAllUser();
 $Arr =array();
 if($userIn->getAllUser()){

  while($row = $getAll->fetch(PDO::FETCH_ASSOC)){

    $someArr = array(
              "userid"=>$row['userid'],
              "fname"=>$row['fname'],
              "email"=>$row['email'],
              "mobile_no"=>$row['mobile_no'],
              "address"=>$row['address'],
              "DOJ"=>$row['DOJ']
    );

    array_push($Arr,$someArr);
  }
  echo json_encode($Arr);
 }
   

  

?>