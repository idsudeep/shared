<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  include_once '../config/database.php';
  include_once '../class/users.php';

  $database = new DB();
  $db = $database->getConnection();

  $user = new UserInfo($db);

  $user->email= $_GET['email'];
  $user->password=$_GET['password'];

  $holdArr = $user->validateLog();
 
  if($holdArr['password']!=$_GET['password']){
      echo json_encode(array('title'=>'wrong Password'));
  }
  if($holdArr['email']=$_GET['email'] && $holdArr['password']==$_GET['password']){

    echo json_encode(array('match'=> 'password Match'));
  }
  



?>