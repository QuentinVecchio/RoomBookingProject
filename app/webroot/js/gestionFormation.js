var gestionFormation = angular.module('gestionFormation', []);
 
gestionFormation.controller('gestionCtrl', function gestionCtrl($scope, $http) {

	/**
	*	Contient toutes les erreurs lors des appels serveurs
	*/
	$scope.errors = [];

	/**
	*	Permet de supprimer une formation
	*	Fait un appel serveur pour supprimer l'entrée de la base de donnée, si il n'y a pas eu d'erreur, suppression de la ligne
	*	@params index, l'index de la formation dans le tableau
	*/
	$scope.removeLine = function(index){
		var res = confirm('Etes-vous sûr de vouloir supprimer la formation?');
		if(res){
			$http.get($scope.urlDelete+'/'+$scope.formations[index].Formation.id).success(function(response) {
						if(response.errors.length == 0){
							$scope.formations.splice(index,1);
						}else{
							writeErrors(response.errors);
						}
				    });		
		}
	}


	/**
	*	Permet d'ajouter une formation au département
	*	Fait un appel serveur pour poster la nouvelle formation, si il n'y a pas d'erreur, on ajout la ligne renvoyé par le serveur
	*/
	$scope.add = function(){
		if($scope.nouvelleFormation != null && $scope.responsable != null){

			$ligne = {
					department_id: $scope.departmentId,
					name: $scope.nouvelleFormation,
					user_id: $scope.responsable.User.id

				}

			$http.post($scope.urlAdd, $ligne).success(function(response){
				console.log('Reponse:');
				console.log(response);
				if(response.errors.length == 0){
					$scope.formations.push(response.value);
					$scope.nouvelleFormation = '';
				}else{
					writeErrors(response.errors);	
				}
			});

		}else{
			alert('Le champs est nul!');
		}
	}

	/**
	*	Permet de bloquer l'édition à une ligne à la fois
	*/
	$scope.isEditing = false;

	/**
	*	Passage en mode d'édition d'une formation
	*	Bloque l'édition à une seule ligne
	*/
	$scope.edit = function(index){
		if(!$scope.isEditing){
			$scope.formations[index].Formation.editMode = true;
			$scope.editValue = $scope.formations[index].Formation.name;
			$scope.formations[index].Formation.editRes = new Array();
			$scope.formations[index].Formation.editRes['User'] = $scope.formations[index].User;
			$scope.isEditing = true;
		}else{
			alert('Vous éditez déjà une ligne');
		}
	}

	/**
	*	Passage du mode d'édition au mode de visualisation
	*	Remet les valeurs avant modification
	*/
	$scope.cancel = function(index){
		$scope.formations[index].Formation.editMode = false;
		$scope.isEditing = false;
		$scope.formations[index].Formation.name = $scope.editValue;
	}


	/**
	*	Validation de l'édition d'une ligne
	*	Post les valeurs pour mettre a jour la base de donnée, si il n'y a pas eu d'erreur remplace la ligne
	*/
	$scope.valid = function(index){
		if($scope.formations[index].Formation.name.length > 0){
			$ligne = {
					id: $scope.formations[index].Formation.id,
					department_id: $scope.departmentId,
					name: $scope.formations[index].Formation.name,
					user_id: $scope.formations[index].Formation.editRes.User.id,
					department_id: $scope.departmentId

				}

			$http.post($scope.urlAdd, $ligne).success(function(response){
				if(response.errors.length == 0){
					$scope.formations.splice(index,1,response.value);

					$scope.formations[index].Formation.editMode = false;
					$scope.isEditing = false;
				}else{
					$scope.formations[index].Formation.name = $scope.editValue;
					writeErrors(response.errors);				
				}
			});

		}else{
			alert('Le champs est vide');
		}

	}

	/**
	*	Affiche les erreurs du serveur dans la console et les ajoutes dans $scope.errors
	*/
	function writeErrors(errors){
		console.log('Erreur:');
		for(i in errors){
			console.log('type: '+errors[i].type);
			console.log('message: '+errors[i].message);
		}
		$scope.errors.push(errors);
		console.log(errors);
	}

	/**
	*	Supression d'une erreur lors du clic
	*/
	$scope.removeError = function(index){
		$scope.errors.splice(index,1);
	}


});