<?php
/**
 * Front page template — the Samen Omhoog landing page.
 *
 * @package SamenOmhoog
 */

get_header();

$so_whatsapp = samen_omhoog_opt( 'whatsapp', '31684613589' );
$so_email    = samen_omhoog_opt( 'email', 'info@samenomhoog.nl' );
$so_phone    = samen_omhoog_opt( 'phone', '06 846 13 589' );
$so_address  = samen_omhoog_opt( 'address', 'Floresstraat 7, 8022 AD Zwolle' );
$wa_url      = 'https://wa.me/' . $so_whatsapp;
?>

<!-- HERO -->
<section class="hero site-section" id="home">
	<div class="hero-content">
		<div class="hero-badge"><?php esc_html_e( 'Zwolle — School of Life', 'samen-omhoog' ); ?></div>
		<h1><?php esc_html_e( 'Ieder mens heeft', 'samen-omhoog' ); ?><em><?php esc_html_e( 'talent.', 'samen-omhoog' ); ?></em><?php esc_html_e( 'Wij helpen het te laten zien.', 'samen-omhoog' ); ?></h1>
		<p class="hero-sub"><?php esc_html_e( 'Stichting Samen Omhoog is een plek waar jongeren en volwassenen zichzelf ontdekken, vaardigheden opbouwen en samen groeien — op hun manier, in hun tempo.', 'samen-omhoog' ); ?></p>
		<div class="hero-actions">
			<a href="#programmas" class="btn-primary"><?php esc_html_e( 'Ontdek ons aanbod →', 'samen-omhoog' ); ?></a>
			<a href="#missie" class="btn-ghost"><?php esc_html_e( 'Ons verhaal', 'samen-omhoog' ); ?></a>
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
					<small><?php esc_html_e( 'School of Life', 'samen-omhoog' ); ?></small>
					<strong><?php esc_html_e( 'Samen ontdekken wat wél kan', 'samen-omhoog' ); ?></strong>
				</div>
			</div>

			<div class="photo-tile tile-small tile-a reveal">
				<div class="tile-icon">✦</div>
				<strong><?php esc_html_e( 'Ontmoeten', 'samen-omhoog' ); ?></strong>
				<span><?php esc_html_e( 'Een plek waar je welkom bent', 'samen-omhoog' ); ?></span>
			</div>

			<div class="photo-tile tile-small tile-b reveal">
				<div class="tile-icon">↗</div>
				<strong><?php esc_html_e( 'Leren door te doen', 'samen-omhoog' ); ?></strong>
				<span><?php esc_html_e( 'Praktijk, ritme en vertrouwen', 'samen-omhoog' ); ?></span>
			</div>

			<div class="hero-quote dynamic-quote reveal">
				<p><?php esc_html_e( '"Als jij gelooft in iemand voordat ze in zichzelf geloven — dan verander je een leven."', 'samen-omhoog' ); ?></p>
				<cite><?php esc_html_e( 'Abdiwahab Ali, Oprichter', 'samen-omhoog' ); ?></cite>
			</div>
		</div>
	</div>
</section>

<!-- HULP FINDER -->
<section class="help-finder" id="hulp">
	<div class="help-inner">
		<div class="help-panel">
			<div class="help-panel-head">
				<div>
					<div class="section-label"><?php esc_html_e( 'Waar kunnen we je mee helpen?', 'samen-omhoog' ); ?></div>
					<h2><?php esc_html_e( 'Kies snel wat bij jou past.', 'samen-omhoog' ); ?></h2>
				</div>
				<p><?php esc_html_e( 'Bezoekers moeten meteen kunnen kiezen waar ze voor komen — zonder te zoeken.', 'samen-omhoog' ); ?></p>
			</div>
			<div class="help-grid">
				<a href="#programmas" class="help-card reveal magnetic-card"><div class="help-icon">1</div><strong><?php esc_html_e( 'Ik zoek begeleiding', 'samen-omhoog' ); ?></strong><span><?php esc_html_e( 'Structuur, dagbesteding, ambulante begeleiding of persoonlijke ondersteuning.', 'samen-omhoog' ); ?></span></a>
				<a href="#programmas" class="help-card reveal magnetic-card"><div class="help-icon">2</div><strong><?php esc_html_e( 'Ik wil leren of werken', 'samen-omhoog' ); ?></strong><span><?php esc_html_e( 'Werkervaring, Klas Entree, stageplekken en praktijkgericht leren.', 'samen-omhoog' ); ?></span></a>
				<a href="#programmas" class="help-card reveal magnetic-card"><div class="help-icon">3</div><strong><?php esc_html_e( 'Ik wil mensen ontmoeten', 'samen-omhoog' ); ?></strong><span><?php esc_html_e( 'Inloop, activiteiten, welzijn en een plek waar je welkom bent.', 'samen-omhoog' ); ?></span></a>
				<a href="#contact" class="help-card reveal magnetic-card"><div class="help-icon">4</div><strong><?php esc_html_e( 'Ik ben verwijzer', 'samen-omhoog' ); ?></strong><span><?php esc_html_e( 'Voor professionals, gemeenten, scholen en wijkteams die willen aanmelden.', 'samen-omhoog' ); ?></span></a>
			</div>
		</div>
		<div class="quick-contact-strip">
			<div class="quick-contact-item whatsapp"><div><small><?php esc_html_e( 'Direct contact', 'samen-omhoog' ); ?></small><strong><?php esc_html_e( 'WhatsApp met Samen Omhoog', 'samen-omhoog' ); ?></strong></div><a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'App ons', 'samen-omhoog' ); ?></a></div>
			<div class="quick-contact-item"><div><small><?php esc_html_e( 'Mail ons', 'samen-omhoog' ); ?></small><strong><?php echo esc_html( $so_email ); ?></strong></div><a href="mailto:<?php echo esc_attr( $so_email ); ?>"><?php esc_html_e( 'Mail', 'samen-omhoog' ); ?></a></div>
			<div class="quick-contact-item"><div><small><?php esc_html_e( 'Locatie', 'samen-omhoog' ); ?></small><strong><?php echo esc_html( $so_address ); ?></strong></div><a href="#contact"><?php esc_html_e( 'Route', 'samen-omhoog' ); ?></a></div>
		</div>
	</div>
</section>

<!-- MISSIE -->
<section class="mission site-section" id="missie">
	<div class="mission-grid">
		<div class="mission-left">
			<div class="section-label"><?php esc_html_e( 'Onze missie', 'samen-omhoog' ); ?></div>
			<h2 class="section-title"><?php esc_html_e( 'Waarom we', 'samen-omhoog' ); ?><br><?php esc_html_e( 'doen wat we', 'samen-omhoog' ); ?> <em><?php esc_html_e( 'doen.', 'samen-omhoog' ); ?></em></h2>
			<div class="mission-text">
				<p><?php esc_html_e( 'Omdat we geloven dat niemand buitengesloten hoeft te worden. Dat groei voor iedereen mogelijk is. Dat het echte leven de beste school is.', 'samen-omhoog' ); ?></p>
				<p><?php esc_html_e( 'Stichting Samen Omhoog is opgericht vanuit de overtuiging dat jongeren en volwassenen die extra ondersteuning nodig hebben, meer verdienen dan een systeem. Ze verdienen een plek. Een gemeenschap. Mensen die in hen geloven.', 'samen-omhoog' ); ?></p>
			</div>
			<div class="mission-values">
				<div class="value-item">
					<div class="value-icon"><svg viewBox="0 0 18 18" fill="none" stroke="#fff" stroke-width="1.5" stroke-linecap="round"><circle cx="9" cy="7" r="3.5"/><path d="M2 16c0-3.5 3.1-6 7-6s7 2.5 7 6"/></svg></div>
					<div class="value-body"><strong><?php esc_html_e( 'Menselijkheid boven systemen', 'samen-omhoog' ); ?></strong><p><?php esc_html_e( 'We denken vanuit de mens, niet vanuit regelgeving.', 'samen-omhoog' ); ?></p></div>
				</div>
				<div class="value-item">
					<div class="value-icon"><svg viewBox="0 0 18 18" fill="none" stroke="#fff" stroke-width="1.5" stroke-linecap="round"><path d="M9 2 L9 9 L13 13"/><circle cx="9" cy="9" r="7"/></svg></div>
					<div class="value-body"><strong><?php esc_html_e( 'Eigen tempo', 'samen-omhoog' ); ?></strong><p><?php esc_html_e( 'Groei heeft geen deadline. We werken in jouw ritme.', 'samen-omhoog' ); ?></p></div>
				</div>
				<div class="value-item">
					<div class="value-icon"><svg viewBox="0 0 18 18" fill="none" stroke="#fff" stroke-width="1.5" stroke-linecap="round"><path d="M3 9 L7 13 L15 5"/></svg></div>
					<div class="value-body"><strong><?php esc_html_e( 'Leren door te doen', 'samen-omhoog' ); ?></strong><p><?php esc_html_e( 'Praktijk en echte ervaringen als motor voor groei.', 'samen-omhoog' ); ?></p></div>
				</div>
				<div class="value-item">
					<div class="value-icon"><svg viewBox="0 0 18 18" fill="none" stroke="#fff" stroke-width="1.5" stroke-linecap="round"><path d="M9 2 C5 4 2 7 2 10 C2 14 5.5 16 9 16 C12.5 16 16 14 16 10 C16 7 13 4 9 2Z"/></svg></div>
					<div class="value-body"><strong><?php esc_html_e( 'Veiligheid & inclusiviteit', 'samen-omhoog' ); ?></strong><p><?php esc_html_e( 'Een plek waar iedereen zichzelf kan zijn.', 'samen-omhoog' ); ?></p></div>
				</div>
			</div>
		</div>
		<div class="mission-right">
			<div class="mission-image-placeholder">
				<div class="image-big-text">Samen<br>Omhoog</div>
				<div class="founder-badge"><div class="fbig">Abdi</div><div class="fsmall"><?php esc_html_e( 'Oprichter', 'samen-omhoog' ); ?></div></div>
			</div>
			<div class="mission-overlay-card"><div class="big">10+</div><div class="small"><?php esc_html_e( 'Jaar ervaring in Zwolle', 'samen-omhoog' ); ?></div></div>
		</div>
	</div>
</section>

<!-- PROGRAMMA'S -->
<section class="programs site-section" id="programmas">
	<div class="programs-header">
		<div class="section-label"><?php esc_html_e( 'Ons aanbod', 'samen-omhoog' ); ?></div>
		<h2 class="section-title"><?php esc_html_e( 'Niet één weg.', 'samen-omhoog' ); ?><br><em><?php esc_html_e( 'Maar de jouwe.', 'samen-omhoog' ); ?></em></h2>
		<p class="section-subtitle"><?php esc_html_e( "Vier programma's. Elk anders, maar allemaal gericht op groei, verbinding en eigen regie.", 'samen-omhoog' ); ?></p>
	</div>
	<div class="programs-grid">
		<div class="program-card featured reveal magnetic-card">
			<div>
				<div class="program-number">01</div>
				<div class="program-label"><?php esc_html_e( 'Programma 01', 'samen-omhoog' ); ?></div>
				<h3 class="program-title"><?php esc_html_e( 'Ontwikkeling & Werkervaring', 'samen-omhoog' ); ?></h3>
				<p class="program-desc"><?php esc_html_e( 'Leer in een echte werkomgeving, bouw vaardigheden op en ontdek wat jou energie geeft. Met begeleiding die echt luistert en SBB-erkende stage en leerwerktrajecten.', 'samen-omhoog' ); ?></p>
				<a href="#contact" class="program-link"><?php esc_html_e( 'Meer ontdekken', 'samen-omhoog' ); ?> <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M2 7h10M7 2l5 5-5 5"/></svg></a>
			</div>
			<div>
				<ul class="program-featured-list">
					<li><?php esc_html_e( 'Stage en leerwerktrajecten', 'samen-omhoog' ); ?></li>
					<li><?php esc_html_e( 'Klas Entree', 'samen-omhoog' ); ?></li>
					<li><?php esc_html_e( 'Praktijkgericht leren', 'samen-omhoog' ); ?></li>
					<li><?php esc_html_e( 'Persoonlijke begeleiding', 'samen-omhoog' ); ?></li>
					<li><?php esc_html_e( 'SBB erkend leerbedrijf', 'samen-omhoog' ); ?></li>
					<li><?php esc_html_e( 'Doorstroom naar werk of opleiding', 'samen-omhoog' ); ?></li>
				</ul>
			</div>
		</div>

		<div class="program-card reveal magnetic-card">
			<div class="program-number">02</div>
			<div class="program-label"><?php esc_html_e( 'Programma 02', 'samen-omhoog' ); ?></div>
			<h3 class="program-title"><?php esc_html_e( 'Ontmoeting & Welzijn', 'samen-omhoog' ); ?></h3>
			<p class="program-desc"><?php esc_html_e( 'Een open deur voor iedereen. Kom binnen, ontmoet mensen, doe mee en voel je thuis. Geen drempel te hoog — gewoon binnenlopen.', 'samen-omhoog' ); ?></p>
			<div class="program-tags"><span class="tag"><?php esc_html_e( 'Laagdrempelige inloop', 'samen-omhoog' ); ?></span><span class="tag"><?php esc_html_e( 'Sociale activiteiten', 'samen-omhoog' ); ?></span><span class="tag"><?php esc_html_e( 'Avondinloop di & do', 'samen-omhoog' ); ?></span></div>
			<a href="#contact" class="program-link"><?php esc_html_e( 'Meer ontdekken', 'samen-omhoog' ); ?> <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M2 7h10M7 2l5 5-5 5"/></svg></a>
		</div>

		<div class="program-card reveal magnetic-card">
			<div class="program-number">03</div>
			<div class="program-label"><?php esc_html_e( 'Programma 03', 'samen-omhoog' ); ?></div>
			<h3 class="program-title"><?php esc_html_e( 'Zorg & Begeleiding', 'samen-omhoog' ); ?></h3>
			<p class="program-desc"><?php esc_html_e( 'Praktische ondersteuning in kleine groepen. Altijd persoonlijk, altijd gericht op groei. Met dagbesteding, ambulante begeleiding en WMO-beschikkingen.', 'samen-omhoog' ); ?></p>
			<div class="program-tags"><span class="tag"><?php esc_html_e( 'Dagbesteding', 'samen-omhoog' ); ?></span><span class="tag"><?php esc_html_e( 'Ambulante begeleiding', 'samen-omhoog' ); ?></span><span class="tag"><?php esc_html_e( 'WMO & beschikkingen', 'samen-omhoog' ); ?></span></div>
			<a href="#contact" class="program-link"><?php esc_html_e( 'Meer ontdekken', 'samen-omhoog' ); ?> <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M2 7h10M7 2l5 5-5 5"/></svg></a>
		</div>

		<div class="program-card dark reveal magnetic-card">
			<div class="program-number">04</div>
			<div class="program-label"><?php esc_html_e( 'Programma 04', 'samen-omhoog' ); ?></div>
			<h3 class="program-title"><?php esc_html_e( 'Ondernemerswerkplaats', 'samen-omhoog' ); ?></h3>
			<p class="program-desc"><?php esc_html_e( 'Voor wie een eigen onderneming wil starten of laten groeien. Coaching, netwerk, werkplek en praktische tools — alles wat je nodig hebt om te ondernemen.', 'samen-omhoog' ); ?></p>
			<div class="program-tags"><span class="tag"><?php esc_html_e( 'Ondernemerscoaching', 'samen-omhoog' ); ?></span><span class="tag"><?php esc_html_e( 'Workshops', 'samen-omhoog' ); ?></span><span class="tag"><?php esc_html_e( 'Netwerk van ondernemers', 'samen-omhoog' ); ?></span></div>
			<a href="#contact" class="program-link"><?php esc_html_e( 'Meer ontdekken', 'samen-omhoog' ); ?> <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M2 7h10M7 2l5 5-5 5"/></svg></a>
		</div>
	</div>
</section>

<!-- FOUNDER -->
<section class="founder site-section" id="verhaal">
	<div class="founder-grid">
		<div class="founder-portrait">
			<div class="founder-name-big"><span><?php esc_html_e( 'Oprichter & directeur', 'samen-omhoog' ); ?></span><?php esc_html_e( 'Abdiwahab Ali', 'samen-omhoog' ); ?></div>
		</div>
		<div class="founder-content">
			<div class="section-label"><?php esc_html_e( 'Het verhaal van Abdi', 'samen-omhoog' ); ?></div>
			<h2 class="section-title"><?php esc_html_e( 'Van zoekend', 'samen-omhoog' ); ?><br><?php esc_html_e( 'naar', 'samen-omhoog' ); ?> <em><?php esc_html_e( 'gids.', 'samen-omhoog' ); ?></em></h2>
			<div class="founder-body">
				<p><?php esc_html_e( 'Abdiwahab Ali — voor iedereen gewoon Abdi — reisde op zijn elfde alleen van Somalië naar Nederland. Hij kende de taal niet, kende niemand, en navigeerde een systeem dat weinig ruimte liet voor wie hij was.', 'samen-omhoog' ); ?></p>
				<p><?php esc_html_e( 'Maar Abdi leerde. Door te doen. Door fouten. Door vol te houden. Hij vond zijn passie in meubelmakerij, sociaal ondernemerschap en film.', 'samen-omhoog' ); ?></p>
			</div>
			<div class="founder-quote">
				<p><?php esc_html_e( '"Als jij gelooft in iemand voordat ze in zichzelf geloven — dan verander je een leven."', 'samen-omhoog' ); ?></p>
				<cite><?php esc_html_e( 'Abdiwahab Ali, oprichter Stichting Samen Omhoog', 'samen-omhoog' ); ?></cite>
			</div>
			<a href="#contact" class="btn-outline-gold"><?php esc_html_e( 'Lees het volledige verhaal →', 'samen-omhoog' ); ?></a>
		</div>
	</div>
</section>

<!-- DOELGROEPEN -->
<section class="audience site-section" id="doelgroepen">
	<div class="audience-inner">
		<div>
			<div class="section-label"><?php esc_html_e( 'Voor wie zijn we er?', 'samen-omhoog' ); ?></div>
			<h2 class="section-title"><?php esc_html_e( 'Een duidelijke ingang voor', 'samen-omhoog' ); ?> <em><?php esc_html_e( 'iedere bezoeker.', 'samen-omhoog' ); ?></em></h2>
			<p class="section-subtitle"><?php esc_html_e( 'We maken de route helder: deelnemers, ouders, professionals en gemeenten vinden meteen hun plek.', 'samen-omhoog' ); ?></p>
		</div>
		<div class="audience-list">
			<div class="audience-row reveal magnetic-card"><div class="audience-num">1</div><div><strong><?php esc_html_e( 'Jongeren & volwassenen', 'samen-omhoog' ); ?></strong><span><?php esc_html_e( 'Voor wie structuur, begeleiding, werkervaring, aansluiting of daginvulling zoekt.', 'samen-omhoog' ); ?></span></div><em>→</em></div>
			<div class="audience-row reveal magnetic-card"><div class="audience-num">2</div><div><strong><?php esc_html_e( 'Ouders & familie', 'samen-omhoog' ); ?></strong><span><?php esc_html_e( 'Voor wie iemand wil aanmelden of eerst rustig wil overleggen wat passend is.', 'samen-omhoog' ); ?></span></div><em>→</em></div>
			<div class="audience-row reveal magnetic-card"><div class="audience-num">3</div><div><strong><?php esc_html_e( 'Professionals & verwijzers', 'samen-omhoog' ); ?></strong><span><?php esc_html_e( 'Voor wijkteams, scholen, zorgpartijen en sociale professionals die willen samenwerken.', 'samen-omhoog' ); ?></span></div><em>→</em></div>
			<div class="audience-row reveal magnetic-card"><div class="audience-num">4</div><div><strong><?php esc_html_e( 'Gemeenten & partners', 'samen-omhoog' ); ?></strong><span><?php esc_html_e( 'Voor WMO, beschikkingen, participatie, leerwerk en maatschappelijke samenwerkingen.', 'samen-omhoog' ); ?></span></div><em>→</em></div>
		</div>
	</div>
</section>

<!-- VERHALEN / ACTUEEL -->
<section class="story-news site-section">
	<div class="story-news-inner">
		<div class="section-label"><?php esc_html_e( 'Verhalen & actualiteit', 'samen-omhoog' ); ?></div>
		<h2 class="section-title"><?php esc_html_e( 'Laat zien wat welzijn', 'samen-omhoog' ); ?> <em><?php esc_html_e( 'doet.', 'samen-omhoog' ); ?></em></h2>
		<p class="section-subtitle"><?php esc_html_e( 'Verhalen en nieuws bouwen vertrouwen. Deze sectie maakt Samen Omhoog menselijker en levendiger.', 'samen-omhoog' ); ?></p>
		<div class="story-grid">
			<div class="story-card reveal magnetic-card"><small><?php esc_html_e( 'Ervaringsverhaal', 'samen-omhoog' ); ?></small><h3><?php esc_html_e( '“Ik kwam binnen en voelde: hier mag ik zijn.”', 'samen-omhoog' ); ?></h3><p><?php esc_html_e( 'Een plek waar mensen gezien worden, zonder oordeel en zonder ingewikkelde drempels.', 'samen-omhoog' ); ?></p></div>
			<div class="story-card reveal magnetic-card"><small><?php esc_html_e( 'Uit de werkplaats', 'samen-omhoog' ); ?></small><h3><?php esc_html_e( 'Leren door te doen in een echte omgeving.', 'samen-omhoog' ); ?></h3><p><?php esc_html_e( 'Van praktische vaardigheden tot zelfvertrouwen: groei ontstaat wanneer iemand mag proberen.', 'samen-omhoog' ); ?></p></div>
			<div class="story-card reveal magnetic-card"><small><?php esc_html_e( 'Samenwerking', 'samen-omhoog' ); ?></small><h3><?php esc_html_e( 'Met scholen, wijkteams en gemeenten.', 'samen-omhoog' ); ?></h3><p><?php esc_html_e( 'Samen zorgen we dat mensen sneller de juiste ondersteuning en plek vinden.', 'samen-omhoog' ); ?></p></div>
		</div>
	</div>
</section>

<!-- AANPAK -->
<section class="approach site-section" id="aanpak">
	<div class="approach-inner">
		<div class="approach-header">
			<div class="section-label"><?php esc_html_e( 'Zo werken wij', 'samen-omhoog' ); ?></div>
			<h2 class="section-title"><?php esc_html_e( 'Van eerste stap naar', 'samen-omhoog' ); ?><br><em><?php esc_html_e( 'eigen regie.', 'samen-omhoog' ); ?></em></h2>
		</div>
		<div class="steps">
			<div class="step"><div class="step-num">1</div><div class="step-title"><?php esc_html_e( 'Kennismaking', 'samen-omhoog' ); ?></div><p class="step-desc"><?php esc_html_e( 'Geen formulieren, geen druk. Gewoon een goed gesprek over jou en je wensen.', 'samen-omhoog' ); ?></p></div>
			<div class="step"><div class="step-num">2</div><div class="step-title"><?php esc_html_e( 'Persoonlijk plan', 'samen-omhoog' ); ?></div><p class="step-desc"><?php esc_html_e( 'Samen stellen we een traject op dat past bij jou — jouw mogelijkheden, tempo en wensen.', 'samen-omhoog' ); ?></p></div>
			<div class="step"><div class="step-num">3</div><div class="step-title"><?php esc_html_e( 'Aan de slag', 'samen-omhoog' ); ?></div><p class="step-desc"><?php esc_html_e( 'Je start met activiteiten of werkervaring. Altijd met iemand naast je die je ondersteunt.', 'samen-omhoog' ); ?></p></div>
			<div class="step"><div class="step-num">4</div><div class="step-title"><?php esc_html_e( 'Groeien', 'samen-omhoog' ); ?></div><p class="step-desc"><?php esc_html_e( 'Je bouwt vertrouwen op, ontdekt je talenten en zet stappen die je nooit voor mogelijk had gehouden.', 'samen-omhoog' ); ?></p></div>
			<div class="step"><div class="step-num gold">5</div><div class="step-title"><?php esc_html_e( 'Eigen regie', 'samen-omhoog' ); ?></div><p class="step-desc"><?php esc_html_e( 'Uiteindelijk sta jij aan het roer. We helpen je zo zelfstandig mogelijk te worden.', 'samen-omhoog' ); ?></p></div>
		</div>
	</div>
</section>

<!-- CERTIFICERINGEN -->
<section class="certs site-section">
	<div class="certs-inner">
		<div class="section-label"><?php esc_html_e( 'Kwaliteit & certificering', 'samen-omhoog' ); ?></div>
		<h2 class="section-title"><?php esc_html_e( 'Gecertificeerd en', 'samen-omhoog' ); ?><br><em><?php esc_html_e( 'aanspreekbaar.', 'samen-omhoog' ); ?></em></h2>
		<div class="certs-grid">
			<div class="cert-card reveal magnetic-card">
				<div class="cert-icon"><svg viewBox="0 0 26 26" fill="none" stroke="#fff" stroke-width="1.6" stroke-linecap="round"><path d="M13 2l3 3 4-1 1 4 3 3-3 3 1 4-4 1-3 3-3-3-4 1-1-4-3-3 3-3-1-4 4 1z"/><path d="M9 13l3 3 5-6"/></svg></div>
				<div class="cert-title"><?php esc_html_e( 'ISO 9001 Gecertificeerd', 'samen-omhoog' ); ?></div>
				<p class="cert-desc"><?php esc_html_e( 'Onze organisatie voldoet aan de internationale norm voor kwaliteitsmanagement. Dit garandeert consistente, kwalitatieve dienstverlening.', 'samen-omhoog' ); ?></p>
			</div>
			<div class="cert-card reveal magnetic-card">
				<div class="cert-icon"><svg viewBox="0 0 26 26" fill="none" stroke="#fff" stroke-width="1.6" stroke-linecap="round"><path d="M13 2L3 6v6c0 6 4 9 10 12 6-3 10-6 10-12V6z"/><path d="M9 13l3 3 5-6"/></svg></div>
				<div class="cert-title"><?php esc_html_e( 'SBB Erkend Leerbedrijf', 'samen-omhoog' ); ?></div>
				<p class="cert-desc"><?php esc_html_e( 'We zijn erkend door Stichting Beroepsonderwijs Bedrijfsleven voor het bieden van kwalitatieve stageplekken en leerwerktrajecten.', 'samen-omhoog' ); ?></p>
			</div>
			<div class="cert-card reveal magnetic-card">
				<div class="cert-icon"><svg viewBox="0 0 26 26" fill="none" stroke="#fff" stroke-width="1.6" stroke-linecap="round"><circle cx="13" cy="13" r="10"/><path d="M8 13l3 3 6-7"/></svg></div>
				<div class="cert-title"><?php esc_html_e( 'Aangesloten bij CBZ', 'samen-omhoog' ); ?></div>
				<p class="cert-desc"><?php esc_html_e( 'Via Coöperatie Boer en Zorg bieden we zorg met bijbehorende klachtenregeling, algemene voorwaarden en vertrouwenspersoon.', 'samen-omhoog' ); ?></p>
			</div>
		</div>
	</div>
</section>

<!-- DOCUMENTEN -->
<section class="documents site-section" id="documenten">
	<div class="documents-inner">
		<div>
			<div class="section-label"><?php esc_html_e( 'Officiële documenten', 'samen-omhoog' ); ?></div>
			<h2 class="section-title"><?php esc_html_e( 'Transparant, veilig en professioneel.', 'samen-omhoog' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( 'Alle belangrijke documenten zijn direct beschikbaar voor deelnemers, ouders, verwijzers en partners.', 'samen-omhoog' ); ?></p>
		</div>
		<div class="doc-grid">
			<a class="doc-card" href="#"><strong><?php esc_html_e( 'Klachtenregeling deelnemers SSO', 'samen-omhoog' ); ?></strong><span><?php esc_html_e( 'PDF downloaden →', 'samen-omhoog' ); ?></span></a>
			<a class="doc-card" href="#"><strong><?php esc_html_e( 'Algemene voorwaarden zorgverlening', 'samen-omhoog' ); ?></strong><span><?php esc_html_e( 'PDF downloaden →', 'samen-omhoog' ); ?></span></a>
			<a class="doc-card" href="#"><strong><?php esc_html_e( 'Huisregels', 'samen-omhoog' ); ?></strong><span><?php esc_html_e( 'PDF downloaden →', 'samen-omhoog' ); ?></span></a>
		</div>
	</div>
</section>

<!-- CONTACT -->
<section class="contact site-section" id="contact">
	<div class="contact-inner">
		<div>
			<div class="section-label"><?php esc_html_e( 'Contact opnemen', 'samen-omhoog' ); ?></div>
			<h2 class="section-title"><?php esc_html_e( 'We horen', 'samen-omhoog' ); ?><br><em><?php esc_html_e( 'graag van je.', 'samen-omhoog' ); ?></em></h2>
			<p class="section-subtitle"><?php esc_html_e( 'Of je nu voor jezelf belt, voor je kind, of als verwijzer — geen drempel te hoog.', 'samen-omhoog' ); ?></p>
			<div class="contact-details">
				<div class="contact-item">
					<div class="contact-icon"><svg viewBox="0 0 18 18" fill="none" stroke="rgba(255,255,255,0.8)" stroke-width="1.5" stroke-linecap="round"><path d="M3 4C3 3.4 3.4 3 4 3h3l1.5 3L7 8c1 2 3 4 5 5l2-1.5 3 1.5v3c0 .6-.4 1-1 1C8.5 17 1 9.5 1 4c0-.4.4-1 1-1"/></svg></div>
					<div>
						<div class="contact-info-label"><?php esc_html_e( 'Telefoon / WhatsApp', 'samen-omhoog' ); ?></div>
						<div class="contact-info-val"><a class="whatsapp-inline" href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener"><svg viewBox="0 0 32 32" fill="currentColor" aria-hidden="true"><path d="M16.04 3C9.44 3 4.07 8.36 4.07 14.96c0 2.11.55 4.17 1.6 5.98L4 29l8.27-1.63a11.9 11.9 0 0 0 5.77 1.47H18.05C24.64 28.84 30 23.48 30 16.88 30 10.3 22.64 3 16.04 3Zm7.04 17.16c-.3.85-1.74 1.63-2.4 1.73-.62.1-1.4.14-2.26-.14-.52-.17-1.2-.39-2.06-.77-3.62-1.56-5.98-5.2-6.16-5.44-.18-.24-1.47-1.96-1.47-3.74s.93-2.65 1.26-3.01c.33-.36.72-.45.96-.45h.69c.22.01.52-.08.81.62.3.72 1.02 2.5 1.11 2.68.09.18.15.39.03.63-.12.24-.18.39-.36.6-.18.21-.38.47-.54.63-.18.18-.37.38-.16.74.21.36.93 1.54 2 2.5 1.37 1.22 2.53 1.6 2.9 1.78.36.18.57.15.78-.09.21-.24.9-1.05 1.14-1.41.24-.36.48-.3.81-.18.33.12 2.1.99 2.46 1.17.36.18.6.27.69.42.09.15.09.87-.21 1.72Z"/></svg><?php esc_html_e( 'WhatsApp ons', 'samen-omhoog' ); ?></a></div>
						<div class="contact-info-sub"><?php echo esc_html( $so_phone ); ?> · <?php esc_html_e( 'Snelste manier om ons te bereiken', 'samen-omhoog' ); ?></div>
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
						<div class="contact-info-label"><?php esc_html_e( 'Adres', 'samen-omhoog' ); ?></div>
						<div class="contact-info-val"><?php echo esc_html( $so_address ); ?></div>
						<div class="contact-info-sub"><?php esc_html_e( 'Ma–do 09:00–17:00 · Vr tot 15:00', 'samen-omhoog' ); ?></div>
					</div>
				</div>
			</div>
		</div>
		<div class="contact-form-wrapper">
			<div class="form-title"><?php esc_html_e( 'Stuur een bericht', 'samen-omhoog' ); ?></div>
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
					<label><?php esc_html_e( 'Onderwerp', 'samen-omhoog' ); ?></label>
					<select name="so_subject">
						<option value=""><?php esc_html_e( 'Kies een onderwerp', 'samen-omhoog' ); ?></option>
						<option><?php esc_html_e( 'Informatie over een programma', 'samen-omhoog' ); ?></option>
						<option><?php esc_html_e( 'Aanmelding deelnemer', 'samen-omhoog' ); ?></option>
						<option><?php esc_html_e( 'Verwijzing als professional', 'samen-omhoog' ); ?></option>
						<option><?php esc_html_e( 'Samenwerking', 'samen-omhoog' ); ?></option>
						<option><?php esc_html_e( 'Vrijwilligerswerk', 'samen-omhoog' ); ?></option>
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
