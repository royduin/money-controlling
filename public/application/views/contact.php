<? echo $this->load->view('layout/header'); ?>

	<h2>Contact</h2>

	<p class="well">Mochten er vragen en/of onduidelijkheden zijn kan je gebruik maken van het contact formulier hieronder. Ik (<a href="http://royduineveld.nl/" target="_blank">Roy Duineveld</a>, ontwikkelaar en beheerder van Money Controlling) streef ernaar je bericht zo spoedig mogelijk te beantwoorden.</p>

	<? 
	if(validation_errors()){ 
		echo '<div class="alert alert-error"><button class="close" data-dismiss="alert">×</button><strong>Foutmelding(en):</strong> '.validation_errors().'</div>'; 
	} elseif( $this->uri->segment(2) == 'success' ){
		echo '<div class="alert alert-success"><button class="close" data-dismiss="alert">×</button><strong>Je bericht is verzonden! Wij doen ons uiterste best zo spoedig mogelijk te reageren!</strong></div>'; 
	}
	$att = array('class' => 'well');
	echo form_open('contact',$att);
	?>

		<label for="name">Naam</label>
		<input class="span3" type="text" name="name" id="name" value="<? echo set_value('name'); ?>" placeholder="Naam">

		<label for="email">Email adres</label>
		<input class="span3" type="email" name="email" id="email" value="<? echo set_value('email'); ?>" placeholder="Email">

		<label for="message">Bericht</label>
		<textarea class="span3" name="message" id="message" placeholder="Bericht..." rows="5"><? echo set_value('message'); ?></textarea>

	  	<div class="form-actions">
	  		<button type="submit" class="btn btn-primary mobile-button">Verzenden</button>
	  	</div>

	</form>

<? echo $this->load->view('layout/footer'); ?>