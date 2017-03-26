<h2>Lening wijzigen</h2>

<? echo form_open(); ?>

<?
$prijs = $amount;
if($prijs == 0){
	$amount_front 	= '0';
	$amount_back 	= '00';
} else {
	$amount_front = substr($prijs, 0, -2);
	if(!$amount_front){
		$amount_front 	= '0';
	}
	$amount_back = substr($prijs, -2);
}
?>

<? 
if(validation_errors()){ 
	echo '<div class="alert alert-error"><button class="close" data-dismiss="alert">×</button><strong>Foutmelding(en):</strong> '.validation_errors().'</div>'; 
}
?>

<label for="amount1">Totaal bedrag</label>
<div class="input-prepend">
	<span class="add-on"><strong>&euro;</strong></span><input type="text" class="span1" name="amount1" id="amount1" placeholder="0" value="<?php echo set_value('amount1',$amount_front); ?>" /><span class="add-on"><strong>,</strong></span><input type="text" class="span1" name="amount2" id="amount2" placeholder="00" value="<?php echo set_value('amount2',$amount_back); ?>" />
</div>

<label for="reason">Omschrijving</label>
<textarea class="span3" name="reason" id="reason" placeholder="Reden..."><? echo set_value('reason',html_escape($definition)); ?></textarea>

<br />

<button type="submit" name="submit" class="btn btn-primary mobile-button">
	<i class="icon-ok icon-white"></i> <strong>Wijzigen</strong>
</button>

<a href="<? echo str_replace('/'.$uri_option,'',current_url()); ?>" class="btn mobile-a-button">
	<i class="icon-remove"></i> <strong>Annuleren</strong>
</a>

</form>