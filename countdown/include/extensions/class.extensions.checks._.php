<?

	class extensions_checks extends installer
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
				'value'		=> $_POST[$this->config['pages'][$pagenum]['data'][$varnum]['varname']],
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
		function _writeToFile ( $pagenum, $varnum, $path, $file, $allowOnlyVariables = false )
			{
				$return		= array (
					'value'		=> '',
					'isset'		=> false
				);
				$fh		= fopen ( $path . "/" . $file, 'w+' );
				if ( $fh )
				{
					if ( $allowOnlyVariables )
					{
						$allowOnlyVariables		= "+" . $allowOnlyVariables . "+";
					}
					fputs ( $fh, "<?php\n" );
					foreach ( $this->config['pages'] as $page )
					{
						foreach ( $page['data'] as $variable )
						{
							if ( $allowOnlyVariables )
							{
								if ( preg_match ( '|\+(' . $variable['varname'] . ')\+|', $allowOnlyVariables ) )
								{
									fputs ( $fh, "$" . $variable['varname'] . " = '" . $variable['uservalue'] . "';\n" );
								}
							} else {
								fputs ( $fh, "$" . $variable['varname'] . " = '" . $variable['uservalue'] . "';\n" );
							}
						}
					}
					fputs ( $fh, "?>" );
					fclose ( $fh );
					$return['isset']		= true;
				}
				return $return;
			}
	}

?>