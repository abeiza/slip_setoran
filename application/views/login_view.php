<!DOCTYPE html>
<html>
	<head>
		<title>Aplikasi | Slip Setoran</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/material.min.css" />
		<script src="<?php echo base_url();?>assets/mdl/material.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/angular.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.js"></script>
		<link href="<?php echo base_url();?>assets/material/material.css"
      rel="stylesheet">
	</head>
	<style>
	.demo-card-square.mdl-card {
	  width: 320px;
	  height: 480px;
	}
	.demo-card-square > .mdl-card__title {
	  color: #fff;
	  background:
		url('../assets/demos/dog.png') bottom right 15% no-repeat #46B6AC;
	}
	</style>
	<script>
			  $(document).ready(function() {
				  $('#notif').click(function(){
						$('#notif').slideUp('slow');
					});
			  });
	</script>
	<body>
		<div class="container">
			<div style="width:320px;margin:auto;display:flex;align-items:center;height:100%;">
				<div class="demo-card-square mdl-card mdl-shadow--2dp" style="padding:0;">
				  <div class="mdl-card__title mdl-card--expand">
					<h1 class="mdl-card__title-text" style="font-family:pacifico">Login</h1>
				  </div>
				  <div class="mdl-card__supporting-text">
					<?php 
					$attribute = array('id'=>'frmadd','style'=>'padding:0 10px;');
					echo form_open('app/login_act/',$attribute);?>
					  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="text" id="user_id" name="user_id">
						<label style="font-size:12px;color:#46B6AC" for="sample3">ID Pengguna</label>
					  </div>
					  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="password" id="user_pass" name="user_pass">
						<label style="font-size:12px;color:#46B6AC" for="sample3">Password</label>
					  </div>
					  <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
						<i class="material-icons">send</i>
						  Login
					  </button>
					  <span style="font-size:11px;">Lupa Password?</span>
					</form>
				  </div>
				</div>
			</div>
		</div>
	</body>
	<?php echo $this->session->flashdata('change_result')?>
</html>