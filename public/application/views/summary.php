<? echo $this->load->view('layout/header.php'); ?>

	<h2>Overzicht</h2>
  <?
  if($this->uri->segment(2) == 'inactive'){
  ?>
	<div class="alert alert-error">
	  	<button class="close" data-dismiss="alert">×</button>
	  	Een lening heeft de status inactief als deze nog niet geverifieerd is. Na het toevoegen van een lening wordt er een email verzonden naar de persoon waarvan je nog geld krijgt met de vraag of dit klopt. Wanneer dit klopt zal deze actief worden. Anders worden de gegevens gewist.
	</div>
  <?
  }
  ?>

	<ul class="nav nav-tabs">
	<?
	if($this->uri->segment(2) == 'inactive'){
	?>
	  	<li><a href="<? echo site_url('summary/open'); ?>">Openstaand</a></li>
	  	<li><a href="<? echo site_url('summary/paid'); ?>">Voldaan</a></li>
	  	<li class="active"><a href="<? echo site_url('summary/inactive'); ?>">Inactief</a></li>
	<?
	} elseif($this->uri->segment(2) == 'paid'){
	?>
	  	<li><a href="<? echo site_url('summary/open'); ?>">Openstaand</a></li>
	  	<li class="active"><a href="<? echo site_url('summary/paid'); ?>">Voldaan</a></li>
	  	<li><a href="<? echo site_url('summary/inactive'); ?>">Inactief</a></li>
	<?
	} else {
	?>    
	  	<li class="active"><a href="<? echo site_url('summary/open'); ?>">Openstaand</a></li>
	  	<li><a href="<? echo site_url('summary/paid'); ?>">Voldaan</a></li>
	  	<li><a href="<? echo site_url('summary/inactive'); ?>">Inactief</a></li>
	<?
	}
	?>
</ul>

  <?
  if(!$data){
  ?>
  <div class="alert alert-error">
	Er zijn (momenteel) geen leningen met deze status.
  </div>
  <?
  } else {
  ?>
	<table class="table table-striped">
		<thead>
		  	<tr>
				<th width="25%">Aan/Van</th>
				<? if($this->uri->segment(2) == 'paid'){ ?>
					<th width="20%">Bedrag</th>
				<? } else { ?>
					<th width="20%">Openstaand</th>
				<? } ?>
				<th width="30%">Datum</th>
				<th width="25%"></td>
		  	</tr>
		</thead>
		<tbody>
		  	<?
		  	foreach($data as $item){
		  	?>
				<tr>
				  	<?
				  	if( $this->session->userdata('user_id') == $item['to'] ){
				  	?>
						<td><? echo html_escape($item['from_name']); ?></td>
						<? if($this->uri->segment(2) == 'paid'){ ?>
							<td><span class="label label-important mobile-label">&euro;<? echo convert_prices($item['amount']); ?></span></td>
						<? } else { ?>
							<td><span class="label label-important mobile-label">&euro;<? echo convert_prices($item['amount'] - $item['amount_paid']); ?></span></td>
						<? } ?>
						<td><? echo convert_dates($item['date']); ?></td>
						<td class="align_right"><a href="<? echo site_url('loan/'.$item['id']); ?>" class="btn btn-danger btn-mini mobile-a-button">Bekijk <i class="icon-chevron-right icon-white hidden-phone"></i></a></td>
				  	<?
				  	} else {
				  	?>
						<td><? echo html_escape($item['to_name']); ?></td>
						<? if($this->uri->segment(2) == 'paid'){ ?>
							<td><span class="label label-success mobile-label">&euro;<? echo convert_prices($item['amount']); ?></span></td>
						<? } else { ?>
							<td><span class="label label-success mobile-label">&euro;<? echo convert_prices($item['amount'] - $item['amount_paid']); ?></span></td>
						<? } ?>
						<td><? echo convert_dates($item['date']); ?></td>
						<td class="align_right"><a href="<? echo site_url('loan/'.$item['id']); ?>" class="btn btn-success btn-mini mobile-a-button">Bekijk <i class="icon-chevron-right icon-white hidden-phone"></i></a></td>
				  	<?
				  	}
				  	?>
				</tr>
			<?
			}
			?>
		</tbody>
	</table>
	<hr />
	<strong>Legenda:</strong> <span class="label label-success">Uitgeleend</span> <span class="label label-important">Geleend</span>
  <?
  }
  ?>

  <!--
  <div class="pagination pagination-centered">
	<ul>
	  <li><a href="#">Vorige</a></li>
	  <li class="active">
		<a href="#">1</a>
	  </li>
	  <li><a href="#">2</a></li>
	  <li><a href="#">3</a></li>
	  <li><a href="#">4</a></li>
	  <li><a href="#">Volgende</a></li>
	</ul>
  </div>
  -->

<? echo $this->load->view('layout/footer.php'); ?>