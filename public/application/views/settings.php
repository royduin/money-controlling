<? echo $this->load->view('layout/header.php'); ?>

<!-- Begin containter -->
<div class="container">

	<h2>Gegevens</h2>
	<div class="alert">
		Velden met * zijn verplicht in te vullen.
	</div>
	<? 
	if(validation_errors()){ 
		echo '<div class="alert alert-error"><button class="close" data-dismiss="alert">×</button><strong>Foutmelding(en):</strong> '.validation_errors().'</div>'; 
	}
	$att = array( 'class' => 'well' );
	echo form_open('settings',$att); ?>

		<label for="name">Naam *</label>
		<input class="span3" type="text" name="name" id="name" value="<? echo set_value('name', html_escape($data['name'])); ?>" />

		<label for="email">Email *</label>
		<input class="span3" type="email" name="email" id="email" value="<? echo set_value('email', html_escape($data['email'])); ?>" />

		<label for="info">Betalings informatie</label>
		<em>Geef hier bijvoorbeeld uw rekening nummer op</em><br />
		<textarea class="span3" name="info" id="info"><? echo set_value('info', html_escape($data['info'])); ?></textarea>

		<label for="password">Uw huidige wachtwoord *</label>
		<input class="span3" type="password" name="password" id="password" />

		<p id="change_password_text"><a href="#">Wachtwoord wijzigen</a></p>

		<div id="change_password">

			<label for="password_new">Nieuw wachtwoord</label>
			<input class="span3" type="password" name="password_new" id="password_new" />

			<label for="password_new2">Herhaal nieuw wachtwoord</label>
			<input class="span3" type="password" name="password_new2" id="password_new2" />

		</div>

		<div class="form-actions">
			<button type="submit" name="save" class="btn btn-success mobile-button">
				<i class="icon-ok icon-white"></i> <strong>Opslaan</strong>
			</button>
		</div>

	</form>

<? echo $this->load->view('layout/footer.php'); ?>