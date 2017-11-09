<?php

    class ValidateForms{
		
        protected $error_string = [];
        protected $form_fields = [];
        protected $display_errors = [];
        public    $regex = [];

        public function __construct(){


            return;
        }

        public static function checkInputField(array $form_fields,$error){
            foreach($form_fields as $fieldname){
                if(isset($_POST[$fieldname]) && empty($_POST[$fieldname])){
                    $this->error_string[$fieldname] = $error;
                }
            }
            return $this->error_string;
        }

        /* Checks to find if passwords match in two fields. */
        public function validatePassword($password,$confirmpass,$error){
            if(strcasecmp($_POST[$password], $_POST[$confirmpass]) != 0){
                $this->error_string[$confirmpass] = $error;
            }
            return $this->error_string;
        }
        //Checks for required fields length //key =>value pair
        public function checkPasswordLength(array $pass_len_array,$error){
            foreach($pass_len_array as $fieldname => $minlen){
                if(!empty($_POST[$fieldname])){
                    if(strlen(trim($_POST[$fieldname])) < $minlen){
                        $this->error_string[$fieldname] = $error;
                    }
                }
            }
            return $this->error_string;
        }

        //Check for Select Option is null;
        public function validateSelect(array $option_array){
            foreach($option_array as $option =>$selval){
                if($_POST[$option] == $selval){
                    $this->error_string[$option] = ucfirst($option)." is required";
                }
            }
            return $this->error_string;
        }
        /*  Check email fields */
        public function checkEmailAddr($emailaddr){
            if(!empty($_POST[$emailaddr]) && !preg_match( "#^[_\w-]+(\.[_\w-])*@[_\w-]+(\.[\w]+)*(\.[\w]{2,3})$#i",$_POST[$emailaddr])){
                $this->error_string[$emailaddr] ="* Invalid email address provided";
            }
            return $this->error_string;
        }


 //Checks for required fields length //key =>value pair
   public function checkFieldLength(array $required_len_array){
 	   foreach($required_len_array as $fieldname => $maxlen){
	  	  if(!empty($_POST[$fieldname]) && strlen(trim($_POST[$fieldname],"\r\n")) < 3){
	  	  $this->error_string[$fieldname] = "*".ucfirst($fieldname)." is too short";
	  	  }
	  	  if(!empty($_POST[$fieldname]) && strlen(trim($_POST[$fieldname],"\r\n")) > $maxlen){
	  	  $this->error_string[$fieldname] = "*".ucfirst($fieldname)." is too long";
	  	}
	  }
	 return $this->error_string;
  }


  //Checks for bad characters if field names
 public function check_FieldChars(array $required_array){
 	     foreach ($required_array as $fieldname) {
		  if(!empty($_POST[$fieldname]) && preg_replace("#[a-zA-Z0-9_-]#i","",$_POST[$fieldname])){
            $this->error_string[$fieldname] = "*".ucfirst($fieldname)." is not allowed";
	  	  }
	   }
	 return $this->error_string;	
 }
	  /*** Checks if file uploaded is verified */
  public function check_uploadFiletype($filetype,array $mimetype, $filename){
      //var_dump($filetype);
  	if(!array_key_exists($filetype,$mimetype)&& !empty($filename)){
	  	 $this->error_string[$this->upload_fieldname] = "".ucfirst($filename)." is not allowed,choose the correct format"; 
		}
    return $this->error_string;
  }
   /*** Checks if file uploaded is already exists */
  public function check_uploadFileExists($filelocation,$filename){
  	    if(file_exists($filelocation) && !empty($filename)){
	   	$this->error_string[$this->upload_fieldname] = "*File ".ucfirst($filename)." already exists";
	   	}
		return $this->error_string;
  }
   /*** Checks if file uploaded file size */
  public function check_uploadFileSize($filesize,$filename){
  	   if(($filesize > $_REQUEST['MAX_FILE_SIZE'] || $filesize > UploadFiles::SET_MAX_FILE_SIZE)&& !empty($filename)){
	     $this->error_string[$this->upload_fieldname] = "File ".ucfirst($filename)." is too large";
	  	}
	   return $this->error_string;
  }	

		
		
		
 /* Display Errors in a form */
 public function displayErrors(array $error_array){
	$output = "<ol class=\"errors\">";
	foreach($error_array as $error) {
	  $error = str_ireplace("_", " ", $error);
	  $output .="<li> " . $error . "</li>";
    }
	$output .="</ol>";
	return $output;
 }
  /* Display Errors in a form */
 public function displayError(array $err_array,$fieldname){	
 	if(is_array($err_array)){
 	   foreach($err_array as $key=>$value){
 	  	$err_array[$key] = str_ireplace("_", " ", $value);
 	    }
 	    if(array_key_exists($fieldname, $err_array)){
           return $err_array[$fieldname];
 	    }
	 }
   }

}?>