<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model1 extends CI_Model {


	public function Model_count()
	{
	$res=$this->db->from("model")->count_all_results();
	return $res;
	}
	
	public function model_Add($name,$model_name,$Count)
	{		
	$data = array(				
				'model_name' 			=> $model_name,
				'name' 			=> $name,
				'quantity' 			=> $Count,
			);
	
	 $this->db->select('*');
	 $this->db->from('model');
	$this->db->where('model_name',$model_name);
	 
	 $res=$this->db->get();
	
	if($res->num_rows() > 0)
	{
		
		return false;
		
	}
	else
	{
		$result=$this->db->insert('model',$data);
		return $result;
	}
	
}


	public function Model_show()
	{ 
	$this->db->select('*');
	 $this->db->from('model');
	 $res=$this->db->get();
	 
	$res->result();
		if ($res->num_rows() > 0) {
			return $res->result();
		} else {
			return FALSE;
		}
	 
	}
	
	
	public function Model_del($id)
	{ 
	 $this->db->where('id', $id);
$del=$this->db->delete('model');

	return $del; 
	}

	public function Model_edit()
	{ 
	$id= $this->input->post('id');
	
	 $this->db->select('*');
	 $this->db->from('model');
	 $this->db->where('id',$id);

	 $res=$this->db->get();
	 return $res->row();
	}
	
	
	public function Model_up($id,$name,$name1,$Count)
	{ 	
		$data = array( 
					'id'	=>  $id, 
					'model_name' =>  $name1, 
					'name' =>  $name,
					'quantity' =>  $Count, 	
    
					);
						
		$this->db->where('id',$id);
		$up=$this->db->update('model',$data);

		return $up;
	
	}
	
	
	public function Sold_Model($id)
	{  
	$this->db->set('quantity', 'quantity-1', FALSE);
	$this->db->where('id', $id);
	$up=$this->db->update('model');

	if($up > 0)
	{
		$this->db->select('quantity');
		$this->db->where('id', $id);
	 $this->db->from('model');
	 $res=$this->db->get();
	
		if($res->row()->quantity <= 1)
			{
				$this->db->where('id', $id);
				$del=$this->db->delete('model');   
				return "1";
			}
	}
	else
			{
			 return 0;
			}
	
	}
}
