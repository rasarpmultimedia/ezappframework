<?php
include_once "test_request.class.php";
class RouterError extends Error{}
class Router{
    public $id;
    protected $controller;
    protected $action;
    protected $target;
    protected $registry;
       
    public function __construct(Request $request,$registry){
        $this->id = isset($request->id)?$request->id:null;
        $this->controller = isset($request->controller)?$request->controller:null;
        $this->action = isset($request->action)?$request->action:null;
        $this->target = isset($request->target)?$request->target:null;
        $this->registry = $registry;
        
    }
    //Id
    public function getId(){
        $id = "";
        $id = (empty($this->id))?1:intval($this->id);
        return $id;      
    }
    //Controller
    public function getController(){
        $controller = "";
        if(empty($this->controller)){
         $controller = "index"; 
        }else{
         $controller = $this->controller;   
        }
        return $controller;
    }
    //Action
    public function getAction(){
        $action ="";
        if(empty($this->action)){
          $action = "index";  
        }else{
          $action = $this->action;
        }
        return $action;      
    }
    //Target
    public function getTarget($target=''){
        if(isset($target) && $target<>null){
            $this->target = $target;
        }
        return $this->target;
    }
    //Load Controller
    public function loadController($path){
     $path = $this->_getFilePath($path);
     $ctrlhandler  = (!empty($this->getController())?
                      $path."controller/".$this->getController():$path."controller/");
     $modelhandler = (!empty($this->getController())?
                $path."model/".$this->getController():$path."model/");
     
        $this->_incControllerClass($ctrlhandler);
        $this->_incModelClass($modelhandler);
        /*close
        //load controller class
        $controllerfile =  $ctrlhandler."_Controller.php";
        //var_dump($controllerfile);
        if(file_exists($controllerfile)){
         include_once $controllerfile;
        }
        //load model class
        $modelfile = $modelhandler."_Model.php";
         if(file_exists($modelfile)){
          include_once $modelfile;
         }
         */

       /*Call Controller Class and Model Class */
        $controller = $this->getController()."_Controller";
        $model = $this->getController()."_Model";
          
        $model_object = class_exists($model)?new $model($this->registry):null;
        $ctrl_object  = class_exists($controller)?new $controller($this->registry,$model_object):null;
        
        if(is_object($ctrl_object)){
               $action = $this->getAction();
               $callback_action  = is_callable(array($ctrl_object,"$action")) ;
              if($callback_action){
                  $callaction = $ctrl_object->$action();
              }else{
                  $callaction = false;
              }
             return $callaction;
            }
        
    }
     
    private function _getFilePath($path){
     try{
        if(!is_dir($path)){
          throw new RouterError("Error: Invalid file path-- {$path}");
        }
     }catch(RouterError $e){
         $output ="";
	     $output .="<div class=\"error\" >";
	     $output .="A Error Occured: ".$e->getMessage()." in ".$e->getFile()." on ".$e->getLine();
	     $output .="<br> Trace: ".$e->getTraceAsString();
	     $output .="<br> Error Code: ".$e->getCode();
	     $output .="</div>";
	     //$data = array("Title"=>"Error Page","Content"=>$output);
         //$view = new View;
         //$view->render($view,$data,"backend");
     }
        return $path;
    }
    
   private function _incModelClass($name){
      $file = $name."_Model.php";
      if(file_exists(strtolower($file))){
       include_once $file;
      }else{
       return false;
      }
    
   }
    
   private function _incControllerClass($name){
      $file = $name."_Controller.php";
      if(file_exists(strtolower($file))){
       include_once $file;
      }else{
       return false;
      }
   }

}
?>