<?php

require_once '../CNF/db.php';

class Item{
	function isExist($c,$n,$d){
		return connect("SELECT * FROM `items` WHERE `itm_code`='$c' AND `itm_name`='$n' AND `itm_desc`='$d'")->rowCount();
	}
	function create($c,$n,$u,$p,$d){
		connect("INSERT into `items`(`itm_code`,`itm_name`,`itm_unt`,`itm_price`,`itm_desc`) VALUES ('$c','$n','$u','$p','$d')");
	}
	function getList(){
		return connect("SELECT * FROM `items`")->fetchAll();
	}
	function getPrice($i){
		return connect("SELECT `itm_price`,`itm_unt` FROM  `items` WHERE `itm_code` = '$i'")->fetch();
	}
	function update($i,$c,$n,$u,$p,$d,$o){
		connect("UPDATE `stocks` AS s , `items` AS i,`records` AS r SET i.`itm_name`='$n',i.`itm_unt`='$u',i.`itm_price`='$p',i.`itm_desc`='$d',r.`itm_code`='$c',s.`itm_id`='$c',i.`itm_code`='$c' WHERE s.`itm_id` = '$o' AND r.`itm_code`='$o' AND i.`itm_id`='$i'");
	}
	function delete($c){
		connect("DELETE FROM `stocks` WHERE `itm_id` = '$c'");
		connect("DELETE FROM `records` WHERE `itm_code`='$c' ");
		connect("DELETE FROM `items` WHERE `itm_code`='$c'");
	}
}
?>