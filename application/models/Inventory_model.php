<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory_model extends CI_Model {


	public function Model_count()
	{
	$res=$this->db->from("model")->count_all_results();
	return $res;
	}
	
	public function Model_show()
	{ 
	$this->db->select('*');
	 $this->db->from('model');
	 $res=$this->db->get();
	 
	print_r($res->result());
	exit();
	 
	}
	

	
	
	public function Sold_Car($id)
	{  
	$this->db->set('quantity', 'quantity-1', FALSE);
	$this->db->where('id',$id);
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
			 return "0";
			}
	
	}
	
	public function Inventory_count()
	{
	$res=$this->db->from("model")->count_all_results();
	return $res;
	}
}
