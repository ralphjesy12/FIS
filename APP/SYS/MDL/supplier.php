<?php

require_once '../CNF/db.php';

class Supplier{
	function getList(){
		return connect("SELECT DISTINCT(`sup_name`) FROM `stocks`")->fetchAll();
	}
}
?>