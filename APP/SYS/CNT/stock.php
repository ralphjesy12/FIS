<?php

if(isset($_GET["a"])){
	require_once '../MDL/stock.php';
	$s = new Stock();
	$d = $_POST;
	switch ($_GET["a"]) {
		case 'entry':
			$s->create($d["d"],$d["q"],$d["i"],$d["s"],$d["p"]);
			session_start();
			error_log(date("Y-m-d H:i:s") . ' : [' . $_SESSION["u"] . '] ' . 'STOCK' . ' = Add Entry '.$d["d"].','.$d["q"].','.$d["i"].','.$d["s"].','.$d["p"] . "\n", 3, "data.log");
			break;
		case 'fetchList':
			$p = $d['p'];
			$r = $s->getList($p);
			if(count($r)>0){
				foreach ($r as $stk) {
					echo '<option value='.$stk["stk_id"].'>'.$stk["itm_name"].'-'.$stk["itm_desc"].'</option>';
				}
			}else{
				echo '<option value="-1"> Nothing to select...</option>';
			}
			break;
		case 'fetchList2':
			$p = $d['p'];
			$r = $s->getList($p);
			if(count($r)>0){
				echo '<option value="ALL">All Materials</option>';
				foreach ($r as $stk) {
					echo '<option value='.$stk["stk_id"].'>'.$stk["itm_name"].'-'.$stk["itm_desc"].'</option>';
				}
			}else{
				echo '<option value="-1"> Nothing to select...</option>';
			}
			break;
		case 'fetchInfo':
			$sid = $_POST["s"];
			$pid = $_POST["p"];
			$r = $s->getInfo($sid,$pid);
			if(count($r)){
				foreach ($r as $s) {
					$class = $s["rec_type"]=="RECEIVE" ? "success" : "danger";
							echo '
							<tr class="'.$class.'" data-id="'.$s['rec_id'].'" data-object='."'".json_encode($s)."'".'>
							<td>'.$s["rec_date"].'</td>';
							if($s["rec_type"]=="RECEIVE")
								echo '<td>'.$s["itm_sup"].'</td><td>'.$s["rec_rnum"].'</td><td>'.$s["itm_qty"].'</td><td>'.$s["itm_price"].'</td><td>'.($s["itm_price"]*$s["itm_qty"]).'</td><td></td><td></td><td></td><td></td><td></td><td><button class="btn-record-edit btn btn-xs btn-info"><i class="fa fa-pencil"></i></button><button class="btn-record-delete btn btn-xs btn-danger" style="margin-left:3px;"><i class="fa fa-trash-o"></i></button></td>';
							else
								echo '<td></td><td></td><td></td><td></td><td></td><td>'.$s["itm_sup"].'</td><td>'.$s["rec_rnum"].'</td><td>'.$s["itm_qty"].'</td><td>'.$s["itm_price"].'</td><td>'.($s["itm_price"]*$s["itm_qty"]).'</td><td><button class="btn-record-edit btn btn-xs btn-info"><i class="fa fa-pencil"></i></button><button class="btn-record-delete btn btn-xs btn-danger" style="margin-left:3px;"><i class="fa fa-trash-o"></i></button></td>';
							echo '
							</tr>

							';
						}
					}else{
						echo '<tr><td colspan="11" class="text-center">Nothing to display</td></tr>';
					}
			break;
		case 'fetchInfoAll':
			$pid = $_POST["p"];
			$r1 = $s->getStockList($pid);

				require_once '../MDL/Project.php';
			$p = new Project();
			$r4 = $p->getProjectInfo2($pid);
			echo '<h1>Stock Card Sheet</h1><br/><strong>Project</strong> : '.$r4["prj_name"].'<br/>
					    <strong>Location</strong> : '.$r4["prj_loc"].'<br/>
					    <strong></strong> : '.$r4["prj_desc"].'<br/><br/>';
			foreach ($r1 as $stk) {
				$r = $s->getInfo($stk["stk_id"],$pid);
				$r2 = $s->getItemInfo($stk["stk_id"]);
					echo '

					    <strong>Materials</strong> : '.$r2["itm_code"].'<br/>
					    <strong></strong> : '.$r2["itm_name"].' - '.$r2["itm_desc"].'<br/><br/>
			<table  id="i'.$stk["stk_id"].'" class="table-stock-info table table-responsive table-condensed table-bordered table-hover">
				<thead class="text-center">
				<tr><th></th><th colspan="5">Delivery</th><th colspan="5">Issuance</th></tr>
				<tr><th>Date</th><th>Supplier</th><th>RIR #</th><th>Qty</th><th>Unit Cost</th><th>Total Cost</th><th>Recipient</th><th>RIS #</th><th>Qty</th><th>Unit Cost</th><th>Total Cost</th></tr>
				</thead>
				<tbody>';
			if(count($r)){
				foreach ($r as $ss) {
					$class = $ss["rec_type"]=="RECEIVE" ? "success" : "danger";
							echo '
							<tr class="'.$class.'">
							<td>'.$ss["rec_date"].'</td>';
							if($ss["rec_type"]=="RECEIVE")
								echo '<td>'.$ss["itm_sup"].'</td><td>'.$ss["rec_rnum"].'</td><td>'.$ss["itm_qty"].'</td><td>'.$ss["itm_price"].'</td><td>'.($ss["itm_price"]*$ss["itm_qty"]).'</td><td></td><td></td><td></td><td></td><td></td>';
							else
								echo '<td></td><td></td><td></td><td></td><td></td><td>'.$ss["itm_sup"].'</td><td>'.$ss["rec_rnum"].'</td><td>'.$ss["itm_qty"].'</td><td>'.$ss["itm_price"].'</td><td>'.($ss["itm_price"]*$ss["itm_qty"]).'</td>';
							echo '</tr> ';
						}


					}else{
						echo '<tr><td colspan="11" class="text-center">Nothing to display</td></tr>';
					}
echo '</tbody> <tfoot style="font-weight:bold"> <tr><td>Total</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr> </tfoot> </table> <table id="ti'.$stk["stk_id"].'" class="table-stock-total table table-responsive table-condensed table-bordered table-hover"> <thead class="text-center"> <tr><th colspan="2">Received</th><th colspan="2">Issued</th><th colspan="2">Balance</th></tr> <tr><th>Quantity</th><th>Amount</th><th>Quantity</th><th>Amount</th><th>Quantity</th><th>Amount</th></tr> </thead> <tbody> </tbody> </table> <hr> ';
			 }
			break;
		case 'fetchInfoAllCount':
			$pid = $_POST["p"];
			$r1 = $s->getStockList($pid);
			if(count($r1)){
				require_once '../MDL/Project.php';
			$p = new Project();
			$r4 = $p->getProjectInfo2($pid);
			echo '<h1>Material Count Sheet</h1><br/><strong>Project</strong> : '.$r4["prj_name"].'<br/> <strong>Location</strong> : '.$r4["prj_loc"].'<br/> <strong></strong> : '.$r4["prj_desc"].'<br/><br/>';

			echo '<table class="table-stock-info table table-responsive table-condensed table-bordered table-hover"> <thead> <th>Code</th> <th>Name</th> <th>Desc</th> <th>Qty</th> <th>Price</th> <th>Total</th> </thead> <tbody> ';
			$tq = 0;
			$tp = 0;
			foreach ($r1 as $stk) {
				$r3 = $s->getStockCount($stk["stk_id"]);
				$r2 = $s->getItemInfo($stk["stk_id"]);
				echo '<tr>
				<td>'.$r2['itm_code'].'</td>
				<td>'.$r2['itm_name'].'</td>
				<td>'.$r2['itm_desc'].'</td>
				<td>'.$r3['stk_qty'].'</td>
				<td>'.$r2['itm_price'].'</td>
				<td>'.number_format(($r3['stk_qty'] * $r2['itm_price']), 2, '.', ',').'</td>
				</tr>';
				$tq +=  $r3['stk_qty'];
				$tp +=  ($r3['stk_qty'] * $r2['itm_price']);

			}
			echo '<tr><td></td><td></td><td></td><td></td><td></td><td></td></tr><tr><td><b>TOTAL</b></td><td></td><td></td><td><b>'.$tq.'</b></td><td></td><td><b>PHP '.number_format($tp, 2, '.', ',').'</b></td></tr></tbody></table>';
		}else{
			echo "0";
		}
			break;
		case 'fetchInfoCount':
			$pid = $_POST["p"];
			$sid = $_POST["s"];
			$r1 = $s->getStockList($pid);
			if(count($r1)){
				require_once '../MDL/Project.php';
			$p = new Project();
			$r4 = $p->getProjectInfo2($pid);
			echo '<h1>Material Count Sheet</h1><br/><strong>Project</strong> : '.$r4["prj_name"].'<br/>
					    <strong>Location</strong> : '.$r4["prj_loc"].'<br/>
					    <strong></strong> : '.$r4["prj_desc"].'<br/><br/>';

			echo '<table class="table-stock-info table table-responsive table-condensed table-bordered table-hover"> <thead> <th>Code</th> <th>Name</th> <th>Desc</th> <th>Qty</th> <th>Price</th> <th>Total</th> </thead> <tbody> '; $tq = 0;
			$tp = 0;
				$r3 = $s->getStockCount($sid);
				$r2 = $s->getItemInfo($sid);
				echo '<tr> <td>'.$r2['itm_code'].'</td> <td>'.$r2['itm_name'].'</td> <td>'.$r2['itm_desc'].'</td> <td>'.$r3['stk_qty'].'</td> <td>'.$r2['itm_price'].'</td> <td>'.number_format(($r3['stk_qty'] * $r2['itm_price']), 2, '.', ',').'</td> </tr>';
				$tq +=  $r3['stk_qty'];
				$tp +=  ($r3['stk_qty'] * $r2['itm_price']);

			echo '<tr><td></td><td></td><td></td><td></td><td></td><td></td></tr><tr><td><b>TOTAL</b></td><td></td><td></td><td><b>'.$tq.'</b></td><td></td><td><b>PHP '.number_format($tp, 2, '.', ',').'</b></td></tr></tbody></table>';
		}else{
			echo "0";
		}
			break;

		case 'fetchHeader':
			$i = $_POST["s"];
			$r = $s->getItemInfo($i);

			echo '		<strong>Project</strong> : '.$r["prj_name"].'<br/> <strong>Location</strong> : '.$r["prj_loc"].'<br/> <strong></strong> : '.$r["prj_desc"].'<br/><br/> <strong>Materials</strong> : '.$r["itm_code"].'<br/> <strong></strong> : '.$r["itm_name"].' - '.$r["itm_desc"].'<br/><br/> ';
			break;
		case 'search':
			$q = $d["d"][0]["value"];
			$ss = $d["d"][1]["value"];
			switch ($ss) {
				case 'alpha-asc':
					$o = "i.`itm_name`,i.`itm_desc`";
					$ss = "ASC";
					break;
				case 'alpha-desc':
					$o = "i.`itm_name`,i.`itm_desc`";
					$ss = "DESC";
					break;
				case 'amt-asc':
					$o = "s.`stk_qty`";
					$ss = "ASC";
					break;
				case 'amt-desc':
					$o = "s.`stk_qty`";
					$ss = "DESC";
					break;
			}

			$r = $s->stockSearch(mysql_escape_mimic($q),$o,$ss);
			foreach ($r as $rd) {
				echo '<tr><td>'.$rd["prj_name"].'</td><td>'.$rd["itm_id"].'</td><td>'.$rd["itm_name"].'-'.$rd["itm_desc"].'</td><td>'.$rd["stk_qty"].'</td><td><button class="btn btn-danger btn-xs" data-proj="'.$rd["prj_id"].'" data-item="'.$rd["stk_id"].'">View</button></td></tr>';
			}
			break;
		case 'getDates':
			$i = $_POST["s"];
			if($i=="ALL"){
				$r = $s->getRecordDates('ALL');
				$date1 = new DateTime($r[0]);
				$date2 = new DateTime($r[1]);
				echo $date1->format('m/d/Y').'|'.$date2->format('m/d/Y');
			}else{
				$r = $s->getRecordDates($i);
				$date1 = new DateTime($r[0]);
				$date2 = new DateTime($r[1]);
				echo $date1->format('m/d/Y').'|'.$date2->format('m/d/Y');
			}

			break;
		default:
			# code...
			break;
	}
}


	function mysql_escape_mimic($inp) {
	    if(is_array($inp))
	        return array_map(__METHOD__, $inp);

	    if(!empty($inp) && is_string($inp)) {
	        return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);
	    }

	    return $inp;
	}
?>
