<?

	class extensions extends extensions_values_form
	{
		function _none ( $pagenum, $varnum )
		{
			$return		= array (
				'value'		=> '',
				'isset'		=> false
			);
			$return['isset']	= true;
			return $return;
		}
		function _notNull ( $pagenum, $varnum )
		{
			$return		= array (
				'value'		=> '',
				'isset'		=> false
			);
			if ( $_POST[$this->config['pages'][$pagenum]['data'][$varnum]['varname']] > "" )
			{
				$return['isset']	= true;
			}
			return $return;
		}
		function _newPasswordcheck ( $pagenum, $varnum, $pass1, $pass2 )
		{
			$return		= array (
				'value'		=> '',
				'isset'		=> false
			);
			if ( $pass1 == $pass2 )
			{
				$return['isset']	= true;
			}

#			if ( $return == false ) $this->_setError ( $pagenum, $varnum );
			return $return;
		}
	}
	
?>