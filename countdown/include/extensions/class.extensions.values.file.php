<?

	class extensions_values_file extends extensions_values_db
	{
		function _value_rootdir ( $pagenum, $varnum )
		{
			return array (
				'value'		=> str_replace ( "\\", "/", ROOTPATH ),
				'isset'		=> true
			);
		}
		
		function _unpackScript ( $pagenum, $varnum, $path )
		{
			echo $path;
			$return['isset']		= true;
			// the first argument is the zip file
			//$in_file = $_SERVER['argv'][1];
			$in_file = $this->config['system']['directories']['scriptdir'] . '/script.zip';
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
			$z = zip_open($in_file);
			$count	= 0;
			while ($entry = zip_read($z)) {
				$count++;
				$entry_name = zip_entry_name($entry);
				// check if all files should be unzipped, or the name of
				// this file is on the list of specific files to unzip
				//if ($all_files || $out_files[$entry_name]) {
					// only proceed if the file is not 0 bytes long
					if (zip_entry_filesize($entry)) {
						$dir = $path . '/' . dirname($entry_name);
						// make all necessary directories in the file's path
						if (! is_dir($dir)) { $this->pc_mkdir_parents($dir); }
						$file = basename($entry_name);
						if (zip_entry_open($z,$entry)) {
							if ($fh = fopen($dir.'/'.$file,'w')) {
								// write the entire file
								fwrite($fh,zip_entry_read($entry,zip_entry_filesize($entry)))
									or $return['isset'] = false;
								fclose($fh) or $return['isset'] = false;
							} else {
								$return['isset'] = false;
							}
							zip_entry_close($entry);
						} else {
							$return['isset'] = false;
						}
					}
				//}
			}
			if ( $count == 0 )
			{
				$return['isset']		= false;
			}
			return $return;
		}
	
		function pc_mkdir_parents($d,$umask = 0777) {
		    $dirs = array($d);
		    $d = dirname($d);
		    $last_dirname = '';
		    while($last_dirname != $d) { 
		        array_unshift($dirs,$d);
		        $last_dirname = $d;
		        $d = dirname($d);
		    }
		
		    foreach ($dirs as $dir) {
		        if (! file_exists($dir)) {
		            if (! mkdir($dir,$umask)) {
		                error_log("Can't make directory: $dir");
		                return false;
		            }
		        } elseif (! is_dir($dir)) {
		            error_log("$dir is not a directory");
		            return false;
		        }
		    }
		    return true;
		}
	}

?>