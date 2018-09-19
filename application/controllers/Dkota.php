<?php
class Dkota extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('History');
	}

	public function index()
	{
		$data["history"] = $this->History->getHistory();
		
		$this->load->view("dkota",$data);
	}
}