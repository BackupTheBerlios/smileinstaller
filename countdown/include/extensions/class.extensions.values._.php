<?php
class extensions_values extends extensions_output_form
{
	function _value_redirectTo($pagenum, $varnum, $preurl, $file)
	{
		if ( $this->config['system']['debug'] >= 5 ) parent::_setError ( $pagenum, $varnum, '_value_redirectTo' );		$return= array ('value' => $preurl.'/'.$file, 'isset' => true);
		return $return;
	}
	function _value_Servername($pagenum, $varnum)
	{
		if ( $this->config['system']['debug'] >= 5 ) parent::_setError ( $pagenum, $varnum, '_value_Servername' );		$return= array ('value' => getenv('SERVER_NAME'), 'isset' => true);
		return $return;
	}
	function _value_Serverport($pagenum, $varnum)
	{
		if ( $this->config['system']['debug'] >= 5 ) parent::_setError ( $pagenum, $varnum, '_value_Serverport' );		$return= array ('value' => getenv('SERVER_PORT'), 'isset' => true);
		return $return;
	}
	function _value_TextToPagecheck ( $pagenum, $varnum )
	{
	}
}
?>