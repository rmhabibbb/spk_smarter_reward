<?php 
class Kriteria_m extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id_kriteria';
    $this->data['table_name'] = 'kriteria';
  }


  	public function get_prioritas(){ 
		$this->db->select('MAX(prioritas) AS prio');
		return $this->db->get($this->data['table_name'])->row()->prio; 
	}

	public function min_prio(){ 
		$this->db->select('MIN(prioritas) AS prio');
		return $this->db->get($this->data['table_name'])->row()->prio; 
	}

	public function max_prio(){ 
		$this->db->select('MAX(prioritas) AS prio');
		return $this->db->get($this->data['table_name'])->row()->prio; 
	}

}

 ?>
