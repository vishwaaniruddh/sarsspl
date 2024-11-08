<?php 
$this->load->view('Layout/header');
$this->load->view('Layout/topside');
$this->load->view('Layout/sidebar'); 
$this->load->view($pagename); 
$this->load->view('Layout/theme'); 
$this->load->view('Layout/footer'); 
?>