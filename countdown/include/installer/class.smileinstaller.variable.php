<?
	class smileinstaller_variable extends smileinstaller_language
	{
		function checkVariable ( $pagenum, $varnum, $checks, $selectedValue )
		{
			$return	= true;
			foreach ( $checks as $check )
			{
				$value		= "";
				$evalcode	= "\$return = \$this->config['extension'] -> " . $this->parseItem ( $check['action'] );
				$return		= $this->executeEnvironment ( $evalcode, $pagenum, $varnum );
				$value		= $return['value'];
				$ok			= $return['isset'];
				if ( !$ok )
				{
					$return		= false;
					$this->_setError ( $pagenum, $varnum, $check['errormessage'] );
					break;
				}
			}
			return $return;
		}
		function setVariable ( $pagenum, $varnum )
		{
			$var		= $this->config['pages'][$pagenum]['data'][$varnum];
			if ( isset ( $_POST[$var['varname']] ) )
			{
				if ( isset ( $this->config['pages'][$pagenum]['data'][$varnum]['valuecheck'] )
				&& is_array ( $this->config['pages'][$pagenum]['data'][$varnum]['valuecheck'] )
				)
				{
					foreach ( $this->config['pages'][$pagenum]['data'][$varnum]['valuecheck'] as $check )
					{
						$value		= "";
						$evalcode	= "\$return = \$this->config['extension'] -> " . $this->parseItem ( $check['action'] );
						$return		= $this->executeEnvironment ( $evalcode, $pagenum, $varnum );
						$value		= $return['value'];
						$ok			= $return['isset'];
						if ( !$ok )
						{
							$this->_setError ( $pagenum, $varnum, $check['errormessage'] );
							break;
						}
					}
				} else {
					$value	= $_POST[$var['varname']];
					$ok	= true;
				}
			} else {
				$value	= $this->config['pages'][$pagenum]['data'][$varnum]['defaultSet']['defaultvalue'];
				$ok		= false;
			}
			if ( !$ok )
			{
				$this->config['pages'][$pagenum]['data'][$varnum]['error']	= 1;
				if ( $this->config['system']['pageerror'] == 0 
				|| $this->config['system']['pageerror'] > $pagenum )
				{
					$this->config['system']['pageerror']	= $pagenum;
				}
			}
			
			$form		= $this->setForm ( $var, $value, $ok );
			$this->config['pages'][$pagenum]['data'][$varnum]['editableValue']	= $form;
			if ( $ok )
			{
				$this->config['pages'][$pagenum]['data'][$varnum]['uservalue'] = $value;
				$this->config['hiddenValue'][$var['varname']]		= array (
					'varname'		=> $var['varname'],
					'varvalue'		=> $value
				);
				$this->config['system']['setVar'][$var['varname']]	= $value;
			}
		}
		function unsetVariable ( $pagenum, $varnum )
		{
			$var		= $this->config['pages'][$pagenum]['data'][$varnum];
			unset ( $this->config['hiddenValue'][$var['varname']] );
			unset ( $this->config['system']['setVar'][$var['varname']] );
			$var		= $this->config['pages'][$pagenum]['data'][$varnum];
			$form		= $this->setForm ( $var, "", false, false );
			$this->config['pages'][$pagenum]['data'][$varnum]['editableValue']	= $form;
		}
	}
?>