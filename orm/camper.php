<?php


class Camper
{

	// private $id;
	// private $first;
	// private $last;
	// private $gender;
	// private $division;
	// private $bunk;

	public static function create($connection, $f, $l, $g, $d, $b) {
	
		$query = "INSERT INTO camper (first,last,gender,division,bunk) VALUES ('$f','$l','$g','$d','$b')";

		$connection->query($query);

		if($connection === false) {
		  	trigger_error('Wrong SQL: ' . $query . ' Error: ' . $connection->error, E_USER_ERROR);
		}
		else {
			
			$new_id = $connection->insert_id;
			return new Camper($new_id, $f, $l, $g, $d, $b);

		}
	}

	public static function remove($connection, $id) {
	
		$query = "DELETE FROM camper where id='$id'";

		$connection->query($query);

		if($connection === false) {
		  	trigger_error('Wrong SQL: ' . $query . ' Error: ' . $connection->error, E_USER_ERROR);
		}
		else {
			return true;
		}
	}

	public static function all($connection) {
		
		$query = "SELECT * FROM camper where 1 ORDER BY last";

		$result = $connection->query($query);
		
		$campers = array();

		$next_row = $result->fetch_row();

		while($next_row)
		{
			$campers[] = new Camper($next_row[0],$next_row[1],$next_row[2],$next_row[3],$next_row[4],$next_row[5]);

			$next_row = $result->fetch_row();
		}
		return $campers;
	}
	public static function some($connection, $idList) {
		$campers = array();

		for($i=0;$i<count($idList);$i++)
		{
			$id = $idList[$i];
			$query = "SELECT * FROM camper where id='$id'";
			$result = $connection->query($query);
			$campers[] = $result->fetch_row();
		}
		return $campers;
	}		
	      
	     private function __construct($i, $f, $l, $g, $d, $b) {
			$this->id = $i;
			$this->first = $f;
			$this->last = $l;
			$this->gender = $g;
			$this->division = $d;
			$this->bunk = $b;
	      }
	    
	      public function id() {
			return $this->id;
	      }
	    
	      public function first() {
			return $this->first;
	      }

	      public function last() {
			return $this->last;
	      }
	    
	      public function gender() {
			return $this->gender;
	      }
	      public function division() {
			return $this->division;
	      }
	      public function bunk() {
			return $this->bunk;
	      }
	    
	      public function getJSON() {
			$json_rep = array();
			$json_rep['id'] = $this->id;
			$json_rep['first'] = $this->first;
			$json_rep['last'] = $this->last;
			$json_rep['gender'] = $this->gender;
			$json_rep['division'] = $this->division;
			$json_rep['bunk'] = $this->bunk;
			return $json_rep;
	      }
}
?>