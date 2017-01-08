<?php
	function connect($qry){
		include 'config.php';
		$dbc = 'mysql:host='.$host.';dbname='.$dbase.'';
		try {
		    $dbh = new PDO($dbc, $user, $password);
		    $rs = $dbh->prepare($qry);
		    $rs->execute();
		    return $rs;
		} catch (PDOException $e) {
		    echo '<hr><div class="alert alert-danger"><strong><i class="fa fa-exclamation-triangle"></i>&nbsp;Something went wrong !!!</strong><br/><br/>Contact your Database Administrator Immediately&nbsp;<abbr title="'.$e->getMessage().'"><i class="fa fa-info"></i></abbr></div>';
		    die();
		}
	}
?>