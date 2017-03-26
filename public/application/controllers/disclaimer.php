<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Disclaimer extends CI_Controller {

	public function index()
	{
		$data = array('page_title'			=> 'Disclaimer',
					  'page_description'	=> 'Disclaimer van Money Controlling');
		$this->load->view('disclaimer',$data);
	}

}