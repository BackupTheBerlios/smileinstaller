<?

	class extensions extends extensions_file
	{
		function _none ( $pagenum, $varnum )
		{
			return true;
		}
		function _notNull ( $pagenum, $varnum )
		{
			$return		= false;
			if ( $_POST[$this->config['pages'][$pagenum]['data'][$varnum]['varname']] > "" )
			{
				$return		= true;
			}
			
			if ( $return == false ) $this->_setError ( $pagenum, $varnum, 'Nicht gesetzt', "" );
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

			if ( $return == false ) $this->_setError ( $pagenum, $varnum, 'Passwoerter stimmen nicht ueberein', "" );
			return $return;
		}
	}
	
?>