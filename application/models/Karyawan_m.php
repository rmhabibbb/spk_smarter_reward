<?php 
class Karyawan_m extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id_karyawan';
    $this->data['table_name'] = 'karyawan';
  }

 


}

 ?>
