<?php
class configparser
{
	function setConfig()
	{
		$settings= $this->loadConfig();
		$this->setInstallerinfos($settings);
		$pagenum= 0;
		if (isset ($settings['root']['pages']['page']['variable']))
		{
			$settings['root']['pages']['page']= array ($settings['root']['pages']['page']);
		}
		foreach ($settings['root']['pages']['page'] as $page)
		{
			$this->config['system']['totalPages']++;
		}
		foreach ($settings['root']['pages']['page'] as $page)
		{
			if ($this->config['system']['debug'] >= 5)
				$this->_setError($pagenum, 'setConfig', 'Set page');
			$this->setPageinfos($pagenum, $page);
			if ($this->config['system']['pageerror'] == -1)
			{
				$this->config['setValue'][]		= array
				(
					'isTitle'		=> 1,
					'info'			=> $this->config['system']['smarttemplate']['allPages'][$pagenum]['info']
				);					


				$this->config['system']['smarttemplate']['allPages'][$pagenum]['isActive']= 1;
				$this->setPageactions($pagenum, $page['check']);
				$this->setPagevariables($pagenum, $page['variable']);
				if ($this->config['system']['pageerror'] == -1)
				{
					$this->checkPageAfter($pagenum);
				}
			}
			$pagenum ++;
		}
		foreach ($this->config['pagesToAdd'] as $pagenum => $page)
		{
			if ($this->config['system']['debug'] >= 5)
				$this->_setError($pagenum, 'setConfig', 'Set page');
			$this->setPageinfos($pagenum, $page);
			if ($this->config['system']['pageerror'] == -1)
			{
				$this->config['system']['smarttemplate']['allPages'][$pagenum]['isActive']= 1;
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
			#$pagenum ++;
		}
		if ($this->config['languageSet'] && $this->config['system']['pageerror'] == -1)
		{
			if ($_POST['_doFinish'] == 1)
			{
				if (isset ($settings['root']['pages']['installer']['finish']['action']))
				{
					$settings['root']['pages']['installer']['finish']= array ($settings['root']['pages']['installer']['finish']);
				}
				if ($this->finishActions($settings['root']['pages']['installer']['finish']))
				{
					$this->setFinish($settings['root']['pages']['installer']['redirectTo']);
				}
			}
		}
		$this->setPage();
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
	function setInstallerinfos($settings)
	{
		if ($this->config['system']['debug'] >= 5)
			$this->_setError('DEBUG', 'setInstallerinfos', 'Set installerinfo');
		if (isset ($settings['root']['pages']['installer']))
		{
			$installer= $settings['root']['pages']['installer'];
			$this->config['installer']['info']		= array
			(
				'title'				=> $this->lang ( $installer['title'] ),
				'nextstring'		=> $this->lang ( $installer['nextstring'] ),
				'onComplete'			=> 
					$this->setInstallerOnComplete ( $installer['onComplete'] ),
				'onFinish'			=> 
					$this->setInstallerOnFinish ( $installer['onFinish'] ),
				#'finishstring'		=> $this->lang ( $installer['finishstring'] ),
				#'finishedstring'	=> $this->lang ( $installer['finishedstring'] ),
				'redirectTo'		=> $installer['redirectTo']
			);
			
			if (isset ($installer['finish']))
			{
				if (isset ($installer['finish']['action']))
				{
					$installer['finish']['action']= array ($installer['finish']['action']);
				}
				foreach ($installer['finish'] as $action)
				{
					if ($this->config['system']['debug'] >= 3)
						$this->lang($action['errormessage']);
					$this->config['installer']['action'][]= array ('action' => $action['action'], 'required' => $action['required'], 'errormessage' => $action['errormessage']);
				}
			}
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
		if ( !isset ( $settings['string'] ) )
		{
			$this->_setError ( 0, 0, 'setInstallerOnFinish string not set' );
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
	function setPageinfos($pagenum, $settings)
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
		$this->config['system']['smarttemplate']['allPages'][$pagenum]= array		(			'info' => array			(				'name' => $this->config['system']['installer'], 				'pagetitle' => $this->lang($settings['title']), 				'pagename' => $this->lang($settings['name']),				'pagedesc' => $this->lang($settings['desc']),			),			'pagenum' => $pagenum, 			'isActive' => 0,		);
		$this->config['system']['smarttemplate']['allPages'][$pagenum]['installerlanguage']= $this->config['system']['installerlanguage'];
		if ($this->config['system']['debug'] >= 5)
			$this->_setError($pagenum, 'setPageinfos', print_r($this->config['system']['smarttemplate']['allPages'][$pagenum], 1));
	}
	function setPageactions($pagenum, $settings)
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
			$this->config['setValue'][]		= $hiddenValue;
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
						$tpl= $this->config['files']['installertemplate'];
						$usePage= $this->config['system']['totalPages'] + 1;
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
		$this->config['system']['smarttemplate']['currentPage']= $this->config['system']['pageerror'];
		$this->config['system']['smarttemplate']['errormessage']= $this->config['system']['errormessage'];
		$this->config['system']['smarttemplate']['totalPages']= sizeof($this->config['system']['smarttemplate']['allPages']);
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