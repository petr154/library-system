<?php

// Controller pro výpis knih

class KnihaKontroler extends Kontroler
{
    public function zpracuj($parametry)
    {
  		// Vytvoření instance modelu, který nám umožní pracovat s knihami
  		$spravceKnih = new SpravceKnih();

  		// Je zadáno URL článku
  		if (!empty($parametry[0]))
  		{
  			// Získání knihy podle URL
  			$kniha = $spravceKnih->vratKnihu($parametry[0]);
  			// Pokud nebyl článek s danou URL nalezen, přesměrujeme na ChybaKontroler
  			if (!$kniha)
  				$this->presmeruj('chyba');

  			// Hlavička stránky
  			$this->hlavicka = array(
  				'titulek' => $kniha['titul'],
  				'klicova_slova' => $kniha['autor'],
  				'popis' => $kniha['poloha'],
  			);

  			// Naplnění proměnných pro šablonu
  			$this->data['titulek'] = $kniha['titul'];
  			$this->data['obsah'] = $kniha;

  			// Nastavení šablony
  			$this->pohled = 'kniha';
  		}
  		elseif (empty($parametry[0]))
    		// Není zadáno URL knihy, čekáme na vyhledávání uživatelem - nebo vypíšeme všechny

    		if (isset($_POST['searchBook'])) {

          $knihy = $spravceKnih->vratVyberKnih();
    			$this->data['knihy'] = $knihy;
    			$this->pohled = 'knihy';
        } else{
          //Řazení abecedně/data vydání
    			   switch ($_POST['sortBy']) {
              case 'authorZa':
                $knihy = $spravceKnih->vratKnihyZa();
                $this->data['knihy'] = $knihy;
                $this->pohled = 'knihy';
                break;
              case 'newest':
                $knihy = $spravceKnih->vratKnihyNewest();
                $this->data['knihy'] = $knihy;
                $this->pohled = 'knihy';
                break;
              case 'oldest':
                $knihy = $spravceKnih->vratKnihyOldest();
                $this->data['knihy'] = $knihy;
                $this->pohled = 'knihy';
                break;

              default:
                $knihy = $spravceKnih->vratKnihy();
                $this->data['knihy'] = $knihy;
                $this->pohled = 'knihy';
                break;
            }
  		  }

    }
}
