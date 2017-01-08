<?php

require_once '../CNF/db.php';

class Stock{
	function receive($i,$q,$p){
		if(! $this->isStock($i,$p) ){
			connect("INSERT into `stocks` (`itm_id`, `stk_qty`,`prj_id`) values ('$i', $q,$p) ");
		}else{
			connect("UPDATE `stocks` SET `stk_qty` = `stk_qty` + $q WHERE `itm_id` = '$i' AND `prj_id` = $p ");
		}
	}
	function issue($i,$q,$p){
		if( $this->availability($i,$p) < 1 ){
			echo "Stocks Depleted";
		}else{
			connect("UPDATE `stocks` SET `stk_qty` = `stk_qty` - $q WHERE `itm_id` = '$i' AND `prj_id` = $p ");
		}
	}

	function isStock($i,$p){
		return connect("SELECT * FROM `stocks` WHERE `itm_id` = '$i'  AND `prj_id` = $p")->rowCount();
	}

	function availability($i,$p){
		return connect("SELECT `stk_qty` FROM `stocks` WHERE `itm_id` = '$i' AND `prj_id` = $p")->fetchColumn();
	}


	function getList($p){
		return connect("SELECT s.`stk_id`,p.`prj_code`,p.`prj_name`,i.`itm_name`,i.`itm_desc`,s.`stk_qty` FROM `stocks` AS s JOIN `projects` AS p ON s.`prj_id`=p.`prj_id` JOIN `items` AS i on s.`itm_id` = i.`itm_code` WHERE s.`prj_id` = '$p'")->fetchAll();
	}
	function getInfo($id,$pid){
		return connect("SELECT r.`rec_id`,r.`rec_date` , r.`itm_sup`  , r.`itm_code` , r.`rec_rnum` , r.`itm_qty` , r.`itm_price` , r.`rec_type` FROM  `stocks` AS s JOIN  `records` AS r ON r.`itm_code` = s.`itm_id` WHERE s.`stk_id` =  '$id' AND r.`prj_code` = '$pid' ORDER BY  `r`.`rec_date` ASC ")->fetchAll();
	}


	function getRecordDates($id){
		if($id=="ALL") $id="%";
		return connect("SELECT MIN(r.`rec_date`),MAX(r.`rec_date`) FROM `stocks` AS s JOIN `records` AS r ON s.`itm_id` = r.`itm_code` WHERE s.`stk_id` LIKE '$id'")->fetch();
	}
	function getItemInfo($id){
		return connect("SELECT i.`itm_code` , i.`itm_name` , i.`itm_desc` , i.`itm_price` , p . * FROM  `stocks` AS s JOIN  `items` AS i ON s.`itm_id` = i.`itm_code` JOIN  `projects` AS p ON p.`prj_id` = s.`prj_id` WHERE s.`stk_id` = $id")->fetch();
	}

	function getStockCount($id){
		return connect("SELECT s.`stk_qty` FROM  `stocks` AS s WHERE s.`stk_id` = $id")->fetch();
	}
	function stockSearch($q,$o,$s){
		return connect("SELECT s.`stk_id`,p.`prj_id`,p.`prj_code`,i.`itm_id`,p.`prj_name`,i.`itm_name`,i.`itm_desc`,s.`stk_qty` FROM `stocks` AS s JOIN `projects` AS p ON s.`prj_id`=p.`prj_id` JOIN `items` AS i on s.`itm_id` = i.`itm_code` WHERE i.`itm_name` LIKE '%$q%' OR i.`itm_desc` LIKE '%$q%' OR p.`prj_name` LIKE '%$q%' OR s.`itm_id` LIKE '%$q%' ORDER BY $o $s")->fetchAll();
	}

	function getStockList($p){
		return connect("SELECT `stk_id` FROM `stocks` WHERE `prj_id`=$p")->fetchAll();
	}

}
?>
