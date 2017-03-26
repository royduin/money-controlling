<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {

	//Load summary page
	public function index()
	{
		if($this->input->post()){
			
			$this->load->library('form_validation');

			//Set validation delimiters
			$this->form_validation->set_error_delimiters('<br />', '');

			$this->form_validation->set_rules('name','Naam','required|max_length[255]');
			$this->form_validation->set_rules('email','Email adres','required|max_length[255]|valid_email');
			$this->form_validation->set_rules('message','Bericht','required');

			if ( $this->form_validation->run() )
			{
				$this->load->library('email');
				$config['mailtype'] = 'html';
				$this->email->initialize($config);
				$this->email->from('noreply@moneycontrolling.com', 'Money Controlling');
				$this->email->reply_to( $this->input->post('email') , $this->input->post('name') );
				$this->email->message( $this->load->view( 'emails/contact' , $this->input->post() , TRUE ) );
				$this->email->subject( 'Contact via Money Controlling' );
    			$this->email->to( 'royduineveld@gmail.com' );
    			$this->email->send();
    			redirect(site_url('contact/success'));
			}

		}
		$data = array('page_title'			=> 'Contact',
					  'page_description'	=> 'Contact opnemen met Money Controlling');
		$this->load->view('contact',$data);
	}

}