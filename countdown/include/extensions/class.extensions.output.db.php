<?
class extensions_output_db extends extensions_checks_form
{
	function _outputSQL($pagenum, $varnum, $dbtype, $dbhost, $dbuser, $dbpass, $dbname, $dbname_user, $tableprefix, $sqlfile)
	{
		if ( $this->config['system']['debug'] >= 5 ) parent::_setError ( $pagenum, $varnum, '_outputSQL' );		$return= array ('value' => '', 'isset' => false);
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