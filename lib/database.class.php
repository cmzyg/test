<?php

class Database {

	public $result, $rowCount, $last_id, $rows;
	

	public function __construct($db)
	{
		$this->db = $db;
	}



	public function select($q, $params = NULL)
	{
		$query = $this->db->prepare($q);

        if($params !== NULL)
        {
        	$i = 1;
        	foreach($params as $value)
        	{
        		$query->bindValue($i++, $value);
        	}
	    }

		if($query->execute())
		{
		    $this->result  = $query->fetch();
		    $this->rows    = $query->rowCount();
		    return $this;
		}
	}

	public function selectAll($q, $params = NULL)
	{
		$query = $this->db->prepare($q);

        if($params !== NULL)
        {
        	$i = 1;
        	foreach($params as $value)
        	{
        		$query->bindValue($i++, $value);
        	}
	    }

		if($query->execute())
		{
		    $this->result  = $query->fetchAll();
		    $this->rows    = $query->rowCount();
		    return $this;
		}
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

	    $this->last_id = $this->db->lastInsertId();
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


	public function fetch()
	{
		return $this->result;
	}

    
	public function rowCount()
	{
		return $this->rows;
	}

	public function lastInsertId()
	{
		return $this->last_id;
	}


	
}