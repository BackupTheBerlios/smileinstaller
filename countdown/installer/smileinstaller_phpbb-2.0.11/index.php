<?
class smileinstaller_phpbb_2_0_11 extends extensions
{
	function finish($pagenum, $varnum, $dbms, $dbhost, $dbuser, $dbpasswd, $dbname, $table_prefix, $admin_name, $admin_pass1, $admin_pass2, $board_email, $script_path, $server_name, $server_port)
	{
		$available_dbms= array ('mysql' => array ('LABEL' => 'MySQL 3.x', 'SCHEMA' => 'mysql', 'DELIM' => ';', 'DELIM_BASIC' => ';', 'COMMENTS' => 'remove_remarks'), 'mysql4' => array ('LABEL' => 'MySQL 4.x', 'SCHEMA' => 'mysql', 'DELIM' => ';', 'DELIM_BASIC' => ';', 'COMMENTS' => 'remove_remarks'), 'postgres' => array ('LABEL' => 'PostgreSQL 7.x', 'SCHEMA' => 'postgres', 'DELIM' => ';', 'DELIM_BASIC' => ';', 'COMMENTS' => 'remove_comments'), 'mssql' => array ('LABEL' => 'MS SQL Server 7/2000', 'SCHEMA' => 'mssql', 'DELIM' => 'GO', 'DELIM_BASIC' => ';', 'COMMENTS' => 'remove_comments'), 'msaccess' => array ('LABEL' => 'MS Access [ ODBC ]', 'SCHEMA' => '', 'DELIM' => '', 'DELIM_BASIC' => ';', 'COMMENTS' => ''), 'mssql-odbc' => array ('LABEL' => 'MS SQL Server [ ODBC ]', 'SCHEMA' => 'mssql', 'DELIM' => 'GO', 'DELIM_BASIC' => ';', 'COMMENTS' => 'remove_comments'));
		if (@ file_exists($script_path))
		{
			unlink($script_path.'config.php');
		}
		if (isset ($dbms))
		{
			switch ($dbms)
			{
				case 'msaccess' :
				case 'mssql-odbc' :
					$check_exts= 'odbc';
					$check_other= 'odbc';
					break;
				case 'mssql' :
					$check_exts= 'mssql';
					$check_other= 'sybase';
					break;
				case 'mysql' :
				case 'mysql4' :
					$check_exts= 'mysql';
					$check_other= 'mysql';
					break;
				case 'postgres' :
					$check_exts= 'pgsql';
					$check_other= 'pgsql';
					break;
			}
		}
		$dbms_schema= $script_path.'/install/schemas/'.$available_dbms[$dbms]['SCHEMA'].'_schema.sql';
		$dbms_basic= $script_path.'/install/schemas/'.$available_dbms[$dbms]['SCHEMA'].'_basic.sql';
		$remove_remarks= $available_dbms[$dbms]['COMMENTS'];
		;
		$delimiter= $available_dbms[$dbms]['DELIM'];
		$delimiter_basic= $available_dbms[$dbms]['DELIM_BASIC'];
		if ($dbms != 'msaccess')
		{
			// Load in the sql parser
			include ($script_path.'/includes/sql_parse.'.$phpEx);
			$sql_query= @ fread(@ fopen($dbms_schema, 'r'), @ filesize($dbms_schema));
			$sql_query= preg_replace('/phpbb_/', $table_prefix, $sql_query);
			$sql_query= $remove_remarks ($sql_query);
			$sql_query= split_sql_file($sql_query, $delimiter);
			for ($i= 0; $i < sizeof($sql_query); $i ++)
			{
				if (trim($sql_query[$i]) != '')
				{
					if (!($result= $db->sql_query($sql_query[$i])))
					{
						die("ERROR 1");
						exit;
					}
				}
			}
			$sql_query= @ fread(@ fopen($dbms_basic, 'r'), @ filesize($dbms_basic));
			$sql_query= preg_replace('/phpbb_/', $table_prefix, $sql_query);
			$sql_query= $remove_remarks ($sql_query);
			$sql_query= split_sql_file($sql_query, $delimiter_basic);
			for ($i= 0; $i < sizeof($sql_query); $i ++)
			{
				if (trim($sql_query[$i]) != '')
				{
					if (!($result= $db->sql_query($sql_query[$i])))
					{
						die('ERROR 2');
						exit;
					}
				}
			}
		}
		$sql= "INSERT INTO ".$table_prefix."config (config_name, config_value) 
						VALUES ('board_startdate', ".time().")";
		if (!$db->sql_query($sql))
		{
			die('ERROR 3');
		}
		$sql= "INSERT INTO ".$table_prefix."config (config_name, config_value) 
						VALUES ('default_lang', '".str_replace("\'", "''", $language)."')";
		if (!$db->sql_query($sql))
		{
			die('ERROR 4');
		}
		$update_config= array ('board_email' => $board_email, 'script_path' => $script_path, 'server_port' => $server_port, 'server_name' => $server_name,);
		while (list ($config_name, $config_value)= each($update_config))
		{
			$sql= "UPDATE ".$table_prefix."config 
								SET config_value = '$config_value' 
								WHERE config_name = '$config_name'";
			if (!$db->sql_query($sql))
			{
				die('ERROR 5');
			}
		}
		$admin_pass_md5= ($confirm && $userdata['user_level'] == ADMIN) ? $admin_pass1 : md5($admin_pass1);
		$sql= "UPDATE ".$table_prefix."users 
						SET username = '".str_replace("\'", "''", $admin_name)."', user_password='".str_replace("\'", "''", $admin_pass_md5)."', user_lang = '".str_replace("\'", "''", $language)."', user_email='".str_replace("\'", "''", $board_email)."'
						WHERE username = 'Admin'";
		if (!$db->sql_query($sql))
		{
			$error .= "Could not update admin info :: ".$sql." :: ".__LINE__." :: ".__FILE__."<br /><br />";
		}
		$sql= "UPDATE ".$table_prefix."users 
						SET user_regdate = ".time();
		if (!$db->sql_query($sql))
		{
			die('ERROR 6');
		}
		if ($error != '')
		{
			die('ERROR 1-6');
			exit;
		}
		$config_data= '<?php'."\n\n";
		$config_data .= "\n// phpBB 2.x auto-generated config file\n// Do not change anything in this file!\n\n";
		$config_data .= '$dbms = \''.$dbms.'\';'."\n\n";
		$config_data .= '$dbhost = \''.$dbhost.'\';'."\n";
		$config_data .= '$dbname = \''.$dbname.'\';'."\n";
		$config_data .= '$dbuser = \''.$dbuser.'\';'."\n";
		$config_data .= '$dbpasswd = \''.$dbpasswd.'\';'."\n\n";
		$config_data .= '$table_prefix = \''.$table_prefix.'\';'."\n\n";
		$config_data .= 'define(\'PHPBB_INSTALLED\', true);'."\n\n";
		$config_data .= '?'.'>'; // Done this to prevent highlighting editors getting confused!
		@ umask(0111);
		$fp= @ fopen($script_dir.'/config.php', 'w');
		$result= @ fputs($fp, $config_data, strlen($config_data));
		@ fclose($fp);
		$upgrade_now= $lang['upgrade_submit'];
	}
	function _uservalue_installerdir($pagenum, $varnum)
	{
		$return= parent :: _value_installerdir($pagenum, $varnum);
		$return['value']= parent :: lang('[Path to installer]').' '.$return['value'];
		return $return;
	}
	function _value_SQLDatabasesUser($pagenum, $varnum)
	{
		$this->_setError($pagenum, $varnum, '[no code]');
	}
}
?>