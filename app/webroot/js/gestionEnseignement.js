var gestionFormation = angular.module('gestionFormation', []);
 
gestionFormation.controller('gestionCtrl', function gestionCtrl($scope, $http) {

	$scope.changement = function(idFormation){
		alert('test');
		if($scope.valeur[id] == true)
		{
			$scope.add(idFormation);
		}
		else
		{
			$scope.delete(idFormation);
		}
	}

	$scope.add = function(idFormation){
		/*$http.get($scope.urlAdd+'/'+idFormation).success(function(response) {
				if(response == 0)
				{
					alert('Erreur lors de l\'ajout');
				}
		});	*/
		alert("case cochée");
	}

	$scope.delete = function(idFormation){
		/*$http.get($scope.urlDelete+'/'+idFormation).success(function(response) {
				if(response == 0)
				{
					alert('Erreur lors de l\'ajout');
				}
		});*/	
		alert("case décochée");
	}
});