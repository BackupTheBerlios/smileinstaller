<?
class extensions_checks_db extends extensions_checks
{
	function _check_SQLConnection($pagenum, $varnum, $dbtype, $dbhost, $dbuser, $dbpass)
	{
		if ( $this->config['system']['debug'] >= 5 ) parent::_setError ( $pagenum, $varnum, '_check_SQLConnection' );		$this->_setError($pagenum, $varnum, '[no code]');
	}
	function _check_SQLDatabaseExists($pagenum, $varnum, $dbtype, $dbhost, $dbuser, $dbpass, $dbdatabase)
	{
		if ( $this->config['system']['debug'] >= 5 ) parent::_setError ( $pagenum, $varnum, '_check_SQLDatabaseExists' );		$this->_setError($pagenum, $varnum, '[no code]');
	}
	function _check_SQLTableExists($pagenum, $varnum, $dbtype, $dbhost, $dbuser, $dbpass, $dbdatabase, $dbtable)
	{
		if ( $this->config['system']['debug'] >= 5 ) parent::_setError ( $pagenum, $varnum, '_check_SQLTableExists' );		$this->_setError($pagenum, $varnum, '[no code]');
	}
}
?>