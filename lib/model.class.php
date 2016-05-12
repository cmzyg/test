<?php

class Model {
	
	private $db;

	public function __construct($db)
	{
		require_once('lib/database.class.php');
		$this->database = new Database($db);
	}

	
}