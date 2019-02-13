<?php

// Třída poskytuje metody pro správu článků v redakčním systému
class SpravceKnih
{

	// Vrátí knihu z databáze podle jeho URL
	public function vratKnihu($url)
	{
		return Db::dotazJeden('
			SELECT `id`, `autor`, `titul`, `vydani`, `poloha`, `poznamka`,`url`
			FROM `knihovna`
			WHERE `url` = ?
		', array($url));
	}

	// Vrátí seznam článků v databázi
	//Řazení od A do Z
	public function vratKnihy()
	{
		return Db::dotazVsechny('
			SELECT `id`, `autor`, `titul`, `vydani`, `poloha`, `poznamka`,`url`
			FROM `knihovna`
			ORDER BY `autor` ASC
		');
	}

//Řazení od Z do A
	public function vratKnihyZa()
	{
		return Db::dotazVsechny('
			SELECT `id`, `autor`, `titul`, `vydani`, `poloha`, `poznamka`,`url`
			FROM `knihovna`
			ORDER BY `autor` DESC
		');
	}
	//Řazení od od nejnovější
		public function vratKnihyNewest()
		{
			return Db::dotazVsechny('
				SELECT `id`, `autor`, `titul`, `vydani`, `poloha`, `poznamka`,`url`
				FROM `knihovna`
				ORDER BY `vydani` DESC
			');
		}

		//Řazení od od nejstarší
			public function vratKnihyOldest()
			{
				return Db::dotazVsechny('
					SELECT `id`, `autor`, `titul`, `vydani`, `poloha`, `poznamka`,`url`
					FROM `knihovna`
					ORDER BY `vydani` ASC
				');
			}

	//Vrátí uživatelem hledané články

	public function vratVyberKnih()
	{
		return Db::dotazVsechny("
			SELECT *
			FROM knihovna
			WHERE autor LIKE CONCAT('%', ?, '%')
		", array($_POST['searchBook']));


		/* vrátí Undefined Index...
		return Db::dotazVsechny("
        SELECT *
        FROM clanky
        WHERE titulek LIKE ?
    ", ['%' . $_POST['search'] . '%']);*/
	}

}
