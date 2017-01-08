<?php
if(isset($_GET["a"])){
	require_once '../MDL/unit.php';
	$u = new Unit();

	switch ($_GET["a"]) {
		case 'fetchSelect':
			$r = $u->getList();
			if(count($r)>0){
				foreach ($r as $unit) 
					echo '<option value="'.$unit["unt_id"].'">'.$unit["unt_name"].' ('.$unit["unt_sym"].')</option>';
			}else{
				echo '<option value="-">-</option>';
			}
			break;
		default:
			# code...
			break;
	}

}
?>