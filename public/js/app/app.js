(function(){
    var app = angular.module('convercity', []);

    app.controller('ReplyController', function($scope, $http){
        $http.get("/app/reply/").success(function(data){
            $scope.replies = data;
        });
    });

})();