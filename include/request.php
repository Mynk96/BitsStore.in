<?php 

require_once(LIB_PATH.DS."database.php");

class Request{
    
    protected static $table_name = "requested_products";
    protected static $db_fields = array('id','requested_user','email','requested_product','created');
    
    public $id;
    public $requested_user;
    public $email;
    public $requested_product;
    public $created;
    
    
    public static function build($requested_user,$email,$requested_product){
        if(!empty($requested_user) && !empty($requested_product)){
            $request = new Request();
            $request->requested_user = $requested_user;
            $request->email = $email;
            $request->requested_product = $requested_product;
            $request->created           = strftime("%Y-%m-%d %H:%M:%S",time());
            return $request;
            }else{
                return false;
            }
        }
    
     private static function instantiate($record) {
		// Could check that $record exists and is an array
    $object = new self;
		// Simple, long-form approach:
		// $object->id 				= $record['id'];
		// $object->username 	= $record['username'];
		// $object->password 	= $record['password'];
		// $object->first_name = $record['first_name'];
		// $object->last_name 	= $record['last_name'];
		
		// More dynamic, short-form approach:
		foreach($record as $attribute=>$value){
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
		  }
		}
		return $object;
	}
	
	private function has_attribute($attribute) {
	  // We don't care about the value, we just want to know if the key exists
	  // Will return true or false
	  return array_key_exists($attribute, $this->attributes());
	}

	protected function attributes() { 
		// return an array of attribute names and their values
	  $attributes = array();
	  foreach(self::$db_fields as $field) {
	    if(property_exists($this, $field)) {
	      $attributes[$field] = $this->$field;
	    }
	  }
	  return $attributes;
	}
	
	
	
	public function save() {
	  // A new record won't have an id yet.
	  return isset($this->id) ? $this->update() : $this->create();
	}
	
	public function create() {
		global $database;
		// Don't forget your SQL syntax and good habits:
		// - INSERT INTO table (key, key) VALUES ('value', 'value')
		// - single-quotes around all values
		// - escape all values to prevent SQL injection
		$attributes = $this->attributes();
	  $sql = "INSERT INTO ".self::$table_name." (";
		$sql .= join(", ", array_keys($attributes));
	  $sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";
	  if($database->query($sql)) {
	    $this->id = $database->insert_id();
	    return true;
	  } else {
	    return false;
	  }
	}
    public static function find_by_sql($sql = "") {
            global $database;
            $result_set = $database->query($sql);
            $object_array = array();
            while($row = $database->fetch_array($result_set)) {
                $object_array[] = self::instantiate($row);
            }
            return $object_array;
        }
    
    public function delete() {
		  global $database;
		  // Don't forget your SQL syntax and good habits:
		  // - DELETE FROM table WHERE condition LIMIT 1
		  // - escape all values to prevent SQL injection
		  // - use LIMIT 1
	       $sql = "DELETE FROM ".self::$table_name;
	       $sql .= " WHERE id=". $this->id;
	       $sql .= " LIMIT 1";
	       $database->query($sql);
	       return ($database->affected_rows() == 1) ? true : false;
        }
    
    public static function last_7_days(){
        global $database;
        $sql = "SELECT * FROM ".self::$table_name." WHERE created > DATE_SUB(CURDATE(),INTERVAL 7 DAY) GROUP BY created";
        $result = self::find_by_sql($sql);
        return $result;
    }
    
}
