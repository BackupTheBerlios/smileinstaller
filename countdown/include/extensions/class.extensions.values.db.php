<?
class extensions_values_db extends extensions_values
{
	function _value_SQLTables($pagenum, $varnum, $dbtype, $dbhost, $dbuser, $dbpass)
	{
		if ( $this->config['system']['debug'] >= 5 ) parent::_setError ( $pagenum, $varnum, '_value_SQLTables' );		$return= array ('value' => '', 'isset' => false);
		if ($link= mysql_connect($dbhost, $dbuser, $dbpass))
		{
			$db_list= mysql_list_dbs($link);
			$options= "";
			while ($row= mysql_fetch_object($db_list))
			{
				$options .= ",".$row->Database;
			}
			$return= array ('value' => substr($options, 1), 'isset' => true);
		}
		return $return;
	}
	function _value_SQLDetect($pagenum, $varnum)
	{
		if ( $this->config['system']['debug'] >= 5 ) parent::_setError ( $pagenum, $varnum, '_value_SQLDetect' );		$this->_setError('0', '_value_SQLDetect', '[no code]');
	}	function _value_supportedDatabases ( $pagenum, $varnum )	{		if ( $this->config['system']['debug'] >= 5 ) parent::_setError ( $pagenum, $varnum, '_value_SQLTables' );		$return		= array		(			'value'		=> $this->config['system']['supportedDatabases'],			'isset'		=> true		);		return $return;	}
}
?>