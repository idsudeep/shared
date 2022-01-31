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

    $user->fname = $_GET['fname'];
    $user->email = $_GET['email'];
    $user->password = $_GET['password'];
    $user->mobile_no = $_GET['mobile_no'];
    $user->address =$_GET['address'];

    $user->validateUser();
    if($user->createUser()){

        echo json_encode(array('title'=>'user Created.'));
    }else{
        echo json_encode(array('title'=>'user Already exists'));
    }
  

     

?>