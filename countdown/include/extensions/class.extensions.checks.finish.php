<?

	class extensions_checks_finish extends extensions_checks_file {
		
		function _createDirectory ( $path, $newDir, $mode )
		{
			$return		= array (
				'value'		=> '',
				'isset'		=> false
			);
			if ( is_dir ( $path ) )
			{
				if ( @mkdir ( "$path/$newDir", $mode ) 
				|| is_dir ( "$path/$newDir" ) )
				{
					$return['isset']		= true;
				}
			}
			return $return;
		}
	}

?>