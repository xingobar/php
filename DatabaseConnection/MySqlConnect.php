<?php
include_once('IConnectionInformation.php');

class MySqlConnect implements IConnectionInformation{

	private static $server = IConnectionInformation::HOST;
	private static $db = $IConnectionInformation::DBNAME;
	private static $user = $IConnectionInformation::ACCOUNT;
	private static $password = $IConnectionInformation::PASSWORD;
	private static $port = $IConnectionInformation::PORT:
	private static $hookup ;


	public function connect(){

		try {
		 	$conn = new PDO("mysql:host=$server;port=$port;dbname=$db",$user, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
		 	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		 	self::$hook = $conn;
		 	echo 'connect successfully';
		 } catch(PDOException $e) {
		 	echo $e->getMessage();
		 	echo 'failed connect';
		 }
		 return self::$hookup;
	}
}
?>