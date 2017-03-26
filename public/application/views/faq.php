<? echo $this->load->view('layout/header'); ?>

	<h2>Veel gestelde vragen</h2>

	<h3>Hoe werkt het?</h3>
	<dl class="dl-horizontal well">
		<dt>Geld uitgeleend</dt>
		<dd>Vul vervolgens de gegevens in op de begin pagina.</dd>
		<dt>Verificatie</dt>
		<dd>
			Er wordt een email verzonden naar de persoon aan wie je geld hebt uitgeleend met de vraag of dat klopt.
			<dl class="dl-horizontal">
				<dt>Klopt</dt>
				<dd>De lening wordt actief en hij of zij zal wekelijks een email ter herinnering ontvangen.</dd>
				<dt>Klopt niet</dt>
				<dd>Om ongewenste activiteiten te voorkomen wordt de lening direct verwijderd.</dd>
			</dl>
		</dd>
		<dt>Lening beheren</dt>
		<dd>Als de lening (deels) terug betaald is kan je dit zelf aangeven door in te loggen. Daarnaast kan je de lening wijzigen en verwijderen. Mocht je dit vergeten, kan hij of zij aan wie je geld hebt uitgeleend aangeven dat er betaald is. Hiervan wordt je dan op de hoogte gesteld met de vraag dit aan te geven.</dd>
		<dt>Betaling uitstellen</dt>
		<dd>Degene aan wie je geld hebt uitgeleend kan eventueel een datum opgeven van de dag dat hij of zij gaat terug betalen. Tot die tijd ontvangt diegene geen herinneringen meer. Uiteraard wordt je hiervan op de hoogte gesteld.</dd>
	</dl>

	<h3>Waarom Money Controlling gebruiken?</h3>
	<p class="well">Het kan soms lang duren voordat je uitgeleend geld terug krijgt. Dit komt meestal doordat het vergeten wordt. Door bij Money Controlling aan te geven dat je geld hebt uitgeleend worden er wekelijks automatisch herinnerings emails verzonden waardoor je er zelf niet meer om hoef te vragen. Bij elke wijziging wordt je ook weer automatisch op de hoogte gesteld via een email bericht.</p>

	<h3>Welke periode is een lening uit te stellen?</h3>
	<p class="well">Een lening kan door degene aan wie je geld hebt uitgeleend, uitgesteld worden met maximaal 3 maanden. De tijd tot de opgegeven datum worden er geen herinnerings emails meer verzonden. Na deze periode kan er eventueel weer uitstel ingesteld worden. Wanneer de terug betaling ingesteld/uitgesteld wordt ontvang je hier een email bericht over.</p>

	<h3>Kosten? Gratis!</h3>
	<p class="well">Het gebruik van Money Controlling is en blijft gratis.</p>

	<h3>Is er ook een mobiele app beschikbaar?</h3>
	<p class="well">
		Momenteel is er nog geen app beschikbaar. Deze plannen zijn er wel en zodra beschikbaar hier en in de Appstore / Play Store te downloaden. Tot die tijd kan je natuurlijk wel een snelkoppeling of bladwijzer naar Money Controlling op je smartphone plaatsen.
	</p>

	<h3>Andere vraag?</h3>
	<p class="well">
		<a href="<? echo site_url('contact'); ?>">Neem contact op!</a>
	</p>


<? echo $this->load->view('layout/footer'); ?>