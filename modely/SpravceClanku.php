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
// Třída poskytuje metody pro správu článků v redakčním systému
class SpravceClanku
{
	
	// Vrátí článek z databáze podle jeho URL
	public function vratClanek($url)
	{
		return Db::dotazJeden('
			SELECT `clanky_id`, `titulek`, `obsah`, `url`, `popisek`, `klicova_slova`
			FROM `clanky` 
			WHERE `url` = ?
		', array($url));
	}
	
	// Vrátí seznam článků v databázi
	public function vratClanky()
	{
		return Db::dotazVsechny('
			SELECT `clanky_id`, `titulek`, `url`, `popisek`
			FROM `clanky` 
			ORDER BY `clanky_id` DESC
		');
	}
    
    //Petrova úprava  - vyhledání článků dle dotazu uživatele
    public function vratVybrane($search)
	{
		return Db::dotazVsechny("
			SELECT `clanky_id`, `titulek`, `url`, `popisek`
			FROM `clanky` 
			WHERE titulek LIKE '%search%' OR obsah LIKE '%search%'
		");
	}
    
	
}