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
			return $return;
		}
		function _checkConnection ( $pagenum, $varnum, $dbtype, $dbhost, $dbuser, $dbpass )
		{
			$return = false;
			if ( $link = mysql_connect ( $dbhost, $dbuser, $dbpass ) )
			{
				$return	= true;
			}
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
						$this->config['system']['errormessage']		.= "Userquery falsch\n$userquery\n";
					}
				}
			}
			return $return;
		}
	}

?>