<?php

class Pagination{
	private $current_page;
	private $per_page;
	private $page_range;
	public  $mid_range = 6;
	private $start_range;
	private $end_range;
	
	private $totalcount;
	private $urlpath;
	protected $req;
	private $link;
        
    
	public function __construct($currpage,$per_page,$totalcount){
		   $this->current_page =(int)$currpage;
		   $this->per_page 	   =(int)$per_page;
		   $this->totalcount   =(int)$totalcount;
		   $this->urlpath = ".";//filter_var($_SERVER['PHP_SELF']); 
		   $this->page_range = $this->pageRange();
           $this->link = new Generateurl;
           $this->req  = Dispatcher::getRequest();
		
		//var_dump($this->current_page);
	}
	public function pageOffset(){
	 //show eg page 1 = 1-1*10 = 0 offset and so on limit 0,10 offset=0,limit=10,
	 $offset = ($this->current_page-1)*$this->per_page;
	 return $offset;
	}
	private function totalPages(){
		return ceil($this->totalcount/$this->per_page);
	}
	private function previousPage(){
		return $this->current_page - 1;
	}
	private function nextPage(){
		return $this->current_page + 1;
	}
	private function hasPreviousPage(){
	 return  $this->previousPage() >= 1 ? true : false;	
	}
	private function hasNextPage(){
	 return  $this->nextPage() <= $this->totalPages() ? true : false;
	}
	private function pageRange(){
		$this->start_range = $this->current_page - floor($this->mid_range/2); 
		$this->end_range   = $this->current_page + floor($this->mid_range/2);
			if($this->start_range <= 0 ){
				$this->start_range = 1;
		    	$this->end_range += abs($this->start_range)+1;
			}elseif($this->end_range > $this->totalPages()){
			    $this->start_range -= $this->end_range-$this->totalPages();
		        $this->end_range   = $this->totalPages();
			}
			return range($this->start_range,$this->end_range);
	} 

// Buliding Pagination links
public function currentOfTotalPages(){
	return "<p class =\"curr_of_totalpages\">Page: {$this->current_page} of {$this->totalPages()}</p>";
}
    
public function getPageNum(){
  return isset($_GET["pgnum"])?intval($_GET["pgnum"]):1;
}
    
protected function addPageParams($pagenum){
	$controller=$this->req->controller?$this->req->controller."/":null;
	$action=$this->req->action?$this->req->action."/":null;
	$targets = $this->req->target?"/".$this->req->target:null;
	return QUERY_STRING."{$controller}{$action}{$pagenum}{$targets}";
}
//$makeurl = GenerateUrl::buildLink("Go somewhere",$_SERVER["PHP_SELF"],"Go to sirenghana.com","pagename,action,id,target");

//Pretty Pagenation
    
public function buildPagination(){
	
	if($this->totalPages() >= 1 || $this->totalPages() >= 10){ 
		$list = "<div class=\"pagination\"><ol>"; 
		$list .="<li>";	
		if($this->hasPreviousPage()){ 
			$list .="<span class=\"enabled\">".$this->link->buildLink("{$this->urlpath}",".","&laquo; Prev ",",{$this->addPageParams($this->previousPage())}")."</span>";	
		}else {
			$list.="<span class =\"disabled\">&laquo; Prev </span>"; 
		}
		
		for($i=1; $i <= $this->totalPages(); $i++) {
			if($this->page_range[0] > 2 && $i == $this->page_range[0]) $list .= "<span>...</span>";
			if($i==1 || $i==$this->totalPages()||in_array($i, $this->page_range)){
				if($i != $this->current_page){ 
				  $list .="<span class=\"enabled\">".$this->link->buildLink("{$this->urlpath}",".", "{$i}","{$this->addPageParams($i)}")."</span>"; 
				  }else{ $list .="<span class=\"disabled\">{$i}</span>"; }  
				 }
		if($this->page_range[$this->mid_range-1] <= $this->totalPages()-1 
		   && $i == $this->page_range[$this->mid_range-1]){$list .= "<span>...</span>";}
			}
		//var_dump($this->page_range[$this->mid_range-1]);
		
	   if($this->hasNextPage()){
		   $list .= "<span class=\"enabled\">".$this->link->buildLink("{$this->urlpath}",".", " Next &raquo;","{$this->addPageParams($this->nextPage())}")."</span>";
	   }else{
		   $list .= "<span class=\"disabled\"> Next &raquo;</span>"; 
	   }
		   $list .= "</li>";
	   $list .= "<ol></div>"; return $list;
	   }
  }
    
    
}
