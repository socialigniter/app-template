<?php

class Data_model extends CI_Model {
    
    function __construct()
    {
        parent::__construct();
    }
    
    function get_data($data_id)
    {
 		$this->db->select('*');
 		$this->db->from('data');    
 		$this->db->where('data_id', $data_id);
 		$this->db->order_by('created_at', 'desc'); 
		$this->db->limit(1);    
 		$result = $this->db->get()->row();	
 		return $result;	      
    }

    function get_data_view()
    {
 		$this->db->select('*');
 		$this->db->from('data');    
 		$this->db->order_by('created_at', 'desc'); 
 		$result = $this->db->get();	
 		return $result->result();	      
    }
    
    function add_data($data)
    {
 		$data['created_at'] = unix_to_mysql(now());
		$data['updated_at'] = unix_to_mysql(now());

		$insert 	= $this->db->insert('data', $data);
		$data_id 	= $this->db->insert_id();
		return $this->db->get_where('data', array('data_id' => $data_id))->row();
    }

    function udpate_data($data_id, $data)
    {
		$data['updated_at'] = unix_to_mysql(now());
		$this->db->where('data_id', $data_id);
		$this->db->update('data', $data);
		return $this->db->get_where('data', array('data_id' => $data_id))->row();	
    }

    function delete_data($data_id)
    {
    	$this->db->where('data_id', $data_id);
    	$this->db->delete('data');
		return TRUE;
    }

}