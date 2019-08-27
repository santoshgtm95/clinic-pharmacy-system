<?php

class Model_patients extends CI_Model
{

	public function __construct()
	{

		parent::__construct();
	}

	public function getPatientData($id = null)
	{
     
     if($id) {

		$sql = "SELECT * FROM ra_patient WHERE is_deleted = '0' and id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->row_array();
	  }
	     $sql = "SELECT * FROM ra_patient WHERE is_deleted = ?";
	     $query = $this->db->query($sql, array('0'));
	     return $query->result_array();

	}

	public function create($data)
	{
       
       if($data) {
        
          $insert = $this->db->insert('ra_patient', $data);
          
          $patient_id = $this->db->insert_id();

       }

       return ($patient_id) ? $patient_id : false;

	}

	public function update($data,$id)
	{

		if($data && $id) {
            
			$this->db->where('id',$id);
			$update = $this->db->update('ra_patient',$data);
			return ($update == true) ? true : false;
		}
	}

	public function visiting_count($id)
	{

		if($id) {
           
           $sql = "SELECT * FROM ra_complaint where patient_id = ?";
           $query = $this->db->query($sql,array($id));
           return $query->num_rows();

		}
	}

	public function delete($id)
	{

		 if($id) {
            
            $this->db->set('deleted_date', mdate("%Y-%m-%d %H:%i:%s"));
            $this->db->set('is_deleted','1');
		 	$this->db->where('id',$id);
		 	$update = $this->db->update('ra_patient');
		 	return($update == true) ? true : false;
		 }
	}
}