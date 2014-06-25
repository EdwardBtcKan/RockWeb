<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Monitor extends CI_Controller 
{
    function __construct() 
	{
        parent::__construct();
		$this->load->helper('cgminerapi');
		// $this->load->helper('functions');
  		// $this->load->library('form_validation');		
	}

	private function get_miner_id()
	{
		return 'df2b2af9ba746d23fae284610f2fd287';
	}

	private function pack_head()
	{
		$head['minerId'] = $this->get_miner_id();
		$head['client']['name'] = 'Rock';
		$head['client']['ver'] = '0.1.0';

		return $head;
	}

	private function pack_status()
	{
		$status['summary'] = request('summary');
		$status['pools'] = request('pools');

		return $status;
	}

	private function post($url, $data)
	{
		$ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	    $result = curl_exec($ch);
	    curl_close($ch);

	    return $result;
	}

	public function send_status()
	{
		$data['head'] = $this->pack_head();
		$data['data']['status'] = $this->pack_head();
		$this->post('http://miner.btckan.com/miner/miner_status', $data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */