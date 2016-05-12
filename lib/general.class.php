<?php

class General {

    public $base_url       = 'http://www.classy-design.co.uk/animal/';
    public $admin_base_url = 'http://www.classy-design.co.uk/animal/admin/';

	
	// method redirects to another page
	// ------------------------------------------------ >>

	public function redirect($location)
	{
		header("location: $location");
		exit;
	}

	// ------------------------------------------------ >>


    // method cuts of a string after the limit of words is reached
	// ------------------------------------------------ >>

	public function limit_words($string, $word_limit)
	{
		$words = explode(" ", $string);
		return implode(" ", array_splice($words, 0, $word_limit));
	}

	// ------------------------------------------------ >>


	// method loads CSS stylesheets
	// ------------------------------------------------ >>

	public function load_styles($styles_array)
	{
		foreach($styles_array as $style)
		{
			echo "<link rel='stylesheet' href='" . $this->base_url . "assets/css/" . $style . "' />";
		}	
	}

	// ------------------------------------------------ >>


	// method loads CSS stylesheets
	// ------------------------------------------------ >>

	public function load_scripts($scripts_array)
	{
		foreach($scripts_array as $script)
		{
			echo "<script src='" . $this->base_url . "assets/js/" . $script . "'></script>";
		}	
	}

	// ------------------------------------------------ >>

	public function base_url()
	{
		return $this->base_url;
	}
 
 
}
?>