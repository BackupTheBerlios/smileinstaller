<?
	// Diese Klasse wird das Logging in Baumstruktur darstellen
	class smilelog
	{
		// Erstellt einen Logeintrag
		function log ( $message )
		{
			$this->config['log'][]	= $message;
		}
		function getLogHTML ()
		{
			$return		= "<ul>";
			foreach ( $this->config['log'] as $key => $logentry )
			{
				$return			.= '<li><pre>' . htmlentities ( $logentry ) . '</pre></li>';
			}
			$return		.= "</ul>";
			return $return;
		}
	}
	
?>