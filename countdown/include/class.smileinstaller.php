<?
	class installer extends smileinstaller_variable {
		function installer ( $installer, $isExtension = false )
		{ 
			$this->config			= array (
				'system'				=> array (
					'debug'					=> 0,
					'isExtension'			=> $isExtension,
					'errormessage'			=> '',
					'installer'				=> $installer,
					'installerlanguage'		=> "",
					'largest_row'			=> 0,
					'largest_row_cached'	=> 0,
					'totalPages'			=> 0,
					'currentPage'			=> 0,
					'explicit_page'			=> 0,
					'installerlanguages'	=> array (
						'english'				=> 'Please select your language',
						'deutsch'				=> 'Bitte w&auml;hlen Sie Ihre Sprache',
						'français'				=> 'Veuillez choisir votre langue',
					),
					'classname'				=> preg_replace ( '|([^a-zA-Z0-9])|', '_', $installer ),
					'pageerror'				=> -1,
					'allow_db'				=> false,
					'directories'			=> array (
						'scriptdir'				=> addslashes ( dirname ( __FILE__ ) )  . '/../installer/' . $installer,
						'languagedir'			=> addslashes ( dirname ( __FILE__ ) )  . '/../installer/' . $installer . '/languages',
					),
				),
				'files'					=> array (
					'languageitems'			=> addslashes ( dirname ( __FILE__ ) )  . '/../installer/' . $installer . '/languages/available',
					'extension'				=> addslashes ( dirname ( __FILE__ ) )  . '/../installer/' . $installer . '/index.php',
					'config'				=> addslashes ( dirname ( __FILE__ ) )  . '/../installer/' . $installer . '/config.xml',
					'installertemplate'		=> addslashes ( dirname ( __FILE__ ) )  . '/../installer/' . $installer . '/tpl/installer.html',
					'languagetemplate'		=> addslashes ( dirname ( __FILE__ ) )  . '/../installer/' . $installer . '/tpl/language.html',
					'finishtemplate'		=> addslashes ( dirname ( __FILE__ ) )  . '/../installer/' . $installer . '/tpl/finish.html',
				),
				'varpattern'			=> '/^' .
					'([0-9]{1,10})\s{1,}' .
					'([12]{1})\s{1,}' .
					'([0-9]{1,})\s{1,}' .
					'([01]{1})\s{1,}' .
					'([01]{1})\s{1,}' .
					'"([^"]{1,})"\s{1,}' .
					'"([^"]{1,})"\s{1,}' .
					'"([^"]{1,})"\s{1,}' .
					'"([^"]{1,})"\s{1,}' .
					'"([^"]{1,})"\s{0,}' .
					'/is',
				'varrequirepattern'			=> '/^' .
					'([0-9]{1,10})\s{1,}' .
					'([12]{1})\s{1,}' .
					'([0-9]{1,})\s{1,}' .
					'([01]{1})\s{1,}' .
					'([01]{1})\s{1,}' .
					'"([^"]{1,})"\s{1,}' .
					'"([^"]{1,})"\s{0,}' .
					'/is',
				'pagetextpattern'		=> '/^' .
					'([0-9]{1,})\s{1,}' .
					'"(pagetitle|pagename|pagedesc{1})"\s{1,}' .
					'"([^"]{1,})"\s{0,}' .
					'/is',
				'pageactionpattern'		=> '/^' .
					'([0-9]{1,10})\s{1,}' .
					'([12]{1})\s{1,}' .
					'([0-9]{1,10})\s{1,}' .
					'"([^"]{1,})"\s{1,}' .
					'"([^"]{1,})"\s{0,}' .
					'/is',
				'languagelinepattern'	=> '/^' .
					'([^=]{1,})=(.*)' .
					'$/',				
			);
		}
		function go ()
		{
			if ( $this->config['system']['debug'] ) $this->_setError ( 'DEBUG', 'go', 'begin installation' );
			if ( $this->config['system']['isExtension'] )
				die ( 'not an installer' );
			$this->loadLanguageitems ();
			$this->initializeExtension ();
			$this->checkLanguagepage ();
			$return	= $this->setConfig ();
			$return		= $this->tpl->result ();
			return $return;
		}
		function initializeExtension ()
		{
			require_once ( $this->config['files']['extension'] );
			$evalcode		= "\$this->config['extension'] = new " . $this->config['system']['classname'] . " ( \$this->config['system']['installer'], true );";
			eval ( $evalcode );
			$this->config['extension']->config	= &$this->config;
		}
		function setPageAfter ( $pagenum )
		{
			$return['isset']	= true;
			if ( isset ( $this->config['pages'][$pagenum]['action'] ) )
			{
				foreach ( $this->config['pages'][$pagenum]['action'] as $check )
				{
					$evalcode	= "\$return = \$this->config['extension']->" . $check['action'];
					$return		= $this->execute ( $evalcode, $pagenum, 0 );
					if ( !$return['isset'] )
					{
						$this->_setError ( $pagenum, 0, $check['errormessage'] );
						if ( $this->config['system']['pageerror'] == -1 
						|| $this->config['system']['pageerror'] > $pagenum )
						{
							$this->config['system']['pageerror']	= $pagenum;
						}
					}
				}
			}
			return $return['isset'];
		}
		function unsetPage ( $pagenum )
		{
			foreach ( $this->config['pages'][$pagenum]['data'] as $varnum => $var )
			{
				$this->unsetVariable ( $pagenum, $varnum );
				$return		= false;
			}
		}
		function genForm ( $formname, $formtype, $defaultValues, $selectedValue )
		{
			$selectedValue	= $this->lang ( $selectedValue );
			switch ( strtolower ( $formtype ) )
			{
				case 'box' :
				{
					$form	= '<textarea readonly style="width: 100%; height: 200px">' . $defaultValues . '</textarea>';
					$this->config['executeEnvironment'][$formname]	= $defaultValues;
					break;
				}
				case 'html' :
				{
					$form	= $defaultValues;
					$this->config['executeEnvironment'][$formname]	= $defaultValues;
					break;
				}
				case 'input' :
				{
					$form		= "<input type=\"text\" name=\"$formname\" value=\"";
					if ( $selectedValue )
					{
						$form	.= $executeEnvironmentvalue	= $selectedValue;
					} else {
						$form	.= $executeEnvironmentvalue	= $defaultValues;
					}
					$form	.= "\">";
					$this->config['executeEnvironment'][$formname]	= $executeEnvironmentvalue;
					break;
				}
				case 'password' :
				{
					$form		= "<input type=\"password\" name=\"$formname\" value=\"";
					if ( $selectedValue )
					{
						$form	.= $executeEnvironmentvalue	= $selectedValue;
					} else {
						$form	.= $executeEnvironmentvalue	= $defaultValues;
					}
					$form	.= "\">";
					$this->config['executeEnvironment'][$formname]	= $executeEnvironmentvalue;
					break;
				}
				case 'text' :
				{
					$form	= "<textarea name=\"$formname\" style=\"width: 100%; height:150px\">";
					if ( $selectedValue )
					{
						$form	.= $executeEnvironmentvalue	= $selectedValue;
					} else {
						$form	.= $executeEnvironmentvalue	= $defaultValues;
					}
					$form	.= '</textarea>';
					$this->config['executeEnvironment'][$formname]	= $executeEnvironmentvalue;
					break;
				}
				case 'select' :
				{
					$this->config['executeEnvironment'][$formname]	= $selectedValue;
					$options		= explode ( ",", $defaultValues );
					$newOptions		= "";
					foreach ( $options as $option )
					{
						$option	= $this->lang ( $option ); 
						if ( $newValue		= strstr ( $option, ":" ) )
						{
							$key	= str_replace ( $newValue, "", $option );
							$option	= substr ( $newValue, 1 );
						}
						else {
							$key	= $option;
						}
						$selected		= "";
						if ( $key == $selectedValue )
						{
							$selected		= "SELECTED";
						}
						$newOptions	.= "<option value=\"$key\" $selected>$option</option>";
					}
					$form		= "<select name=\"$formname\">$newOptions</select>";
					break;
				}
				case 'checkbox' :
				{
					if ( $selectedValue )
					{
						$form	= "<input type=\"checkbox\" name=\"$formname\" CHECKED value=\"$defaultValues\">";
						$this->config['executeEnvironment'][$formname]	= $selectedValue;
					} else {
						$form	= "<input type=\"checkbox\" name=\"$formname\" value=\"$defaultValues\">";
						$this->config['executeEnvironment'][$formname]	= $defaultValues;
					}
					break;
				}
				default :
				{
					die ( 'noform' . print_r ( $var, 1 ) );
				}
			}
			return $form;
		}
		function parseItem ( $value, $getType = false, $executecode = false )
		{
			$itemtype		= substr ( $value, 0, 1 );
			$item			= substr ( $value, 1 );
			switch ( $itemtype )
			{
				case '='	:
				{
					$return		= $item;
					break;
				}
				case '!'	:
				{
					if ( $allFunctionoptions = strstr ( $item, ':' ) ) 
					{
						$allFunctionoptions		= substr ( $allFunctionoptions, 1 );
						$functionname			= str_replace ( ":$allFunctionoptions", '', $item );
						$options				= explode ( ',', $allFunctionoptions );
						if ( is_array ( $options ) ) 
						{
							foreach ( $options as $key => $option )
							{
								$options[$key]	= $this->lang ( $option );							
							}
							$options			= "\"" . implode ( "\", \"", $options ) . "\"";
						}
						$return					= "$functionname ( \$pagenum, \$varnum, $options );";
					} else {
						$return					= "$item ( \$pagenum, \$varnum );";
					}
					if ( $executecode )
					{
						foreach ( $executecode['var'] as $varname => $varvalue )
						{
							$$varname	= $varvalue;
						}
						$return	= $this->execute ( $executecode['code'] . $return, $pagenum, $varnum );
						$return	= $return['value'];
					}
					break;
				}
				case '.'	:
				{
					$return		= implode 
					(
						"", 
						file
						(
							$this->config['system']['directories']['scriptdir'] . 
							'/externals/' . $item
						)
					);
					break;
				}
				default		:
				{
					$itemtype		= "";
					$item			= $value;
				}
			}
			if ( $getType )
			{
				$return		= $itemtype . $return;
			}
			return $return;
		}
		function _setError ( $pagenum, $varnum, $errormessage )
		{
			if ( $varnum == 0 )
			{
				$htmlname		= 'Seite ' . $pagenum;
			} else {
				$htmlname		= $this->config['pages'][$pagenum]['data'][$varnum]['htmlname'];
			}
			$errormessage		= $this->lang ( $errormessage );
			$this->config['system']['errormessage'][]['text']		= $htmlname . ": " . $errormessage;
		}
		function setErrorpage ( $pagenum )
		{
			if ( $this->config['system']['pageerror'] < $pagenum )
			{
				$this->config['system']['pageerror'] = $pagenum;
			}
		}
	}
	
?>