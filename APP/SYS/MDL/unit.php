<?php

require_once '../CNF/db.php';

class Unit{
	function getList(){
		return connect("SELECT * FROM `units`")->fetchAll();
	}
}
?>