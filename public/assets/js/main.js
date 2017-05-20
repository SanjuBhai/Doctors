//Define an angular module for our app
var myApp = angular.module('myApp', ['ui.router']);

//Define Routing for app

myApp.config(function($stateProvider, $urlRouterProvider) {
    
    $urlRouterProvider.otherwise('/Doctors');
    
    $stateProvider
	
	//route for banner-bottom page
    .state('/Doctors', {
	url:'/Doctors',
	templateUrl: 'views/banner-bottom.html'
	})
	   //route for doctor-list page
	 .state('/doctorList', {
	url: '/doctorList',
	templateUrl: 'views/doctor-list.html',
	controller: 'DoctorsController'
	
	})
	 //route for doctor-view page
	.state('/doctorView', {
	url:  '/doctorView',
	templateUrl: 'views/doctor-view.html',
	controller: 'DoctorsViewController'
      }) 
	  
	  
	  //route for doctor-list page
	.state('/Restro', {
	url:'/Restro',
	templateUrl: 'views/restro-bottom.html'
	
     })
	  //route for restro-list page
	 .state('/restroList', {
	url: '/restroList',
	templateUrl: 'views/restro-list.html'
	})
	  //route for restro-view page
	 .state('/viewMore', {
	url: '/viewMore',
	templateUrl: 'views/restro-view.html',
	controller: 'RestroController'
      });
	  
	 
});
myApp.factory('DataService', function() {
  
  var factory = {};
  var dataStore = [];

  factory.setData = function(data) {  
   
    dataStore.push(data);// Push all form data into dataStore
  }
  
  factory.getData = function() { 
      return dataStore; 
  } 
  return factory;

});
myApp.controller('DoctorsController', function($scope, $http,DataService) {
  $http.get('doctor-list.json')
       .then(function(res){
          $scope.docs = res.data;
		 });
		 $scope.doit= function(data){
		 DataService.setData(data)
       }
});
//myApp.controller('DoctorsController', function($scope, $http) {
    
		
		 
//});




