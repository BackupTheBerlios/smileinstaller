<?
class extensions_values_file extends extensions_values_db
{
	function _value_rootdir($pagenum, $varnum)
	{
		return array ('value' => str_replace("\\", "/", ROOTPATH), 'isset' => true);
	}
	function _value_installerdir($pagenum, $varnum)
	{
		return array ('value' => str_replace("\\", "/", INSTALLERPATH), 'isset' => true);
	}
	function _value_rooturl($pagenum, $varnum)
	{
		return array ('value' => str_replace("\\", "/", ROOTURL), 'isset' => true);
	}
	function _value_Demopaths($pagenum, $varnum)
	{
		$return= array ('value' => '', 'isset' => false);
		$rootpath= str_replace("\\", "/", ROOTPATH.'/');
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