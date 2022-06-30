<?php 
class Subkriteria_m extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id_sub';
    $this->data['table_name'] = 'subkriteria';
  }
  public function get_prioritas($id){ 
		$this->db->select('MAX(prioritas) AS prio');
    $this->db->where('id_kriteria' , $id);
		return $this->db->get($this->data['table_name'])->row()->prio; 
	}

  public function min_prio($id){ 
    $this->db->select('MIN(prioritas) AS prio');
    $this->db->where('id_kriteria' , $id);
    return $this->db->get($this->data['table_name'])->row()->prio; 
  }

  public function max_prio($id){ 
    $this->db->select('MAX(prioritas) AS prio');
    $this->db->where('id_kriteria' , $id);
    return $this->db->get($this->data['table_name'])->row()->prio; 
  }
}

 ?>
