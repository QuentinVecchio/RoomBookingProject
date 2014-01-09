<?php
/**
* Objet MotDePasse
* Fait par Quentin Vecchio
* Octobre 2013
*/
class MotDePasse
{
	private $_mdp;
	private $_nbLettre;
	private $_lettre ='abcdefghijklmnopqrstuvwxyz';
	private $_chiffre='0123456789';
	private $_spec = '#@&!?';

	function __construct($nb = 8)
	{
		$this->_nbLettre = $nb;
	}

	public function NbLettre()
	{
		return $this->_nbLettre;
	}

	public function Mdp()
	{
		return $this->_mdp;
	}

	public function setNbLettre($NbLettre)
	{
		$this->_nbLettre = $NbLettre;
	}

	private function setMdp($mdp)
	{
		$this->_mdp = $mdp;
	}

	public function genere()
	{
		$i = 0;
		$mdp = "";
		$aleatoire;
		while($i < $this->_nbLettre)
		{
			$aleatoire = rand(0,6);
			if($i === 0)
			{
				$caractere = substr($this->_spec, mt_rand(0, strlen($this->_spec)-1), 1);
			}
			else if($i%2 === 0)
			{
				$caractere = substr($this->_lettre, mt_rand(0, strlen($this->_lettre)-1), 1);
			}
			else
			{
				$caractere = substr($this->_chiffre, mt_rand(0, strlen($this->_chiffre)-1), 1);
			}
			$mdp .= $caractere;
			$i++;
		}
		$this->setMdp($mdp);
		return $mdp;
	}
}
?>