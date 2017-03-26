<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function __construct()
    {
    	parent::__construct();
        if(!$this->session->userdata('logged_in')){
        	redirect('#login');
        }
    }

	//Load summary page
	public function index()
	{
        //Get user info
        $data['data'] = $this->database_model->get_user_info_by_id( $this->session->userdata('user_id') );
        $data['page_title'] = $data['page_description'] = 'Gegevens';

        //Form submitted?
        if($this->input->post())
        {
            //Load form validation library
            $this->load->library('form_validation');

            //Set validation rules
            $this->form_validation->set_rules('name', 'Naam', 'required|max_length[255]');
            $this->form_validation->set_rules('email', 'Email', 'required|max_length[255]|valid_email|callback__check_email');
            $this->form_validation->set_rules('password', 'Huidige wachtwoord', 'required|callback__login_check');
            $this->form_validation->set_rules('info', 'Betalings informatie', 'max_length[255]');

            //Want a new password?
            if($this->input->post('password_new') OR $this->input->post('password_new2')){
                $this->form_validation->set_rules('password_new', 'Nieuw wachtwoord', 'required|matches[password_new2]');
                $this->form_validation->set_rules('password_new2', 'Herhaal nieuw wachtwoord', 'required');
            }

            //Set validation delimiters
            $this->form_validation->set_error_delimiters('<br />', '');

            //Run validation
            if ($this->form_validation->run() == FALSE)
            {
                //Load view to show the validation errors
                $this->load->view('settings',$data);
            }
            else
            {
                //Validation succeed
                if($this->input->post('password_new')){
                    $password = sha1($this->input->post('password_new').$this->config->item('encryption_key'));
                    $this->database_model->edit_user($this->input->post('name'),$this->input->post('email'),$this->input->post('info'),$password);
                } else {
                    $this->database_model->edit_user($this->input->post('name'),$this->input->post('email'),$this->input->post('info'));
                }
                
                //Redirect
                $data = array('page' => 'settings','summary' => 'De ingevoerde gegevens zijn opgeslagen!');
                $this->load->view('saved',$data);
            }



        } else {
            //Load the view
            $this->load->view('settings', $data);
        }
	}

    //Callback for the form validation to check if user have entered valid credentials
    public function _login_check()
    {
        if( $this->database_model->validate_credentials( $this->input->post('email') , $this->input->post('password') ) != TRUE ){
            $this->form_validation->set_message('_login_check', 'Het ingevoerde wachtwoord komt niet overeen.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    //Callback for the form validation to check if there is already an account
    public function _check_email()
    {
        if( $this->database_model->email_exist( $this->input->post('login_email') ) == TRUE ){
            $this->form_validation->set_message('_check_email', 'Er is al een gebruiker met dit email adres. Wachtwoord vergeten?');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}