<?

	class extensions_checks_db extends extensions_checks
	{
		function _checkConnection ( $pagenum, $varnum, $dbtype, $dbhost, $dbuser, $dbpass )
		{
			echo "$pagenum, $varnum, $dbtype, $dbhost, $dbuser, $dbpass )";
			$return = array (
				'value'		=> '',
				'isset'		=> false
			);
			if ( $link = mysql_connect ( $dbhost, $dbuser, $dbpass ) )
			{
				$return['isset']	= true;
			}
			return $return;
		}
	}

?>