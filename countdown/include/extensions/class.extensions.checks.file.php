<?

	class extensions_checks_file extends extensions_checks_db
	{
		function _checkInstalldir ( $pagenum, $varnum )
		{
			echo $_POST[$this->config['pages'][$pagenum]['data'][$varnum]['varname']];
			$return		= array (
				'value'		=> $_POST[$this->config['pages'][$pagenum]['data'][$varnum]['varname']],
				'isset'		=> false
			);
			@mkdir ( $return['value'], 0777 );
			if ( is_dir ( $return['value'] ) )
			{
				$return['isset']		= true;
			}
			return $return;
			
		}
	}

?>