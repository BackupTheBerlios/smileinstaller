<?

	class extensions_values_db extends extensions_values
	{
		function _getTables ( $pagenum, $varnum, $dbtype, $dbhost, $dbuser, $dbpass )
		{
			$return = array (
				'value'		=> '',
				'isset'		=> false
			);
			if ( $link = mysql_connect ( $dbhost, $dbuser, $dbpass ) )
			{
				$db_list = mysql_list_dbs($link);
				$options	= "";
				while ( $row = mysql_fetch_object ( $db_list ) ) {
					$options	.= "," . $row->Database;
				}
				$return		= array (
					'value'		=> substr ( $options, 1 ),
					'isset'		=> true
				);
			}
			return $return;
		}
		function _writesql ( $pagenum, $varnum, $dbtype, $dbhost, $dbuser, $dbpass, $dbname, $dbname_user, $tableprefix, $sqlfile )
		{
			$return		= array (
				'value'		=> '',
				'isset'		=> false
			);
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
					mysql_select_db ( $dbname, $link );
					if ( @mysql_query ( $userquery ) )
					{
						$return['isset']		= true;
					}
				}
			}
			return $return;
		}
	}

?>