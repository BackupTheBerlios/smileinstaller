<?

	class extensions extends extensions_formspecific
	{ 
		function _none ( $pagenum, $varnum ) {
			$return = array ( 
				'value' => $_POST[$this->config['pages'][$pagenum]['data'][$varnum]['varname']],
				'isset'	=> true
			);
			return $return;
		}
		function _notNull ( $pagenum, $varnum )
		{
			$return = array ( 
				'value' => $var['defaultvalue'],
				'isset'	=> false
			);
			if ( $_POST[$this->config['pages'][$pagenum]['data'][$varnum]['varname']] > "" )
			{
				$return = array ( 
					'value' => $_POST[$this->config['pages'][$pagenum]['data'][$varnum]['varname']],
					'isset'	=> true
				);
			}
			return $return;
		}
		function __compareUser ( $varname, $requireValue )
		{
			$return			= 0;
			if ( $_POST[$varname] == $requireValue )
			{
				
				$return		= 1;
			}
			return $return;
		}
		function _injectVariable ( $pagenum, $varnum, $userpagenum )
		{
			$pagenum++;
			$configvarnum		= $this->config['count'][$pagenum]['variables'] + $varnum;
			$dir		= $this->config['system']['directories']['scriptdir'] . "/temp/$userpagenum/$varnum";
			$page			= $pagenum;
			$required		= @implode ( "", file ( "$dir/required" ) );
			$position		= $configvarnum;
			$canRecheck		= @implode ( "", file ( "$dir/canrecheck" ) );
			$newline		= @implode ( "", file ( "$dir/newline" ) );
			$varname		= @implode ( "", file ( "$dir/varname" ) );
			$htmlname		= @implode ( "", file ( "$dir/htmlname" ) );
			$form			= @implode ( "", file ( "$dir/form" ) );
			$defaultvalue	= "=" . @implode ( "", file ( "$dir/defaultvalue" ) );
			$check			= "=" . @implode ( "", file ( "$dir/check" ) );
			if ( !isset ( $this->config['pages'][$pagenum]['data'][$varname] ) )
			{
				$this->config['pagevariables'][$varname]		= array (
					'pagenum'		=> $pagenum,
					'varnum'		=> $position
				);
				$this->config['pages'][$pagenum]['data'][$position]		= array (
					'varname'		=> $varname,
					'htmlname'		=> $this->lang ( $htmlname ),
					'valueRequired'	=> $required,
					'canRecheck'	=> $canRecheck,
					'form'			=> $this->parseConfigoptionType ( $form ),
					'newline'		=> $newline,
					'defaultvalue'	=> $defaultvalue,
					'valuecheck'	=> array ( $check ),
					'successfulSet'	=> 0,
					'installerlanguage'	=> '',
				);
			}else {
				$this->config['pages'][$page]['data'][$position]['valuecheck'][]	= $check;
			}
			if ( $this->config['system']['totalPages'] < $page )
			{
				$this->config['system']['totalPages']	= $page;
			}
		}
		function _newPasswordcheck ( $pagenum, $varnum, $pass1, $pass2 )
		{
			$return		= false;
			if ( $pass1 == $pass2 )
			{
				$return		= true;
			}
			return $return;
		}
		function _rootdir ( $pagenum, $varnum )
		{
			return	str_replace ( '/include', '', str_replace ( "\\", "/", dirname ( __FILE__ ) ) );
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
		 
		    return false;
		}
	}
	
?>