<?php
/*
	class FSQL{
		public $con;
		public $host = "localhost";
		public $user_name = "root";
		public $password = "";
		public $database_name = "caiwuu";
		public function connection(){
			$this->con = mysql_connect($this->host, $this->user_name, $this->password);
		}
		public function disconnect(){
			mysql_close($this->con);
		}
		public function set_laugue(){
			if($this->con)
			{
				mysql_query("set names utf8");
			}
		}
		public function choice(){
			if($this->con)
			{
					mysql_select_db($this->database_name, $this->con);
			}
		}
		public function query($sql_query){
			return mysql_query($sql_query);
		}
		public function connections(){
			$this->connection();
			$this->set_laugue();
			$this->choice();
		}
	}
	*/
	class FSQL{
		public $con;
		public $host = "localhost";
		public $user_name = "root";
		public $password = "";
		public $database_name = "caiwuu";
		public function connection(){
			$this->con = new mysqli($this->host, $this->user_name, $this->password, $this->database_name);
		}
		public function disconnect(){
			$this->con->close();
		}
		public function set_laugue(){
			if(!$this->con->connect_error)
			{
				$this->con->query("set names utf8");
			}
		}
		public function query($sql_query){
			return $this->con->query($sql_query);
		}
		public function connections(){
			$this->connection();
			$this->set_laugue();
		}
	}
?>