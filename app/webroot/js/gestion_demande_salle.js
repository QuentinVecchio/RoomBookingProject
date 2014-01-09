var gestionTableau =angular.module('gestionTableau', [])

  .directive('dateAfter', function () {
      
    return {
      
      require: 'ngModel',
      
      link: function (scope, element, attrs, ngModelCtrl) {
        var date, otherDate;
        scope.$watch(attrs.dateAfter, function (value) {
          otherDate = value;
          validate();
        });
        scope.$watch(attrs.ngModel, function (value) {
          date = value;
          validate();
        });
        function validate() {
          ngModelCtrl.$setValidity('dateAfter', !date || !otherDate || date > otherDate);
        } 
      }
      
    };

  })


function tableauController($scope){

	$scope.loans = []


	$scope.removeLine = function(index){
		var res = confirm('Etes-vous sûr de vouloir supprimer la ligne?');
		if(res){
			$scope.loans.loan.splice(index, 1);
		}
		return false;
	}

	$scope.duplicateLine = function(index){
		var original = $scope.loans.loan[index];
		var tmp = {
				status_id: original.status_id,
				department_id: original.department_id,
				room_id: original.room_id,
				date : '',
				start_time: original.start_time,
				end_time: original.end_time,
				remark: original.remark

			};
		$scope.loans.loan.splice(index+1, 0, tmp);
		return false;
	}
}