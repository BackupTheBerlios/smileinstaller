<?
	class smileinstaller_variable extends smileinstaller_language
	{
		function setVariable ( $pagenum, $varnum )
		{
			if ( !isset ( $this->config['pages'][$pagenum]['data'][$varnum]['defaultSet'] ) )
			{
				$this->setDefaultValue ( $pagenum, $varnum );
				$this->config['pages'][$pagenum]['data'][$varnum]['defaultSet']	= true;
			}
			$var						= $this->config['pages'][$pagenum]['data'][$varnum];
			$postSet	= false;
			$valueIsSet		= false;
			if ( $var['canRecheck'] == 0 && isset ( $this->config['system']['setVar'][$var['varname']] ) )
			{
				$uneditable	= true;
				$value		= $this->config['system']['setVar'][$var['varname']];
				$valueIsSet		= true;
				$postSet	= true;
			} else {
				$uneditable	= false;
				if ( isset ( $_POST[$var['varname']] ) )
				{
					if ( isset ( $this->config['pages'][$pagenum]['data'][$varnum]['valuecheck'] )
					&& is_array ( $this->config['pages'][$pagenum]['data'][$varnum]['valuecheck'] )
					)
					{
						$valueIsSet		= false;
						foreach ( $this->config['pages'][$pagenum]['data'][$varnum]['valuecheck'] as $check )
						{
							$value		= "";
							$evalcode	= "\$return = \$this->config['extension'] -> " . $this->parseItem ( $check['action'] );
							$return		= $this->executeEnvironment ( $evalcode, $pagenum, $varnum );
							$value		= $return['value'];
							$valueIsSet	= $return['isset'];
#							} elseif ( substr ( $check['action'], 0, 1 ) === "=" )
#							{
#								if ( $_POST[$var['varname']] == substr ( $check['action'], 1 ) )
#								{
#									$value	= $this->lang ( substr ( $check['action'], 1 ) );
#									$valueIsSet	= true;
#								}
#							} elseif ( substr ( $check['action'], 0, 1 ) === "." ) {
#								$data	= trim ( implode ( "", file ( $this->config['system']['directories']['scriptdir'] . '/files/' .substr ( $check['action'], 1 ) ) ) );
#								if ( $_POST[$var['varname']] == $data )
#								{
#									$value	= $data;
#									$valueIsSet	= true;
#								}
#							} else {
#								die ( 'No parseable value ' . $check['action'] );
#							}
							if ( $valueIsSet == false )
							{
								$this->_setError ( $pagenum, $varnum, $check['errormessage'] );
								if ( $check['required'] == 1 )
								{
									break;
								}
							}
						}
					} else {
						$value	= $_POST[$var['varname']];
						$valueIsSet	= true;
					}
				} else {
					$value	= "";
					$valueIsSet	= false;
				}
			}
			if ( $var['valueRequired'] == 0 )
			{
				$valueIsSet	= true;
			}
			if ( !$valueIsSet )
			{
				$this->config['pages'][$pagenum]['data'][$varnum]['error']	= 1;
				if ( $this->config['system']['pageerror'] == 0 
				|| $this->config['system']['pageerror'] > $pagenum )
				{
					$this->config['system']['pageerror']	= $pagenum;
				}
			}
			
			$form		= $this->setForm ( $var, $value, $valueIsSet, $uneditable );
			$this->config['pages'][$pagenum]['data'][$varnum]['editableValue']	= $form;
			if ( $valueIsSet )
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