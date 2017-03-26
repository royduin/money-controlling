<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Loan extends CI_Controller {

	protected $loan_id;
	protected $current_loan;
	protected $uri_option;

	public function __construct()
	{
		parent::__construct();

		//Logged in?
		if( ! $this->session->userdata('logged_in') )
		{
			redirect('#login');
		} else 
		{
			$this->loan_id          = $this->uri->segment(2);
			$this->uri_option		= $this->uri->segment(3);

			//Required URI segments present?
			if( ! $this->loan_id )
			{
				show_404();
			} else 
			{
				//Loan exists?
				$this->current_loan     = $this->database_model->loan_get( $this->loan_id );
				if( ! $this->current_loan ){
					show_404();
				}
			}
		}
	}

	public function index()
	{
		$data 				= $this->current_loan;

		if($data['to_id'] == $this->session->userdata('user_id')) {
			$options 			= array('payment','payment_date');
		} else {
			$options 			= array('partly_paid','fully_paid','edit','delete');
		}

		//Option in URL?
		if($this->uri_option)
		{
			//Valid option?
			if( in_array($this->uri_option,$options) )
			{
				$data['scroll_down']	= TRUE;
				$data['uri_option']		= $this->uri_option;

				//Posted?
				if( $this->input->post() )
				{
					//Load mailer library
					if($this->uri_option == 'delete'){
						$this->load->library('mailer', $this->database_model->loan_get( $this->loan_id ) );
					}

					$call_function = '_'.$this->uri_option;
					if( $this->$call_function() )
					{
						//Load mailer library
						if($this->uri_option != 'delete'){
							$this->load->library('mailer', $this->database_model->loan_get( $this->loan_id ) );
						}

						//Send email
						$this->mailer->send_message( $this->uri_option );

						if($this->uri_option == 'delete'){
							$data['redirect']	= site_url('summary');
						} else {
							$data['redirect']	= str_replace('/'.$this->uri_option,'',current_url());
						}
						$data['options']	= '<hr />'.$this->load->view('options/success',$data,TRUE);
					} else {
						$data['options']	= '<hr />'.$this->load->view('options/'.$this->uri_option,$data,TRUE);
					}
				} else {
					$data['options']	= '<hr />'.$this->load->view('options/'.$this->uri_option,$data,TRUE);
				}

			//No valid option in url -> Show 404
			} else {
				show_404();
			}

		//No option in url -> Show buttons
		} else {
			$data['options']	= $this->load->view('options/buttons',$data,TRUE);
		}

		if($data['to_id'] == $this->session->userdata('user_id')) {
			$data['page_title']	= $data['page_description'] = 'Lening bij '.$data['from_name'];
		} else {
			$data['page_title']	= $data['page_description'] = 'Uitgeleend aan '.$data['to_name'];
		}

		$this->load->view('loan',$data);
	}

	public function _payment_date()
	{
		if($this->current_loan['status'] != 'paid')
		{
			//Load form validation library
			$this->load->library('form_validation');

			//Rules
			$this->form_validation->set_rules('date', 'Datum', 'required|callback__valid_date');

			//Set validation delimiters
			$this->form_validation->set_error_delimiters('<br />', '');

			//Run
			if ($this->form_validation->run() == FALSE)
			{
				//Fail -> show view with errors
				return FALSE;
			}
			else
			{
				$date_split		= explode('-',$this->input->post('date'));
				$payment_date 	= mktime(0,0,0,$date_split[1],$date_split[0],$date_split[2]);
				$data = array(
					'payment_date' 		=> $payment_date
				);

				if( $this->database_model->loan_update( $this->loan_id , $data ) )
				{
					return TRUE;
				} else {
					return FALSE;
				}
			}
		}
	}

	public function _payment()
	{
		if($this->current_loan['status'] != 'paid')
		{
			return TRUE;
		}
	}

	public function _delete()
	{
		if($this->current_loan['status'] != 'paid')
		{
			if( $this->database_model->loan_delete( $this->loan_id ) ){
				return TRUE;
			} else {
				return FALSE;
			}
		}
	}

	public function _edit()
	{
		if($this->current_loan['status'] != 'paid')
		{
			$amount = $this->input->post('amount1').$this->input->post('amount2');
			
			//Load form validation library
			$this->load->library('form_validation');

			//Rules
			$this->form_validation->set_rules('amount1', 'Bedrag voor de komma', 'required|max_length[8]|greater_than[0]|numeric|is_natural_no_zero');
			$this->form_validation->set_rules('amount2', 'Bedrag achter de komma', 'required|exact_length[2]|numeric|is_natural');
			$this->form_validation->set_rules('reason', 'Reden', 'required|max_length[255]');

			//Set validation delimiters
			$this->form_validation->set_error_delimiters('<br />', '');

			//Run
			if ($this->form_validation->run() == FALSE)
			{
				//Fail -> show view with errors
				return FALSE;
			}
			else
			{
				$data = array(
					'amount' 		=> $amount,
					'definition'	=> $this->input->post('reason')
				);

				if( $this->database_model->loan_update( $this->loan_id , $data ) ){
					//TODO: Mail!
					return TRUE;
				} else {
					return FALSE;
				}
			}
		}
	}

	public function _fully_paid()
	{
		if($this->current_loan['status'] != 'paid')
		{
			$data = array(
				'amount_paid' 	=> $this->current_loan['amount'],
				'status'		=> 'paid',
				'payment_date' 	=> ''
			);

			if( $this->database_model->loan_update( $this->loan_id , $data ) ){
				//TODO: Mail!
				return TRUE;
			} else {
				return FALSE;
			}
		}
	}

	public function _partly_paid()
	{
		if($this->current_loan['status'] != 'paid')
		{
			$amount = $this->input->post('amount1').$this->input->post('amount2');
			
			//Load form validation library
			$this->load->library('form_validation');

			//Rules
			$this->form_validation->set_rules('amount1', 'Bedrag voor de komma', 'required|max_length[8]|greater_than[0]|numeric|is_natural_no_zero|callback__higher_than_total['.$amount.','.$this->current_loan['amount'].']');
			$this->form_validation->set_rules('amount2', 'Bedrag achter de komma', 'required|exact_length[2]|numeric|is_natural');

			//Set validation delimiters
			$this->form_validation->set_error_delimiters('<br />', '');

			//Run
			if ($this->form_validation->run() == FALSE)
			{
				//Fail -> show view with errors
				return FALSE;
			}
			else
			{
				//Fully paid?
				if($amount == $this->current_loan['amount']){
					$data = array(
						'amount_paid' 	=> $amount,
						'status'		=> 'paid',
						'payment_date' 	=> ''
					);
				} else {
					$data = array(
						'amount_paid' 	=> $amount
					);
				}

				if( $this->database_model->loan_update( $this->loan_id , $data ) ){
					//TODO: Mail!
					return TRUE;
				} else {
					return FALSE;
				}
			}
		}
	}

	public function _higher_than_total($value,$posted)
	{
		$amount = explode(',',$posted);
		if($amount[0] > $amount[1]){
			$this->form_validation->set_message('_higher_than_total', 'Het ingevoerde bedrag kan niet hoger zijn dan het geleende bedrag.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function _valid_date($value)
	{
		$this->form_validation->set_message('_valid_date', 'Er is geen geldige datum opgegeven. Deze kan niet vandaag en in het verleden zijn en mag maximaal 3 maanden later gezet worden.');
		$date_split = explode('-',$value);
		//Valid date?
		if( checkdate($date_split[1],$date_split[0],$date_split[2]) ){
			//Today or in the past?
			if( mktime(0,0,0,$date_split[1],$date_split[0],$date_split[2]) > mktime(0,0,0,date('m'),date('d'),date('Y')) ){
				//Max. 3 months?
				if( mktime(0,0,0,$date_split[1],$date_split[0],$date_split[2]) < strtotime('+3 months') ){
					return TRUE;
				} else {
					return FALSE;
				}
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

}