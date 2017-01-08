<?php

if(isset($_GET["a"])){
	require_once '../MDL/supplier.php';
	$s = new Supplier();
	$d = $_POST;
	switch ($_GET["a"]) {
		case 'fetchSelect':
			$r = $s->getList();
			if(count($r)>0){
				$suppliers = '';
				foreach ($r as $supplier) 
					$suppliers.='|'.$supplier['sup_name'];
			}
			break;
		default:
			# code...
			break;
	}

}

?>