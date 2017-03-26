<? echo $this->load->view('emails/header'); ?>

Beste <? echo html_escape($to_name); ?>,<br />
<br />
<? echo html_escape($from_name); ?> heeft op <? echo convert_dates($date); ?> aangegeven nog &euro;<? echo convert_prices($amount); ?> van je te krijgen. Waarvan <b>&euro;<? echo convert_prices($amount - $amount_paid); ?></b> nog openstaand. Hij of zij heeft daarvoor de volgende reden opgegeven:<br />
<? echo nl2br(html_escape($definition)); ?><br />
<br />
Tot op heden is dit bedrag nog niet volledig terug betaald, vandaar dat je deze email ontvangt.<br />
Mocht je deze lening al wel afbetaald hebben of wil je een datum opgeven dat je gaat betalen, dan kan je dit aangeven:<br />
<br />
<a href="<? echo site_url('loan/'.$id.'/payment'); ?>" style="font-weight: bold; background-color: #05C; padding: 10px; color: #FFF; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; margin-top: 5px; margin-bottom: 5px;">Ik heb betaald</a><br />
<br /><br />
<a href="<? echo site_url('loan/'.$id.'/payment_date'); ?>" style="font-weight: bold; background-color: #05C; padding: 10px; color: #FFF; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; margin-top: 5px; margin-bottom: 5px;">Ik ga betalen op...</a><br />
<br />
Totdat de lening volledig betaald is ontvang je wekelijks (elke zondag) deze email.

<? echo $this->load->view('emails/footer'); ?>