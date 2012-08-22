<?php

// load the header
$this->load->view('assets/inc/header');

// send the output
echo $yield;

// load the footer
$this->load->view('assets/inc/footer');