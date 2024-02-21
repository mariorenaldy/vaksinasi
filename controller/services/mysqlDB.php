<?php

class MySQLDB{
  protected $servername = DB_HOST;
  protected $dbname = DB_NAME;
  protected $username = DB_USER;
  protected $password = DB_PASS;
	protected $lastID;

	protected $db_connection;

	public function __construct(string $servername = DB_HOST, string $dbname = DB_NAME, string $username = DB_USER, string $password = DB_PASS){
    $this->servername = $servername;
    $this->dbname = $dbname;
    $this->username = $username;
    $this->password = $password;
	}

	public function openConnection(){
		$this->db_connection = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
		
		if($this->db_connection->connect_error){
			die('Could not connect to '.$this->servername.' server');
		}
	}

	public function executeSelectQuery($sql){
		$this->openConnection();
		$query_result = $this->db_connection->query($sql);
		$result = [];
		if($query_result && $query_result->num_rows > 0){
			while($row = $query_result->fetch_assoc()){
				$result[] = $row;
			}
		}
		$this->closeConnection();
		return $result;
	}

	public function executeNonSelectQuery($sql){
		$this->openConnection();
		$query_result = $this->db_connection->query($sql);
		$this->lastID = $this->db_connection->insert_id;
		$this->closeConnection();
		return $query_result;
	}

	public function closeConnection(){
		$this->db_connection->close();
	}

	public function escapeString($name){
		$this->openConnection();
		return $this->db_connection->real_escape_string($name);
	}

	public function lastID(){
		return $this->lastID;
	}
}
?>