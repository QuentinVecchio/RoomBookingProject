<?php
/**
* Objet Date
* Fait par Quentin Vecchio
* Octobre 2013
*/
class Date 
{
	//Variables
		private $_annee;
		private $_mois;
		private $_jour;
		private $_Jours = array('Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche');
		private $_Mois = array('Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre');
	//Methodes
		//Constructeur
			function __construct()
			{
				if(date('n') > 1 && date('n') < 9)
				{
					$this->_annee = date('Y')-1;				
				}
				else 
				{
					$this->_annee = date('Y');
				}
				$this->_mois = date('n');
				$this->_jour = date('j');
			}
		//Setters
			//Setter Annee
				public function setAnnee($nouvellleAnnee)
				{
					$this->_annee = $nouvellleAnnee;
				}
			//Setter Mois
				public function setMois($nouveauMois)
				{
					$this->_mois = $nouveauMois;
				}
			//Setter Jour
				public function setJour($nouveauJour)
				{
					$this->_jour = $nouveauJour;
				}
		//Getters
			//Getter annnee
				public function Annee()
				{
					return $this->_annee;
				}
			//Getter mois
				public function Mois()
				{
					return $this->_mois;
				}
			//Getter jour
				public function Jour()
				{
					return $this->_jour;
				}
			//Getter Tableau de jour
				public function tabJour()
				{
					return $this->_Jours;
				}
			//Getter Tableau de mois
				public function tabMois()
				{
					return $this->_Mois;
				}
		//Affichage
			//affiche Date
				public function afficheDate()
				{
					echo $this->_jour . '/' . $this->_mois .'/' . $this->_annee;
				}
			//affiche Jours
				public function afficheJour()
				{
					foreach ($this->_Jours as $jour) 
					{
						echo $jour . " ";
					}
				}
			//affiche Mois
				public function afficheMois()
				{
					foreach ($this->_Mois as $mois) {
						echo $mois . " ";
					}
				}
			//Fonction qui renvoie un tableau des jours et mois de l'année
		public function tabAnnee($year)
		{
			$table = array();
			$date = new DateTime($year . '-01-01');
			while($date->format('Y') <= $year)
			{
				$y = $date->format('Y');
				$m = $date->format('n');
				$d = $date->format('j');
				$w = str_replace('0','7', $date->format('w'));
				$table[$y][$m][$d] = $w;
				$date->add(new DateInterval('P1D'));
			}
			return $table;
		}
}
?>