<h2>Datum van betaling opgeven</h2>

<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">×</button>
	Door hier een datum op te geven dat u gaat betalen zult u tot die datum geen herinneringen meer ontvangen over deze lening.
</div>

<? echo form_open(); ?>

<? 
if(validation_errors()){ 
	echo '<div class="alert alert-error"><button class="close" data-dismiss="alert">×</button><strong>Foutmelding(en):</strong> '.validation_errors().'</div>'; 
}
?>

<label for"date">Datum</label>
<?
if($payment_date){
	$date_value = set_value('date',date('d-m-Y',$payment_date));
} else {
	$date_value = set_value('date',date('d-m-Y'));
}
?>
<input type="text" name="date" id="date" value="<? echo $date_value; ?>" placeholder="<? echo date('d-m-Y'); ?>" />
<span class="help-block">Voorbeeld: <? echo date('d-m-Y'); ?></span>

<button type="submit" name="submit" class="btn btn-success mobile-button">
	<i class="icon-ok icon-white"></i> <strong>Opslaan</strong>
</button>

<a href="<? echo str_replace('/'.$uri_option,'',current_url()); ?>" class="btn mobile-a-button">
	<i class="icon-remove"></i> <strong>Annuleren</strong>
</a>

</form>