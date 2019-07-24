<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">

<script src="<?php echo base_url('assets/js/popper.min.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>

<style>
.car{
	border:1px solid black;
	padding:10px;
}

.sort-icon {
    font-size: 9px;
    margin-left: 5px;
}

th {
    cursor:pointer;
}
</style>
  </head>
  <body ng-app="Car">
  <nav class="navbar navbar-expand-sm bg-primary navbar-dark">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url('Manufacturer/index'); ?>">Car Rental</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url('Manufacturer/car_manufacture'); ?>">Manufacturer</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url('Model/car_model'); ?>">Model</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="<?php echo base_url('Inventory/Inventory_Car'); ?>">Inventory System</a>
    </li>
  </ul>
</nav>
<div class="container" ng-controller="CarCtrl" ng-init="Manufacturer_Show()">
  <P>
  &nbsp;</P>
  
  <h3><?php echo $car_manufacture1; ?>&nbsp;({{Count}})</h3>
  <div class="alert alert-danger alert-dismissible" ng-show="success1" >
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{successMessage1}}
   </div>
   

		<div class="col-md-12">
          
            <input type="text" ng-model="search" class="form-control" placeholder="Search Records..">
          </div>
<p></p>
 <table class="table table-bordered">
		<thead>
			<tr>
				<td  ng-click="sort('id')">ID <span class="glyphicon sort-icon" ng-show="sortKey=='id'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></td>
				<td ng-click="sort('name')">Manufacturer Name <span class="glyphicon sort-icon" ng-show="sortKey=='name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></td>
				<td ng-click="sort('model_name')">Model Name <span class="glyphicon sort-icon" ng-show="sortKey=='model_name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></td>
				<td ng-click="sort('quantity')">Quantity(Count*)
				 <span class="glyphicon sort-icon" ng-show="sortKey=='quantity'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
				</td>
				
				<td>Action</td>
				
			</tr>
		</thead>
			<tr dir-paginate="x in inventory_data | orderBy:sortKey:reverse|filter:search|itemsPerPage:4">
				<td>{{x.id}}</td>
				<td>{{x.name}}</td>
				<td>{{x.model_name}}</td>
				<td>{{x.quantity}}</td>
				
				<td><button ng-click="Sold(x.id)" class="btn btn-success btn-xs">Sold</button></td>
				
			</tr>
			
		</tbody>
		
</table>
<dir-pagination-controls
        max-size="4"
        direction-links="true"
        boundary-links="true" >
    </dir-pagination-controls>
</div>
<script src="<?php echo base_url('assets/js/dirPagination.js'); ?>"></script> 
  </body>
<script>
var app = angular.module('Car',['angularUtils.directives.dirPagination']);
app.controller('CarCtrl', function($scope,$http) {

	
	$scope.Manufacturer_Show= function(){
	$http.get(
		"<?php echo base_url('Inventory/show_inventory'); ?>",
		
		
		).success(function(data)
		{
			
			$scope.Count_Show();
			$scope.inventory_data = data;
		

		});
	},
	
	 $scope.sort = function(keyname){
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    },
	
	 $scope.Sold = function(id){
  if(confirm("Are you sure you want to Sold it?"))
  {
   $http({
    method:"POST",
    url:"<?php echo base_url('Inventory/Sold'); ?>",
    data:{'id':id}
   }).success(function(data){
	   alert(data);
	   $scope.Count_Show();
	   $scope.Manufacturer_Show();
   });
  }
 },
 
 $scope.Count_Show= function(){
	$http.get(
		"<?php echo base_url('Inventory/show_count'); ?>",
		).success(function(data)
		{	
		
			$scope.Count=data;
		});
	}
 
 
	
});
</script>
</html>
