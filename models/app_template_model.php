<?php

class {APP_CLASS}_model extends CI_Model {
    
    function __construct()
    {
        parent::__construct();
    }
    
    function get_data($limit=10)
    {
 		$this->db->select('data.status_id, table.user_id');
 		$this->db->from('data');    
 		$this->db->join('users', 'data.user_id = user.user_id'); 				
 		$this->db->order_by('created_at', 'desc'); 
		$this->db->limit($limit);    
 		$result = $this->db->get();	
 		return $result->result();	      
    }
    
    function add_data($data)
    {
 		$data = array(
			'user_id' 	 		=> $data['user_id'],
			'text'  	 		=> $data['text'],
			'created_at' 		=> unix_to_mysql(now()),
			'updated_at' 		=> unix_to_mysql(now())
		);

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