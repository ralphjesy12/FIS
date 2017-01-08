<?php
if(isset($_GET["a"])){
	require_once '../MDL/project.php';
	$p = new Project();

	switch ($_GET["a"]) {
		case 'create':
			$d = deSerialize($_POST["data"]);
			if(!$p->isExist($d["projCode"],$d["projName"]))
				$p->create($d["projCode"],$d["projName"],$d["projLoc"],$d["projDesc"]);
			else
		    	echo '<hr><div class="alert alert-danger"><strong><i class="fa fa-exclamation-triangle"></i>&nbsp;Project Already Exist !!!</strong><br/><br/>Please try creating a project with a different Project Code or Name</div>';
		    session_start();
			error_log(date("Y-m-d H:i:s") . ' : [' . $_SESSION["u"] . '] ' . 'PROJECT' . ' = Add Entry ' . "\n", 3, "data.log");

			break;
		case 'fetchList':
			$r = $p->getList();
			if(count($r)>0){
				$active = 'active';
				foreach ($r as $proj) {
					echo '<a class="list-group-item '.$active.'" data-project="'.$proj["prj_code"].'"><span class="badge">'.$proj["prj_code"].'</span>&nbsp;'.$proj["prj_name"].'</a>';

					$active='';
				}
			}else{
				echo '<a data-toggle="modal" href="#modal-project-create" class="list-group-item active"> No recent Projects Yet.<br> <small>Click Here to Create</small> </a>';
			}
			break;
		case 'fetchInfo':
			$pid = $_POST["p"];
			$r = $p->getProjectInfo($pid);
			$d = array( $r[0][1] , $r[0][2] , $r[0][3] , $r[0][4] ,$r[0][0] );
			echo implode("|", $d);
			break;
		case 'remove':
			$pid = $_POST["p"];
			$p->remove($pid);
			session_start();
			error_log(date("Y-m-d H:i:s") . ' : [' . $_SESSION["u"] . '] ' . 'PROJECT' . ' = Remove Entry '. $pid . "\n", 3, "data.log");
			break;
		case 'editInfo':
			$pid = $_POST["p"];
			$dat = $_POST["d"];
			$col = $_POST["c"];
			switch ($col) {
				case 'Project Code': $c = "prj_code";break;
				case 'Project Name': $c = "prj_name";break;
				case 'Project Location': $c = "prj_loc";break;
				case 'Project Description': $c = "prj_desc";break;
			}
		    session_start();
			error_log(date("Y-m-d H:i:s") . ' : [' . $_SESSION["u"] . '] ' . 'PROJECT' . ' = Edit Entry '. $pid . "\n", 3, "data.log");

			$p->editProjectInfo($pid,$dat,$c);
			break;
		case 'fetchSelect':
			$r = $p->getList();
			if(count($r)>0){
				foreach ($r as $proj) 
					echo '<option value="'.$proj["prj_id"].'">'.$proj["prj_code"].'-'.$proj["prj_name"].'</option>';
			}else{
				echo '<option value="-1">No Projects Yet</option>';
			}
			break;
		case 'projStats':
			$pid = $_POST["p"];
			$r = $p->getStats($pid);

			if(count($r)>0){
					$recordPrice = array();
			$recordQty = array();
			foreach ($r as $rs) {
				$RD = new DateTime($rs["rec_date"]);
				$thisRD = $RD->format('m-y');
				$thisType = $rs["rec_type"];
				if(!isset($recordPrice[$thisRD])){
					$recordPrice[$thisRD] = array();
					$recordPrice[$thisRD]["RECEIVE"] = array();
					$recordPrice[$thisRD]["ISSUE"] = array();
					$recordPrice[$thisRD]["BALANCE"] = array();
					
				}
				if(!isset($recordQty[$thisRD])){
					$recordQty[$thisRD] = array();
					$recordQty[$thisRD]["RECEIVE"] = array();
					$recordQty[$thisRD]["ISSUE"] = array();
				} 
				array_push($recordPrice[$thisRD][$thisType],($rs["itm_price"]*$rs["itm_qty"]));
				array_push($recordQty[$thisRD][$thisType],$rs["itm_qty"]);
			}

			$data = array();
			foreach ($recordPrice as $key => $value) {
				if(!isset($data[$key])){
					$data[$key] = array();
					$data[$key]["PR"] = 0;
					$data[$key]["PI"] = 0;
					$data[$key]["QR"] = 0;
					$data[$key]["QI"] = 0;
				}
				foreach ($value as $key2 => $val) {
					if($key2=='RECEIVE'){
						foreach ($val as $vals) {
						 $data[$key]["PR"]+=floatval($vals);
						}
					}else{
						foreach ($val as $vals) {
						 $data[$key]["PI"]+=floatval($vals);
						}
					}
				}
			}

			foreach ($recordQty as $key => $value) {
				if(!isset($data[$key])){
					$data[$key] = array();
					$data[$key]["PR"] = 0;
					$data[$key]["PI"] = 0;
					$data[$key]["QR"] = 0;
					$data[$key]["QI"] = 0;
				}
				foreach ($value as $key2 => $val) {
					if($key2=='RECEIVE'){
						foreach ($val as $vals) {
						 $data[$key]["QR"]+=floatval($vals);
						}
					}else{
						foreach ($val as $vals) {
						 $data[$key]["QI"]+=floatval($vals);
						}
					}
				}
			}

			$labels = array();
			$data1 = array();
			$data2 = array();
			$data3 = array();
			$data4 = array();
			$data5 = array();
			$data6 = array();

			$hpr = 0;
			$hpi = 0;
			$hqr = 0;
			$hqi = 0;
			$hpb = 0;
			$hqb = 0;

			$tpr = 0;
			$tpi = 0;
			$tqr = 0;
			$tqi = 0;
			$tpb = 0;
			$tqb = 0;

			$apr = 0;
			$api = 0;
			$aqr = 0;
			$api = 0;
			$aqb = array();
			$apb = array();

			$lpr = 1e27;
			$lpi = 1e27;
			$lqr = 1e27;
			$lpb = 1e27;
			$lqb = 1e27;
			$lqi = 1e27;

			$cnt = 0;

			$pb = 0;
			$qb = 0;
			foreach ($data as $key => $value) {
				$cnt++;
				$kd = DateTime::createFromFormat('m-y', $key);
				$kdd = $kd->format('M \'y');

				$pr = floatval($value["PR"]);
				$pi = floatval($value["PI"]);
				$qr = intval($value["QR"]);
				$qi = intval($value["QI"]);

				$pb = ($pb==0 && $pr!=0) ? $pr : $pb+$pr; 
				$qb = ($qb==0 && $qr!=0) ? $qr : $qb+$qr;

				$pb = ($pi!=0) ? $pb-$pi : $pb;
				$qb = ($qi!=0) ? $qb-$qi : $qb;

				array_push($labels, $kdd);

				array_push($data1, $pr);
				array_push($data2, $pi);
				array_push($data3, $qr);
				array_push($data4, $qi);
				if($pb>=0) array_push($data5, $pb);
				if($qb>=0) array_push($data6, $qb);

				$hpr = ($pr>$hpr) ? $pr : $hpr;
				$hpi = ($pi>$hpi) ? $pi : $hpi;
				$hqr = ($qr>$hqr) ? $qr : $hqr;
				$hqi = ($qi>$hqi) ? $qi : $hqi;
				$hqb = ($qb>$hqb) ? $qb : $hqb;
				$hpb = ($pb>$hpb) ? $pb : $hpb;

				$lpr = ($pr<$lpr && $pr>=0) ? $pr : $lpr;
				$lpi = ($pi<$lpi && $pi>=0) ? $pi : $lpi;
				$lqr = ($qr<$lqr && $qr>=0) ? $qr : $lqr;
				$lqi = ($qi<$lqi && $qi>=0) ? $qi : $lqi;

				$lpb = ($pb<$lpb && $pb>=0) ? $pb : $lpb;
				$lqb = ($qb<$lqb && $qb>=0) ? $qb : $lqb;

				$tpr += $pr;
				$tpi += $pi;
				$tqr += $qr;
				$tqi += $qi;
				$tpb = $pb;
				$tqb = $qb;

				array_push($apb, $pb);
				array_push($aqb, $qb);
			}

			$apr = round( $tpr / $cnt , 2 );
			$api = round( $tpi / $cnt , 2 );
			$aqr = round( $tqr / $cnt , 2 );
			$aqi = round( $tqi / $cnt , 2 );

			$qb = 0;
			$pb = 0;

			foreach ($aqb as $q) {
				$qb+=$q;
			}
			foreach ($apb as $p) {
				$pb+=$p;
			}
			$aapb = round( $pb / $cnt , 2 );
			$aaqb = round( $qb / $cnt , 2 );


			$hpr = number_format($hpr, 2, '.', ',');
			$lpr = number_format($lpr, 2, '.', ',');
			$apr = number_format($apr, 2, '.', ',');
			$tpr = number_format($tpr, 2, '.', ',');

			$hpi = number_format($hpi, 2, '.', ',');
			$lpi = number_format($lpi, 2, '.', ',');
			$api = number_format($api, 2, '.', ',');
			$tpi = number_format($tpi, 2, '.', ',');

			$hpb = number_format($hpb, 2, '.', ',');
			$lpb = number_format($lpb, 2, '.', ',');
			$aapb = number_format($aapb, 2, '.', ',');
			$tpb = number_format($tpb, 2, '.', ',');

			echo implode(',', $labels).'&'.implode(':', $data1).'|'.implode(':', $data2).'|'.implode(':', $data5).'+'.implode(':', $data3).'|'.implode(':', $data4).'|'.implode(':', $data6);
			echo '#';
			echo '
			<tr><td>Highest Peak</td><td>'.$hqr.'</td><td>PHP '.$hpr.'</td><td>'.$hqi.'</td><td>PHP '.$hpi.'</td><td>'.$hqb.'</td><td>PHP '.$hpb.'</td></tr>
			<tr><td>Lowest Peak</td><td>'.$lqr.'</td><td>PHP '.$lpr.'</td><td>'.$lqi.'</td><td>PHP '.$lpi.'</td><td>'.$lqb.'</td><td>PHP '.$lpb.'</td></tr>
			<tr><td>Monthly Average</td><td>'.$aqr.'</td><td>PHP '.$apr.'</td><td>'.$aqi.'</td><td>PHP '.$api.'</td><td>'.$aaqb.'</td><td>PHP '.$aapb.'</td></tr>
			<tr><td><b>Overall Total</b></td><td><b>'.$tqr.'</b></td><td><b>PHP '.$tpr.'</b></td><td><b>'.$tqi.'</b></td><td><b>PHP '.$tpi.'</b></td><td><b>'.$tqb.'</td><td><b>PHP '.$tpb.'</b></td></tr>
			';
		}

			break;
		case 'stats':
			$sc = $p->countStats();
			$stat = array();
			$stock = array();
			foreach ($sc as $s) array_push($stat, (int)$s[0]);
			$sc = $p->countStocks();
			array_push($stock, 'RECEIVED ('.(int)$sc[0][0].'):'.(int)$sc[0][0] );
			array_push($stock, 'ISSUED ('.(int)$sc[1][0].'):'.(int)$sc[1][0] );
			echo implode(',', $stat).'|'.implode(',',$stock);
			break;
		case 'logs':
			$f = fopen('data.log', 'r');
			$contents = fread($f, filesize('data.log'));
			fclose($f);
			echo $contents;
			break;
		default:
			# code...
			break;
	}

}
	function deSerialize($param){
		$n = array();
		foreach ($param as $p) {
				$n[$p["name"]] = mysql_escape_mimic($p["value"]);
		}
		return $n;
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