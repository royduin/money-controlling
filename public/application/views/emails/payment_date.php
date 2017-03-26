<? echo $this->load->view('emails/header'); ?>

Beste <? echo html_escape($from_name); ?>,<br />
<br />
<? echo html_escape($to_name); ?> heeft aangegeven op <? echo date('d-m-Y',$payment_date); ?> te gaan betalen.<br />
Tot die datum zal hij of zij geen herinneringen meer ontvangen over deze lening.<br />
<br />
<a href="<? echo site_url('loan/'.$id); ?>" style="font-weight: bold; background-color: #05C; padding: 10px; color: #FFF; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; margin-top: 5px; margin-bottom: 5px;">Lening bekijken</a>

<? echo $this->load->view('emails/footer'); ?>