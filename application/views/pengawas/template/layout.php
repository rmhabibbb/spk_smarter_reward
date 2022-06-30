<?php
$data =[
  'title' => $title,
  'index' => $index
];
$this->load->view('pengawas/template/header',$data);
$this->load->view('pengawas/template/navbar');
$this->load->view('pengawas/template/sidebar',$data);
$this->load->view($content);
$this->load->view('pengawas/template/footer');
 ?>
