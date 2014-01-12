var gestionFormation = angular.module('gestionFormation', []);
 
gestionFormation.controller('gestionCtrl', function gestionCtrl($scope, $http) {

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
			$http.get($scope.urlAdd+'/'+$scope.departmentId+'/'+$scope.nouvelleFormation+'/'+$scope.responsable.User.id).success(function(response) {
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
			$http.get($scope.urlUpdate+'/'+$scope.formations[index].Formation.id+'/'+
											$scope.formations[index].Formation.name+'/'+
											$scope.departmentId+'/'+$scope.formations[index].Formation.editRes.User.id).success(function(response) {
				if(response.errors.length == 0){
					$scope.formations.splice(index,1,response.value);

					$scope.formations[index].Formation.editMode = false;
					$scope.isEditing = false;
				}else{
					alert('Erreur lors de l\'ajout');
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
	}


});