<?php
/**
 * Front page template — the Samen Omhoog landing page.
 *
 * Content based on the live site samenomhoog.nl (home, aanbod, team, contact).
 *
 * @package SamenOmhoog
 */

get_header();

$so_whatsapp = samen_omhoog_opt( 'whatsapp', '31628859553' );
$so_email    = samen_omhoog_opt( 'email', 'info@samenomhoog.nl' );
$so_phone    = samen_omhoog_opt( 'phone', '06-28859553' );
$so_address  = samen_omhoog_opt( 'address', 'Floresstraat 7, 8022 AD Zwolle' );
$so_kvk      = samen_omhoog_opt( 'kvk', '89792807' );
$so_rsin     = samen_omhoog_opt( 'rsin', '865111339' );
$so_agb      = samen_omhoog_opt( 'agb', '98108329' );
$wa_url      = 'https://wa.me/' . $so_whatsapp;
?>

<!-- HERO -->
<section class="hero site-section" id="home">
	<div class="hero-content">
		<div class="hero-badge"><?php esc_html_e( 'Stichting Samen Omhoog · Zwolle', 'samen-omhoog' ); ?></div>
		<h1><?php esc_html_e( 'Dé ontwikkelplek waar', 'samen-omhoog' ); ?> <em><?php esc_html_e( 'jongeren vooruitkomen.', 'samen-omhoog' ); ?></em></h1>
		<p class="hero-sub"><?php esc_html_e( 'Een plek om te oefenen met het leven. In onze werkplaatsen ontdekken jongeren hun talent, doen ze werkervaring op en bouwen ze perspectief op richting onderwijs, werk en meedoen. En het is méér dan dat: een community waar je erbij hoort.', 'samen-omhoog' ); ?></p>
		<div class="hero-actions">
			<a href="#aanbod" class="btn-primary"><?php esc_html_e( 'Bekijk wat we bieden →', 'samen-omhoog' ); ?></a>
			<a href="#contact" class="btn-ghost"><?php esc_html_e( 'Plan een kennismaking', 'samen-omhoog' ); ?></a>
		</div>
	</div>
	<div class="hero-visual">
		<div class="life-collage" aria-label="<?php esc_attr_e( 'Samen Omhoog in beeld', 'samen-omhoog' ); ?>">
			<div class="collage-orb orb-one"></div>
			<div class="collage-orb orb-two"></div>

			<div class="photo-tile tile-main reveal">
				<div class="tile-gradient"></div>
				<div class="tile-people"><span></span><span></span><span></span></div>
				<div class="tile-caption">
					<small><?php esc_html_e( 'Onze aanpak', 'samen-omhoog' ); ?></small>
					<strong><?php esc_html_e( 'Relatie + Ontwikkeling + Werkervaring = Perspectief', 'samen-omhoog' ); ?></strong>
				</div>
			</div>

			<div class="photo-tile tile-small tile-a reveal">
				<div class="tile-icon"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-4.5-7-10a4 4 0 0 1 7-2.6A4 4 0 0 1 19 11c0 5.5-7 10-7 10z"/></svg></div>
				<strong><?php esc_html_e( 'Inloop', 'samen-omhoog' ); ?></strong>
				<span><?php esc_html_e( 'Een plek waar je erbij hoort', 'samen-omhoog' ); ?></span>
			</div>

			<div class="photo-tile tile-small tile-b reveal">
				<div class="tile-icon"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 17L17 7M9 7h8v8"/></svg></div>
				<strong><?php esc_html_e( 'Leren door te doen', 'samen-omhoog' ); ?></strong>
				<span><?php esc_html_e( 'Echte opdrachten in de werkplaats', 'samen-omhoog' ); ?></span>
			</div>

			<div class="hero-quote dynamic-quote reveal">
				<p><?php esc_html_e( '"Ieder mens heeft talent. Niet iedereen past in hetzelfde systeem."', 'samen-omhoog' ); ?></p>
				<cite><?php esc_html_e( 'Stichting Samen Omhoog', 'samen-omhoog' ); ?></cite>
			</div>
		</div>
	</div>
</section>

<!-- CONTACT-ROUTE FINDER -->
<section class="help-finder" id="hulp">
	<div class="help-inner">
		<div class="help-panel">
			<div class="help-panel-head">
				<div>
					<div class="section-label"><?php esc_html_e( 'Hoe wil je contact?', 'samen-omhoog' ); ?></div>
					<h2><?php esc_html_e( 'Kies wat bij je past.', 'samen-omhoog' ); ?></h2>
				</div>
				<p><?php esc_html_e( 'Voor jongeren die een plek zoeken, verwijzers die willen aanmelden en partners die willen bijdragen — de deur staat open.', 'samen-omhoog' ); ?></p>
			</div>
			<div class="help-grid">
				<a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener" class="help-card reveal magnetic-card"><div class="help-icon">1</div><strong><?php esc_html_e( 'Voor jongeren', 'samen-omhoog' ); ?></strong><span><?php esc_html_e( 'Loop binnen bij de inloop of stuur een berichtje. Geen drempel, geen verplichting.', 'samen-omhoog' ); ?></span></a>
				<a href="#contact" class="help-card reveal magnetic-card"><div class="help-icon">2</div><strong><?php esc_html_e( 'Voor verwijzers & gemeenten', 'samen-omhoog' ); ?></strong><span><?php esc_html_e( 'Plan een kennismaking en ontdek waarvoor je jongeren bij ons kunt aanmelden.', 'samen-omhoog' ); ?></span></a>
				<a href="#contact" class="help-card reveal magnetic-card"><div class="help-icon">3</div><strong><?php esc_html_e( 'Steun ons', 'samen-omhoog' ); ?></strong><span><?php esc_html_e( 'Word partner, vrijwilliger of donateur en help jongeren vooruit.', 'samen-omhoog' ); ?></span></a>
				<a href="#aanbod" class="help-card reveal magnetic-card"><div class="help-icon">4</div><strong><?php esc_html_e( 'Ik wil leren of werken', 'samen-omhoog' ); ?></strong><span><?php esc_html_e( 'Werkplaatsen, Klas Entree, stage en leerwerktrajecten onder één dak.', 'samen-omhoog' ); ?></span></a>
			</div>
		</div>
		<div class="quick-contact-strip">
			<div class="quick-contact-item whatsapp"><div><small><?php esc_html_e( 'Direct contact', 'samen-omhoog' ); ?></small><strong><?php esc_html_e( 'WhatsApp / bel ons', 'samen-omhoog' ); ?></strong></div><a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $so_phone ); ?></a></div>
			<div class="quick-contact-item"><div><small><?php esc_html_e( 'Mail ons', 'samen-omhoog' ); ?></small><strong><?php echo esc_html( $so_email ); ?></strong></div><a href="mailto:<?php echo esc_attr( $so_email ); ?>"><?php esc_html_e( 'Mail', 'samen-omhoog' ); ?></a></div>
			<div class="quick-contact-item"><div><small><?php esc_html_e( 'Locatie', 'samen-omhoog' ); ?></small><strong><?php echo esc_html( $so_address ); ?></strong></div><a href="#contact"><?php esc_html_e( 'Route', 'samen-omhoog' ); ?></a></div>
		</div>
	</div>
</section>

<!-- MISSIE / WAAROM -->
<section class="mission site-section" id="missie">
	<div class="mission-grid">
		<div class="mission-left">
			<div class="section-label"><?php esc_html_e( 'Waarom wij bestaan', 'samen-omhoog' ); ?></div>
			<h2 class="section-title"><?php esc_html_e( 'De brug tussen thuis, school, straat en', 'samen-omhoog' ); ?> <em><?php esc_html_e( 'werk.', 'samen-omhoog' ); ?></em></h2>
			<div class="mission-text">
				<p><?php esc_html_e( 'De veilige tussenstap waar jongeren kunnen landen, tot rust komen en stap voor stap doorgroeien naar onderwijs, werk en zelfstandigheid — op één plek waar welzijn, participatie en zorg samenkomen, verbonden door ontwikkeling. En waar je erbij hoort.', 'samen-omhoog' ); ?></p>
				<p><?php esc_html_e( 'Wij geloven dat jongeren niet geholpen zijn met veroordeling, maar met perspectief, positieve voorbeelden en een omgeving waarin zij ontdekken waar hun talenten liggen. Onze methodiek is geworteld in de presentiebenadering (naar Andries Baart): ontwikkeling begint met gezien, gehoord en begrepen worden.', 'samen-omhoog' ); ?></p>
			</div>
			<div class="mission-values">
				<div class="value-item">
					<div class="value-icon"><svg viewBox="0 0 18 18" fill="none" stroke="#fff" stroke-width="1.5" stroke-linecap="round"><circle cx="9" cy="7" r="3.5"/><path d="M2 16c0-3.5 3.1-6 7-6s7 2.5 7 6"/></svg></div>
					<div class="value-body"><strong><?php esc_html_e( 'Talentontwikkeling', 'samen-omhoog' ); ?></strong><p><?php esc_html_e( 'Iedere jongere heeft talenten die ontdekt kunnen worden.', 'samen-omhoog' ); ?></p></div>
				</div>
				<div class="value-item">
					<div class="value-icon"><svg viewBox="0 0 18 18" fill="none" stroke="#fff" stroke-width="1.5" stroke-linecap="round"><path d="M3 9 L7 13 L15 5"/></svg></div>
					<div class="value-body"><strong><?php esc_html_e( 'Kansgericht', 'samen-omhoog' ); ?></strong><p><?php esc_html_e( 'Wij creëren kansen waar jongeren die zelf nog niet zien.', 'samen-omhoog' ); ?></p></div>
				</div>
				<div class="value-item">
					<div class="value-icon"><svg viewBox="0 0 18 18" fill="none" stroke="#fff" stroke-width="1.5" stroke-linecap="round"><path d="M9 2 L9 9 L13 13"/><circle cx="9" cy="9" r="7"/></svg></div>
					<div class="value-body"><strong><?php esc_html_e( 'Eigenaarschap', 'samen-omhoog' ); ?></strong><p><?php esc_html_e( 'Jongeren leren verantwoordelijkheid nemen voor hun keuzes.', 'samen-omhoog' ); ?></p></div>
				</div>
				<div class="value-item">
					<div class="value-icon"><svg viewBox="0 0 18 18" fill="none" stroke="#fff" stroke-width="1.5" stroke-linecap="round"><path d="M9 2 C5 4 2 7 2 10 C2 14 5.5 16 9 16 C12.5 16 16 14 16 10 C16 7 13 4 9 2Z"/></svg></div>
					<div class="value-body"><strong><?php esc_html_e( 'Succeservaringen', 'samen-omhoog' ); ?></strong><p><?php esc_html_e( 'Groei ontstaat door te ervaren dat je iets kunt.', 'samen-omhoog' ); ?></p></div>
				</div>
			</div>
		</div>
		<div class="mission-right">
			<div class="mission-image-placeholder">
				<div class="image-big-text">Samen<br>Omhoog</div>
				<div class="founder-badge"><div class="fbig">14–27</div><div class="fsmall"><?php esc_html_e( 'Voor jongeren', 'samen-omhoog' ); ?></div></div>
			</div>
			<div class="mission-overlay-card"><div class="big">±230</div><div class="small"><?php esc_html_e( 'Jongeren & bezoekers bereikt', 'samen-omhoog' ); ?></div></div>
		</div>
	</div>
</section>

<!-- AANPAK -->
<section class="approach site-section" id="aanpak">
	<div class="approach-inner">
		<div class="approach-header">
			<div class="section-label"><?php esc_html_e( 'Onze aanpak', 'samen-omhoog' ); ?></div>
			<h2 class="section-title"><?php esc_html_e( 'Wij kijken naar mogelijkheden,', 'samen-omhoog' ); ?><br><em><?php esc_html_e( 'niet naar beperkingen.', 'samen-omhoog' ); ?></em></h2>
			<p class="section-subtitle"><?php esc_html_e( 'Ontwikkeling begint bij de relatie. Pas als een jongere zich gezien en veilig voelt, groeit de rest.', 'samen-omhoog' ); ?></p>
		</div>
		<div class="steps four">
			<div class="step"><div class="step-num">1</div><div class="step-title"><?php esc_html_e( 'Relatie', 'samen-omhoog' ); ?></div><p class="step-desc"><?php esc_html_e( 'Nabijheid en rolmodellen die de taal spreken. Gezien, gehoord en begrepen worden komt eerst.', 'samen-omhoog' ); ?></p></div>
			<div class="step"><div class="step-num">2</div><div class="step-title"><?php esc_html_e( 'Ontwikkeling', 'samen-omhoog' ); ?></div><p class="step-desc"><?php esc_html_e( 'Hard skills én soft skills: samenwerken, communiceren, initiatief nemen en verantwoordelijkheid dragen.', 'samen-omhoog' ); ?></p></div>
			<div class="step"><div class="step-num">3</div><div class="step-title"><?php esc_html_e( 'Werkervaring', 'samen-omhoog' ); ?></div><p class="step-desc"><?php esc_html_e( 'Praktisch aan de slag met echte opdrachten in de werkplaatsen — leren door te doen.', 'samen-omhoog' ); ?></p></div>
			<div class="step"><div class="step-num gold">4</div><div class="step-title"><?php esc_html_e( 'Perspectief', 'samen-omhoog' ); ?></div><p class="step-desc"><?php esc_html_e( 'Doorstroom naar onderwijs, werk en zelfstandigheid — meedoen in de samenleving.', 'samen-omhoog' ); ?></p></div>
		</div>
	</div>
</section>

<!-- WERKPLAATSEN -->
<section class="workshops site-section" id="werkplaats">
	<div class="approach-inner">
		<div class="approach-header">
			<div class="section-label"><?php esc_html_e( 'De werkplaatsen', 'samen-omhoog' ); ?></div>
			<h2 class="section-title"><?php esc_html_e( 'Leren door te', 'samen-omhoog' ); ?> <em><?php esc_html_e( 'doen.', 'samen-omhoog' ); ?></em></h2>
			<p class="section-subtitle"><?php esc_html_e( 'De werkplaatsen zijn het hart van onze aanpak — geen doel, maar een middel om jongeren te activeren en te laten ontdekken waar hun talent ligt.', 'samen-omhoog' ); ?></p>
		</div>
		<div class="work-grid">
			<div class="work-card reveal magnetic-card"><span class="work-icon"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="2" width="6" height="11" rx="3"/><path d="M5 10a7 7 0 0 0 14 0"/><path d="M12 17v4M8 21h8"/></svg></span><strong><?php esc_html_e( 'Multimedia & podcast', 'samen-omhoog' ); ?></strong></div>
			<div class="work-card reveal magnetic-card"><span class="work-icon"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 3.5l6 6-2.5 2.5-6-6z"/><path d="M12 6L3.5 14.5l4 4L16 10"/></svg></span><strong><?php esc_html_e( 'Hout & metaal', 'samen-omhoog' ); ?></strong></div>
			<div class="work-card reveal magnetic-card"><span class="work-icon"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="6" cy="6" r="3"/><circle cx="6" cy="18" r="3"/><path d="M20 4L8.5 15.5M14.5 14.5L20 20M8.5 8.5L10.5 10.5"/></svg></span><strong><?php esc_html_e( 'Kapsalon', 'samen-omhoog' ); ?></strong></div>
			<div class="work-card reveal magnetic-card"><span class="work-icon"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="6" cy="17" r="3.5"/><circle cx="18" cy="17" r="3.5"/><path d="M6 17l4-8h5l3 8M10 9l-1-3H7"/></svg></span><strong><?php esc_html_e( '(Fat)bike-reparatie', 'samen-omhoog' ); ?></strong></div>
			<div class="work-card reveal magnetic-card"><span class="work-icon"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M3 11l9-7 9 7"/><path d="M5 10v9h14v-9"/><path d="M9 19v-5h6v5"/></svg></span><strong><?php esc_html_e( 'Huiskamer & leerplek', 'samen-omhoog' ); ?></strong></div>
		</div>
	</div>
</section>

<!-- VOOR WIE -->
<section class="audience site-section" id="doelgroepen">
	<div class="audience-inner">
		<div>
			<div class="section-label"><?php esc_html_e( 'Voor wie', 'samen-omhoog' ); ?></div>
			<h2 class="section-title"><?php esc_html_e( 'Voor jongeren met talent dat', 'samen-omhoog' ); ?> <em><?php esc_html_e( 'ruimte verdient.', 'samen-omhoog' ); ?></em></h2>
			<p class="section-subtitle"><?php esc_html_e( 'Iedere jongere is anders. Wat hen verbindt, is de behoefte aan een veilige plek, tijd en iemand die in ze gelooft. Wij sluiten aan bij waar zij staan — en kijken vooruit.', 'samen-omhoog' ); ?></p>
			<span class="audience-age"><?php esc_html_e( '14 tot 27 jaar', 'samen-omhoog' ); ?></span>
		</div>
		<div class="audience-list">
			<div class="audience-row reveal magnetic-card"><div class="audience-num">1</div><div><strong><?php esc_html_e( 'Nieuwkomers', 'samen-omhoog' ); ?></strong><span><?php esc_html_e( 'Kort in Nederland en klaar om mee te doen — vanuit het praktijkonderwijs, de ISK of een integratiejaar.', 'samen-omhoog' ); ?></span></div><em>→</em></div>
			<div class="audience-row reveal magnetic-card"><div class="audience-num">2</div><div><strong><?php esc_html_e( 'Klaar voor een kans', 'samen-omhoog' ); ?></strong><span><?php esc_html_e( 'Jongeren die op school of stage hun plek nog niet vonden, maar met de juiste begeleiding opbloeien.', 'samen-omhoog' ); ?></span></div><em>→</em></div>
			<div class="audience-row reveal magnetic-card"><div class="audience-num">3</div><div><strong><?php esc_html_e( 'Op zoek naar richting', 'samen-omhoog' ); ?></strong><span><?php esc_html_e( 'Jongeren die hun draai nog zoeken en weer ritme, perspectief en motivatie willen vinden.', 'samen-omhoog' ); ?></span></div><em>→</em></div>
			<div class="audience-row reveal magnetic-card"><div class="audience-num">4</div><div><strong><?php esc_html_e( 'Klaar voor een nieuwe start', 'samen-omhoog' ); ?></strong><span><?php esc_html_e( 'Jongeren die een tijd buiten beeld waren en bij ons opnieuw kunnen opbouwen.', 'samen-omhoog' ); ?></span></div><em>→</em></div>
		</div>
	</div>
</section>

<!-- AANBOD -->
<section class="programs site-section" id="aanbod">
	<div class="programs-header">
		<div class="section-label"><?php esc_html_e( 'Wat we bieden', 'samen-omhoog' ); ?></div>
		<h2 class="section-title"><?php esc_html_e( 'Eén doel: ontwikkeling.', 'samen-omhoog' ); ?><br><em><?php esc_html_e( 'Eén plek. Meerdere ingangen.', 'samen-omhoog' ); ?></em></h2>
		<p class="section-subtitle"><?php esc_html_e( 'Elke jongere komt bij ons om zich te ontwikkelen. Dat doen we onder één dak, via meerdere ingangen — elk met een eigen financiering, zodat verwijzers precies weten waarvoor ze kunnen aanmelden.', 'samen-omhoog' ); ?></p>
	</div>

	<div class="programs-grid">
		<div class="program-card featured reveal magnetic-card">
			<div>
				<div class="program-label"><?php esc_html_e( 'Onderwijs & stage onder één dak', 'samen-omhoog' ); ?></div>
				<h3 class="program-title"><?php esc_html_e( 'Klas Entree — van leren tot diploma', 'samen-omhoog' ); ?></h3>
				<p class="program-desc"><?php esc_html_e( 'Onderwijs én stage op één plek, samen met StartCollege Landstede, Start.Deltion en de gemeente Zwolle. In een kleine groep toewerken naar een Entree-diploma, mbo-verklaring of praktijkverklaring. Voor anderstalige jongeren vanaf 16 jaar — start schooljaar 2026–2027.', 'samen-omhoog' ); ?></p>
				<a href="#contact" class="program-link"><?php esc_html_e( 'Plan een kennismaking', 'samen-omhoog' ); ?> <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M2 7h10M7 2l5 5-5 5"/></svg></a>
			</div>
			<div>
				<ul class="program-featured-list">
					<li><?php esc_html_e( '1 plek: onderwijs én stage onder één dak', 'samen-omhoog' ); ?></li>
					<li><?php esc_html_e( 'Max. 10 studenten per klas, veel aandacht', 'samen-omhoog' ); ?></li>
					<li><?php esc_html_e( 'Eigen leerplan op het tempo van de student', 'samen-omhoog' ); ?></li>
					<li><?php esc_html_e( 'Examen op de werkplek, leren in de echte context', 'samen-omhoog' ); ?></li>
					<li><?php esc_html_e( 'Taal in de praktijk', 'samen-omhoog' ); ?></li>
					<li><?php esc_html_e( 'Doorstroom naar werk of vervolgopleiding', 'samen-omhoog' ); ?></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="partners-line">
		<span class="partners-label"><?php esc_html_e( 'Klas Entree in samenwerking met', 'samen-omhoog' ); ?></span>
		<div class="partner-logos">
			<?php
			echo samen_omhoog_partner_logo( 'landstede.png', 'StartCollege Landstede' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in helper.
			echo samen_omhoog_partner_logo( 'deltion.png', 'Start.Deltion' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo samen_omhoog_partner_logo( 'zwolle.png', 'Gemeente Zwolle' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			?>
		</div>
	</div>

	<div class="ingang-grid">
		<div class="ingang-card reveal magnetic-card"><h3><?php esc_html_e( 'Inloop', 'samen-omhoog' ); ?></h3><p><?php esc_html_e( 'Laagdrempelige ontmoeting, structuur en een luisterend oor — overdag en in de avond. Velen vinden via de inloop hun weg terug.', 'samen-omhoog' ); ?></p><span class="ingang-fin"><?php esc_html_e( 'Financiering: subsidie', 'samen-omhoog' ); ?></span></div>
		<div class="ingang-card reveal magnetic-card"><h3><?php esc_html_e( 'Leerwerktrajecten & stage', 'samen-omhoog' ); ?></h3><p><?php esc_html_e( 'Begeleide leer- en werkplekken (De Groene Draad) richting een reguliere stage of het afronden van school.', 'samen-omhoog' ); ?></p><span class="ingang-fin"><?php esc_html_e( 'Onderwijs · subsidie', 'samen-omhoog' ); ?></span></div>
		<div class="ingang-card reveal magnetic-card"><h3><?php esc_html_e( 'Klas Entree', 'samen-omhoog' ); ?></h3><p><?php esc_html_e( 'Onderwijs én stage op één plek, richting Entree-diploma of praktijkverklaring.', 'samen-omhoog' ); ?></p><span class="ingang-fin"><?php esc_html_e( 'I.s.m. onderwijs', 'samen-omhoog' ); ?></span></div>
		<div class="ingang-card reveal magnetic-card"><h3><?php esc_html_e( 'Sociale activering', 'samen-omhoog' ); ?></h3><p><?php esc_html_e( 'Betekenisvolle daginvulling en taal- en cultuurondersteuning, ook voor nieuwkomers en AMV\'ers.', 'samen-omhoog' ); ?></p><span class="ingang-fin"><?php esc_html_e( 'Financiering: subsidie', 'samen-omhoog' ); ?></span></div>
		<div class="ingang-card reveal magnetic-card"><h3><?php esc_html_e( 'Zorgtrajecten', 'samen-omhoog' ); ?></h3><p><?php esc_html_e( 'Ambulante begeleiding en groepsaanbod wanneer een jongere meer nodig heeft — als gecontracteerd aanbieder via Coöperatie Boer & Zorg.', 'samen-omhoog' ); ?></p><span class="ingang-fin"><?php esc_html_e( 'Jeugdwet / Wmo · op maat', 'samen-omhoog' ); ?></span></div>
		<div class="ingang-card reveal magnetic-card"><h3><?php esc_html_e( 'Participatietrajecten', 'samen-omhoog' ); ?></h3><p><?php esc_html_e( 'Meedoen en groeien richting werk en zelfstandigheid.', 'samen-omhoog' ); ?></p><span class="ingang-fin"><?php esc_html_e( 'Inkoop · op maat', 'samen-omhoog' ); ?></span></div>
		<div class="ingang-card reveal magnetic-card"><h3><?php esc_html_e( 'Jobcoaching', 'samen-omhoog' ); ?></h3><p><?php esc_html_e( 'Persoonlijke begeleiding richting werk, stage en de arbeidsmarkt.', 'samen-omhoog' ); ?></p><span class="ingang-fin"><?php esc_html_e( 'Op maat', 'samen-omhoog' ); ?></span></div>
		<div class="ingang-card soon reveal magnetic-card"><h3><?php esc_html_e( 'Trainingen', 'samen-omhoog' ); ?></h3><p><?php esc_html_e( 'Aanbod in ontwikkeling — hier komt binnenkort meer over.', 'samen-omhoog' ); ?></p><span class="ingang-fin"><?php esc_html_e( 'Binnenkort', 'samen-omhoog' ); ?></span></div>
	</div>
</section>

<!-- RESULTATEN -->
<section class="results site-section">
	<div class="approach-inner">
		<div class="approach-header">
			<div class="section-label"><?php esc_html_e( 'Wat het oplevert', 'samen-omhoog' ); ?></div>
			<h2 class="section-title"><?php esc_html_e( 'Resultaat begint al bij', 'samen-omhoog' ); ?> <em><?php esc_html_e( 'binnenkomen.', 'samen-omhoog' ); ?></em></h2>
			<p class="section-subtitle"><?php esc_html_e( 'Een jongere die via de inloop binnenkomt en weer de weg terugvindt naar onderwijs, stage of een dagritme — dat is op zichzelf al een resultaat.', 'samen-omhoog' ); ?></p>
		</div>
		<div class="results-grid">
			<div class="result-stat reveal"><div class="rnum">±230</div><div class="rlabel"><?php esc_html_e( 'Unieke jongeren & bezoekers bereikt', 'samen-omhoog' ); ?></div></div>
			<div class="result-stat reveal"><div class="rnum">55</div><div class="rlabel"><?php esc_html_e( 'Jongeren op een stageplek', 'samen-omhoog' ); ?></div></div>
			<div class="result-stat reveal"><div class="rnum">20</div><div class="rlabel"><?php esc_html_e( 'Zorgtrajecten', 'samen-omhoog' ); ?></div></div>
			<div class="result-stat reveal"><div class="rnum">150</div><div class="rlabel"><?php esc_html_e( 'Bezoekers van de inloop', 'samen-omhoog' ); ?></div></div>
			<div class="result-stat reveal"><div class="rnum">6</div><div class="rlabel"><?php esc_html_e( 'Participatietrajecten', 'samen-omhoog' ); ?></div></div>
		</div>
	</div>
</section>

<!-- FOUNDER -->
<section class="founder site-section" id="verhaal">
	<div class="founder-grid">
		<div class="founder-portrait">
			<div class="founder-name-big"><span><?php esc_html_e( 'Oprichter · Manager Uitvoering & Ontwikkeling', 'samen-omhoog' ); ?></span><?php esc_html_e( 'Abdiwahab Ali', 'samen-omhoog' ); ?></div>
		</div>
		<div class="founder-content">
			<div class="section-label"><?php esc_html_e( 'De oprichter', 'samen-omhoog' ); ?></div>
			<h2 class="section-title"><?php esc_html_e( 'Rolmodellen', 'samen-omhoog' ); ?><br><?php esc_html_e( 'spreken de', 'samen-omhoog' ); ?> <em><?php esc_html_e( 'taal.', 'samen-omhoog' ); ?></em></h2>
			<div class="founder-body">
				<p><?php esc_html_e( 'Samen Omhoog is opgericht door Abdiwahab Ali. Hij kwam op jonge leeftijd alleen naar Nederland en weet uit eigen ervaring hoe het is om je weg te zoeken — met vallen en opstaan, en uiteindelijk een nieuwe richting in meubelmakerij, ondernemerschap en film.', 'samen-omhoog' ); ?></p>
				<p><?php esc_html_e( 'Vanuit die herkenning begeleidt hij jongeren met één overtuiging: ieder mens heeft potentieel, ongeacht achtergrond of omstandigheden. Hij staat zelf als rolmodel en begeleider op de werkvloer; zijn nabijheid vormt het fundament onder onze aanpak.', 'samen-omhoog' ); ?></p>
			</div>
			<div class="founder-quote">
				<p><?php esc_html_e( '"Door nabijheid en een gedeelde leefwereld bereiken we jongeren die voor anderen onbereikbaar blijven."', 'samen-omhoog' ); ?></p>
				<cite><?php esc_html_e( 'Stichting Samen Omhoog', 'samen-omhoog' ); ?></cite>
			</div>
			<a href="#team" class="btn-outline-gold"><?php esc_html_e( 'Maak kennis met het team →', 'samen-omhoog' ); ?></a>
		</div>
	</div>
</section>

<!-- TEAM -->
<section class="team site-section" id="team">
	<div class="certs-inner">
		<div class="section-label"><?php esc_html_e( 'Wie wij zijn', 'samen-omhoog' ); ?></div>
		<h2 class="section-title"><?php esc_html_e( 'Verschillende achtergronden,', 'samen-omhoog' ); ?> <em><?php esc_html_e( 'één missie.', 'samen-omhoog' ); ?></em></h2>
		<p class="section-subtitle"><?php esc_html_e( 'It takes a village. Bij Samen Omhoog ontmoet een jongere niet één begeleider, maar een hecht team van professionals, vakmensen en ervaringsdeskundigen die hun leefwereld kennen.', 'samen-omhoog' ); ?></p>
		<div class="team-grid">
			<div class="team-card reveal magnetic-card"><div class="team-avatar">AA</div><h3><?php esc_html_e( 'Abdi Ali', 'samen-omhoog' ); ?></h3><div class="team-role"><?php esc_html_e( 'Manager Uitvoering & Ontwikkeling', 'samen-omhoog' ); ?></div><p><?php esc_html_e( 'Oprichter en rolmodel; ook als begeleider op de werkvloer. Vond na een moeilijke weg zijn richting in meubelmakerij, ondernemerschap en film.', 'samen-omhoog' ); ?></p></div>
			<div class="team-card reveal magnetic-card"><div class="team-avatar">MH</div><h3><?php esc_html_e( 'Marijn Hageman', 'samen-omhoog' ); ?></h3><div class="team-role"><?php esc_html_e( 'Manager Organisatie & Strategie', 'samen-omhoog' ); ?></div><p><?php esc_html_e( 'Veiligheidskundige met een achtergrond binnen politie en veiligheid. Bouwt aan de organisatie, strategie en samenwerking.', 'samen-omhoog' ); ?></p></div>
			<div class="team-card reveal magnetic-card"><div class="team-avatar">AA</div><h3><?php esc_html_e( 'Ali Abdulle', 'samen-omhoog' ); ?></h3><div class="team-role"><?php esc_html_e( 'Manager Facilitair & Beheer', 'samen-omhoog' ); ?></div><p><?php esc_html_e( 'Ook begeleider op de werkvloer; ervaringsdeskundige die zonder opleiding opnieuw begon en een eigen bedrijf opbouwde.', 'samen-omhoog' ); ?></p></div>
			<div class="team-card reveal magnetic-card"><div class="team-avatar">EB</div><h3><?php esc_html_e( 'Esther Brinkman', 'samen-omhoog' ); ?></h3><div class="team-role"><?php esc_html_e( 'Trajectcoördinator Zorg & Participatie', 'samen-omhoog' ); ?></div><p><?php esc_html_e( 'Achtergrond in de reclassering, met ervaring in de TBS- en GGZ-sector. Begeleiding en jobcoaching.', 'samen-omhoog' ); ?></p></div>
			<div class="team-card reveal magnetic-card"><div class="team-avatar">SP</div><h3><?php esc_html_e( 'Sonja van der Ploeg', 'samen-omhoog' ); ?></h3><div class="team-role"><?php esc_html_e( 'Docent & jobcoach', 'samen-omhoog' ); ?></div><p><?php esc_html_e( 'Verzorgt onderwijs, jobcoaching en sociale activering.', 'samen-omhoog' ); ?></p></div>
			<div class="team-card reveal magnetic-card"><div class="team-avatar">YA</div><h3><?php esc_html_e( 'Yassine Assad', 'samen-omhoog' ); ?></h3><div class="team-role"><?php esc_html_e( 'SKJ-jeugdprofessional', 'samen-omhoog' ); ?></div><p><?php esc_html_e( 'Geregistreerd jeugdprofessional. Begeleiding van jongeren vanuit de (verlengde) Jeugdwet. Daarnaast werkzaam bij het COA.', 'samen-omhoog' ); ?></p></div>
			<div class="team-card reveal magnetic-card"><div class="team-avatar">RK</div><h3><?php esc_html_e( 'Robbert Kaspers', 'samen-omhoog' ); ?></h3><div class="team-role"><?php esc_html_e( 'Werkmeester', 'samen-omhoog' ); ?></div><p><?php esc_html_e( 'Meubelmaker en luchtvaarttechnicus; brengt vakmanschap, discipline en praktijkervaring de werkplaats in.', 'samen-omhoog' ); ?></p></div>
			<div class="team-card reveal magnetic-card"><div class="team-avatar">SH</div><h3><?php esc_html_e( 'Shaakir Haashi', 'samen-omhoog' ); ?></h3><div class="team-role"><?php esc_html_e( 'Sociale activering', 'samen-omhoog' ); ?></div><p><?php esc_html_e( 'Ervaringsdeskundige met een migratieachtergrond; betrokken bij de sociale activering voor praktische vragen en ondersteuning.', 'samen-omhoog' ); ?></p></div>
			<div class="team-card reveal magnetic-card" style="background:var(--forest);border-color:var(--forest);"><div class="team-avatar" style="background:var(--gold);">+</div><h3 style="color:#fff;"><?php esc_html_e( 'Ons netwerk', 'samen-omhoog' ); ?></h3><div class="team-role" style="color:var(--gold-light);"><?php esc_html_e( 'Samen om één jongere heen', 'samen-omhoog' ); ?></div><p style="color:rgba(255,255,255,.7);"><?php esc_html_e( 'Naast ons vaste team werken we met een netwerk van ondernemers, scholen, wijkteams en zorgpartners.', 'samen-omhoog' ); ?></p></div>
		</div>
	</div>
</section>

<!-- CERTIFICERINGEN -->
<section class="certs site-section">
	<div class="certs-inner">
		<div class="section-label"><?php esc_html_e( 'Kwaliteit & certificering', 'samen-omhoog' ); ?></div>
		<h2 class="section-title"><?php esc_html_e( 'Gecertificeerd en', 'samen-omhoog' ); ?> <em><?php esc_html_e( 'aanspreekbaar.', 'samen-omhoog' ); ?></em></h2>
		<div class="certs-grid">
			<div class="cert-card reveal magnetic-card">
				<?php $logo = samen_omhoog_logo_src( 'iso9001.png' ); ?>
				<?php if ( $logo ) : ?>
					<img class="cert-brand-img" src="<?php echo esc_url( $logo ); ?>" alt="<?php esc_attr_e( 'ISO 9001 — TÜV NORD', 'samen-omhoog' ); ?>" loading="lazy">
				<?php else : ?>
					<div class="cert-icon"><svg viewBox="0 0 26 26" fill="none" stroke="#fff" stroke-width="1.6" stroke-linecap="round"><path d="M13 2l3 3 4-1 1 4 3 3-3 3 1 4-4 1-3 3-3-3-4 1-1-4-3-3 3-3-1-4 4 1z"/><path d="M9 13l3 3 5-6"/></svg></div>
				<?php endif; ?>
				<div class="cert-title"><?php esc_html_e( 'ISO 9001 Gecertificeerd', 'samen-omhoog' ); ?></div>
				<p class="cert-desc"><?php esc_html_e( 'Onze organisatie voldoet aan de internationale norm voor kwaliteitsmanagement (TÜV NORD) — consistente, kwalitatieve dienstverlening.', 'samen-omhoog' ); ?></p>
			</div>
			<div class="cert-card reveal magnetic-card">
				<?php $logo = samen_omhoog_logo_src( 'sbb.png' ); ?>
				<?php if ( $logo ) : ?>
					<img class="cert-brand-img" src="<?php echo esc_url( $logo ); ?>" alt="<?php esc_attr_e( 'SBB Erkend Leerbedrijf', 'samen-omhoog' ); ?>" loading="lazy">
				<?php else : ?>
					<div class="cert-icon"><svg viewBox="0 0 26 26" fill="none" stroke="#fff" stroke-width="1.6" stroke-linecap="round"><path d="M13 2L3 6v6c0 6 4 9 10 12 6-3 10-6 10-12V6z"/><path d="M9 13l3 3 5-6"/></svg></div>
				<?php endif; ?>
				<div class="cert-title"><?php esc_html_e( 'SBB Erkend Leerbedrijf', 'samen-omhoog' ); ?></div>
				<p class="cert-desc"><?php esc_html_e( 'Erkend door SBB voor het bieden van kwalitatieve stageplekken en leerwerktrajecten — wij leiden vakmensen op.', 'samen-omhoog' ); ?></p>
			</div>
			<div class="cert-card reveal magnetic-card">
				<?php $logo = samen_omhoog_logo_src( 'skj.png' ); ?>
				<?php if ( $logo ) : ?>
					<img class="cert-brand-img" src="<?php echo esc_url( $logo ); ?>" alt="<?php esc_attr_e( 'SKJ Kwaliteitsregister Jeugd', 'samen-omhoog' ); ?>" loading="lazy">
				<?php else : ?>
					<div class="cert-icon"><svg viewBox="0 0 26 26" fill="none" stroke="#fff" stroke-width="1.6" stroke-linecap="round"><circle cx="13" cy="13" r="10"/><path d="M8 13l3 3 6-7"/></svg></div>
				<?php endif; ?>
				<div class="cert-title"><?php esc_html_e( 'SKJ Kwaliteitsregister Jeugd', 'samen-omhoog' ); ?></div>
				<p class="cert-desc"><?php esc_html_e( 'Geregistreerde SKJ-jeugdprofessional in huis. Ook aangesloten bij Coöperatie Boer & Zorg (CBZ) en zorgvuldig volgens de AVG.', 'samen-omhoog' ); ?></p>
			</div>
		</div>

		<div class="partner-strip-wrap">
			<span class="partners-label"><?php esc_html_e( 'Erkend door & in samenwerking met', 'samen-omhoog' ); ?></span>
			<div class="partner-logos">
				<?php
				echo samen_omhoog_partner_logo( 'iso9001.png', 'ISO 9001 — TÜV NORD' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in helper.
				echo samen_omhoog_partner_logo( 'sbb.png', 'SBB Erkend Leerbedrijf' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo samen_omhoog_partner_logo( 'skj.png', 'SKJ Kwaliteitsregister Jeugd' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo samen_omhoog_partner_logo( 'rotary.png', 'Rotary Zwolle – IJsselland' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?>
			</div>
		</div>
	</div>
</section>

<!-- CONTACT -->
<section class="contact site-section" id="contact">
	<div class="contact-inner">
		<div>
			<div class="section-label"><?php esc_html_e( 'Contact', 'samen-omhoog' ); ?></div>
			<h2 class="section-title"><?php esc_html_e( 'Kom langs, bel', 'samen-omhoog' ); ?> <em><?php esc_html_e( 'of mail.', 'samen-omhoog' ); ?></em></h2>
			<p class="section-subtitle"><?php esc_html_e( 'Voor jongeren die een plek zoeken, verwijzers die willen aanmelden en partners die willen bijdragen — we denken graag mee.', 'samen-omhoog' ); ?></p>
			<div class="contact-details">
				<div class="contact-item">
					<div class="contact-icon"><svg viewBox="0 0 18 18" fill="none" stroke="rgba(255,255,255,0.8)" stroke-width="1.5" stroke-linecap="round"><path d="M3 4C3 3.4 3.4 3 4 3h3l1.5 3L7 8c1 2 3 4 5 5l2-1.5 3 1.5v3c0 .6-.4 1-1 1C8.5 17 1 9.5 1 4c0-.4.4-1 1-1"/></svg></div>
					<div>
						<div class="contact-info-label"><?php esc_html_e( 'Telefoon / WhatsApp', 'samen-omhoog' ); ?></div>
						<div class="contact-info-val"><a class="whatsapp-inline" href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener"><svg viewBox="0 0 32 32" fill="currentColor" aria-hidden="true"><path d="M16.04 3C9.44 3 4.07 8.36 4.07 14.96c0 2.11.55 4.17 1.6 5.98L4 29l8.27-1.63a11.9 11.9 0 0 0 5.77 1.47H18.05C24.64 28.84 30 23.48 30 16.88 30 10.3 22.64 3 16.04 3Zm7.04 17.16c-.3.85-1.74 1.63-2.4 1.73-.62.1-1.4.14-2.26-.14-.52-.17-1.2-.39-2.06-.77-3.62-1.56-5.98-5.2-6.16-5.44-.18-.24-1.47-1.96-1.47-3.74s.93-2.65 1.26-3.01c.33-.36.72-.45.96-.45h.69c.22.01.52-.08.81.62.3.72 1.02 2.5 1.11 2.68.09.18.15.39.03.63-.12.24-.18.39-.36.6-.18.21-.38.47-.54.63-.18.18-.37.38-.16.74.21.36.93 1.54 2 2.5 1.37 1.22 2.53 1.6 2.9 1.78.36.18.57.15.78-.09.21-.24.9-1.05 1.14-1.41.24-.36.48-.3.81-.18.33.12 2.1.99 2.46 1.17.36.18.6.27.69.42.09.15.09.87-.21 1.72Z"/></svg><?php echo esc_html( $so_phone ); ?></a></div>
						<div class="contact-info-sub"><?php esc_html_e( 'Snelste manier om ons te bereiken', 'samen-omhoog' ); ?></div>
					</div>
				</div>
				<div class="contact-item">
					<div class="contact-icon"><svg viewBox="0 0 18 18" fill="none" stroke="rgba(255,255,255,0.8)" stroke-width="1.5" stroke-linecap="round"><rect x="2" y="4" width="14" height="10" rx="2"/><path d="M2 6l7 5 7-5"/></svg></div>
					<div>
						<div class="contact-info-label"><?php esc_html_e( 'E-mail', 'samen-omhoog' ); ?></div>
						<div class="contact-info-val"><a href="mailto:<?php echo esc_attr( $so_email ); ?>" style="color:#fff;text-decoration:none;"><?php echo esc_html( $so_email ); ?></a></div>
						<div class="contact-info-sub"><?php esc_html_e( 'Reactie binnen 1–2 werkdagen', 'samen-omhoog' ); ?></div>
					</div>
				</div>
				<div class="contact-item">
					<div class="contact-icon"><svg viewBox="0 0 18 18" fill="none" stroke="rgba(255,255,255,0.8)" stroke-width="1.5" stroke-linecap="round"><path d="M9 2C6.2 2 4 4.2 4 7c0 4 5 9 5 9s5-5 5-9c0-2.8-2.2-5-5-5z"/><circle cx="9" cy="7" r="1.5"/></svg></div>
					<div>
						<div class="contact-info-label"><?php esc_html_e( 'Bezoek', 'samen-omhoog' ); ?></div>
						<div class="contact-info-val"><?php echo esc_html( $so_address ); ?></div>
						<div class="contact-info-sub"><?php esc_html_e( 'Ma–vr 09:00–17:00 · Avondinloop di & do 19:00–23:00', 'samen-omhoog' ); ?></div>
					</div>
				</div>
				<div class="contact-item">
					<div class="contact-icon"><svg viewBox="0 0 18 18" fill="none" stroke="rgba(255,255,255,0.8)" stroke-width="1.5" stroke-linecap="round"><rect x="2.5" y="3.5" width="13" height="11" rx="1.5"/><path d="M2.5 7h13"/></svg></div>
					<div>
						<div class="contact-info-label"><?php esc_html_e( 'Organisatie', 'samen-omhoog' ); ?></div>
						<div class="contact-info-val"><?php echo esc_html( sprintf( 'KvK %s', $so_kvk ) ); ?></div>
						<div class="contact-info-sub"><?php echo esc_html( sprintf( 'RSIN %1$s · AGB %2$s', $so_rsin, $so_agb ) ); ?></div>
					</div>
				</div>
			</div>
		</div>
		<div class="contact-form-wrapper">
			<div class="form-title"><?php esc_html_e( 'Plan een kennismaking', 'samen-omhoog' ); ?></div>
			<div class="form-sub"><?php esc_html_e( 'We reageren zo snel mogelijk — meestal binnen één werkdag.', 'samen-omhoog' ); ?></div>

			<?php
			$so_status = isset( $_GET['so_contact'] ) ? sanitize_key( wp_unslash( $_GET['so_contact'] ) ) : '';
			if ( 'success' === $so_status ) {
				echo '<div class="form-feedback success">' . esc_html__( 'Bedankt! Je bericht is verstuurd. We nemen snel contact met je op.', 'samen-omhoog' ) . '</div>';
			} elseif ( 'error' === $so_status ) {
				echo '<div class="form-feedback error">' . esc_html__( 'Er ging iets mis of niet alle verplichte velden waren ingevuld. Probeer het opnieuw.', 'samen-omhoog' ) . '</div>';
			}
			?>

			<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
				<input type="hidden" name="action" value="samen_omhoog_contact">
				<?php wp_nonce_field( 'samen_omhoog_contact', 'samen_omhoog_contact_nonce' ); ?>
				<div style="position:absolute;left:-9999px;" aria-hidden="true">
					<label>Website<input type="text" name="website" tabindex="-1" autocomplete="off"></label>
				</div>
				<div class="form-row">
					<div class="form-group"><label><?php esc_html_e( 'Naam', 'samen-omhoog' ); ?></label><input type="text" name="so_name" placeholder="<?php esc_attr_e( 'Jouw naam', 'samen-omhoog' ); ?>" required></div>
					<div class="form-group"><label><?php esc_html_e( 'E-mail', 'samen-omhoog' ); ?></label><input type="email" name="so_email" placeholder="jouw@email.nl" required></div>
				</div>
				<div class="form-group"><label><?php esc_html_e( 'Telefoon', 'samen-omhoog' ); ?></label><input type="tel" name="so_phone" placeholder="06 ..."></div>
				<div class="form-group">
					<label><?php esc_html_e( 'Ik ben...', 'samen-omhoog' ); ?></label>
					<select name="so_subject">
						<option value=""><?php esc_html_e( 'Kies een onderwerp', 'samen-omhoog' ); ?></option>
						<option><?php esc_html_e( 'Jongere — ik zoek een plek', 'samen-omhoog' ); ?></option>
						<option><?php esc_html_e( 'Ouder / familie', 'samen-omhoog' ); ?></option>
						<option><?php esc_html_e( 'Verwijzer / professional', 'samen-omhoog' ); ?></option>
						<option><?php esc_html_e( 'Gemeente / partner', 'samen-omhoog' ); ?></option>
						<option><?php esc_html_e( 'Klas Entree (onderwijs)', 'samen-omhoog' ); ?></option>
						<option><?php esc_html_e( 'Vrijwilliger / donateur', 'samen-omhoog' ); ?></option>
						<option><?php esc_html_e( 'Iets anders', 'samen-omhoog' ); ?></option>
					</select>
				</div>
				<div class="form-group"><label><?php esc_html_e( 'Bericht', 'samen-omhoog' ); ?></label><textarea name="so_message" placeholder="<?php esc_attr_e( 'Schrijf hier je bericht...', 'samen-omhoog' ); ?>" required></textarea></div>
				<button type="submit" class="btn-submit"><?php esc_html_e( 'Verstuur bericht →', 'samen-omhoog' ); ?></button>
			</form>
		</div>
	</div>
</section>

<?php
get_footer();
