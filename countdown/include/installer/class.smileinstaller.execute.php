<?
	class smileinstaller_execute extends configparser
	{
		function execute ( $evalcode, $pagenum = false, $varnum = false )
		{
			$this->evalcode		= $evalcode;
			unset ( $evalcode );
			foreach ( $this->config['executeEnvironment'] as $varname => $varvalue )
			{
				$$varname = $varvalue;
			}
			unset ( $varname, $varvalue );
			eval ( $this->evalcode );
			return $return;
		}
		function executeEnvironment ( $evalcode, $pagenum, $varnum )
		{
			$this->evalcode		= $evalcode;
			unset ( $evalcode );
			foreach ( $this->config['executeEnvironment'] as $varname => $varvalue )
			{
				$$varname = $varvalue;
			}
			unset ( $varname, $varvalue );
			eval ( $this->evalcode );
			return $return;
		}
		function executePageenvironment ( $evalcode, $pagenum )
		{
			$this->evalcode		= $evalcode;
			unset ( $evalcode );
			foreach ( $this->config['executeEnvironment'] as $varname => $varvalue )
			{
				$$varname = $varvalue;
			}
			unset ( $varname, $varvalue );
			$varnum		= 0;
			eval ( $this->evalcode );
			return $return;
		}
		function executeFinishenvironment ( $evalcode )
		{
			$this->evalcode		= $evalcode;
			unset ( $evalcode );
			foreach ( $this->config['executeEnvironment'] as $varname => $varvalue )
			{
				$$varname = $varvalue;
			}
			unset ( $varname, $varvalue );
			$varnum		= 0;
			eval ( $this->evalcode );
			return $return;
		}
	}
	
?>