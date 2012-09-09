<!DOCTYPE html>
<html>

	<head>

		<meta charset="utf-8" />
		<title><?php echo $title; ?> » Sistema Automatizado de Asistencia Virtual</title>

		<!-- fonts -->
		<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,700|Arvo' rel='stylesheet' type='text/css'>
		
		<!-- styles -->
		<link rel="stylesheet" href="<?php echo $this->resource->css('bs.css'); ?>" />
		<link rel="stylesheet" href="<?php echo $this->resource->css('bs-r.css'); ?>" />
		<link rel="stylesheet" href="<?php echo $this->resource->css('fa.css'); ?>" />
		<link rel="stylesheet" href="<?php echo $this->resource->css('fa-ie.css'); ?>" />
		<link rel="stylesheet" href="<?php echo $this->resource->css('app.css'); ?>" />

		<!-- scripts -->
		<script src="<?php echo $this->resource->js('jq.js'); ?>"></script>
		<script src="<?php echo $this->resource->js('bs.js'); ?>"></script>
		<script src="<?php echo $this->resource->js('app.js'); ?>"></script>

	</head>

	<body data-controller="<?php echo $this->uri->segment(1); ?>" data-method="<?php echo $this->uri->segment(2); ?>" data-root="<?php echo base_url(); ?>" data-uri="<?php echo uri_string(); ?>">