<?php
require_once "./include/config.php";
$install		= new installer ( $configuration );
$content		= $install->go();
// $_top entfernen um Smarttemplate ein weiteres Template erstellen zu lassen
unset ( $_top );
$tpl			= new smarttemplate ( './include/templates/debug.html' );
$tpl			->assign 
(
	'var', array 
	(
		'errors'	=> $catchedErrors,
		'content'	=> $content
	)
);
$debug			= $tpl->result();
// $_top entfernen um Smarttemplate ein weiteres Template erstellen zu lassen
unset ( $_top );
// Debugtemplate in Template einfuegen sofern noetig und moeglich
if ( preg_match ( '|<body([^>]{1,})>|', $content, $result ) )
{
	$content		= str_replace
	( 
		'<body' . $result[1] . '>',
		'<body' . $result[1] . '>' . $debug,
		$content
	);
}
echo $content;
?>