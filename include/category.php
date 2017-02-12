<?php
require_once(LIB_PATH.DS."database.php");


    class Category {
        public $category;
    
        
    public static function find_photos_by_category{$category = ""}{
        global $database;
        $result_set = 
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
    
}
?>