/usr/bin/php

<?php
//***************************************************************************
//  entrée date en timestamp
function jour_ferie($date) {
    // Donner un timestamp unix en paramètre
    // Retourne si jour_férié ou week-end
    $jour = date("d", $date);
    $mois = date("m", $date);
    $annee = date("Y", $date);

    if($jour == 1 && $mois == 1) return 8; // 1er janvier
    if($jour == 1 && $mois == 5) return 8; // 1er mai
    if($jour == 8 && $mois == 5) return 8; // 8 mai
    if($jour == 14 && $mois == 7) return 8; // 14 juillet
    if($jour == 15 && $mois == 8) return 8; // 15 aout
    if($jour == 1 && $mois == 11) return 8; // 1 novembre
    if($jour == 11 && $mois == 11) return 8; // 11 novembre
    if($jour == 25 && $mois == 12) return 8; // 25 decembre

    $date_paques = easter_date($annee);
    $jour_paques = date("d", $date_paques);
    $mois_paques = date("m", $date_paques);
    if($jour_paques == $jour && $mois_paques == $mois) return 8; // Paques
    if($jour==$jour_paques+1 && $mois_paques == $mois) return 8; // Lundi Paques

    $date_ascension = mktime(date("H", $date_paques),
	date("i", $date_paques),
	date("s", $date_paques),
	date("m", $date_paques),
	date("d", $date_paques) + 39,
	date("Y", $date_paques)
    );
    $jour_ascension = date("d", $date_ascension);
    $mois_ascension = date("m", $date_ascension);
    if($jour_ascension == $jour && $mois_ascension == $mois) return 8; // Ascension


    $date_pentecote = mktime(date("H", $date_ascension),
	date("i", $date_ascension),
	date("s", $date_ascension),
	date("m", $date_ascension),
	date("d", $date_ascension) + 11,
	date("Y", $date_ascension)
    );
    $jour_pentecote = date("d", $date_pentecote);
    $mois_pentecote = date("m", $date_pentecote);
    if($jour_pentecote == $jour && $mois_pentecote == $mois) return 8; // Pentecote

    $jour_julien = unixtojd($date);
    $jour_semaine = jddayofweek($jour_julien, 0);
    if($jour_semaine == 6) return 2; // samedi
    if($jour_semaine == 0) return 2; // dimanche

    return 0;
} 


?>
