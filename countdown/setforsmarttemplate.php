		function setForSmarttemplate ()
		{
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
		}
