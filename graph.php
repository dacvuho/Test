<!doctype html>
<html ng-app="myApp">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nvd3/1.8.1/nv.d3.min.css"/>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.9/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.6/d3.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nvd3/1.8.1/nv.d3.min.js"></script>
    <script src="https://rawgit.com/krispo/angular-nvd3/v1.0.5/dist/angular-nvd3.js"></script>
    <script src="app.js"></script>



</head>
<body ng-controller="myCtrl">
<div>
    <nvd3 options="options" data="data"></nvd3>
</div>
</body>
</html>