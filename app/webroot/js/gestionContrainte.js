var gestionFormation = angular.module('gestionContrainte', []);
 
gestionFormation.controller('gestionCtrl', function gestionCtrl($scope, $http, filterFilter) {
	$scope.semaine = new Array([],[],[],[],[],[]);

	$scope.filtreTraite = "tous";

	$scope.removeLine = function(i, index){
		//var res = confirm('Etes-vous sûr de vouloir supprimer la ligne?');
		//if(res){
			//console.log($scope.semaine[i]);
			$scope.semaine[i].splice(index, 1);
		//}
	}

	$scope.duplicateLine = function(i, index){
		var tmp = {
				date : '',
				start_time: '',
				end_time: ''
			};
		$scope.semaine[i].splice(index+1, 0, tmp);
	}

	$scope.initCheck = function(i){
		if(i==1){
			$scope.codeCouleur = {background:'#1D702D'};
			return true;
		}else{
			$scope.codeCouleur = {background:'#C9001A'};
			return false;
		}
	}

	$scope.deleteC = function(id, date, index){
		var idUser = id.c.Constraint.user_id;
		var existe = false;
		var idC = id.c.Constraint.id;

		$http.get($scope.urlDeleteC+'/'+idC).success(function(response) {
				if(response != 0){
					for(i in $scope.constraints){
						if($scope.constraints[i] == id.c){
							$scope.constraints.splice(i,1);
						}else if($scope.constraints[i].Constraint.user_id == idUser&&
								$scope.constraints[i].Constraint.date == date){
							// si il existe encore des entrées pour le jour donnée
							existe = true;
						}
					}

					// si il ne reste plus d'élément pour un user donnée d'une journée
					if(!existe){
						for(i in $scope.listId[index].id){
							if($scope.listId[index].id[i].Constraint.user_id == idUser){
								$scope.listId[index].id.splice(i, 1);
							}
						}
					}					
				}else{
					alert('Erreur lors de la suppression');
				}
		    });	

		
	}

	$scope.changeC = function(user_id, date, t){
		var d = new Date(date);
		var r;
		if(t){
			r = 1;
			$scope.codeCouleur = {background:'#1D702D'};
		}else{
			$scope.codeCouleur = {background:'#C9001A'};
			r = 0;
		}
		$http.get($scope.urlChangeC+'/'+user_id+'/'+date+'/'+r).success(function(response) {
				if(response == 0){
					alert('Erreur lors du changement d\'état');
				}
		    });	
	}

});