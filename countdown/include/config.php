<?php

error_reporting(1);
error_reporting(E_PARSE+E_ERROR);
set_magic_quotes_runtime ( 0 );
////////////////////////////////////////////
// Welcher Installer soll verwendet werden?
	$configuration		= 'demoinstaller';
////////////////////////////////////////////
$rp		= str_replace ( "\\", "/", dirname ( __FILE__ ) );
$nrp	= str_replace ( '/include', '', $rp );
$nrp	= str_replace ( strrchr ( $nrp, '/' ), '', $nrp );
$dnrp	= $nrp . '/demo';


define ( 'ROOTPATH',		$nrp ); 
define ( 'DEMOROOTPATH',	$dnrp ); 
define ( 'INSTALLERPATH',			str_replace ( "\\", "/", 
	dirname ( __FILE__ ) ) . '/..' );
define ( 'SMARTTEMPLATEDIR',		str_replace ( "\\", "/", 
	dirname ( __FILE__ ) ) . '/../../smarttemplate' );
define ( 'INDEXFILE',				str_replace ( "\\", "/", 
	dirname ( __FILE__ ) ) . '/../index.php' );
$_CONFIG['smarttemplate_compiled']	= str_replace ( "\\", "/", 
	dirname ( __FILE__ ) ) . '/../tmp';
$_CONFIG['cache_lifetime']			= 1;
$catchedErrors						= array
(
	'counts' => array
	(
		'notice' => 0,
		'parse' => 0,
		'main' => 0,
		'other' => 0,
	)
);
if ( !is_dir ( "./tmp" ) )
{
	mkdir ( 'tmp', 0777 );
	chmod ( 'tmp', 0777 );
}

require_once "./include/functions.php";			

$originalEh		= set_error_handler("onError");
stripPostvariables ();

require_once "./../adodb/adodb.inc.php";
require_once "./../smarttemplate/class.smarttemplate.php";
require_once "./include/installer/class.smileinstaller.execute.php";
require_once "./include/installer/class.smileinstaller.language.php";
require_once "./include/installer/class.smileinstaller.variable.php";
require_once "./include/class.smileinstaller.php";
require_once "./include/extensions/class.extensions.all.php";
require_once "./include/extensions/class.extensions.checks._.php";
require_once "./include/extensions/class.extensions.checks.db.php";
require_once "./include/extensions/class.extensions.checks.file.php";
require_once "./include/extensions/class.extensions.checks.finish.php";
require_once "./include/extensions/class.extensions.checks.form.php";
require_once "./include/extensions/class.extensions.output._.php";
require_once "./include/extensions/class.extensions.output.db.php";
require_once "./include/extensions/class.extensions.output.file.php";
require_once "./include/extensions/class.extensions.output.finish.php";
require_once "./include/extensions/class.extensions.output.form.php";
require_once "./include/extensions/class.extensions.values._.php";
require_once "./include/extensions/class.extensions.values.db.php";
require_once "./include/extensions/class.extensions.values.file.php";
require_once "./include/extensions/class.extensions.values.finish.php";
require_once "./include/extensions/class.extensions.values.form.php";
require_once "./include/class.extensions.php";

?>