<?php
class extensions_checks_db extends extensions_checks
{
	function _check_SQLConnection ( $pagenum, $varnum, $dbtype, $dbhost, $dbuser, $dbpass, $dbname )
	{		if ( $this->config['system']['debug'] >= 0 ) parent::_setError ( $pagenum, $varnum, '_check_SQLConnection', false );		$return		= array
		(
			'value' => '',
			'isset' => false
		);
		if ( parent::_SQLConnect ( $dbtype, $dbhost, $dbuser, $dbpass, $dbname, &$conn ) )
		{
			$conn	->close ();
			$return['isset']	= true;
		}
		return $return;
	}
	function _check_SQLDatabaseExists($pagenum, $varnum, $dbtype, $dbhost, $dbuser, $dbpass, $dbdatabase)
	{
		if ( $this->config['system']['debug'] >= 5 ) parent::_setError ( $pagenum, $varnum, '_check_SQLDatabaseExists', false );
		$return		= array
		(
			'value' => '',
			'isset' => false
		);		if ( parent::_SQLConnect ( $dbtype, $dbhost, $dbuser, $dbpass, $dbdatabase, &$conn ) )
		{
			$conn	->close ();
			$return['isset']	= true;
		}
		return $return;
	}
}
?>