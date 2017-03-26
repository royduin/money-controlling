<? echo $this->load->view('emails/header'); ?>

Contact via Money Controlling.<br />
<br />
<b>Naam</b> <? echo html_escape($name); ?><br />
<b>Email</b> <? echo html_escape($email); ?><br />
<b>Bericht</b><br />
-----------<br />
<? echo nl2br(html_escape($message)); ?><br />
-----------<br />

<? echo $this->load->view('emails/footer'); ?>