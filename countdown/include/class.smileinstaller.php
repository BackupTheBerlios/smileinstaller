<?
	class installer extends smileinstaller_variable {
		function installer ( $installer, $isExtension = false )
		{ 
			$this->config			= array (
				'system'				=> array (
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
					'pageerror'				=> 0,
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
			if ( $this->config['system']['isExtension'] )
				die ( 'not an installer' );
			$this->loadLanguageitems ();
			$this->initializeExtension ();
			$this->checkLanguagepage ();
			$this->setConfig ();
			$this->setPages ();
			$abortFinish	= $this->checkExplicitPage ();
			if ( $this->checkFinishPage ( $abortFinish ) == 1 )
			{
				$this->doFinish ();
			}
			$this->setForSmarttemplate ();
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
		function setPages ()
		{
			foreach ( $this->config['pages'] as $pagenum => $pagedata )
			{
				foreach ( $this->config['pages'][$pagenum]['data'] as $varnum => $var )
				{
					$this->setVariable ( $pagenum, $varnum );
				}
				if ( (int)$this->config['system']['pageerror'] > (int)0 )
				{
					if ( $this->config['system']['pageerror'] >= $pagenum )
					{
						$this->unsetPage ( $pagenum );
						break;
					}
				}
				if ( !$this->setPageAfter ( $pagenum ) )
				{
					break;
				}
			}
			if ( $this->config['system']['pageerror'] > 0 )
			{
				for ( $i =  $this->config['system']['pageerror']; $i <=  $this->config['system']['totalPages']; $i++ )
				{
					$this->unsetPage ( $i );
				}
			}
		}
		function setPageAfter ( $pagenum )
		{
			$return['isset']	= true;
			if ( isset ( $this->config['pages'][$pagenum]['action'] ) )
			{
				foreach ( $this->config['pages'][$pagenum]['action'] as $check )
				{
					$evalcode	= "\$return = \$this->config['extension']->" . substr ( $check['action'], 1 );
					$return		= $this->executePageenvironment ( $evalcode, $pagenum, 0 );
					if ( !$return['isset'] )
					{
						$this->_setError ( $pagenum, 0, $check['errormessage'] );
						if ( $this->config['system']['pageerror'] == 0 
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
		function checkFinishpage ( $abortFinish )
		{
			$this->config['system']['dofinish']		= 0;					
			if ( $this->config['system']['pageerror'] == 0 )
			{
				$this->config['system']['finishpage']		= $this->config['system']['totalPages'] - 1;
				if ( !$abortFinish )
				{
					$this->config['system']['dofinish']		= 1;
					$this->config['system']['currentPage']	= $this->config['system']['totalPages'] + 1;
				}
			} else {
				$this->config['system']['finishpage']		= 0;
			}
			return $this->config['system']['dofinish'];
		}
		function setForm ( $var, $value, $isset, $uneditable )
		{
			if ( $uneditable )
			{
				$disabled	= "DISABLED";
			} else {
				$disabled	= "";
			}
			$defaultvalue	= $this->lang ( $var['defaultvalue'] );
			switch ( strtolower ( $var['form'] ) )
			{
				case 'box' :
				{
					$form	= '<textarea readonly style="width: 100%; height: 200px">' .
						$defaultvalue .
						'</textarea>';
					$this->config['executeEnvironment'][$var['varname']]	= $defaultvalue;
					break;
				}
				case 'html' :
				{
					$form	= $defaultvalue;
					$this->config['executeEnvironment'][$var['varname']]	= $defaultvalue;
					break;
				}
				case 'input' :
				{
					$form		= '<input ' . $disabled . ' type="text" name="' . 
						$var['varname'] . '" value="';
					if ( $isset )
					{
						$form	.= $executeEnvironmentvalue	= $value;
					} else {
						$form	.= $executeEnvironmentvalue	= $defaultvalue;
					}
					$form	.= '">';
					$this->config['executeEnvironment'][$var['varname']]	= $executeEnvironmentvalue;
					break;
				}
				case 'password' :
				{
					$form		= '<input ' . $disabled . ' type="password" name="' . 
						$var['varname'] . '" value="';
					if ( $isset )
					{
						$form	.= $executeEnvironmentvalue	= $value;
					} else {
						$form	.= $executeEnvironmentvalue	= $defaultvalue;
					}
					$form	.= '">';
					$this->config['executeEnvironment'][$var['varname']]	= $executeEnvironmentvalue;
					break;
				}
				case 'text' :
				{
					$form	= '<textarea ' . $disabled . ' name="' . $var['varname'] . 
						'" style="width: 100%; height:150px">';
					if ( $isset )
					{
						$form	.= $executeEnvironmentvalue	= $value;
					} else {
						$form	.= $executeEnvironmentvalue	= $defaultvalue;
					}
					$form	.= '</textarea>';
					$this->config['executeEnvironment'][$var['varname']]	= $executeEnvironmentvalue;
					break;
				}
				case 'select' :
				{
					$this->config['executeEnvironment'][$var['varname']]	= $value;
					$options		= explode ( ",", $var['defaultvalue'] );
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
						if ( $isset ) {
							if ( $key == $value )
							{
								$selected		= "SELECTED";
							}
						}
						$newOptions	.= "<option value=\"$key\" $selected>$option</option>";
					}
					$form		= "<select $disabled name=\"" . $var['varname'] . "\">$newOptions</select>";
					break;
				}
				case 'checkbox' :
				{
					if ( $isset )
					{
						$form	= '<input type="checkbox" name="' . $var['varname'] . '" CHECKED value="' . $value . '">';
						$this->config['executeEnvironment'][$var['varname']]	= $value;
					} else {
						$form	= '<input type="checkbox" name="' . $var['varname'] . '" value="' . $defaultvalue . '">';
						$this->config['executeEnvironment'][$var['varname']]	= $defaultvalue;
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
			echo "Item to parse :<b>" . htmlentities ( $value ) . "</b><br>";
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
			echo htmlentities ( $return ) . "<br>";
			return $return;
		}
		function checkExplicitPage ()
		{
			$return		= false;
			if ( isset ( $_POST['explicit_page'] )
			&& $_POST['explicit_page'] > 0
			&& $_POST['explicit_page'] <= $this->config['system']['totalPages'] )
			{
				$return		= true;
				if ( $this->config['system']['pageerror'] > 0 )
				{
					if ( $_POST['explicit_page'] <= $this->config['system']['pageerror'] )
					{
						$this->config['currentPage']			= $this->config['pages'][$_POST['explicit_page']];
						$this->config['system']['currentPage']	= $_POST['explicit_page'];
					} else {
						$this->config['currentPage']			= $this->config['pages'][$this->config['system']['pageerror']];
					$this->config['system']['currentPage']		= $this->config['system']['pageerror'];
					}
				} else {
					$this->config['currentPage']				= $this->config['pages'][$_POST['explicit_page']];
					$this->config['system']['currentPage']		= $_POST['explicit_page'];
				}
			} else {
				if ( $this->config['system']['pageerror'] > 0 )
				{
					$this->config['currentPage']				= $this->config['pages'][$this->config['system']['pageerror']];
					$this->config['system']['currentPage']		= $this->config['system']['pageerror'];
				} else {
					$this->config['currentPage']				= $this->config['pages'][$this->config['system']['totalPages']];
					$this->config['system']['currentPage']		= $this->config['system']['totalPages'];
				}
			}
			return $return;
		}
		function setForSmarttemplate ()
		{
			if ( $this->config['languageSet'] )
			{
				$hiddenValue[]	= array (
					'varname'	=> 'setVar',
					'varvalue'	=> urlencode ( serialize ( $this->config['system']['setVar'] ) )
				);
				foreach ( $this->config['hiddenValue'] as $varname => $vardata )
				{
					$hiddenValue[]		= array (
						'varname'		=> $varname,
						'varvalue'		=> $vardata['varvalue']
					);
				}
				$currentPage		= 0;
				ksort ( $this->config['pages'] );
				reset ( $this->config['pages'] );
				while ( list ( $pagedatakey, $pagedata ) = each ( $this->config['pages'] ) ) {
					$page[$currentPage]['currentPage']		= $this->config['system']['currentPage']-1;
					$page[$currentPage]['info']		= $pagedata['info'];
					$page[$currentPage]['pagenum']	= $currentPage+1;
					if ( isset ( $pagedata['data'] ) && is_array ( $pagedata['data'] ) )
					{
						ksort ( $pagedata['data'] );
						reset ( $pagedata['data'] );
						$currentPosition		= 0;
						while ( list ( $vardatakey, $vardata ) = each ( $pagedata['data'] ) )
						{
							$page[$currentPage]['data'][$currentPosition]		= $vardata;
							$currentPosition++;
						}
					}
					$page[$currentPage]['hiddenValue']		= $hiddenValue;
					if ( $page[$currentPage]['currentPage'] == $currentPage )
					{
						$page[$currentPage]['isCurrentPage']		 = 1;
						$this->config['system']['smarttemplate']['displayPage']		= $page[$currentPage];
						unset ( $this->config['system']['smarttemplate']['displayPage']['currentPage'] );
					} else {
						$page[$currentPage]['isCurrentPage']		 = 0;
					}
					
					if ( $currentPage <= $this->config['system']['pageerror']-1 
						|| $this->config['system']['pageerror'] == 0 
					)
					{
						$page[$currentPage]['isActive']		= 1;
					} else {
						$page[$currentPage]['isActive']		= 0;
					}
					$page[$currentPage]['installerlanguage']		= $this->config['system']['installerlanguage'];
					$currentPage++;
				}
				$this->config['system']['smarttemplate']['allPages']			= $page;
				$this->config['system']['smarttemplate']['errormessage']		= $this->config['system']['errormessage'];
				$this->config['system']['smarttemplate']['totalPages']			= $this->config['system']['totalPages'];
				$this->config['system']['smarttemplate']['installerlanguage']	= $this->config['system']['installerlanguage'];
				$this->config['system']['smarttemplate']['currentPage']			= $this->config['system']['currentPage']-1;
				if ( $this->config['finishSet'] )
				{
					$this->tpl		= new smarttemplate ( $this->config['files']['finishtemplate'] );
				} else {
					$this->tpl		= new smarttemplate ( $this->config['files']['installertemplate'] );
				}
			} else {
				foreach ( $this->config['system']['installerlanguages'] as $language => $text ) {
					$this->config['system']['smarttemplate']['installerlanguages'][]		= array (
						'language'		=> $language,
						'text'			=> $text,
					);
				}
				$this->tpl		= new smarttemplate ( $this->config['files']['languagetemplate'] );
			}
			$this->config['system']['smarttemplate']['installer']				= $this->config['installer']['info'];
			$this->config['system']['smarttemplate']['installer']['name']		= $this->config['system']['installer'];			
			$this->tpl->assign ( 'var', $this->config['system']['smarttemplate'] );
			
		}
		function setDefaultValue ( $pagenum, $varnum )
		{
			$var		= $this->config['pages'][$pagenum]['data'][$varnum];
			$return		= "";
			$code		= array (
				'code'		=> "\$return = \$this->config['extension']->",
				'var'		=> array (
					'pagenum'	=> $pagenum,
					'varnum'	=> $varnum
				)
			);			
			$return		= $this->parseItem ( $var['defaultvalue'], false, $code );
			if ( isset ( $return['isset'] ) )
			{
				$return		= $return['value'];
			}
			$this->config['pages'][$pagenum]['data'][$varnum]['defaultvalue'] = $return;
			return $return;
		}
		function setAnyValue ( $value, $pagenum, $varnum )
		{
			switch ( substr ( $value, 0, 1 ) )
			{
				case '<' :
				{
					$evalcode		= "\$return = \$this->config['extension']->" . 
						$this->parseItem ( substr ( $value, 1 ) );
					$return	= $this->executeEnvironment ( $evalcode, $pagenum, $varnum );
					break;
				}
				case '=' :
				{
					$return	= substr ( $var['defaultvalue'], 1 );
					break;
				}
				case '.' :
				{
					$return	= trim ( implode ( "", file ( 
						$this->config['system']['directories']['scriptdir'] . 
						'/files/' . substr ( $value, 1 ) 
					) ) );
					break;
				}
				default :
				{
					die ( 'no useable value ' . htmlentities ( $var['defaultvalue'] ) );
					break;
				}
			}
			return $return;
		}
		function doFinish ()
		{
			
			foreach ( $this->config['installer']['action'] as $action )
			{
				$action['action']		= substr ( $action['action'], 1 );
				$evalcode	= "\$return = \$this->config['extension']->" . $this->parseItem ( $action['action'] );
				$return		= $this->executeFinishenvironment ( $evalcode );
				if ( !$return['isset'] )
				{
					$this->_setError ( $action['errormessage'] );
					break;
				}
			}
			$this->config['finishSet']	= $return['isset'];
			if ( $return['isset'] )
			{
				$action		= substr ( $this->config['installer']['info']['redirectTo'], 1 );
				$evalcode	= "\$return = \$this->config['extension']->" . $this->parseItem ( $action );
				$return		= $this->executeFinishenvironment ( $evalcode );
				$this->config['installer']['info']['redirectTo']		= $return['value'];
			}
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
	}
?>