<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Mailer {

	protected $data;
	protected $CI;

	public function __construct($data = array())
    {
    	$this->CI =& get_instance();

    	$this->CI->load->library('email');
		$config['mailtype'] = 'html';
		$this->CI->email->initialize($config);
		$this->CI->email->from('noreply@moneycontrolling.com', 'Money Controlling');
		$this->data 	= $data;

    }

    public function send_message($option, $data = '')
    {
        //Override if library is loaded before
    	if( $data ){
    		$this->data = $data;
    	}

    	$this->CI->email->message( $this->CI->load->view('emails/'.$option,$this->data,TRUE) );

    	switch($option)
    	{
    	// TO options
    		case 'payment_date':
    			$this->CI->email->subject( $this->data['to_name'].' gaat betalen op '.date('d-m-Y',$this->data['payment_date']) );
    			$this->CI->email->to( $this->data['from_email'] );
    			$this->CI->email->reply_to( $this->data['to_email'] , $this->data['to_name'] );
    			break;

    		case 'payment':
    			$this->CI->email->subject( $this->data['to_name'].' heeft aangegeven dat de lening (deels) terug betaald is' );
    			$this->CI->email->to( $this->data['from_email'] );
    			$this->CI->email->reply_to( $this->data['to_email'] , $this->data['to_name'] );
    			break;

    	// FROM options
    		case 'partly_paid':
    			$this->CI->email->subject( $this->data['from_name'].' heeft een betaling ontvangen' );
    			$this->CI->email->to( $this->data['to_email'] );
    			$this->CI->email->reply_to( $this->data['from_email'] , $this->data['from_name'] );
    			break;

    		case 'fully_paid':
    			$this->CI->email->subject( 'De lening bij '.$this->data['from_name'].' is volledig betaald' );
    			$this->CI->email->to( $this->data['to_email'] );
    			$this->CI->email->reply_to( $this->data['from_email'] , $this->data['from_name'] );
    			break;

    		case 'edit':
    			$this->CI->email->subject( $this->data['from_name'].' heeft de lening gewijzigd' );
    			$this->CI->email->to( $this->data['to_email'] );
    			$this->CI->email->reply_to( $this->data['from_email'] , $this->data['from_name'] );
    			break;

    		case 'delete':
    			$this->CI->email->subject( $this->data['from_name'].' heeft de lening verwijderd' );
    			$this->CI->email->to( $this->data['to_email'] );
    			$this->CI->email->reply_to( $this->data['from_email'] , $this->data['from_name'] );
    			break;

    	// CREATE options
    		case 'new_user':
				$this->CI->email->subject( 'Welkom bij Money Controlling' );
    			$this->CI->email->to( $this->data['email'] );
    			break;

    		case 'new_loan':
				$this->CI->email->subject( $this->data['from_name'].' krijgt nog geld van je' );
    			$this->CI->email->to( $this->data['to_email'] );
    			$this->CI->email->reply_to( $this->data['from_email'] , $this->data['from_name'] );
    			break;

        // TO CONFIRM options
            case 'confirm_yes':
                $this->CI->email->subject( $this->data['to_name'].' heeft de lening geverifieerd' );
                $this->CI->email->to( $this->data['from_email'] );
                $this->CI->email->reply_to( $this->data['to_email'] , $this->data['to_name'] );
                break;

            case 'confirm_no':
                $this->CI->email->subject( $this->data['to_name'].' heeft aangegeven dat de lening niet klopt' );
                $this->CI->email->to( $this->data['from_email'] );
                $this->CI->email->reply_to( $this->data['to_email'] , $this->data['to_name'] );
                break;

        // CRONJOB
            case 'cron':
                $this->CI->email->subject( $this->data['from_name'].' krijgt nog steeds geld van je' );
                $this->CI->email->to( $this->data['to_email'] );
                $this->CI->email->reply_to( $this->data['from_email'] , $this->data['from_name'] );
                break;
    	}

    	return $this->CI->email->send();
    }

}