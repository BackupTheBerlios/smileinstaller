<?

	class extensions_checks_file extends extensions_checks_db
	{
		function _check_Installdir ( $pagenum, $varnum )
		{
			$return		= array (
				'value'		=> $_POST[$this->config['pages'][$pagenum]['data'][$varnum]['varname']],
				'isset'		=> false
			);
			if ( !is_dir ( $return['value'] ) )
			{
				if ( mkdir ( $return['value'], 0777 ) )
				{
					rmdir ( $return['value'] );
					$return['isset']		= true;
				}
			}
			return $return;
		}
	}

?>