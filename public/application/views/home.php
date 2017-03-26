<? echo $this->load->view('layout/header'); ?>

	<? if($this->session->userdata('user_id')){ ?>
		<script>users = <? echo $this->database_model->get_autocomplete($this->session->userdata('user_id')); ?></script>
	<? } ?>

	<!-- Open form -->
	<? 
	$att = array('id' => 'masterform');
	echo form_open('home/submit', $att); 
	?>
	  
	  	<div id="click_menu">Klik hier om het menu te openen <img src="<? echo site_url('img/arrow.png'); ?>" alt="" /></div>

	  	<!--<div class="alert alert-error"><strong>LET OP! Website is nog in ontwikkeling! Voor vragen neem contact op.</strong></div>-->

	  	<? echo $this->session->userdata('user_id') ? '<div class="hero-unit hidden-phone">' : '<div class="hero-unit">'; ?>
			<h1>Money Controlling</h1>
			<p>Iedereen heeft het wel, je leent geld uit, vergeet het of krijgt het niet meer terug. Hier de oplossing! Volg een aantal simpele stappen en wij zorgen voor herinneringen en een overzicht van eventueel meerdere leningen.</p>
			<p><a class="btn btn-primary btn-large" href="<? echo site_url('faq'); ?>"><strong><i class="icon-thumbs-up icon-white"></i> Hoe werkt het?</strong></a></p>
	  	</div>

	  	<? 
	  	if(validation_errors()){ 
			echo '<div class="alert alert-error"><button class="close" data-dismiss="alert">×</button><strong>Foutmelding(en):</strong> '.validation_errors().'</div>'; 
	  	}
	  	?>
		<div class="row">
	  		<? echo $this->session->userdata('user_id') ? '<div class="span3 hidden-phone">' : '<div class="span3">'; ?>
				<h2>Wie ben je?</h2>
				<label for="login_email">Je email adres</label>
		  		<? if($this->session->userdata('user_id')){ ?>
		  			<h3><? echo html_escape($this->database_model->email_by_user_id($this->session->userdata('user_id'))); ?></h3>
		  		<? } else { ?>
					<input class="span3" type="email" name="login_email" id="login_email" placeholder="Email adres" value="<?php echo set_value('login_email'); ?>" />
		  		<? } ?>

		  		<div id="login_hide_password">
					<label for="login_password">Je wachtwoord</label>
					<input class="span3" type="password" name="login_password" id="login_password" placeholder="Wachtwoord" />
		  		</div>

		  		<div id="login_hide_name">
					<label for="login_name">Je naam</label>
					<? if($this->session->userdata('user_id')){ ?>
			 	 		<h3><? echo html_escape($this->database_model->name_by_user_id($this->session->userdata('user_id'))); ?></h3>
			 	 		<a href="<? echo site_url('logout'); ?>">Ben je dit niet?</a>
					<? } else { ?>
			  			<input class="span3" type="text" name="login_name" id="login_name" placeholder="Naam" value="<?php echo set_value('login_name'); ?>" />
					<? } ?>
		  		</div>
	  		</div>
	  		<div class="span3 login_hide">
				<h2>Aan wie?</h2>
		  		<label for="autocomplete_name">Zijn/haar naam</label>
		  		<input class="span3" type="text" name="name" id="autocomplete_name" placeholder="Naam" value="<?php echo set_value('name'); ?>" />
		  		<label for="autocomplete_email">Zijn/haar email adres</label>
		  		<input class="span3" type="email" name="email" id="autocomplete_email" placeholder="Email adres" value="<?php echo set_value('email'); ?>" />
	  		</div>
	  		<div class="span3 login_hide">
				<h2>Hoeveel en waarom?</h2>
		  		<label for="amount1">Bedrag</label>
		  		<div class="input-prepend">
					<span class="add-on"><strong>&euro;</strong></span><input type="text" class="span1" name="amount1" id="amount1" placeholder="0" value="<?php echo set_value('amount1'); ?>" /><span class="add-on"><strong>,</strong></span><input type="text" class="span1" name="amount2" id="amount2" placeholder="00" value="<?php echo set_value('amount2','00'); ?>" />
		  		</div>
		  		<label for="reason">Reden</label>
		  		<textarea class="span3" name="reason" id="reason" placeholder="Reden..."><?php echo set_value('reason'); ?></textarea>
	  		</div>
	  		<div class="span3 login_change">
				<p>Door te klikken op opslaan ga je akkoord met onze <a href="<? echo site_url(); ?>conditions">voorwaarden</a>.</p>
				<button type="submit" name="save" id="save_results" class="btn btn-success btn-large mobile-button">
		  			<i class="icon-ok icon-white"></i> <strong>Opslaan</strong>
				</button>
	  		</div>
		</div>
	</form>

  	<hr />

  	<div id="myCarousel" class="carousel slide">
		<!-- Carousel items -->
		<div class="carousel-inner">
	  		<div class="active item">
				<blockquote>
		  			<p>Geweldige website! Eindelijk overzicht van wat ik uitleen!</p>
		  			<small>Jan Pieters</small>
				</blockquote>
	  		</div>
	  		<div class="item">
				<blockquote class="pull-right">
		  			<p>Inmiddels heel wat geld terug gekregen van wat ik heb uitgeleend. Handig dit!</p>
		  			<small>Lars</small>
				</blockquote>
	  		</div>
	  		<div class="item">
				<blockquote>
		  			<p>Website werkt erg fijn op mijn telefoon als tablet.</p>
		  			<small>Mohammed</small>
				</blockquote>
	  		</div>
	  		<div class="item">
				<blockquote class="pull-right">
		  			<p>Eenvoudig en handig!</p>
		  			<small>Tim</small>
				</blockquote>
	  		</div>
		</div>
		<!-- Carousel nav -->
		<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		<a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
  	</div>

<? echo $this->load->view('layout/footer'); ?>