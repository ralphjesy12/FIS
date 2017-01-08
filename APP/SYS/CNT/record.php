<?php
if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
ini_set('display_errors', 1);
error_reporting(E_ALL);
if(isset($_GET["a"])){
	require_once '../MDL/record.php';
	$r = new Record();
	$d = $_POST;
	switch ($_GET["a"]) {
		case 'entry':
		require_once '../MDL/stock.php';
		$s = new Stock();
		$i = $_POST["i"];
		$entry = array();
		foreach ($_POST["r"] as $e) {
			array_push($entry, array(
				$e[0],$e[1],$e[3],$e[4],$e[5],$i[1],$i[2],$i[0]
			));
			if($i[0]=="RECEIVE")
			$s->receive($e[3],$e[1],$i[1]);
			else
			$s->issue($e[3],$e[1],$i[1]);
		}
		session_start();
		error_log(date("Y-m-d H:i:s") . ' : [' . $_SESSION["u"] . '] ' . 'RECORD' . ' = Add Entry ' . "\n", 3, "data.log");
		$r->create($entry);

		break;
		case 'update':
		require_once '../MDL/stock.php';
		$s = new Stock();
		$i = $_POST["i"];
		$entry = $_POST["r"];
		$entryold = $r->get($i);
		$diff = $entry[1] - $entryold['itm_qty'];
		$r->update($i,$entry);

		if($entryold['prj_code']==$entry[5]){
			if($diff!=0){
				if($entry[7]=="RECEIVE")
				$s->receive($entry[2],$diff,$entry[5]);
				else
				$s->issue($entry[2],$diff,$entry[5]);
			}
		}else{
			if($entry[7]=="RECEIVE"){
				$s->issue($entry[2],$entryold['itm_qty'],$entryold['prj_code']);
			}
			else{
				$s->receive($entry[2],$entryold['itm_qty'],$entryold['prj_code']);
			}

			if($entry[7]=="RECEIVE"){
				$s->receive($entry[2],$entry[1],$entry[5]);
			}
			else{
				$s->issue($entry[2],$entry[1],$entry[5]);
			}
		}


		break;
		default:
		# code...
		break;
	}

}
?>
