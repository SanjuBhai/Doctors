var myAppServices = angular.module("services", []);

myAppServices.factory('DataService', function() {
  
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