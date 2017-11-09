<?php

class HTMLHelper{
    public static $data = array();
	public static function addElement($tag,$content=null,$extra_attr=''){
	   $tag = $content!=null?"<{$tag} {$extra_attr}>{$content}</{$tag}>":"<{$tag}/>";	    return $tag;
    }
    public static function ul(array$items,$extra_attr=''){
		$puts = "<ul {$extra_attr}>";
		foreach ($items as $item) {
		$puts .= "<li>{$item}</li>";	
		}
		$puts .= "</ul>";
		return $puts;
	}
    public static function ol(array$items,$extra_attr=''){
		$puts = "<ol {$extra_attr}>";
		foreach ($items as $item) {
		$puts .= "<li>{$item}</li>";	
		}
		$puts .= "</ol>";
		return $puts;
	}
    public static function table(array$tabledata,$attr="",$cssrule=""){
            foreach ($tabledata as $k => $value) {
			 $output = '';
               if($k==="th"){
                   $output .="<th {$cssrule}>{$value}</th>";
               }
				
				if($k==="td") {
				   $output .="<td {$cssrule}>{$value}</td>";
               }   
            }
            $table="<table $attr>".$output."</table>";
            return $table;
	}
	
    public static function hyperlink($url, $addfile, $linktext,$params='',$id=''){
         return GenerateUrl::buildLink($url, $addfile, $linktext,$params,$id);
    }
	
  public function htmlImage($src,$alt,$width,$height,$optioanl=""){
   $image = "<img src=\"{$src}\" width=\"{$width}\" height=\"{$height}\" ";
   $image .= strlen($optioanl)==0?"/>":"{$optioanl} />";
   return $image;
   }
    public static function addCSS($href,$rel="stylesheet",$media="screen"){
   	return "<link rel=\"{$rel}\" media=\"{$media}\" href=\"{$href}\" />";
   }
	
  public static function addScripts(array$srcs){
  	 //array_push($srcs);
	 $puts ="";foreach($srcs as $src){
	 $puts .=  "<script src=\"{$src}\"></script>\n";
	}
   	return $puts;
   }
	
  public function addScript($scripts,$src=''){
	  if(is_array($scripts)){
		   $puts =  "<script>\n";
			  foreach($scripts as $script){$puts .= $script."\n";}
		   $puts .= "</script>\n";
	  }else{  
		 $src  = !empty($src)?"src=\"{$src}\" ":"";
		 $puts =  "<script {$src}>{$scripts}\n</script>\n";  
	  }
	 
   	return $puts;
   }
}
$html = new HtmlHelper;
?>