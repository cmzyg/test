<?php

class Session {


    // method sets a session for the next pag load only
	// ------------------------------------------------ >>

	public function set_flashdata($item, $value)
	{
		$_SESSION[$item] = $value;
	}

	// ------------------------------------------------ >>




    // method sets a session for the next pag load only
	// ------------------------------------------------ >>

	public function set_userdata($item, $value)
	{
		$_SESSION[$item] = $value;
	}

	// ------------------------------------------------ >>




	// method returns session variable and deletes it
	// ------------------------------------------------ >>

	public function flashdata($item)
	{
		if(isset($_SESSION[$item]))
		{
			$value = $_SESSION[$item];
			unset($_SESSION[$item]);
			return $value;
		}
	}

	// ------------------------------------------------ >>



	// method returns session variable
	// ------------------------------------------------ >>

	public function userdata($item)
	{
		if(isset($_SESSION[$item]))
		{
			$value = $_SESSION[$item];
			return $value;
		}
	}

	// ------------------------------------------------ >>

	
}