<?php

/*  logger.php (class)

	this is for debugging and general information
	to be stored in a flat file.  Also good for logging
	actions that users do, for security audits.
	
	Warn Levels:
	------------
	0 - Informational [INFO]
	1 - Debug         [DEBUG]
	2 - Warning       [WARN]
	3 - Critical      [CRITICAL]
	4 - End of Days   [EOD]  <-  Seriously, if you use this one it means your server's on fire.
	
	usage:  $logme = new logger(Type as Integer, Location as String)
	Type = flatfile/mysql
	Location = if flatfile the location you want to save the log file including name
	   	   if db, then the class var where you stored the db connection info (must use OOP vars, not arrays)
  	   
*/

class Logger
{
	private $timestamp;
	private $warnLvl = array(0=>"[INFO] ", 1=>"[DEBUG] ", 2=>"[WARNING] ", 3=>"[CRITICAL] ", 4=>"[END-OF-DAYS] ");
	
	function __construct($typId = NULL, $location = NULL)
	{
		switch($typId) {
			case "flatfile":
				$this->type     = $typId;
				$this->filename = !empty($location) ? rtrim($location, '\\/') : "website.log";
				
				//create file (if it doesn't exist)
				if(file_exists($this->filename) && !is_writable($this->filename)) {
					throw new RuntimeException('Log file could not be written to. Check your permissions.');
				}
				
				$this->fileHandle = fopen($this->filename, 'a');
				if(!$this->fileHandle) {
					throw new RuntimeException('The file could not be opened.  Check permissions.');
				}
				
				break;
			case "mysql":	
				$this->type     = $typId;
				$this->dbhost   = !empty($location->host)   ? $location->host   : "";
				$this->dbuser   = !empty($location->user)   ? $location->user   : "";
				$this->dbpass   = !empty($location->pass)   ? $location->pass   : "";
				$this->dbname   = !empty($location->db)     ? $location->db     : "";
				break;
			default:
				return false;
		}
	}
	
	public function write($errLevel = NULL, $msg = NULL) 
	{
		$timestamp = new DateTime();
		$timestamp->format("dMY H:i:s e");
		$output = "";
		if($this->type == "flatfile") 
		{
			$output .= "[".$timestamp."]";
		}
		$output .= $warnLvl[$errorLevel].$msg;
		
		
		return true;
	}
	
	function __destruct()
	{
	
	}
}
?>
