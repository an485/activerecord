<?php
		
abstract class model {
    protected $tableName;
    
	
	 public function save()
    {
        $db = dbConn::getConnection();
		if (!isset($this->id)) {
            $sql = $this->insert();
        } else {
            $sql = $this->update();
        }
        $statement = $db->prepare($sql);
        $statement->execute();
	}
	
	public function insert() {
		$array = get_object_vars($this);
		array_pop($array);
        array_shift($array);
		$columns = array_keys($array);
        $columnString = implode(', ', $columns);
        $valueString = implode(', ', $array);
		$table = $this->tableName; 
		$sql = 'INSERT INTO ' . $table .  ' (' . $columnString . ') VALUES  (' . $valueString . ')';
		echo "I just Instered a new row with the values " . $valueString . "<br>";
		return $sql;

    } 
  /*   This was a Test to get it right 
  private function update() {
        $sql = 'UPDATE ' . $this->tableName . ' SET owneremail=' . $this->owneremail . ', ownerid=' . $this->ownerid . ', duedate=' . $this->duedate . ', message='  . $this->message . ' WHERE id=' . $this->id;
      
		echo 'I just updated record ' . $this->id;
		return $sql;
    }*/
	 public function update() {
	
	    $array = get_object_vars($this);
	    array_pop($array);
        array_shift($array);
		$sql = 'UPDATE ' . $this->tableName . ' SET ';
		foreach($array as $field => $value)
			if (isset($value)) 
                $values[] = $field.' = '. $value ;
			  
		$sql .= implode(', ', $values);	
		$sql .= ' WHERE id=' . $this->id;
       
		echo 'I just updated record ' . $this->id;
		return $sql;
		
    }

    public function delete() {
		$sql = 'DELETE FROM ' . $this->tableName . ' WHERE id=' . $this->id;
		$db = dbConn::getConnection();
        $statement = $db->prepare($sql);
        $statement->execute(); 
        echo 'I just deleted record ' . $this->id .' from the ' . $this->tableName . ' table';
    }
}
class account extends model {
    public $id;
	public $email;
    public $fname;
    public $lname;
    public $phone;
    public $birthday;
    public $gender;
    public $password;
	
	
    public function __construct()
    {
        $this->tableName = 'accounts';
	
    }
}

class todo extends model {
    public $id;
    public $owneremail;
    public $ownerid;
    public $createddate;
    public $duedate;
    public $message;
    public $isdone;
	
	
    public function __construct()
    {
        $this->tableName = 'todos';
	
    }
	
}

?>
