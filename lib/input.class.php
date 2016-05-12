<?php
class Input	{

	public $variable;

	
	// method validates user input
	// ------------------------------------------------ >>

	public function filter($variable)
	{
		$this->variable = stripslashes(strip_tags(trim($variable)));
		return $this->variable;
	}

	// ------------------------------------------------ >>




	// method grabs post variable
	// ------------------------------------------------ >>

	public function post($value)
	{
		return $_POST[$value];
	}

	// ------------------------------------------------ >>




	// method grabs post variable
	// ------------------------------------------------ >>

	public function get($value)
	{
		return $_GET[$value];
	}

	// ------------------------------------------------ >>




    // method validates email address format
	// ------------------------------------------------ >>

	function valid_email($address)
	{
		return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $address)) ? FALSE : TRUE;
	}

	// ------------------------------------------------ >>
}
?>