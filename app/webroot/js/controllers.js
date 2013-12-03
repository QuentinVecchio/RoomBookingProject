var gestionDemande = angular.module('gestionDemande', []);
 
gestionDemande.controller('FormCtrl', function FormCtrl($scope) {
 //$scope.id = 1;
  $scope.number= 1;

	$scope.getNumber = function(num) {
		var tmp = new Array();
		for(var i=1; i < num; i++){
			tmp.push(i);
		}
	    return tmp; 
	}

	$scope.getDate = function(num, date){
		var tmp = date.split('-');
		var d = new Date(tmp[2], (tmp[1]-1), tmp[0],0,0,0,0);
		

		var d1 = new Date(d.getTime()+num*604800000);
		return d1.getDate()+'-'+(d1.getMonth()+1)+'-'+d1.getFullYear();
	}




});