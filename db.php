<?php


class dbConn {

    //variable to hold connection object.
    protected static $db;

    //private construct - class cannot be instatiated externally.
		private function __construct() {
			$servername = "sql2.njit.edu";
			$username = "an485";
			$dbname = "an485";
			$password2 = "azlHvWl8h";
			$password = "X6XHCBKdK";
			$dsn = "mysql:host=$servername;dbname=$dbname";

			//Try to connect
			try {
				self::$db = new PDO($dsn, $username, $password);
				// PDO error exceptions
				self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				//echo "Connected successfully <br>";
				}
			//catch connection errors
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
				}
		}
	// get connection function. Static method - accessible without instantiation
        public static function getConnection() {

				//Guarantees single instance, if no connection object exists then create one.
        		if (!self::$db) {
					//new connection object.
            	new dbConn();
        		}

        //return connection.
        return self::$db;
    }
	
//end class dbConn	
}

?>