<?
	class configparser {
		function parseConfig ()
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
			$settings	= $root->toArray();
			$this->setInstallerinfos ( $settings );
			$pagenum	= 1;
			foreach ( $settings['root']['pages']['page'] as $page )
			{
				$this->config['pages'][$pagenum]['info']['pagetitle']		= $this->lang ( $page['title'] );
				$this->config['pages'][$pagenum]['info']['pagename']		= $this->lang ( $page['name'] );
				$this->config['pages'][$pagenum]['info']['pagedesc']		= $this->lang ( $page['desc'] );
				if ( isset ( $page['checkafter']['required'] ) )
				{
					$page['checkafter']		= array ( $page['checkafter'] );
				}
				if ( isset ( $page['checkbefore']['required'] ) )
				{
					$page['checkbefore']		= array ( $page['checkbefore'] );
				}
				if ( isset ( $page['checkbefore'] )
					&& is_array ( $page['checkbefore'] ) )
				{
					foreach ( $page['checkbefore'] as $check )
					{
						$this->config['pages'][$pagenum]['action']['checkbefore'][]		= array (
							'required'		=> $check['required'],
							'action'		=> $this->parseValue ( $check['action'] )
						);
					}
				}
				if ( isset ( $page['checkafter'] )
					&& is_array ( $page['checkafter'] ) )
				{
					foreach ( $page['checkafter'] as $check )
					{
						$this->config['pages'][$pagenum]['action']['checkafter'][]		= array (
							'required'		=> $check['required'],
							'action'		=> $this->parseValue ( $check['action'] )
						);
					}
				}

				if ( $this->config['system']['totalPages'] < $pagenum )
				{
					$this->config['system']['totalPages']	= $pagenum;
				}
				if ( isset ( $page['variable']['name'] ) )
				{
					$page['variable'] = array ( $page['variable'] );
				}
				$varcount = 1;
				foreach ( $page['variable'] as $variable )
				{
					$required		= $variable['required'];
					$position		= $varcount;
					$canRecheck		= $variable['recheckable'];
					$newline		= $variable['newline'];
					$varname		= $variable['name'];
					$htmlname		= $variable['htmlname'];
					$form			= $variable['formtype'];
					$defaultvalue	= $variable['defaultvalue'];
					if ( !isset ( $this->config['count'][$pagenum]['variables'] ) )
						$this->config['count'][$pagenum]['variables']	= false;
					if ( $position > $this->config['count'][$pagenum]['variables'] )
					{
						$this->config['count'][$pagenum]['variables']	= $position;
					}

					$this->config['pages'][$pagenum]['data'][$position]		= array (
						'varname'		=> $varname,
						'htmlname'		=> $this->lang ( $htmlname ),
						'valueRequired'	=> $required,
						'canRecheck'	=> $canRecheck,
						'form'			=> $this->parseConfigoptionType ( $form ),
						'newline'		=> $newline,
						'defaultvalue'	=> $defaultvalue,
						'successfulSet'	=> 0,
						'installerlanguage'	=> '',
					);
					unset ( $check );
					if ( isset ( $variable['check']['required'] ) ) {
						$variable['check']	= array ( $variable['check'] );
					}
					if ( isset ( $variable['check']['0'] ) && is_array ( $variable['check']['0'] ) )
					{
						$this->config['pages'][$pagenum]['data'][$position]['valuecheck']	= $variable['check'];
					}
					$this->config['pagevariables'][$varname]		= array (
						'pagenum'		=> $pagenum,
						'varnum'		=> $varcount
					);
					$varcount++;
				}
				$pagenum++;
			}
		}
		function parseConfigoptionPos ( $pos )
		{
			$return		= "";
			switch ( strtolower ( $pos ) ) 
			{
				case 'new'		: 
				{
					if ( $this->config['system']['largest_row_cached'] > $this->config['system']['largest_row'] )
					{
						$this->config['system']['largest_row']	= $this->config['system']['largest_row_cached'];
					}
					$this->config['system']['largest_row_cached']	= 1;
					$return		= 'new';
					break;
				}
				case 'same'		: 
				{
					$this->config['system']['largest_row_cached']++;
					$return		= 'same';
					break;
				}
				case 'none'		:
				{
					$return		= 'none';
					break;
				}
			}
			if ( $this->config['system']['largest_row_cached'] > $this->config['system']['largest_row'] )
				$this->config['system']['largest_row']	= $this->config['system']['largest_row_cached'];
			return $return;
		}
		function parseConfigoptionPage ( $page )
		{
			$page		= str_replace ( '-', '', $page );
			if ( is_numeric ( $page ) ) 
			{
				return $page;
			} else {
				die ( 'Error in ParsePage' );
			}
		}
		function parseConfigoptionRequired ( $page )
		{
			if ( preg_match ( '|^-|', $page ) ) 
			{
				return false;
			} else {
				return true;
			}
		}
		function parseConfigoptionStartval ( $value )
		{
			$return			= "";
			if ( $value > "" ) 
			{
				$real_value		= substr ( $value, 1 );
				switch ( substr ( $value, 0, 1 ) ) 
				{
					case '<'		: 
					{
						require_once "./" . $this->config['system']['directories']['scriptdir'] . '/extensions/' . $real_value;
						break;
					}
					case '='		: 
					{
						$return		= $real_value;
						break;
					}
					default : 
					{
						die ( 'Cant parse value' );
					}
				}
			}
			return $return;
		}
		function parseConfigoptionType ( $type )
		{
			$return		= strtolower ( $type );
			return $return;
		}	
		function setInstallerinfos ( $settings )
		{
			if ( isset ( $settings['root']['pages']['installer'] ) )
			{
				$installer		= $settings['root']['pages']['installer'];
				$this->config['installer']['info']['title']			= $this->lang ( $installer['title'] );
				$this->config['installer']['info']['nextstring']	= $this->lang ( $installer['nextstring'] );
				$this->config['installer']['info']['finishstring']	= $this->lang ( $installer['finishstring'] );
				if ( isset ( $installer['finish']['action'] )
					&& !is_array ( $installer['finish']['action'] )
				) {
					$installer['finish']['action']		= array ( $installer['finish']['action'] );
				}
			}
			if ( is_array ( $installer['finish']['action'] ) )
			{
				foreach ( $installer['finish']['action'] as $action )
				{
					$this->config['installer']['action'][]	= $this->parseFinishaction ( $action );
				}
			}
		}
	}
?>