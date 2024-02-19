angular.module("MyApp", []).controller("NavController", [
  "$window",
  function ($window) {
    this.goToLogin = function () {
      $window.location.href = "login.html";
    };
  },
]);
