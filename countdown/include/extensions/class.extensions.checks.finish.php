<?

	class extensions_checks_finish extends extensions_checks_file {
		
		function _createDirectory ( $pagenum, $varnum, $path, $mode )
		{
			$return		= array (
				'value'		=> "$path/$newDir",
				'isset'		=> false
			);
			@mkdir ( "$path/$newDir", $mode );
			if ( is_dir ( "$path/$newDir" ) )
			{
				$return['isset']		= true;
			}
			return $return;
		}
	}

?>