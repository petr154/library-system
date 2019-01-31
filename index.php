 <?php
 
 /*Mùžete ho upravovat a používat jak chcete, musíte však zmínit
  odkaz na http://www.itnetwork.cz    */

// Nastavení interního kódování pro funkce pro práci s øetìzci
mb_internal_encoding("UTF-8");

// Callback pro automatické naèítání tøíd controllerù a modelù
function autoloadFunkce($trida)
{
	// Konèí název tøídy øetìzcem "Kontroler" ?
    if (preg_match('/Kontroler$/', $trida))	
        require("kontrolery/" . $trida . ".php");
    else
        require("modely/" . $trida . ".php");
}

// Registrace callbacku (Pod starým PHP 5.2 je nutné nahradit fcí __autoload())
spl_autoload_register("autoloadFunkce");

// Pøipojení k databázi
Db::pripoj("localhost", "petr154", "XtztwTTeT3fEBnG8", "knihy");

// Vytvoøení routeru a zpracování parametrù od uživatele z URL
$smerovac = new SmerovacKontroler();
$smerovac->zpracuj(array($_SERVER['REQUEST_URI']));

// Vyrenderování šablony
$smerovac->vypisPohled();