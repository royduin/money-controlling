<? echo $this->load->view('layout/header.php'); ?>

<? if($to_id == $this->session->userdata('user_id')) { ?>
	<h2>Geleend bij <? echo html_escape($from_name); ?></h2>
<? } else { ?>
	<h2>Uitgeleend aan <? echo html_escape($to_name); ?></h2>
<? } ?>

<? if($status == 'inactive'){ ?>
	<div class="alert alert-error">
		<button class="close" data-dismiss="alert">×</button>
		<? if($to_id == $this->session->userdata('user_id')) { ?>
			De lening is inactief omdat je deze nog niet geverifieerd hebt. Geef onderop aan of deze lening klopt.
		<? } else { ?>
			Een lening heeft de status inactief als deze nog niet geverifieerd is. Na het toevoegen van een lening wordt er een email verzonden naar de persoon waarvan je nog geld krijgt met de vraag of dit klopt. Wanneer dit klopt zal deze actief worden. Anders worden de gegevens gewist.
		<? } ?>
	</div>
<? } ?>

<? if($payment_date){ ?>
	<div class="alert alert-info">
		<button class="close" data-dismiss="alert">×</button>
		<? if($to_id == $this->session->userdata('user_id')) { ?>
			Je hebt aangegeven op <? echo date('d-m-Y',$payment_date); ?> te betalen. Tot die tijd ontvang je geen herinneringen meer.
		<? } else { ?>
			<? echo html_escape($to_name); ?> heeft aangegeven op <? echo date('d-m-Y',$payment_date); ?> te betalen. Tot die tijd ontvangt hij of zij geen herinneringen meer.
		<? } ?>
	</div>
<? } ?>

<table class="table table-striped table-bordered table-condensed">
	<tr>
		<th>Status</th>
		<td><? echo translate_status($status); ?></td>
	</tr>
	<tr>
		<th>Datum</th>
		<td><? echo convert_dates($date); ?></td>
	</tr>
	<tr>
		<th>Bedrag</th>
		<td>&euro;<? echo convert_prices($amount); ?></td>
	</tr>
	<tr>
		<th>Bedrag betaald</th>
		<td>&euro;<? echo convert_prices($amount_paid); ?></td>
	</tr>
	<tr>
		<th>Bedrag openstaand</th>
		<? if($status == 'paid'){ ?>
			<td>&euro;<? echo convert_prices($amount - $amount_paid); ?></td>
		<? } else { ?>
			<td><span class="label label-important mobile-label">&euro;<? echo convert_prices($amount - $amount_paid); ?></span></td>
		<? } ?>
	</tr>
	<tr>
		<th>Omschrijving</th>
		<td><? echo nl2br(html_escape($definition)); ?></td>
	</tr>
	<tr>
		<th>Betalings informatie</th>
		<td>
			<? if( ($from_id == $this->session->userdata('user_id') AND $from_info) OR ($to_id == $this->session->userdata('user_id') AND $from_info) ) { ?>
				<? echo html_escape($from_info); ?>
			<? } elseif($from_id == $this->session->userdata('user_id') AND !$from_info) { ?>
				<em>Geen, <a href="<? echo site_url('settings'); ?>">klik hier om informatie toe te voegen</a></em>
			<? } elseif($to_id == $this->session->userdata('user_id') AND !$from_info) { ?>
				<em>Geen</em>
			<? } ?>
		</td>
	</tr>
	<tr>
		<th>Vooruitgang</th>
		<td>
			<?
			$progress = floor($amount_paid * 100 / $amount);
			?>
			<div class="progress progress-success progress-striped">
				<div class="bar" style="width: <? echo $progress; ?>%;">
					<span class="hidden-phone">
						<? if($progress >= 10){ ?>
							<strong><? echo $progress; ?>%</strong>
						<? } ?>
					</span>
				</div>
			</div>
		</td>
	</tr>
</table>
<a class="btn mobile-a-button" href="<? echo site_url('summary/'.$status); ?>">&laquo; Terug naar overzicht</a>

<? echo $options; ?>

<? echo $this->load->view('layout/footer.php'); ?>