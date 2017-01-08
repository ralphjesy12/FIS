<?php
	require_once '../CNF/db.php';
	class user{
		function checkUser($un,$pw){
			return connect("SELECT `usr_level`,`usr_id` FROM `users` WHERE `usr_name` = '$un' AND `usr_pass` = '".$this->cipher('encrypt',$pw)."'"); 
		}
		function addUser($val){
			$qry = "INSERT INTO `users` (`usr_name`,`usr_pass`,`usr_level`) VALUES  ('".$val[0]."','".$this->cipher('encrypt',$val[1])."','".$val[2]."')";
			$rslt = connect($qry);
			return $rslt->rowCount(); 
		}
		function updateUser($id,$nn,$np){
			return connect("UPDATE `users` SET `usr_name` = '".$nn."' , `usr_pass` = '".$this->cipher('encrypt',$np)."' WHERE `usr_id`='".$id."'");
		}
		function cipher($action, $string) {
		   $output = false;
		   $key = 'FollowYourHeart';
		   // initialization vector 
		   $iv = md5(md5($key));
		   if( $action == 'encrypt' ) {
		       $output = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, $iv);
		       $output = base64_encode($output);
		   }
		   else if( $action == 'decrypt' ){
		       $output = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, $iv);
		       $output = rtrim($output);
		   }
		   return $output;
		}
		function getClerks(){
			return connect("SELECT * FROM `users` WHERE `usr_level`='CLERK'")->fetchAll();
		}
	}
?>