<?
class extensions_checks_db extends extensions_checks
{
	function _check_SQLConnection($pagenum, $varnum, $dbtype, $dbhost, $dbuser, $dbpass)
	{
		$this->_setError($pagenum, $varnum, '[no code]');
	}
	function _check_SQLDatabaseExists($pagenum, $varnum, $dbtype, $dbhost, $dbuser, $dbpass, $dbdatabase)
	{
		$this->_setError($pagenum, $varnum, '[no code]');
	}
	function _check_SQLTableExists($pagenum, $varnum, $dbtype, $dbhost, $dbuser, $dbpass, $dbdatabase, $dbtable)
	{
		$this->_setError($pagenum, $varnum, '[no code]');
	}
}
?>