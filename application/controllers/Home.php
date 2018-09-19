<?php
class Home extends CI_Controller{
	public function __construct()
	{
		parent::__construct();		
		$this->load->helper('url');
		$this->load->model('History');
	}

	public function index()
	{
		$this->load->view("home");
	}
	
	public function search()
	{
		//getting city list and woeid
		$text = $this->input->post("text");
		$text = str_replace("-","%20",$text);
		$url = 'https://www.metaweather.com/api/location/search/?query='.$text;
		$curl = curl_init();
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl,CURLOPT_HTTPGET,TRUE);
		$output = curl_exec($curl);
		curl_close($curl);
		
		//insert to database
		$text = str_replace("%20"," ",$text);
		$this->History->insertHistory($text);
		
		//return a response
		echo $output;
		
	}
	
	public function detail()
	{
		$woeid = $this->input->post("woeid");
		//https://www.metaweather.com/api/location/44418/2013/4/27/
		$url = 'https://www.metaweather.com/api/location/'.$woeid.'/';
		$curl = curl_init();
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl,CURLOPT_HTTPGET,TRUE);
		$output = curl_exec($curl);
		curl_close($curl);
		echo $output;
	}
	
	public function detailGoogle()
	{
		//get woeid
		$text = $this->input->post("text");
		$text = str_replace("-","%20",$text);
		$url = 'https://www.metaweather.com/api/location/search/?query='.$text;
		$curl = curl_init();
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl,CURLOPT_HTTPGET,TRUE);
		$output = curl_exec($curl);
		curl_close($curl);
		$arrOutput = json_decode($output,true);
		$woeid = $arrOutput[0]['woeid'];
		
		//get weather
		$url = 'https://www.metaweather.com/api/location/'.$woeid.'/';
		$curl = curl_init();
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl,CURLOPT_HTTPGET,TRUE);
		$output = curl_exec($curl);
		curl_close($curl);
		echo $output;
	}
}