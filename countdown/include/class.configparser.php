<?
	class configparser {
		function setConfig ()
		{
			$settings		= $this->loadConfig ();
			$this->setInstallerinfos ( $settings );
			$pagenum	= 0;
			foreach ( $settings['root']['pages']['page'] as $page )
			{
				$this->setPageinfos ( $pagenum, $page );
				if ( $this->config['system']['pageerror'] == -1 )
				{
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
		}
		function loadConfig ()
		{
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
			$this->config['pages'][$pagenum]['info']		= array
			(
				'name'			=> $this->config['system']['installer'],
				'pagetitle'		=> $this->lang ( $settings['title'] ),
				'pagename'		=> $this->lang ( $settings['name'] ),
				'pagedesc'		=> $this->lang ( $settings['desc'] ),
			);
			$this->config['system']['smarttemplate']['allPages'][$pagenum]		= array
			(
				'info'		=> $pagedata['info'],
				'pagenum'	=> $pagenum,
				'isCurrentPage'	=> 0,
			);
		}
		function setPageactions ( $pagenum, $settings )
		{
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
			if ( isset ( $settings['name'] ) )
			{
				$settings = array ( $settings );
			}
			foreach ( $settings as $variable )
			{
				$varcount		= sizeof ( $this->config['pages'][$pagenum]['data'] );
				echo $varcount;
				$required		= $variable['required'];
				$position		= $varcount;
				$canRecheck		= $variable['recheckable'];
				$newline		= $variable['newline'];
				$varname		= $variable['name'];
				$htmlname		= $variable['htmlname'];
				$form			= $variable['formtype'];
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
				$defaultform	= $this->genForm ( $varname, $form, $tempdefaultvalue, false );
				$this->config['pages'][$pagenum]['data'][$position]		= array (
					'htmlname'		=> $this->lang ( $htmlname ),
					'form'			=> strtolower ( $form ),
					'newline'		=> $newline,
					'form'			=> $form,
				);
				if ( isset ( $variable['check']['required'] ) ) {
					$variable['check']	= array ( $variable['check'] );
				}
				if ( $_POST[$varname] )
				{
					if ( $this->checkVariable ( $pagenum, $varcount, $variable['check'], $_POST[$varname] ) )
					{
						$form		= $this->genForm ( $varname, $form, $tempdefaultvalue, $_POST[$varname] );
					} else {
						$form		= $defaultform;
					}
				} else {
					echo "IN";
					$this->setErrorpage ( $pagenum );
					$form		= $defaultform;
				}
				$this->config['pages'][$pagenum]['data'][$position]		= array (
					'htmlname'		=> $this->lang ( $htmlname ),
					'form'			=> strtolower ( $form ),
					'newline'		=> $newline,
					'form'			=> $form,
				);
			}
			$this->config['system']['smarttemplate']['allPages'][$pagenum]['data']	= $this->config['pages'][$pagenum]['data']; 
		}
	}
?>