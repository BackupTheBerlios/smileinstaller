<?

	class smileinstaller_language extends smileinstaller_execute
	{
		function loadLanguageitems ()
		{
			$languageitems		= file ( $this->config['files']['languageitems'] );
			foreach ( $languageitems as $languageitem ) {
				$this->config['languageitems'][]	= array ( 'itemname' => trim ( $languageitem ) );
			}
			if ( isset ( $_POST['setVar'] ) )
			{
				$setVar		= unserialize ( urldecode ( $_POST['setVar'] ) );
				if ( is_array ( $setVar ) )
				{
					foreach ( $setVar as $varname => $varvalue )
					{
						$this->config['system']['setVar'][$varname]		= $varvalue;
					}
				}
			}
		}
		function checkLanguagepage ()
		{
			$this->config['languageSet']		= false;
			if ( !isset ( $_POST['_installerlanguage'] ) )
				return false;
			if ( !$this->parseLanguagefile ( $_POST['_installerlanguage'] ) )
				return false;
			$this->config['system']['installerlanguage']		= $_POST['_installerlanguage'];
			$this->config['languageSet']		= true;
			if ( !isset ( $this->config['pages'] ) )
				return false;
			if ( !is_array (  $this->config['pages'] ) )
				return false;
			foreach ( $this->config['pages'] as $pagenum => $pagedata )
			{
				$this->config['pages'][$pagenum]['installerlanguage']	= $this->config['system']['installerlanguage'];
			}
		}
		function parseLanguagefile ( $language )
		{
			$return		= 0;
			if ( is_file ( $this->config['system']['directories']['languagedir'] . '/' . $language . '.txt' ) )
			{
				$languagedata		= file ( $this->config['system']['directories']['languagedir'] . '/' . $language . '.txt' );
				foreach ( $languagedata as $line )
				{
					if ( preg_match ( $this->config['languagelinepattern'], trim ( $line ), $result ) )
					{
						$this->config['language'][trim ( $result[1] )]		= trim ( $result[2] );
					}
				}
				$return		= 1;
			}
			return 1;
		}
		function lang ( $key )
		{
			if ( !preg_match ( '|^\[([^\[]{0,})\]$|', trim ( $key ), $result ) )
				return $key;
			if ( !isset ( $this->config['language'][$result[1]] )
				|| $this->config['language'][$result[1]] == "" )
				return $result[1];
			return $this->config['language'][$result[1]];
		}
	}

?>