<? if($status != 'paid'){ ?>
	<? if($to_id == $this->session->userdata('user_id')) { ?>
		<? if($status == 'inactive'){ ?>
			<h2>Klopt het dat <? echo html_escape($from_name); ?> nog &euro;<? echo convert_prices($amount); ?> van je krijgt?</h2>
			<a class="btn btn-success mobile-a-button" href="<? echo site_url('confirm/yes/'.$id.'/'.$unique_id.'/summary'); ?>">Ja dat klopt</a>
			<a class="btn btn-danger mobile-a-button" href="<? echo site_url('confirm/no/'.$id.'/'.$unique_id.'/summary'); ?>">Nee</a>
		<? } else { ?>
			<a class="btn btn-success mobile-a-button" href="<? echo site_url('loan/'.$id.'/payment'); ?>">Betaling gedaan</a>
			<a class="btn btn-warning mobile-a-button" href="<? echo site_url('loan/'.$id.'/payment_date'); ?>">Datum van betaling opgeven</a>
		<? } ?>
	<? } else { ?>
		<a class="btn btn-success mobile-a-button" href="<? echo site_url('loan/'.$id.'/fully_paid'); ?>">Volledig betaald</a>
		<a class="btn btn-warning mobile-a-button" href="<? echo site_url('loan/'.$id.'/partly_paid'); ?>">Deels betaald</a>
		<a class="btn btn-primary mobile-a-button" href="<? echo site_url('loan/'.$id.'/edit'); ?>">Lening wijzigen</a>
		<a class="btn btn-danger mobile-a-button" href="<? echo site_url('loan/'.$id.'/delete'); ?>">Lening verwijderen</a>
	<? } ?>
<? } ?>