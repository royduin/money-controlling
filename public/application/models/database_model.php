<?php

class Database_model extends CI_Model {

	//Check if the email exists
	function email_exist($email)
	{
		if($email){
			$query = $this->db->get_where('users', array('email' => $email));
			if($query->num_rows == 1){
				return TRUE;
			}
		}
	}

	//Check if email/password combination exists
	function validate_credentials($email,$password)
	{
		if($email AND $password){
			$array = array(
							'email' 	=> $email,
							'password' 	=> sha1($password.$this->config->item('encryption_key')) 
						  );
			$query = $this->db->get_where( 'users', $array );
			if($query->num_rows == 1){
				return TRUE;
			}
		}
	}

	//Create new user
	function create_user($name, $email, $password)
	{
		$insert = array(
			'name'		=>	$name,
			'email'		=>	$email,
			'password'	=>	$password
			);
		$this->db->insert('users', $insert);
		return $this->db->insert_id();
	}

	//Edit user
	function edit_user($name,$email,$info,$password=FALSE)
	{
		if($password){
			$data = array(
				'name'		=> $name,
				'email'		=> $email,
				'info'		=> $info,
				'password'	=> $password
				);
		} else {
			$data = array(
				'name'		=> $name,
				'email'		=> $email,
				'info'		=> $info
				);
		}
		$this->db->where('id', $this->session->userdata('user_id'));
		$this->db->update('users', $data);
	}

	//Get user id by email
	function user_id_by_email($email)
	{
		$query = $this->db->get_where('users', array('email' => $email));
		$result = $query->row_array();
		return $result['id'];
	}

	//Get name by email
	function name_by_email($email)
	{
		$query = $this->db->get_where('users', array('email' => $email));
		$result = $query->row_array();
		return $result['name'];
	}

	//Get name by id
	function name_by_user_id($id)
	{
		$query = $this->db->get_where('users', array('id' => $id));
		$result = $query->row_array();
		return $result['name'];
	}

	//Get email by id
	function email_by_user_id($id)
	{
		$query = $this->db->get_where('users', array('id' => $id));
		$result = $query->row_array();
		return $result['email'];
	}

	//Get info by id
	function info_by_user_id($id)
	{
		$query = $this->db->get_where('users', array('id' => $id));
		$result = $query->row_array();
		return $result['info'];
	}

	//Get user info in array by id
	function get_user_info_by_id($id)
	{
		$query = $this->db->get_where('users', array('id' => $id));
		return $query->row_array();
	}

	//Save loan in database
	function save_loan($from, $to, $amount, $definition)
	{
		$unique_id	= random_string('sha1');
		$insert = array(
			'from'			=>	$from,
			'to'			=>	$to,
			'amount'		=>	$amount,
			'amount_paid'	=>	0,
			'definition'	=>	$definition,
			'date'			=>	date('Y-m-d'),
			'status' 		=> 	'inactive',
			'unique_id' 	=> 	$unique_id
			);
		$this->db->insert('loans', $insert);
		return $unique_id;
	}

	//Get a loan in a array
	function get_loan($id)
	{
		$query = $this->db->get_where('loans',array('id' => $id));
		$result = $query->row_array();
		return $result;
	}

	//Get loan state
	function get_loan_state($id)
	{
		$query = $this->db->get_where('loans',array('id' => $id));
		$result = $query->row_array();
		if($result){
			return $result['status'];
		} else {
			return FALSE;
		}
	}

	//Set loan state
	function set_loan_state($id,$state)
	{
		$data = array(
			'status'		=> $state
			);
		$this->db->where('id', $id);
		$this->db->update('loans', $data);
	}

	//Delete loan
	function delete_loan($id)
	{
		$this->db->delete('loans', array('id' => $id)); 
	}

	//Set loan fully paid
	function set_loan_paid_full($id)
	{
		$amount = $this->get_loan($id);
		$amount = $amount['amount'];
		$data = array(
			'status'		=> 	'paid',
			'amount_paid'	=>	$amount
			);
		$this->db->where('id', $id);
		$this->db->update('loans', $data);
	}

//SUMMARY

	//Get all loans in an array
	function get_summary($user_id, $status)
	{
		$this->db->select('
							loans.id,
							loans.from,
							loans.to,
							loans.amount,
							loans.amount_paid,
							loans.definition,
							loans.date,
							loans.status,
							loans.unique_id,
							loans.payment_date,
							ufrom.id AS from_id,
							ufrom.name AS from_name,
							uto.id AS to_id,
							uto.name AS to_name');
		$this->db->from('loans');
		$this->db->where("(loans.from='$user_id' OR loans.to='$user_id') AND loans.status='$status'", NULL, FALSE);
		$this->db->order_by('date', 'desc');
		$this->db->join('users AS ufrom','ufrom.id = loans.from');
		$this->db->join('users AS uto','uto.id = loans.to');
		$query = $this->db->get();
		return $query->result_array();
	}

//LOANS

	//Update loan
	function loan_update($id,$data)
	{
		$this->db->where('id', $id);
		return $this->db->update('loans', $data);
	}

	//Get a loan in a array
	function loan_get($id, $unique_id = FALSE)
	{
		$this->db->select('
							loans.id,
							loans.amount,
							loans.amount_paid,
							loans.definition,
							loans.date,
							loans.status,
							loans.unique_id,
							loans.payment_date,
							ufrom.id AS from_id,
							ufrom.name AS from_name,
							ufrom.email AS from_email,
							ufrom.info AS from_info,
							uto.id AS to_id,
							uto.name AS to_name,
							uto.email AS to_email,
							uto.info AS to_info');
		$this->db->from('loans');
		if($unique_id){
			$this->db->where(array('loans.id' => $id,'unique_id' => $unique_id));
		} else {
			$this->db->where(array('loans.id' => $id));
		}
		$this->db->join('users AS ufrom','ufrom.id = loans.from');
		$this->db->join('users AS uto','uto.id = loans.to');
		$query = $this->db->get();
		return $query->row_array();
	}

	//Delete loan
	function loan_delete($id)
	{
		return $this->db->delete('loans', array('id' => $id));
	}

//USERS

	//Get user info in a array
	function user_get($value,$email = FALSE)
	{
		if($email){
			$query = $this->db->get_where('users', array('email' => $value));
		} else {
			$query = $this->db->get_where('users', array('id' => $value));
		}
		return $query->row_array();
	}

//CRON

	//Get all loans in an array
	function get_for_cron($timestamp)
	{
		$this->db->select('
							loans.id,
							loans.from,
							loans.to,
							loans.amount,
							loans.amount_paid,
							loans.definition,
							loans.date,
							loans.status,
							ufrom.name AS from_name,
							ufrom.email AS from_email,
							uto.name AS to_name,
							uto.email AS to_email');
		$this->db->from('loans');
		$this->db->where("(loans.payment_date='' OR loans.payment_date <= '$timestamp') AND loans.status='open'", NULL, FALSE);
		$this->db->join('users AS ufrom','ufrom.id = loans.from');
		$this->db->join('users AS uto','uto.id = loans.to');
		$query = $this->db->get();
		return $query->result_array();
	}

//AUTO COMPLETE

	//Get all users by loans from user
	function get_autocomplete($user_id)
	{
		$this->db->distinct();
		$this->db->select('
							ufrom.name AS from_name,
							ufrom.email AS from_email,
							uto.name AS to_name,
							uto.email AS to_email');
		$this->db->from('loans');
		$this->db->where("loans.from='$user_id' OR loans.to='$user_id'", NULL, FALSE);
		$this->db->join('users AS ufrom','ufrom.id = loans.from');
		$this->db->join('users AS uto','uto.id = loans.to');
		$query = $this->db->get();
		$results = $query->result_array();
		foreach($results as $key=>$result)
		{
			if($result['from_email'] != $this->email_by_user_id($user_id)){
				$results[$key]['label'] = $results[$key]['from_name'];
				$results[$key]['email'] = $results[$key]['from_email'];
			}
			unset($results[$key]['from_name']);
			unset($results[$key]['from_email']);

			if($result['to_email'] != $this->email_by_user_id($user_id)){
				$results[$key]['label'] = $results[$key]['to_name'];
				$results[$key]['email'] = $results[$key]['to_email'];
			}
			unset($results[$key]['to_name']);
			unset($results[$key]['to_email']);
		}
		return json_encode($results);
	}

//LOST PW

	//Save lost pw token
	function lostpw_save_token($email,$token)
	{
		$data = array(
			'pwreset' => $token
			);
		$this->db->where('email', $email);
		return $this->db->update('users', $data);
	}

	//Check credentials
	function lostpw_check($id,$token)
	{
		$query = $this->db->get_where('users', array('id' => $id,'pwreset' => $token));
		if($query->num_rows == 1){
			return TRUE;
		}
		return FALSE;
	}

}