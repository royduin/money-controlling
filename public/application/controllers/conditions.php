<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Conditions extends CI_Controller {

	public function index()
	{
		$data = array('page_title'			=> 'Voorwaarden',
					  'page_description'	=> 'Voorwaarden van Money Controlling');
		$this->load->view('conditions',$data);
	}

}