<? echo $this->load->view('layout/header'); ?>

<div class="alert">
	<? echo $summary; ?> Je wordt doorgestuurd...
</div>

<? if(isset($time)){ ?>
	<meta http-equiv="refresh" content="<? echo $time; ?>;URL=<? echo site_url($page); ?>" />
<? } else { ?>
	<meta http-equiv="refresh" content="2;URL=<? echo site_url($page); ?>" />
<? } ?>

<? echo $this->load->view('layout/footer'); ?>