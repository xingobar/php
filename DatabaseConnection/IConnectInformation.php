<?php
interface IConnectionInformation{

	const HOST = 'localhost';
	const ACCOUNT = 'root';
	const PASSWORD = 'root';
	const PORT = '8889';
	const DBNAME = 'test';

	public function connect();
}
?>