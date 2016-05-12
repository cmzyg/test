<?php

class Controller extends Database {

	public $variable;
	
	public function filter($variable)
	{
		$this->variable = stripslashes(strip_tags(trim($variable)));
		return $this->variable;
	}

	public function set_flashdata($item, $value)
	{
		$_SESSION[$item] = $value;
	}

	public function flashdata($item)
	{
		if(isset($_SESSION[$item]))
		{
			$value = $_SESSION[$item];
			unset($_SESSION[$item]);
			return $value;
		}
	}

	function new_line($input)
	{
        return preg_replace('/<br(\s+)?\/?>/i', "\n", $input);
	}


	public function redirect($location)
	{
		header("location: $location");
		exit;
	}


	// method uploads file
	// ------------------------------------------------ >>

    public function upload_file($directory, $tmp, $file)
    {
    	if($file) 
		{
			move_uploaded_file($tmp, $directory . "/" . $file);
        }

        return $this;
    }

	// ------------------------------------------------ >>
	
}