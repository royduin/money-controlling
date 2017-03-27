		<hr>

		<footer>
			<p>&copy; 2011 - <? echo date('Y'); ?> Money Controlling</p>
			<p><a href="<? echo site_url('disclaimer'); ?>">Disclaimer</a> - <a href="<? echo site_url('conditions'); ?>">Voorwaarden</a></p>
		</footer>

	</div>
	<!-- End container -->

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<? echo site_url(); ?>js/libs/jquery-1.7.2.min.js"><\/script>')</script>

	<script src="<? echo site_url(); ?>js/libs/jquery-ui-1.8.24.custom.min.js"></script>

	<script src="<? echo site_url(); ?>js/libs/bootstrap/bootstrap.min.js"></script>

	<script src="<? echo site_url(); ?>js/plugins.js?v=<? echo $this->config->item('version'); ?>"></script>
	<script src="<? echo site_url(); ?>js/script.js?v=<? echo $this->config->item('version'); ?>"></script>

	<? if(isset($scroll_down)){ ?>
		<script>
			$('html, body').animate({scrollTop: $(document).height() }, 800);
		</script>
	<? } ?>


	<script>
	var _gaq=[['_setAccount','XX-XXXXXXXX-X'],['_trackPageview']];
	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
	g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
	s.parentNode.insertBefore(g,s)}(document,'script'));
	</script>

</body>
</html>
