<?

function onError($errno, $errstr, $errfile= false, $errline= false, $context= false)
{
	global $catchedErrors;
	if ($errno == E_NOTICE)
		$errno= 'notice';
	elseif ($errno == E_PARSE) $errno= 'parse';
	elseif ($errno == E_ERROR) $errno= 'main';
	else
		$errno= 'other';
	$catchedErrors['counts'][$errno]++;
	$filelen= strlen($errfile);
	$newfile= "";
	$maxlen= 50;
	$shortfile= substr($errfile, $maxlen);
	if ($filelen > $maxlen)
	{
		while ($filelen > $maxlen)
		{
			$newfile .= substr($errfile, 0, $maxlen)."\n";
			$errfile= substr($errfile, $maxlen);
			$filelen= strlen($errfile);
		}
		$newfile .= $errfile;
		$errfile= $newfile;
	}
	$catchedErrors[$errno][]= array ('str' => $errstr, 'shortfile' => $shortfile, 'file' => $errfile, 'line' => $errline);
}
function stripPostvariables()
{
	global $_POST;
	if (isset ($_POST) && is_array($_POST))
	{
		foreach ($_POST as $key => $value)
		{
			$_POST[$key]= stripslashes($_POST[$key]);
		}
	}
}

?>