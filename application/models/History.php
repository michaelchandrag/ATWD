<?php
class History extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function getHistory()
	{
		$this->db->select('*');
		$this->db->from("history");
		return $this->db->get()->result();
	}
	
	public function insertHistory($text)
	{
		date_default_timezone_set('Asia/Jakarta');
		$datetime = date('m-d-Y h:i:s a', time()); 
		$data = array(
			"text" => $text,
			"datetime" => date("Y-m-d h:i:s a")
		);
		$this->db->insert("history",$data);
	}
}