<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manufacturer extends CI_Controller {

function __construct() {
        parent::__construct();
        $this->load->helper('url');
		 $this->load->model('Manufacturer_Model');
    }


	public function index()
	{
		$data["title"]="Mini Car Inventory System";
		$this->load->view('home',$data);
	}
	
	public function car_manufacture()
	{
		$data["car_manufacture"]="Add Car Manufacturer";
		$data["car_manufacture1"]="Display Car Manufacturer";
		$this->load->view('car_manufacture',$data);
	}
	
	public function add_manufacture()
	{	
	  $data= file_get_contents("php://input");
	  $pos=json_decode($data);
	 $name1=$pos->name;
	$btnName=$pos->btnName;
	
	if($btnName=="ADD")
	{
		 $data=$this->Manufacturer_Model->Manufacturer($name1);
		      if($data)
	 {
	    echo "true";
	 }
	 else
	 {
		 echo "false";
	 }
	}
	if($btnName=="UPDATE")
	{	
	 $id=$pos->id;
	 
	 $data=$this->Manufacturer_Model->Manufacturer_update($id,$name1);
     if($data)
	 {
	    echo "1";
	 }
	 else
	 {

		 echo "2";
	 }
	}
	}
	
	public function show_manufacture()
	{	
	
	$data=$this->Manufacturer_Model->Manufacturer_show_data();
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
		$data=$this->Manufacturer_Model->Model_count();
		echo json_encode($data);
	}
	
}
