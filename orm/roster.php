<?php


class Roster
{

	// private $id;
	// private $first;
	// private $last;
	// private $gender;
	// private $division;
	// private $bunk;

	public static function create($connection, $n) {
	
		$query = "INSERT INTO roster(name) VALUES ('$n')";

		$connection->query($query);

		if($connection === false) {
		  	trigger_error('Wrong SQL: ' . $query . ' Error: ' . $connection->error, E_USER_ERROR);
		}
		else {
			
			$new_id = $connection->insert_id;
			return new Roster($new_id, $n);

		}
	}

	public static function update($connection, $n, $rid) {
	
		$query = "UPDATE roster SET name='$n' WHERE id='$rid'";

		$connection->query($query);

		if($connection === false) {
		  	trigger_error('Wrong SQL: ' . $query . ' Error: ' . $connection->error, E_USER_ERROR);
		}
		else {
			
			return new Roster($rid,$n);

		}
	}

	public static function remove($connection, $id) {
	
		$query = "DELETE FROM roster where id='$id'";

		$connection->query($query);

		if($connection === false) {
		  	trigger_error('Wrong SQL: ' . $query . ' Error: ' . $connection->error, E_USER_ERROR);
		}
		else {
			return true;
		}
	}

	public static function grabRoster($connection, $id) {
		
		$query = "SELECT * FROM roster where id='$id'";

		$result = $connection->query($query);
		
		if ($result) {
			if ($result->num_rows == 0){
				return null;
			}
			$roster_info = $result->fetch_array();
			return new Roster(intval($roster_info['id']),
					$roster_info['name']);
		}
		return null;
	}

	public static function all($connection) {
		
		$query = "SELECT * FROM roster where 1";

		$result = $connection->query($query);
		
		$rosters = array();

		$next_row = $result->fetch_row();

		while($next_row)
		{
			$rosters[] = new Roster($next_row[0],$next_row[1]);

			$next_row = $result->fetch_row();
		}
		return $rosters;
	}	
	      
	     private function __construct($i, $n) {
			$this->id = $i;
			$this->name = $n;
	      }
	    
	      public function id() {
			return $this->id;
	      }
	    
	      public function name() {
			return $this->name;
	      }
	    
	      public function getJSON() {
			$json_rep = array();
			$json_rep['id'] = $this->id;
			$json_rep['name'] = $this->name;
			return $json_rep;
	      }
}
?>