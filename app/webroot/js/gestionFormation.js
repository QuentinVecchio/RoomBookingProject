var gestionFormation = angular.module('gestionFormation', []);
 
gestionFormation.controller('gestionCtrl', function gestionCtrl($scope, $http) {

	$scope.errors = [];

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

	$scope.isEditing = false;
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

	$scope.cancel = function(index){
		$scope.formations[index].Formation.editMode = false;
		$scope.isEditing = false;
		$scope.formations[index].Formation.name = $scope.editValue;
	}


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

	function writeErrors(errors){
		console.log('Erreur:');
		for(i in errors){
			console.log('type: '+errors[i].type);
			console.log('message: '+errors[i].message);
		}
		$scope.errors.push(errors);
		console.log(errors);
	}

	$scope.removeError = function(index){
		$scope.errors.splice(index,1);
	}


});