<?php
class smileinstaller_execute
{
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
}
?>