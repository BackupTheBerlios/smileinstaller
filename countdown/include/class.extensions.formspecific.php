<?

	class extensions_formspecific	extends extensions_db
	{
		function _checkFormspecific ( $pagenum, $varnum, $requireValue = false )
		{
			$var		= $this->config['pages'][$pagenum]['data'][$varnum];
			switch ( strtolower ( $var['form'] ) )
			{
				case 'select' :
				{
					$return		= $this->__checkFormSelect ( $var, $requireValue );
					break;
				}
				case 'checkbox' :
				{
					$return		= $this->__checkFormCheckbox( $var );
					break;
				}
				case 'input' :
				{
					$return		= $this->__checkFormInput ( $var );
					break;
				}
				case 'password' :
				{
					$return		= $this->__checkFormPassword ( $var );
					break;
				}
				default :
				{
					die ( 'no checkable element ' . $this->config['pages'][$pagenum]['data'][$varnum]['form'] );
				}
			}
			if ( $return['isset'] == false ) $this->_setError ( $pagenum, $varnum, 'ungueltiger Wert', $_POST[$this->config['pages'][$pagenum]['data'][$varnum]['varname']] );
			
			return $return;
		}
		function __checkFormSelect ( $var, $requireValue = false )
		{
			$return = array ( 
				'value' => $var['defaultvalue'],
				'isset'	=> false
			);
			if ( $requireValue ) 
			{
				if ( $_POST[$var['varname']] == $requireValue )
				{
					$return = array ( 
						'value' => $_POST[$var['varname']],
						'isset'	=> true
					);
				}
			} else {
				$options		= explode ( ",", $var['defaultvalue'] );
				foreach ( $options as $value )
				{
					if ( $newValue		= strstr ( $value, ":" ) )
					{
						$key	= str_replace ( $newValue, "", $value );
						$value	= substr ( $newValue, 1 );
					}
					else {
						$key	= $value;
					}
					if ( $_POST[$var['varname']] == $key )
					{
						$return = array ( 
							'value' => $_POST[$var['varname']],
							'isset'	=> true
						);
					}
				}
			}
			return $return;
		}
		function __checkFormCheckbox ( $var )
		{
			$return = array ( 
				'value' => $var['defaultvalue'],
				'isset'	=> false
			);
			if ( $var['defaultvalue'] == $_POST[$var['varname']] )
			{
				$return = array ( 
					'value' => $_POST[$var['varname']],
					'isset'	=> true
				);
			}
			return $return;
		}
		function __checkFormInput ( $var )
		{
			$return = array ( 
				'value' => $var['defaultvalue'],
				'isset'	=> false
			);
			if ( $_POST[$var['varname']] > "" )
			{
				$return = array ( 
					'value' => $_POST[$var['varname']],
					'isset'	=> true
				);
			}
			return $return;
		}
		function __checkFormPassword ( $var )
		{
			$return = array ( 
				'value' => $var['defaultvalue'],
				'isset'	=> false
			);
			if ( $_POST[$var['varname']] > "" )
			{
				$return = array ( 
					'value' => $_POST[$var['varname']],
					'isset'	=> true
				);
			}
			return $return;
		}
	}
	
?>