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

<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>
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
    <li class="nav-item active">
      <a class="nav-link" href="<?php echo base_url('Model/car_model'); ?>">Model</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url('Inventory/Inventory_Car'); ?>">Inventory System</a>
    </li>
  </ul>
</nav>
<div class="container" ng-controller="CarCtrl"  ng-init="Model_Show()">
<p></p>
  <h2><?php echo $car_model; ?></h2>

  <div class="alert alert-success alert-dismissible" ng-show="success" ng-class="{fade:doFade1}">
    <p class="close" data-dismiss="alert" aria-label="close"></p>
    {{successMessage}}
   </div>
	
	<div class="alert alert-danger alert-dismissible" ng-show="error" ng-class="{fade:doFade}">
    <p class="close" data-dismiss="alert" aria-label="close"></p>
    {{errorMessage}}
   </div>
	

  <div class="car">
  <form name="model1" id="save" ng-submit="Model()">
	<div class="row">
		<div class="col-md-6">
			 <div class="form-group">
			 
  <label for="Manufacturer">Manufacturer Name:</label>
  <select class="form-control" id="Manufacturer" name="Model" ng-model="ManufacturerName" value="{{name}}" required>
  <option value=''>----Select Manufacturer----</option>
  <?php foreach($model1 as $name)
  {
  ?>
    <option value='<?php echo $name->name; ?>'><?php echo $name->name; ?></option>
  <?php } ?>
  </select>
  <p style="color:red">{{ManufacturerName}}</p>
</div> 
		</div>
		<div class="col-md-6">
			<div class="form-group">
			<label for="model">Model Name:</label>
			<input type="text" class="form-control" id="model" name="model" ng-model="ModelName" value="{{model_name}}" required>
			 <p style="color:red">{{ModelName}}</p>
</div>
		</div>
		
		<div class="col-md-6">
			<div class="form-group">
			<label for="Count">Quantity (Count):</label>
			<input type="text" class="form-control" id="Count" name="Count" value="{{quantity}}" ng-model="Count" onkeypress="return isNumber(event)" required>
</div>
		</div> 
		
		<div class="col-md-6">
			 <input type="submit" class="btn btn-warning" value="{{btnName}}" ng-disabled="model1.$invalid" style="margin-top:32px;">
		</div>
	</div>
	</form>
  </div>
  <P>&nbsp;</P>
  
  <h3><?php echo $car_model1; ?>&nbsp;({{Count_data}})</h3>
   <div class="alert alert-danger" id="alert3" style="display:none;">
  <strong>Manufacturer!</strong>Deleted!!!
</div>

<div class="alert alert-success" id="alert4" style="display:none;">
  <strong>Car Model!</strong>Updated!!!
</div>
  <table class="table table-bordered">
    <thead>
      <tr>
       
        <th>Manufacturer Name</th>
		<th>Model Name</th>
        <th>Quantity (Count*)</th>
		 <th>Edit</th>
		 <th>Delete</th>
      </tr>
    </thead>
    		<tr ng-repeat="x in Model_data">
				<!--<td>ID</td>-->
				<td>{{x.name}}</td>
				<td>{{x.model_name}}</td>
				<td>{{x.quantity}}</td>
				<td><button ng-click="Edit(x.id,x.name,x.model_name,x.quantity)" class="btn btn-warning btn-xs">Edit</button></td>
				<td><button ng-click="Delete(x.id)" class="btn btn-danger btn-xs">Delete</button></td>
				
			</tr>
  </table>
</div>
  </body>
<script>
var app = angular.module('Car',[]);
app.controller('CarCtrl', function($scope,$http,$timeout) {
	
	$scope.btnName="SUBMIT";
    $scope.Model = function(){
		if($scope.ManufacturerName ==null)
	{
		alert("Fill Manufacturer Name");
	}
	else if($scope.ModelName ==null)
	{
		alert("Fill Model Name");
	}
	
	else if($scope.Count ==null)
	{
		alert("Fill Quantity");
	}
	else
	{
		$http.post(
		"<?php echo base_url('Model/add_model'); ?>",
		{name:$scope.ManufacturerName,model_name:$scope.ModelName,Count:$scope.Count,btnName:$scope.btnName,'id':$scope.id},
		
		).success(function(data)
		{
			 if(data == 'False')
   {
    $scope.success = false;
    $scope.error = true;
    $scope.errorMessage = "Model Already Existed";
	
   }
   else 
   {
	   
    $scope.success = true;
   $scope.error = false;
   $scope.successMessage = "Model Added";  
   $scope.Model_Show();
	$scope.ManufacturerName='';
	$scope.ModelName=null;
	$scope.Count=null;   
 
    }

	if(data == '1')
		{
	   
    $scope.successMessage = "Manufacturer Name Has Been UPDATED";
	$scope.btnName="SUBMIT";
	$scope.Model_Show();
	 $scope.ManufacturerName='';
	 $scope.ModelName=null;
	 $scope.Count=null;
    
   }
  
   
	
		});
	}	
	},
	
	$scope.Model_Show= function(){
	$http.get(
		"<?php echo base_url('Model/show_model'); ?>",
		
		
		).success(function(data)
		{
			$scope.Count_Show();
			$scope.Model_data=data;
		
		});
	},	
	
	
 $scope.Count_Show= function(){
	$http.get(
		"<?php echo base_url('Model/show_count'); ?>",
		).success(function(data)
		{	
			$scope.Count_data=data;
		});
	},
	
		 $scope.Delete = function(id){
  if(confirm("Are you sure you want to Delete it?"))
  {
   $http({
    method:"POST",
    url:"<?php echo base_url('Model/del_model'); ?>",
    data:{'id':id}
   }).success(function(data){
	   alert(data);
	   $scope.Count_Show();
     $scope.Model_Show();
   });
  }
 }
 
 
	 $scope.Edit = function(id,name,model_name,quantity){
			$scope.id=id;
			$scope.ManufacturerName='';
			$scope.ModelName=model_name;
			$scope.Count=quantity;
			$scope.btnName="UPDATE";
 }
 
	
});	
</script>
</html>
