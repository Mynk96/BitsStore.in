<?php 
    require_once(LIB_PATH.DS."database.php");
    
    class User {
        
        protected static $table_name = "users";
        protected static $db_fields = array('id', 'Name', 'Email', 'Password', 'Hostel','Select_year','Contact_no', 'Sec_ques','Sec_ans', 'profile_pic', 'type', 'size');
        
        
        
        public $id;
        public $Name;
        public $Email;
        public $Password;
        public $Hostel;
        public $Select_year;
        public $Contact_no;
        public $Sec_ques;
        public $Sec_ans;
        public $profile_pic;
        public $type;
        public $size;
        
        protected $upload_dir = "profile_pics";
        
        //Common Database Method
        private $temp_path;
        public $errors = array();
        
        protected $upload_errors = array(
            
            UPLOAD_ERR_OK         => "No Errors.",    
            UPLOAD_ERR_INI_SIZE   => "Larger than upload_max_filesize",
            UPLOAD_ERR_FORM_SIZE  => "Larger than form MAX_FILE_SIZE",
            UPLOAD_ERR_PARTIAL    => "Partial upload",
            UPLOAD_ERR_NO_FILE    => "No file.",
            UPLOAD_ERR_NO_TMP_DIR => "No temporary directory",
            UPLOAD_ERR_CANT_WRITE => "Can't write to disk",
            UPLOAD_ERR_EXTENSION  => "File upload stopped by extension"
        );
        
        // Pass in $_FILE['uploaded_file'] as an argument.
        public function attach_file($file) {
            //Perform error checking on the form parameters.
                if(!$file || empty($file) || !is_array($file)){
                    $this->errors[] = "No file was uploaded";
                    return false;
                } elseif($file['error'] != 0){
                    $this->errors[]  = $this->upload_errors[$file['error']];
                    return false;
                } else {
            
            //set object attributes to the form parameters
                $this->temp_path = $file['tmp_name'];
                $this->filename  = basename($file['name']);
                if($file['type'] != "image/jpeg"){
                    $this->errors[] = "Invalid File type";
                    return false;    
                }else {
                $this->type = $file['type'];
                $this->size = $file['size'];
                return true;
                }
            //Don't worry about saving anything to database.
            }
        }
        public function update_photo() {
            //Make sure there are no errors.
            
            //Can't save if there are previous errors.
            if(!empty($this->errors)) {return false;}
            //Attempt to move the file
            
            //Can't save without filename & temp location.
            if(empty($this->filename) || empty($this->temp_path)){
                $this->errors[] = "the file location was not available";
                return false;
            }
            
            //Determine the target path.
            $target_path = SITE_ROOT.DS.$this->upload_dir.DS.$this->filename;
            
            //Make sure the file doesn;t already exists.
            if(file_exists($target_path)) {
                $this->errors[] = "The file {$this->filename} already exists or {$this->filename} filename already exists.Please rename & then upload.";
                return false;
            }   
            
            //Attempt to move the file.
            if(move_uploaded_file($this->temp_path,$target_path)){
                 //Success
                 //Save a corresponding entry to the database.
                    if($this->update()){
                        unset($this->temp_path);
                        return true; 
                    } 
                } else {
                //file was not moved
                $this->errors[] = "The file upload failed,possibly due to incorrect permissions to the folder";
                return false;
            }
           
            
        }
        
        public function save() {
            //Make sure there are no errors.
            
            //Can't save if there are previous errors.
            if(!empty($this->errors)) {return false;}
            //Attempt to move the file
            
            //Can't save without filename & temp location.
            if(empty($this->filename) || empty($this->temp_path)){
                $this->errors[] = "the file location was not available";
                return false;
            }
            
            //Determine the target path.
            $target_path = SITE_ROOT.DS.$this->upload_dir.DS.$this->filename;
            
            //Make sure the file doesn;t already exists.
            if(file_exists($target_path)) {
                $this->errors[] = "The file {$this->filename} already exists or {$this->filename} filename already exists.Please rename & then upload.";
                return false;
            }
            
            //Attempt to move the file.
            if(move_uploaded_file($this->temp_path,$target_path)){
                 //Success
                 //Save a corresponding entry to the database.
                    if($this->create()){
                        unset($this->temp_path);
                        return true; 
                    } 
                } else {
                //file was not moved
                $this->errors[] = "The file upload failed,possibly due to incorrect permissions to the folder";
                return false;
            }
           
            
        }
        
        
        public static function find_all(){
            global $database;
            $result_set = User::find_by_sql("SELECT * FROM users");
            return $result_set;
        }
        
        public static function find_by_id ($id=0){
            global $database;
            $result_array = User::find_by_sql("SELECT * FROM users WHERE id={$id}");
            return !empty($result_array) ? array_shift($result_array):false;
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
        
        
        private static function instantiate ($record) {
            $object = new self;
                //$object->id           = $record['id'];
                //$object->name         = $record['Name'];
                //$object->email        = $record['Email'];
                //$object->password     = $record['Password'];
                //$object->hostel       = $record['Hostel'];
                //$object->select_year  = $record['Select_year'];
                //$object->contact_no   = $record['Contact_no'];
                //return $object;
            
            foreach($record as $attribute=>$value){
                if($object->has_attribute($attribute)){
                    $object->$attribute = $value;
                }
            }
            return $object;
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
        
        
        private function has_attribute($attribute) {
            $object_vars = get_object_vars($this);
            return array_key_exists($attribute, $object_vars);  
        }
        public function create() {
        global $database;
        $sql = "INSERT INTO users (Name, Email, Password, Hostel, Select_year,Contact_no,Sec_ques,Sec_ans, profile_pic, type, size) VALUES ('$this->Name','$this->Email','$this->Password','$this->Hostel','$this->Select_year','$this->Contact_no','$this->Sec_ques','$this->Sec_ans','$this->profile_pic','$this->type','$this->size')";
        $result = $database->query($sql);
        return $result;
        print_r($result);    
        }    
    
        public static function authenticate($email = "",$password = "") {
            global $database;
            
            
            $sql = "SELECT * FROM users";
            $sql .= " WHERE Email = '{$email}'";
            $sql .= " AND Password = '{$password}'";
            $sql .= " LIMIT 1";
            
            $result_array = User::find_by_sql($sql);
            return !empty($result_array) ? array_shift($result_array):false;
        }
        
         public static function find_by_email($email=""){
            global $database;
            $result_array = User::find_by_sql("SELECT * FROM ".self::$table_name." WHERE Email="."'".$email."'");
            return !empty($result_array) ? array_shift($result_array):false;
        }    
        public static function check_email($email=""){
            global $database;
            $sql = "SELECT * FROM users WHERE Email = '".$email."'";
            $result = $database->query($sql);
            if($result->num_rows != 0){
                return true;
            }else{
                return false;
            }
        }
        
        public static function count_all() {
            global $database;
            $sql = "SELECT COUNT(*) FROM ".self::$table_name;
            $result_set = $database->query($sql);
            $row = $database->fetch_array($result_set);
            return array_shift($row);
        }
    
        
        public function update() {
            global $database;
		// Don't forget your SQL syntax and good habits:
		// - UPDATE table SET key='value', key='value' WHERE condition
		// - single-quotes around all values
		// - escape all values to prevent SQL injection
		$attributes = $this->attributes();
        $attribute_pairs = array();
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE ".self::$table_name." SET ".join(", ", $attribute_pairs). " WHERE id=". $this->id;
	    $database->query($sql);
	  return ($database->affected_rows() == 1) ? true : false;
	   }    
        
        public function check_validation($email,$sec_ques,$sec_ans){
            global $database;
            $sql = "SELECT * FROM Users WHERE Email = '".$email."' AND Sec_ques = '".$sec_ques."' AND Sec_ans = '".$sec_ans."'";
            $result = $database->query($sql);
            if($result->num_rows == 1){
                return true;
            }else{
                return false;
            }
        }
        
        public static function update_password($pwd,$email){
            global $database;
            $sql = "UPDATE users SET Password = '".$pwd."' WHERE Email = '".$email."'";
            $result = $database->query($sql);
            print_r($result);
        }
        
    
    }
    


?>