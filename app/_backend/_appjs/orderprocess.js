var app = app;
(function(){
 var customerid = CustomerID;
	//console.log(customerid);
  app.initOrderProcess = function(){ 
	  var file_url, order_elem, xhr;
      xhr = app.ajax.xhr();	
	   file_url = "../_backend/_jsondata/orderprocess.json.php";
	   order_elem = app._fetchElemId(document,"orders_table_list");
	  if(order_elem!=null){order_elem.innerHTML="Loading Orders... Please Wait";}   
	 
 
  app.ajax.paginate.loadAjaxPage=function(pn){
		 app.output = function(){
		   var output ="";
		   var data = JSON.parse(xhr.responseText);
			//console.log(xhr.responseText);
		   output = "<table id=\"order_process_data\" class=\"table table-hover\"><tr><p>Customer ID: "+customerid+"</p></tr><tr><th>Order#</th><th>Date</th><th>Description</th><th>eCurrency</th><th>Amount USD</th><th>Amount GHS</th><th>Amount BTC</th><th>Status</th><th>Action</th></tr>";
		   //console.log(data);
		   for(var i in data){
			   if(data.hasOwnProperty(i)){
				   if(!data[i].Pagenate){
					output += "<tr><td>"+data[i].Ordernum+"</td><td>"+data[i].Orderdate+"</td><td>"+data[i].OrderDesc+"</td><td>"+data[i].eCurrency+"</td><td>"+data[i].USD_Amt+"</td><td>"+data[i].GHS_Amt+"</td><td>"+data[i].BTC_Amt+"</td><td>"+data[i].Trans_Status+"</td><td>"+data[i].Action_Link+"</td></tr>";
				   }
			  }
		   var pagenate = data[i].Pagenate;
		   }
		   output += "</table>";
		   output += "<div class=\"pagination\">"+pagenate+"</div>";
		   if(order_elem!=null){order_elem.innerHTML = output;}
	   };
	 app.ajax.$_get(file_url+"?pn="+pn);
	 app.ajax.$_response(app.output);
  };
  app.ajax.paginate.loadAjaxPage(1); 
  }
  app.addEvent(window,"load",app.initOrderProcess);
})();