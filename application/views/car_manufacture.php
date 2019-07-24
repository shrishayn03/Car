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
</style>
  </head>
  <body ng-app="Car">
  <nav class="navbar navbar-expand-sm bg-primary navbar-dark">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url('Manufacturer/index'); ?>">Car Rental</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="<?php echo base_url('Manufacturer/car_manufacture'); ?>">Manufacturer</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url('Model/car_model'); ?>">Model</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url('Inventory/Inventory_Car'); ?>">Inventory System</a>
    </li>
  </ul>
</nav>
<div class="container" ng-controller="CarCtrl" ng-init="Manufacturer_Show()">
<p></p>
  <h2><?php echo $car_manufacture; ?></h2>

 <div class="alert alert-success alert-dismissible" ng-show="success" ng-click="error()">
    <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
    {{successMessage}}
   </div>
	
	<div class="alert alert-danger alert-dismissible" ng-show="error" >
    <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
    {{errorMessage}}
   </div>
	

  


  <div class="car">
  <form id="save" name="Manufacturer1" ng-submit="Manufacturer()">
	<div class="row">
	
	
	
		<div class="col-md-6">
			<div class="form-group">
			<label for="Manufacturer">Manufacturer Name:</label>
			<input type="text" class="form-control" id="Manufacturer" name="Manufacturer" value="{{name}}" ng-model="ManufacturerName" required autofocus>
			<p style="color:red">{{ManufacturerName}}</p>
</div>
		</div>
		<div class="col-md-6">
		<p>&nbsp;</p>
		<span ng-show="Manufacturer1.Manufacturer.$dirty && Manufacturer1.Manufacturer.$error.required" style="color:red;">Manufacturer Name Required !!! !</span>
		</div>
		
		<div class="col-md-6">
			 <input type="submit" class="btn btn-warning" ng-disabled="Manufacturer1.$invalid" value="{{btnName}}">
		</div>

	</div>
			</form>
  </div>
  <P>
  &nbsp;</P>
  
  <h3><?php echo $car_manufacture1; ?>&nbsp;({{Count}})</h3>
  <div class="alert alert-danger alert-dismissible" ng-show="success1" >
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{successMessage1}}
   </div>
   
   
 <div class="alert alert-success" id="alert4" style="display:none;">
  <strong>Manufacturer!</strong>Updated!!!
</div>


 <table class="table table-bordered">
		<thead>
			<tr>
				<!--<td>ID</td>-->
				<td>Manufacturer Name</td>
				<td>Edit</td>
				<td>Delete</td>
				
			</tr>
		</thead>
			<tr ng-repeat="x in manufacturer_data">
				<!--<td>ID</td>-->
				<td>{{x.name}}</td>
				<td><button ng-click="Edit(x.id,x.name)" class="btn btn-warning btn-xs editEmpForm">Edit</button></td>
				<td><button ng-click="Delete(x.id)" class="btn btn-danger btn-xs">Delete</button></td>
				
			</tr>
			
		</tbody>
</table>
</div>
  </body>
<script>
var app = angular.module('Car',[]);
app.controller('CarCtrl', function($scope,$http) {
	
	 $scope.btnName="ADD";
    $scope.Manufacturer = function(){
		
		$http.post(
		"<?php echo base_url('Manufacturer/add_manufacture'); ?>",
		{name:$scope.ManufacturerName,btnName:$scope.btnName,'id':$scope.id},
		
		).success(function(data)
		{
			
			 if(data == 'false')
   {
    $scope.success = false;
    $scope.error = true;
    $scope.errorMessage = "Manufacturer Already Existed";
   }
   else 
   {
	   
    $scope.success = true;
    $scope.error = false;
    $scope.successMessage = "Manufacturer Name Added";
   
	$scope.Manufacturer_Show();
	 $scope.ManufacturerName=null;
    
   }

	if(data == '1')
		{
	   
    $scope.successMessage = "Manufacturer Name Has Been UPDATED";
	$scope.btnName="ADD";
	$scope.Manufacturer_Show();
	 $scope.ManufacturerName=null;
    
   }
  
   
	
		});
	},	
	
	$scope.Manufacturer_Show= function(){
	$http.get(
		"<?php echo base_url('Manufacturer/show_manufacture'); ?>",
		
		
		).success(function(data)
		{
			$scope.Count_Show();
			$scope.manufacturer_data = data;
		
		});
	},	
	
	 $scope.Delete = function(id){
  if(confirm("Are you sure you want to Delete it?"))
  {
   $http({
    method:"POST",
    url:"<?php echo base_url('Manufacturer/del_manufacture'); ?>",
    data:{'id':id}
   }).success(function(data){
	   alert(data);
	   $scope.Count_Show();
     $scope.Manufacturer_Show();
   });
  }
 },
	
	
	 $scope.Edit = function(id,name){
			$scope.id=id;
			$scope.ManufacturerName=name;
			$scope.btnName="UPDATE";
 },
 
 
 $scope.Count_Show= function(){
	$http.get(
		"<?php echo base_url('Manufacturer/show_count'); ?>",
		).success(function(data)
		{	
			$scope.Count=data;
		});
	}
 
 
	
});
</script>
</html>
