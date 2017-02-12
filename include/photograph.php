<?php
    require_once(LIB_PATH.DS."database.php");
    
    class Photograph {
        
        protected static $table_name = "photographs";
        protected static $db_fields = array('id', 'filename', 'type', 'size', 'product_name','product_price', 'category', 'product_details', 'Email');
        
        public $id;
        public $filename;
        public $type;
        public $size;
        public $product_name;
        public $product_price;
        public $category;
        public $product_details;
        public $Email;
        private $temp_path;
        protected $upload_dir="images";
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
                
                if($file['type'] != "image/jpeg"){
                    $this->errors[] = "Invalid File type";
                    return false;    
                } else {
                    $this->filename = str_replace( " ","_",$_FILES['file_upload']['name']);
                    $this->type = $file['type'];
                    $this->size = $file['size'];
                    $this->temp_path = "images/content/".$this->filename;
                        
                            

                                
                return true;
                    }
            //Don't worry about saving anything to database.
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
            
            
            //Make sure the file doesn;t already exists.
            $target_path = SITE_ROOT.DS.$this->upload_dir.DS.$this->filename;
            $final_target = SITE_ROOT.DS.$this->upload_dir.DS.$this->filename;
            if(file_exists($final_target)) {
                $this->errors[] = "The file {$this->filename} already exists or {$this->filename} filename already exists.Please rename & then upload.";
                return false;
            }
            
            //Attempt to move the file.
            $target_path = SITE_ROOT.DS.$this->upload_dir.DS.$this->filename;
            $final_target = SITE_ROOT.DS.$this->upload_dir.DS.$this->filename;
            if(move_uploaded_file($target_path,$final_target)){
                 //Success
                 //Save a corresponding entry to the database.
                    echo "hello";
                    if($this->create()){
                        unset($this->target_path);
                        return true; 
                    } 
                } else {
                //file was not moved
                $this->errors[] = "The file upload failed,possibly due to incorrect permissions to the folder";
                return false;
            }
           
            
        }
        
        
        //Common Database Methods
        public static function find_all(){
            global $database;
            $result_set = self::find_by_sql("SELECT * FROM ".self::$table_name);
            return $result_set;
        }
        
        public static function find_by_id ($id=0){
            global $database;
            $result_array = self::find_by_sql("SELECT * FROM ".self::$table_name."  WHERE id={$id}");
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
        
        private function has_attribute($attribute) {
            $object_vars = $this->attributes();
            return array_key_exists($attribute, $object_vars);  
        }
        
        
        protected function attributes(){
            $attributes = array();
            foreach(self::$db_fields as $field){
                if(property_exists($this, $field)){
                    $attributes[$field] = $this->$field;
                }
            }
            return $attributes;
        }
        
        public static function find_by_email ($email = ""){
            global $database;
            $result_array = self::find_by_sql("SELECT * FROM ".self::$table_name."  WHERE Email = '".$email."'");
            return $result_array;
        }
        
        public function create() {
        global $database;
        $attributes = $this->attributes();
        $sql = "INSERT INTO `photographs` (filename, type, size, product_name, product_price, category, product_details, Email) VALUES ('$this->filename', '$this->type', '$this->size', '$this->product_name', '$this->product_price', '$this->category', '$this->product_details', '$this->Email')";
        //$sql = "INSERT INTO ".self::$table_name." (".join(", ", array_keys($attributes)).") VALUES ('".join("', '", array_values($attributes))."')";
            if($database->query($sql)){
                return true;
            }else{
                return false;
            }
        }    
        
        public static function find_photo_by_category($category=""){
            global $database;
            $result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE category = '".$category."'");
            return $result_array;
        }
        
        public static function find_photo_by_product_name($name=""){
            global $database;
            $result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE product_name LIKE '".$name."%'");
            return $result_array;
        }
        
        
        public static function count_all() {
            global $database;
            $sql = "SELECT COUNT(*) FROM ".self::$table_name;
            $result_set = $database->query($sql);
            $row = $database->fetch_array($result_set);
            return array_shift($row);
        }
        
        public static function count_all_with_category($category) {
            global $database;
            $sql = "SELECT COUNT(*) FROM ".self::$table_name."  WHERE category = '".$category."'";
            $result_set = $database->query($sql);
            $row = $database->fetch_array($result_set);
            return array_shift($row);
        }
        
         public static function count_all_with_search($name="") {
            global $database;
            $sql = "SELECT COUNT(*) FROM ".self::$table_name."  WHERE product_name LIKE '".$name."%'";
            $result_set = $database->query($sql);
            $row = $database->fetch_array($result_set);
            return array_shift($row);
        }
        public function destroy() {
		// First remove the database entry
		if($this->delete()) {
			// then remove the file
		  // Note that even though the database entry is gone, this object 
			// is still around (which lets us use $this->image_path()).
			$target_path = SITE_ROOT.DS.'images'.DS.'content'.$this->filename;
			$target_path2 = SITE_ROOT.DS.'images'.DS.'thumb'.$this->filename;
			return unlink($target_path) ? true : false;
			return unlink($target_path2) ? true : false;
		} else {
			// database delete failed
			return false;
		      }
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
        
        function thumbnail( $img, $source, $dest, $maxw, $maxh ) {      
            $jpg = $source.$img;

        if( $jpg ) {
            list( $width, $height  ) = getimagesize( $jpg ); //$type will return the type of the image
            $source = imagecreatefromjpeg( $jpg );

        if( $maxw >= $width && $maxh >= $height ) {
            $ratio = 1;
        }elseif( $width > $height ) {
            $ratio = $maxw / $width;
        }else {
            $ratio = $maxh / $height;
        }

        $thumb_width = round( $width * $ratio ); //get the smaller value from cal # floor()
        $thumb_height = round( $height * $ratio );

        $thumb = imagecreatetruecolor( $thumb_width, $thumb_height );
        imagecopyresampled( $thumb, $source, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height );

        $path = $dest.$img;
        if(!empty($this->errors)) {return false;}
            //Attempt to move the file
            
            //Can't save without filename & temp location.
            if(empty($this->filename) || empty($this->temp_path)){
                $this->errors[] = "the file location was not available";
                return false;
            }
            
            //Determine the target path.
            
            
        
           
            
            //Attempt to move the file
            
        if(imagejpeg( $thumb, $path, 75 )){
            echo "hello";
                    if($this->create()){
                        imagedestroy( $thumb );
                        imagedestroy( $source );
                        unset($this->target_path);
                        return true; 
                    } 
            }else{
                $this->errors[] = "The file upload failed,possibly due to incorrect permissions to the folder";
                return false;
            }
            }
        }
    
}

?>