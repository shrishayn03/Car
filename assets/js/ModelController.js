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