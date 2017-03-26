<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Confirm extends CI_Controller {

	protected $loan_id;
	protected $loan_unique_id;
	protected $redirect_page;
	protected $current_loan;

	public function __construct()
    {
    	parent::__construct();

    	$this->loan_id 			= $this->uri->segment(3);
    	$this->loan_unique_id 	= $this->uri->segment(4);

    	//Required URI segments present?
		if( ! $this->loan_id || ! $this->loan_unique_id )
		{
			show_404();
		}
		else
		{
			//Get loan
			$this->current_loan		= $this->database_model->loan_get( $this->loan_id , $this->loan_unique_id );

			//Load mailer library
			$this->load->library('mailer',$this->current_loan);

			//Set redirect
			if( $this->uri->segment(5) ){
				$this->redirect_page = 'summary';
			} else {
				$this->redirect_page = 'home';
			}
		}
    }

	public function yes()
	{
		if(!$this->current_loan){
			
			//Load view
			$data = array('summary' => 'De lening bestaat niet. Deze kan eerder al verwijderd zijn.', 'page' => $this->redirect_page, 'time' => 5);
			$this->load->view('saved',$data);

		} elseif($this->current_loan['status'] == 'inactive'){

			//Update
			$this->database_model->loan_update( $this->loan_id , array('status' => 'open') );

			//Load view
			$data = array('summary' => 'De status van de lening is op actief ingesteld.', 'page' => $this->redirect_page, 'time' => 5);
			$this->load->view('saved',$data);

			//Send email
			$this->mailer->send_message('confirm_yes');
			
		} else {

			//Load view
			$data = array('summary' => 'De status van de lening is al op actief ingesteld.', 'page' => $this->redirect_page, 'time' => 5);
			$this->load->view('saved',$data);

		}
	}

	public function no()
	{
		if(!$this->current_loan){

			//Load view
			$data = array('summary' => 'De lening bestaat niet. Deze kan eerder al verwijderd zijn.', 'page' => $this->redirect_page, 'time' => 5);
			$this->load->view('saved',$data);

		} elseif($this->current_loan['status'] == 'inactive'){

			//Delete loan
			$this->database_model->delete_loan( $this->loan_id );

			//Load view
			$data = array('summary' => 'De lening is verwijderd.', 'page' => $this->redirect_page, 'time' => 5);
			$this->load->view('saved',$data);

			//Send email
			$this->mailer->send_message('confirm_no');

		} elseif($this->current_loan['status'] != 'inactive'){

			//Load view
			$data = array('summary' => 'De lening is eerder al geactiveerd.', 'page' => $this->redirect_page, 'time' => 5);
			$this->load->view('saved',$data);

		}
	}

}