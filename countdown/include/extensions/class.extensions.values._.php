<?

	class extensions_values extends extensions_checks_form
	{
		function _redirectTo ( $pagenum, $varnum, $preurl, $file )
		{
			$return		= array (
				'value'		=> $preurl . '/' . $file,
				'isset'		=> true
			);
			return $return;
		}
		function _getServername ( $pagenum, $varnum )
		{
			$return		= array (
				'value'		=> getenv ( 'SERVER_NAME' ),
				'isset'		=> true
			);
			return $return;
		}
		function _getServerport ( $pagenum, $varnum )
		{
			$return		= array (
				'value'		=> getenv ( 'SERVER_PORT' ),
				'isset'		=> true
			);
			return $return;
		}
	}

?>