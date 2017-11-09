/**
* This software was developed by Rasarp Multimedia Inc
* @Framework: ezappframework
* @Author :  Sarpong Abdul-Rahman Dugbatey
* @Version : v1.1
* @Licence : GPL v3.0
* Release Date: 01-12-2016
**/
var ezAPPFW = {}; 
var app = ezAPPFW;
app = app||window.app;
(function() { var doc;
if(!doc){doc = document||window;}
/* Document Objects Helper Methods */
app._$ = {};
app._$.$ = function (callback_fn){//defualt obj constructor
	 if(callback_fn==undefined || callback_fn==null){
		 callback_fn = this;
	 }
	 return callback_fn;
}

app._fetchElemId = function (doc,id){
     return doc.getElementById(id);
};
app._fetchElemTagName = function (doc,tagName){
     return doc.getElementsByTagName (tagName);
};
/** FORM API **/
app._$.FORMAPI = { 
	validateform : {},
	field : function(id){ return app._fetchElemId(document,id) },
	upload_data : new FormData,
	formval : null,
	escapeval : function(val){return encodeURIComponent(val)},
	forms:document.forms
};
/* Document Objects Helper Methods Ends */	
/** Ajax Starts **/
app.ajax = {type:"",entype:"",url:"",data:""};//App Ajax Object
var xhreq = null; 
app.ajax.xhr = function(){
    if(window.XMLHttpRequest){
        xhreq = new XMLHttpRequest;
    }else{
        xhreq = new ActiveXObject("Microsoft.XMLHTTP");
    }
    return xhreq;
};
xhreq = app.ajax.xhr();
//Ajax Pagination
app.ajax.paginate = {
	current_pgnum:1,
	results_perpage:10,
	totalPages:20,
	loadAjaxPage : function(pagenum){}
};
//Ajax Event Handler
app.ajax.$_response = function(output_fn){
    xhreq.onreadystatechange = function(){
        if(xhreq.readyState==4 && xhreq.status==200){
          output_fn();  
        } 
    };  
};
/* Ajax Get */
app.ajax.$_get = function(url){
	app.ajax.url = url!=null?url:app.ajax.url;
    xhreq.open("GET",app.ajax.url,true);
    xhreq.send(null);   
    return true;
};
/* Ajax Post */
app.ajax.$_post = function(url,data){
	app.ajax.url = url!=null?url:app.ajax.url;
	app.ajax.data = data!=null?data:app.ajax.data;
    xhreq.open("POST",app.ajax.url,true);
	xhreq.setRequestHeader("Content-type",app.ajax.entype);
    xhreq.send(app.ajax.data);
    return true;
};

/**
obj = {url:"",response:"",type:"",data:"",entype:""}
app.ajax.$_submit(obj);
**/
app.ajax.$_submit=function(obj){
	obj.response = (obj.response=="undefined"?null:obj.response);
	if(obj.type=="GET"){
		xhreq.open(obj.type,obj.url,true);
      	xhreq.send(null);	
	}else if(obj.type=="POST"){
		xhreq.open(obj.type,obj.url,true);
		xhreq.setRequestHeader("Content-type", obj.entype);
		xhreq.send(obj.data);
	}
	return true;
}
/** Ajax Ends **/
/** Event Handler **/
app.addEvent = function(doc,type,handler){
	if(!doc){doc = document;}
    if(doc.addEventListener){
       doc.addEventListener(type,handler,false); 
    }else if(doc.attachEvent){
       doc.attachEvent("on"+type,handler);
    }
};
	
app.eventHandler = function(e){
	e = (e==null)?this:e;
	var e = e || window.event;
    var target = e.target || e.srcElement;
	return target;
};
/** Form Validation Rules **/

var doc = document;
//Single Line Text Field
	app._$.FORMAPI.validateform.isValid = false;
	app._$.FORMAPI.validateform.textField = function(id,errormsg){
	 var field = app._fetchElemId(doc,id);
	 var error = app._fetchElemId(doc,id+"_error");
	 	 field = (field!=null)?field:"";error = (error!=null)?error:"";
	 var pattern = /[a-z ]/i;
		if(field.value == ""){
		 return error.innerHTML = errormsg;
		}else if(!pattern.test(field.value)){
		app._$.FORMAPI.validateform.isValid = false;
		return error.innerHTML = "Invalid "+field.value+ ", is not allowed";
		}else{
		app._$.FORMAPI.validateform.isValid = true;
		return error.innerHTML = "";
		}
		return false;
	};		 
	app._$.FORMAPI.validateform.digit = function(id,errormsg){
	 var field = app._fetchElemId(doc,id);
	 var error = app._fetchElemId(doc,id+"_error");
	 	 field = (field!=null)?field:"";error = (error!=null)?error:"";
	 var pattern = /^\d+$/i;
		if(field.value == ""){
		  app._$.FORMAPI.validateform.isValid = false;
		  return error.innerHTML = errormsg;
		}else if(!pattern.test(field.value)){
		 app._$.FORMAPI.validateform.isValid = false;
		 return error.innerHTML = "Invalid digit "+field.value+", is not allowed";
		}else{
		 app._$.FORMAPI.validateform.isValid = true;
		 return error.innerHTML = "";	
		}
		return false;
	};
	app._$.FORMAPI.validateform.currency = function(id,errormsg){
	 var field = app._fetchElemId(doc,id);
	 var error = app._fetchElemId(doc,id+"_error");
	 	 field = (field!=null)?field:"";error = (error!=null)?error:"";
	 	var pattern = /^[0-9]*(\.[0-9]+)?$/;
		
		if(field.value == ""){
		 app._$.FORMAPI.validateform.isValid = false;	
		 return error.innerHTML = errormsg;
		}else if(!pattern.test(field.value)){
		 app._$.FORMAPI.validateform.isValid = false;
		 return error.innerHTML = "Invalid currency "+field.value+", is not allowed";
		}else{
		 app._$.FORMAPI.validateform.isValid = true;
		 return error.innerHTML = "";	
		}
		return false;
	};
	//Text Area Field or Multi Line Text
	app._$.FORMAPI.validateform.textAreaField = function(id,errormsg){
	 var field = app._fetchElemId(doc,id);
	 var error = app._fetchElemId(doc,id+"_error");
		 field = (field!=null)?field:"";error = (error!=null)?error:"";
	 var pattern = /^.+$/i;
		if(field.value == ""){
		 app._$.FORMAPI.validateform.isValid = false;
		 return error.innerHTML = errormsg;
		}else if(!pattern.test(field.value)){
		 app._$.FORMAPI.validateform.isValid = false;
		 return error.innerHTML = "Invalid "+field.value+ ", is not allowed";
		}else{
		 app._$.FORMAPI.validateform.isValid = true;
		 return error.innerHTML = "";
		}
		return false;
	};
	//Email
	app._$.FORMAPI.validateform.emailField = function(id,errormsg){
	 var field = app._fetchElemId(doc,id);
	 var error = app._fetchElemId(doc,id+"_error");
		 field = (field!=null)?field:"";error = (error!=null)?error:"";
	 var pattern = /^[\w!#$%&'*+/=?`{|}~^-]+(?:\.[\w!#$%&'*+/=?`{|}~^-]+)*@(?:[A-Z0-9-]+\.)+[A-Z]{2,6}$/i;
		if(field.value == ""){
		 app._$.FORMAPI.validateform.isValid = false;
		 return error.innerHTML = errormsg;
		}else if(!pattern.test(field.value)){
		 app._$.FORMAPI.validateform.isValid = false;
		 return error.innerHTML = "Invalid "+field.value+ ", is not an email address";	
		}else{
		 app._$.FORMAPI.validateform.isValid = false;
		 return error.innerHTML = "";	
		}
		return false;
	};
 //Password
 app._$.FORMAPI.validateform.passwordField = function(id,errormsg){
	 var field = app._fetchElemId(doc,id);
	 var error = app._fetchElemId(doc,id+"_error");
	 	 field = (field!=null)?field:"";error = (error!=null)?error:"";
	 var pattern = /^\w+$/i;
		if(field.value == ""){
		 app._$.FORMAPI.validateform.isValid = false;
		 return error.innerHTML = errormsg;
		}else if(!pattern.test(field.value)){
		 app._$.FORMAPI.validateform.isValid = false;
		 return error.innerHTML = "Invalid "+field.value+", is not allowed";
		}else{
		 app._$.FORMAPI.validateform.isValid = false;
		 return error.innerHTML = "";
		}
		return false;
	};
 app._$.FORMAPI.validateform.passwordMatchField = function(matchval,id,errormsg){
	 var field = app._fetchElemId(doc,id);
	 var error = app._fetchElemId(doc,id+"_error");
	 	 field = (field!=null)?field:"";error = (error!=null)?error:"";
	 var pattern = /matchval/i;
		if(!pattern.test(field.value)){
		 app._$.FORMAPI.validateform.isValid = false;
		 return error.innerHTML = errormsg;
		}else{			
		app._$.FORMAPI.validateform.isValid = false;
		return error.innerHTML = "";
		}
	 return false;
	};
	
})();

/** ezAppFrameWork Application **/