<?
class extensions_checks_form extends extensions_checks_finish
{
	function __check_string($pagenum, $varnum)
	{
		$return= array ('value' => $var['defaultvalue'], 'isset' => false);
		@ mkdir($return['value'], 0777);
		if ($_POST[$var['varname']] > "")
		{
			$return['isset']= true;
		}
		return $return;
	}
	function _check_Formspecific($pagenum, $varnum, $requireValue= false)
	{
		$var= $this->config['pages'][$pagenum]['data'][$varnum];
		switch (strtolower($var['formtype']))
		{
			case 'select' :
				{
					$return= $this->__checkFormSelect($var, $requireValue);
					break;
				}
			case 'checkbox' :
				{
					$return= $this->__checkFormCheckbox($var, $requireValue);
					break;
				}
			case 'input' :
				{
					$return= $this->__checkFormInput($var, $requireValue);
					break;
				}
			case 'password' :
				{
					$return= $this->__checkFormPassword($var, $requireValue);
					break;
				}
			default :
				{
					die('no checkable element "'.$this->config['pages'][$pagenum]['data'][$varnum]['form']);
				}
		}
		return $return;
	}
	function __checkFormSelect($var, $requireValue= false)
	{
		$return= array ('value' => $var['defaultvalue'], 'isset' => false);
		if ($requireValue)
		{
			if ($_POST[$var['varname']] == $requireValue)
			{
				$return= array ('value' => $_POST[$var['varname']], 'isset' => true);
			}
		}
		else
		{
			$options= explode(",", $var['defaultvalue']);
			foreach ($options as $value)
			{
				if ($newValue= strstr($value, ":"))
				{
					$key= $this->lang(str_replace($newValue, "", $value));
					$value= $this->lang($newValue);
				}
				else
				{
					$value= $this->lang($value);
					$key= $value;
				}
				if ($_POST[$var['varname']] == $key)
				{
					$return= array ('value' => $_POST[$var['varname']], 'isset' => true);
				}
			}
		}
		return $return;
	}
	function __checkFormCheckbox($var, $requireValue= false)
	{
		$return= array ('value' => $var['defaultvalue'], 'isset' => false);
		if ($requireValue)
		{
			if ($_POST[$var['varname']] == $requireValue)
			{
				$return= array ('value' => $_POST[$var['varname']], 'isset' => true);
			}
		}
		else
		{
			if ($var['defaultvalue'] == $_POST[$var['varname']])
			{
				$return= array ('value' => $_POST[$var['varname']], 'isset' => true);
			}
		}
		return $return;
	}
	function __checkFormInput($var, $requireValue= false)
	{
		$return= array ('value' => $var['defaultvalue'], 'isset' => false);
		if ($requireValue)
		{
			if ($_POST[$var['varname']] == $requireValue)
			{
				$return= array ('value' => $_POST[$var['varname']], 'isset' => true);
			}
		}
		else
		{
			if ($_POST[$var['varname']] > "")
			{
				$return= array ('value' => $_POST[$var['varname']], 'isset' => true);
			}
		}
		return $return;
	}
	function __checkFormPassword($var, $requireValue= false)
	{
		$return= array ('value' => $var['defaultvalue'], 'isset' => false);
		if ($requireValue)
		{
			if ($_POST[$var['varname']] == $requireValue)
			{
				$return= array ('value' => $_POST[$var['varname']], 'isset' => true);
			}
		}
		else
		{
			if ($_POST[$var['varname']] > "")
			{
				$return= array ('value' => $_POST[$var['varname']], 'isset' => true);
			}
		}
		return $return;
	}
}
?>