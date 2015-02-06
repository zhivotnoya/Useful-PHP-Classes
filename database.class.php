<?php
// db.class.php

/* 
	this class adapted for my use from example located at:
	http://www.dreamincode.net/forums/topic/223360-connect-to-your-database-using-oop-php5-with-mysql-and-mysqli/
	
	This class utilizes the newer MySQLi methods, as the older MySQL methods are being phased out my the PHP folks.
*/

class db
{
	private $selectdb;
	private $lastQuery;
	private $config;
	public $dbhost;
	public $dbuser;
	public $dbpass;
	public $dbname;
	
	/* Be sure to change the defaults below if your script(s) all use the same db.  It makes
	   it easier to write code, and keep the classes in a seperate location, for security
	   reasons.
	   */
	
	function __construct($dbhost = NULL, $dbuser = NULL, $dbpass = NULL, $dbname = NULL)
	{
		$this->host   = !empty($dbhost)   ? $dbhost   : "example.com";
		$this->user   = !empty($dbhost)   ? $dbuser   : "username";
		$this->pass   = !empty($dbpass)   ? $dbpass   : "password";
		$this->db     = !empty($dbname)   ? $dbname   : "database";
	}
	
	function __destruct()
	{
		// destruct stuff should go here.
	}

	public function openConnection()
	{
		$this->connection = new mysqli($this->host, $this->user, $this->pass, $this->db);
		
		if($this->connection->connect_error) {
			trigger_error('Database connection failed: ' . $this->connection->connect_error, E_USER_ERROR);
		}
	}  // end if func openConnection
	
	public function closeConnection()
	{
		$this->connection->close();
	} // end of func closeConnection
	
	public function escapeString($string)
	{
		return mysqli_real_escape_string($this->connection, $string);
	} // end of func escapeString
	
	public function query($query)
	{
		$query = str_replace("}", "", $query);
		$query = str_replace("{", "", $query);
		
		try
		{
			if(empty($this->connection))
			{
				$this->openConnection();
				$this->lastQuery = mysqli_query($this->connection, $this->escapeString($query));
				$this->closeConnection();
				
				return $this->lastQuery;
			} else {
				$this->lastQuery = mysqli_query($this->connection, $this->escapeString($query));
				
				return $this->lastQuery;
			}
		}
		catch(exception $e)
		{
			return $e;
		}
	} // end of func query
	
	public function lastQuery()
	{
		return $this->lastQuery;
	}  // end of func lastQuery()
	
	public function pingServer()
	{
		try
		{
			if(!mysqli_ping($this->connection))
			{
				return false;
			} else {
				return true;
			}
		}
		catch(exception $e)
		{
			return $e;
		}
	}  // end of func pingServer
	
	public function hasRows($result)
	{
		try
		{
			if(mysqli_num_rows($result)>0)
			{
				return true;
			} else {
				return false;
			}
		}
		catch(exception $e)
		{
			return $e;
		}
	}  // end of func hasRows
	
	public function countRows($result)
	{
		try
		{
			return mysqli_num_rows($result);
		}
		catch(exception $e)
		{
			return $e;
		}
	}  // end of func countRows
	
	public function fetchAssoc($result)
	{
		try
		{
			return mysqli_fetch_assoc($result);
		} catch(exception $e) {
			return $e;
		}
	}  // end of func fetchAssoc

	public function fetchArray($result)
	{
		try
		{
			return mysqli_fetch_array($result);
		}
		catch(exception $e)
		{
			return $e;
		}
	}  // end of func fetchArray
	
	public function error()
	{
		return $mysqli->error;
	}
	
	
} // end of db.class.php



?>
