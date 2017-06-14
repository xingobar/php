<?php
include_once('IHandler.php');
include_once('./DbConnection/DbConnect.php');
include_once('RealSubject.php');
class Proxy implements IHandler
{
    
    private $authSuccess;
    private $conn;
    private $realSubject;
    private $table;


    public function login($userName,$password){
        $password = md5($password);
        $this->authSuccess = false; 
        $this->table = 'user';
        $this->conn = DbConnect::connect();

        try{
            $sql = "select password from $this->table where user_name =:user_name";
            $sqlRaw = $this->conn->prepare($sql);
            $sqlRaw->execute(array(
                'user_name' => $userName
            ));
            $rowCount = $sqlRaw->rowCount();
        }catch(PDOException $pdoException){
            printf("Failed %s <br/>" ,$pdoException->getMessage());
            echo '<br/>';
            $this->conn = null;
            exit(); 
        }

        if($rowCount === 0){
            echo 'username or password doesn\'t exist';
            $this->conn = null;
            exit();
        }else{
            $actualPassword = $sqlRaw->fetch()['password'];
            if($password === $actualPassword){
                $this->authSuccess = true;
            }
        }
        $this->conn = null;

        if($this->authSuccess){
            $this->request();
        }else{
            echo 'username or password is wrong';
        }
    }

    public function request(){
        $this->realSubject = new realSubject();
        $this->realSubject->request();
    }  
}
?>