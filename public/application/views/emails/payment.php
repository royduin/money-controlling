<? echo $this->load->view('emails/header'); ?>

Beste <? echo html_escape($from_name); ?>,<br />
<br />
Klopt het dat <? echo html_escape($to_name); ?> de lening (deels) betaald heeft?<br />
<br />
<a href="<? echo site_url('loan/'.$id.'/fully_paid'); ?>" style="font-weight: bold; background-color: #05C; padding: 10px; color: #FFF; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; margin-top: 5px; margin-bottom: 5px;">Volledig betaald</a><br />
<br /><br />
<a href="<? echo site_url('loan/'.$id.'/partly_paid'); ?>" style="font-weight: bold; background-color: #05C; padding: 10px; color: #FFF; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; margin-top: 5px; margin-bottom: 5px;">Deels betaald</a>

<? echo $this->load->view('emails/footer'); ?>