<?
	class configparser {
		function setConfig ()
		{
			$settings		= $this->loadConfig ();
			$this->setInstallerinfos ( $settings );
			$pagenum	= 0;
			foreach ( $settings['root']['pages']['page'] as $page )
			{
				if ( $this->config['system']['debug'] ) $this->_setError ( $pagenum, 'setConfig', 'Set page' );
				$this->setPageinfos ( $pagenum, $page );
				if ( $this->config['system']['pageerror'] == -1 )
				{
					$this->config['system']['smarttemplate']['allPages'][$pagenum]['isActive']	= 1;
					$this->setPageactions ( $pagenum, $page['check'] );
					$this->setPagevariables ( $pagenum, $page['variable'] );
					if ( $this->config['system']['totalPages'] < $pagenum )
					{
						$this->config['system']['totalPages']	= $pagenum;
					}
					$this->setPageAfter ( $pagenum );
				}
				$pagenum++;
			}
			$this->setPage ();
		}
		function loadConfig ()
		{
			if ( $this->config['system']['debug'] ) $this->_setError ( 'DEBUG', 'loadConfig', 'load configfile' );
			if ( !file_exists ( $this->config['files']['config'] )
				|| !is_readable ( $this->config['files']['config'] ) ) 
			{
				die ( "no configfile" );
			}
			require ( 'Config.php' );
			$conf	= new config;
			$root	= &$conf->parseConfig ( $this->config['files']['config'], 'XML' );
			if ( PEAR::isError ( $root ) ) {
			    die ( 'Error while reading configuration: ' . $root->getMessage () );
			}
			$return		= $root->toArray();
			return $return;
		}
		function setInstallerinfos ( $settings )
		{
			if ( $this->config['system']['debug'] ) $this->_setError ( 'DEBUG', 'setInstallerinfos', 'Set installerinfo' );
			if ( isset ( $settings['root']['pages']['installer'] ) )
			{
				$installer		= $settings['root']['pages']['installer'];
				$this->config['installer']['info']		= array
				(
					'title'				=> $this->lang ( $installer['title'] ),
					'nextstring'		=> $this->lang ( $installer['nextstring'] ),
					'finishstring'		=> $this->lang ( $installer['finishstring'] ),
					'finishedstring'	=> $this->lang ( $installer['finishedstring'] ),
					'redirectTo'		=> $this->lang ( $installer['redirectTo'] )
				);
				if ( isset ( $installer['finish'] ) )
				{
					if ( isset ( $installer['finish']['action'] ) )
					{
						$installer['finish']['action']	= array ( $installer['finish']['action'] );
					}
					foreach ( $installer['finish'] as $action )
					{
						$this->config['installer']['action'][]		= array ( 
							'action'			=> $action['action'],
							'required'			=> $action['required'],
							'errormessage'		=> $action['errormessage']
						);
					}
				}
			}
		}
		function setPageinfos ( $pagenum, $settings )
		{
			if ( $this->config['system']['debug'] ) $this->_setError ( $pagenum, 'setPageinfos', 'Set pageinfos' );
			$this->config['system']['smarttemplate']['allPages'][$pagenum]		= array
			(
				'info'		=> array
				(
					'name'			=> $this->config['system']['installer'],
					'pagetitle'		=> $this->lang ( $settings['title'] ),
					'pagename'		=> $this->lang ( $settings['name'] ),
					'pagedesc'		=> $this->lang ( $settings['desc'] ),
				),
				'pagenum'	=> $pagenum,
				'isActive'	=> 0,
			);
			if ( $this->config['system']['debug'] ) $this->_setError ( $pagenum, 'setPageinfos', print_r ( $this->config['system']['smarttemplate']['allPages'][$pagenum], 1 ) );
		}
		function setPageactions ( $pagenum, $settings )
		{
			if ( $this->config['system']['debug'] ) $this->_setError ( $pagenum, 'setPageactions', 'Set pageactions' );
			if ( isset ( $settings['required'] ) )
			{
				$settings		= array ( $settings );
			}
			if ( isset ( $settings )
				&& is_array ( $settings ) )
			{
				foreach ( $settings as $check )
				{
					$this->config['pages'][$pagenum]['action'][]		= array (
						'required'		=> $check['required'],
						'action'		=> $this->parseItem ( $check['action'] ),
						'errormessage'	=> $check['errormessage'],
					);
				}
			}
		}
		function setPagevariables ( $pagenum, $settings )
		{
			if ( $this->config['system']['debug'] ) { $this->_setError ( $pagenum, 'DEBUG', 'Set pagevariables' ); }
			if ( isset ( $settings['name'] ) )
			{
				$settings = array ( $settings );
			}
			foreach ( $settings as $variable )
			{
				$varcount		= sizeof ( $this->config['pages'][$pagenum]['data'] );
				if ( $this->config['system']['debug'] ) $this->_setError ( $pagenum, 'setConfig', 'Set variable ' . $varcount );
				$required		= $variable['required'];
				$position		= $varcount;
				$canRecheck		= $variable['recheckable'];
				$newline		= $variable['newline'];
				$varname		= $variable['name'];
				$htmlname		= $variable['htmlname'];
				$form			= $variable['form'];
				$formtype		= $variable['formtype'];
				if ( isset ( $_POST[$varname] ) )
				{
					$uservalue	= $_POST[$varname];
				} else {
					$uservalue	= false;
				}
				$defaultvalue	= $variable['defaultvalue'];
				if ( !isset ( $this->config['count'][$pagenum]['variables'] ) )
					$this->config['count'][$pagenum]['variables']	= false;
				if ( $position > $this->config['count'][$pagenum]['variables'] )
				{
					$this->config['count'][$pagenum]['variables']	= $position;
				}
				$code		= array (
					'code'		=> "\$return = \$this->config['extension']->",
					'var'		=> array (
						'pagenum'	=> $pagenum,
						'varnum'	=> $varnum
					)
				);			
				$tempdefaultvalue	= $this->parseItem ( $defaultvalue, false, $code );
				$defaultform	= $this->genForm ( $varname, $formtype, $tempdefaultvalue, false );
				$this->config['pages'][$pagenum]['data'][$position]		= array (
					'varname'		=> $variable['name'],
					'htmlname'		=> $this->lang ( $htmlname ),
					'newline'		=> $newline,
					'form'			=> $variable['form'],
					'formtype'		=> $variable['formtype'],
					'defaultvalue'	=> $defaultvalue,
				);
				if ( isset ( $variable['check']['required'] ) ) {
					$variable['check']	= array ( $variable['check'] );
				}
				if ( isset ( $_POST[$varname] ) )
				{
					$this->config['pages'][$pagenum]['data'][$position]['checks']	= $variable['check'];
					if ( $this->config['system']['debug'] ) $this->_setError ( $pagenum, $varcount, 'check variable = "' . $_POST[$varname] . '"' );
					if ( $this->checkVariable ( $pagenum, $varcount, $variable['check'], $_POST[$varname] ) )
					{
						$form		= $this->genForm ( $varname, $formtype, $tempdefaultvalue, $_POST[$varname] );
					} else {
						$this->setErrorpage ( $pagenum );
						$form		= $defaultform;
					}
				} else {
					if ( $formtype != 'box' && $formtype != 'html' )
					{
						$this->setErrorpage ( $pagenum );
					}
					$form		= $defaultform;
				}
				$this->config['pages'][$pagenum]['data'][$position]['form']		= $form;
			}
			$this->config['system']['smarttemplate']['allPages'][$pagenum]['data']	= $this->config['pages'][$pagenum]['data']; 
		}
		function setPage ()
		{
			$usePage = -1;
			if ( $this->config['languageSet'] )
			{
				if ( $this->config['system']['pageerror'] == -1 )
				{
					$this->config['system']['canFinish']	= 1;
				} else {
					$this->config['system']['canFinish']	= 0;
				}
				if ( isset ( $_POST['explicit_page'] )
					&& is_numeric ( $_POST['explicit_page'] ) )
				{
					if ( $_POST['explicit_page'] > $this->config['system']['totalPages'] )
					{
						$_POST['explicit_page'] = $this->config['system']['totalPages'];
					}
					if ( $_POST['explicit_page'] <= $this->config['system']['pageerror'] )
					{
						$usePage		= $_POST['explicit_page'];
					} else {
						$usePage		= $this->config['system']['pageerror'];
					}
				}
				if ( $this->config['system']['canFinish'] == 1 
					&& $usePage == -1 )
				{
					$this->tpl		= new smarttemplate ( $this->config['files']['finishtemplate'] );
				} else {
					$usePage		= $this->config['system']['pageerror'];
				}
				$this->config['system']['smarttemplate']['allPages'][$usePage]['isCurrent']	= 1;
				$this->config['system']['smarttemplate']['displayPage']	= $this->config['system']['smarttemplate']['allPages'][$usePage];
				$this->tpl		= new smarttemplate ( $this->config['files']['installertemplate'] );
			} else {
				foreach ( $this->config['system']['installerlanguages'] as $language => $text ) {
					$this->config['system']['smarttemplate']['installerlanguages'][]		= array (
						'language'		=> $language,
						'text'			=> $text,
					);
				}
				$this->tpl		= new smarttemplate ( $this->config['files']['languagetemplate'] );
			}
			$this->config['system']['smarttemplate']['currentPage']			= $this->config['system']['pageerror'];
			$this->config['system']['smarttemplate']['errormessage']		= $this->config['system']['errormessage'];
			$this->config['system']['smarttemplate']['totalPages']			= sizeof ( $this->config['system']['smarttemplate']['allPages'] );
			$this->config['system']['smarttemplate']['installerlanguage']	= $this->config['system']['installerlanguage'];
			$this->config['system']['smarttemplate']['installer']			= $this->config['installer']['info'];
			$this->config['system']['smarttemplate']['installer']['name']	= $this->config['system']['installer'];			
			$this->tpl->assign ( 'var', $this->config['system']['smarttemplate'] );
		}
	}
?>