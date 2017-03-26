<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Summary extends CI_Controller {

	public function __construct()
    {
    	parent::__construct();
        if(!$this->session->userdata('logged_in')){
        	redirect('#login');
        }
    }

	//Load summary page
	public function index($status = 'open')
	{
		$options = array('open','inactive','paid');
		if(in_array($status,$options)){
			$data['data'] = $this->database_model->get_summary( $this->session->userdata('user_id') , $status );
			$data['page_title'] = $data['page_description'] = 'Overzicht leningen met de status '.strtolower(translate_status($status)).'';
			$this->load->view('summary', $data);
		} else {
			show_404();
		}
	}

}