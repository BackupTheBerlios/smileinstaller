<?

	class extensions_db extends extensions_finish
	{
		function _getTables ( $pagenum, $varnum, $dbtype, $dbhost, $dbuser, $dbpass )
		{
			$return = false;
			if ( $link = mysql_connect ( $dbhost, $dbuser, $dbpass ) )
			{
				$db_list = mysql_list_dbs($link);
				$options	= "";
				while ( $row = mysql_fetch_object ( $db_list ) ) {
					$options	.= "," . $row->Database;
				}
				$return = substr ( $options, 1 );
			}
			if ( $return == false ) $this->_setError ( $pagenum, $varnum, 'Tabellen nicht abrufbar', "Host: $dbhost, User: $dbuser" );
			return $return;
		}
		function _checkConnection ( $pagenum, $varnum, $dbtype, $dbhost, $dbuser, $dbpass )
		{
			$return = false;
			if ( $link = mysql_connect ( $dbhost, $dbuser, $dbpass ) )
			{
				$return	= true;
			}
			if ( $return == false ) $this->_setError ( $pagenum, $varnum, "Konnte nicht zur Datenbank verbinden", "Host: $dbhost, User: $dbuser" );
			return $return;
		}
		function _writesql ( $pagenum, $varnum, $dbtype, $dbhost, $dbuser, $dbpass, $dbname, $dbname_user, $tableprefix, $sqlfile )
		{
			$return		= false;
			if ( $dbname_user > "" )
			{
				$dbname		= $dbname_user;
			}
			$userquery	= implode ( "", file ( $this->config['system']['directories']['scriptdir'] . '/' . $sqlfile ) );
			eval ( "\$userquery = \"$userquery\";" );
			if ( $link = mysql_connect ( $dbhost, $dbuser, $dbpass ) )
			{
				$query		= "CREATE DATABASE IF NOT EXISTS $dbname";
				if ( mysql_query ( $query ) )
				{
					mysql_select_db ( $dbname, $link ) or die ( 'NIX' );
					if ( mysql_query ( $userquery ) )
					{
						$return		= true;
					} else {
						$this->_setError ( $pagenum, $varnum, "Userquery falsch", "$userquery" );
					}
				}
			}
			return $return;
		}
	}

?>