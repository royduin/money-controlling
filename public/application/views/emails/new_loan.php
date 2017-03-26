<? echo $this->load->view('emails/header'); ?>

Beste <? echo html_escape($to_name); ?>,<br />
<br />
<? echo html_escape($from_name); ?> heeft aangegeven nog <b>&euro;<? echo convert_prices($amount); ?></b> van je te krijgen en heeft de volgende reden opgegeven:<br />
<? echo nl2br(html_escape($definition)); ?><br />
<br />
Klopt het dat <? echo html_escape($from_name); ?> dit nog van je krijgt?<br />
<br /><br />
<a href="<? echo site_url('confirm/yes/'.$id.'/'.$unique_id); ?>" style="font-weight: bold; background-color: #05C; padding: 10px; color: #FFF; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; margin-top: 5px; margin-bottom: 5px;">Ja dat klopt</a><br />
<br /><br />
<a href="<? echo site_url('confirm/no/'.$id.'/'.$unique_id); ?>" style="font-weight: bold; background-color: #05C; padding: 10px; color: #FFF; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; margin-top: 5px; margin-bottom: 5px;">Nee dat klopt niet</a><br />

<? echo $this->load->view('emails/footer'); ?>