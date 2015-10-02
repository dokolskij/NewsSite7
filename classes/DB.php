<?php
class DB{
	private $dbh;
	private $className='stdClass';
	
	public function __construct() {
		$this->dbh=new Pdo('mysql:dbname=test; host=localhost; charset=utf8', 'root', '123');
	}

	public function setClassName($className){
		$this->className=$className;
	}

	public function query($sql, $params=[]){
		$sth=$this->dbh->prepare($sql);
		$sth->execute($params);
		return $sth->fetchAll(PDO::FETCH_CLASS, $this->className);
	}

	public function lastInsertId(){
		return $this->dbh->lastInsertId();
	}

	public function execute($sql, $params=[]){
		$sth=$this->dbh->prepare($sql);
		return $sth->execute($params);
	}
	
}

