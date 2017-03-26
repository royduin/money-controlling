<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends CI_Controller {

	public function __construct()
    {
    	parent::__construct();

    	//Check if it's running from the cronjob
    	if( ! $this->input->is_cli_request() ){
    		show_404();
    	}

    	//Load mailer library
    	$this->load->library('mailer');
    	
    }

	public function index()
	{
		$data = $this->database_model->get_for_cron( time() );

		if($data){
			foreach($data as $item){
				if( ! $this->mailer->send_message('cron',$item) ){
					log_message('error', 'CRONJOB: Couldn\'t send email! Loan ID: '.$item['id']);
				}
				sleep(5);
			}
		}
	}

}