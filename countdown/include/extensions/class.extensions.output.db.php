<?php
class extensions_output_db extends extensions_output
{
	function _outputSQL($pagenum, $varnum, $dbtype, $dbhost, $dbuser, $dbpass, $dbname, $dbname_user, $sqlfile)
	{
		if ( $this->config['system']['debug'] >= 5 ) parent::_setError ( $pagenum, $varnum, '_outputSQL' );		$return= array ('value' => '', 'isset' => false);
		echo "Code aendern _outputSQL";
		return $return;
		if ($dbname_user > "")
		{
			$dbname= $dbname_user;
		}
		$userquery= implode("", file($this->config['system']['directories']['scriptdir'].'/'.$sqlfile));
		eval ("\$userquery = \"$userquery\";");
		if ($link= mysql_connect($dbhost, $dbuser, $dbpass))
		{
			$query= "CREATE DATABASE IF NOT EXISTS $dbname";
			if (mysql_query($query))
			{
				mysql_select_db($dbname, $link);
				if (@ mysql_query($userquery))
				{
					$return['isset']= true;
				}
			}
		}
		return $return;
	}
}
?>