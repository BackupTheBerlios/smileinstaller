<?

	define ( 'ROOTPATH', dirname ( dirname ( __FILE__ ) . '*' ) );
	// Ziparchiv des Scripts muss den neuen Pfad enthalten!
	///////////////////////////////////////////////////////
	// Nichts quoten. Ganz schlecht!
	set_magic_quotes_runtime ( 0 );
	// Benoetigt fuer Debugging (spaeter nicht vergessen)
	// Eigene Fehlerbehandlung setzen
	$originalEh 	= set_error_handler( "onError" );
	error_reporting ( 1 ); error_reporting ( E_ALL );

	$catchedErrors	= array
	(
		'counts'		=> array
		(
			'notice'		=> 0,
			'parse'			=> 0,
			'main'			=> 0,
			'other'			=> 0,
		)
	);
	/* Faengt alle abfangbaren Fehler ab ;) */
	function onError ( $errno, $errstr, $errfile = false, $errline = false, $context = false )
	{
		global $catchedErrors;
		if ( $errno == E_NOTICE ) $errno = 'notice';
		elseif ( $errno == E_PARSE ) $errno = 'parse';
		elseif ( $errno == E_ERROR ) $errno = 'main';
		else $errno		= 'other';
		$catchedErrors['counts'][$errno]++;
		$filelen		= strlen ( $errfile );
		$newfile		= "";
		$maxlen			= 50;
		$shortfile		= substr ( $errfile, $maxlen );
		if ( $filelen > $maxlen )
		{
			while ( $filelen > $maxlen )
			{
				$newfile		.= substr ( $errfile, 0, $maxlen ) . "\n";
				$errfile		= substr ( $errfile, $maxlen );
				$filelen		= strlen ( $errfile );
			}
			$newfile		.= $errfile;
			$errfile		= $newfile;
		}
		$catchedErrors[$errno][]		= array (
			'str'		=> $errstr,
			'shortfile'	=> $shortfile,
			'file'		=> $errfile,
			'line'		=> $errline
		);
	}
	/* Erstellt das Templateverzeichniss (CVS mag keine leeren Verzeichnisse) */
	function genTemplatedir ()
	{
		if ( !is_dir ( "./tmp" ) )
		{
			mkdir ( "tmp", 0777 );
		}
	}
	/* Setzt alle noetigen Variablen fuer Smarttemplate */
	function setTemplatevariables ()
	{
		global $_CONFIG;
		$_CONFIG['smarttemplate_compiled']		= addslashes ( dirname ( __FILE__ ) ) . '/tmp';
		$_CONFIG['cache_lifetime']				= 1;
		define ( 'SMARTTEMPLATEDIR', dirname ( __FILE__ ) . '/../smarttemplate' );
		define ( 'INDEXFILE', basename ( __FILE__ ) );
	}
	/* Entfernt alles sinnlose aus den POSTs */
	function stripPostvariables ()
	{
		global $_POST;
		if ( isset ( $_POST ) && is_array ( $_POST ) )
		{
			foreach ( $_POST as $key => $value )
			{
				$_POST[$key]		= stripslashes ( $_POST[$key] );
			}
		}
	}
	/* Loescht das Templateverzeichniss (Entwicklung braucht das) */
	function removeTemplatedir ()
	{
		$dir		= dir ( "./tmp" );
		while ( $value = $dir->read () )
		{
			if ( $value != ".." && $value != "." )
			{
				@unlink ( "./tmp/$value" );
			}
		}
		$dir->close ();
	}

	require_once "./../adodb/adodb.inc.php";
	require_once "./../smarttemplate/class.smarttemplate.php";
	require_once "./include/class.configparser.php";
	require_once "./include/installer/class.smileinstaller.execute.php";
	require_once "./include/installer/class.smileinstaller.language.php";
	require_once "./include/installer/class.smileinstaller.variable.php";
	require_once "./include/class.smileinstaller.php";
	require_once "./include/extensions/class.extensions.checks._.php";
	require_once "./include/extensions/class.extensions.checks.db.php";
	require_once "./include/extensions/class.extensions.checks.file.php";
	require_once "./include/extensions/class.extensions.checks.finish.php";
	require_once "./include/extensions/class.extensions.checks.form.php";
	require_once "./include/extensions/class.extensions.values._.php";
	require_once "./include/extensions/class.extensions.values.db.php";
	require_once "./include/extensions/class.extensions.values.file.php";
	require_once "./include/extensions/class.extensions.values.finish.php";
	require_once "./include/extensions/class.extensions.values.form.php";
	require_once "./include/class.extensions.php";

	// Start
	genTemplatedir ();
	setTemplatevariables ();
	stripPostvariables ();
	$install	= new installer ( 'sample' );
	$content	= $install->go ();
	unset ( $_top );
	$tpl		= new smarttemplate ( './include/templates/debug.html' );
	$tpl		->assign
	( 'var', array
		(
			'errors'		=> $catchedErrors,
			'content'		=> $content
		)	
	);
	$debug		= $tpl->result();
	unset ( $_top );
	if ( preg_match ( '|<body([^>]{1,})>|', $content, $result ) )
	{
		$content	= str_replace
		( 
			'<body' . $result[1] . '>',
			'<body' . $result[1] . '>' . $debug,
			$content
		);
	} else {
		$content		.= 'no debug added';
	}
	removeTemplatedir ();
	
	echo $content;

?>