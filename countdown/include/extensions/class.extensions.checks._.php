<?
class extensions_checks extends installer
{
	function _check_none($pagenum, $varnum)
	{		if ( $this->config['system']['debug'] >= 5 ) parent::_setError ( $pagenum, $varnum, 'check_none', false );		$return= array ('value' => '', 'isset' => false);
		$return['isset']= true;
		return $return;
	}
	function _check_notNull($pagenum, $varnum)
	{
		if ( $this->config['system']['debug'] >= 5 ) parent::_setError ( $pagenum, $varnum, '_check_notNull', false );		$return= array ('value' => $_POST[$this->config['pages'][$pagenum]['data'][$varnum]['varname']], 'isset' => false);
		if ($_POST[$this->config['pages'][$pagenum]['data'][$varnum]['varname']] > "")
		{
			$return['isset']= true;
		}
		return $return;
	}
	function _check_compareValues($pagenum, $varnum, $compare)
	{
		if ( $this->config['system']['debug'] >= 5 ) parent::_setError ( $pagenum, $varnum, '_check_compareValues', false );		$return= array ('value' => '', 'isset' => false);
		if ($_POST[$this->config['pages'][$pagenum]['data'][$varnum]['varname']] === $pass2)
		{
			$return['isset']= true;
		}
		return $return;
	}}
?>