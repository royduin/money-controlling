<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function index()
	{
		//Unset sessions
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('user_id');

		//Redirect to home
		redirect();
	}

}