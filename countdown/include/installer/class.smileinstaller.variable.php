<?
	class smileinstaller_variable extends smileinstaller_language
	{
		function checkVariable ( $pagenum, $varnum, $checks, $selectedValue )
		{
			$return	= true;
			if ( is_array ( $checks ) )
			{
				if ( $this->config['pages'][$pagenum]['data'][$varnum]['formtype'] != 'box'
					&& $this->config['pages'][$pagenum]['data'][$varnum]['formtype'] != 'html' )
				{
					if ( $this->config['system']['debug'] >= 5 ) $this->_setError ( $pagenum, 'checkVariable', "$pagenum, $varnum, $selectedValue" );
					foreach ( $checks as $check )
					{
						$value		= "";
						$evalcode	= "\$return = \$this->config['extension'] -> " . $this->parseItem ( $check['action'] );
						if ( $this->config['system']['debug'] >= 5 ) $this->_setError ( $pagenum, 'checkVariable', "execute $evalcode" );
						$return		= $this->execute ( $evalcode, $pagenum, $varnum );
						$value		= $return['value'];
						$ok			= $return['isset'];
						if ( $this->config['system']['debug'] >= 5 ) $this->lang ( $check['errormessage'] );
						if ( !$ok )
						{
							if ( $this->config['system']['debug'] >= 5 ) $this->_setError ( $pagenum, 'checkVariable', "check false" );
							$return		= false;
							$this->_setError ( $pagenum, $varnum, $check['errormessage'] );
							break;
						} else {
							if ( $this->config['system']['debug'] >= 5 ) $this->_setError ( $pagenum, 'checkVariable', "check true" );
						}					
					}
				}
			}
			return $return;
		}
	}
?>