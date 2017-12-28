<!DOCTYPE html>
<html>
	<head>
		<title>Aplikasi | Slip Setoran</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/confirm/jquery-confirm.min.css">
			  
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/material.min.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/dataTablesMaterial.min.css" />
		<script src="<?php echo base_url();?>assets/js/jquery.js"></script>
		<script src="<?php echo base_url();?>assets/mdl/material.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/dataTables.material.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.dataTables.js"></script>
		<link href="<?php echo base_url();?>assets/material/material.css"
      rel="stylesheet">
	</head>
	<!-- Uses a header that contracts as the page scrolls down. -->
	<style>
	.demo-layout-waterfall .mdl-layout__header-row .mdl-navigation__link:last-of-type  {
	  padding-right: 0;
	}
	</style>
	<script>
		$(function(){
			$('#waterfall-exp').change(function(){
				var isi = $('#waterfall-exp').val();
				window.location.href = "<?php echo base_url();?>index.php/form_slip/search/"+isi;
			});
		});
	</script>