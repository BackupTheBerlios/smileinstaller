<?php

	class page
	{
		var $pagename			= false;
		var $pagedescription	= false;
		var $variable			= array ();
		var $check				= array ();
		var $buttonNext			= false;
		var $buttonPrevious		= false;

		function setPagename ( $data )
		{
			$this->pagename		= $data;
		}
		function setPagedescription ( $data )
		{
			$this->pagedescription	= $data;
		}
		function addVariable ( $data )
		{
			$variable				= new variable ();
			$this->variable[]		= new variable ();
			return &$this->variable[];
		}
		function addCheck ( $data )
		{
		}
		function execute ()
		{
		}
	}
	
?>