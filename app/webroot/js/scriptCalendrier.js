$(function(){
//Initialisation des variables
	date = new Date();
	var annee = date.getFullYear();
	var mois = date.getMonth()+1;
	var jour = date.getDate();
	init(jour,9,annee);
	parcour = 402;
	initFocus(jour,mois,annee);
	//Initialisation des calendriers
//Initialisation de l'interfaces en mettant le focus sur la date d'aujourd'hui
	function init(j,m,a)
	{
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
	function change()
	{
		$("#btnB").trigger('click');
	}
	function initFocus(j,m,a)
	{
		
		var dif = m - 9;
		var n = 9 + dif;
		if(dif < 0)
		{
			dif = 9 - m;
		}
		for(i=0;i<dif;i++)
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
						$('#anneeBouge').animate({ marginTop: '-='+63}, 0);
					}
					else
					{
						nbMois+=1;
					}
				$('#titreMois').attr('val',nbMois);
			//On met a jour le mois dans la vue
				$('#moisBouge').animate({ marginTop: '-='+30}, 0);

			//Gestion de l'affichage du calendrier	
				$('#month' + nbMois).addClass('affiche');
				spanNbLigne = $('#nbLigne'+nbMoisAv).html();
				nbLigne = parseInt(spanNbLigne);
				nbLigne += 1;
				nbLigne *= 60;
				nbLigne -=4;
				$('#month9').animate({ marginTop: '-='+nbLigne}, 0, function(){
					$('#month' + nbMoisAv).removeClass('affiche');		
				});	
			//Gestion du bas de calendrier	
			}
		}
		gereBasCalendrier(nbMois);
		if(a == annee)
		{
			$('#month' + m +' #days'+j).addClass('focus');
		}
		else
		{
			$('#month1' + m +' #days'+j).addClass('focus');
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
						$('#anneeBouge').animate({ marginTop: '+='+63}, 800);
					}
					else
					{
						nbMois-=1;
					}
					$('#titreMois').attr('val',nbMois);
				//On met a jour le mois dans la vue
					$('#moisBouge').animate({ marginTop: '+='+30}, 800);
				//Gestion de l'affichage du calendrier	
					$('#month' + nbMois).addClass('affiche');
					spanNbLigne = $('#nbLigne'+nbMois).html();
					nbLigne = parseInt(spanNbLigne);
					nbLigne += 1;
					nbLigne *= 60;
					nbLigne -= 4;
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
						$('#anneeBouge').animate({ marginTop: '-='+63}, 800);
					}
					else
					{
						nbMois+=1;
					}
				$('#titreMois').attr('val',nbMois);
			//On met a jour le mois dans la vue
				$('#moisBouge').animate({ marginTop: '-='+30}, 800);

			//Gestion de l'affichage du calendrier	
				$('#month' + nbMois).addClass('affiche');
				spanNbLigne = $('#nbLigne'+nbMoisAv).html();
				nbLigne = parseInt(spanNbLigne);
				nbLigne += 1;
				nbLigne *= 60;
				nbLigne -=4;
				$('#month9').animate({ marginTop: '-='+nbLigne}, 800, function(){
					$('#month' + nbMoisAv).removeClass('affiche');		
				});	
			//Gestion du bas de calendrier
				gereBasCalendrier(nbMois);	
			}
		});
	//Fonction de gestion des touches du claviers
		$('body').keydown(function(e){
			if(e.which == 38)
			{
				$("#btnH").trigger('click');
			}
			else if(e.which == 40)
			{
				$("#btnB").trigger('click');
			}
     	});
     //Fonction permettant de dormir
     	function sleep(milliseconds,n) 
     	{
	  		var start = new Date().getTime();
	  		for (var i = 0; i < 1e7; i++) 
	  		{
		    	if ((new Date().getTime() - start) > milliseconds)
		    	{
		      		break;
		    	}
  			}
		}
});