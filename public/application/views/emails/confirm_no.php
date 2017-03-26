<? echo $this->load->view('emails/header'); ?>

Beste <? echo html_escape($from_name); ?>,<br />
<br />
<? echo html_escape($to_name); ?> heeft aangegeven dat de toegevoegde lening <strong>niet</strong> klopt.<br />
De lening is om die reden dan ook verwijderd.

<? echo $this->load->view('emails/footer'); ?>