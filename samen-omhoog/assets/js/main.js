/* Samen Omhoog theme — interactions */
( function () {
	'use strict';

	// Sticky nav shadow on scroll.
	var nav = document.getElementById( 'mainNav' );
	if ( nav ) {
		var onScroll = function () {
			nav.classList.toggle( 'scrolled', window.scrollY > 40 );
		};
		window.addEventListener( 'scroll', onScroll, { passive: true } );
		onScroll();
	}

	// Reveal-on-scroll animation.
	var revealEls = document.querySelectorAll( '.reveal' );
	if ( revealEls.length && 'IntersectionObserver' in window ) {
		var observer = new IntersectionObserver( function ( entries ) {
			entries.forEach( function ( entry ) {
				if ( entry.isIntersecting ) {
					entry.target.classList.add( 'visible' );
					observer.unobserve( entry.target );
				}
			} );
		}, { threshold: 0.14 } );

		revealEls.forEach( function ( el, index ) {
			el.style.transitionDelay = ( Math.min( index % 6, 5 ) * 70 ) + 'ms';
			observer.observe( el );
		} );
	} else {
		revealEls.forEach( function ( el ) {
			el.classList.add( 'visible' );
		} );
	}
} )();
