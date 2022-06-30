<?php 
class Laporan_m extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id_laporan';
    $this->data['table_name'] = 'laporan';
  }
}

 ?>
