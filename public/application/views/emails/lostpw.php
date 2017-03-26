<? echo $this->load->view('emails/header'); ?>

Beste <? echo html_escape($name); ?>,<br />
<br />
Via onze website is een verzoek ingediend om een nieuw wachtwoord in te stellen voor uw account bij Money Controlling.<br />
<br />
Via de onderstaande link kan je een nieuw wachtwoord instellen.<br />
Mocht je geen nieuw wachtwoord aangevraagd hebben kan je deze email als niet verzonden beschouwen.<br />
<br />
<a href="<? echo site_url('lostpw/set/'.$id.'/'.$pwreset); ?>" style="font-weight: bold; background-color: #05C; padding: 10px; color: #FFF; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; margin-top: 5px; margin-bottom: 5px;">Wachtwoord opnieuw instellen</a><br />

<? echo $this->load->view('emails/footer'); ?>