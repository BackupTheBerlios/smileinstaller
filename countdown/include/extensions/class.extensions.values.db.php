<?
class extensions_values_db extends extensions_values
{
	function _value_SQLGetDatabases ( $pagenum, $varnum, $dbtype, $dbhost, $dbuser, $dbpass, $dbname )
	{
		if ( $this->config['system']['debug'] >= 0 ) parent::_setError ( $pagenum, $varnum, '_value_SQLGetDatabases', false );
		$return		= array
		(
			'value' => '',
			'isset' => false
		);
		if ( parent::_validateSupportedDatabase ( $dbtype ) )
		{
			$dsn	= "$dbtype://$dbuser:$dbpass@$dbhost/$dbname";
			$conn	= ADONewConnection ( $dsn );
			if ( is_object ( $conn ) )
			{
				$rs		= $conn->Execute('SHOW DATABASES');
				if ( $rs )
				{
					$rs		= $rs->getArray ();
					foreach ( $rs as $database )
					{
						$return['value'] .= "," . $database[0];
					}
					$return['value']	= substr ( $return['value'], 1 );
					$return['isset']	= true;
				}
			}
		}
		return $return;
	}
	function _value_supportedDatabases ( $pagenum, $varnum, $getOnly = false )	{		if ( $this->config['system']['debug'] >= 5 ) parent::_setError ( $pagenum, $varnum, '_value_SQLTables' );		$return		= array		(			'value'		=> $this->config['system']['supportedDatabases'],			'isset'		=> true		);
		$databases	= $this->config['system']['supportedDatabases'];
		asort ( $databases );
		if ( $getOnly )
		{
			$getOnly	= "+".$getOnly."+";
		}
		$value	= "";
		while ( $key = key ( $databases ) )
		{
			if ( $getOnly )
			{
				if ( preg_match ( '|\+' . $key . '\+|', $getOnly ) )
				{
					$value		.= ",$key:" . $databases[$key];
				}
			} else {
				$value		.= ",$key:" . $databases[$key];
			}
			next ( $databases );
		}
		$value		= substr ( $value, 1 );
		$return['value']		= $value;		return $return;	}
}
?>