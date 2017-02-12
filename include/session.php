<?php 
    
        
Class Session {
            private $logged_in = false;
            public $user_id;
            public $Name;
            public $Email;
            private $Password;
            public $Hostel;
            public $Select_year;
            public $Contact_no;
            public $Sec_ques;
            public $Sec_ans;
            public $profile_pic;
            public $type;
            public $size;
            
            
        function __construct() {
            session_start();    
            $this->check_login();
    }
    
    
        
    
        public function login($user) {
            if($user){
                foreach($user as $attribute=>$value){
                    $this->$attribute = $_SESSION[$attribute] = $value;
                }
                $this->logged_in = true;
                
            }
        }
    
        public function logout() {
            foreach($_SESSION as $attribute => $value){
                unset($_SESSION[$attribute]);
                unset($this->$attribute);
            }
            $this->logged_in = false;
        }



        private function check_login() {
            if(isset ($_SESSION['id'])) {
                foreach($_SESSION as $attribute => $value){
                    $this->$attribute = $_SESSION[$attribute];
                }
                
                $this->logged_in = true;
            } else {
                unset($this->user_id);
                unset($this->Name);
                unset($this->Email);
                unset($this->Password);
                unset($this->Hostel);
                unset($this->Select_year);
                unset($this->Contact_no);
                unset($this->Sec_ques);
                unset($this->Sec_ans);
                unset($this->profile_pic);
                unset($this->type);
                unset($this->size);
                $this->logged_in = false;
            }
        }
        
        public function is_logged_in() {
            return $this->logged_in;
        }  
        public function update_session($user) {
            if($user){
                foreach($user as $attribute=>$value){
                    $this->$attribute = $_SESSION[$attribute] = $value;
                }
                $this->logged_in = true;
                
            }
        }
}
    $session = new Session();


?>