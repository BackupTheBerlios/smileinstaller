<?php
class extensions_output extends extensions_checks_form
{
	// Fuegt eine Konfigurationsseite an die bisherigen
	function _output_addPage ( $pagenum, $varnum, $title, $name, $desc )
	{
		$return		= array ( 'isset' => true );
		$this->config['system']['totalPages']++;
		$this->config['system']['lastVariable']	= -1;
		$this->config['pagesToAdd'][$this->config['system']['totalPages']]		= array
		(
			'title'		=> $this->Variablereplacements ( $title ),
			'name'		=> $this->Variablereplacements ( $name ),
			'desc'		=> $this->Variablereplacements ( $desc ),
		);
		$this->_setError ( 0, 0, 'Create page ' . $this->config['system']['totalPages'] );
		return array ( 'isset' => true );;	
	}
	function _output_addVariableToLastPage ( $pagenum, $varnum, $varname, $htmlname, $htmldesc, $defaultvalue, $autovalue, $formtype, $required, $newline )
	{
		$this->config['system']['lastVariable']++;
		$this->config['system']['lastAction']	= -1;
		$this->config['pagesToAdd'][$this->config['system']['totalPages']]['variable'][$this->config['system']['lastVariable']] = array
		(
			'name'				=> $this->Variablereplacements ( $varname ),
			'htmlname'				=> $this->Variablereplacements ( $htmlname ),
			'htmldesc'				=> $this->Variablereplacements ( $htmldesc ),
			'newline'				=> $this->Variablereplacements ( $newline ),
			'required'				=> $this->Variablereplacements ( $required ),
			'defaultvalue'			=> $this->Variablereplacements ( $defaultvalue ),
			'autovalue'				=> $this->Variablereplacements ( $autovalue ),
			'formtype'				=> $this->Variablereplacements ( $formtype )
		);
		$this->_setError ( 0, 0, 'Create variable');	
		return array ( 'isset' => true );;	
	}
	function _output_addActionToLastVariable ( $pagenum, $varnum, $action )
	{
		$this->config['system']['lastAction']++;
		$this->config['system']['lastOption']	= -1;
		$this->config['pagesToAdd']
			[$this->config['system']['totalPages']]
			['variable']
			[$this->config['system']['lastVariable']]
			['check']
			[$this->config['system']['lastAction']]
			['action']
			= $this->Variablereplacements ( $action );
		$this->_setError ( 0, 0, 'Create action' );	
		return array ( 'isset' => true );;	
	}
	function _output_addOptionToLastAction ( $pagenum, $varnum, $option )
	{
		$this->config['system']['lastOption']++;
		$this->config['pagesToAdd']
			[$this->config['system']['totalPages']]
			['variable']
			[$this->config['system']['lastVariable']]
			['check']
			[$this->config['system']['lastAction']]
			['option']
			[$this->config['system']['lastOption']]
			= $this->Variablereplacements ( $option );
		$this->_setError ( 0, 0, 'Create Option' );	
		return array ( 'isset' => true );;	
	}
	function Variablereplacements ( $string )
	{
		$string		= str_replace ( '#P', $this->config['system']['totalPages'], $string );
		$string		= str_replace ( '#V', $this->config['system']['lastVariable'], $string );
		$string		= str_replace ( '#A', $this->config['system']['lastAction'], $string );
		$string		= str_replace ( '#O', $this->config['system']['lastOption'], $string );
		$string		= str_replace ( 'งง', '$', $string );
		return $string;
	}
}
?>