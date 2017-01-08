		<style type="text/css">
		/*@page { size: landscape; }*/
		thead th{
			text-align: center;
		}
		strong{
			width: 150px;
			display: inline-block;
		}
		.table-condensed > thead > tr > th, .table-condensed > thead > tr > td, .table-condensed > tbody > tr > th, .table-condensed > tbody > tr > td, .table-condensed > tfoot > tr > th, .table-condensed > tfoot > tr > td {
			padding: 3px;
		}

		body{
			font-size: 12px;
		}
		</style>
	
	<div class="container">
		<div class="row">
			<div class="col-xs-8"><div id="header"></div></div>
			<div class="col-xs-4" id="dates">
				<strong>From : </strong><span id="date-from"></span><br/>
				<strong>To : </strong><span id="date-to"></span><br/>
			</div>
		</div>	
			
		<div id="container" class="row" style="margin:10px 0px;">
			<table id="table-stock-info" class="table table-responsive table-condensed table-bordered table-hover">
				<thead class="text-center">
				<tr><th></th><th colspan="5">Delivery</th><th colspan="5">Issuance</th></tr>
				<tr><th>Date</th><th>Supplier</th><th>RIR #</th><th>Qty</th><th>Unit Cost</th><th>Total Cost</th><th>Recipient</th><th>RIS #</th><th>Qty</th><th>Unit Cost</th><th>Total Cost</th></tr>
				</thead>
				<tbody></tbody>
				<tfoot style="font-weight:bold">
					<tr><td>Total</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
				</tfoot>
			</table>
			<table id="table-stock-total" class="table table-responsive table-condensed table-bordered table-hover">
				<thead class="text-center">
					<tr><th colspan="2">Received</th><th colspan="2">Issued</th><th colspan="2">Balance</th></tr>
					<tr><th>Quantity</th><th>Amount</th><th>Quantity</th><th>Amount</th><th>Quantity</th><th>Amount</th></tr>
				</thead>
				<tbody>
					
				</tbody>				
			</table>
		</div>

      
	</div>
	<div class="container"><button id="btn-printer" type="button" class="btn btn-danger hidden-print"><i class="fa fa-print"> </i>&nbsp; Print This page</button> </div>

		<script type="text/javascript">
	$(document).ready(function(){

			var url = document.URL.split("?");
			var urls = url[1].split("&");
			var item = urls[0];
			var type = urls[4];
		        if (item) {
		            if(item=='ALL'){
		            	var pc = urls[3];
		            	url = (type=="stock") ? "APP/SYS/CNT/stock.php?a=fetchInfoAll" : "APP/SYS/CNT/stock.php?a=fetchInfoAllCount";
		            	$.post(url, {
		                p: pc
		            	},function(data){
		            		$("#container").html(data);
		            		

							if(type=="stock"){
$("#container").find(".table-stock-info").each(function(){
		            			var thisId = $(this).attr("id");
		            			var rqty = 0;
				                var ramt = 0;
				                var iqty = 0;
				                var iamt = 0;
				                $("#"+thisId+".table-stock-info tbody").find("tr.success").each(function() {
				                    rqty += parseFloat($(this).children("td:nth-child(4)").text());
				                    ramt += parseFloat($(this).children("td:nth-child(6)").text());
				                });
				                $("#"+thisId+".table-stock-info tbody").find("tr.danger").each(function() {
				                    iqty += parseFloat($(this).children("td:nth-child(9)").text());
				                    iamt += parseFloat($(this).children("td:nth-child(11)").text());
				                });
				                var ttl = '<tr><td>' + rqty + '</td><td>' + ramt.toFixed(2) + '</td><td>' + iqty + '</td><td>' + iamt.toFixed(2) + '</td><td>' + (rqty - iqty) + '</td><td>' + (ramt - iamt).toFixed(2) + '</td></tr>';
				                $("#"+thisId+".table-stock-info tfoot td:nth-child(4)").text(rqty);
				                $("#"+thisId+".table-stock-info tfoot td:nth-child(6)").text(ramt.toFixed(2));
				                $("#"+thisId+".table-stock-info tfoot td:nth-child(9)").text(iqty);
				                $("#"+thisId+".table-stock-info tfoot td:nth-child(11)").text(iamt.toFixed(2));
				                $("#t"+thisId+".table-stock-total tbody").html(ttl);
		            		});
							}else{
				            		var d = new Date();
			        			$("#dates").html('AS OF DATE : '+ d.toLocaleDateString());
							}
		            	}).then(function(){
                            $('head').find('title').text(type+'_record_'+ urls[1]+'_'+urls[2]);
                            
		            		if(type=="stock"){
								$("#date-from").text(urls[1]);
								$("#date-to").text(urls[2]);
								updateStock2(urls[1],urls[2]);
		            		}

		            		window.print();
		            		
		            	});
		            }else{
			            var pc = urls[3];
		            	url = (type=="stock") ? "APP/SYS/CNT/stock.php?a=fetchInfo" : "APP/SYS/CNT/stock.php?a=fetchInfoCount";
			            	$.post(url, {
			                s: item, p : pc
			            }, function(data) {
			                if(type=="stock"){
			                	var rqty = 0;
			                var ramt = 0;
			                var iqty = 0;
			                var iamt = 0;
			                $("#table-stock-info tbody").html(data);
			                $("#table-stock-info tbody").find("tr.success").each(function() {
			                    rqty += parseFloat($(this).children("td:nth-child(4)").text());
			                    ramt += parseFloat($(this).children("td:nth-child(6)").text());
			                });
			                $("#table-stock-info tbody").find("tr.danger").each(function() {
			                    iqty += parseFloat($(this).children("td:nth-child(9)").text());
			                    iamt += parseFloat($(this).children("td:nth-child(11)").text());
			                });
			                var ttl = '<tr><td>' + rqty + '</td><td>' + ramt.toFixed(2) + '</td><td>' + iqty + '</td><td>' + iamt.toFixed(2) + '</td><td>' + (rqty - iqty) + '</td><td>' + (ramt - iamt).toFixed(2) + '</td></tr>';
			                $("#table-stock-info tfoot td:nth-child(4)").text(rqty);
			                $("#table-stock-info tfoot td:nth-child(6)").text(ramt.toFixed(2));
			                $("#table-stock-info tfoot td:nth-child(9)").text(iqty);
			                $("#table-stock-info tfoot td:nth-child(11)").text(iamt.toFixed(2));
			                $("#table-stock-total tbody").html(ttl);
				            }else{

				            	$("#container").html(data);
				            		var d = new Date();
			        			$("#dates").html('AS OF DATE : '+ d.toLocaleDateString());
				            }
			            }).then(function(){
			            	$("#date-from").text(urls[1]);
			            	$("#date-to").text(urls[2]);
			            		updateStock(urls[1],urls[2]);
                                $('head').find('title').text(type+'_record_'+ urls[1]+'_'+urls[2]);
		            		if(type=="stock"){	
			            			$.post("APP/SYS/CNT/stock.php?a=fetchHeader",{ s : item },function(data){
			        				$("#header").html(data);
				        			}).then(function(){
				        				window.print();
				        			});
			        		}else{
			        		
			        			window.print();
			        			
			        		}
			        			
			            });
		            }
		        }


		        $("#btn-printer").click(function(){
		        	window.print();
		        });
		});

		function updateStock(d1,d2) {
        var start = new Date(d1);
        var end = new Date(d2);
        var thisDate = new Date();


        var rqty = 0;
        var ramt = 0;
        var iqty = 0;
        var iamt = 0;
        
        $("#table-stock-info tbody tr").each(function() {
            thisDate = new Date($(this).children("td:nth-child(1)").text());
            thisDate = new Date(thisDate.toLocaleDateString());
            if ((start > thisDate) || (thisDate > end)) 
            	$(this).remove();
            else{
            	if ($(this).hasClass('success')) {
                    rqty += parseFloat($(this).children("td:nth-child(4)").text());
                    ramt += parseFloat($(this).children("td:nth-child(6)").text());
                }

                if ($(this).hasClass('danger')) {
                    iqty += parseFloat($(this).children("td:nth-child(9)").text());
                    iamt += parseFloat($(this).children("td:nth-child(11)").text());
                }
            }
        });

        
        var ttl = '<tr><td>' + rqty + '</td><td>' + ramt + '</td><td>' + iqty + '</td><td>' + iamt + '</td><td>' + (rqty - iqty) + '</td><td>' + (ramt - iamt).toFixed(2) + '</td></tr>';
        $("#table-stock-info tfoot td:nth-child(4)").text(rqty);
        $("#table-stock-info tfoot td:nth-child(6)").text(ramt.toFixed(2));
        $("#table-stock-info tfoot td:nth-child(9)").text(iqty);
        $("#table-stock-info tfoot td:nth-child(11)").text(iamt.toFixed(2));
        $("#table-stock-total tbody").html(ttl);
    }


		function updateStock2(d1,d2) {
        var start = new Date(d1);
        var end = new Date(d2);
        var thisDate = new Date();
$("#container").find(".table-stock-info").each(function(){
	var thisId = $(this).attr("id");
	 var rqty = 0;
        var ramt = 0;
        var iqty = 0;
        var iamt = 0;
        
        $("#"+thisId+".table-stock-info tbody tr").each(function() {
            thisDate = new Date($(this).children("td:nth-child(1)").text());
            thisDate = new Date(thisDate.toLocaleDateString());
            if ((start > thisDate) || (thisDate > end)) 
            	$(this).remove();
            else{
            	if ($(this).hasClass('success')) {
                    rqty += parseFloat($(this).children("td:nth-child(4)").text());
                    ramt += parseFloat($(this).children("td:nth-child(6)").text());
                }

                if ($(this).hasClass('danger')) {
                    iqty += parseFloat($(this).children("td:nth-child(9)").text());
                    iamt += parseFloat($(this).children("td:nth-child(11)").text());
                }
            }
        });

        
        var ttl = '<tr><td>' + rqty + '</td><td>' + ramt + '</td><td>' + iqty + '</td><td>' + iamt + '</td><td>' + (rqty - iqty) + '</td><td>' + (ramt - iamt).toFixed(2) + '</td></tr>';
        $("#"+thisId+".table-stock-info tfoot td:nth-child(4)").text(rqty);
        $("#"+thisId+".table-stock-info tfoot td:nth-child(6)").text(ramt.toFixed(2));
        $("#"+thisId+".table-stock-info tfoot td:nth-child(9)").text(iqty);
        $("#"+thisId+".table-stock-info tfoot td:nth-child(11)").text(iamt.toFixed(2));
        $("#t"+thisId+".table-stock-total tbody").html(ttl);
});

    }

		</script>




       