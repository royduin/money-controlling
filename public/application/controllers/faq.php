<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faq extends CI_Controller {

	public function index()
	{
		$data = array('page_title'			=> 'Veel gestelde vragen',
					  'page_description'	=> 'Veel gestelde vragen aan Money Controlling');
		$this->load->view('faq',$data);
	}

}