<?

class extensions_all extends installer
{
	function __pc_mkdir_parents($d, $umask= 0777)
	{
		$dirs= array ($d);
		$d= dirname($d);
		$last_dirname= '';
		while ($last_dirname != $d)
		{
			array_unshift($dirs, $d);
			$last_dirname= $d;
			$d= dirname($d);
		}
		foreach ($dirs as $dir)
		{
			if (!file_exists($dir))
			{
				if (!mkdir($dir, $umask))
				{
					error_log("Can't make directory: $dir");
					return false;
				}
			}
			elseif (!is_dir($dir))
			{
				error_log("$dir is not a directory");
				return false;
			}
		}
		return true;
	}
	function _validatesupporteddatabase ( $databasetype )
	{
		$return		= false;
		if ( isset ( $this->config['system']['supportedDatabases'][$databasetype] ) )
		{
			$return		= true;
		}
		return $return;
	}
	function _SQLConnect ( $dbtype, $dbhost, $dbuser, $dbpass, $dbname, &$conn )
	{
		if ( $this->config['system']['debug'] >= 0 ) parent::_setError ( $pagenum, $varnum, '_SQLConnect', false );
		$return		= false;
		if ( $this->_validateSupportedDatabase ( $dbtype ) )
		{
			$dsn	= "$dbtype://$dbuser:$dbpass@$dbhost/$dbname";
			$conn	= ADONewConnection ( $dsn );
			if ( is_object ( $conn ) )
			{
				$return		= true;
			}
		}
		return $return;
	}
}

?>