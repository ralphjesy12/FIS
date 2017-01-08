<?php
if (isset($_GET['a'])) {
	$d = clean($_POST);
	require_once '../MDL/user.php';
	$u = new User();
	switch ($_GET['a']) {
		case 'signin':
			$r = $u->checkUser($d['un'],$d['pw']);
			
			if($r->rowCount()){
				$status = 'OK';
				session_start();
				session_cache_expire(2);
				$_SESSION["u"] = $d['un'];
				$_SESSION["l"] = $r->fetch()[0];
			}else{
				$status = 'FAILED';
				echo '<hr><div class="alert alert-danger"><strong><i class="fa fa-exclamation-triangle"></i>&nbsp;Authorization Error !!!</strong><br/><br/>Invalid Username or Password</div>';
			}
			error_log(date("Y-m-d H:i:s") . ' : [' . 'GUEST' . '] ' . 'LOGIN' . ' = Tried to login as '.$d["un"].','.$d["pw"].'|'.$status. "\n", 3, "data.log");
			break;
		case 'signout':
			session_start();
			error_log(date("Y-m-d H:i:s") . ' : [' . $_SESSION["u"] . '] ' . 'LOGOUT' . "\n", 3, "data.log");
			session_destroy();
			break;
		case 'update':
			session_start();
			$on = $_SESSION["u"] ;
			$r = $u->checkUser($on,$d['op']);
			if($r->rowCount()){
				$status = "OK";
				$id = $r->fetch()[1];
				$r = $u->updateUser($id,$d['un'],$d['pw']);
			}else{
				$status = "FAILED";
				echo "ip";
			}
			error_log(date("Y-m-d H:i:s") . ' : [' . $_SESSION["u"] . '] ' . 'UPDATE' . ' = Tried to update account with '.$d["un"].','.$d["pw"].'|'.$status. "\n", 3, "data.log");
			break;
		case 'getClerks':
			$r = $u->getClerks();
			if(count($r)){
				foreach ($r as $c) {
					$pass = $u->cipher('decrypt',$c["usr_pass"]);
					echo '<tr><td>'.$c["usr_name"].'</td><td>'.$pass.'</td></tr>';
				}
			}else{
				echo '<tr><td colspan="2">No clerks yet</td></tr>';
			}
			break;
		case 'addClerk':
			$val = array($d['un'],$d['pw'],"CLERK");
			$u->addUser($val);
			session_start();
			error_log(date("Y-m-d H:i:s") . ' : [' . $_SESSION["u"] . '] ' . 'ADD CLERK' . ' = '.$d["un"].','.$d["pw"]."\n", 3, "data.log");
			break;
		case 'randomCred':
			$string = array_merge(range('A','Z'),range('a','z'),range('0','9')); 
			$str = str_shuffle(implode($string)); 
			$str1 = substr($str, rand(0,26-5), 5);
			$str = str_shuffle(implode($string)); 
			srand();
			$str2 = substr($str, rand(0,26-5), 5);
			echo $str1.'|'.$str2;
		break;
	}
}
	
	function clean($p){
		$n = array();
		foreach ($p as $k=>$v) $n[$k] = mysql_escape_mimic($v);
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