<?

	class extensions_finish extends installer {
		
		function _copyScriptTo ( $path )
		{
			$return		= false;
			if ( is_dir ( $path ) )
			{
#
			}
		}
		function _createDirectory ( $path, $newDir, $mode )
		{
			$return		= false;
			if ( is_dir ( $path ) )
			{
				if ( @mkdir ( "$path/$newDir", $mode ) 
				|| is_dir ( "$path/$newDir" ) )
				{
					$return		= true;
				}
			}
			return $return;
		}
		function _writeToFile ( $filename, $allowOnlyVariables = false )
		{
			$return		= false;
			$fh		= fopen ( $this->config['system']['directories']['scriptdir'] . '/files/script/' . $filename, 'w+' );
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
				$return		= true;
			}
			return $return;
		}
	}

?>