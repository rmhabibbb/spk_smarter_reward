<?php
$data =[
  'title' => $title,
  'index' => $index
];
$this->load->view('kabag/template/header',$data);
$this->load->view('kabag/template/navbar');
$this->load->view('kabag/template/sidebar',$data);
$this->load->view($content);
$this->load->view('kabag/template/footer');
 ?>
