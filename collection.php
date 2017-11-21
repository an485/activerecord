<?php
		
abstract class collection {
    static public function create() {
      $model = new static::$modelName;
      return $model;
    }
    static public function findAll() {
        $db = dbConn::getConnection();
        $tableName = get_called_class();
        $sql = 'SELECT * FROM ' . $tableName;
        $statement = $db->prepare($sql);
        $statement->execute();
        $class = static::$modelName;
        $statement->setFetchMode(PDO::FETCH_CLASS, $class);
        $recordsSet =  $statement->fetchAll();
        return $recordsSet;
    }
    static public function print_Table($rows) {
		$table = "<table cellpadding='6'>";
		/*$table .=  '<tr>';
		// Start a Foreach row as array to load the header row tr > th
		foreach(array_keys($rows) as $value1) 
		        { 
			   $table .= '<th class="header">' . htmlspecialchars($value1) . '</th>';
				}
         $table .= '</tr>';*/
		
		foreach ($rows as $value){			
		  $table .='<tr>';
		     foreach($value as $value2) {
                    $table .= '<td>' . htmlspecialchars($value2) . '</td>';
                  } 
			$table .= '</tr>';
		}
			$table .= '</table>';
		return $table;
		
		}
	
	static public function findOne($id) {
        $db = dbConn::getConnection();
        $tableName = get_called_class();
		$sql = 'SELECT * FROM ' . $tableName . ' WHERE id =' . $id;
        $statement = $db->prepare($sql);
        $statement->execute();
        $class = static::$modelName;
        $statement->setFetchMode(PDO::FETCH_CLASS, $class);
        $recordSet =  $statement->fetchAll();
        return $recordSet;
    }
	
		
}

class todos extends collection {
    protected static $modelName = 'todo';
}
class accounts extends collection {
    protected static $modelName = 'account';
	
	 public function __construct()
    {
       
    }
	
	//destruct and print the Html
    public function __destruct()
    {
       stringFunctions::printThis($this->html);
    }

	
}
?>
