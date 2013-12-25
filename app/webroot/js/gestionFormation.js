var gestionFormation = angular.module('gestionFormation', []);
 
gestionFormation.controller('gestionCtrl', function gestionCtrl($scope, $http) {

	$scope.removeLine = function(index){
		var res = confirm('Etes-vous sûr de vouloir supprimer la formation?');
		if(res){
			$http.get($scope.urlDelete+'/'+$scope.formations[index].Formation.id).success(function(response) {
						if(response == 1){
							$scope.formations.splice(index,1);
						}else{
							alert('Erreur lors de la suppression');
						}
				    });		
		}
	}

	$scope.add = function(){
		if($scope.nouvelleFormation != null){
			$http.get($scope.urlAdd+'/'+$scope.departmentId+'/'+$scope.nouvelleFormation).success(function(response) {
				if(response != 0){
					$scope.formations.push(response);
					$scope.nouvelleFormation = '';
				}else{
					alert('Erreur lors de l\'ajout');
				}
		    });			
		}
	}

	$scope.isEditing = false;
	$scope.editValue = '';
	$scope.edit = function(index){
		if(!$scope.isEditing){
			$scope.formations[index].Formation.editMode = true;
			$scope.editValue = $scope.formations[index].Formation.name;
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
			$http.get($scope.urlUpdate+'/'+$scope.formations[index].Formation.id+'/'+$scope.formations[index].Formation.name+'/'+$scope.departmentId).success(function(response) {
				if(response != 0){
					$scope.formations.splice(index,1,response);
				}else{
					alert('Erreur lors de l\'ajout');
				}
		    });	

			$scope.formations[index].Formation.editMode = false;
			$scope.isEditing = false;
		}else{
			alert('Le champs est vide');
		}

	}


});