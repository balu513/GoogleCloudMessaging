<?php

class DBCnf {
	private $HOST 	= "localhost";
	private $USER 	= "root";
	private $PASS 	= "admin123";
	private $DBNAME = "GCM";
	
	
	/**
	 * @var DB
	 */
	private static $instance = NULL;
	
	/**
	 * @var mysqli
	 */
	private $conn;

	/**
	 * Create Constructor for DataBase.
	 */
	private function __construct() {
		$this->conn = mysqli_connect ($this->HOST, $this->USER, $this->PASS, $this->DBNAME);

		if (mysqli_connect_error()) {
			die("{errorno='" . mysqli_connect_errno() . "', error='". mysqli_connect_error()."'}");
		}
	}

	public static function dieOnError() {
		die("{errorno='".self::$instance->conn->errno."', error='".self::$instance->conn->error."'}");
	}
	
	/**
	 * Get the MySqli connection
	 * @return mysqli
	 */
	public static function getConnection() {
		if(self::$instance == NULL) {
			self::$instance = new DBCnf();
		}
		
		return self::$instance->conn;
	}
}