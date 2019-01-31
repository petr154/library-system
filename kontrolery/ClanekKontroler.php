<?php

/*
 *  _____ _______         _                      _
 * |_   _|__   __|       | |                    | |
 *   | |    | |_ __   ___| |___      _____  _ __| | __  ___ ____
 *   | |    | | '_ \ / _ \ __\ \ /\ / / _ \| '__| |/ / / __|_  /
 *  _| |_   | | | | |  __/ |_ \ V  V / (_) | |  |   < | (__ / /
 * |_____|  |_|_| |_|\___|\__| \_/\_/ \___/|_|  |_|\_(_)___/___|
 *                   ___
 *                  |  _|___ ___ ___
 *                  |  _|  _| -_| -_|  LICENCE
 *                  |_| |_| |___|___|
 *
 * IT ZPRAVODAJSTVÍ  <>  PROGRAMOVÁNÍ  <>  HW A SW  <>  KOMUNITA
 *
 * Tento zdrojový kód pochází z IT sociální sítě WWW.ITNETWORK.CZ
 *
 * Můžete ho upravovat a používat jak chcete, musíte však zmínit
 * odkaz na http://www.itnetwork.cz
 */

// Controller pro výpis článků

class ClanekKontroler extends Kontroler
{
    public function zpracuj($parametry)
    {
		// Vytvoření instance modelu, který nám umožní pracovat s články
		$spravceClanku = new SpravceClanku();
		
		// Je zadáno URL článku
		if (!empty($parametry[0]))
		{
			// Získání článku podle URL
			$clanek = $spravceClanku->vratClanek($parametry[0]);
			// Pokud nebyl článek s danou URL nalezen, přesměrujeme na ChybaKontroler
			if (!$clanek)
				$this->presmeruj('chyba');
		
			// Hlavička stránky
			$this->hlavicka = array(
				'titulek' => $clanek['titulek'],
				'klicova_slova' => $clanek['klicova_slova'],
				'popis' => $clanek['popisek'],
			);
			
			// Naplnění proměnných pro šablonu		
			$this->data['titulek'] = $clanek['titulek'];
			$this->data['obsah'] = $clanek['obsah'];
			
			// Nastavení šablony
			$this->pohled = 'clanek';
		}
		else
		// Není zadáno URL článku, vypíšeme všechny
		{
			$clanky = $spravceClanku->vratClanky();
			$this->data['clanky'] = $clanky;
			$this->pohled = 'clanky';
		}
    }
}