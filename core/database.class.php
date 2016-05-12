<?php

class Database {
	
	private $db;
	public $result;
	public $results;

	public function __construct($db)
	{
		$this->db = $db;
	}
	

	public function update($query, $array)
	{
		$query = $this->db->prepare($query);

        	$i = 1;
        	foreach($array as $value)
        	{
        		$query->bindValue($i++, $value);
        	}

		$query->execute();
	}


	public function delete($query, $array)
	{
		$query = $this->db->prepare($query);

        	$i = 1;
        	foreach($array as $value)
        	{
        		$query->bindValue($i++, $value);
        	}

		$query->execute();
	}

	public function insert($query, $array)
	{
		$query = $this->db->prepare($query);

        	$i = 1;
        	foreach($array as $value)
        	{
        		$query->bindValue($i++, $value);
        	}

		$query->execute();
	}



	public function select($query, $array = NULL)
	{
		$query = $this->db->prepare($query);

        if($array !== NULL)
        {
        	$i = 1;
        	foreach($array as $value)
        	{
        		$query->bindValue($i++, $value);
        	}
	    }

		$query->execute();

		$this->result  = $query->fetch();
	}


	public function selectAll($query, $array = NULL)
	{
		$query = $this->db->prepare($query);

        if($array !== NULL)
        {
        	$i = 1;
        	foreach($array as $value)
        	{
        		$query->bindValue($i++, $value);
        	}
	    }

		$query->execute();

		$this->results = $query->fetchAll();
	}


	public function fetch()
	{
		return $this->result;
	}

    
    public function fetchAll()
	{
		return $this->results;
	}


	public function rowCount($query, $array = NULL)
	{
		$query = $this->db->prepare($query);

        if($array !== NULL)
        {
        	$i = 1;
        	foreach($array as $value)
        	{
        		$query->bindValue($i++, $value);
        	}
	    }

		$query->execute();

		return $query->rowCount();
	}


	
}