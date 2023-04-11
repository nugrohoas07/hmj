<?php

class Template {

	protected $CI;

	protected $openSectionName = null;

	protected $render = array();

	public function __construct() {
		$this->CI = & get_instance();		
	}

	public function section($name)  {
		$this->openSectionName = $name;
		ob_start();
	}

	public function endsection() {	
		try {
			if ($this->openSectionName)	{
				$this->render[$this->openSectionName] = ob_get_contents();
				$this->openSectionName = null;
				ob_get_clean();
			} else {
				throw new Exception('EndSectionWitoutStart');
			}
		} catch(Exception $e) {
			show_error($e->getMessage());
		}		
	}

	public function render($name, $return = false) {		
		if (isset($this->render[$name])) {
			if ($return) {
				return $this->render;
			}
			echo $this->render[$name];
		}
	}

	public function getview($view, $data = null, $return = false) {
		return $this->CI->load->view($view, $data, $return);
	}	

	public function view($view, $data = null, $return = false) {
		$output = $this->CI->load->view($view, $data, true);
		$output = trim($output);
		if ($return) {
			return $output;
		} else {
			echo $output;
		}
	}

}

function section($name) {
	$CI = & get_instance();
	$CI->template->section($name);
}

function endsection() {
	$CI = & get_instance();
	$CI->template->endsection();	
}

function render($name) {
	$CI = & get_instance();
	$CI->template->render($name);		
}

function getview($view) {
	$CI = & get_instance();
	$CI->template->getview($view);		
}