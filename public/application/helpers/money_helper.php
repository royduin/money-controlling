<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Converts date to local
function convert_dates($date){
	$date = explode("-", $date);
	$date = $date[2].'-'.$date[1].'-'.$date[0];
	return $date;
}

//Add comma to prices
function convert_prices($price){
	if($price == 0){
		$price = '0,00';
	} else {
		$price_front = substr($price, 0, -2);
		if(!$price_front){
			$price_front = 0;
		}
		$price_back = substr($price, -2);
		if(strlen($price_back) == 1){
			$price_back = '0'.$price_back;
		}
		$price = $price_front.','.$price_back;
	}
	return $price;
}

function translate_status($status){
	switch($status)
    {
    	case 'open':
    		$status = 'Openstaand';
    		break;
    	case 'inactive':
    		$status = 'Inactief';
    		break;
    	case 'paid':
    		$status = 'Voldaan';
    		break;
    }
    return $status;
}

/* End of file money_helper.php */
/* Location: ./application/helpers/money_helper.php */