<?php 
Class Log extends Exception{
	protected $error;
	protected $file;
	protected $line;
	protected $data;
	protected $fileLog='fileLog.txt';

	public function __construct($err) {
		$this->error = $err->getMessage();
		$this->file = $err->getFile();
		$this->line = $err->getLine();
		$this->data = date("Y-m-d H:i:s (T)");
	}

	public function errLog(){
		$errInfo=$this->data."\n";
		$errInfo.=$this->error."\n";
		$errInfo.=$this->file.' on line ';
		$errInfo.=$this->line.' <br>'."\n\n";
		file_put_contents($this->fileLog, $errInfo, FILE_APPEND | LOCK_EX);
	}

}