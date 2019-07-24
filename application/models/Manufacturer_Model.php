<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manufacturer_Model extends CI_Model {

	public function Manufacturer($name1)
	{
		
		
		
	$data = array(				
				'name' 	=> $name1, 
			);
	
	
	 $this->db->select('*');
	 $this->db->from('manufacturer');
	 $this->db->where('name',$name1);
	 
	 $res=$this->db->get();
	
	if($res->num_rows() > 0)
	{
		
		return false;
		
	}
	else
	{
		$result=$this->db->insert('manufacturer',$data);
		return $result;
	}
	
}


	public function Manufacturer_show_data()
	{ 
	 $this->db->select('*');
    $q = $this->db->get('manufacturer');
    $results = $q->result_array();

    return $results;
	 

		
		
	 }
	
	
	public function Manufacturer_show1()
	{ 
	$this->db->select();
	 $this->db->from('manufacturer');
	 $res=$this->db->get();
	 return $res->result();
	}
	
	
	public function Manufacturer_del($id)
	{ 

	 $this->db->where('id', $id);
$del=$this->db->delete('manufacturer');

	return $del; 
	}

	
public function Manufacturer_update($id,$name1)
	{ 
	
	
		$data = array( 
    'id'	=>  $id, 
    'name' =>  $name1, 
    
);
		 $this->db->select('*');
	 $this->db->from('manufacturer');
	 $this->db->where('name',$name1);
	 
	 $res=$this->db->get();
			if($res->num_rows() > 0)
	{
		
		return false;
		
	}
	else
	{	
		
		$this->db->where('id',$id);
		$up=$this->db->update('manufacturer',$data);

		return $up;
	}
	}

public function Model_count()
	{
	$res=$this->db->from("manufacturer")->count_all_results();
	return $res;
	}

}
