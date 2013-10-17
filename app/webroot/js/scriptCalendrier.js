$(function(){
//Initialisation des variables
	date = new Date();
	var annee = date.getFullYear();
	var mois = date.getMonth()+1;
	var jour = date.getDate();
	init(3,9,2013);
	parcour = 402;
	//Initialisation des calendriers
//Initialisation de l'interfaces en mettant le focus sur la date d'aujourd'hui
	function init(j,m,a)
	{
		if(a == annee)
		{
			$('#month' + m +' #days'+j).addClass('focus');
		}
		else
		{
			$('#month1' + m +' #days'+j).addClass('focus');
		}
		$('#titreAnnee').attr('val',a);
		$('#titreMois').attr('val',m);
		if(a == annee)
		{
			$('#month' + m).addClass('affiche');
		}
		else
		{
			$('#month1' + m).addClass('affiche');
		}	
	}
	function gereBasCalendrier(nMois)
	{

		spanNbLigne = $('#nbLigne'+nMois).html();
		nbLigne = parseInt(spanNbLigne);
		he = $('#basCalendrier').css('height');
		tailleInit = parseInt(he);
		if(nbLigne == 4)
		{
			tailleNv = 290;
		}
		else if(nbLigne == 5)
		{
			tailleNv = 345;
		}
		else
		{
			tailleNv = 400;
		}
		taille = tailleNv - tailleInit;
		$('#basCalendrier').animate({ height: '+='+ taille}, 800);	
	}
//Initialisation des actions
	//Fonction de clique sur le bouton de controle Bas
		$('#btnH').click(function() 
		{
			//Recupère le mois courant
				moisCourant = $('#titreMois').attr('val');
				nbMois = parseInt(moisCourant);
				nbMoisAv = nbMois;
			//On recupère l'annee courante
				annneeCourant = $('#titreAnnee').attr('val');
				nbAnnee = parseInt(annneeCourant);
			if(!(nbMois == 9 && nbAnnee == annee))
			{	
				//Si on peux monter alors 
					//On modifie l'attribut val de mois, et l'attribut d'annee si il change
					if(nbMois == 1)
					{
						nbMois = 12;
						nbAnnee -= 1;
						$('#titreAnnee').attr('val',nbAnnee);
						$('#anneeBouge').animate({ marginTop: '+='+74}, 800);
					}
					else
					{
						nbMois-=1;
					}
					$('#titreMois').attr('val',nbMois);
				//On met a jour le mois dans la vue
					$('#moisBouge').animate({ marginTop: '+='+37}, 800);
				//Gestion de l'affichage du calendrier	
					$('#month' + nbMois).addClass('affiche');
					spanNbLigne = $('#nbLigne'+nbMois).html();
					nbLigne = parseInt(spanNbLigne);
					nbLigne += 1;
					nbLigne *= 58;
					nbLigne -= 3;
					$('#month9').animate({ marginTop: '+='+nbLigne}, 800, function(){
						$('#month' + nbMoisAv).removeClass('affiche');	
					});	
				//Gestion du bas de calendrier
					gereBasCalendrier(nbMois);	
			}
		});
	//Fonction de clique sur le bouton de controle Haut
		$('#btnB').click(function() 
		{
			//Recupere le mois courant
				moisCourant = $('#titreMois').attr('val');
				nbMois = parseInt(moisCourant);
				nbMoisAv = nbMois;
			//On recupère l'année courante
				annneeCourant = $('#titreAnnee').attr('val');
				nbAnnee = parseInt(annneeCourant);
			if(!(nbMois == 8 && nbAnnee == annee+1))
			{	
				//Si on peux descendre alors
					//On modifie l'attribut val de mois, et l'attribut d'annee si il change
					if(nbMois == 12)
					{
						nbMois = 1;
						nbAnnee += 1;
						$('#titreAnnee').attr('val',nbAnnee);
						$('#anneeBouge').animate({ marginTop: '-='+74}, 800);
					}
					else
					{
						nbMois+=1;
					}
				$('#titreMois').attr('val',nbMois);
			//On met a jour le mois dans la vue
				$('#moisBouge').animate({ marginTop: '-='+37}, 800);	
			//Gestion de l'affichage du calendrier	
				$('#month' + nbMois).addClass('affiche');
				spanNbLigne = $('#nbLigne'+nbMoisAv).html();
				nbLigne = parseInt(spanNbLigne);
				nbLigne += 1;
				nbLigne *= 58;
				nbLigne -= 3;
				$('#month9').animate({ marginTop: '-='+nbLigne}, 800, function(){
					$('#month' + nbMoisAv).removeClass('affiche');	
				});	
			//Gestion du bas de calendrier
				gereBasCalendrier(nbMois);	
			}
		});
});