<?php
//This class has file system management utilities

class FileSystem{
	//Directories
	public $Dirfilepath;
    public $Filename;
	public $Data; 
	public $Fileoutput = array();
	
	
	public function readDirectory($dirfilepath){
		$this->Dirfilepath = $dirfilepath;
		$this->Dirfilepath = opendir($this->Dirfilepath);
		while(false !== ($filename = readdir($this->Dirfilepath))){
			$this->Fileoutput[] = $filename;
		}
		 return $this->Fileoutput;
	}
	
	public function getFileparts(array $filearray,$filepart=array("filename.png")){
		foreach ($filearray as $file) {
			$fileparts = preg_split("/\./", $file);
		}
		return $filepart[0]?$fileparts[0]:$fileparts[1];
	}
	
    public function writeToFile($filename="", $data="",$flag=0){
    	  $this->Filename = $filename;
		  $this->Data = $data;
		  if(file_exists($this->Filename)){
   	      	 $handle = file_put_contents($this->Filename, $this->Data,$flag);
			 //return $handle;
   		  }else{
		    $handle = file_put_contents($this->Filename, $this->Data,$flag);
   		  	//exit("***File Error: File ".$this->Filename." do not exist.***");
   		  }
   }
	
   public function readFromFile($filename=""){
    	  $this->Filename = $filename;
		  if(file_exists($this->Filename)){
   	      	 $fread = file_get_contents($filename);
			 return $fread;
   		  }else{
   		  	exit("***File Error: File ".$this->Filename." do not exist.***");
   		  }   
    }
 
    public function readFileFromArr($filename=""){
    	 $this->Filename = $filename;
		  if(file_exists($this->Filename)){
		  	  $file = file($this->Filename);
			  foreach($file as $output_file){
			  	$this->Fileoutput[] = $output_file;
			  }
			  return $this->Fileoutput;
		  }else{
			  exit("***File Error: File ".$this->Filename." do not exist.***");
		  }
    }

}
 $makedirnfiles = new Filesystem; 
 