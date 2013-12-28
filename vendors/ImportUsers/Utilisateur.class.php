<?php 
	/**
	* Objet Utilisateur fait par Quentin Vecchio
	* 10 nov 2013
	* Objet permettant de generer un pseudo
	*/
	class Utilisateur
	{
		private $_pseudo;
		private $_nom;
		private $_prenom;
		private $_nCaracNom;
		private $_nCaracPrenom;
	//Constructeur
		function __construct($nom,$prenom,$nCaracNom = 4,$nCaracPrenom = 4)
		{
			$this->_nom = $nom;
			$this->_prenom = $prenom;
			$this->_nCaracPrenom = $nCaracPrenom;
			$this->_nCaracNom = $nCaracNom;
			
		}
	//Getters
		function pseudo()
		{
			return $this->_pseudo;
		}

		function nom()
		{
			return $this->_nom;
		}

		function prenom()
		{
			return $this->_prenom;
		}

		function nCaracPrenom()
		{
			return $this->_nCaracPrenom;
		}

		function nCaracNom()
		{
			return $this->_nCaracNom;
		}
	//Setters
		function setPseudo($pseudo)
		{
			$this->_pseudo = $pseudo;
		}

		function setNom($nom)
		{
			$this->_nom = $nom;
		}

		function setPrenom($prenom)
		{
			$this->_prenom = $prenom;
		}

		function setNCaracPrenom($nCaracPrenom)
		{
			$this->_nCaracPrenom = $nCaracPrenom;
		}

		function setNCaracNom($nCaracNom)
		{
			$this->_nCaracNom = $nCaracNom;
		}

		function genere()
		{
			$pseudo = "";

			if(strlen($this->_nom) < $this->_nCaracNom)
			{
				$pseudo .= substr($this->_nom, 0, strlen($this->_nom));
			}
			else
			{
				$pseudo .= substr($this->_nom, 0, $this->_nCaracNom);
			}

			if(strlen($this->_prenom) < $this->_nCaracPrenom)
			{
				$pseudo .= substr($this->_prenom, 0, strlen($this->_prenom));
			}
			else
			{
				$pseudo .= substr($this->_prenom, 0, $this->_nCaracPrenom);
			}
			$this->_pseudo =  strtolower($pseudo);
		}
	}



?>