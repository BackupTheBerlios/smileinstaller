<?

// Ein eigener Errorhandler um die Fehler in das Template aufzunehmen
function onError ( $errno, $errstr, $errfile = false, $errline = false, $context = false )
{
	global $catchedErrors;
	switch ( $errono )
	{
		case E_NOTICE	:
		{
			$errno		= 'notice';
			break;
		}
		case E_PARSE	:
		{
			$errno		= 'parse';
			break;
		}
		case E_ERROR	:
		{
			$errno		= 'main';
			break;
		}
		default			:
		{
			$errno= 'other';
			break;
		}
	}
	// Fehlerzaehler erhoehen
	$catchedErrors['counts'][$errno]++;
	$filelen	= strlen ( $errfile );
	$newfile	= "";
	$maxlen		= 50;
	$shortfile	= substr ( $errfile, $maxlen );
	// Newlines einfuegen wenn Zeile zu lang
	if ( $filelen > $maxlen )
	{
		while ( $filelen > $maxlen )
		{
			$newfile	.= substr ( $errfile, 0, $maxlen ) . "\n";
			$errfile	= substr ( $errfile, $maxlen );
			$filelen	= strlen ( $errfile );
		}
		$newfile		.= $errfile;
		$errfile		= $newfile;
	}
	$catchedErrors[$errno][]= array ('str' => $errstr, 'shortfile' => $shortfile, 'file' => $errfile, 'line' => $errline);
}
// Entfernt alle nicht wichtigen \ aus den gesendeten Variablen
function stripPostvariables()
{
	if ( isset ( $_POST ) && is_array ( $_POST ) )
	{
		foreach ( $_POST as $key => $value )
		{
			$_POST[$key]		= stripslashes ( $_POST[$key] );
		}
	}
}

?>