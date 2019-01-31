 <?php
 
 /*M��ete ho upravovat a pou��vat jak chcete, mus�te v�ak zm�nit
  odkaz na http://www.itnetwork.cz    */

// Nastaven� intern�ho k�dov�n� pro funkce pro pr�ci s �et�zci
mb_internal_encoding("UTF-8");

// Callback pro automatick� na��t�n� t��d controller� a model�
function autoloadFunkce($trida)
{
	// Kon�� n�zev t��dy �et�zcem "Kontroler" ?
    if (preg_match('/Kontroler$/', $trida))	
        require("kontrolery/" . $trida . ".php");
    else
        require("modely/" . $trida . ".php");
}

// Registrace callbacku (Pod star�m PHP 5.2 je nutn� nahradit fc� __autoload())
spl_autoload_register("autoloadFunkce");

// P�ipojen� k datab�zi
Db::pripoj("localhost", "petr154", "XtztwTTeT3fEBnG8", "knihy");

// Vytvo�en� routeru a zpracov�n� parametr� od u�ivatele z URL
$smerovac = new SmerovacKontroler();
$smerovac->zpracuj(array($_SERVER['REQUEST_URI']));

// Vyrenderov�n� �ablony
$smerovac->vypisPohled();