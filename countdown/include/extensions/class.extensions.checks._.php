<?

	class extensions_checks extends installer
	{
		function _check_none ( $pagenum, $varnum )
		{
			$return		= array (
				'value'		=> '',
				'isset'		=> false
			);
			$return['isset']	= true;
			return $return;
		}
		function _check_notNull ( $pagenum, $varnum )
		{
			$return		= array (
				'value'		=> $_POST[$this->config['pages'][$pagenum]['data'][$varnum]['varname']],
				'isset'		=> false
			);
			if ( $_POST[$this->config['pages'][$pagenum]['data'][$varnum]['varname']] > "" )
			{
				$return['isset']	= true;
			}
			return $return;
		}
		function _check_compareValues ( $pagenum, $varnum, $pass1, $pass2 )
		{
			$return		= array (
				'value'		=> '',
				'isset'		=> false
			);
			if ( $pass1 === $pass2 )
			{
				$return['isset']	= true;
			}
			return $return;
		}
	}

?>