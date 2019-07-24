<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">

<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/popper.min.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script> 


  </head>
  <body>
   <nav class="navbar navbar-expand-sm bg-primary navbar-dark">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link active" href="<?php echo base_url('Manufacturer/index'); ?>">Car Rental</a>
    </li>
    <li class="nav-item">
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
<div class="container">
  <div class="jumbotron">
    <h1><center><?php echo $title; ?></center></h1>      
    <img class="img-fluid mx-auto d-block" src="<?php echo base_url('assets/img/car.jpg'); ?>" alt="Chania" width="460" height="345"> 
  </div>
</div>

  </body>
  
</html>
