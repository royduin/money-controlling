<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {


	//Load home page
	public function index()
	{
		$this->load->view('home');
	}


	//Handles the submit from the home page
	public function submit()
	{
		//Submitted?
		if($this->input->post())
		{
			//Load form validation library
			$this->load->library('form_validation');

			if(!$this->input->post('login_password'))
			{
				//Set form validation rules
				$this->form_validation->set_rules('name', 'Zijn/haar naam', 'required|max_length[255]');
				$this->form_validation->set_rules('email', 'Zijn/haar email', 'required|max_length[255]|valid_email|callback__not_match_same_email');

				$this->form_validation->set_rules('amount1', 'Bedrag voor de komma', 'required|max_length[8]|greater_than[0]|numeric|is_natural_no_zero');
				$this->form_validation->set_rules('amount2', 'Bedrag achter de komma', 'required|exact_length[2]|numeric|is_natural');
				$this->form_validation->set_rules('reason', 'Reden', 'required|max_length[255]');
			}

			$new_user = FALSE;

			//Not logged in
			if(!$this->session->userdata('logged_in'))
			{
				$this->form_validation->set_rules('login_email', 'Je eigen email adres', 'required|max_length[255]|valid_email');
				if( $this->input->post('login_password') )
				{
					//Login
					$this->form_validation->set_rules('login_password', 'Je wachtwoord', 'required|callback__login_check');
				}
				else
				{
					//New user
					$this->form_validation->set_rules('login_name', 'Je eigen naam', 'required|max_length[255]|callback__check_email');
					$new_user = TRUE;
				}
			}

			//Set validation delimiters
			$this->form_validation->set_error_delimiters('<br />', '');


			//Run validation
			if ($this->form_validation->run() == FALSE)
			{
				//Load view to show the validation errors
				$this->load->view('home');
			}
			else
			{
				//Validation succeed
				$this->save( $this->input->post() , $new_user );
			}

		}
		else
		{	
			//Redirect to the home page
			redirect();
		}
	}

	//Callback for the form validation to check if user is logged in
	/*
	public function _logged_in()
	{
		if(!$this->session->userdata('logged_in')){
			$this->form_validation->set_message('_logged_in', 'Je ben niet ingelogd. Klik rechts boven om in te loggen.');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	*/

	//Callback for the form validation to check if user have entered valid credentials
	public function _login_check()
	{
		if( $this->database_model->validate_credentials( $this->input->post('login_email') , $this->input->post('login_password') ) != TRUE ){
			$this->form_validation->set_message('_login_check', 'De ingevoerde email en wachtwoord combinatie komt niet overeen. <a href="'.site_url('lostpw').'">Wachtwoord vergeten?</a>');
			return FALSE;
		} else {
			return TRUE;
		}
	}


	//Callback for the form validation to check if there is already an account
	public function _check_email()
	{
		if( $this->database_model->email_exist( $this->input->post('login_email') ) == TRUE ){
			$this->form_validation->set_message('_check_email', 'Er is al een gebruiker met dit email adres. <a href="'.site_url('lostpw').'">Wachtwoord vergeten?</a>');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	//Callback for the form validation to check if "your own email adress" does not match the "from email adress"
	public function _not_match_same_email()
	{
		if($this->input->post('login_email')){
			$email = $this->input->post('login_email');
		} else {
			$email = $this->database_model->email_by_user_id($this->session->userdata('logged_in'));
		}

		if( strtolower($this->input->post('email')) == strtolower($email) ){
			$this->form_validation->set_message('_not_match_same_email', 'Het is niet mogelijk om een lening bij jezelf toe te voegen. Er is twee maal hetzelfde email adres ingevuld.');
			return FALSE;
		} else {
			return TRUE;
		}
	}



	//Save all settings
	private function save( $array, $new_user )
	{

		$this->load->library('mailer',$array);

		//New user?
		if( $new_user == TRUE )
		{
			//Generate a password
			$password = random_string('alnum',8);

			//Add to database
			$user_id = $this->database_model->create_user(
															$array['login_name'], 
															$array['login_email'], 
															sha1($password.$this->config->item('encryption_key'))
														  );
			//Send credentials to the user by email
			$this->mailer->send_message('new_user',array(
																'name'		=> $array['login_name'],
																'email'		=> $array['login_email'],
																'password'	=> $password
															));

		//Existing user
		} else
		{
			//Get user id
			if($this->session->userdata('logged_in')){
				$user_id = $this->session->userdata('user_id');
			} else {
				$user_id = $this->database_model->user_id_by_email($array['login_email']);
			}
			$array['login_name'] = $this->database_model->name_by_user_id($user_id);
		}

		//Login user
		$this->session->set_userdata('logged_in', TRUE);
		$this->session->set_userdata('user_id', $user_id);

		//New loan?
		if($array['name']){

			//Get user id for TO
			if($this->database_model->email_exist($array['email']))
			{
				//Get user id by email
				$to 	= $this->database_model->user_id_by_email($array['email']);
			}
			else
			{
				//Generate password
				$password 	= random_string('alnum',8);

				//Create new user
				$to 		= $this->database_model->create_user(
																	$array['name'], 
																	$array['email'], 
																	sha1($password.$this->config->item('encryption_key')));

				//Send credentials by email
				$this->mailer->send_message('new_user',array(
																'name'		=> $array['name'],
																'email'		=> $array['email'],
																'password'	=> $password,
																'to'		=> TRUE
															));
			}

			//Store loan in database
			$unique_id = $this->database_model->save_loan($user_id, $to, $array['amount1'].$array['amount2'], $array['reason']);
			$loan_id = $this->db->insert_id();

			//Send loan email
			$this->mailer->send_message('new_loan', $this->database_model->loan_get($loan_id) );

		}

		//Load view
		if($array['name']){
			$data = array('page' => 'summary/inactive','summary' => 'De ingevoerde gegevens zijn opgeslagen!');
		} else {
			$data = array('page' => 'summary','summary' => 'Je bent succesvol ingelogd!');
		}
		$this->load->view('saved',$data);

	}


}