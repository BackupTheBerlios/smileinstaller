<?

	class extensions_file extends extensions_formspecific
	{
		function _value_rootdir ( $pagenum, $varnum )
		{
			return str_replace ( '/include', '', str_replace ( "\\", "/", dirname ( __FILE__ ) ) );
		}
		function _checkWriteable ( $pagenum, $varnum, $path )
		{
			$return		= false;
			if ( is_dir( $path ) )
			{
				$fh		= @fopen ( 'test', 'w+' );
				if ( $fh )
				{
					fclose ( $fh );
					unlink ( $fh );
					$return		= true;
				}
			}
			if ( $return == false ) $this->_setError ( $pagenum, $varnum, "Keine Schreibrechte", "$path" );
			return $return;
		}
		function _createDirectory ( $pagenum, $varnum, $pathname, $mode = null )
		{
			$pathname		= $_POST[$this->config['pages'][$pagenum]['data'][$varnum]['varname']];
			$pathname		= str_replace ( '\\', '/', $pathname );
			$return		= false;
		    if ( !is_dir ( $pathname )
		    	&& !empty ( $pathname )
		    	&& !is_file ( $pathname ) )
		    {
			    $next_pathname		= substr ( $pathname, 0, strrpos ( $pathname, '/' ) );
			    if ( mkdirr ( $next_pathname, $mode ) )
			    {
			        if ( !file_exists ( $pathname ) )
			        {
			            return mkdir($pathname, $mode);
			        }
			    }
		        $return		= true;
		    }
		 
			if ( $return == false ) $this->_setError ( $pagenum, $varnum, 'Verzeichniss konnte nicht erstellt werden', "$pathname" );
		    return $return;
		}
	}

?>