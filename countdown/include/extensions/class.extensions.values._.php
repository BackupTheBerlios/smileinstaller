<?
class extensions_values extends extensions_output_form
{
	function _value_redirectTo($pagenum, $varnum, $preurl, $file)
	{
		$return= array ('value' => $preurl.'/'.$file, 'isset' => true);
		return $return;
	}
	function _value_Servername($pagenum, $varnum)
	{
		$return= array ('value' => getenv('SERVER_NAME'), 'isset' => true);
		return $return;
	}
	function _value_Serverport($pagenum, $varnum)
	{
		$return= array ('value' => getenv('SERVER_PORT'), 'isset' => true);
		return $return;
	}
}
?>