<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_exist extends CI_Controller {

	//Check if the email adres exists for ajax login
	public function index($email = 0,$unique_id = 0)
	{
		if($this->database_model->email_exist($email) == TRUE){
			echo 'TRUE';
		}
	}

}