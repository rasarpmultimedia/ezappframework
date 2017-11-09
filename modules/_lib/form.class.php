<?php
/*
 * Class Create Html Form from a class */
class Form{
	 //form attributes
	 private $htmlForm;
	 private $formName;
	 private $action;
	 private $method;
	 protected $inputName;
	 private   $extra_attr;
	 
	 protected $formInputs = []; 
	 protected $groupFormInputs = [];
	 private   $addhtml =[];
	 public $selOptions =[];
     public $dataListOptions = [];
	 
	 public function __construct($name="",$action="",$method="get",$extra_attr=""){
		$this->formName = $name;
		$this->action  = $action;
		$this->method  = $method;
		$this->extra_attr = $extra_attr;
	 }
	 public function startForm(){
	 	$this->htmlForm = "<form action=\"{$this->action}\" name=\"{$this->formName}\" id=\"{$this->formName}\" method=\"{$this->method}\" {$this->extra_attr}> \n";
		return $this->htmlForm;
	 }
    
	 public function inputLabel($for,$name){
	    return"<label for=\"$for\">$name</label>";
	 }
    
	 public function addFormElem($element){
         return $this->setFormField(null,$element);
     }
    
     public  function inputField($type,$name,$value='',$optional_attr='',$jserror=false){
		$jserror =($jserror==false)?"":"<div id=\"{$name}_error\"></div>";
        return"<input type=\"{$type}\" name=\"{$name}\" id=\"{$name}\" value=\"{$value}\" $optional_attr>{$jserror}";
	 }
	
     public  function uploadField($id,$name,$optional_attr='',$jserror=false){
		$jserror =($jserror==false)?"":"<div id=\"{$name}_error\"></div>";
        return"<input type=\"file\" name=\"{$name}\" id=\"{$id}\" $optional_attr>{$jserror}";
	 }
	
     public function textAreaField($name,$value='',$rows='',$cols='',$optional_attr='',
								   $jserror=false){
		$jserror =($jserror==false)?"":"<div id=\"{$name}_error\"></div>";
		$extra_arr = (strlen($rows)>0||strlen($cols)>0)?"rows =\"$rows\" cols=\"$cols\"":"";
		return "<textarea name=\"$name\" id=\"$name\" $extra_arr $optional_attr>$value</textarea>{$jserror}";
	 }
	/*Select Options*/
     public function selectOptions($name,array $options,$postback_field,$optional_attr='',
								   $jserror=false){ 
		    $jserror =($jserror==false)?"":"<div id=\"{$name}_error\"></div>";
            $output = "<select name=\"{$name}\" id=\"{$name}\" $optional_attr >  \n";
            foreach($options as $key=>$option){
              $output .= ($key == $postback_field)?"<option value=\"{$key}\" selected =\"selected\">{$option}</option>":"<option value=\"{$key}\">{$option}</option> \n";                     
             }      
            $output .="</select>{$jserror}"; return $output;
	 }

	 public function dataList($name,array $options){
	    $output = "<datalist id=\"{$name}\">  \n";
	 	foreach($options as $option){
	 	$output .= "<option label=\"{$option}\" value=\"{$option}\" />";
		}
	    $output .="</datalist>\n"; return $output;
	 }
    
	 public function radioButton($label,$name,$value='',$checked=false,
								 $inline_style="display:inline",$jserror=false){ 
	   $jserror =($jserror==false)?"":"<div id=\"{$name}_error\"></div>";
	   $checked = ($checked==true)?"checked=\"checked\"":"";
	   return "<span style=\"{$inline_style}\"><label><input type=\"radio\" name=\"{$name}\" value=\"{$value}\" $checked /> ".ucfirst("{$label}")."</label></span>{$jserror}";
	 }
	
	 public function checkBox($label,$name,$value='',$checked=false,
							  $inline_style="display:block", $jserror=false){
	   $jserror =($jserror==false)?"":"<div id=\"{$name}_error\"></div>";
	   $checked = ($checked==true)?"checked=\"checked\"":"";
	   return "<span style=\"{$inline_style}\"><label><input type=\"checkbox\" name=\"{$name}\" value=\"{$value}\" $checked /> ".ucfirst("{$label}")."</label></span>{$jserror}";
	 }
	
	public function checkedBoxValue($check_name,$value){
          if($_POST && $value!=null){
			 $name = $check_name;
			 preg_match("/^[a-z_-]+/",$name,$name_matches);
			 if(isset($_POST[$name_matches[0]])){
                 return in_array($value,$_POST[$name_matches[0]])?true:false;
			 }
		  }
	  }
	
	public function checkedRadioValue($check_name,$value,$postbackval=''){
        if(isset($_POST[$check_name])){
         return $this->process->post($check_name)=="$value"?true:false;
        }else{
         return $this->process->post($check_name,$postbackval)=="$value"?true:false;
        }
    }
	
	public function setFormField($label='',$field='',$error=''){
	 	if($label<>null){
	 	$this->formInputs[$label] = (strlen($error)>0)?[$field,$error]:[$field];
		}else{
		$this->formInputs[] = (strlen($error)>0)?[$field,$error]:[$field];
		}
		return $this->formInputs;
	 }
	
	 public function groupFormFields($grouplable,$label,$field,$error){
        return array_merge($this->groupFormInputs,array($grouplable=>$this->setFormField($label,$field,$error))); 
	 }
	 public function endForm(){
	 	return $this->htmlForm = "\n</form> ";
	 }

	 //End of form elements
	 /*This Method Displays the form on the screen with specified format
	  * Left Labling, 
	  * Top Labling,
	  * Form Grouping,
	  * Upload Labling,
	  * Login Labling,
	  * Bootscrap Labling
	  * */

	
	public function customFormCollections(){
		$formcollections = array();
		$formInputs = $this->formInputs;
		//var_dump($formInputs);
		foreach($formInputs as $label=>$data){
			 $label = (!is_numeric($label)?$label:$label);
			 $input = array_key_exists(0, $data)?$data[0]:$data[0]; 
			 $error = (array_key_exists(1, $data))?$data[1]:null;
			 $formcollections[$label] = ["input"=>$input,"error"=>$error];
		}
		return $formcollections;
	}
	
	public function wrapField($formelem,$element="div",$attr=""){
		if($element<>null){
		 $tag = "<{$element} {$attr}>{$formelem}</{$element}>";	
		}else{$tag="";}
		return $tag;
	}
	
	protected function createCustomForm(&$layout){ 
		return $this->startForm().$layout.$this->endForm();
	}
	
	public function displayCustomForm($layout){
		return $this->createCustomForm($layout);
	}
	
	public function DisplayForm($layout,$message=""){
		 $message = strlen($message)>0?$message:$message;
		 switch($layout){ 
			//Normal formating 
			 case"Left_Labling":
				 $output ="<div class=\"formwrapper\">";
				 $output .= $message; 
				 $output  .=$this->startForm();
				 foreach($this->formInputs as $label =>$data){
					 $label = (!is_numeric($label)?$label:null);
				     $input = array_key_exists(0, $data)?$data[0]:$data[0]; 
				 	 $error = (array_key_exists(1, $data))?$data[1]:null;
				 $output .= $message;
				 $output .=($label<>null)?"<div class=\"inputfield label-left\">{$label}{$input} \n":"<div class=\"inputfield label-left\">{$input} \n";
				 $output .=(strlen($error)>0)?"<p class=\"error\">{$error}</p></div>\n":"</div>";	 
				 }
				 $output .=$this->endForm()."</div>\n";
				  return $output;
			 break;
                    
			 case"Top_Labling":
				 /*display form */
				 $output ="<div class=\"formwrapper\">";
				 $output .= "<p class=\"message\">{$message}</p>";  
				 $output .= $this->startForm();
				 foreach($this->formInputs as $label=>$data){
                  $label = (!is_numeric($label)?$label:null);
				  $input = array_key_exists(0, $data)?$data[0]:$data[0]; 
				  $error = array_key_exists(1, $data)?$data[1]:null;
				  $output .=($label<>null)?"<div class=\"inputfield label-top\">{$label}<br/>{$input} \n":"<div class=\"inputfield label-top\">{$input} \n";
				  $output .=(strlen($error)>0)?"\n <p class=\"error\">{$error}</p></div> ":"</div> \n";
				 }
				 $output .=$this->endForm();
				 $output .="</div>";
				 return $output;
			break;
            
            case"Form_Grouping":
				$output ="<div class=\"formwrapper\">";
				 $output .= $message; 
				 $output .=$this->startForm();
				 foreach($this->groupFormInputs as $fieldset=>$formInputs){
					 $output .="<div class=\"app-form\">";
					 if($fieldset){
						 foreach($formInputs as $label =>$data){
							$label = (!is_numeric($label)?$label:null);
							$input = array_key_exists(0, $data)?$data[0]:$data[0]; 
							$error = (array_key_exists(1, $data))?$data[1]:null;
							$output .= $message;
							$output .=($label<>null)?"<div class=\"app-form\">{$label}{$input} \n":"<div class=\"app-form\">{$input} \n";
							$output .=(strlen($error)>0)?"<p class=\"error\">{$error}</p></div>\n":"</div>";
						 }
						 
					 }
				  
                    $output .="</div>";	
				 }
                    $output .=$this->endForm()."</div>\n";
				  return $output;
			 break;
                    
			case"Upload_Labling":
				  //puts 
				$output ="<div id=\"uploadwrapper\">";
				  $output .=$this->startForm();
				 foreach($this->formInputs as $label =>$data){
                    $label = (!is_numeric($label)?$label:null);
				    $input = array_key_exists(0, $data)?$data[0]:$data[0]; 
				 	$error = (array_key_exists(1, $data))?$data[1]:null;
				 $output .= $message;
				 $output .=($label<>null)?"<div class=\"upload\">{$label}{$input} \n":"<div class=\"app-form\">{$input}\n";
				 $output .=(strlen($error)>0)?"<p class=\"error\">{$error}</p></div>\n":"</div>";	 
				 }
				 $output .=$this->endForm()."</div>";
				  return $output;
			break;
                    
			case "Login_Labling":
				 /*Display Login form */
				 $output ="<div id=\"loginWrapper\">";
				 $output .= "<p class=\"message\">{$message}</p>";  
				 $output .= $this->startForm();
				 foreach($this->formInputs as $label=>$data){
                  $label = (!is_numeric($label)?$label:null);
				  $input = array_key_exists(0, $data)?$data[0]:$data[0]; 
				  $error = array_key_exists(1, $data)?$data[1]:null;
				  $output .=($label<>null)?"<p class=\"inputfield label-top\">{$label}<br/>{$input} \n":"<p class=\"inputfield label-top\">{$input} \n";
				  $output .=(strlen($error)>0)?"\n <p class=\"error\">{$error}</p></p> ":"</p> \n";
				 }
				 $output .=$this->endForm();
				 $output .="</div>";
				 return $output;
				break;
                    
			default:
			 return null;
			break;
	 	    }
	 }

}

/**
 *@Method Form Validation Class
 */
class FormValidator{
 private $field_errors= array();
 public  $upload_fieldname;
//Checks for required empty fields
 public function check_requiredFields(array$required_array){
 	     foreach ($required_array as $fieldname) {
		    if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])){
	  	    $this->field_errors[$fieldname] = "".ucfirst($fieldname)." is required";
	  	  }
	   }
	 return $this->field_errors;
 }
 //Checks for bad characters if field names
 public function check_invalidChars(array $required_array,$regex="#[a-zA-Z- ]#i"){
 	     foreach ($required_array as $fieldname) {
             if(!empty($_POST[$fieldname]) &&
                preg_replace($regex,"",$_POST[$fieldname])){
            $this->field_errors[$fieldname] = "Invalid character in ".ucfirst($fieldname)." is not allowed";
	  	  }
	   }
	 return $this->field_errors;	
 }
 //Checks for required fields length //key =>value pair
   public function check_FieldLength(array $required_len_array){
 	   foreach($required_len_array as $fieldname => $maxlen){
	  	  if(!empty($_POST[$fieldname]) && strlen(trim($_POST[$fieldname],"\r\n")) < 3){
	  	  $this->field_errors[$fieldname] = "".ucfirst($fieldname)." is too short";
	  	  }
	  	  if(!empty($_POST[$fieldname]) && strlen(trim($_POST[$fieldname],"\r\n")) > $maxlen){
	  	  $this->field_errors[$fieldname] = "".ucfirst($fieldname)." is too long";
	  	}
	  }
	 return $this->field_errors;
  }
  //Check for Select Option is null;
  public function check_selectField(array $option_array){
  	 foreach($option_array as $option =>$selval){
  	 	 if(isset($_POST[$option])&&$_POST[$option] == $selval){
  	 	 	$this->field_errors[$option] = "".ucfirst($option)." is required";
  	 	 }
  	}
	 return $this->field_errors;
  }
  /*  Check email fields */
  public function check_EmailAddr($emailaddr){
  	if(!empty($_POST[$emailaddr]) && !preg_match( "#^[_\w-]+(\.[_\w-])*@[_\w-]+(\.[\w]+)*(\.[\w]{2,3})$#i",$_POST[$emailaddr])){
		$this->field_errors[$emailaddr] ="Invalid email address provided";
	}
	return $this->field_errors;
  }
  /*** Checks if file uploaded is verified */
  public function check_uploadFiletype($filetype,array $mimetype, $filename){
      //var_dump($filetype);
  	if(!array_key_exists($filetype,$mimetype)&& !empty($filename)){
	  	 $this->field_errors[$this->upload_fieldname] = "".ucfirst($filename)." is not allowed,choose the correct format"; 
		}
    return $this->field_errors;
  }
   /*** Checks if file uploaded is already exists */
  public function check_uploadFileExists($filelocation,$filename){
  	    if(file_exists($filelocation) && !empty($filename)){
	   	$this->field_errors[$this->upload_fieldname] = "*File ".ucfirst($filename)." already exists";
	   	}
		return $this->field_errors;
  }
   /*** Checks if file uploaded file size */
  public function check_uploadFileSize($filesize,$filename){
  	   if(($filesize > $_REQUEST['MAX_FILE_SIZE'] || $filesize > UploadFiles::SET_MAX_FILE_SIZE)&& !empty($filename)){
	     $this->field_errors[$this->upload_fieldname] = "File ".ucfirst($filename)." is too large";
	  	}
	   return $this->field_errors;
  }
  /* Checks to find if passwords match in two fields. */
 public function check_PasswordFields($password,$confirmpass){
	    $pass = isset($_POST[$password])?$_POST[$password]:null;
	    $cpass = isset($_POST[$confirmpass])?$_POST[$confirmpass]:null;
 	    if(strcasecmp($pass,$cpass) != 0){
		$this->field_errors[$confirmpass] ="Password entered did not match"; 
		}
   return $this->field_errors;
  }
  //Checks for required fields length //key =>value pair
   public function check_PasswordLength(array $pass_len_array){
 	   foreach($pass_len_array as $fieldname => $minlen){
	  	if(!empty($_POST[$fieldname])){
         if(strlen(trim($_POST[$fieldname])) < $minlen){
             $this->field_errors[$fieldname] = "Password is too short must be at least {$minlen} characters";
              }  
	  	  }
	  }
	 return $this->field_errors;
  }
    
  //Checks for bad characters if field names
 public function check_UsernameChars(array $required_array){
 	     foreach ($required_array as $fieldname) {
		  if(!empty($_POST[$fieldname]) && preg_replace("#[a-zA-Z0-9_-]#i","",$_POST[$fieldname])){
            $this->field_errors[$fieldname] = "".ucfirst($fieldname)." is not allowed";
	  	  }
	   }
	 return $this->field_errors;	
 }
 /* Checks dates by formates in dd/mm/yyyy */
 public function checkFormDate($dateformat='09/10/2013'){
 	$regex ="~^[0-9]{2}\\/[0-9]{2}\\/[0-9]{4}|[0-9]{2}\-[0-9]{2}\-[0-9]{4}$~";
     if(!empty($_POST[$dateformat]) && !preg_match($regex, $_POST[$dateformat])){
     	$this->field_errors[$dateformat] ="* Invalid date format,must be dd/mm/yyyy";
      }
	 return $this->field_errors;
 }

public function check_Digit($fieldname){
 	    //$fieldname = ($fieldname=="phone")?"/[0-9-?]/":"/[0-9]/";
 		if(!empty($_POST[$fieldname]) && !preg_match('/^[\d\.?]+$/i',$_POST[$fieldname])){
		$this->field_errors[$fieldname]= "{$fieldname} must be digits";
		}
	return $this->field_errors;
 }
	
 public function check_Radio_n_CheckBox($items_array,$checkeditem){
 	 //put validation rules
 }
 /* Display Errors in a form */
 public function displayErrors(array $error_array){
	if(count($error_array)>0){
		$output = "<ol class=\"errors\">";
		foreach($error_array as $error) {
			$error = str_ireplace("_", " ", $error);
	  		$output .="<li> " . $error . "</li>";
    	}
		$output .="</ol>";
		return $output;
	}else{ return "";} 
 }
  /* Display Errors in a form */
 public function displayErrorField(array $err_array,$fieldname){	
 	if(is_array($err_array)){
 	   foreach($err_array as $key=>$value){
 	  	$err_array[$key] = str_ireplace("_", " ", $value);
 	    }
 	    if(array_key_exists($fieldname, $err_array)){
           return $err_array[$fieldname];
 	    }
	 }
   }
 }
?>

