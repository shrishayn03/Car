<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {

function __construct() {
        parent::__construct();
        $this->load->helper('url');
		 $this->load->model('Model1');
		  $this->load->model('Inventory_model');
		 
    }


	public function index()
	{
		
	}
	
	public function Inventory_car()
	{
		
		$data["car_manufacture1"]="Car Inventory System";
		$this->load->view('Inventory',$data);
	}
	
	public function show_inventory()
	{	
	
	$data=$this->Model1->Model_show();
	  echo json_encode($data);
	}
	
	public function del_manufacture()
	{	
	 $data= file_get_contents("php://input");
	  $pos=json_decode($data);
	 $id=$pos->id;
	
	$data=$this->Manufacturer_Model->Manufacturer_del($id);
	 if($data)
	 {
	    echo "Manufacturer Deleted Successfully";
	 }
	 else
	 {
		 echo "false";
	 }
	}
	
	public function show_count()
	{
		$data=$this->Inventory_model->Inventory_count();
		echo json_encode($data);
	}
	
	public function Sold()
	{
		$data= file_get_contents("php://input");
		$pos=json_decode($data);
		$id=$pos->id;
	 
		$data=$this->Inventory_model->Sold_Car($id);
		if($data=="1")
		{
			echo "Car Sold";
		}
		else 
			{
			echo "Car Sold & Have More Than 1 Quantity";
		}
	}
	
	
	
}
