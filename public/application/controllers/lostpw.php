<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lostpw extends CI_Controller {

	public function index()
	{
		if($this->input->post())
		{
			// Load library
			$this->load->library('form_validation');

			// Set validation delimiters
			$this->form_validation->set_error_delimiters('<br />', '');

			// Set rules
			$this->form_validation->set_rules('email','Email adres','required|max_length[255]|valid_email|callback__check_email');

			// Validate!
			if ( $this->form_validation->run() )
			{
				$this->load->library('email');
				$config['mailtype'] = 'html';
				$this->email->initialize($config);
				$this->email->from('noreply@moneycontrolling.com', 'Money Controlling');
				$data = $this->database_model->user_get( $this->input->post('email') , TRUE );
				$data['pwreset'] = sha1(random_string('alnum',8));
				$this->database_model->lostpw_save_token($this->input->post('email'),$data['pwreset']);
				$this->email->message( $this->load->view( 'emails/lostpw' , $data , TRUE ) );
				$this->email->subject( 'Wachtwoord opnieuw instellen' );
    			$this->email->to( $this->input->post('email') );
    			$this->email->send();
    			redirect(site_url('lostpw/success'));
			}
		}

		// Load view
		$data = array('page_title'			=> 'Wachtwoord vergeten',
					  'page_description'	=> 'Wachtwoord opnieuw instellen bij Money Controlling');
		$this->load->view('lostpw',$data);
	}

	public function set($id = '',$pwreset = '')
	{
		if(!$id || !$pwreset || !$this->database_model->lostpw_check($id,$pwreset))
		{
			show_404();
		}
		else
		{
			//Login
			$this->session->set_userdata('logged_in', TRUE);
			$this->session->set_userdata('user_id', $id);
			//Delete token
			$this->database_model->lostpw_save_token($this->database_model->email_by_user_id($id),'');
			//Redirect
			$this->load->view('saved',array(
										'summary' 	=> 'Je bent nu ingelogd en op de volgende pagina kan je een nieuw wachtwoord kiezen.',
										'time'		=> 5,
										'page'		=> 'settings'
										));
		}

	}

	//Callback for the form validation to check if the email address exists
	public function _check_email()
	{
		if( $this->database_model->email_exist( $this->input->post('email') ) == FALSE ){
			$this->form_validation->set_message('_check_email', 'Het ingevoerde email adres is niet bij ons bekend.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

}

/* End of file  */
/* Location: ./application/controllers/ */