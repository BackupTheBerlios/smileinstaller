<?php
	define ( 'ERRORINFO', 0 );
	define ( 'DEBUGINFO', 5 );
class installer extends smilelog
{
	// Erstellt alle wichtigen Variablen
	function installer ( $installer, $isExtension = false )
	{
		$this->config		= array 		(			'system'			=> array
			(
				'debug'					=> 0, 				'isExtension'			=> $isExtension, 				'errormessage'			=> '', 				'installer'				=> $installer, 				'installerlanguage'		=> "", 				'largest_row'			=> 0, 				'largest_row_cached'	=> 0, 				'totalPages'			=> -1, 				'currentPage'			=> 0, 				'explicit_page'			=> 0, 				'installerlanguages'	=> array 				(					'englisch'				=> 'Please select your language', 					'deutsch'				=> 'Bitte w&auml;hlen Sie Ihre Sprache', 					'franzoesisch'			=> 'Veuillez choisir votre langue',				),				'classname'				=> preg_replace('|([^a-zA-Z0-9])|', '_', $installer ),				'pageerror'				=> -1,
				'directories'			=> array 				(					'scriptdir'				=> addslashes ( dirname ( __FILE__ ) ) 
						. '/../installer/' . $installer, 					'languagedir'			=> addslashes ( dirname ( __FILE__ ) ) 
						. '/../installer/' . $installer . '/languages',
				),
				
				// Aus der AdoDB-Supportseite (manches geht scheinbar doch nicht?)
				'supportedDatabases'	=> array
				(
					'access'		=> 'Microsoft Access',
					'ado_access'	=> 'Microsoft Access/Jet',
					'ado_mssql'		=> 'Microsoft SQL Server',
					'db2'			=> 'DB2',
					'vfp'			=> 'Microsoft Visual FoxPro',
					'fbsql'			=> 'FrontBase',
					'ibase'			=> 'Interbase <=6',
					'firebird'		=> 'Firebird',
					'borland_ibase'	=> 'Borland Interbase >=6.5',
					'informix'		=> 'Informix >=7.3',
					'informix72'	=> 'Informix <7.3',
					'ldap'			=> 'LDAP',
					'mssql'			=> 'Microsoft SQL Server >=7 (default)',
					'mssqlpo'		=> 'Microsoft SQL Server >=7 (portable)',
					'mysql'			=> 'MySQL',
					'mysqlt'		=> 'MySQL (transaction support)',
					'oci8'			=> 'Oracle 8/9',
					'oci805'		=> 'Oracle 8.0.5',
					'oci8po'		=> 'Oracle 8/9 (portable)',
					'odbc'			=> 'ODBC (generic)',
					'odbc_mssql'	=> 'ODBC MSSQL',
					'odbc_oracle'	=> 'ODBC Oracle',
					'odbtp'			=> 'odbtp (generic)',
					'odbtp_unicode'	=> 'odbtp (unicode)',
					'oracle'		=> 'Oracle 7',
					'netezza'		=> 'Netezza',
					'postgres'		=> 'PostgreSQL (generic)',
					'postgres64'	=> 'PostgreSQL 6.4',
					'postgres7'		=> 'PostgreSQL 7',
					'postgres8'		=> 'PostgreSQL 8',
					'sapdb'			=> 'SAP DB',
					'sqlanywhere'	=> 'Sybase SQL Anywhere',
					'sqlite'		=> 'SQLite',
					'sqlitepo'		=> 'SQLite (portable)',
					'sybase'		=> 'Sybase'
				),
			), 			'files'						=> array 			(				'languageitems'				=> addslashes ( dirname ( __FILE__ ) )
					. '/../installer/' . $installer . '/languages/available', 				'extension'					=> addslashes ( dirname ( __FILE__ ) )
					. '/../installer/' . $installer . '/index.php', 				'config'					=> addslashes ( dirname ( __FILE__ ) )
					. '/../installer/' . $installer . '/config.xml', 				'installertemplate'			=> addslashes ( dirname ( __FILE__ ) )
					. '/templates/installer.html', 				'languagetemplate'			=> addslashes ( dirname ( __FILE__ ) )
					. '/templates/language.html', 				'completetemplate'			=> addslashes ( dirname ( __FILE__ ) )
					. '/templates/complete.html', 				'finishtemplate'			=> addslashes ( dirname ( __FILE__ ) )
					. '/templates/finish.html',			), 			'languagelinepattern'			=> '/^' . '([^=]{1,})=(.*)' . '$/',
			'log'							=> array (),
		);
	}

	// Setzt eine Fehlermeldung ohne Fehlerseite
	function _setError ( $errortype, $pagenum, $varnum, $errormessage, $translate = true )
	{
		if ( $errortype <= $this->config['system']['debug'] )
		{
			if ( $pagenum != -1 && $varnum != -1 )
			{
				$htmlname	= "$pagenum, $varnum ";
			} else {
				$htmlname	= "---- ";
			}
			if ( $this->config['pages'][$pagenum]['data'][$varnum]['htmlname'] > "" )
			{
				$htmlname .= "(".$this->config['pages'][$pagenum]['data'][$varnum]['htmlname'].") ";
			}
			
			// Fuehrt zur Rekursivitaet wenn die Fehlermeldung nicht uebersetzbar ist.
			if ( $translate )
			{
				$errormessage		= $this->lang ( $errormessage );
			}
			return parent::log ( $htmlname . ": " . $errormessage );
		}
	}
	// Prüft ob die Installationssprache gesetzt ist
	function checkLanguagepage ()
	{
		$this->config['languageSet']	= false;
		// Wenn keine Sprache ausgewaehlt wurde
		if ( !isset ( $_POST['_installerlanguage'] ) )
		{
			return false;
		}
		// Wenn Sprachdatei/en nicht ladbar
		if ( !$this->parseLanguagefile ( $_POST['_installerlanguage'] ) )
		{
			return false;
		}
		$this->config['system']['installerlanguage']	= $_POST['_installerlanguage'];
		$this->config['languageSet']	= true;
		// Keine Seiten
		if ( !isset ( $this->config['pages'] ) )
			return false;
		// Seiten falsch angelegt
		if ( !is_array ( $this->config['pages'] ) )
			return false;
		// Jeder Seite die gewaehlte Sprache setzen
		foreach ($this->config['pages'] as $pagenum => $pagedata)
		{
			$this->config['pages'][$pagenum]['installerlanguage']= $this->config['system']['installerlanguage'];
		}
	}
	// Prueft die Aktionen einer Seite
	function checkInstallerpage ( $pagenum )
	{
		$return['isset']	= true;
		// Wenn Aktionen vorhanden
		if ( isset ( $this->config['pages'][$pagenum]['action'] ) )
		{
			// Alle durchlaufen
			foreach ( $this->config['pages'][$pagenum]['action'] as $check )
			{
				$evalcode	= "\$return = \$this->config['extension']->" . $check['action'];
				$return		= $this->execute($evalcode, $pagenum, 0);
				if ( $this->config['system']['debug'] >= 3 )
					$this->lang ( $check['errormessage'] );
				// Ween Fehler bei Aktion
				if ( !$return['isset'] )
				{
					if ( $check['required'] == 1 )
					{
						$this->setError ( $pagenum, 0, __METHOD__ . " " . $check['errormessage'] );
					} else {
						$this->_setError ( DEBUGINFO, $pagenum, 0, __METHOD__ . " " . $check['errormessage'] );
					}
				}
			}
		}
		return $return['isset'];
	}
	// Prueft die Aktionen einer Variable
	function checkVariable ( $pagenum, $varnum, $checks, $selectedValue )
	{
		$return= true;
		// Wenn Checks verfuegbar
		if ( is_array ( $checks ) )
		{
			// Wenn Variable keine "Nur-Anzeige"-Variable
			if ( $this->config['pages'][$pagenum]['data'][$varnum]['formtype'] != 'box'
				&& $this->config['pages'][$pagenum]['data'][$varnum]['formtype'] != 'html' )
			{
				$this->_setError( DEBUGINFO, $pagenum, 0, __METHOD__ . " " . "$pagenum, $varnum, $selectedValue" );
				// Alle Checks durchlaufen
				foreach ( $checks as $check )
				{
					$value		= "";
					$evalcode	= "\$return = \$this->config['extension'] -> " 
						. $this->parseItem ( $check['action'] );
					$this->_setError ( DEBUGINFO, $pagenum, $varnum, __METHOD__ . " " . "execute $evalcode" );
					$return		= $this->execute ( $evalcode, $pagenum, $varnum );
					$value		= $return['value'];
					$ok			= $return['isset'];
					if ( $this->config['system']['debug'] >= 5 )
					{
						$this->lang ( $check['errormessage'] );
					}
					// Wenn Prüfung nicht OK
					if (!$ok)
					{
						$this->_setError ( DEBUGINFO, $pagenum, $varnum, __METHOD__ . " " . "checkVariable: check false" );
						if ( $check['required'] == 1 )
						{ 
							$return		= false;
							$this		->setError ( $pagenum, $varnum, "checkVariable: " . $check['errormessage'] );
						} else {
							$this->_setError ( DEBUGINFO, $pagenum, $varnum, __METHOD__ . " " . "... but its ok" );
						}
							
						break;
					} else {
						$this->_setError ( DEBUGINFO, $pagenum, $varnum, __METHOD__ . " " . "check true");
					}
				}
			}
		}
		return $return;
	}
	function execute($evalcode, $pagenum= false, $varnum= false)
	{
		$this->evalcode= $evalcode;
		unset ($evalcode);
		foreach ($this->config['executeEnvironment'] as $varname => $varvalue)
		{
			$$varname= $varvalue;
		}
		unset ($varname, $varvalue);
		eval ($this->evalcode);
		return $return;
	}
	function executeFinishActions($checks, $pagenum= 0, $varnum= 0)
	{
		$return= true;
		$this->_setError ( DEBUGINFO, $pagenum, $varnum, __METHOD__ . " " . "$pagenum, $varnum, $selectedValue");
		foreach ($checks as $check)
		{
			$value= "";
			$evalcode= "\$return = \$this->config['extension'] -> ".$this->parseItem($check['action']);
			$this->_setError ( DEBUGINFO, $pagenum, $varnum, __METHOD__ . " " . "execute $evalcode");
			$return= $this->execute($evalcode, $pagenum, $varnum);
			$value= $return['value'];
			$ok= $return['isset'];
			if ($this->config['system']['debug'] >= 3)
				$this->lang($check['errormessage']);
			if (!$ok)
			{
				$this->_setError ( DEBUGINFO, $pagenum, $varnum, __METHOD__ . " " . "check false");
				$return		= false;
				$this->_setError( ERRORINFO, $pagenum, $varnum, __METHOD__ . " " . $check['errormessage']);
				break;
			}
			else
			{
				$this->_setError ( DEBUGINFO, $pagenum, $varnum, __METHOD__ . " " . "check true");
			}
		}
		return $return;
	}
	function genForm($formname, $formtype, $defaultValues, $selectedValue)
	{
		$selectedValue= $this->lang($selectedValue);
		switch (strtolower($formtype))
		{
			case 'box' :
				{
					$form= '<textarea readonly style="white-space: nowrap; width: 600; height: 300px">'.$defaultValues.'</textarea>';
					$this->config['executeEnvironment'][$formname]= $defaultValues;
					break;
				}
			case 'html' :
				{
					$form= $defaultValues;
					$this->config['executeEnvironment'][$formname]= $defaultValues;
					break;
				}
			case 'input' :
				{
					$form= "<input type=\"text\" name=\"$formname\" value=\"";
					if ($selectedValue)
					{
						$form .= $executeEnvironmentvalue= $selectedValue;
					}
					else
					{
						$form .= $executeEnvironmentvalue= $defaultValues;
					}
					$form .= "\">";
					$this->config['executeEnvironment'][$formname]= $executeEnvironmentvalue;
					break;
				}
			case 'password' :
				{
					$form= "<input type=\"password\" name=\"$formname\" value=\"";
					if ($selectedValue)
					{
						$form .= $executeEnvironmentvalue= $selectedValue;
					}
					else
					{
						$form .= $executeEnvironmentvalue= $defaultValues;
					}
					$form .= "\">";
					$this->config['executeEnvironment'][$formname]= $executeEnvironmentvalue;
					break;
				}
			case 'text' :
				{
					$form= "<textarea name=\"$formname\" style=\"white-space: nowrap; width: 100%; height:150px\">";
					if ($selectedValue)
					{
						$form .= $executeEnvironmentvalue= $selectedValue;
					}
					else
					{
						$form .= $executeEnvironmentvalue= $defaultValues;
					}
					$form .= '</textarea>';
					$this->config['executeEnvironment'][$formname]= $executeEnvironmentvalue;
					break;
				}
			case 'select' :
				{
					$this->config['executeEnvironment'][$formname]= $selectedValue;
					$options= explode(",", $defaultValues);
					$newOptions= "";
					foreach ($options as $option)
					{
						$option= $this->lang($option);
						if ($newValue= strstr($option, ":"))
						{
							$key= str_replace($newValue, "", $option);
							$option= substr($newValue, 1);
						}
						else
						{
							$key= $option;
						}
						$selected= "";
						if ($key == $selectedValue)
						{
							$selected= "SELECTED";
						}
						$newOptions .= "<option value=\"$key\" $selected>$option</option>";
					}
					$form= "<select name=\"$formname\">$newOptions</select>";
					break;
				}
			case 'checkbox' :
				{
					$defaultValues		= $this->lang ( $defaultValues );
					$form= "<input type=\"hidden\" name=\"$formname\" value=\"NOTSET\">";
					if ($selectedValue == $defaultValues )
					{
						$form	.= "<input type=\"checkbox\" name=\"$formname\" CHECKED value=\"$defaultValues\">";
						$this->config['executeEnvironment'][$formname]= $selectedValue;
					}
					else
					{
						$form	.= "<input type=\"checkbox\" name=\"$formname\" value=\"$defaultValues\">";
						$this->config['executeEnvironment'][$formname]= $defaultValues;
					}
					break;
				}
			default :
				{
					die('noform'.print_r($var, 1));
				}
		}
		return $form;
	}
	function getInstallerUsepage ()
	{
		$usePage		= -1;
		if ($this->config['system']['pageerror'] == -1)
		{
			$this->config['system']['canFinish']= 1;
		}
		else
		{
			$this->config['system']['canFinish']= 0;
		}
		if (isset ($_POST['explicit_page']) 
			&& is_numeric($_POST['explicit_page']))
		{
			if ($_POST['explicit_page'] > $this->config['system']['totalPages'])
			{
				$_POST['explicit_page']	= $this->config['system']['totalPages'];
			}
			if ($this->config['system']['pageerror'] == -1)
			{
				$this->config['system']['pageerror']= $_POST['explicit_page'];
			}
			if ($_POST['explicit_page'] <= $this->config['system']['pageerror'])
			{
				$usePage= $_POST['explicit_page'];
			}
			else
			{
				$usePage= $this->config['system']['pageerror'];
			}
		}
		if ($this->config['system']['canFinish'] == 1 
			&& ( $usePage == -1 || $usePage == $this->config['system']['totalPages'] ) )
		{
			if ($_POST['_doFinish'] != 1)
			{
				$usePage	= $this->config['system']['totalPages'];
				$this->config['system']['smarttemplate']['setCompletepage']= 1;
			}
			else
			{
				die ( "EXECUTEFINISHACTIONS!" );
			}
		}
		if ( $usePage == -1 )
		{
			$usePage= $this->config['system']['pageerror'];
		}
		return $usePage;
	}
	function initializeExtension()
	{
		$this->_setError ( DEBUGINFO, -1, -1, __METHOD__ . " " . $this->config['files']['extension'], false );
		require_once ( $this->config['files']['extension'] );
		$evalcode	= "\$this->config['extension'] = new " 
			. $this->config['system']['classname']
			. " ( \$this->config['system']['installer'], true );";
		eval ( $evalcode );
		$this->config['extension']->config		= &$this->config;
	}
	function go()
	{
		$this->_setError ( DEBUGINFO, -1, -1, __METHOD__ . " " . 'begin installation' );
		if ( $this->config['system']['isExtension'] )
		{
			die ( 'not an installer' );
		}
		$this->loadLanguages ();
		$this->initializeExtension ();
		$this->checkLanguagepage ();
		$return		= $this->setConfig ();
		$return		= $this->tpl->result ();
		return $return;
	}
	function lang($key)
	{
		if (!is_string($key))
		{
			$this->_setError ( DEBUGINFO, -1, -1, __METHOD__ . " " . 'not a string: ". '.print_r($key, 1).'"', false);
		}
		else
		{
			if (!preg_match('|^\[(.*)\]$|', trim($key), $result))
			{
				$return= $key;
				$this->_setError ( DEBUGINFO, -1, -1, __METHOD__ . " " . 'No languagestring "'.$return.'"', false);
			}
			else
			{
				if (!isset ($this->config['language'][$result[1]]) || $this->config['language'][$result[1]] == "")
				{
					$return= $result[1];
					$this->_setError ( DEBUGINFO, -1, -1, __METHOD__ . " " . 'No languagedefinition "'.$return.'"', false);
				}
				else
				{
					$return= $this->config['language'][$result[1]];
				}
			}
		}
		return $return;
	}
	function loadConfig ()
	{
		$this->_setError ( DEBUGINFO, -1, -1, __METHOD__ 
			. ' begin installation' );
		if (!file_exists($this->config['files']['config']) || !is_readable($this->config['files']['config']))
		{
			die("no configfile");
		}
		require ('Config.php');
		$conf= new config;
		$root= & $conf->parseConfig($this->config['files']['config'], 'XML');
		if (PEAR :: isError($root))
		{
			die('Error while reading configuration: '.$root->getMessage());
		}
		$return= $root->toArray();
		return $return;
	}
	function loadLanguages ()
	{
		$languageitems= file($this->config['files']['languageitems']);
		foreach ($languageitems as $languageitem)
		{
			$this->config['languageitems'][]= array ('itemname' => trim($languageitem));
		}
		if (isset ($_POST['setVar']))
		{
			$setVar= unserialize(urldecode($_POST['setVar']));
			if (is_array($setVar))
			{
				foreach ($setVar as $varname => $varvalue)
				{
					$this->config['system']['setVar'][$varname]= $varvalue;
				}
			}
		}
	}
	function parseItem($value, $getType= false, $executecode= false)
	{
		$itemtype= substr($value, 0, 1);
		$item= substr($value, 1);
		switch ($itemtype)
		{
			case '=' :
				{
					$return= $item;
					break;
				}
			case '!' :
				{
					if ($allFunctionoptions= strstr($item, ':'))
					{
						$allFunctionoptions= substr($allFunctionoptions, 1);
						$functionname= str_replace(":$allFunctionoptions", '', $item);
						$options= explode(',', $allFunctionoptions);
						if (is_array($options))
						{
							foreach ($options as $key => $option)
							{
								$options[$key]= $this->lang($option);
							}
							$options= "\"".implode("\", \"", $options)."\"";
						}
						$return= "$functionname ( \$pagenum, \$varnum, $options );";
					}
					else
					{
						$return= "$item ( \$pagenum, \$varnum );";
					}
					if ($executecode)
					{
						foreach ($executecode['var'] as $varname => $varvalue)
						{
							$$varname= $varvalue;
						}
						$return= $this->execute($executecode['code'].$return, $pagenum, $varnum);
						$return= $return['value'];
					}
					break;
				}
			case '.' :
				{
					$return= implode("", file($this->config['system']['directories']['scriptdir'].'/externals/'.$item));
					break;
				}
			default :
				{
					$itemtype= "";
					$item= $value;
				}
		}
		if ($getType)
		{
			$return= $itemtype.$return;
		}
		return $return;
	}
	function parseLanguagefile($language)
	{
		$return= 0;
		if (is_file($this->config['system']['directories']['languagedir'].'/'.$language.'.txt'))
		{
			$languagedata= file($this->config['system']['directories']['languagedir'].'/'.$language.'.txt');
			foreach ($languagedata as $line)
			{
				if (preg_match($this->config['languagelinepattern'], trim($line), $result))
				{
					$this->config['language'][trim($result[1])]= trim($result[2]);
				}
			}
			$return= 1;
		}
		return 1;
	}
	function setAllInstallerpages ( $pages )
	{
		$pagenum	= 0;
		foreach ( $pages as $page )
		{
			$this->_setError ( DEBUGINFO, $pagenum, 0, __METHOD__ . " " . 'Set page' );
			$this->setInstallerpageDataInfos ( $pagenum, $page );
			if ( $this->config['system']['pageerror'] == -1 )
			{
				$this->setFinishvalueTitle ( $this->config['system']['smarttemplate']['allPages'][$pagenum]['info'] );
				$this->setInstallerpageDataActive ( $pagenum );
				$this->setInstallerpageDataChecks ( $pagenum, $page['check'] );
				$this->setInstallerpageDataVariables ( $pagenum, $page['variable'] );
				if ( $this->config['system']['pageerror'] == -1 )
				{
					$this->checkInstallerpage ( $pagenum );
				}
			}
			$pagenum ++;
		}
	}
	function setAllRuntimeGeneratedInstallerpages ()
	{
		foreach ( $this->config['pagesToAdd'] as $pagenum => $page)
		{
			$this->_setError ( DEBUGINFO, $pagenum, 0, __METHOD__ . " " . 'Set runtimepage');
			$this->setInstallerpageDataInfos($pagenum, $page);
			if ($this->config['system']['pageerror'] == -1)
			{
				$this->setInstallerpageActive ( $pagenum );
				foreach ( $page['check'] as $checknum => $check )
				{
					if ( is_array ( $check['option'] ) )
					{
						$options	= ':' . implode ( ',', $check['option'] );
					} else {
						$options	= "";
					}
					$page['check'][$checknum]	= array (
						'action'		=> $check['action'] . $options,
						'required'		=> $check['required'],
						'errormessage'	=> $check['errormessage']
					);
				}
				$this->setPageactions($pagenum, $page['check']);
				
				$this->setPagevariables($pagenum, $page['variable']);
				if ($this->config['system']['totalPages'] < $pagenum)
				{
					$this->config['system']['totalPages']= $pagenum;
				}
				if ($this->config['system']['pageerror'] == -1)
				{
					$this->checkInstallerpage($pagenum);
				}
			}
		}
	}
	function setConfig()
	{
		$settings		= $this->loadConfig();
		$this->setInstallerdata ( $settings['root']['pages']['installer'] );
		if ( isset ($settings['root']['pages']['installer']['page']['variable']) )
		{
			$settings['root']['pages']['installer']['page']= array ($settings['root']['pages']['installer']['page']);
		}
		$this->setTotalPages ( $settings['root']['pages']['installer']['page'] );
		$this->setAllInstallerpages ( $settings['root']['pages']['installer']['page'] );
		$this->setAllRuntimeGeneratedInstallerpages ();
		$this->setInstallerpageComplete ( $settings['root']['pages']['installer']['onComplete'] );
		$this->setFinishOrComplete ();
		$this->setHTMLPage();
	}
	function setError ( $pagenum, $varnum= false, $errormessage= false )
	{
		if ($this->config['system']['pageerror'] < $pagenum)
		{
			$this->config['system']['pageerror']= $pagenum;
		}
		if ($errormessage || $varnum)
		{
			return $this->_setError ( ERRORINFO, $pagenum, $varnum, $errormessage);
		}
	}
	function setFinish($redirectTo)
	{
		$code= array ('code' => "\$return = \$this->config['extension']->", 'var' => array ('pagenum' => 0, 'varnum' => 0));
		$return= $this->parseItem($redirectTo, false, $code);
		$this->config['installer']['info']['redirectTo']= $this->config['system']['smarttemplate']['installer']['redirectTo']= $return;
	}
	function setFinishOrComplete ()
	{
		if ( $this->config['languageSet'] 
			&& $this->config['system']['pageerror'] == -1 )
		{
			$this->setInstallerpageDataActive ( $this->config['system']['totalPages'] );
			
			if ($_POST['_doFinish'] == 1)
			{
				if (isset ($settings['root']['pages']['installer']['finish']['action']))
				{
					$settings['root']['pages']['installer']['finish']	= array
					(
						$settings['root']['pages']['installer']['finish']
					);
				}
				if ($this->executeFinishActions($settings['root']['pages']['installer']['finish']))
				{
					$this->setFinish($settings['root']['pages']['installer']['redirectTo']);
				}
			}
		}
	}
	function setFinishvalue ( $valueinfo, $noDisplay )
	{
		$valueinfo['noDisplay']		= $noDisplay;
		$this->config['setValue'][]		= $valueinfo;					
	}
	function setFinishvalueTitle ( $pageinfo )
	{
		$this->config['setValue'][]		= array
		(
			'isTitle'		=> 1,
			'info'			=> $pageinfo
		);					
	}
	function setHiddenValue ( $pagenum, $hiddenValue )
	{
		$this->config['hiddenValue'][$pagenum][]	= $hiddenValue;
	}
	function setInstallerpageComplete ( $pageinfo )
	{
		#$this->config['system']['totalPages']++;
		$this->setInstallerpageDataInfos( $this->config['system']['totalPages'], $pageinfo );
	}
	function setInstallerpageDataActive ( $pagenum, $activate = true )
	{
		if ( $activate )
		{ 
			$this->config['system']['smarttemplate']['allPages'][$pagenum]['isActive']= 1;
		} else {
			$this->config['system']['smarttemplate']['allPages'][$pagenum]['isActive']= 0;
		}
	}
	function setInstallerpageDataInfos ( $pagenum, $settings )
	{
		$this->_setError ( DEBUGINFO, $pagenum, 0, __METHOD__ . " " . 'Set pageinfos');
		if ( !isset ($settings['title'] ) )
		{
			$this->setError ( $pagenum, 0, __METHOD__ . " " . 'No pagetitle' );
		}
		if ( !isset ( $settings['name'] ) )
		{
			$this->setError ( $pagenum, 0, __METHOD__ . " " . 'No pagename' );
		}
		if ( !isset ( $settings['desc'] ) )
		{
			$this->setError ( $pagenum, 0, __METHOD__ . " " . 'No pagedescription');
		}
		$this->config['system']['smarttemplate']['allPages'][$pagenum]	= array
		(
			'info' => array
			(
				'name'		=> $this->config['system']['installer'], 
				'pagetitle'	=> $this->lang($settings['title']), 
				'pagename'	=> $this->lang($settings['name']),
				'pagedesc'	=> $this->lang($settings['desc']),
				'button'	=> $this->lang($settings['button']),
			),
			'pagenum' => $pagenum, 
			'isActive' => 0,
		);
		$this->config['system']['smarttemplate']['allPages'][$pagenum]['installerlanguage']= $this->config['system']['installerlanguage'];
		$this->_setError ( DEBUGINFO, $pagenum, 0, __METHOD__ . " " . print_r($this->config['system']['smarttemplate']['allPages'][$pagenum], 1));
	}
	function setInstallerpageDataChecks ( $pagenum, $settings )
	{
		$this->_setError ( DEBUGINFO, $pagenum, 0, __METHOD__ . " " . 'Set pageactions');
		if (isset ($settings['required']))
		{
			$settings= array ($settings);
		}
		if (isset ($settings) && is_array($settings))
		{
			foreach ($settings as $check)
			{
				if (!isset ($check['required']))
				{
					$this->setError ( $pagenum, 0, __METHOD__ . " " . 'No required for action');
				}
				if (!isset ($check['action']))
				{
					$this->setError ( $pagenum, 0, __METHOD__ . " " . 'No action for action?!?');
				}
				if (!isset ($check['errormessage']))
				{
					$this->setError ( $pagenum, 0, __METHOD__ . " " . 'No errormessage for action');
				}
				if ($this->config['system']['debug'] >= 3)
					$this->lang($check['errormessage']);
				$this->config['pages'][$pagenum]['action'][]= array ('required' => $check['required'], 'action' => $this->parseItem($check['action']), 'errormessage' => $check['errormessage'],);
			}
		}
	}
	function setInstallerpageDataVariables ( $pagenum, $settings )
	{
		$this->_setError ( DEBUGINFO, $pagenum, 0, __METHOD__ . " " . 'Set pagevariables');
		if (isset ($settings['name']))
		{
			$settings= array ($settings);
		}
		foreach ($settings as $variable)
		{
			$varcount= sizeof($this->config['pages'][$pagenum]['data']);
			$this->_setError ( DEBUGINFO, $pagenum, 0, __METHOD__ . " " . 'Set variable '.$varcount);
			if (!isset ($variable['name']))
			{
				$this->setError ( $pagenum, 0, __METHOD__ . " " . 'No name for variable ' . $variable['varname'] );
				$variable['name']= "";
			}
			if ( !isset ($variable['required'] ) )
			{
				$this->setError ( $pagenum, $varcount, __METHOD__ . " " . 'No required for variable ' . $variable['varname'] );
			}
			if (!isset ($variable['newline']))
			{
				$this->setError ( $pagenum, $varcount, __METHOD__ . " " . 'No newline for variable ' . $variable['varname'] );
			}
			if (!isset ($variable['htmlname']))
			{
				$this->setError ( $pagenum, $varcount, __METHOD__ . " " . 'No htmlname for variable ' . $variable['varname'] );
			}
			if (!isset ($variable['htmldesc']))
			{
				$this->setError ( $pagenum, $varcount, __METHOD__ . " " . 'No htmldesc for variable ' . $variable['varname'] );
			}
			if (!isset ($variable['formtype']))
			{
				$this->setError ( $pagenum, $varcount, __METHOD__ . " " . 'No formtype for variable ' . $variable['varname'] );
			}
			if (!isset ($variable['autovalue']))
			{
				$this->_setError ( ERRORINFO, $pagenum, $varcount, __METHOD__ . " " . 'No autovalue for variable ' . $variable['varname'] );
			}
			$required= $variable['required'];
			$position= $varcount;
			$newline= $variable['newline'];
			$varname= $variable['name'];
			$htmlname= $variable['htmlname'];
			$htmldesc= $variable['htmldesc'];
			$formtype= $variable['formtype'];
			if (isset ($_POST[$varname]))
			{
				$uservalue= $_POST[$varname];
			}
			else
			{
				$uservalue= false;
			}
			$defaultvalue= $variable['defaultvalue'];
			$autovalue= $variable['autovalue'];
			if (!isset ($this->config['count'][$pagenum]['variables']))
				$this->config['count'][$pagenum]['variables']= false;
			if ($position > $this->config['count'][$pagenum]['variables'])
			{
				$this->config['count'][$pagenum]['variables']= $position;
			}
			$code= array ('code' => "\$return = \$this->config['extension']->", 'var' => array ('pagenum' => $pagenum, 'varnum' => $varnum));
			$tempdefaultvalue= $this->parseItem ( $defaultvalue, false, $code );
			$autovalue= $this->parseItem($autovalue, false, $code);
			$autovalue= $this->lang($autovalue);
			$defaultform= $this->genForm($varname, $formtype, $tempdefaultvalue, false);
			$this->config['pages'][$pagenum]['data'][$position]= array ('varname' => $variable['name'], 'htmlname' => $this->lang($htmlname), 'htmldesc' => $this->lang($htmldesc), 'newline' => $newline, 'form' => $variable['formtype'], 'formtype' => $variable['formtype'], 'defaultvalue' => $tempdefaultvalue, 'autovalue' => $autovalue,);
			if (isset ($variable['check']['required']))
			{
				$variable['check']= array ($variable['check']);
			}
			if (isset ($_POST[$varname]))
			{
				$this->config['pages'][$pagenum]['data'][$position]['checks']= $variable['check'];
				$this->_setError ( DEBUGINFO, $pagenum, $varcount, __METHOD__ . " " . 'check variable = "'.$_POST[$varname].'"');
				if ($this->checkVariable($pagenum, $varcount, $variable['check'], $_POST[$varname]))
				{
					if ($formtype == 'box' || $formtype == 'html')
					{
						$hiddenValue	= array
						(
							'htmlname'	=> $this->lang($htmlname),
							'htmldesc'	=> $this->lang($htmldesc),
							'varname'	=> $varname,
							'varvalue' => ''
						);
					}
					else
					{
						$hiddenValue	= array 
						(
							'htmlname' => $this->lang($htmlname), 
							'htmldesc' => $this->lang($htmldesc), 
							'varname' => $varname, 
							'varvalue' => $_POST[$varname]
						);
					}
					$form= $this->genForm($varname, $formtype, $tempdefaultvalue, $_POST[$varname]);
				}
				else
				{
					$this->setError ( $pagenum, $varcount, __METHOD__ . " " . 'checks failed for ' . $varname );
					$form= $defaultform;
				}

				$this->setHiddenValue ( $pagenum, $hiddenValue );
			}
			else
			{
				if ($formtype != 'box' && $formtype != 'html')
				{
					$this->_setError ( DEBUGINFO, $pagenum, $varcount, __METHOD__ . " " . 'not posted ' . $varname );
				}
				$form= $defaultform;
			}
			$this->config['pages'][$pagenum]['data'][$position]['form']= $form;
			if ($formtype != 'box' && $formtype != 'html')
			{
				$noDisplay	= 0;
				
			} else {
				$noDisplay	= 1;
			}
			$this->setFinishvalue ( $hiddenValue, $noDisplay );
		}
		$this->config['system']['smarttemplate']['allPages'][$pagenum]['data']= $this->config['pages'][$pagenum]['data'];
	}
	function setInstallerdata ( $installer )
	{
		if (isset ($installer))
		{
			$this->setInstallerdataInfos ( $installer );
		}
		if ( isset ( $installer['onComplete'] ) )
		{
			$this->setInstallerdataOnComplete ( $installer['onComplete'] );
		}
		if ( isset ( $installer['onFinish'] ) )
		{
			$this->setInstallerdataOnFinish ( $installer['onFinish'] );
		}
	}
	function setInstallerdataInfos ( $infos )
	{
		
		$this->_setError ( DEBUGINFO, -1, -1, __METHOD__ . " " . 'Set installerinfo');
		$this->config['installer']['info']		= array
		(
			'title'				=> $this->lang ( $infos['title'] ),
			'nextstring'		=> $this->lang ( $infos['nextbutton'] )
		);
	}
	function setInstallerdataOnComplete ( $actions )
	{
		if ( isset ( $actions['action'] ) )
		{
			$actions		= array ( $actions );
		}
		foreach ($actions as $action)
		{
			$this->config['installer']['action'][]= array
			(
				'action' => $action['action'], 
				'required' => $action['required'],
				'errormessage' => $action['errormessage']
			);
		}
	}
	function setInstallerdataOnFinish ( $settings )
	{
		if ( !isset ( $settings['title'] ) )
		{
			$this->_setError ( ERRORINFO , -1, -1, __METHOD__ . " " . 'title not set' );
		}
		if ( !isset ( $settings['name'] ) )
		{
			$this->_setError ( ERRORINFO, -1, -1, __METHOD__ . " " . 'name not set' );
		}
		if ( !isset ( $settings['desc'] ) )
		{
			$this->_setError ( ERRORINFO, -1, -1, __METHOD__ . " " . 'desc not set' );
		}
		if ( isset ( $settings['check'] ) )
		{
			$this->setInstallerdataOnFinishActionCheck ( $settings['check'] );
		}
		if ( isset ( $settings['value'] ) )
		{
			$this->setInstallerdataOnFinishActionValue ( $settings['value'] );
		}
		if ( isset ( $settings['output'] ) )
		{
			$this->setInstallerdataOnFinishActionOutput ( $settings['output'] );
		}
	}
	function setInstallerdataOnFinishActionCheck ( $functions )
	{
		if ( is_array ( $functions ) )
		{
			foreach ( $functions as $function )
			{
				#echo "IN";
			}
		} else {
			$this->_setError ( ERRORINFO, -1, -1, __METHOD__ . " " . 'no finishactions for check' );
		}
	}
	function setInstallerdataOnFinishActionOutput ( $functions )
	{
		if ( is_array ( $functions ) )
		{
			foreach ( $functions as $function )
			{
				#echo "IN";
			}
		} else {
			$this->_setError ( ERRORINFO, -1, -1, __METHOD__ . " " . 'no finishactions for output' );
		}
	}
	function setInstallerdataOnFinishActionValue ( $functions )
	{
		if ( is_array ( $functions ) )
		{
			foreach ( $functions as $function )
			{
				#echo "IN";
			}
		} else {
			$this->_setError ( ERRORINFO, -1, -1, __METHOD__ . " " . 'no finishactions for value' );
		}
	}
	function setHTMLPage()
	{
		$usePage= -1;
		if ($this->config['languageSet'])
		{
			$usePage		= $this->getInstallerUsepage (); 
			$tpl= $this->config['files']['installertemplate'];
			$this->config['system']['smarttemplate']['allPages'][$usePage]['isCurrent']= 1;
			$this->config['system']['smarttemplate']['displayPage']= $this->config['system']['smarttemplate']['allPages'][$usePage];
			$this->tpl= new smarttemplate($tpl);
			$this->config['system']['smarttemplate']['setValues']= $this->config['setValue'];
			for ( $i = 0; $i <= $this->config['system']['totalPages']; $i++ )
			{
				for ( $j = 0; $j <= $this->config['system']['totalPages']; $j++ )
				{
					foreach ( $this->config['hiddenValue'][$j] as $hiddenValue )
					{
						$this->config['system']['smarttemplate']['allPages'][$i]['hiddenValue'][]	= $hiddenValue;
						if ( $j != $i && $usePage == $i && $usePage < $this->config['system']['totalPages'] )
						{
							$this->config['system']['smarttemplate']['displayPage']['hiddenValue'][]	= $hiddenValue;
						}
					}
				}
			}

		}
		else
		{
			foreach ($this->config['system']['installerlanguages'] as $language => $text)
			{
				$this->config['system']['smarttemplate']['installerlanguages'][]= array
				(
					'language' => $language,
					'text' => $text
				);
			}
			$this->tpl= new smarttemplate($this->config['files']['languagetemplate']);
		}
		$this->config['system']['smarttemplate']['allPages'][$usePage]['isActive']	= 2;
		$this->config['system']['smarttemplate']['currentPage']		= $this->config['system']['pageerror'];
		$this->config['system']['smarttemplate']['errormessage']	= parent::getLogHTML ();#$this->config['system']['errormessage'];
		$this->config['system']['smarttemplate']['totalPages']		= sizeof($this->config['system']['smarttemplate']['allPages']);
		$this->config['system']['smarttemplate']['installerlanguage']= $this->config['system']['installerlanguage'];
		$this->config['system']['smarttemplate']['installer']= $this->config['installer']['info'];
		$this->config['system']['smarttemplate']['installer']['name']= $this->config['system']['installer'];
		$this->tpl->assign('var', $this->config['system']['smarttemplate']);
	}
	function setTotalPages ( $pages )
	{
		$this->config['system']['totalPages']	= 0;
		foreach ( $pages as $page)
		{
			$this->config['system']['totalPages']++;
		}
	}
}
?>