<?php
class extensions_values_file extends extensions_values_db
{
	function _value_rootdir($pagenum, $varnum)
	{
		if ( $this->config['system']['debug'] >= 5 ) parent::_setError ( $pagenum, $varnum, '_value_rootdir' );
		return array ('value' => str_replace("\\", "/", ROOTPATH), 'isset' => true);
	}
	function _value_demorootdir($pagenum, $varnum)
	{
		if ( $this->config['system']['debug'] >= 5 ) parent::_setError ( $pagenum, $varnum, '_value_rootdir' );
		return array ('value' => str_replace("\\", "/", DEMOROOTPATH), 'isset' => true);
	}
	function _value_installerdir($pagenum, $varnum)
	{
		if ( $this->config['system']['debug'] >= 5 ) parent::_setError ( $pagenum, $varnum, '_value_installerdir' );		return array ('value' => str_replace("\\", "/", INSTALLERPATH), 'isset' => true);
	}
	function _value_rooturl($pagenum, $varnum)
	{
		if ( $this->config['system']['debug'] >= 5 ) parent::_setError ( $pagenum, $varnum, '_value_rooturl' );		return array ('value' => str_replace("\\", "/", ROOTURL), 'isset' => true);
	}
	function _value_Demopaths($pagenum, $varnum)
	{
		if ( $this->config['system']['debug'] >= 5 ) parent::_setError ( $pagenum, $varnum, '_value_Demopaths' );		$return= array ('value' => '', 'isset' => false);
		$rootpath= str_replace("\\", "/", DEMOROOTPATH.'/');
		if ($newRootpath= strstr($rootpath, ":"))
		{
			$rootpath= $this->lang(substr($newRootpath, 1));
		}
		for ($i= 1; $i <= 10; $i ++)
		{
			$return['value'] .= ",".$rootpath.$i;
		}
		$return['value']= substr($return['value'], 1);
		return $return;
	}
}
?>