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
	}

?>