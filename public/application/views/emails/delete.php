<? echo $this->load->view('emails/header'); ?>

Beste <? echo html_escape($to_name); ?>,<br />
<br />
<? echo html_escape($from_name); ?> heeft de lening verwijderd.<br />

<? echo $this->load->view('emails/footer'); ?>