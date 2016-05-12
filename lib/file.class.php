<?php
class File	{

	
	// method creates a folder
	// ------------------------------------------------ >>

	public function make_folder($array)
	{
		foreach($array as $row)
		{
			mkdir($row);
		}
		
		return $this;
	}

	// ------------------------------------------------ >>


}
?>