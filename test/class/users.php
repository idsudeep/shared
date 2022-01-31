<?php
    class UserInfo{

        // conn
        private $conn;

        // table
        private $dbTable = 'user_tbl';

        // col
        public $fname;
        public $email;
        public $mobile_no;
        public $password;
        public $address;
      
       

        // public $created;

        // db conn
        public function __construct($db){
            $this->conn = $db;
        }

        public function validateUser(){
            $queryOne = "select * from user_tbl where email =?";
            $stmt = $this->conn->prepare($queryOne);
            $this->email=htmlspecialchars(strip_tags($this->email));
            $stmt->bindParam(1,$this->email,PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);   
        }

        public function createUser(){
 
            $result = $this->validateUser();
            if($result['email']!=$this->email){
                
            $sql_Q = "insert into user_tbl (fname ,email ,password ,mobile_no ,address) values (:fname, :email, :password, :mobile_no, :address)";
                     
            $stmt= $this->conn->prepare($sql_Q);
            $this->fname=htmlspecialchars(strip_tags($this->fname));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->password=htmlspecialchars(strip_tags($this->password));
            $this->mobile_no=htmlspecialchars(strip_tags($this->mobile_no));
            $this->address=htmlspecialchars(strip_tags($this->address));
           $stmt->bindParam(':fname',$this->fname ,PDO::PARAM_STR);
           $stmt->bindParam(':email',$this->email,PDO::PARAM_STR);
           $stmt->bindParam(':password',$this->password,PDO::PARAM_STR);
           $stmt->bindParam(':mobile_no',$this->mobile_no);
           $stmt->bindParam(':address',$this->address,PDO::PARAM_STR);
           if($stmt->execute()){
               return true;
           }
                
            }else{ return false;}

        }

        public function validateLog(){

            $simpleQuery = "select fname,email,password,mobile_no,address from user_tbl where password = :password AND email = :email";
            $stmt= $this->conn->prepare($simpleQuery);
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->password=htmlspecialchars(strip_tags($this->password));
            $stmt->bindParam(':email',$this->email, PDO::PARAM_STR);
            $stmt->bindParam(':password',$this->password, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);

        }

        public function getAllUser(){
            $sqlQuery = "select userid,fname ,email ,mobile_no ,address , DOJ from user_tbl ";
            $stmt=$this->conn->prepare($sqlQuery);
            if($stmt->execute()){
                return $stmt;
            }

        }



    }