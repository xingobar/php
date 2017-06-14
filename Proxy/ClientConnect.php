<?php
include_once('./DbConnection/DbConnect.php');
include_once('Proxy.php');
class ClientConnect{
    private $conn;
    private $proxy;

    public function __construct(){
       $this->proxy = new Proxy();
       $this->authenticate($this->proxy);
    }

    private function authenticate(IHandler $proxy){
        $proxy->login('gary','gary');
    }
}

$clientConnect = new ClientConnect();
?>