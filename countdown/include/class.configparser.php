<?php
class configparser
{
	function setConfig()
	{
		$settings		= $this->loadConfig();
		$this->setInstaller ( $settings );
		if ( isset ($settings['root']['pages']['page']['variable']) )
		{
			$settings['root']['pages']['page']= array ($settings['root']['pages']['page']);
		}
		$this->setTotalPages ( $settings['root']['pages']['page'] );
		$this->setAllInstallerpages ( $settings['root']['pages']['page'] );
		$this->setAllRuntimeGeneratedInstallerpages ();
		$this->setCompleteInstallerpage ( $settings['root']['pages']['installer']['onComplete'] );
		$this->setFinishOrComplete ();
		$this->setPage();
	}
	function setTotalPages ( $pages )
	{
		$this->config['system']['totalPages']	= 0;
		foreach ( $pages as $page)
		{
			$this->config['system']['totalPages']++;
		}
	}
	function setAllInstallerpages ( $pages )
	{
		$pagenum	= 0;
		foreach ( $pages as $page )
		{
			if ($this->config['system']['debug'] >= 5)
				$this->_setError($pagenum, 'setConfig', 'Set page');
			$this->setPagedataInfos($pagenum, $page);
			if ($this->config['system']['pageerror'] == -1)
			{
				$this->setFinishvalueTitle ( $this->config['system']['smarttemplate']['allPages'][$pagenum]['info'] );
				$this->setInstallerpageActive ( $pagenum );
				$this->setPagedataChecks ($pagenum, $page['check']);
				$this->setPagevariables($pagenum, $page['variable']);
				if ($this->config['system']['pageerror'] == -1)
				{
					$this->checkPageAfter($pagenum);
				}
			}
			$pagenum ++;
		}
	}
	function setFinishvalueTitle ( $pageinfo )
	{
		$this->config['setValue'][]		= array
		(
			'isTitle'		=> 1,
			'info'			=> $pageinfo
		);					
	}
	function setFinishvalue ( $valueinfo, $noDisplay )
	{
		$valueinfo['noDisplay']		= $noDisplay;
		$this->config['setValue'][]		= $valueinfo;					
	}
	function setInstallerpageActive ( $pagenum, $activate = true )
	{
		if ( $activate )
		{ 
			$this->config['system']['smarttemplate']['allPages'][$pagenum]['isActive']= 1;
		} else {
			$this->config['system']['smarttemplate']['allPages'][$pagenum]['isActive']= 0;
		}
	}
	function loadConfig()
	{
		if ($this->config['system']['debug'] >= 5)
			$this->_setError('DEBUG', 'loadConfig', 'load configfile');
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
	function setInstaller ( $settings )
	{
		if (isset ($settings['root']['pages']['installer']))
		{
			$this->setInstallerdataInfos ( $settings['root']['pages']['installer'] );
		}
		if ( isset ( $settings['root']['pages']['installer']['onComplete'] ) )
		{
			$this->setInstallerdataOnComplete ( $settings['root']['pages']['installer']['onComplete'] );
		}
		if ( isset ( $settings['root']['pages']['installer']['onFinish'] ) )
		{
			$this->setInstallerOnFinish ( $settings['root']['pages']['installer']['onFinish'] );
		}
	}
	function setInstallerdataInfos($infos)
	{
		
		if ($this->config['system']['debug'] >= 5)
			$this->_setError('DEBUG', 'setInstallerinfos', 'Set installerinfo');
		$this->config['installer']['info']		= array
		(
			'title'				=> $this->lang ( $infos['title'] ),
			'nextstring'		=> $this->lang ( $infos['nextstring'] )
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
	function setInstallerOnComplete ( $settings )
	{
		if ( !isset ( $settings['showVars'] ) )
		{
			$this->_setError ( 0, 0, 'setInstallerOnComplete showVars not set' );
		}
		if ( !isset ( $settings['string'] ) )
		{
			$this->_setError ( 0, 0, 'setInstallerOnComplete string not set' );
		}
	}
	function setInstallerOnFinish ( $settings )
	{
		if ( !isset ( $settings['title'] ) )
		{
			$this->_setError ( 0, 0, 'setInstallerOnFinish title not set' );
		}
		if ( !isset ( $settings['name'] ) )
		{
			$this->_setError ( 0, 0, 'setInstallerOnFinish name not set' );
		}
		if ( !isset ( $settings['desc'] ) )
		{
			$this->_setError ( 0, 0, 'setInstallerOnFinish desc not set' );
		}
	}
	function setInstallerOnFinishfunctions ( $functions )
	{
		if ( is_array ( $functions ) )
		{
			foreach ( $functions as $function )
			{
			}
		} else {
			$this->_setError ( 0, 0, 'setInstallerOnFinishfunctions' );
		}
	}
	function setAllRuntimeGeneratedInstallerpages ()
	{
		foreach ( $this->config['pagesToAdd'] as $pagenum => $page)
		{
			if ($this->config['system']['debug'] >= 5)
				$this->_setError($pagenum, 'setConfig', 'Set page');
			$this->setPagedataInfos($pagenum, $page);
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
					$this->checkPageAfter($pagenum);
				}
			}
		}
	}
	function setCompleteInstallerpage ( $pageinfo )
	{
		$this->config['system']['totalPages']++;
		$this->setPagedataInfos( $this->config['system']['totalPages'], $pageinfo );
	}
	function setFinishOrComplete ()
	{
		if ( $this->config['languageSet'] 
			&& $this->config['system']['pageerror'] == -1 )
		{
			$this->setInstallerpageActive ( $this->config['system']['totalPages'] );
			
			if ($_POST['_doFinish'] == 1)
			{
				if (isset ($settings['root']['pages']['installer']['finish']['action']))
				{
					$settings['root']['pages']['installer']['finish']	= array
					(
						$settings['root']['pages']['installer']['finish']
					);
				}
				if ($this->finishActions($settings['root']['pages']['installer']['finish']))
				{
					$this->setFinish($settings['root']['pages']['installer']['redirectTo']);
				}
			}
		}
	}
	function setPagedataInfos($pagenum, $settings)
	{
		if ($this->config['system']['debug'] >= 5)
			$this->_setError($pagenum, 'setPageinfos', 'Set pageinfos');
		if (!isset ($settings['title']))
		{
			$this->setErrorpage($pagenum, 'setPageinfos', 'No pagetitle');
		}
		if (!isset ($settings['name']))
		{
			$this->setErrorpage($pagenum, 'setPageinfos', 'No pagename');
		}
		if (!isset ($settings['desc']))
		{
			$this->setErrorpage($pagenum, 'setPageinfos', 'No pagedescription');
		}
		$this->config['system']['smarttemplate']['allPages'][$pagenum]	= array		(			'info' => array			(				'name'		=> $this->config['system']['installer'], 				'pagetitle'	=> $this->lang($settings['title']), 				'pagename'	=> $this->lang($settings['name']),				'pagedesc'	=> $this->lang($settings['desc']),
				'button'	=> $this->lang($settings['button']),
			),			'pagenum' => $pagenum, 			'isActive' => 0,		);
		$this->config['system']['smarttemplate']['allPages'][$pagenum]['installerlanguage']= $this->config['system']['installerlanguage'];
		if ($this->config['system']['debug'] >= 5)
			$this->_setError($pagenum, 'setPageinfos', print_r($this->config['system']['smarttemplate']['allPages'][$pagenum], 1));
	}
	function setPagedataChecks ($pagenum, $settings)
	{
		if ($this->config['system']['debug'] >= 5)
			$this->_setError($pagenum, 'setPageactions', 'Set pageactions');
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
					$this->setErrorpage($pagenum, 'setPageactions', 'No required for action');
				}
				if (!isset ($check['action']))
				{
					$this->setErrorpage($pagenum, 'setPageactions', 'No action for action?!?');
				}
				if (!isset ($check['errormessage']))
				{
					$this->setErrorpage($pagenum, 'setPageactions', 'No errormessage for action');
				}
				if ($this->config['system']['debug'] >= 3)
					$this->lang($check['errormessage']);
				$this->config['pages'][$pagenum]['action'][]= array ('required' => $check['required'], 'action' => $this->parseItem($check['action']), 'errormessage' => $check['errormessage'],);
			}
		}
	}
	function setPagevariables($pagenum, $settings)
	{
		if ($this->config['system']['debug'] >= 5)
		{
			$this->_setError($pagenum, 'DEBUG', 'Set pagevariables');
		}
		if (isset ($settings['name']))
		{
			$settings= array ($settings);
		}
		foreach ($settings as $variable)
		{
			$varcount= sizeof($this->config['pages'][$pagenum]['data']);
			if ($this->config['system']['debug'] >= 5)
				$this->_setError($pagenum, 'setConfig', 'Set variable '.$varcount);
			if (!isset ($variable['name']))
			{
				$this->setErrorpage($pagenum, $variable['name'].'('.$varcount.')', 'setPagevariables, No name for variable');
				$variable['name']= "";
			}
			if (!isset ($variable['required']))
			{
				$this->setErrorpage($pagenum, $varcount, 'setPagevariables '.$variable['name'].', No required for variable');
			}
			if (!isset ($variable['newline']))
			{
				$this->setErrorpage($pagenum, $varcount, 'setPagevariables '.$variable['name'].', No newline for variable');
			}
			if (!isset ($variable['htmlname']))
			{
				$this->setErrorpage($pagenum, $varcount, 'setPagevariables '.$variable['name'].', No htmlname for variable');
			}
			if (!isset ($variable['htmldesc']))
			{
				$this->setErrorpage($pagenum, $varcount, 'setPagevariables '.$variable['name'].', No htmldesc for variable');
			}
			if (!isset ($variable['formtype']))
			{
				$this->setErrorpage($pagenum, $varcount, 'setPagevariables '.$variable['name'].', No formtype for variable');
			}
			if (!isset ($variable['autovalue']))
			{
				$this->_setError($pagenum, $varcount, 'setPagevariables '.$variable['name'].', No autovalue for variable');
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
			$tempdefaultvalue= $this->parseItem($defaultvalue, false, $code);
			$autovalue= $this->parseItem($autovalue, false, $code);			$autovalue= $this->lang($autovalue);
			$defaultform= $this->genForm($varname, $formtype, $tempdefaultvalue, false);
			$this->config['pages'][$pagenum]['data'][$position]= array ('varname' => $variable['name'], 'htmlname' => $this->lang($htmlname), 'htmldesc' => $this->lang($htmldesc), 'newline' => $newline, 'form' => $variable['formtype'], 'formtype' => $variable['formtype'], 'defaultvalue' => $tempdefaultvalue, 'autovalue' => $autovalue,);
			if (isset ($variable['check']['required']))
			{
				$variable['check']= array ($variable['check']);
			}
			if (isset ($_POST[$varname]))
			{
				$this->config['pages'][$pagenum]['data'][$position]['checks']= $variable['check'];
				if ($this->config['system']['debug'] >= 5)
					$this->_setError($pagenum, $varcount, 'check variable = "'.$_POST[$varname].'"');
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
					$this->setErrorpage($pagenum);
					$form= $defaultform;
				}
			}
			else
			{
				if ($formtype != 'box' && $formtype != 'html')
				{
					$this->setErrorpage($pagenum);
				}
				$form= $defaultform;
			}
			$this->config['pages'][$pagenum]['data'][$position]['form']= $form;
			$this->config['hiddenValue'][]	= $hiddenValue;
			if ($formtype != 'box' && $formtype != 'html')
			{
				$noDisplay	= 0;
				
			} else {
				$noDisplay	= 1;
			}
			$this->setFinishvalue ( $hiddenValue, $noDisplay );
		}
		$this->config['system']['smarttemplate']['allPages'][$pagenum]['data']= $this->config['pages'][$pagenum]['data'];
		$this->config['system']['smarttemplate']['allPages'][$pagenum]['hiddenValue']= & $this->config['hiddenValue'];
	}
	function setPage()
	{
		$usePage= -1;
		if ($this->config['languageSet'])
		{
			if ($this->config['system']['pageerror'] == -1)
			{
				$this->config['system']['canFinish']= 1;
			}
			else
			{
				$this->config['system']['canFinish']= 0;
			}
			if (isset ($_POST['explicit_page']) && is_numeric($_POST['explicit_page']))
			{
				if ($_POST['explicit_page'] > $this->config['system']['totalPages'])
				{
					$_POST['explicit_page']= $this->config['system']['totalPages'];
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
				$tpl= $this->config['files']['installertemplate'];
			}
			else
			{
				if ($this->config['system']['canFinish'] == 1 && $usePage == -1)
				{
					if ($_POST['_doFinish'] != 1)
					{
						$tpl		= $this->config['files']['installertemplate'];
						$usePage	= $this->config['system']['totalPages'];
						$this->config['system']['smarttemplate']['setCompletepage']= 1;
						$this->config['system']['smarttemplate']['setValues']= $this->config['setValue'];
					}
					else
					{
						echo "FINISH";
						$tpl= $this->config['files']['completetemplate'];
					}
				}
				else
				{
					$tpl= $this->config['files']['installertemplate'];
					$usePage= $this->config['system']['pageerror'];
				}
			}
			$this->config['system']['smarttemplate']['allPages'][$usePage]['isCurrent']= 1;
			$this->config['system']['smarttemplate']['displayPage']= $this->config['system']['smarttemplate']['allPages'][$usePage];
			$this->tpl= new smarttemplate($tpl);
		}
		else
		{
			foreach ($this->config['system']['installerlanguages'] as $language => $text)
			{
				$this->config['system']['smarttemplate']['installerlanguages'][]= array ('language' => $language, 'text' => $text,);
			}
			$this->tpl= new smarttemplate($this->config['files']['languagetemplate']);
		}
		$this->config['system']['smarttemplate']['currentPage']		= $this->config['system']['pageerror'];
		$this->config['system']['smarttemplate']['errormessage']	= $this->config['system']['errormessage'];
		$this->config['system']['smarttemplate']['totalPages']		= sizeof($this->config['system']['smarttemplate']['allPages']);
		$this->config['system']['smarttemplate']['installerlanguage']= $this->config['system']['installerlanguage'];
		$this->config['system']['smarttemplate']['installer']= $this->config['installer']['info'];
		$this->config['system']['smarttemplate']['installer']['name']= $this->config['system']['installer'];
		$this->tpl->assign('var', $this->config['system']['smarttemplate']);
	}
	function finishActions($checks, $pagenum= 0, $varnum= 0)
	{
		$return= true;
		if ($this->config['system']['debug'] >= 5)
			$this->_setError($pagenum, 'checkVariable', "$pagenum, $varnum, $selectedValue");
		foreach ($checks as $check)
		{
			$value= "";
			$evalcode= "\$return = \$this->config['extension'] -> ".$this->parseItem($check['action']);
			if ($this->config['system']['debug'] >= 5)
				$this->_setError($pagenum, 'checkVariable', "execute $evalcode");
			$return= $this->execute($evalcode, $pagenum, $varnum);
			$value= $return['value'];
			$ok= $return['isset'];
			if ($this->config['system']['debug'] >= 3)
				$this->lang($check['errormessage']);
			if (!$ok)
			{
				if ($this->config['system']['debug'] >= 5)
					$this->_setError($pagenum, 'checkVariable', "check false");
				$return= false;
				$this->_setError($pagenum, $varnum, $check['errormessage']);
				break;
			}
			else
			{
				if ($this->config['system']['debug'] >= 5)
					$this->_setError($pagenum, 'checkVariable', "check true");
			}
		}
		return $return;
	}
	function setFinish($redirectTo)
	{
		$code= array ('code' => "\$return = \$this->config['extension']->", 'var' => array ('pagenum' => 0, 'varnum' => 0));
		$return= $this->parseItem($redirectTo, false, $code);
		$this->config['installer']['info']['redirectTo']= $this->config['system']['smarttemplate']['installer']['redirectTo']= $return;
	}
}
?>