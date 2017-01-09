<?php

require_once '../CNF/db.php';

class Record{
	function create($entry){
		$sql = 'INSERT INTO `firedepot`.`records` (`rec_rnum`, `itm_qty`, `itm_code`, `itm_sup`, `itm_price`, `prj_code`, `rec_date`, `rec_type`) VALUES ';
		$values = array();
		foreach ($entry as $e) {
			$e = array_map(function($s){
				return '"'.$s.'"';
			}, $e);
			array_push($values, '('.implode(",",$e).')');
		}
		$sql .= implode(",", $values);

		connect($sql);
	}

	function get($id){
		$sql = 'SELECT * FROM `firedepot`.`records` WHERE `rec_id` = "'.$id.'" LIMIT 1';
		return connect($sql)->fetch();
	}

	function delete($id){
		$sql = 'DELETE FROM `firedepot`.`records` WHERE `rec_id` = "'.$id.'" LIMIT 1';
		return connect($sql);
	}

	function update($i,$entry){
		$sql = 'UPDATE `firedepot`.`records` SET
		`itm_qty` = "'.$entry[1].'",
		`itm_code` = "'.$entry[2].'",
		`itm_sup` = "'.$entry[3].'",
		`itm_price` = "'.$entry[4].'",
		`prj_code` = "'.$entry[5].'",
		`rec_date` = "'.$entry[6].'",
		`rec_type` = "'.$entry[7].'"
		WHERE
		`rec_rnum` = "'.$entry[0].'" LIMIT 1 ';
		connect($sql);

	}
}
?>
