<h2>Lening verwijderen?</h2>

<? echo form_open(); ?>

<button type="submit" name="submit" class="btn btn-danger mobile-button">
	<i class="icon-ok icon-white"></i> <strong>Ja</strong>
</button>

<a href="<? echo str_replace('/'.$uri_option,'',current_url()); ?>" class="btn mobile-a-button">
	<i class="icon-remove"></i> <strong>Annuleren</strong>
</a>

</form>