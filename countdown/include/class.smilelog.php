<?
	// Diese Klasse wird das Logging in Baumstruktur darstellen
	class smilelog
	{
		// Erstellt einen Logeintrag
		function log ( $message = 'setMessage!' )
		{
			$this->config['log']['allNodes']++;
			$useThisNode	= $this->config['log']['currentNode'];
			$this->config['log']['node'][$this->config['log']['allNodes']]['text']	= $message;
			if ( $useThisNode !=  $this->config['log']['allNodes'] )
			{
				if ( !isset ( $this->config['log']['currentLog'][$useThisNode]['text'] ) )
				{
					$this->config['log']['currentLog'][$useThisNode]['text']	=
						$this->config['log']['node'][$useThisNode]['text'];
				}
				$this->config['log']['currentLog'][$useThisNode]['subnode'][]	= $this->config['log']['node'][$this->config['log']['allNodes']];
			}
			return $this->config['log']['allNodes'];
		}
		function useNode ( $useThisNode )
		{
			$this->config['log']['currentNode']		= $useThisNode;
		}
		function getLogHTML ( $log = false )
		{
			if ( !$log )
			{
				$log	= $this->config['log']['currentLog'];
			}
			$return		= "<ul>";
			foreach ( $log as $key => $logentry )
			{
				if ( isset ( $logentry['text'] ) )
				{
					$return			.= '<li><pre>' . htmlentities ( $logentry['text'] ) . '</pre>';
					if ( is_array ( $logentry['subnode'] ) )
					{
						$return		.= $this->getLogHTML ( $logentry['subnode'] );
					}
					$return		.= "</li>";
				}
			}
			$return		.= "</ul>";
			return $return;
		}
	}
	
?>