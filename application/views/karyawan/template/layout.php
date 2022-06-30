<?php
$data =[
  'title' => $title,
  'index' => $index
];
$this->load->view('karyawan/template/header',$data);
$this->load->view('karyawan/template/navbar');
$this->load->view('karyawan/template/sidebar',$data);
$this->load->view($content);
$this->load->view('karyawan/template/footer');
 ?>
