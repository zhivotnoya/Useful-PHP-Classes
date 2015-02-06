<?php
	// template.class.php
	
	/*  this doesn't handle complex templates, or have any logic added, yet. */
	
	class Template
	{
	
		private $template;
		
		function __construct ($template = null)
		{
			if (isset($template))
			{
				$this->load($template);
			}
		}
		
		function __destruct()
		{
			// destructions stuff here...if needbe
		}
		
		public function load($file)
		{
			if (isset($file) && file_exists($file))
			{
				$this->template = file_get_contents($file);	
			}
		}
		
		public function set($var, $content)
		{
			$this->template = str_replace("{@". $var ."}", $content, $this->template);
		}
		
		public function publish()
		{
			/* 
			 * Prints out the theme to the page
			 * However, before we do that, we need to remove every var
			 * within {} that are not set
			 */
			 
			$this->removeEmpty();
			/* eval("<?php" . $this->template . "?>"); */
			
			return $this->template;
			
		}
		
		private function removeEmpty()
		{
			/*
			 * this function would remove all empty variables from the template wrapped in {}
			 */
			
			$this->template = preg_replace('^{.*}^', "", $this->template);
		}
		
		public function parse()
		{
			// this function grabs a static document and returns the content
			return $this->template;
		}
		
	}

?>
