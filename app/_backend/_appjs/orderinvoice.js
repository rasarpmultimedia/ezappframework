var app = app;
(function(){
var customerid = CustomerID;
var requestid  = RequestID;
 app.initOrderInvoice = function(){	
  var file_url, order_elem, xhr;
      xhr = app.ajax.xhr();	
	  var querystr = encodeURI("id="+requestid);
	  file_url = "_webroot/_jsondata/order.invoice.json.php?"+querystr;
	  order_elem = app._fetchElemId(document,"order_invoice_table");
	  order_elem.innerHTML = "Loading Invoice...";
	 
	 app.output =function(){
		 var data = JSON.parse(xhr.responseText);
		  var output ="<p>Customer ID: "+customerid+"</p><table class=\"table table-bordered invoice\">";
	   for(var i in data){
		  if(data.hasOwnProperty(i)){
			  output +="<tr><td><h4>Your Order#: "+data[i].Ordernum+"</h4></td><td colspan=\"2\" style=\"padding-left:20em\">"+data[i].Action_Link+"</td></tr>";
			  
			  if(data[i].Order_Type=="sales"){
				output +="<thead><tr><th>Order Details</th><th>Values</th></tr></thead>";
				output +="<tr><td>Order Date</td><td>"+data[i].Orderdate+"</td></tr><tr><td>e-Currency You Sold</td><td>"+data[i].eCurrency+"</td></tr><tr><td>USD Amount We Pay</td><td>"+data[i].USD_Amt+"</td></tr><tr><td>GHS Amount We Pay</td><td>"+data[i].GHS_Amt+"</td></tr><tr><td>BTC Amount You Sold</td><td>"+data[i].BTC_Amt+"</td></tr><tr><td>Transaction Status</td><td>"+data[i].Trans_Status+"</td></tr><tr><td>Order Notes</td><td>"+data[i].Order_Desc+"</td></tr><tr><td>Payment Status</td><td>"+data[i].Payment_Status+"</td></tr><tr><td>Payment Method</td><td>"+data[i].Payment_Method+"</td></tr><tr><td>Payment Details</td><td>"+data[i].Payment_Details+"</td></tr></tbody>";
				  
			  }else if(data[i].Order_Type=="purchase"){
				 /*
				output +="<tr><td><h4>Your Order#: "+data[i].Ordernum+"</h4></td><td colspan=\"2\" style=\"margin-right:50px\">"+data[i].Action_Link+"</td></tr>";*/
				output +="<thead><tr><th>Order Details</th><th>Values</th></tr></thead>";
				output +="<tbody><tr><td>Order Date</td><td>"+data[i].Orderdate+"</td></tr><tr><td>e-Currency You Bought</td><td>"+data[i].eCurrency+"</td></tr><tr><td>USD Amount You Pay</td><td>"+data[i].USD_Amt+"</td></tr><tr><td>GHS Amount You Pay</td><td>"+data[i].GHS_Amt+"</td></tr><tr><td>BTC Amount You Bought</td><td>"+data[i].BTC_Amt+"</td></tr><tr><td>Transaction Status</td><td>"+data[i].Trans_Status+"</td></tr><tr><td>Order Notes</td><td>"+data[i].Order_Desc+"</td></tr><tr><td>Payment Status</td><td>"+data[i].Payment_Status+"</td></tr><tr><td>Payment Method</td><td>"+data[i].Payment_Method+"</td></tr><tr><td>Payment Details</td><td>"+data[i].Payment_Details+"</td></tr></tbody>" 
				  //more work here
			  }
		  }
	  }
		 
		output +="</table>";
		order_elem.innerHTML =output;
	 };
	 app.ajax.$_get(file_url);
	 app.ajax.$_response(app.output);
     

 };
app.addEvent(window,"load",app.initOrderInvoice);
})();