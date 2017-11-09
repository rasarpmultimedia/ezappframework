var app = app;
(function(){
var requestid  = RequestID;
 app.initSearch = function(){	
  var file_url, search_elem, xhr;
      xhr = app.ajax.xhr();	
	  var querystr = encodeURI("id="+requestid);
	  file_url = "_webroot/_jsondata/search.json.php?"+querystr;
	  search_elem = app._fetchElemId(document,"search_area");
	  search_elem.innerHTML = "Loading Invoice...";
	 
	 app.output =function(){
		 var data = JSON.parse(xhr.responseText);
		 //console.log(data);
		 search_elem.innerHTML = output;
	 };
	 app.ajax.$_get(file_url);
	 app.ajax.$_response(app.output);
     

 };
app.addEvent(window,"load",app.initSearch);
})();