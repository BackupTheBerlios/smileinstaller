<?php
class extensions_output_file extends extensions_output_db
{
	function _output_VarToFile($pagenum, $varnum, $path, $file, $allowOnlyVariables= false)
	{
		if ( $this->config['system']['debug'] >= 5 ) parent::_setError ( $pagenum, $varnum, '_output_VarToFile' );		$return= array ('value' => '', 'isset' => false);
		$fh= fopen($path."/".$file, 'w+');
		if ($fh)
		{
			if ($allowOnlyVariables)
			{
				$allowOnlyVariables= "+".$allowOnlyVariables."+";
			}
			fputs($fh, "<?php\n");
			foreach ($this->config['hiddenValue'] as $variable)
			{
				if ($allowOnlyVariables)
				{
					if (preg_match('|\+('.$variable['varname'].')\+|', $allowOnlyVariables))
					{
						fputs($fh, "$".$variable['varname']." = '".$variable['varvalue']."';\n");
					}
				}
				else
				{
					fputs($fh, "$".$variable['varname']." = '".$variable['varvalue']."';\n");
				}
			}
			fputs($fh, "?>");
			fclose($fh);
			$return['isset']= true;
		}
		return $return;
	}
	function _output_CreateDirectory($pagenum, $varnum, $path, $mode)
	{
		if ( $this->config['system']['debug'] >= 5 ) parent::_setError ( $pagenum, $varnum, '_output_CreateDirectory' );		$return= array ('value' => "$path/$newDir", 'isset' => false);
		@ mkdir("$path/$newDir", $mode);
		if (is_dir("$path/$newDir"))
		{
			$return['isset']= true;
		}
		return $return;
	}
	function _output_UnpackScript($pagenum, $varnum, $path)
	{
		if ( $this->config['system']['debug'] >= 5 ) parent::_setError ( $pagenum, $varnum, '_output_UnpackScript' );		$return['isset']= true;
		// the first argument is the zip file
		//$in_file = $_SERVER['argv'][1];
		$in_file= $this->config['system']['directories']['scriptdir'].'/script.zip';
		/* any other arguments are specific files in the archive to unzip
		if ($_SERVER['argc'] > 2) {
			$all_files = 0;
			for ($i = 2; $i < $_SERVER['argc']; $i++) {
			$out_files[$_SERVER['argv'][$i]] = true;
		}
		} else {
		*/
		// if no other files are specified, unzip all files
		//$all_files = true;
		//}
		$z= zip_open($in_file);
		$count= 0;
		while ($entry= zip_read($z))
		{
			$count ++;
			$entry_name= zip_entry_name($entry);
			// check if all files should be unzipped, or the name of
			// this file is on the list of specific files to unzip
			//if ($all_files || $out_files[$entry_name]) {
			// only proceed if the file is not 0 bytes long
			if (zip_entry_filesize($entry))
			{
				$dir= $path.'/'.dirname($entry_name);
				// make all necessary directories in the file's path
				if (!is_dir($dir))
				{
					$this->__pc_mkdir_parents($dir);
				}
				$file= basename($entry_name);
				if (zip_entry_open($z, $entry))
				{
					if ($fh= fopen($dir.'/'.$file, 'w'))
					{
						// write the entire file
						fwrite($fh, zip_entry_read($entry, zip_entry_filesize($entry))) or $return['isset']= false;
						fclose($fh) or $return['isset']= false;
					}
					else
					{
						$return['isset']= false;
					}
					zip_entry_close($entry);
				}
				else
				{
					$return['isset']= false;
				}
			}
			//}
		}
		if ($count == 0)
		{
			$return['isset']= false;
		}
		return $return;
	}
}
?>