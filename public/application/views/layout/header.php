<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="nl"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="nl"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="nl"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="nl"> <!--<![endif]-->

<!-- Manifest test:  manifest="<? echo site_url(); ?>mc.appcache" -->
<!-- Manifest test2:  manifest="<? echo site_url(); ?>manifest.php" -->

<head>
	<meta charset="utf-8">

	<title><? echo isset($page_title) ? $page_title : 'Money Controlling'; ?></title>
	<meta name="description" content="<? echo isset($page_description) ? $page_description : 'Iedereen heeft het wel, je leent geld uit, vergeet het of krijgt het niet meer terug. Hier de oplossing! Volg een aantal simpele stappen en wij zorgen voor herinneringen en een overzicht van eventueel meerdere leningen.'; ?>">
	<meta name="author" content="Roy Duineveld">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta name="google-site-verification" content="omeY2LOv3N3MC5fkqgX3W3SMKzCNzgUEmFG4Y_m5gKc" />

	<link rel="stylesheet" href="<? echo site_url(); ?>css/bootstrap.min.css">
	<style>
	body {
	padding-top: 60px;
	padding-bottom: 40px;
	}
	</style>
	<link rel="stylesheet" href="<? echo site_url(); ?>css/jquery-ui-1.8.24.custom.css" />
	<link rel="stylesheet" href="<? echo site_url(); ?>css/bootstrap-responsive.min.css">
	<link rel="stylesheet" href="<? echo site_url(); ?>css/style.css?v=<? echo $this->config->item('version'); ?>">

	<script src="<? echo site_url(); ?>js/libs/modernizr-2.5.3.min.js"></script>
</head>
<body>

	<!-- Begin navbar -->
	<div class="navbar navbar-fixed-top">
	  	<div class="navbar-inner">
			<div class="container">
		  		<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
		  		</a>
		  		<a class="brand" href="<? echo site_url(); ?>">Money Controlling</a>
		  		<div class="nav-collapse">
					<ul class="nav">
						<li<? if( $this->uri->segment(1) == '' OR $this->uri->segment(1) == 'home' ){ echo ' class="active"'; } ?>><a href="<? echo site_url(); ?>">Home</a></li>
						<? /* if( $this->uri->segment(1) == '' OR $this->uri->segment(1) == 'home' ){ echo '<li id="what_is_li"><a href="#" id="what_is_a">Wat is Money Controlling?</a></li>'; } */ ?>
						<li<? if( $this->uri->segment(1) == 'faq' ){ echo ' class="active"'; } ?>><a href="<? echo site_url(); ?>faq">FAQ</a></li>
						<li<? if( $this->uri->segment(1) == 'contact' ){ echo ' class="active"'; } ?>><a href="<? echo site_url(); ?>contact">Contact</a></li>
					</ul>
					<ul class="nav pull-right">
			  			<? if(!$this->session->userdata('logged_in')){ ?>
							<? if( $this->uri->segment(1) == '' OR $this->uri->segment(1) == 'home' ){ ?>
				  				<li><a href="#login" id="toggle_login">Inloggen</a></li>
							<? } else { ?>
				  				<li><a href="<? echo site_url('#login'); ?>" id="toggle_login">Inloggen</a></li>
							<? } ?>
			  			<? } else { ?>
							<li class="dropdown" id="logged_in">
				  				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><? echo html_escape($this->database_model->name_by_user_id($this->session->userdata('user_id'))); ?> <b class="caret"></b></a>
				  				<ul class="dropdown-menu">
									<li><a href="<? echo site_url('settings'); ?>">Gegevens</a></li>
									<li><a href="<? echo site_url('summary'); ?>">Leningen</a></li>
									<li class="divider"></li>
									<li><a href="<? echo site_url('logout'); ?>">Uitloggen</a></li>
				  				</ul>
							</li>
			  			<? } ?>
					</ul>

		  		</div>
			</div>
	  	</div>
	</div>
	<!-- End navbar -->

	<!-- Begin containter -->
	<div class="container">

		<!--[if lt IE 7]><div class="alert alert-error"><button class="close" data-dismiss="alert">×</button><strong>Je browser is verouderd! <a href="http://browsehappy.com/" target="_blank">Gebruik een andere browser</a> of <a href="http://www.google.com/chromeframe/?redirect=true" target="_blank">installeer Google Chrome Frame</a> om deze website optimaal te gebruiken.</strong></div><![endif]-->
