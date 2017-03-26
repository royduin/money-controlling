<? echo $this->load->view('emails/header'); ?>

Beste <? echo html_escape($name); ?>,<br />
<br />
Welkom bij Money Controlling!<br />
<br />
<? if(isset($to)){ ?>
	Je hebt een email bericht ontvangen dat iemand nog geld van je krijgt. Hij of zij heeft dit aangegeven bij Money Controlling (een eenvoudig hulpmiddel om je leningen te beheren). Vandaar deze email.<br /><br />
<? } ?>
Hieronder de gegevens om te kunnen inloggen.<br />
<br />
<b>Email adres</b> <? echo html_escape($email); ?><br />
<b>Wachtwoord</b> <? echo html_escape($password); ?><br />
<i>Dit wachtwoord kan gewijzigd worden door in te loggen op onze website.</i><br />

<? echo $this->load->view('emails/footer'); ?>