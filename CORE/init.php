<?php
	require_once 'config.php';

	function mysql_escape_mimic($inp) { 
	    if(is_array($inp)) 
	        return array_map(__METHOD__, $inp); 

	    if(!empty($inp) && is_string($inp)) { 
	        return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp); 
	    } 

	    return $inp; 
	} 

	function start( $env = 'dev' ){
		environment($env);
		echo DOCTYPE."\n";
		echo '<html lang="'.LANG.'" >'."\n";
		loadHead();
		loadBody();
		echo '</html>';
	}

	function loadHead(){
		echo '<head>'."\n";
		echo '<title>'.TITLE.'</title>'."\n";
		echo '<meta charset="'.CHARSET.'">'."\n";
		//METATAGS
		foreach ($GLOBALS['META'] as $NAME => $CONTENT) echo '<meta name="'.$NAME.'" content="'.$CONTENT.'">'."\n";
		//FAVICON
		if(defined('FAVICON')) echo '<link rel="shortcut icon" href="'.IMG.FAVICON.'">'."\n";
		//STYLESHEETS
		foreach ($GLOBALS['STYLESHEET'] as $HREF) loadCSS($HREF);
		//SCRIPTS
		foreach ($GLOBALS['SCRIPT'] as $SRC) loadScript($SRC);
		echo '</head>'."\n";
	}

	function loadBody(){
		echo '<body>';
		if(file_exists(VW.'header.php')) include VW.'header.php';
		if($_SERVER['QUERY_STRING']){
			$v = VW.$_SERVER['QUERY_STRING'].'.php';
			if(file_exists($v)) include $v;
			else include VW.'404.php';
		} 
		else if(file_exists(VW.DEFA_PAGE.'.php')) include VW.DEFA_PAGE.'.php';
		else include VW.'404.php';
		if(file_exists(VW.'FOOTER.php')) include VW.'FOOTER.php';
		echo '</body>'."\n";
	}

	function environment($e){
		//INITIALIZE ENVIRONMENT
		if (isset($e))
		{
			switch ($e)
			{
				case 'dev': error_reporting(E_ALL); break;
				case 'test':
				case 'prod': error_reporting(0); break;
			}
		}
	}

	function loadCSS($HREF){
		echo '<link rel="stylesheet" href="'.CSS.$HREF.'">'."\n";
	}
	function loadScript($SRC){
		echo '<script type="text/javascript" src="'.JS.$SRC.'"></script>'."\n";
	}
?>