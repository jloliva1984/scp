
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="">
	<link rel="<?php echo base_url('/assets');?>/bootstrap/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<link href="<?php echo base_url('/assets');?>/login/login.css" rel="stylesheet" />

	<title>Login</title>
</head>
<body>

	<!-- Main Content -->
	
		<div class="row main-content bg-success text-center">
			<div class="col-md-4 text-center company__info">
				<span class="company__logo"><h2><span class="fa fa-android"></span></h2></span>
				<h2 class="company_title">Sistema de costos por proyectos </h2>
			</div>
			<div class="col-md-8 col-xs-12 col-sm-12 login_form ">
				<div class="container-fluid">
					<div class="row text-center">
						<h2 text-center>Formulario acceso</h2>
					</div>
					<div class="row">
					<?php helper('form');?>
					<?php echo form_open('Login/index', 'class="form-group" id=login" method="POST"'); ?>
						<!--<form control="" class="form-group">-->
							<div class="row">
								<input type="text" name="username" id="username" class="form__input" placeholder="Usuario">
							</div>
							<div class="row">
								<!-- <span class="fa fa-lock"></span> -->
								<input type="password" name="password" id="password" class="form__input" placeholder="Password">
							</div>
							
							<div class="row">
								<input type="submit" value="ENTRAR" class="btn">
							</div>
						<?php echo form_close(); ?>	
						<!--</form>-->
					</div>
					<div class="row">
						mensajes de error aqui
					</div>
				</div>
			</div>
		</div>
	
	<!-- Footer -->

	<script src="<?php echo base_url('/assets');?>/bootstrap/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>