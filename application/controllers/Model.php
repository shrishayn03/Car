<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends CI_Controller {

function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->model('Manufacturer_Model');
		$this->load->model('Model1');
    }


	public function index()
	{
		
	}
	
	public function car_model()
	{
		$data["car_model"]="Add Car Model";
		$data["car_model1"]="Display Car's Data";
		$data["model1"]=$this->Manufacturer_Model->Manufacturer_show1();
		//$data["count"]=$this->Model1->Model_count();
		$this->load->view('Model',$data);
	}
	
	
	public function add_model()
	{
		$data= file_get_contents("php://input");
	  $pos=json_decode($data);
	
			$btnName=$pos->btnName;
			
			
			$name= $pos->name;
			$model_name= $pos->model_name;
			$Count= $pos->Count;
			
			
			if($btnName=="SUBMIT")
			{
				$data=$this->Model1->model_Add($name,$model_name,$Count);
				if($data > 0)
					{
						echo "True";	
					}
				else
					{
						echo "False";
					}
			}	
		
		if($btnName=="UPDATE")
	{	
	 $id=$pos->id;
	 
	 $data=$this->Model1->Model_up($id,$name,$model_name,$Count);
     if($data)
	 {
	    echo "1";
	 }
	 else
	 {

		 echo "False";
	 }
	}
	}
	
	public function show_count()
	{
		$data=$this->Model1->Model_count();
		echo json_encode($data);
	}
	
	public function show_model()
	{	
	$data=$this->Model1->model_show();
	echo json_encode($data);
	}
	
	
	public function del_model()
	{	
	 $data= file_get_contents("php://input");
	  $pos=json_decode($data);
	 $id=$pos->id;
	
	
	$data=$this->Model1->Model_del($id);
	 if($data)
	 {
	    echo "Model Data Deleted Successfully";
	 }
	 else
	 {
		 echo "false";
	 }
	}

}
