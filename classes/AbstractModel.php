<?php
abstract class AbstractModel
{ 	
    protected static $table;
	protected $data;
    //protected static $class;
	
	public function __set($k, $v){
		$this->data[$k]=$v;
	}
	
	public function __get($k){
		return $this->data[$k];
	}

	public function __isset($k){
		return $this->data[$k];
	}

	public static function findAll(){
		$class=get_called_class();

		$sql='
		SELECT * FROM '.static::$table;
		
		$db=new DB;
		$db->setClassName($class);
		return $db->query($sql);
	}

	public static function findOneByPk($id){
		$class=get_called_class();

		$sql='
		SELECT * FROM '.static::$table. '
		WHERE id=:id';
		
		$db=new DB;
		$db->setClassName($class);
		return $db->query($sql, [':id' => $id])[0];
	}

	private function insert(){
		$cols= array_keys($this->data);
		
		foreach ($cols as $col) {
			
			$data[':'.$col] = $this->data[$col];
		}
		
		$sql='
		INSERT INTO '.static::$table. '
		(' .implode(', ', $cols). ')
		VALUES
		(' .implode(', ', array_keys($data)). ')
		';
		if (!empty($this->data['title']) && !empty($this->data['text'])){
			$db=new DB;
			$result=$db->execute($sql, $data);
			
			if (true==$result){
				print $db->lastInsertId();
			}
		}	
	}

	public static function findByColumn($column, $value){
		
		$class=get_called_class();
		$sql='
		SELECT * FROM '.static::$table. '
		WHERE '.$column.'=:value';
		
		$db=new DB;
		$db->setClassName($class);
		$res=$db->query($sql, [':value'=>$value]);

		if (empty($res)){
			throw new E404Exception(' Ничего не найдено...');
		}
		return $res;
	}

	private function update(){
		$cols=[];
		$data=[];
		foreach ($this->data as $k=>$v) {
			$data[':'.$k]=$v;
			if ('id'==$k){
			continue;}
			$cols[]=$k.'=:'.$k;
		}
		
		$sql='
		UPDATE '.static::$table. '
		SET '.implode(', ', $cols). '
		WHERE id=:id';
		
		$db=new DB;
		$db->execute($sql, $data);
	}

	public function delete(){
		$sql='
		DELETE FROM '.static::$table.' WHERE id=:id';
		$db=new DB;
		$db->execute($sql, [':id'=>$this->id]);
	}

	public function save(){
		if (!isset($this->id)) {
			$this->insert();
		}  
		else {
			$this->update();
		}
	}
}