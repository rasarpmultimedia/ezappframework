<?php
include_once"json.inc.php";
$getid  = isset($_GET["id"])?intval($_GET["id"]):null;

        $order_invoice = array();$pagination = array();
	    $order_table = $config["Tables"]["Orders"];
		$orders = $dataset->initQuery($order_table);
		$orders::$placeholder=[$auth->userid];
		$count_orders = $orders->selectCount("Order_id");
		$process = $ajaxformprocess->process;
		/*/initialize variables/*///
        //$ajaxpaginate = new AjaxPaginate($currpage,$per_page,$totalcount);
        //var_dump($process->get("pn"));
	   
		$curpage    = intval($process->get("pn"))?intval($process->get("pn")):1;
		$totalpage  = $count_orders;
		$res_per_page = 10;
		
        if(isset($curpage)){
			$paginate = new AjaxPaginate($curpage,$res_per_page,$totalpage->Totalcount);
			$sql = $dataset->initQuery($order_table);
			$order_status = "Pending";
			$sql::$placeholder = [$order_status];
			//$limit = "LIMIT ".$res_per_page." OFFSET ".$paginate->pageOffset();
			$limit =" LIMIT {$paginate->pageOffset()},{$res_per_page}";
			$results = $sql->selectAllRecords("WHERE Status=? ORDER BY Orderdate DESC {$limit}");

			if($results){
		  	  foreach($results as $res){
				  $order_invoice[] = [
					  "Orderid"	  =>$res->Order_id,
					  "Ordernum"  =>$res->Order_no,
					  "Orderdate" =>$util->formatDate($res->Orderdate,"date"),
					  "OrderDesc" =>$res->OrderDesc,
					  "eCurrency" =>$res->eCurrency,"USD_Amt"=>$res->Amount_USD,
					  "GHS_Amt"	  =>$res->Amount_GHS,"BTC_Amt"=>$res->Amount_BTC,
					  "Trans_Status" =>$res->Status,
					  "Orderby" =>$res->Orderedby,
					  "Action_Link" =>($res->Status=="Pending")?$link::buildPrettyUrl(".",".","<i class=\"fa fa-file-o\"></i> Approve",QUERY_STRING."dashboard/{$res->Order_id}/approve"):"Approved"
				  ];
			  }
			}
		 $pagination["Pagenate"] = $paginate->buildAjaxPagination();	
		}
        $order_invoice[] = $pagination;
		$data = $json->encodeJSON($order_invoice,$json->opt_as["pretty"]);
		echo $data;




