/**
 * Created by sean on 4/5/15.
 */


(function(){
    var app = angular.module('convercity', []);

    app.controller('DataloggerController', function($scope, $http){
        $http.get("/app/datalogger/table/").success(function(data){
            $scope.tables = data;
        });
    });

})();