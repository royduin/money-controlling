<h2>Betaling gedaan?</h2>

<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">×</button>
	Hierbij wordt er enkel een email verstuurd naar <? echo html_escape($from_name); ?> zodat hij of zij vervolgens kan aangeven dat er een bedrag ontvangen is.
</div>

<? echo form_open(); ?>

<button type="submit" name="submit" class="btn btn-success mobile-button">
	<i class="icon-ok icon-white"></i> <strong>Ja</strong>
</button>

<a href="<? echo str_replace('/'.$uri_option,'',current_url()); ?>" class="btn mobile-a-button">
	<i class="icon-remove"></i> <strong>Annuleren</strong>
</a>

</form>