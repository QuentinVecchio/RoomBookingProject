<?php

	class ImportUtil{

		function initUtil($lien)
		{
		// Ajout de fichiers
			require('PHPExcel.php');
			require_once('MotDePasse.class.php');
			$pass = new MotDePasse();
			$pass->setNbLettre(8);

			require('Utilisateur.class.php');

		// Création de l'objet Reader pour un fichier Excel 2007 
			$objReader = new PHPExcel_Reader_Excel2007(); 
		// Permet de ne récupérer que les valeurs des cellules sans les propriétés de style 
			$objReader->setReadDataOnly(true); 
		// Lecture du fichier. Si on ignore le format du fichier, utiliser PHPExcel_IOFactory 
			$objPHPExcel = PHPExcel_IOFactory::load($lien);
		//Nombres de lignes
		//	$nbLigne = $objReader->sheets[0]['numRows'];
		//On part du principe que la colonne 1 est le nom la 2 le prénom et la 3 l'email
			for($i=1;$i<4;$i++)
			{
				$prenom = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1,$i)->getValue();
				$nom = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0,$i)->getValue();
				$email = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2,$i)->getValue();
				$departement = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3,$i)->getValue();
				$util = new Utilisateur($nom,$prenom);
				$pseudo = $util->genere();

				$mdp = $pass->genere();
	
				echo 'Nom : ' .  $nom .' Prenom : ' . $prenom . ' Email : ' . $email . ' Departement : ' . $departement. ' Pseudo : '. $util->pseudo() . ' Mdp : ' . $mdp .'</br>';
			}
		}
	}
?>