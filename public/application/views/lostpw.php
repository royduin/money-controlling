<? echo $this->load->view('layout/header'); ?>

	<h2>Wachtwoord vergeten</h2>
	<p class="well">In het geval dat je je wachtwoord vergeten bent, geef hieronder je email adres op en je ontvangt een email hoe je het wachtwoord opnieuw kan instellen.</p>
	<?
	if(validation_errors()){ 
		echo '<div class="alert alert-error"><button class="close" data-dismiss="alert">×</button><strong>Foutmelding(en):</strong> '.validation_errors().'</div>'; 
	} elseif( $this->uri->segment(2) == 'success' ){
		echo '<div class="alert alert-success"><button class="close" data-dismiss="alert">×</button><strong>Er is een email toegezonden met informatie om het wachtwoord opnieuw in te stellen.</strong></div>'; 
	}
	$att = array('class' => 'well');
	echo form_open('lostpw',$att);
	?>
		<label for="email">Email adres</label>
		<input class="span3" type="email" name="email" id="email" value="<? echo set_value('email'); ?>" placeholder="Email">

		<div class="form-actions">
	  		<button type="submit" class="btn btn-primary mobile-button">Verzenden</button>
	  	</div>
	</form>

<? echo $this->load->view('layout/footer'); ?>